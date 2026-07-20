<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    /** @use HasFactory<\Database\Factories\ExperienceFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'position',
        'description',
        'start_date',
        'end_date',
        'is_current',
        'location',
        'technologies',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_current' => 'boolean',
            'technologies' => 'array',
        ];
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('start_date', 'desc');
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }
}
