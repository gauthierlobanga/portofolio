<?php

use App\Jobs\RunCodeSubmissionJob;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\CodeSubmission;
use App\Models\User;
use App\Models\UserAssessmentAnswer;
use App\Models\UserAssessmentAttempt;
use Illuminate\Support\Facades\Http;

it('dispatches the run code submission job and updates the attempt score', function () {
    Http::fake([
        '*' => Http::response([
            'stdout' => 'Hello World',
            'stderr' => null,
            'compile_output' => null,
            'status' => ['id' => 3, 'description' => 'Accepted'],
            'token' => 'judge0-token',
            'expected_output' => 'Hello World',
        ], 200),
    ]);

    $user = User::factory()->create();

    $assessment = Assessment::create([
        'title' => 'Code TP',
        'type' => 'tp',
        'description' => 'Testing code submission',
        'passing_score' => 50,
        'is_active' => true,
    ]);

    $question = AssessmentQuestion::create([
        'assessment_id' => $assessment->id,
        'question_text' => 'Écrire du code',
        'type' => 'code_editor',
        'points' => 10,
    ]);

    $attempt = UserAssessmentAttempt::create([
        'user_id' => $user->id,
        'assessment_id' => $assessment->id,
        'status' => 'completed',
        'started_at' => now(),
    ]);

    UserAssessmentAnswer::create([
        'user_assessment_attempt_id' => $attempt->id,
        'assessment_question_id' => $question->id,
        'answer_text' => null,
        'file_path' => null,
        'is_correct' => null,
        'points_awarded' => 0,
    ]);

    $submission = CodeSubmission::create([
        'user_id' => $user->id,
        'assessment_id' => $assessment->id,
        'assessment_question_id' => $question->id,
        'user_assessment_attempt_id' => $attempt->id,
        'source_code' => 'echo "Hello World";',
        'language' => 'php',
        'status' => 'pending',
    ]);

    RunCodeSubmissionJob::dispatchSync($submission);

    $submission->refresh();
    $attempt->refresh();

    expect($submission->status)->toBe('completed');
    expect($submission->passed)->toBe(true);
    expect($submission->judge0_token)->toBe('judge0-token');
    expect($attempt->status)->toBe('graded');
    expect((float) $attempt->score)->toBe(100.0);
    expect($attempt->passed)->toBe(true);
});
