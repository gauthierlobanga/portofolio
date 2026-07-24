@props(['stats' => [], 'about' => null])
    <section wire:cloak
        class="relative flex flex-col items-start gap-x-10 gap-y-8 overflow-hidden border-b border-zinc-200 px-5 py-10 xs:px-8 sm:py-16 lg:px-15 lg:py-20 dark:border-zinc-800 max-w-7xl mx-auto"
        x-data="{ shown: false }" x-intersect.once="shown = true">

        {{-- Ambiance lumineuse de fond --}}
        <div class="pointer-events-none absolute inset-0 z-0">
            <div
                class="absolute -top-40 right-0 h-150 w-150 rounded-full bg-linear-to-br from-emerald-200/20 to-teal-100/0 blur-3xl dark:from-emerald-500/5 dark:to-transparent">
            </div>
            <div
                class="absolute -bottom-20 -left-20 h-125 w-125 rounded-full bg-linear-to-tr from-zinc-200/40 to-emerald-100/0 blur-3xl dark:from-zinc-900/50 dark:to-transparent">
            </div>
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-size-[14px_24px] mask-[radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]">
            </div>
        </div>

        {{-- Contenu principal (à gauche) --}}
        <div class="relative z-10 w-full max-w-3xl">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2.5 rounded-full border border-zinc-200 bg-white/80 px-3.5 py-1 text-[11px] font-medium uppercase tracking-[0.15em] text-zinc-500 shadow-[0_1px_2px_rgba(0,0,0,0.02)] backdrop-blur-md transition-all duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] dark:border-zinc-800 dark:bg-zinc-900/80 dark:text-zinc-400"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-3'">
                <span class="relative flex h-1.5 w-1.5">
                    <span
                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                    <span
                        class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                </span>
                Projets
            </div>

            {{-- Titre --}}
            <h1 class="mt-6 text-pretty text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight text-zinc-950 font-serif dark:text-zinc-50 transition-all duration-500 delay-100 ease-[cubic-bezier(0.16,1,0.3,1)]"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                {!! $about->project_banner_title ?:
                    'Nos <span class="relative inline-block bg-linear-to-r from-emerald-600 via-emerald-500 to-teal-600 bg-clip-text text-transparent dark:from-emerald-400 dark:via-emerald-300 dark:to-teal-400">projets</span>' !!}
            </h1>

            {{-- Sous‑titre --}}
            <p class="mt-4 max-w-xl text-lg leading-relaxed text-zinc-600/90 dark:text-zinc-400 font-sans transition-all duration-500 delay-200 ease-[cubic-bezier(0.16,1,0.3,1)]"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                {{ $about->project_banner_subtitle ?: 'Découvrez l\'impact de nos actions sur le terrain au profit des communautés agricoles.' }}
            </p>

            {{-- Statistiques --}}
            <div class="mt-8 flex flex-wrap gap-5 transition-all duration-500 delay-300 ease-[cubic-bezier(0.16,1,0.3,1)]"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
                @foreach ($stats as $label => $value)
                    <div x-data="hoverStatsCard()" class="group relative px-4 py-3 text-center">
                        <div x-ref="background"
                            class="absolute inset-0 rounded-lg bg-zinc-100 transition duration-300 ease-out group-hover:bg-emerald-100/50 dark:bg-zinc-800 dark:group-hover:bg-emerald-900/20"
                            aria-hidden="true"></div>
                        <div class="relative z-10 flex flex-col items-center gap-0.5">
                            <span
                                class="text-xs font-semibold uppercase tracking-widest text-zinc-500 mix-blend-luminosity dark:text-zinc-400">{{ $label }}</span>
                            <span class="text-xl font-bold text-zinc-900 dark:text-white">{{ $value }}</span>
                        </div>
                        <div x-ref="topLeftCorner" class="absolute top-0 left-0" aria-hidden="true">
                            <svg class="h-2.5 text-emerald-500" viewBox="0 0 11 11" fill="none">
                                <path d="M9.5 0.5H0.5V9.5" stroke="currentColor" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div x-ref="bottomLeftCorner" class="absolute bottom-0 left-0" aria-hidden="true">
                            <svg class="h-2.5 -scale-y-100 text-emerald-500" viewBox="0 0 11 11" fill="none">
                                <path d="M9.5 0.5H0.5V9.5" stroke="currentColor" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div x-ref="topRightCorner" class="absolute top-0 right-0" aria-hidden="true">
                            <svg class="h-2.5 -scale-x-100 text-emerald-500" viewBox="0 0 11 11" fill="none">
                                <path d="M9.5 0.5H0.5V9.5" stroke="currentColor" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div x-ref="bottomRightCorner" class="absolute right-0 bottom-0" aria-hidden="true">
                            <svg class="h-2.5 -scale-x-100 -scale-y-100 text-emerald-500" viewBox="0 0 11 11"
                                fill="none">
                                <path d="M9.5 0.5H0.5V9.5" stroke="currentColor" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
