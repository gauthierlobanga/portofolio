<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FormationCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'color', 'sort_order'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}

