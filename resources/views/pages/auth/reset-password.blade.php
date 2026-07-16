<x-layouts::auth :title="__('Réinitialiser le mot de passe')">
    <div class="flex flex-col gap-6">
        {{-- En‑tête --}}
        <div class="text-center">
            <div
                class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                {{ __('Nouveau mot de passe') }}
            </h1>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                {{ __('Choisissez un mot de passe sécurisé pour votre compte.') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-5">
            @csrf
            <!-- Token -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <!-- Email (lecture seule) -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    {{ __('Adresse email') }}
                </label>
                <input type="email" name="email" value="{{ request('email') }}" readonly
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm text-zinc-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 cursor-not-allowed">
            </div>

            <!-- Nouveau mot de passe -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="new-password">
                    {{ __('Nouveau mot de passe') }}
                </label>
                <input id="new-password" name="password" type="password" required autocomplete="new-password"
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm text-zinc-900 placeholder:text-zinc-400 transition-all duration-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-emerald-400 dark:focus:ring-emerald-400/20">
            </div>

            <!-- Confirmation du mot de passe -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="password-confirm">
                    {{ __('Confirmer le mot de passe') }}
                </label>
                <input id="password-confirm" name="password_confirmation" type="password" required
                    autocomplete="new-password" placeholder="••••••••"
                    class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm text-zinc-900 placeholder:text-zinc-400 transition-all duration-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-emerald-400 dark:focus:ring-emerald-400/20">
            </div>

            <!-- Bouton -->
            <button type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-sm shadow-emerald-200 transition-all duration-200 hover:bg-emerald-500 hover:shadow-md dark:shadow-emerald-900/30 dark:hover:bg-emerald-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                {{ __('Réinitialiser le mot de passe') }}
            </button>
        </form>
    </div>
</x-layouts::auth>
