<div class="mx-auto flex max-w-6xl flex-col gap-8 md:flex-row md:items-start md:gap-12">
    {{-- Sidebar Navigation --}}
    <div class="w-full shrink-0 md:w-64">
        <div class="sticky top-8 overflow-hidden rounded-2xl border border-zinc-200/80 bg-white/50 p-3 shadow-sm backdrop-blur-xl dark:border-zinc-800 dark:bg-zinc-900/50">
            <flux:navlist aria-label="{{ __('Settings') }}" class="gap-1">
                <flux:navlist.item :href="route('profile.edit')" wire:navigate icon="user" class="rounded-xl transition-colors hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    {{ __('Profile') }}
                </flux:navlist.item>
                
                <flux:navlist.item :href="route('security.edit')" wire:navigate icon="shield-check" class="rounded-xl transition-colors hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    {{ __('Security') }}
                </flux:navlist.item>
                
                <flux:navlist.item :href="route('appearance.edit')" wire:navigate icon="paint-brush" class="rounded-xl transition-colors hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    {{ __('Appearance') }}
                </flux:navlist.item>
                
                <flux:separator class="my-2" />
                
                <flux:navlist.item :href="route('formations.suivi')" wire:navigate icon="academic-cap" class="rounded-xl transition-colors hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-emerald-900/30 dark:hover:text-emerald-400">
                    Mes Formations
                </flux:navlist.item>
            </flux:navlist>
        </div>
    </div>

    <flux:separator class="md:hidden" />

    {{-- Main Content Area --}}
    <div class="min-w-0 flex-1 self-stretch">
        <div class="overflow-hidden rounded-3xl border border-zinc-200/80 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            {{-- Header --}}
            <div class="border-b border-zinc-100 bg-zinc-50/50 px-6 py-8 dark:border-zinc-800/50 dark:bg-zinc-900/50 sm:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                    {{ $heading ?? '' }}
                </h2>
                @if(isset($subheading) && $subheading)
                    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
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
