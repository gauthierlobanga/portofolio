<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PrivacySettings extends Settings
{
    public array $content = [];

    public static function group(): string
    {
        return 'privacy';
    }
}
