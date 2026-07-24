@props(['stats' => [], 'about' => null])
    {{-- ========== HEADER ========== --}}
    <section class="relative overflow-hidden bg-zinc-50 pt-24 pb-20 sm:pt-32 sm:pb-28 lg:pt-36 lg:pb-32 dark:bg-zinc-950"
        x-data="{ shown: false }" x-intersect.once="shown = true">

        {{-- Ambiance lumineuse dynamique et Orbes --}}
        <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
            {{-- Orbes animés --}}
            <div
                class="absolute top-[-20%] right-[-10%] w-[70%] h-[70%] rounded-full bg-emerald-400/20 mix-blend-multiply blur-[120px] animate-blob dark:bg-emerald-600/20 dark:mix-blend-screen">
            </div>
            <div
                class="absolute top-[20%] left-[-10%] w-[60%] h-[60%] rounded-full bg-teal-300/20 mix-blend-multiply blur-[120px] animate-blob animation-delay-2000 dark:bg-teal-500/20 dark:mix-blend-screen">
            </div>
            <div
                class="absolute bottom-[-20%] left-[20%] w-[80%] h-[80%] rounded-full bg-cyan-300/20 mix-blend-multiply blur-[120px] animate-blob animation-delay-4000 dark:bg-cyan-600/20 dark:mix-blend-screen">
            </div>

            {{-- Effet de texture (grain léger) --}}
            <div class="absolute inset-0 opacity-[0.03] mix-blend-overlay"
                style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.8%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');">
            </div>

            {{-- Grille subtile --}}
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-size-[24px_24px] mask-[radial-gradient(ellipse_60%_60%_at_50%_0%,#000_70%,transparent_100%)]">
            </div>
        </div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-16 lg:grid-cols-12 lg:gap-24">

                {{-- BLOC TEXTE PRINCIPAL --}}
                <div class="flex flex-col items-start gap-8 lg:col-span-7">
                    <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-4 py-1.5 text-sm font-medium text-emerald-700 backdrop-blur-md dark:text-emerald-300 transition-all duration-500"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                        Nouvelles sessions disponibles
                    </div>

                    <h1 class="text-pretty text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-zinc-900 drop-shadow-sm dark:text-white dark:drop-shadow-lg transition-all duration-700 delay-100 ease-[cubic-bezier(0.16,1,0.3,1)]"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                        {!! $about->formation_banner_title ?:
                            'Élevez vos compétences avec nos <span class="relative inline-block animate-text-gradient bg-linear-to-r from-emerald-600 via-teal-500 to-emerald-600 bg-size-[200%_auto] bg-clip-text text-transparent dark:from-emerald-400 dark:via-teal-300 dark:to-emerald-400">formations</span>' !!}
                    </h1>

                    <p class="max-w-xl text-lg sm:text-xl leading-relaxed text-zinc-600 dark:text-zinc-400 font-medium transition-all duration-700 delay-200 ease-[cubic-bezier(0.16,1,0.3,1)]"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                        {{ $about->formation_banner_subtitle ?: 'Découvrez des programmes intensifs et pratiques, conçus par des experts pour accélérer votre carrière professionnelle.' }}
                    </p>
                </div>

                {{-- PANNEAU D'INFORMATION ET STATISTIQUES --}}
                <div class="w-full lg:col-span-5 transition-all duration-700 delay-300 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'">
                    <div
                        class="group relative overflow-hidden rounded-3xl border border-white/40 bg-white/40 p-8 shadow-2xl shadow-emerald-500/5 backdrop-blur-xl transition-all duration-500 hover:border-emerald-500/30 dark:border-zinc-700/50 dark:bg-zinc-900/50 dark:shadow-emerald-900/10">

                        {{-- Effet reflet glassmorphism --}}
                        <div
                            class="absolute inset-0 bg-linear-to-tr from-white/10 to-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 dark:from-white/5 dark:to-transparent">
                        </div>

                        <div class="relative z-10 flex flex-col gap-8">
                            <div class="grid grid-cols-2 gap-x-8 gap-y-10 sm:grid-cols-3 lg:grid-cols-2">
                                @foreach ($stats as $label => $value)
                                    <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                                        class="group/stat relative min-w-24 px-4 py-4 text-center transition-all duration-500 delay-{{ 300 + $loop->index * 100 }}"
                                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">

                                        {{-- Background au survol --}}
                                        <div class="absolute inset-0 rounded-2xl bg-emerald-500/0 transition-colors duration-300 ease-out group-hover/stat:bg-emerald-500/5 dark:group-hover/stat:bg-emerald-400/10"
                                            aria-hidden="true"></div>

                                        <div class="relative z-10 flex flex-col items-center gap-1">
                                            <span
                                                class="text-4xl sm:text-5xl font-black tracking-tight text-transparent bg-clip-text bg-linear-to-br from-zinc-900 to-zinc-600 dark:from-white dark:to-zinc-400 group-hover/stat:from-emerald-600 group-hover/stat:to-teal-500 dark:group-hover/stat:from-emerald-400 dark:group-hover/stat:to-teal-300 transition-all duration-300">
                                                {{ $value }}
                                            </span>
                                            <span
                                                class="text-xs font-bold uppercase tracking-wider text-zinc-500 group-hover/stat:text-emerald-700 transition-colors duration-300 dark:text-zinc-400 dark:group-hover/stat:text-emerald-400">
                                                {{ $label }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


