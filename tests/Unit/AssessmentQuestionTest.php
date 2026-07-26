<?php

use App\Models\AssessmentQuestion;

it('normalizes qcm type alias to multiple_choice', function () {
    $question = new AssessmentQuestion([
        'type' => 'qcm',
    ]);

    expect($question->type)->toBe('multiple_choice');
});

it('normalizes code type alias to code_editor', function () {
    $question = new AssessmentQuestion([
        'type' => 'code',
    ]);

    expect($question->type)->toBe('code_editor');
});
