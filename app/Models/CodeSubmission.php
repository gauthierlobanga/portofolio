<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CodeSubmission extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'assessment_id',
        'assessment_question_id',
        'user_assessment_attempt_id',
        'source_code',
        'language',
        'run_output',
        'passed',
        'test_results',
        'judge0_token',
        'status',
    ];

    protected $casts = [
        'passed' => 'boolean',
        'test_results' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(AssessmentQuestion::class, 'assessment_question_id');
    }

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(UserAssessmentAttempt::class, 'user_assessment_attempt_id');
    }
}
