@props(['stats' => [], 'about' => null])
    <section x-cloak class="relative overflow-hidden bg-[#fafaf9] py-18 sm:py-24 lg:py-28 dark:bg-zinc-950"
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

        <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 items-start gap-16 lg:grid-cols-12 lg:gap-24">

                {{-- BLOC TEXTE PRINCIPAL --}}
                <div class="flex flex-col items-start gap-6 lg:col-span-7">
                    <div class="inline-flex items-center gap-2.5 rounded border border-zinc-200 bg-white/80 px-3.5 py-1 text-[11px] font-medium uppercase tracking-[0.15em] text-zinc-500 shadow-[0_1px_2px_rgba(0,0,0,0.02)] backdrop-blur-md transition-all duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] dark:border-zinc-800 dark:bg-zinc-900/80 dark:text-zinc-400"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-3'">
                        <div class="flex items-center gap-1.5">
                            @svg('heroicon-o-book-open', 'h-5 w-6 text-emerald-600 dark:text-emerald-400')
                            {!! $about->blog_hero_badge !!}
                        </div>
                    </div>

                    <h1 class="text-pretty text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight text-zinc-950 font-serif dark:text-zinc-50 transition-all duration-500 delay-100 ease-[cubic-bezier(0.16,1,0.3,1)]"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                        {!! $about->blog_banner_title ?:
                            'Le pouls de <span class="relative inline-block bg-linear-to-r from-emerald-600 via-emerald-500 to-teal-600 bg-clip-text text-transparent dark:from-emerald-400 dark:via-emerald-300 dark:to-teal-400">CADERSA asbl</span>' !!}
                    </h1>

                    <p class="max-w-xl text-lg leading-relaxed text-zinc-600/90 dark:text-zinc-400 font-sans transition-all duration-500 delay-200 ease-[cubic-bezier(0.16,1,0.3,1)]"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                        {!! $about->blog_banner_subtitle ?:
                            'Plongez au cœur de nos actions : <span class="font-medium text-zinc-950 dark:text-zinc-100">formations, résultats terrain et innovations</span> qui façonnent un impact durable sur l\'agriculture locale.' !!}
                    </p>
                </div>

                {{-- PANNEAU D'INFORMATION ET STATISTIQUES --}}
                <div class="w-full lg:col-span-5 lg:pt-4 transition-all duration-500 delay-300 ease-[cubic-bezier(0.16,1,0.3,1)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
                    <div
                        class="group relative overflow-hidden bg-white/40 p-8 transition-all duration-500 dark:border-zinc-800 dark:bg-zinc-900/40">
                        <div class="relative z-10 flex flex-col gap-8">
                            <div class="grid grid-cols-2 gap-x-8 gap-y-10 sm:grid-cols-3 lg:grid-cols-2">
                                @foreach ($stats as $label => $value)
                                    <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                                        class="group relative px-4 py-3 text-center transition-all duration-300 delay-{{ 300 + $loop->index * 100 }}"
                                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                                        <div class="absolute inset-0 rounded-xl bg-emerald-50/80 transition duration-300 ease-out group-hover:bg-emerald-100 dark:bg-white/5 dark:group-hover:bg-emerald-500/10"
                                            aria-hidden="true"></div>
                                        <div class="relative z-10 flex flex-col items-center">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-widest text-zinc-500 group-hover:text-emerald-700 transition-colors duration-300 dark:text-zinc-400 dark:group-hover:text-emerald-300">{{ $label }}</span>
                                            <span
                                                class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $value }}</span>
                                        </div>
                                        <svg class="absolute top-0 left-0 h-2.5 text-emerald-400 transition-transform duration-300 ease-out"
                                            :class="{ '-translate-x-1 -translate-y-1': hover }" viewBox="0 0 11 11"
                                            fill="none">
                                            <path d="M9.5 0.5H0.5V9.5" stroke="currentColor" stroke-linecap="round" />
                                        </svg>
                                        <svg class="absolute bottom-0 left-0 h-2.5 -scale-y-100 text-emerald-400 transition-transform duration-300 ease-out"
                                            :class="{ '-translate-x-1 translate-y-1': hover }" viewBox="0 0 11 11"
                                            fill="none">
                                            <path d="M9.5 0.5H0.5V9.5" stroke="currentColor" stroke-linecap="round" />
                                        </svg>
                                        <svg class="absolute top-0 right-0 h-2.5 -scale-x-100 text-emerald-400 transition-transform duration-300 ease-out"
                                            :class="{ 'translate-x-1 -translate-y-1': hover }" viewBox="0 0 11 11"
                                            fill="none">
                                            <path d="M9.5 0.5H0.5V9.5" stroke="currentColor" stroke-linecap="round" />
                                        </svg>
                                        <svg class="absolute bottom-0 right-0 h-2.5 -scale-x-100 -scale-y-100 text-emerald-400 transition-transform duration-300 ease-out"
                                            :class="{ 'translate-x-1 translate-y-1': hover }" viewBox="0 0 11 11"
                                            fill="none">
                                            <path d="M9.5 0.5H0.5V9.5" stroke="currentColor" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div
                            class="absolute top-3 left-3 size-1.5 border-t border-l border-zinc-300 opacity-40 dark:border-zinc-700">
                        </div>
                        <div
                            class="absolute top-3 right-3 size-1.5 border-t border-r border-zinc-300 opacity-40 dark:border-zinc-700">
                        </div>
                        <div
                            class="absolute bottom-3 left-3 size-1.5 border-b border-l border-zinc-300 opacity-40 dark:border-zinc-700">
                        </div>
                        <div
                            class="absolute bottom-3 right-3 size-1.5 border-b border-r border-zinc-300 opacity-40 dark:border-zinc-700">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


