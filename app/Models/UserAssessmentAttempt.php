<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAssessmentAttempt extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'assessment_id',
        'status',
        'started_at',
        'completed_at',
        'score',
        'passed',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'passed' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(UserAssessmentAnswer::class, 'user_assessment_attempt_id');
    }

    public function codeSubmissions(): HasMany
    {
        return $this->hasMany(CodeSubmission::class, 'user_assessment_attempt_id');
    }

    public function recalculateScore(): void
    {
        $attempt = $this->loadMissing(['assessment.questions', 'answers']);

        $totalPossible = $this->assessment->questions->sum('points');
        $awarded = $this->answers->sum(fn ($answer) => $answer->points_awarded ?? 0);
        $percentage = $totalPossible > 0 ? round(($awarded / $totalPossible) * 100, 2) : 0.0;
        $passed = $this->assessment->passing_score !== null ? $percentage >= $this->assessment->passing_score : false;
        $hasPendingCode = $this->codeSubmissions()->whereIn('status', ['pending', 'running'])->exists();

        $this->update([
            'score' => $percentage,
            'passed' => $passed,
            'status' => $hasPendingCode ? 'completed' : 'graded',
        ]);

        if ($passed && $this->assessment->formation_module_id) {
            UserModuleProgress::updateOrCreate(
                [
                    'user_id' => $this->user_id,
                    'formation_module_id' => $this->assessment->formation_module_id,
                ],
                ['is_completed' => true, 'completed_at' => now()]
            );
        }
    }
}
