<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Formation extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\FormationFactory> */
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'excerpt',
        'content',
        'location',
        'status',
        'is_active',
        'start_date',
        'end_date',
        'published_at',
        'meta',
        'sort_order',
        'formation_category_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'published_at' => 'datetime',
        'meta' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\Proxies\Fluent|\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(\Spatie\Image\Manipulations::FIT_CROP, 400, 225)
            ->quality(80)
            ->nonQueued();

        $this->addMediaConversion('card')
            ->fit(\Spatie\Image\Manipulations::FIT_CROP, 1200, 675)
            ->quality(80)
            ->nonQueued();
    }

    public function formationCategory()
    {
        return $this->belongsTo(FormationCategory::class, 'formation_category_id');
    }
}
