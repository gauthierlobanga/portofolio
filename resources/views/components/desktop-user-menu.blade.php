{{-- resources/views/components/desktop-user-menu.blade.php --}}
<flux:dropdown position="bottom" align="start">
    {{-- Déclencheur --}}
    <button type="button"
        class="group flex items-center gap-2 rounded-xl px-2 py-1.5 transition-colors duration-200 hover:bg-zinc-100 dark:hover:bg-zinc-800">
        {{-- Avatar --}}
        <flux:avatar
            src="{{ auth()->user()?->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=10b981&color=fff' }}"
            :name="auth()->user()->name" :initials="auth()->user()->initials()" size="sm" circle
            class="ring-1 ring-zinc-200 dark:ring-zinc-700 transition-all duration-200 group-hover:ring-emerald-300/50" />

        {{-- Nom --}}
        <span class="hidden sm:inline text-sm font-medium text-zinc-600 dark:text-zinc-300 truncate max-w-32">
            {{ auth()->user()->name }}
        </span>
    </button>

    {{-- Menu déroulant --}}
    <flux:menu
        class="mt-2 w-auto min-w-55 max-w-70 overflow-hidden rounded-2xl border border-zinc-200/70 bg-white shadow-xl shadow-zinc-500/10 backdrop-blur-xl dark:border-zinc-700/70 dark:bg-zinc-900/95 dark:shadow-zinc-950/50">
        {{-- En‑tête utilisateur --}}
        <div class="flex items-center gap-3 px-5 py-4 bg-zinc-50/80 dark:bg-zinc-800/50">
            <flux:avatar
                src="{{ auth()->user()?->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=10b981&color=fff' }}"
                :name="auth()->user()->name" :initials="auth()->user()->initials()" size="lg" circle
                class="ring-2 ring-white dark:ring-zinc-800" />
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-semibold text-zinc-900 dark:text-white">{{ auth()->user()->name }}</p>
                <p class="truncate text-xs text-zinc-500 dark:text-zinc-400">{{ auth()->user()->email }}</p>
                @if (auth()->user()?->hasRole('super_admin'))
                    <span
                        class="mt-1 inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                        Admin
                    </span>
                @endif
            </div>
        </div>

        <flux:menu.separator class="border-zinc-100 dark:border-zinc-800" />

        {{-- Actions --}}
        <div class="py-1">
            @if (auth()->user()?->hasRole('super_admin'))
                <flux:menu.item :href="route('filament.admin.pages.dashboard')" icon="shield-check"
                    class="group flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-zinc-700 transition-all duration-200 hover:bg-emerald-50 hover:text-emerald-700 dark:text-zinc-300 dark:hover:bg-emerald-900/20 dark:hover:text-emerald-400">
                    <span class="flex-1">Administration</span>
                    <flux:icon.arrow-right
                        class="size-4 text-emerald-400 opacity-0 transition-opacity group-hover:opacity-100" />
                </flux:menu.item>
            @endif

            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate
                class="group flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-zinc-700 transition-all duration-200 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white">
                <span class="flex-1">Paramètres</span>
                <flux:icon.arrow-right
                    class="size-4 text-zinc-400 opacity-0 transition-opacity group-hover:opacity-100" />
            </flux:menu.item>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                    class="group flex w-full items-center gap-3 px-4 py-2.5 text-sm font-medium text-zinc-700 transition-all duration-200 hover:bg-red-50 hover:text-red-600 dark:text-zinc-300 dark:hover:bg-red-900/20 dark:hover:text-red-400">
                    <span class="flex-1 text-left">Déconnexion</span>
                    <flux:icon.arrow-right
                        class="size-4 text-red-400 opacity-0 transition-opacity group-hover:opacity-100" />
                </flux:menu.item>
            </form>
        </div>

        {{-- Pied de menu discret --}}
        <div class="border-t border-zinc-100 px-4 py-2 dark:border-zinc-800">
            <p class="text-center text-[10px] text-zinc-400 dark:text-zinc-600">
                {{ config('app.name') }} · v{{ config('app.version', '1.0') }}
            </p>
        </div>
    </flux:menu>
</flux:dropdown>
