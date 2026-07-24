@props(['about' => null])
    <section wire:cloak
        class="relative flex flex-col overflow-hidden border-b border-zinc-200 px-5 py-12 xs:px-8 sm:py-16 lg:px-15 lg:py-24 dark:border-zinc-800 max-w-7xl mx-auto"
        x-data="{ shown: false }" x-intersect.once="shown = true">

        {{-- Ambiance lumineuse de fond --}}
        <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
            {{-- Big Background Text (Typographie géante) --}}
            <div class="absolute -top-12 -right-10 select-none text-[12rem] md:text-[16rem] lg:text-[20rem] font-black leading-none text-zinc-900/[0.03] dark:text-white/[0.02] font-serif"
                :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'"
                style="transition: all 1s cubic-bezier(0.16,1,0.3,1);">
                SKILLS
            </div>

            <div class="absolute -top-40 right-0 h-150 w-150 rounded-full bg-emerald-100/30 blur-3xl dark:bg-emerald-900/10 dark:to-transparent">
            </div>
            <div
                class="absolute -bottom-20 -left-20 h-125 w-125 rounded-full bg-linear-to-tr from-zinc-200/40 to-emerald-100/0 blur-3xl dark:from-zinc-900/50 dark:to-transparent">
            </div>
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]">
            </div>
        </div>

        <div class="relative z-10 flex w-full flex-col lg:flex-row lg:items-center lg:justify-between gap-12">
            {{-- Contenu principal (à gauche) --}}
            <div class="w-full max-w-2xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2.5 rounded-full border border-zinc-200 bg-white/80 px-3.5 py-1 text-[11px] font-medium uppercase tracking-[0.15em] text-zinc-500 shadow-[0_1px_2px_rgba(0,0,0,0.02)] backdrop-blur-md transition-all duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] dark:border-zinc-800 dark:bg-zinc-900/80 dark:text-zinc-400"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-3'">
                    <span class="relative flex h-1.5 w-1.5">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span
                            class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                    </span>
                    {{ $about->skill_badge ?: 'Expertise Technique' }}
                </div>

                {{-- Titre --}}
                <h1 class="mt-6 text-pretty text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-zinc-950 font-serif dark:text-white transition-all duration-500 delay-100 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    {!! $about->skill_title ?:
                        'Mes <span class="relative inline-block bg-linear-to-r from-emerald-600 via-emerald-500 to-teal-600 bg-clip-text text-transparent dark:from-emerald-400 dark:via-emerald-300 dark:to-teal-400">compétences</span>' !!}
                </h1>

                {{-- Sous‑titre --}}
                <p class="mt-6 max-w-xl text-lg leading-relaxed text-zinc-600 dark:text-zinc-400 font-sans transition-all duration-500 delay-200 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    {{ $about->skill_subtitle ?: 'Découvrez les technologies et outils que je maîtrise au quotidien pour construire des solutions modernes, robustes et élégantes.' }}
                </p>
            </div>

            {{-- Illustration / Icône moderne (à droite) --}}
            <div class="hidden lg:flex relative w-full max-w-sm justify-center items-center lg:justify-end"
                 :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                 style="transition: all 0.7s cubic-bezier(0.16,1,0.3,1); transition-delay: 300ms;">
                
                {{-- Glow derrière l'icône --}}
                <div class="absolute inset-0 right-0 bg-linear-to-br from-emerald-400/20 to-teal-400/20 blur-3xl rounded-full dark:from-emerald-400/10 dark:to-teal-400/10"></div>
                
                {{-- Conteneur flottant "Glassmorphism" --}}
                <div class="relative flex h-56 w-56 items-center justify-center rounded-3xl border border-white/60 bg-white/40 shadow-2xl shadow-emerald-900/5 backdrop-blur-xl transition-transform duration-700 hover:-translate-y-2 dark:border-white/10 dark:bg-white/5 dark:shadow-black/50">
                    
                    {{-- Badge flottant (Code) --}}
                    <div class="absolute -left-8 top-12 flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-xl shadow-zinc-200/50 dark:bg-zinc-800 dark:shadow-black/50 animate-[bounce_5s_infinite_ease-in-out]">
                        <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    </div>
                    
                    {{-- Badge flottant (Science/Data) --}}
                    <div class="absolute -right-6 bottom-10 flex h-16 w-16 items-center justify-center rounded-2xl bg-zinc-900 shadow-xl shadow-zinc-900/50 dark:bg-zinc-100 dark:shadow-white/10 animate-[bounce_6s_infinite_ease-in-out_reverse]">
                        <svg class="h-8 w-8 text-emerald-400 dark:text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>

                    {{-- Icône Centrale (Terminal / Dev) --}}
                    <svg class="h-24 w-24 text-emerald-500 dark:text-emerald-400 drop-shadow-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                        <line x1="8" y1="21" x2="16" y2="21"/>
                        <line x1="12" y1="17" x2="12" y2="21"/>
                        <polyline points="6 8 8 10 6 12"/>
                        <line x1="10" y1="12" x2="14" y2="12"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>
