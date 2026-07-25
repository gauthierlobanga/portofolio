<section class="relative overflow-hidden border-t border-zinc-200 bg-zinc-50 px-6 py-20 dark:border-zinc-800 dark:bg-zinc-950 sm:py-24 lg:px-8">
    <div class="pointer-events-none absolute inset-0" aria-hidden="true">
        <div class="absolute -left-32 top-20 h-72 w-72 rounded-full bg-emerald-400/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -right-20 h-80 w-80 rounded-full bg-teal-400/10 blur-3xl"></div>
    </div>

    <div class="relative mx-auto grid max-w-6xl gap-10 lg:grid-cols-[0.8fr_1.2fr] lg:items-start lg:gap-16">
        <div>
            <flux:badge class="border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300">
                Centre d'aide
            </flux:badge>
            <h2 class="mt-5 text-3xl font-bold tracking-tight text-zinc-950 dark:text-white sm:text-4xl">
                Questions fréquentes
            </h2>
            <p class="mt-4 max-w-md text-base leading-7 text-zinc-600 dark:text-zinc-400">
                Une réponse est peut-être déjà disponible. Recherchez un mot-clé ou ouvrez une question pour en savoir plus.
            </p>

            <div class="mt-8 max-w-md" x-data="{}">
                {{-- Barre de recherche (nouveau style stable) --}}
                <div class="flex flex-col gap-2">
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Rechercher une réponse</label>
                    <div class="flex w-full flex-col-reverse gap-3 sm:flex-row sm:items-center" role="search">
                        
                        {{-- Bouton Reset (apparaît si recherche active) --}}
                        <div x-show="$wire.search !== ''" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="flex items-center">
                            <button type="button" wire:click="clearSearch"
                                class="group inline-flex h-10 items-center justify-center gap-1.5 border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-600 shadow-sm transition-all duration-300 ease-out hover:border-red-300 hover:bg-red-50 hover:text-red-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:border-red-800 dark:hover:bg-red-900/20 dark:hover:text-red-400 active:scale-[0.97]">
                                <svg class="size-4 transition-transform duration-300 group-hover:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>Effacer</span>
                            </button>
                            <div class="px-1">
                                <svg class="h-px w-3 text-zinc-300 dark:text-zinc-600" viewBox="0 0 12 1" fill="none">
                                    <line stroke="currentColor" y1="0.5" x2="12" y2="0.5" stroke-dasharray="2 2" />
                                </svg>
                            </div>
                        </div>

                        {{-- Champ de recherche --}}
                        <div class="relative flex grow items-center">
                            {{-- Icône loupe --}}
                            <div class="pointer-events-none absolute left-3.5 flex items-center" aria-hidden="true">
                                <svg class="size-4 text-zinc-400 dark:text-zinc-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </div>

                            <input
                                type="search"
                                wire:model.live.debounce.300ms="search"
                                placeholder="Ex. tarifs, projet, formation."
                                autocomplete="off"
                                spellcheck="false"
                                class="h-10 w-full border border-zinc-200 bg-white pl-9 pr-9 text-sm text-zinc-900 placeholder-zinc-400 shadow-sm outline-none transition-all duration-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder-zinc-500 dark:focus:border-emerald-500 dark:focus:ring-emerald-500/20 rounded-none"
                                aria-label="Rechercher une réponse"
                            >

                            {{-- Spinner de chargement --}}
                            <div wire:loading wire:target="search"
                                class="pointer-events-none absolute right-3 flex items-center" aria-hidden="true">
                                <svg class="size-4 animate-spin text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                </svg>
                            </div>
                            {{-- Icône clear (quand texte présent, pas de loader, et sur mobile où reset est caché sous le champ) --}}
                            <div wire:loading.remove wire:target="search"
                                x-show="$wire.search !== ''" x-cloak
                                class="pointer-events-none absolute right-3 flex items-center" aria-hidden="true">
                                <svg class="size-3.5 text-zinc-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a
                href="{{ route('faq') }}"
                wire:navigate
                class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 transition hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-300"
            >
                Voir toutes les questions
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                </svg>
            </a>
        </div>

        <div>
            <div class="mb-5 flex items-center justify-between gap-4">
                <p class="text-sm text-zinc-500 dark:text-zinc-400" aria-live="polite" wire:loading.class="opacity-50" wire:target="search">
                    {{ $this->faqs->count() }} {{ $this->faqs->count() > 1 ? 'réponses affichées' : 'réponse affichée' }}
                </p>
                <span class="hidden rounded-full border border-zinc-200 bg-white px-3 py-1 text-xs font-medium text-zinc-500 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-400 sm:inline-flex">
                    Mis à jour régulièrement
                </span>
            </div>

            <div x-data="{ open: null }" class="space-y-3" wire:loading.class="opacity-60" wire:target="search">
                @forelse ($this->faqs as $faq)
                    <article
                        wire:key="contact-faq-{{ $faq->id }}"
                        class="overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm transition hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-900/5 dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-emerald-800"
                    >
                        <button
                            type="button"
                            class="flex w-full items-center justify-between gap-5 px-5 py-5 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-inset sm:px-6"
                            @click="open = open === '{{ $faq->id }}' ? null : '{{ $faq->id }}'"
                            :aria-expanded="open === '{{ $faq->id }}' ? 'true' : 'false'"
                            aria-controls="contact-faq-answer-{{ $faq->id }}"
                        >
                            <span class="text-sm font-semibold leading-6 text-zinc-900 dark:text-white sm:text-base">
                                {{ $faq->question }}
                            </span>
                            <span
                                class="flex size-8 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-700 transition-transform duration-300 dark:bg-emerald-950/50 dark:text-emerald-300"
                                :class="open === '{{ $faq->id }}' ? 'rotate-45' : ''"
                                aria-hidden="true"
                            >
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" d="M12 5v14M5 12h14" />
                                </svg>
                            </span>
                        </button>

                        <div
                            id="contact-faq-answer-{{ $faq->id }}"
                            x-cloak
                            x-show="open === '{{ $faq->id }}'"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="border-t border-zinc-100 px-5 pb-6 pt-5 dark:border-zinc-800 sm:px-6"
                        >
                            <div class="prose prose-zinc max-w-none text-sm leading-7 dark:prose-invert">
                                {!! $faq->formatted_answer !!}
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-dashed border-zinc-300 bg-white px-6 py-12 text-center dark:border-zinc-700 dark:bg-zinc-900">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Aucun résultat</h3>
                        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                            Essayez un autre mot-clé ou consultez la FAQ complète.
                        </p>
                        <a
                            href="{{ route('faq') }}"
                            wire:navigate
                            class="mt-5 inline-flex items-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700"
                        >
                            Ouvrir la FAQ
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
