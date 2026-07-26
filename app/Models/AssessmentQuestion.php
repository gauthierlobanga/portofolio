<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentQuestion extends Model
{
    use HasFactory, HasUuids;

    public const TYPE_MULTIPLE_CHOICE = 'multiple_choice';

    public const TYPE_TEXT = 'text';

    public const TYPE_CODE_EDITOR = 'code_editor';

    protected static array $typeAliases = [
        'qcm' => self::TYPE_MULTIPLE_CHOICE,
        'code' => self::TYPE_CODE_EDITOR,
    ];

    protected $fillable = [
        'assessment_id',
        'question_text',
        'type',
        'points',
        'sort_order',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function setTypeAttribute(string $value): void
    {
        $this->attributes['type'] = self::$typeAliases[$value] ?? $value;
    }

    public function options(): HasMany
    {
        return $this->hasMany(AssessmentOption::class);
    }
}
