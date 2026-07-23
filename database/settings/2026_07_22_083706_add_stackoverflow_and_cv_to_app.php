<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('app.stackoverflow_url', null);
        $this->migrator->add('app.cv_url', null);
    }
};
