<x-layouts::app :title="__('Dashboard')">
  <flux:sidebar sticky collapsible="mobile"
        class="lg:hidden h-dvh max-h-dvh overflow-y-auto border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <a href="{{ route('home') }}" wire:navigate
                class="group inline-flex items-center gap-3 rounded-lg py-1.5 transition duration-300 ease-out
                  hover:-translate-x-1 focus:outline-none">
                <x-app-logo />
            </a>
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.item :href="route('home')" :current="request()->routeIs('home')" wire:navigate
                :accent="false"
                class="!text-zinc-600 !border !border-emerald-200 hover:!bg-emerald-50 hover:!text-emerald-600 dark:!text-zinc-400 dark:!border-emerald-800 dark:hover:!bg-emerald-900/20 dark:hover:!text-emerald-400 !transition !duration-200 !rounded-lg">
                {{ __('Accueil') }}
            </flux:sidebar.item>
            <flux:sidebar.item :href="route('services.index')" :current="request()->routeIs('services.*')"
                wire:navigate :accent="false"
                class="!text-zinc-600 !border !border-emerald-200 hover:!bg-emerald-50 hover:!text-emerald-600 dark:!text-zinc-400 dark:!border-emerald-800 dark:hover:!bg-emerald-900/20 dark:hover:!text-emerald-400 !transition !duration-200 !rounded-lg">
                {{ __('Services') }}
            </flux:sidebar.item>
            <flux:sidebar.item :href="route('projects.index')" :current="request()->routeIs('projects.*')"
                wire:navigate :accent="false"
                class="!text-zinc-600 !border !border-emerald-200 hover:!bg-emerald-50 hover:!text-emerald-600 dark:!text-zinc-400 dark:!border-emerald-800 dark:hover:!bg-emerald-900/20 dark:hover:!text-emerald-400 !transition !duration-200 !rounded-lg">
                {{ __('Projets') }}
            </flux:sidebar.item>
            <flux:sidebar.item :href="route('posts.index')" :current="request()->routeIs('posts.index')" wire:navigate
                :accent="false"
                class="!text-zinc-600 !border !border-emerald-200 hover:!bg-emerald-50 hover:!text-emerald-600 dark:!text-zinc-400 dark:!border-emerald-800 dark:hover:!bg-emerald-900/20 dark:hover:!text-emerald-400 !transition !duration-200 !rounded-lg">
                {{ __('Blog') }}
            </flux:sidebar.item>
            <flux:sidebar.item :href="route('about')" :current="request()->routeIs('about')" wire:navigate
                :accent="false"
                class="!text-zinc-600 !border !border-emerald-200 hover:!bg-emerald-50 hover:!text-emerald-600 dark:!text-zinc-400 dark:!border-emerald-800 dark:hover:!bg-emerald-900/20 dark:hover:!text-emerald-400 !transition !duration-200 !rounded-lg">
                {{ __('À propos') }}
            </flux:sidebar.item>
            <flux:sidebar.item :href="route('contact')" :current="request()->routeIs('contact')" wire:navigate
                :accent="false"
                class="!text-zinc-600 !border !border-emerald-200 hover:!bg-emerald-50 hover:!text-emerald-600 dark:!text-zinc-400 dark:!border-emerald-800 dark:hover:!bg-emerald-900/20 dark:hover:!text-emerald-400 !transition !duration-200 !rounded-lg">
                {{ __('Contact') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />

        <flux:sidebar.nav>
            <flux:sidebar.group class="grid">
                @auth
                    <x-desktop-user-menu />
                @else
                    <div class="flex flex-col gap-3">
                        {{-- Sélecteur de thème --}}
                        <flux:radio.group x-data variant="segmented" :accent="false" x-model="$flux.appearance"
                            class="!border !border-emerald-200 !rounded !bg-transparent !shadow-none
               dark:!border-emerald-800 dark:!bg-transparent
               [&>ui-radio]:!text-zinc-500 [&>ui-radio]:hover:!bg-emerald-50 [&>ui-radio]:hover:!text-emerald-600
               dark:[&>ui-radio]:!text-zinc-400 dark:[&>ui-radio]:hover:!bg-emerald-900/20 dark:[&>ui-radio]:hover:!text-emerald-400
               [&>ui-radio]:data-checked:!bg-transparent [&>ui-radio]:data-checked:!text-emerald-600 dark:[&>ui-radio]:data-checked:!text-emerald-400
               [&>ui-radio]:data-checked:!border-emerald-600 dark:[&>ui-radio]:data-checked:!border-emerald-400
               !gap-0 !p-0">
                            <flux:radio value="light" icon="sun" class="!border-0 !shadow-none" />
                            <flux:radio value="dark" icon="moon" class="!border-0 !shadow-none" />
                            <flux:radio value="system" icon="computer-desktop" class="!border-0 !shadow-none" />
                        </flux:radio.group>

                        {{-- Lien Connexion --}}
                        <flux:sidebar.item href="{{ route('login') }}" icon="arrow-right-start-on-rectangle"
                            class="!text-emerald-600 !border !border-emerald-200 hover:!bg-emerald-50 dark:!text-emerald-400 dark:!border-emerald-800 dark:hover:!bg-emerald-900/20 !transition !duration-200 !rounded">
                            {{ __('Connexion') }}
                        </flux:sidebar.item>
                    </div>
                @endauth
            </flux:sidebar.group>
        </flux:sidebar.nav>
    </flux:sidebar>
</x-layouts::app>
