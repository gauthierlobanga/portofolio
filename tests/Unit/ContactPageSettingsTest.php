<?php

use App\Settings\AboutSettings;
use App\Settings\CookieSettings;
use App\Settings\LegalSettings;
use App\Settings\PrivacySettings;
use App\Settings\SettingApp;
use App\Settings\TermsSettings;
use Tests\TestCase;

uses(TestCase::class);

it('defines contact page settings properties on the app settings class', function () {
    $appSettings = new SettingApp;

    expect(property_exists($appSettings, 'contact_hero_badge'))->toBeTrue()
        ->and(property_exists($appSettings, 'contact_hero_title'))->toBeTrue()
        ->and(property_exists($appSettings, 'contact_hero_subtitle'))->toBeTrue()
        ->and(property_exists($appSettings, 'contact_form_heading'))->toBeTrue()
        ->and(property_exists($appSettings, 'contact_form_description'))->toBeTrue()
        ->and(property_exists($appSettings, 'contact_support_title'))->toBeTrue()
        ->and(property_exists($appSettings, 'contact_support_description'))->toBeTrue()
        ->and(property_exists($appSettings, 'contact_offices_title'))->toBeTrue();
});

it('defines home page section heading properties on the about settings class', function () {
    $aboutSettings = new AboutSettings;

    expect(property_exists($aboutSettings, 'service_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'service_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'formation_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'formation_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'skill_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'skill_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'partner_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'partner_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'team_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'team_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'project_hero_badge'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'project_hero_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'project_hero_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'project_content_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'project_content_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'project_banner_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'project_banner_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'blog_hero_badge'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'blog_hero_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'blog_hero_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'blog_content_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'blog_content_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'blog_banner_title'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'blog_banner_subtitle'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'author_home'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'auteur_about'))->toBeTrue()
        ->and(property_exists($aboutSettings, 'citation_footer'))->toBeTrue();
});

it('defines hero section properties on static page settings classes', function () {
    $cookieSettings = new CookieSettings;
    $legalSettings = new LegalSettings;
    $privacySettings = new PrivacySettings;
    $termsSettings = new TermsSettings;

    expect(property_exists($cookieSettings, 'hero_badge'))->toBeTrue()
        ->and(property_exists($cookieSettings, 'hero_title'))->toBeTrue()
        ->and(property_exists($cookieSettings, 'hero_subtitle'))->toBeTrue()
        ->and(property_exists($legalSettings, 'hero_badge'))->toBeTrue()
        ->and(property_exists($legalSettings, 'hero_title'))->toBeTrue()
        ->and(property_exists($legalSettings, 'hero_subtitle'))->toBeTrue()
        ->and(property_exists($privacySettings, 'hero_badge'))->toBeTrue()
        ->and(property_exists($privacySettings, 'hero_title'))->toBeTrue()
        ->and(property_exists($privacySettings, 'hero_subtitle'))->toBeTrue()
        ->and(property_exists($termsSettings, 'hero_badge'))->toBeTrue()
        ->and(property_exists($termsSettings, 'hero_title'))->toBeTrue()
        ->and(property_exists($termsSettings, 'hero_subtitle'))->toBeTrue();
});
