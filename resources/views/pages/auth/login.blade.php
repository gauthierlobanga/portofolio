<x-layouts::auth :title="__('Se connecter')">
    <div class="flex flex-col gap-6">
        {{-- En‑tête --}}
        <div class="text-center">
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                {{ __('Heureux de vous revoir') }}
            </h1>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                {{ __('Connectez‑vous pour accéder à votre espace') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        {{-- Passkey (si activé) --}}
        <x-passkey-verify />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email -->
            <flux:input
                name="email"
                :label="__('Adresse email')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="exemple@cadersa.org"
                class="rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white"
            />

            <!-- Mot de passe -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Mot de passe')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Votre mot de passe')"
                    viewable
                    class="rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white"
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 right-0 text-sm font-medium text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300" :href="route('password.request')" wire:navigate>
                        {{ __('Mot de passe oublié ?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Se souvenir de moi -->
            <flux:checkbox name="remember" :label="__('Se souvenir de moi')" :checked="old('remember')" />

            <!-- Bouton de connexion -->
            <flux:button type="submit" class="w-full rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3 transition shadow-sm shadow-emerald-200 dark:shadow-emerald-900/30">
                {{ __('Se connecter') }}
            </flux:button>
        </form>

        {{-- Lien vers l'inscription --}}
        <div class="text-center text-sm text-zinc-500 dark:text-zinc-400">
            <span>{{ __('Pas encore de compte ?') }}</span>
            <flux:link :href="route('register')" wire:navigate class="font-semibold text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300 ml-1">
                {{ __('Créer un compte') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth>
