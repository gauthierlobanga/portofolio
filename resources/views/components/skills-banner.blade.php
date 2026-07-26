@props(['about' => null, 'skills' => collect()])
<section wire:cloak
    class="relative flex flex-col overflow-hidden border-b border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-5 py-14 xs:px-8 sm:py-20 lg:px-15 lg:py-28"
    x-data="{ shown: false }" x-intersect.once="shown = true">

    {{-- Fond décoratif --}}
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden" aria-hidden="true">
        {{-- Texte géant en filigrane --}}
        <div class="absolute -top-10 -right-8 select-none text-[10rem] md:text-[15rem] lg:text-[18rem] font-black leading-none text-zinc-900/2.5 dark:text-white/2.5 font-serif tracking-widest"
            :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'"
            style="transition: all 1.2s cubic-bezier(0.16,1,0.3,1);">
            SKILLS
        </div>
        {{-- Halos de lumière --}}
        <div class="absolute -top-40 right-0 h-125 w-125 rounded-full bg-emerald-100/40 blur-3xl dark:bg-emerald-900/10">
        </div>
        <div class="absolute -bottom-20 -left-20 h-100 w-100 rounded-full bg-teal-100/30 blur-3xl dark:bg-teal-900/10">
        </div>
        {{-- Grille de fond --}}
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-size-[14px_24px] mask-[radial-gradient(ellipse_80%_60%_at_50%_0%,#000_70%,transparent_100%)]">
        </div>
    </div>

    <div class="relative z-10 mx-auto w-full max-w-7xl">
        <div class="flex w-full flex-col lg:flex-row lg:items-center lg:justify-between">
            {{-- Contenu principal (gauche) --}}
            <div class="w-full max-w-7xl">
                {{-- Badge animé --}}
                <div class="inline-flex items-center gap-2.5 rounded-full border border-zinc-200 bg-white/80 px-3.5 py-1 text-[11px] font-medium uppercase tracking-[0.15em] text-zinc-500 shadow-sm backdrop-blur-md transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] dark:border-zinc-800 dark:bg-zinc-900/80 dark:text-zinc-400"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    <span class="relative flex h-1.5 w-1.5">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span
                            class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                    </span>
                    {{ $about?->skill_badge ?: 'Expertise Technique' }}
                </div>

                {{-- Titre principal --}}
                <h1 class="mt-6 text-pretty text-4xl font-black tracking-tight text-zinc-950 dark:text-white sm:text-5xl md:text-6xl transition-all duration-500 delay-100 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
                    {!! $about?->skill_title ?:
                        'Mes <span class="bg-linear-to-r from-emerald-600 via-emerald-500 to-teal-500 bg-clip-text text-transparent dark:from-emerald-400 dark:via-emerald-300 dark:to-teal-400">compétences</span>' !!}
                </h1>

                {{-- Sous-titre --}}
                <p class="mt-5 max-w-xl text-lg leading-relaxed text-zinc-600 dark:text-zinc-400 transition-all duration-500 delay-200 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    {{ $about?->skill_subtitle ?: 'Découvrez les technologies et outils que je maîtrise au quotidien pour construire des solutions modernes, robustes et élégantes.' }}
                </p>

                {{-- Statistiques rapides --}}
                <div class="mt-10 flex flex-wrap items-center gap-8 transition-all duration-500 delay-300 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    @php
                        $totalSkills = \App\Models\Skill::count();
                        $totalCategories = \App\Models\SkillCategory::has('skills')->count();
                    @endphp
                    <div class="flex items-end gap-2">
                        <span
                            class="text-4xl font-black text-zinc-900 dark:text-white tabular-nums">{{ $totalSkills }}</span>
                        <span
                            class="mb-1 text-sm font-medium text-zinc-500 dark:text-zinc-400">compétences<br>maîtrisées</span>
                    </div>
                    <div class="h-10 w-px bg-zinc-200 dark:bg-zinc-700"></div>
                    <div class="flex items-end gap-2">
                        <span
                            class="text-4xl font-black text-zinc-900 dark:text-white tabular-nums">{{ $totalCategories }}</span>
                        <span
                            class="mb-1 text-sm font-medium text-zinc-500 dark:text-zinc-400">domaines<br>couverts</span>
                    </div>
                    <div class="h-10 w-px bg-zinc-200 dark:bg-zinc-700"></div>
                    <div class="flex items-end gap-2">
                        <span
                            class="text-4xl font-black text-emerald-500 dark:text-emerald-400 tabular-nums">+{{ now()->year - 2020 }}</span>
                        <span
                            class="mb-1 text-sm font-medium text-zinc-500 dark:text-zinc-400">années<br>d'expérience</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
