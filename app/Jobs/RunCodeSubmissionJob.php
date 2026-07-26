<?php

namespace App\Jobs;

use App\Models\CodeSubmission;
use App\Models\UserAssessmentAnswer;
use App\Models\UserAssessmentAttempt;
use App\Services\Judge0Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RunCodeSubmissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public CodeSubmission $submission)
    {
        $this->afterCommit();
    }

    public function handle(): void
    {
        $submission = $this->submission->fresh();
        if (! $submission) {
            return;
        }

        $submission->update(['status' => 'running']);

        try {
            $client = new Judge0Client;
            $language = $submission->language ?? 'php';

            $result = $client->submit($submission->source_code, $language);

            if (! $result['ok']) {
                $submission->update([
                    'status' => 'failed',
                    'run_output' => $result['body'] ?? null,
                    'test_results' => $result['body'] ?? null,
                ]);

                $this->recalculateAttempt($submission);

                return;
            }

            $body = $result['body'] ?? [];
            $stdout = $body['stdout'] ?? null;
            $stderr = $body['stderr'] ?? null;
            $compileOutput = $body['compile_output'] ?? null;
            $status = $body['status'] ?? null;
            $passed = null;

            if (isset($body['expected_output']) && isset($stdout)) {
                $passed = trim((string) $stdout) === trim((string) $body['expected_output']);
            }

            $submission->update([
                'status' => 'completed',
                'run_output' => json_encode([
                    'stdout' => $stdout,
                    'stderr' => $stderr,
                    'compile' => $compileOutput,
                    'status' => $status,
                ], JSON_UNESCAPED_UNICODE),
                'test_results' => $body,
                'passed' => $passed,
                'judge0_token' => $body['token'] ?? null,
            ]);

            if ($passed) {
                $question = $submission->question;
                $points = $question?->points ?? 0;

                UserAssessmentAnswer::query()
                    ->where('user_assessment_attempt_id', $submission->user_assessment_attempt_id)
                    ->where('assessment_question_id', $submission->assessment_question_id)
                    ->update([
                        'is_correct' => true,
                        'points_awarded' => $points,
                    ]);
            }

            $this->recalculateAttempt($submission);
        } catch (\Throwable $exception) {
            Log::error('RunCodeSubmissionJob failed: '.$exception->getMessage());

            $submission->update([
                'status' => 'failed',
                'run_output' => $exception->getMessage(),
            ]);

            $this->recalculateAttempt($submission);
        }
    }

    protected function recalculateAttempt(CodeSubmission $submission): void
    {
        $attempt = UserAssessmentAttempt::with(['assessment.questions', 'answers', 'codeSubmissions'])
            ->find($submission->user_assessment_attempt_id);

        if (! $attempt) {
            return;
        }

        $attempt->recalculateScore();
    }
}
