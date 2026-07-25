<div class="mx-auto flex max-w-6xl flex-col gap-8 md:flex-row md:items-start md:gap-12">
    {{-- Sidebar Navigation --}}
    <div class="w-full shrink-0 md:w-64">
        <div class="sticky top-8 overflow-hidden rounded-3xl border border-zinc-200/70 bg-zinc-50/80 p-4 backdrop-blur-sm dark:border-zinc-800/70 dark:bg-zinc-950/80">
            <flux:navlist aria-label="{{ __('Settings') }}" class="gap-2">
                <flux:navlist.item :href="route('profile.edit')" wire:navigate icon="user" class="rounded-2xl border border-transparent bg-white/90 px-4 py-3 text-left text-sm font-medium text-zinc-900 transition-colors hover:border-zinc-200 hover:bg-zinc-100 dark:bg-zinc-950/90 dark:text-white dark:hover:border-zinc-700 dark:hover:bg-zinc-900">
                    {{ __('Profile') }}
                </flux:navlist.item>

                <flux:navlist.item :href="route('security.edit')" wire:navigate icon="shield-check" class="rounded-2xl border border-transparent bg-white/90 px-4 py-3 text-left text-sm font-medium text-zinc-900 transition-colors hover:border-zinc-200 hover:bg-zinc-100 dark:bg-zinc-950/90 dark:text-white dark:hover:border-zinc-700 dark:hover:bg-zinc-900">
                    {{ __('Security') }}
                </flux:navlist.item>

                <flux:navlist.item :href="route('appearance.edit')" wire:navigate icon="paint-brush" class="rounded-2xl border border-transparent bg-white/90 px-4 py-3 text-left text-sm font-medium text-zinc-900 transition-colors hover:border-zinc-200 hover:bg-zinc-100 dark:bg-zinc-950/90 dark:text-white dark:hover:border-zinc-700 dark:hover:bg-zinc-900">
                    {{ __('Appearance') }}
                </flux:navlist.item>

                <flux:separator class="my-3 border-zinc-200/70 dark:border-zinc-700/70" />

                <flux:navlist.item :href="route('formations.suivi')" wire:navigate icon="academic-cap" class="rounded-2xl border border-transparent bg-white/90 px-4 py-3 text-left text-sm font-medium text-zinc-900 transition-colors hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 dark:bg-zinc-950/90 dark:text-white dark:hover:border-emerald-700 dark:hover:bg-emerald-950/70 dark:hover:text-emerald-300">
                    Mes Formations
                </flux:navlist.item>
            </flux:navlist>
        </div>
    </div>

    <flux:separator class="md:hidden" />

    {{-- Main Content Area --}}
    <div class="min-w-0 flex-1 self-stretch">
        <div class="overflow-hidden rounded-3xl border border-zinc-200/70 bg-white/95 dark:border-zinc-800/70 dark:bg-zinc-950/95">
            {{-- Header --}}
            <div class="border-b border-zinc-200/70 bg-zinc-50/70 px-6 py-8 dark:border-zinc-800/70 dark:bg-zinc-950/70 sm:px-8">
                <h2 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                    {{ $heading ?? '' }}
                </h2>
                @if(isset($subheading) && $subheading)
                    <p class="mt-3 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                        {{ $subheading }}
                    </p>
                @endif
            </div>

            {{-- Form/Content Area --}}
            <div class="px-6 py-8 sm:px-8">
                <div class="w-full max-w-2xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
