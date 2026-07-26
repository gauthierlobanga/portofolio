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
        <div class="mx-auto max-w-4xl text-center">
            {{-- Badge animé --}}
            <div class="mb-8 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50/80 px-4 py-1.5 text-sm font-medium text-emerald-700 backdrop-blur-sm transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] dark:border-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                Formations professionnelles
            </div>

            {{-- Titre principal --}}
            <h1 class="text-pretty text-4xl font-extrabold tracking-tight text-zinc-900 drop-shadow-sm sm:text-5xl md:text-6xl lg:text-7xl dark:text-white dark:drop-shadow-lg transition-all duration-700 delay-100 ease-[cubic-bezier(0.16,1,0.3,1)]"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                {!! $about?->formation_banner_title ?:
                    'Élevez vos compétences avec nos <span class="relative inline-block animate-text-gradient bg-linear-to-r from-emerald-600 via-teal-500 to-emerald-600 bg-size-[200%_auto] bg-clip-text text-transparent dark:from-emerald-400 dark:via-teal-300 dark:to-emerald-400">formations</span>' !!}
            </h1>

            {{-- Sous-titre --}}
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-zinc-600 sm:text-xl dark:text-zinc-400 font-medium transition-all duration-700 delay-200 ease-[cubic-bezier(0.16,1,0.3,1)]"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                {{ $about?->formation_banner_subtitle ?: 'Découvrez des programmes intensifs et pratiques, conçus par des experts pour accélérer votre carrière professionnelle.' }}
            </p>

            <a href="#formations-list" x-data="scrollToBottomButton" @click.prevent="scrollToBottom()"
                class="group inline-flex h-12 mt-3 items-center gap-5 rounded-full border border-zinc-200/60 bg-white/70 px-5 pr-2 text-sm font-medium text-zinc-800 shadow shadow-zinc-900/5 backdrop-blur-md transition-all duration-300 ease-out hover:scale-105 hover:border-emerald-500/40 hover:bg-white/90 hover:shadow-emerald-500/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/50 dark:border-zinc-700/60 dark:bg-zinc-900/70 dark:text-zinc-200 dark:shadow-black/20 dark:hover:border-emerald-500/50 dark:hover:bg-zinc-800/90 dark:hover:shadow-emerald-500/20 sm:pl-5 sm:pr-2"
                aria-label="Aller en bas de la page">
                <span class="hidden sm:block overflow-hidden whitespace-nowrap" data-text>
                    Aller en bas
                </span>
                <span
                    class="relative isolate grid h-10 w-10 place-items-center overflow-hidden rounded-full bg-linear-to-br from-emerald-500 to-teal-600 text-white shadow shadow-emerald-500/25 transition-shadow duration-300 group-hover:shadow-emerald-500/50 dark:from-emerald-600 dark:to-teal-700 dark:shadow-emerald-500/20 dark:group-hover:shadow-emerald-500/40">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>
