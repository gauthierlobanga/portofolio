@props(['about' => null])
<section wire:cloak
    class="relative flex flex-col overflow-hidden border-b border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-5 py-14 xs:px-8 sm:py-20 lg:px-15 lg:py-28"
    x-data="{ shown: false }" x-intersect.once="shown = true">

    {{-- Fond décoratif --}}
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden" aria-hidden="true">
        {{-- Texte géant en filigrane --}}
        <div class="absolute -top-10 -right-8 select-none text-[10rem] md:text-[15rem] lg:text-[18rem] font-black leading-none text-zinc-900/[0.025] dark:text-white/[0.025] font-serif tracking-widest"
            :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'"
            style="transition: all 1.2s cubic-bezier(0.16,1,0.3,1);">
            SKILLS
        </div>
        {{-- Halos de lumière --}}
        <div class="absolute -top-40 right-0 h-[500px] w-[500px] rounded-full bg-emerald-100/40 blur-3xl dark:bg-emerald-900/10"></div>
        <div class="absolute -bottom-20 -left-20 h-[400px] w-[400px] rounded-full bg-teal-100/30 blur-3xl dark:bg-teal-900/10"></div>
        {{-- Grille de fond --}}
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px] [mask-image:radial-gradient(ellipse_80%_60%_at_50%_0%,#000_70%,transparent_100%)]"></div>
    </div>

    <div class="relative z-10 mx-auto w-full max-w-7xl">
        <div class="flex w-full flex-col lg:flex-row lg:items-center lg:justify-between gap-12">

            {{-- Contenu principal (gauche) --}}
            <div class="w-full max-w-2xl">
                {{-- Badge animé --}}
                <div class="inline-flex items-center gap-2.5 rounded-full border border-zinc-200 bg-white/80 px-3.5 py-1 text-[11px] font-medium uppercase tracking-[0.15em] text-zinc-500 shadow-sm backdrop-blur-md transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] dark:border-zinc-800 dark:bg-zinc-900/80 dark:text-zinc-400"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                    </span>
                    {{ $about->skill_badge ?: 'Expertise Technique' }}
                </div>

                {{-- Titre principal --}}
                <h1 class="mt-6 text-pretty text-4xl font-black tracking-tight text-zinc-950 dark:text-white sm:text-5xl md:text-6xl transition-all duration-500 delay-100 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
                    {!! $about->skill_title ?:
                        'Mes <span class="bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-500 bg-clip-text text-transparent dark:from-emerald-400 dark:via-emerald-300 dark:to-teal-400">compétences</span>' !!}
                </h1>

                {{-- Sous-titre --}}
                <p class="mt-5 max-w-xl text-lg leading-relaxed text-zinc-600 dark:text-zinc-400 transition-all duration-500 delay-200 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    {{ $about->skill_subtitle ?: 'Découvrez les technologies et outils que je maîtrise au quotidien pour construire des solutions modernes, robustes et élégantes.' }}
                </p>

                {{-- Statistiques rapides --}}
                <div class="mt-10 flex flex-wrap items-center gap-8 transition-all duration-500 delay-300 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    @php
                        $totalSkills = \App\Models\Skill::count();
                        $totalCategories = \App\Models\SkillCategory::has('skills')->count();
                    @endphp
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-zinc-900 dark:text-white tabular-nums">{{ $totalSkills }}</span>
                        <span class="mb-1 text-sm font-medium text-zinc-500 dark:text-zinc-400">compétences<br>maîtrisées</span>
                    </div>
                    <div class="h-10 w-px bg-zinc-200 dark:bg-zinc-700"></div>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-zinc-900 dark:text-white tabular-nums">{{ $totalCategories }}</span>
                        <span class="mb-1 text-sm font-medium text-zinc-500 dark:text-zinc-400">domaines<br>couverts</span>
                    </div>
                    <div class="h-10 w-px bg-zinc-200 dark:bg-zinc-700"></div>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-emerald-500 dark:text-emerald-400 tabular-nums">+{{ now()->year - 2020 }}</span>
                        <span class="mb-1 text-sm font-medium text-zinc-500 dark:text-zinc-400">années<br>d'expérience</span>
                    </div>
                </div>
            </div>

            {{-- Illustration (droite, desktop uniquement) --}}
            <div class="hidden lg:flex relative w-full max-w-sm flex-col justify-center items-end gap-4"
                 :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                 style="transition: all 0.8s cubic-bezier(0.16,1,0.3,1); transition-delay: 350ms;">

                {{-- Glow de fond --}}
                <div class="absolute right-0 top-0 h-64 w-64 rounded-full bg-emerald-400/15 blur-3xl dark:bg-emerald-400/8"></div>

                {{-- Carte principale glassmorphism --}}
                <div class="relative w-full rounded-3xl border border-zinc-200/80 bg-white/60 p-8 shadow-2xl shadow-zinc-900/5 backdrop-blur-xl dark:border-zinc-700/60 dark:bg-zinc-900/60 dark:shadow-black/40 transition-transform duration-700 hover:-translate-y-1">
                    {{-- Icône centrale --}}
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-500 shadow-lg shadow-emerald-500/25 mb-6">
                        <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <polyline points="6 8 8 10 6 12"/>
                            <line x1="10" y1="12" x2="14" y2="12"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-zinc-900 dark:text-white">Stack Technique</p>
                    <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Laravel · Livewire · Filament · Vue · React</p>

                    {{-- Barres de catégories --}}
                    <div class="mt-6 space-y-3">
                        @foreach(\App\Models\SkillCategory::withCount('skills')->has('skills')->take(4)->get() as $cat)
                        <div>
                            <div class="mb-1 flex items-center justify-between">
                                <span class="text-xs font-medium text-zinc-600 dark:text-zinc-400">{{ $cat->name }}</span>
                                <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200">{{ $cat->skills_count }}</span>
                            </div>
                            <div class="h-1.5 w-full overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">
                                <div class="h-full rounded-full bg-emerald-500/80 transition-all duration-700 delay-500"
                                    :style="shown ? 'width: {{ min(100, $cat->skills_count * 15) }}%' : 'width: 0%'"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Badge flottant --}}
                <div class="absolute -right-4 -top-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-900 shadow-xl shadow-zinc-900/30 dark:bg-zinc-100 dark:shadow-white/10 animate-[bounce_6s_infinite_ease-in-out]">
                    <svg class="h-7 w-7 text-emerald-400 dark:text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>
