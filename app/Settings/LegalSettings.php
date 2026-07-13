<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LegalSettings extends Settings
{
    public array $content = [];

    public static function group(): string
    {
        return 'legal';
    }
}
