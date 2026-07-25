<?php

namespace App\Providers;

use App\Settings\SettingApp;
use Carbon\CarbonImmutable;
use Filament\Notifications\Livewire\Notifications;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passkeys\Passkeys;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

        Model::shouldBeStrict();

        // Register a custom passkey model that uses UUIDs so inserts match the
        // project's passkeys migration (which defines a uuid primary key).
        Passkeys::usePasskeyModel(\App\Models\Passkey::class);

        Notifications::alignment(Alignment::Center);
        Notifications::verticalAlignment(VerticalAlignment::Start);

        /**
         * Partage des données globales avec toutes les vues
         */
        View::composer('*', function ($view) {
            $settings = app(SettingApp::class);
            $view->with('settings', $settings);
        });
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        if (app()->isProduction()) {
            Vite::useHotFile(storage_path('framework/vite.hot'));
        }

        Password::defaults(fn () => Password::min(12)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()
            ->uncompromised()
        );
    }
}
