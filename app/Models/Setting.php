<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

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
        ];
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
}
