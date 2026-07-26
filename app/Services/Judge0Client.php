<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

final class Judge0Client
{
    public function submit(string $sourceCode, string $language = 'php', array $options = []): array
    {
        $base = rtrim(env('JUDGE0_URL', 'https://judge0-ce.p.rapidapi.com'), '/');
        $apiKey = env('JUDGE0_API_KEY');

        // Judge0 expects language_id; this project leaves mapping to caller or environment.
        $payload = array_merge([
            'source_code' => $sourceCode,
            'language' => $language,
            // optional fields: stdin, expected_output, etc.
        ], $options);

        $headers = [];
        if ($apiKey) {
            // Some Judge0 providers use RapidAPI or an API key header - support a generic header
            $headers['X-RapidAPI-Key'] = $apiKey;
        }

        $response = Http::withHeaders($headers)
            ->post($base.'/submissions?base64_encoded=false&wait=true', $payload);

        if (! $response->successful()) {
            return [
                'ok' => false,
                'status' => $response->status(),
                'body' => $response->body(),
            ];
        }

        return [
            'ok' => true,
            'body' => $response->json(),
        ];
    }
}
