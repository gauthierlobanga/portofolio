<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'formation_id',
        'formation_module_id',
        'title',
        'description',
        'type',
        'duration_minutes',
        'passing_score',
        'is_active',
    ];

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(FormationModule::class, 'formation_module_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(AssessmentQuestion::class);
    }
}
