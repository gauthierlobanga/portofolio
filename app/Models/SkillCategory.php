<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SkillCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'color', 'icon', 'sort_order'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
