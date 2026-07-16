@assets
@vite('resources/js/passkeys.js')
@endassets

<div x-data="passkeyRegistration()">
    {{-- Message si les passkeys ne sont pas supportées --}}
    <template x-if="!supported">
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-700 dark:border-amber-800 dark:bg-amber-950/30 dark:text-amber-400">
            <div class="flex items-start gap-3">
                <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                <p>{{ __('Les clés d’accès ne sont pas prises en charge par ce navigateur.') }}</p>
            </div>
        </div>
    </template>

    {{-- Bouton "Ajouter une clé" --}}
    <template x-if="supported && !showForm">
        <button
            type="button"
            x-on:click="showForm = true"
            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border-2 border-dashed border-zinc-300 bg-zinc-50 px-4 py-4 text-sm font-medium text-zinc-600 transition-all duration-200 hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700 dark:border-zinc-700 dark:bg-zinc-900/50 dark:text-zinc-400 dark:hover:border-emerald-700 dark:hover:bg-emerald-950/20 dark:hover:text-emerald-400"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            {{ __('Ajouter une clé d’accès') }}
        </button>
    </template>

    {{-- Formulaire d’enregistrement --}}
    <template x-if="supported && showForm">
        <div class="space-y-4 rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            {{-- En-tête --}}
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-zinc-900 dark:text-white">{{ __('Nouvelle clé d’accès') }}</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('Donnez un nom à votre clé pour l’identifier.') }}</p>
                </div>
            </div>

            {{-- Champ de saisie du nom --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="passkey-name">
                    {{ __('Nom de la clé') }}
                </label>
                <input
                    id="passkey-name"
                    type="text"
                    x-model="name"
                    x-on:keydown.enter.prevent="register()"
                    x-ref="passkeyNameInput"
                    x-init="focusInput()"
                    placeholder="{{ __('ex: MacBook Pro, iPhone, Bureau...') }}"
                    class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm text-zinc-900 placeholder:text-zinc-400 transition-all duration-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-emerald-400 dark:focus:ring-emerald-400/20"
                >
            </div>

            {{-- Message d’erreur --}}
            <p x-show="error" x-text="error" x-cloak class="text-sm text-red-600 dark:text-red-400"></p>

            {{-- Boutons d’action --}}
            <div class="flex gap-2.5 pt-1">
                <button
                    type="button"
                    x-on:click="register()"
                    x-bind:disabled="loading || !name.trim()"
                    class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-emerald-200 transition-all duration-200 hover:bg-emerald-500 hover:shadow-md disabled:cursor-not-allowed disabled:opacity-50 dark:shadow-emerald-900/30 dark:hover:bg-emerald-400"
                >
                    <svg x-show="!loading" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="loading" class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-show="!loading">{{ __('Enregistrer') }}</span>
                    <span x-show="loading" x-cloak>{{ __('Enregistrement...') }}</span>
                </button>
                <button
                    type="button"
                    x-on:click="cancel()"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-600 transition-all duration-200 hover:bg-zinc-50 hover:text-zinc-800 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:hover:text-zinc-200"
                >
                    {{ __('Annuler') }}
                </button>
            </div>
        </div>
    </template>
</div>
