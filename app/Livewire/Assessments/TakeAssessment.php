<?php

namespace App\Livewire\Assessments;

use App\Actions\Formations\RegisterForFormation;
use App\Jobs\RunCodeSubmissionJob;
use App\Models\Assessment;
use App\Models\CodeSubmission;
use App\Models\FormationRegistration;
use App\Models\User;
use App\Models\UserAssessmentAnswer;
use App\Models\UserAssessmentAttempt;
use App\Models\UserModuleProgress;
use App\Notifications\FormationRegistrationAdminAlert;
use App\Notifications\FormationRegistrationSubmitted;
use Flux\Flux;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class TakeAssessment extends Component
{
    public Assessment $assessment;

    public UserAssessmentAttempt $attempt;

    public $answers = [];

    public function mount(Assessment $assessment)
    {
        $this->assessment = $assessment->load('questions.options');

        $this->attempt = UserAssessmentAttempt::firstOrCreate(
            ['user_id' => auth()->id(), 'assessment_id' => $assessment->id],
            ['status' => 'started', 'started_at' => now()]
        );

        if ($this->attempt->status === 'completed' || $this->attempt->status === 'graded') {
            Flux::toast(
                text: 'Vous avez déjà soumis cette évaluation.',
                variant: 'danger',
            );
            $this->redirectRoute('dashboard');
        }

        foreach ($this->assessment->questions as $question) {
            $this->answers[$question->id] = '';
        }
    }

    public function submit()
    {
        $totalScore = 0;
        $totalPossible = 0;
        $hasCodeQuestions = $this->assessment->questions->contains(function ($question) {
            return in_array($question->type, ['code_editor', 'code'], true);
        });

        foreach ($this->assessment->questions as $question) {
            $answerVal = $this->answers[$question->id] ?? null;
            $isCorrect = false;
            $points = 0;
            $totalPossible += $question->points;

            // Multiple choice / QCM
            if (in_array($question->type, ['qcm', 'multiple_choice'], true)) {
                $correctOption = $question->options->where('is_correct', true)->first();
                if ($correctOption && $correctOption->id == $answerVal) {
                    $isCorrect = true;
                    $points = $question->points;
                    $totalScore += $points;
                }

                UserAssessmentAnswer::updateOrCreate(
                    [
                        'user_assessment_attempt_id' => $this->attempt->id,
                        'assessment_question_id' => $question->id,
                    ],
                    [
                        'answer_text' => is_array($answerVal) ? json_encode($answerVal) : $answerVal,
                        'is_correct' => $isCorrect,
                        'points_awarded' => $points,
                    ]
                );

                continue;
            }

            // Text answers
            if ($question->type === 'text') {
                UserAssessmentAnswer::updateOrCreate(
                    [
                        'user_assessment_attempt_id' => $this->attempt->id,
                        'assessment_question_id' => $question->id,
                    ],
                    [
                        'answer_text' => is_array($answerVal) ? json_encode($answerVal) : $answerVal,
                        'is_correct' => null,
                        'points_awarded' => 0,
                    ]
                );

                continue;
            }

            // Code editor answers (TP / TD)
            if (in_array($question->type, ['code_editor', 'code'], true)) {
                // persist a CodeSubmission record and link it to the answer
                $submission = CodeSubmission::create([
                    'user_id' => $this->attempt->user_id,
                    'assessment_id' => $this->assessment->id,
                    'assessment_question_id' => $question->id,
                    'user_assessment_attempt_id' => $this->attempt->id,
                    'source_code' => (string) $answerVal,
                    'language' => 'php', // could be made configurable per question
                    'status' => 'pending',
                ]);

                // Save the answer record referencing the submission id in file_path for traceability
                UserAssessmentAnswer::updateOrCreate(
                    [
                        'user_assessment_attempt_id' => $this->attempt->id,
                        'assessment_question_id' => $question->id,
                    ],
                    [
                        'answer_text' => null,
                        'file_path' => $submission->id,
                        'is_correct' => null,
                        'points_awarded' => 0,
                    ]
                );

                // Dispatch the code submission for asynchronous execution.
                if (env('JUDGE0_ENABLED', false)) {
                    RunCodeSubmissionJob::dispatch($submission);
                }

                continue;
            }

            // Fallback generic storage
            UserAssessmentAnswer::updateOrCreate(
                [
                    'user_assessment_attempt_id' => $this->attempt->id,
                    'assessment_question_id' => $question->id,
                ],
                [
                    'answer_text' => is_array($answerVal) ? json_encode($answerVal) : $answerVal,
                    'is_correct' => null,
                    'points_awarded' => 0,
                ]
            );
        }
        $percentage = $totalPossible > 0 ? ($totalScore / $totalPossible) * 100 : 0;
        $passed = $percentage >= $this->assessment->passing_score;

        $this->attempt->update([
            'status' => $hasCodeQuestions ? 'completed' : 'graded',
            'completed_at' => now(),
            'score' => $percentage,
            'passed' => $passed,
        ]);

        if ($passed && $this->assessment->formation_module_id) {
            UserModuleProgress::updateOrCreate(
                [
                    'user_id' => $this->attempt->user_id,
                    'formation_module_id' => $this->assessment->formation_module_id,
                ],
                ['is_completed' => true, 'completed_at' => now()]
            );
        }

        if ($passed && $this->assessment->type === 'admission' && $this->assessment->formation_id) {
            // Ensure the user has a registration for this formation and mark it as pending approval/payment when needed.
            $registration = FormationRegistration::withTrashed()
                ->where('user_id', $this->attempt->user_id)
                ->where('formation_id', $this->assessment->formation_id)
                ->first();

            try {
                $user = $this->attempt->user ?? auth()->user();
                // If an existing registration exists, update notes and ensure status/payment are set to pending where appropriate
                if ($registration) {
                    $notes = $registration->admin_notes ? $registration->admin_notes."\n" : '';
                    $registration->update([
                        'admin_notes' => $notes.'Test d\'admission réussi avec un score de '.round($percentage, 2).'% le '.now()->format('d/m/Y H:i'),
                        'status' => FormationRegistration::STATUS_PENDING,
                        'payment_status' => $registration->formation && $registration->formation->price ? FormationRegistration::PAYMENT_PENDING : FormationRegistration::PAYMENT_FREE,
                    ]);
                } else {
                    // Create a registration using the existing action to keep logic consistent
                    $registrationAction = app(RegisterForFormation::class);
                    $registration = $registrationAction(
                        $this->assessment->formation,
                        $user,
                        'Inscription automatique après réussite du test d\'admission (score: '.round($percentage, 2).'%)',
                        true
                    );
                }

                // Notify admins that a new registration needs attention
                $admins = User::query()
                    ->whereHas('roles', function ($q) {
                        $q->whereIn('name', ['super_admin', 'admin']);
                    })
                    ->get();

                if ($registration && $admins->isNotEmpty()) {
                    Notification::send($admins, new FormationRegistrationAdminAlert($registration));
                }

                // Notify the participant that their registration has been recorded
                if ($registration && $user) {
                    $user->notify(new FormationRegistrationSubmitted($registration));
                }
            } catch (\Throwable $e) {
                \Log::error('Error while creating/updating registration after admission test: '.$e->getMessage());
            }
        }

        Flux::toast(
            text: 'Votre évaluation a été soumise avec succès.',
            variant: 'success',
        );
        $this->redirectRoute('dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.assessments.take-assessment')
            ->layout('layouts.app', ['title' => $this->assessment->title]);
    }
}
