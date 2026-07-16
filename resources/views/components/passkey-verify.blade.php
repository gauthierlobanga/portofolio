@props([
    'optionsRoute' => 'passkey.login-options',
    'submitRoute' => 'passkey.login',
    'label' => __('Se connecter avec une clé d’accès'),
    'loadingLabel' => __('Authentification en cours...'),
    'separator' => __('Ou continuer avec votre email'),
])

@assets
@vite('resources/js/passkeys.js')
@endassets

<div x-data="passkeyVerify()" data-options-route="{{ route($optionsRoute) }}" data-submit-route="{{ route($submitRoute) }}">
    <template x-if="supported">
        <div>
            {{-- Bouton principal --}}
            <button
                type="button"
                class="relative w-full inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-white px-4 py-3 text-sm font-semibold text-emerald-700 shadow-sm transition-all duration-200 hover:border-emerald-300 hover:bg-emerald-50 hover:shadow-md dark:border-emerald-800 dark:bg-zinc-900 dark:text-emerald-400 dark:hover:border-emerald-700 dark:hover:bg-emerald-950/30"
                x-on:click="verify()"
                x-bind:disabled="loading"
            >
                {{-- Icône empreinte digitale --}}
                <svg x-show="!loading" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                </svg>
                <svg x-show="loading" class="h-5 w-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span x-show="!loading">{{ $label }}</span>
                <span x-show="loading" x-cloak>{{ $loadingLabel }}</span>
            </button>

            {{-- Message d’erreur --}}
            <p x-show="error" x-text="error" x-cloak
               class="mt-3 text-sm text-center text-red-600 dark:text-red-400"></p>

            {{-- Séparateur --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-zinc-200 dark:border-zinc-700"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase tracking-wider">
                    <span class="px-3 text-zinc-500 dark:text-zinc-400 bg-white dark:bg-zinc-900">
                        {{ $separator }}
                    </span>
                </div>
            </div>
        </div>
    </template>
</div>
