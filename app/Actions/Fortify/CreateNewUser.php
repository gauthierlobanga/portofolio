<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Mail\NewUserRegistered;
use App\Mail\WelcomeUser;
use App\Models\User;
use App\Settings\SettingApp;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        try {
            $settings = app(SettingApp::class);
            if ($settings->email) {
                Mail::to($settings->email)->send(new NewUserRegistered($user));
            }

            // Envoi de l'email de bienvenue à l'utilisateur
            Mail::to($user->email)->send(new WelcomeUser($user));
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi des emails d\'inscription : '.$e->getMessage());
        }

        return $user;
    }
}
