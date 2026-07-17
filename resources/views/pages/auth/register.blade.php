<x-layouts::auth :title="__('Créer un compte')">
    <div class="flex flex-col gap-6">
        {{-- En‑tête --}}
        <div class="text-center">
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                {{ __('Rejoignez la communauté') }}
            </h1>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                {{ __('Créez votre compte en quelques secondes') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Nom complet -->
            <div>
                <flux:input
                    name="name"
                    :label="__('Nom complet')"
                    :value="old('name')"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Jean Dupont"
                    class="rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white"
                />
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Adresse email -->
            <div>
                <flux:input
                    name="email"
                    :label="__('Adresse email')"
                    :value="old('email')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="exemple@cadersa.org"
                    class="rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white"
                />
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <flux:input
                    name="password"
                    :label="__('Mot de passe')"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    viewable
                    class="rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white"
                />
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation du mot de passe -->
            <div>
                <flux:input
                    name="password_confirmation"
                    :label="__('Confirmer le mot de passe')"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    viewable
                    class="rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white"
                />
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton d'inscription -->
            <flux:button type="submit" class="w-full rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3 transition shadow-sm shadow-emerald-200 dark:shadow-emerald-900/30">
                {{ __('Créer mon compte') }}
            </flux:button>
        </form>

        {{-- Lien vers la connexion --}}
        <div class="text-center text-sm text-zinc-500 dark:text-zinc-400">
            <span>{{ __('Vous avez déjà un compte ?') }}</span>
            <flux:link :href="route('login')" wire:navigate class="font-semibold text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300 ml-1">
                {{ __('Se connecter') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth>
