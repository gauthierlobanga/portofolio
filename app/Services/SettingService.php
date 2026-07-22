<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    /**
     * @var Setting
     *              The setting instance
     */
    protected $setting;

    /**
     * Constructeur du service de paramètres
     */
    public function __construct()
    {
        $this->setting = Setting::with('user')
            ->firstOrCreate([]);
    }

    /**
     * récupère le nom complet de l'utilisateur
     */
    public function getName()
    {
        return $this->setting->user->name;
    }

    /**
     * récupère l'email de l'utilisateur
     */
    public function getEmail()
    {
        return $this->setting->user->email;
    }

    /**
     * récupère le titre du job de l'utilisateur
     */
    public function getTitleJob()
    {
        return $this->setting->job_title;
    }

    /**
     * récupère la biographie de l'utilisateur
     */
    public function getBio()
    {
        return $this->setting->bio;
    }

    /**
     * récupère l'url du site web de l'utilisateur
     */
    public function getWebsite_url(): bool
    {
        return $this->setting->isWebSiteUrl();
    }

    /**
     * récupère l'url de l'image de l'utilisateur
     */
    public function getHeroImageUrl()
    {
        return $this->setting->user->getFirstMediaUrl('avatars') ?: null;
    }

    /**
     * récupère toutes les informations des settings
     */
    public function getAllSettings()
    {
        return $this->setting;
    }

    /**
     * récupère les booléens pour afficher ou non le lien github
     */
    public function getGithub_url(): bool
    {
        return $this->setting->isGithubUrl();
    }

    /**
     * récupère les booléens pour afficher ou non le lien twitter
     */
    public function getTwitter_url(): bool
    {
        return $this->setting->isTwitterUrl();
    }

    /**
     * récupère les booléens pour afficher ou non le lien linkedin
     */
    public function getLinkedin_url(): bool
    {
        return $this->setting->isLinkedinUrl();
    }
}
