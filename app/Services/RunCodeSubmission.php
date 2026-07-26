<?php

namespace App\Services;

use App\Models\CodeSubmission;
use Exception;

final class RunCodeSubmission
{
    public function run(CodeSubmission $submission): CodeSubmission
    {
        $submission->update(['status' => 'running']);

        try {
            $client = new Judge0Client;
            $language = $submission->language ?? 'php';

            $result = $client->submit($submission->source_code, $language);

            if (! $result['ok']) {
                $submission->update([
                    'status' => 'failed',
                    'run_output' => $result['body'] ?? null,
                ]);

                return $submission->fresh();
            }

            $body = $result['body'] ?? [];

            $stdout = $body['stdout'] ?? null;
            $stderr = $body['stderr'] ?? null;
            $compile_output = $body['compile_output'] ?? null;
            $status = $body['status'] ?? null;

            $passed = null;
            if (isset($body['expected_output']) && isset($stdout)) {
                $passed = trim((string) $stdout) === trim((string) $body['expected_output']);
            }

            $submission->update([
                'status' => 'completed',
                'run_output' => json_encode(['stdout' => $stdout, 'stderr' => $stderr, 'compile' => $compile_output, 'status' => $status], JSON_UNESCAPED_UNICODE),
                'test_results' => $body,
                'passed' => $passed,
                'judge0_token' => $body['token'] ?? null,
            ]);

            return $submission->fresh();
        } catch (Exception $e) {
            $submission->update([
                'status' => 'failed',
                'run_output' => $e->getMessage(),
            ]);

            return $submission->fresh();
        }
    }
}
