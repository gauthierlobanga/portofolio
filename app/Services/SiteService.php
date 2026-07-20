<?php

namespace App\Services;

use App\Models\User;

class SiteService
{
    protected $users;

    public function __construct()
    {
        $this->users = User::query()->first() ?? new User;
    }

    public function getName()
    {
        return $this->users->name;
    }

    public function getEmail()
    {
        return $this->users->email;
    }

    public function getHeroImageUrl()
    {
        return $this->users->getFirstMediaUrl('avatars') ?: null;
    }

    public function getAllUsers()
    {
        return $this->users;
    }
}
