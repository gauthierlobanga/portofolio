<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Skill extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'level', 'category', 'skill_category_id'];

    protected $casts = [
        'level' => 'integer',
    ];

    // --------------------------------------------------------------
    // Relations
    // --------------------------------------------------------------
    public function categorySkill()
    {
        return $this->belongsTo(SkillCategory::class, 'skill_category_id');
    }

    // --------------------------------------------------------------
    // Accesseurs / Mutateurs utiles
    // --------------------------------------------------------------
    public function icon(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('icon') ?: null,
        );
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('image') ?: null,
        );
    }

    public function color(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->categorySkill?->color ?? '#6b7280', // gris par défaut
        );
    }

    // --------------------------------------------------------------
    // Media Library
    // --------------------------------------------------------------
    public function registerMediaCollections(): void
    {
        // Icône (SVG ou PNG)
        $this->addMediaCollection('icon')
            ->singleFile()
            ->useDisk('public')
            ->acceptsMimeTypes(['image/png', 'image/webp', 'image/svg+xml'])
            ->withResponsiveImages();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // Miniature 150x150
        $this->addMediaConversion('icon')
            ->width(150)
            ->height(150)
            ->fit(Fit::Crop, 150, 150)
            ->format('webp')
            ->quality(90)
            ->sharpen(10)
            ->withResponsiveImages()
            ->performOnCollections('icon')
            ->optimize();

        // Icône miniature 64x64
        $this->addMediaConversion('icon_thumb')
            ->width(64)
            ->height(64)
            ->fit(Fit::Crop, 64, 64)
            ->format('webp')
            ->quality(80)
            ->performOnCollections('icon');
    }
}
