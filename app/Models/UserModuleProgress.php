<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Représente le suivi et la progression d'un utilisateur sur un module spécifique.
 * 
 * @property int $id
 * @property string $user_id
 * @property string $formation_module_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $completed_at
 * 
 * @property-read \App\Models\User $user
 * @property-read \App\Models\FormationModule $module
 */
class UserModuleProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'formation_module_id',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(FormationModule::class, 'formation_module_id');
    }
}
