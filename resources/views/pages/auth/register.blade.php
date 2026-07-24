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
            </div>

            <!-- Mot de passe -->
            <div x-data="{
                password: '',
                get hasLength() { return this.password.length >= 12; },
                get hasUppercase() { return /[A-Z]/.test(this.password); },
                get hasNumber() { return /[0-9]/.test(this.password); },
                get hasSymbol() { return /[^A-Za-z0-9]/.test(this.password); },
                get isFullyValid() { return this.hasLength && this.hasUppercase && this.hasNumber && this.hasSymbol; }
            }">
                <flux:input
                    name="password"
                    x-model="password"
                    :label="__('Mot de passe')"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    viewable
                    class="rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white"
                />
                
                {{-- Checklist interactive --}}
                <div x-show="!isFullyValid" x-transition class="mt-3 grid grid-cols-2 gap-2 text-xs">
                    <div class="flex items-center gap-1.5 transition-colors duration-300" :class="hasLength ? 'text-emerald-600 dark:text-emerald-400 font-medium' : 'text-zinc-500 dark:text-zinc-400'">
                        <svg x-show="hasLength" class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <svg x-show="!hasLength" class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"></circle></svg>
                        12 caractères min.
                    </div>
                    <div class="flex items-center gap-1.5 transition-colors duration-300" :class="hasUppercase ? 'text-emerald-600 dark:text-emerald-400 font-medium' : 'text-zinc-500 dark:text-zinc-400'">
                        <svg x-show="hasUppercase" class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <svg x-show="!hasUppercase" class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"></circle></svg>
                        Une majuscule
                    </div>
                    <div class="flex items-center gap-1.5 transition-colors duration-300" :class="hasNumber ? 'text-emerald-600 dark:text-emerald-400 font-medium' : 'text-zinc-500 dark:text-zinc-400'">
                        <svg x-show="hasNumber" class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <svg x-show="!hasNumber" class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"></circle></svg>
                        Un chiffre
                    </div>
                    <div class="flex items-center gap-1.5 transition-colors duration-300" :class="hasSymbol ? 'text-emerald-600 dark:text-emerald-400 font-medium' : 'text-zinc-500 dark:text-zinc-400'">
                        <svg x-show="hasSymbol" class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <svg x-show="!hasSymbol" class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"></circle></svg>
                        Un symbole
                    </div>
                </div>
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
