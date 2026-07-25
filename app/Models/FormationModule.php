<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Représente un module pédagogique appartenant à une formation.
 * 
 * @property string $id
 * @property string $formation_id
 * @property string $title
 * @property string|null $slug
 * @property string|null $description
 * @property int $sort_order
 * 
 * @property-read \App\Models\Formation $formation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ModuleProject[] $projects
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserModuleProgress[] $userProgress
 */
class FormationModule extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'formation_id',
        'title',
        'slug',
        'description',
        'sort_order',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function projects()
    {
        return $this->hasMany(ModuleProject::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserModuleProgress::class);
    }
}
