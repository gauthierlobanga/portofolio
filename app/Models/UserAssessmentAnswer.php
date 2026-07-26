<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAssessmentAnswer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_assessment_attempt_id',
        'assessment_question_id',
        'answer_text',
        'file_path',
        'is_correct',
        'points_awarded',
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(UserAssessmentAttempt::class, 'user_assessment_attempt_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(AssessmentQuestion::class, 'assessment_question_id');
    }
}
