<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'full_name',
        'job_title',
        'bio',
        'email',
        'phone',
        'location',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'website_url',
        'is_github_url',
        'is_linkedin_url',
        'is_twitter_url',
        'is_website_url',
        'stackoverflow_url',
        'is_stackoverflow_url',
        'methodology',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_github_url' => 'boolean',
            'is_linkedin_url' => 'boolean',
            'is_twitter_url' => 'boolean',
            'is_website_url' => 'boolean',
            'is_stackoverflow_url' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cv')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isGithubUrl(): bool
    {
        return $this->is_github_url;
    }

    public function isTwitterUrl(): bool
    {
        return $this->is_twitter_url;
    }

    public function isLinkedinUrl(): bool
    {
        return $this->is_linkedin_url;
    }

    public function isWebSiteUrl(): bool
    {
        return $this->is_website_url;
    }

    public function isStackoverflowUrl(): bool
    {
        return $this->is_stackoverflow_url;
    }
}
