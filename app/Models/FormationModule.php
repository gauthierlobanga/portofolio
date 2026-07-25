<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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
 * @property-read Formation $formation
 * @property-read Collection|ModuleProject[] $projects
 * @property-read Collection|UserModuleProgress[] $userProgress
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
        'is_active',
    ];

    /**
     * Always eager-load these relationships to avoid lazy-loading when the app
     * disables it globally. This prevents LazyLoadingViolationException when
     * templates or other code access $module->projects without explicitly
     * eager-loading them.
     *
     * Note: If performance becomes a concern, consider removing this and
     * eager-loading 'projects' only where needed (e.g., with('projects')).
     */
    protected $with = ['projects'];

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

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'formation_module_id');
    }
}
