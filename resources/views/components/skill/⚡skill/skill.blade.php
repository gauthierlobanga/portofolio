<section class="relative isolate py-6 sm:py-10 bg-white dark:bg-zinc-950">
    {{-- Fond décoratif --}}
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div
            class="absolute left-1/2 top-0 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full bg-emerald-500/5 blur-3xl">
        </div>
        <div class="absolute right-0 bottom-0 h-64 w-64 translate-y-1/2 rounded-full bg-teal-500/5 blur-3xl"></div>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center mb-16 sm:mb-20">
            <span
                class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                Expertise
            </span>
            <h2 class="mt-6 text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-5xl">
                {{ $this->about->skill_title ?: 'Compétences' }}
            </h2>
            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                {{ $this->about->skill_subtitle ?: 'Technologies et outils que je maîtrise au quotidien.' }}
            </p>
        </div>

        {{-- Grille des catégories --}}
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($this->categories as $categoryId => $skills)
                @php
                    $category = $skills->first()->categorySkill;
                    $color = $category?->color ?? '#10b981';
                @endphp
                <div x-cloak x-data="cspState" x-intersect="shown = true"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    class="transition-all duration-700 ease-out" style="transition-delay: {{ $loop->index * 75 }}ms">
                    <div
                        class="group flex h-full flex-col rounded-2xl border border-zinc-200/70 bg-white p-6 shadow-sm transition-all duration-500 ease-out
                                hover:-translate-y-1 hover:border-emerald-300 hover:shadow-md hover:shadow-emerald-100/40
                                dark:border-zinc-700/60 dark:bg-zinc-900 dark:hover:border-emerald-700 dark:hover:shadow-emerald-900/20">
                        {{-- En‑tête de catégorie --}}
                        <div class="flex items-center gap-4 mb-6">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl text-white shadow-md"
                                style="background-color: {{ $color }}">
                                @if ($category && $category->icon)
                                    @svg('heroicon-o-' . $category->icon, 'h-6 w-6')
                                @else
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                                    {{ $category?->name ?? 'Non classé' }}
                                </h3>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                    {{ $skills->count() }} compétence(s)
                                </p>
                            </div>
                        </div>

                        {{-- Barres de compétences --}}
                        <div class="flex-1 space-y-5">
                            @foreach ($skills as $skill)
                                <div x-data="{ width: 0 }" x-init="$watch('shown', value => { if (value) setTimeout(() => width = {{ $skill->level }}, 100 + {{ $loop->index }} * 60) })" class="space-y-2">
                                    <div class="flex items-center gap-3 text-sm font-medium">
                                        {{-- Icône de la compétence (image ou fallback) --}}
                                        @if ($skill->icon)
                                            <img src="{{ $skill->icon }}" alt="{{ $skill->name }}"
                                                class="h-10 w-10  object-contain" />
                                        @else
                                            <span
                                                class="flex h-10 w-10 items-center justify-center  text-lg font-bold text-white"
                                                style="background-color: {{ $color }}">
                                                {{ strtoupper(substr($skill->name, 0, 2)) }}
                                            </span>
                                        @endif
                                        <span
                                            class="text-zinc-700 dark:text-zinc-300 flex-1">{{ $skill->name }}</span>
                                        <span class="text-xs text-zinc-500 dark:text-zinc-400 tabular-nums"
                                            x-text="width + '%'">0%</span>
                                    </div>
                                    <div class="h-2 w-full overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">
                                        <div class="h-full rounded-full transition-all duration-1000 ease-out"
                                            :style="'width: ' + width + '%; background: linear-gradient(90deg, ' +
                                                '{{ $color }}' + ', ' + '{{ $color }}' + 'cc)'">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5 h-1 w-12 rounded-full opacity-20"
                            style="background-color: {{ $color }}"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
