{{-- resources/views/livewire/skills-section.blade.php --}}
<section class="relative isolate py-24 sm:py-32 bg-white dark:bg-zinc-950 overflow-hidden">
    {{-- Formes décoratives d’arrière‑plan --}}
    <div class="absolute inset-0 -z-10">
        <div class="absolute left-0 top-0 h-96 w-96 rounded-full bg-emerald-500/5 blur-3xl"></div>
        <div class="absolute right-0 bottom-0 h-80 w-80 rounded-full bg-teal-500/5 blur-3xl"></div>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- En‑tête --}}
        <div class="mx-auto max-w-2xl text-center mb-16 sm:mb-20">
            <h2 class="text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                Compétences
            </h2>
            <p class="mt-4 text-lg leading-7 text-zinc-500 dark:text-zinc-400">
                Un aperçu des technologies et outils que je maîtrise au quotidien
            </p>
        </div>

        {{-- Grille des catégories --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 lg:gap-10">
            @foreach ($this->categories as $categoryId => $skills)
                @php
                    $category = $skills->first()->categorySkill;
                    $color = $category?->color ?? '#10b981';
                @endphp
                <div x-data="{ shown: false, animated: false }"
                    x-intersect.threshold.20="shown = true; if (!animated) { animated = true; $nextTick(() => { animateBars(); }); }"
                    class="group relative flex flex-col rounded-2xl border border-zinc-200/60 bg-white/80 backdrop-blur-sm p-6 shadow-sm transition-all duration-500 ease-out hover:shadow-lg hover:border-emerald-200 dark:border-zinc-800/60 dark:bg-zinc-900/80 dark:hover:border-emerald-900/50"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">

                    {{-- En‑tête de catégorie --}}
                    <div class="flex items-center gap-4 mb-8">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl text-white shadow-md"
                            style="background-color: {{ $color }}">
                            @if ($category && $category->icon)
                                @svg('heroicon-o-' . $category->icon, 'h-6 w-6')
                            @else
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            @endif
                        </span>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                            {{ $category?->name ?? 'Non classé' }}
                        </h3>
                        <span class="ml-auto text-xs font-medium text-zinc-400 dark:text-zinc-500">
                            {{ $skills->count() }} comp.
                        </span>
                    </div>

                    {{-- Liste des compétences --}}
                    <ul class="space-y-6 flex-1">
                        @foreach ($skills as $skill)
                            <li x-data="{ width: 0 }" x-init="$watch('shown', value => { if (value) setTimeout(() => width = {{ $skill->level }}, 100 + {{ $loop->index }} * 50) })" class="space-y-2">
                                <div class="flex items-center justify-between text-sm font-medium">
                                    <span class="text-zinc-700 dark:text-zinc-300">{{ $skill->name }}</span>
                                    <span class="text-xs text-zinc-400 dark:text-zinc-500 tabular-nums"
                                        x-text="width + '%'">0%</span>
                                </div>
                                <div class="h-2 w-full overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <div class="h-full rounded-full transition-all duration-1000 ease-out"
                                        style="background: linear-gradient(90deg, {{ $color }}, {{ $color }}cc); width: 0%"
                                        :style="'width: ' + width + '%'">
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Légère décoration en bas --}}
                    <div class="mt-6 h-1 w-12 rounded-full opacity-20" style="background-color: {{ $color }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
