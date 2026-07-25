<x-layouts::app :title="__('Dashboard')">
    <div class="flex flex-col gap-12 px-4 py-8 lg:px-8 max-w-7xl mx-auto w-full">

        {{-- Bannière de Bienvenue --}}
        <div
            class="relative overflow-hidden rounded-4xl border border-black/5 bg-zinc-50/50 p-8 backdrop-blur-xl dark:border-white/5 dark:bg-white/5 md:p-14">
            {{-- Effets de lueur en arrière-plan --}}
            <div
                class="absolute -top-32 -right-32 h-96 w-96 rounded-full bg-emerald-500/10 blur-3xl transition-opacity duration-700 dark:bg-emerald-500/20">
            </div>
            <div
                class="absolute bottom-[-20%] left-[-10%] h-64 w-64 rounded-full bg-blue-500/10 blur-3xl transition-opacity duration-700 dark:bg-blue-500/20">
            </div>

            <div class="relative z-10 flex flex-col items-start justify-between gap-10 md:flex-row md:items-center">
                <div class="space-y-5">
                    <h1
                        class="flex items-center gap-3 text-4xl font-light tracking-tight text-zinc-900 dark:text-white md:text-5xl lg:text-6xl">
                        <span>Bonjour, <span class="font-medium">{{ auth()->user()->name }}</span></span>
                        <flux:icon.hand-raised class="size-10 text-yellow-500/80 dark:text-yellow-500/70 lg:size-12" />
                    </h1>
                    <p class="max-w-2xl text-lg font-light leading-relaxed text-zinc-500 dark:text-zinc-400">
                        Bienvenue dans votre espace personnel. Découvrez mon univers, explorez mes réalisations
                        récentes, ou contactez-moi pour discuter de votre prochain projet.
                    </p>
                </div>

                <div class="flex w-full shrink-0 flex-col gap-4 sm:flex-row md:w-auto">
                    <a href="{{ route('projects.index') }}" wire:navigate
                        class="group inline-flex items-center justify-center gap-3 rounded-full border border-black/5 bg-white/80 px-8 py-4 font-medium text-zinc-900 backdrop-blur-md transition-all duration-300 ease-out hover:bg-white dark:border-white/5 dark:bg-white/10 dark:text-white dark:hover:bg-white/20">
                        Voir les projets
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="size-4 transition-transform duration-300 group-hover:translate-x-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Section Accès Rapide (pleine largeur, 6 raccourcis) --}}
        <div class="flex flex-col gap-6">
            <h2 class="flex items-center gap-3 text-lg font-medium tracking-tight text-zinc-900 dark:text-white">
                <span
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-black/5 bg-zinc-50 dark:border-white/5 dark:bg-white/5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4 text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" />
                    </svg>
                </span>
                Accès Rapide
            </h2>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Profil / À propos --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-black/5 bg-zinc-50/50 p-6 backdrop-blur-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-zinc-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">
                    <div class="flex items-center gap-5">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-black/5 bg-white text-zinc-900 transition-colors duration-300 group-hover:border-emerald-500/30 group-hover:text-emerald-500 dark:border-white/5 dark:bg-white/5 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-medium text-zinc-900 transition-colors dark:text-white">Gauthier
                                Lobanga</h3>
                            <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">Mon profil & parcours</p>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" wire:navigate class="absolute inset-0 z-10"><span class="sr-only">À
                            propos</span></a>
                </div>

                {{-- Contact --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-black/5 bg-zinc-50/50 p-6 backdrop-blur-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-zinc-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">
                    <div class="flex items-center gap-5">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-black/5 bg-white text-zinc-900 transition-colors duration-300 group-hover:border-blue-500/30 group-hover:text-blue-500 dark:border-white/5 dark:bg-white/5 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-medium text-zinc-900 transition-colors dark:text-white">Me
                                Contacter</h3>
                            <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">Discutons de votre idée</p>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" wire:navigate class="absolute inset-0 z-10"><span
                            class="sr-only">Contact</span></a>
                </div>

                {{-- Projets --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-black/5 bg-zinc-50/50 p-6 backdrop-blur-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-zinc-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">
                    <div class="flex items-center gap-5">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-black/5 bg-white text-zinc-900 transition-colors duration-300 group-hover:border-violet-500/30 group-hover:text-violet-500 dark:border-white/5 dark:bg-white/5 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-medium text-zinc-900 transition-colors dark:text-white">Mes
                                Projets</h3>
                            <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">Voir mes réalisations</p>
                        </div>
                    </div>
                    <a href="{{ route('projects.index') }}" wire:navigate class="absolute inset-0 z-10"><span
                            class="sr-only">Projets</span></a>
                </div>

                {{-- Blog / Articles --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-black/5 bg-zinc-50/50 p-6 backdrop-blur-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-zinc-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">
                    <div class="flex items-center gap-5">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-black/5 bg-white text-zinc-900 transition-colors duration-300 group-hover:border-amber-500/30 group-hover:text-amber-500 dark:border-white/5 dark:bg-white/5 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-medium text-zinc-900 transition-colors dark:text-white">Blog &
                                Articles</h3>
                            <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">Lire mes publications</p>
                        </div>
                    </div>
                    <a href="{{ route('posts.index') }}" wire:navigate class="absolute inset-0 z-10"><span
                            class="sr-only">Blog</span></a>
                </div>

                {{-- Formations --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-black/5 bg-zinc-50/50 p-6 backdrop-blur-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-zinc-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">
                    <div class="flex items-center gap-5">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-black/5 bg-white text-zinc-900 transition-colors duration-300 group-hover:border-cyan-500/30 group-hover:text-cyan-500 dark:border-white/5 dark:bg-white/5 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-medium text-zinc-900 transition-colors dark:text-white">
                                Formations</h3>
                            <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">Accéder aux cours</p>
                        </div>
                    </div>
                    <a href="{{ route('formations.index') }}" wire:navigate class="absolute inset-0 z-10"><span
                            class="sr-only">Formations</span></a>
                </div>

                {{-- Services --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-black/5 bg-zinc-50/50 p-6 backdrop-blur-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-zinc-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">
                    <div class="flex items-center gap-5">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-black/5 bg-white text-zinc-900 transition-colors duration-300 group-hover:border-purple-500/30 group-hover:text-purple-500 dark:border-white/5 dark:bg-white/5 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-medium text-zinc-900 transition-colors dark:text-white">Services
                            </h3>
                            <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">Découvrir mes offres</p>
                        </div>
                    </div>
                    <a href="{{ route('services.index') }}" wire:navigate class="absolute inset-0 z-10"><span
                            class="sr-only">Services</span></a>
                </div>
            </div>
        </div>

        <hr class="border-black/5 dark:border-white/5">

        {{-- Section Nouveautés & Récents (3 colonnes, 6 projets) --}}
        <div class="flex flex-col gap-6">
            <div class="flex items-center justify-between">
                <h2 class="flex items-center gap-3 text-lg font-medium tracking-tight text-zinc-900 dark:text-white">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-black/5 bg-zinc-50 dark:border-white/5 dark:bg-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </span>
                    Nouveautés & Récents
                </h2>
                <a href="{{ route('projects.index') }}" wire:navigate
                    class="text-sm font-medium text-zinc-500 transition-colors hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">
                    Tout voir &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @forelse ($recentProjects as $project)
                    <a href="{{ route('projects.show', $project) }}" wire:navigate
                        class="group relative flex flex-col overflow-hidden rounded border border-black/5 bg-zinc-50/50 backdrop-blur-sm transition-all duration-500 ease-out hover:-translate-y-2 hover:bg-zinc-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">
                        <div class="aspect-video w-full overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                            @if ($project->cover_url)
                                <img src="{{ $project->cover_url }}" alt="{{ $project->title }}"
                                    class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                    loading="lazy">
                            @else
                                <div
                                    class="flex h-full w-full items-center justify-center text-zinc-400 dark:text-zinc-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1" stroke="currentColor" class="size-12">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col justify-between p-5">
                            <div>
                                <h3
                                    class="mb-1 line-clamp-1 text-base font-medium text-zinc-900 transition-colors group-hover:text-emerald-500 dark:text-white">
                                    {{ $project->title }}
                                </h3>
                                <p
                                    class="line-clamp-2 text-sm font-light leading-relaxed text-zinc-500 dark:text-zinc-400">
                                    {{ $project->getPlainTextContent(100) ?: 'Pas de description' }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div
                        class="col-span-full rounded-4xl border border-dashed border-black/10 bg-zinc-50/50 p-12 text-center dark:border-white/10 dark:bg-white/5">
                        <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">Aucun projet récent pour le
                            moment.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <hr class="border-black/5 dark:border-white/5">

        {{-- Section Mes Formations (widget Livewire) --}}
        <div
            class="flex flex-col gap-6 rounded border border-black/5 bg-zinc-50/50 p-6 backdrop-blur-xl dark:border-white/5 dark:bg-white/5 md:p-8">
            <livewire:dashboard.formations-widget />
        </div>

        <hr class="border-black/5 dark:border-white/5">

        {{-- Section Analytiques d'Apprentissage --}}
        <div
            class="flex flex-col gap-6 rounded border border-black/5 bg-zinc-50/50 p-6 backdrop-blur-xl dark:border-white/5 dark:bg-white/5 md:p-8">
            <livewire:dashboard.learner-analytics-widget />
        </div>

        <hr class="border-black/5 dark:border-white/5">

        {{-- Section Services --}}
        <div class="flex flex-col gap-8">

            <div class="flex items-center justify-between">
                <h2 class="flex items-center gap-3 text-lg font-medium tracking-tight text-zinc-900 dark:text-white">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-black/5 bg-zinc-50 dark:border-white/5 dark:bg-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 text-purple-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                    </span>
                    Services Proposés
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @forelse($services as $service)
                    <a href="{{ route('services.show', $service) }}" wire:navigate
                        class="group flex flex-col items-center gap-5 rounded-4xl border border-black/5 bg-zinc-50/50 p-8 text-center backdrop-blur-sm transition-all duration-500 ease-out hover:-translate-y-2 hover:bg-zinc-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">

                        {{-- Image du service (miniature de préférence, sinon grande) --}}
                        @if ($service->image_thumb_url || $service->image_url)
                            <img src="{{ $service->image_thumb_url ?? $service->image_url }}"
                                alt="{{ $service->title }}"
                                class="h-16 w-16 rounded-2xl object-cover transition-transform duration-300 group-hover:scale-110">
                        @else
                            {{-- Fallback : icône SVG --}}
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-zinc-500 transition-all duration-300 group-hover:scale-110 group-hover:text-purple-500 dark:bg-white/5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                </svg>
                            </div>
                        @endif

                        <h3 class="text-base font-medium text-zinc-900 dark:text-white">{{ $service->title }}</h3>
                    </a>
                @empty
                    <div
                        class="col-span-full rounded-4xl border border-dashed border-black/10 bg-zinc-50/50 p-12 text-center dark:border-white/10 dark:bg-white/5">
                        <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">Aucun service pour le moment.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="flex justify-center pt-2">
                <a href="{{ route('services.index') }}" wire:navigate
                    class="group inline-flex items-center gap-2 rounded-full border border-black/5 bg-zinc-50/50 px-6 py-3 text-sm font-medium text-zinc-900 backdrop-blur-sm transition-all duration-300 ease-out hover:bg-zinc-100 dark:border-white/5 dark:bg-white/5 dark:text-white dark:hover:bg-white/10">
                    Explorer tous mes services
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="size-4 transition-transform duration-300 group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>

        <hr class="border-black/5 dark:border-white/5">

        {{-- Section Compétences --}}
        <div class="flex flex-col gap-8">
            <div class="flex items-center justify-between">
                <h2 class="flex items-center gap-3 text-lg font-medium tracking-tight text-zinc-900 dark:text-white">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-black/5 bg-zinc-50 dark:border-white/5 dark:bg-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 text-orange-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                        </svg>
                    </span>
                    <span class="inline sm:hidden md:inline">Mes Compétences</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @forelse($skills as $skill)
                    <div
                        class="group flex items-center gap-4 justify-center sm:justify-start rounded-3xl border border-black/5 bg-zinc-50/50 p-4 backdrop-blur-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-zinc-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">
                        @if ($skill->icon)
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white transition-transform duration-300 group-hover:scale-110 dark:bg-white/5">
                                @php
                                    $icon = $skill->icon;
                                    $isFa =
                                        Str::contains($icon, 'fa-') ||
                                        Str::contains($icon, 'fi-') ||
                                        Str::contains($icon, 'bx-');
                                    $isSvg = Str::startsWith($icon, '<svg');
                                @endphp
                                @if ($isFa) <i class="{{ $icon }} text-2xl text-zinc-700 dark:text-zinc-300"></i>
                                @elseif ($isSvg)
                                    {!! $icon !!}
                                @else
                                    <img src="{{ $icon }}" alt="{{ $skill->name }}" class="max-h-6 max-w-6 object-contain"> @endif
                            </div>
                        @else
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white text-zinc-500 transition-transform duration-300 group-hover:scale-110 dark:bg-white/5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                                </svg>
                            </div>
                        @endif
                        <span
                            class="inline sm:hidden md:inline truncate text-sm font-medium text-zinc-900 dark:text-white">{{ $skill->name }}</span>
                    </div>
                @empty
                    <div
                        class="col-span-full rounded-4xl border border-dashed border-black/10 bg-zinc-50/50 p-8 text-center dark:border-white/10 dark:bg-white/5">
                        <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">Aucune compétence pour le
                            moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="flex justify-center pt-2">
                <a href="{{ route('skill') }}" wire:navigate
                    class="group inline-flex items-center gap-2 rounded-full border border-black/5 bg-zinc-50/50 px-6 py-3 text-sm font-medium text-zinc-900 backdrop-blur-sm transition-all duration-300 ease-out hover:bg-zinc-100 dark:border-white/5 dark:bg-white/5 dark:text-white dark:hover:bg-white/10">
                    Parcourir mes compétences
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="size-4 transition-transform duration-300 group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-layouts::app>
