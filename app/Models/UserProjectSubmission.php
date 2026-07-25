<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Représente la soumission d'un projet par un utilisateur pour évaluation.
 * 
 * @property int $id
 * @property string $user_id
 * @property string $module_project_id
 * @property string $status
 * @property int|null $grade
 * @property string|null $feedback
 * 
 * @property-read \App\Models\User $user
 * @property-read \App\Models\ModuleProject $project
 */
class UserProjectSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module_project_id',
        'status',
        'grade',
        'feedback',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(ModuleProject::class, 'module_project_id');
    }
}
