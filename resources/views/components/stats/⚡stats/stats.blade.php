{{-- ========== STATS & CTA – Responsive, Dark/Light ========== --}}
<section id="stats-cta" class="relative overflow-hidden bg-white dark:bg-zinc-950 py-24">
    {{-- Overlay subtil (mode clair : émeraude léger ; mode sombre : émeraude profond) --}}
    <div
        class="absolute inset-0 bg-linear-to-b from-emerald-50/80 to-transparent dark:from-emerald-900/20 dark:to-transparent pointer-events-none">
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- En‑tête --}}
        <div x-cloak class="mb-12 md:mb-16 max-w-3xl" x-data="cspState" x-intersect="shown = true">
            <span
                class="inline-block rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300 backdrop-blur-sm transition-all duration-700 ease-out"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                Quelques chiffres
            </span>
            <h2 class="mt-4 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-zinc-900 dark:text-white transition-all duration-700 delay-100 ease-out"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                {{ $this->about->impactHeading() ?: 'Des résultats concrets' }}
            </h2>
            @if ($this->about->impactSubtitle())
                <p class="mt-4 md:mt-6 text-base md:text-lg leading-7 md:leading-8 text-zinc-600 dark:text-zinc-400 transition-all duration-700 delay-200 ease-out"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    {{ $this->about->impactSubtitle() }}
                </p>
            @endif
        </div>

        {{-- Statistiques --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            @php
                $stats = collect($this->about->getImpactStats())
                    ->map(function ($stat) {
                        return array_merge(
                            [
                                'value' => $stat['value'] ?? '',
                                'label' => $stat['label'] ?? '',
                                'icon' => $stat['icon'] ?? 'M12 14l9-5-9-5-9 5 9 5z',
                                'description' => $stat['description'] ?? '',
                            ],
                            $stat,
                        );
                    })
                    ->toArray();
            @endphp

            @foreach ($stats as $index => $stat)
                <div x-cloak x-data="animatedStat('{{ addslashes($stat['value']) }}')" x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    class="transition-all duration-700 ease-out" style="transition-delay: {{ $index * 100 }}ms">

                    <div
                        class="group relative border border-zinc-200 bg-white p-5 md:p-6 transition-all duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:shadow-md hover:shadow-emerald-100/30 dark:border-zinc-700/60 dark:bg-zinc-900 dark:hover:border-emerald-700/60 dark:hover:shadow-emerald-900/20 rounded-xl">
                        {{-- Icône --}}
                        <div
                            class="mb-4 flex h-11 w-11 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 transition group-hover:bg-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400 dark:group-hover:bg-emerald-500/20 dark:group-hover:text-emerald-300">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="{{ $stat['icon'] }}" />
                            </svg>
                        </div>

                        {{-- Valeur --}}
                        <div class="text-2xl sm:text-3xl font-bold tracking-tight text-zinc-900 dark:text-white"
                            x-text="shown ? formatValue(count) : targetRaw"></div>

                        {{-- Label --}}
                        <div class="mt-2 text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ $stat['label'] }}
                        </div>

                        {{-- Description (optionnelle) --}}
                        @if (!empty($stat['description']))
                            <p class="mt-2 text-sm leading-relaxed text-zinc-500 dark:text-zinc-500">
                                {{ $stat['description'] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Bloc CTA --}}
        <div x-cloak class="mt-12 md:mt-16" x-data="{ shown: false }" x-intersect="shown = true"
            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'"
            class="transition-all duration-700 ease-out">
            <div
                class="overflow-hidden rounded-2xl border border-zinc-200 bg-zinc-50/80 backdrop-blur-md dark:border-white/10 dark:bg-white/5">
                <div class="grid gap-6 md:gap-8 p-6 sm:p-8 md:grid-cols-2 md:p-12">
                    {{-- Colonne de gauche --}}
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-zinc-900 dark:text-white">
                            {{ $this->about->impactHighlightHeading() ?: 'Prêt à donner vie à votre projet ?' }}
                        </h3>
                        <div class="mt-4 text-zinc-600 dark:text-zinc-300 text-sm md:text-base leading-relaxed">
                            @php
                                $highlightText = $this->about->impactHighlightText();
                            @endphp
                            @if ($highlightText)
                                @if (is_array($highlightText) && isset($highlightText['type']))
                                    {!! new \Tiptap\Editor()->setContent($highlightText)->getHTML() !!}
                                @else
                                    {!! $highlightText !!}
                                @endif
                            @else
                                <p>Discutons de vos besoins en développement web, de vos idées d'application ou de votre
                                    besoin de formation. Je vous réponds rapidement.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Colonne de droite --}}
                    <div
                        class="rounded-2xl border border-zinc-200 bg-white/80 p-5 md:p-6 flex flex-col justify-center dark:border-white/10 dark:bg-white/5">
                        <p
                            class="text-xs sm:text-sm uppercase tracking-[0.2em] text-emerald-600 dark:text-emerald-300 font-semibold">
                            Contact
                        </p>
                        <p class="mt-3 text-sm leading-6 text-zinc-500 dark:text-zinc-400">
                            {{ $this->about->impactSubtitle() ?: 'Un message suffit pour démarrer une collaboration.' }}
                        </p>
                        <div class="mt-5">
                            <a href="{{ $this->about->impactHighlightCtaUrl() ?: route('contact') }}"
                                class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-zinc-900">
                                {{ $this->about->impactHighlightCtaLabel() ?: 'Me contacter' }}
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
