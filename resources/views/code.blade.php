{{-- Tri pour le post à réviser --}}
{{-- Zone de tri --}}
<div class="custom-top-dashed-border mt-5 flex flex-wrap items-center justify-between gap-4 pt-5">
    <div class="flex flex-wrap items-center gap-4">
        <div x-cloak class="relative flex items-center gap-1.5 text-xs" @click.outside="sortOpen = false"
            @keydown.escape.window="sortOpen = false">
            <span class="text-zinc-500 dark:text-zinc-400">Trier par</span>
            <button type="button" @click="sortOpen = !sortOpen" :aria-expanded="sortOpen"
                class="group inline-flex cursor-pointer h-8 items-center gap-1.5 bg-zinc-100 px-3 text-sm font-medium text-zinc-700 transition-all duration-300 ease-out hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/50">
                <span
                    x-text="{
                            'newest': 'Plus récents',
                            'oldest': 'Plus anciens',
                            'popular': 'Plus vus',
                            'name-asc': 'Titre A→Z',
                            'name-desc': 'Titre Z→A'
                        }[$wire.sort] || 'Plus récents'"></span>
                <svg class="size-3.5 transition-transform duration-300 ease-out" :class="sortOpen && 'rotate-180'"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                </svg>
            </button>
            <div x-show="sortOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                class="absolute top-full left-0 z-20 mt-1 w-40 overflow-hidden border border-zinc-200/60 bg-white shadow-md shadow-zinc-200/20 backdrop-blur-sm dark:border-zinc-700/60 dark:bg-zinc-900 dark:shadow-zinc-950/50"
                role="listbox">
                <div class="py-1">
                    @foreach (['newest' => 'Plus récents', 'oldest' => 'Plus anciens', 'popular' => 'Plus vus', 'name-asc' => 'Titre A→Z', 'name-desc' => 'Titre Z→A'] as $value => $label)
                        <button type="button" role="option" :aria-selected="$wire.sort === '{{ $value }}'"
                            @click="selectSort('{{ $value }}')"
                            class="flex w-full items-center gap-2 px-4 py-2.5 text-left text-sm transition-colors duration-150 hover:bg-emerald-50 dark:hover:bg-emerald-900/20"
                            :class="$wire.sort === '{{ $value }}' ?
                                'bg-emerald-50 font-semibold text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400' :
                                'text-zinc-600 dark:text-zinc-400'">
                            <span class="size-4 flex items-center justify-center">
                                <svg class="size-4 transition-opacity"
                                    :class="$wire.sort === '{{ $value }}' ? 'opacity-100' : 'opacity-0'"
                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex items-center gap-1.5 text-xs">
            <span class="text-zinc-500 dark:text-zinc-400">Articles trouvés :</span>
            <span
                class="inline-grid h-7 min-w-8 place-items-center rounded-full bg-emerald-100 px-2 text-xs font-bold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                {{ $posts->total() }}
            </span>
        </div>
    </div>
</div>
