<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Représente un projet pratique associé à un module de formation.
 * 
 * @property string $id
 * @property string $formation_module_id
 * @property string $title
 * @property string|null $description
 * 
 * @property-read \App\Models\FormationModule $module
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserProjectSubmission[] $submissions
 */
class ModuleProject extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'formation_module_id',
        'title',
        'description',
    ];

    public function module()
    {
        return $this->belongsTo(FormationModule::class, 'formation_module_id');
    }

    public function submissions()
    {
        return $this->hasMany(UserProjectSubmission::class);
    }
}
