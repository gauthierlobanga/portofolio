<?php

use Livewire\Component;
use App\Models\Skill;
use App\Settings\AboutSettings;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use App\Concerns\Traits\HasImageUrl;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Transition;

new #[Layout('layouts::main')] class extends Component {
    use HasImageUrl;

    use WithPagination;

    protected $scrollToTop = false;

    protected const PER_PAGE = 6;

    #[Url(as: 'category')]
    public string $filter = 'all';

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'sort')]
    public string $sort = 'level-desc';

    #[Transition(skip: true)]
    public function clearFilters(): void
    {
        $this->reset(['filter', 'search', 'sort']);
        $this->resetPage();
    }

    #[Computed]
    public function statuses(): array
    {
        $categories = \App\Models\SkillCategory::orderBy('sort_order')->get();
        $statuses = ['all' => 'Toutes'];
        foreach ($categories as $cat) {
            $statuses[$cat->id] = $cat->name;
        }
        return $statuses;
    }

    #[Computed]
    public function skills(): Collection
    {
        $applyFilters = function ($query) {
            $query->with(['categorySkill', 'media']);
            if ($this->filter !== 'all') {
                $query->where('skill_category_id', $this->filter);
            }
            return $query;
        };

        if (empty($this->search)) {
            $skills = $applyFilters(Skill::query())->get();
        } else {
            $skills = Skill::search($this->search)->query($applyFilters)->get();
        }

        if ($this->sort === 'level-asc') {
            $skills = $skills->sortBy('level');
        } elseif ($this->sort === 'level-desc') {
            $skills = $skills->sortByDesc('level');
        } elseif ($this->sort === 'name-asc') {
            $skills = $skills->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        } elseif ($this->sort === 'name-desc') {
            $skills = $skills->sortByDesc('name', SORT_NATURAL | SORT_FLAG_CASE);
        } else {
            $skills = $skills->sortBy([['categorySkill.sort_order', 'asc'], ['level', 'desc']]);
        }

        return $skills->values();
    }

    #[Computed]
    public function categories(): LengthAwarePaginator
    {
        $grouped = $this->skills->groupBy(fn($skill) => $skill->skill_category_id ?? 'none');

        $items = $grouped
            ->map(function (Collection $skills, string $key) {
                $category = $skills->first()->categorySkill;

                return (object) [
                    'id' => $key,
                    'name' => $category?->name ?? 'Non classé',
                    'color' => $category?->color ?? '#10b981',
                    'icon' => $category?->icon,
                    'skills' => $skills,
                    'count' => $skills->count(),
                ];
            })
            ->values();

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = self::PER_PAGE;
        $sliced = $items->slice(($page - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator($sliced, $items->count(), $perPage, $page, ['path' => LengthAwarePaginator::resolveCurrentPath()]);
    }

    #[Computed]
    public function about(): AboutSettings
    {
        return app(AboutSettings::class);
    }
};
?>

<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950">
    {{-- ==================== HERO ==================== --}}
    <x-skills-banner :about="$this->about" />

    {{-- ========== SECTION GRILLE COMPÉTENCES ========== --}}
            <section class="px-5 py-8 xs:px-8 md:p-10 mx-auto max-w-7xl lg:px-12">
            {{-- Barre de recherche + bouton filtres --}}
            <div class="mb-2" x-data="{ showFilters: false }">
                <section class="flex w-full flex-col-reverse gap-3 sm:flex-row sm:items-center" role="search">
                    <div class="flex items-center">
                        {{-- Bouton Filtres --}}
                        <button type="button" x-ref="filtersButton" @click="showFilters = !showFilters"
                            :aria-expanded="showFilters" aria-controls="filters-panel"
                            class="group inline-flex h-10 items-center cursor-pointer gap-2 border border-zinc-200 bg-white px-4 text-sm font-medium text-zinc-600 transition-all duration-300 ease-out hover:border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:bg-zinc-700 dark:hover:text-zinc-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/50 focus-visible:ring-offset-2 active:scale-[0.97]"
                            :class="showFilters ?
                                'border-emerald-500! bg-emerald-50! text-emerald-700! shadow-emerald-100! hover:bg-emerald-100! dark:border-emerald-400! dark:bg-emerald-900/20! dark:text-emerald-300! dark:hover:bg-emerald-900/30!' :
                                ''">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 5H3"
                                    class="transition-all duration-200 ease-out opacity-40 group-hover:opacity-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"
                                    style="transition-delay: 0ms;" />
                                <path d="M12 19H3"
                                    class="transition-all duration-200 ease-out opacity-40 group-hover:opacity-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"
                                    style="transition-delay: 30ms;" />
                                <path d="M14 3v4"
                                    class="transition-all duration-200 ease-out opacity-40 group-hover:opacity-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"
                                    style="transition-delay: 60ms;" />
                                <path d="M16 17v4"
                                    class="transition-all duration-200 ease-out opacity-40 group-hover:opacity-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"
                                    style="transition-delay: 90ms;" />
                                <path d="M21 12h-9"
                                    class="transition-all duration-200 ease-out opacity-40 group-hover:opacity-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"
                                    style="transition-delay: 120ms;" />
                                <path d="M21 19h-5"
                                    class="transition-all duration-200 ease-out opacity-40 group-hover:opacity-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"
                                    style="transition-delay: 150ms;" />
                                <path d="M21 5h-7"
                                    class="transition-all duration-200 ease-out opacity-40 group-hover:opacity-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"
                                    style="transition-delay: 180ms;" />
                                <path d="M8 10v4"
                                    class="transition-all duration-200 ease-out opacity-40 group-hover:opacity-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"
                                    style="transition-delay: 210ms;" />
                                <path d="M8 12H3"
                                    class="transition-all duration-200 ease-out opacity-40 group-hover:opacity-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"
                                    style="transition-delay: 240ms;" />
                            </svg>
                            <span>Filtres</span>
                        </button>

                        {{-- Bouton Reset --}}
                        <div x-show="$wire.filter !== 'all' || $wire.sort !== 'level-desc' || $wire.search !== ''" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="grid transition-all duration-500 ease-out">
                            <div class="flex items-center overflow-hidden">
                                <div class="px-1 transition-opacity duration-500 ease-out opacity-100">
                                    <svg class="h-px w-5 text-zinc-300 dark:text-zinc-600" viewBox="0 0 20 1"
                                        fill="none">
                                        <line stroke="currentColor" y1="0.5" x2="20" y2="0.5"
                                            stroke-dasharray="4 4" />
                                    </svg>
                                </div>
                                <button type="button" wire:click="clearFilters" @click="showFilters = false"
                                    :inert="$wire.filter === 'all' && $wire.sort === 'level-desc' && $wire
                                        .search === ''"
                                    class="group inline-flex h-10 items-center justify-center gap-1.5 border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-600 shadow-sm transition-all duration-300 ease-out hover:border-red-300 hover:bg-red-50 hover:text-red-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:border-red-800 dark:hover:bg-red-900/20 dark:hover:text-red-400 active:scale-[0.97]">
                                    <svg class="size-4 transition-transform duration-300 group-hover:rotate-180"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span>Réinitialiser</span>
                                    <span
                                        class="inline-grid h-5 min-w-5 place-items-center rounded-full bg-emerald-500 px-1 text-xs font-bold text-white"
                                        x-text="($wire.filter !== 'all' ? 1 : 0) + ($wire.sort !== 'level-desc' ? 1 : 0) + ($wire.search !== '' ? 1 : 0)"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Champ de recherche --}}
                    <div class="relative grow">
                        <div
                            class="group relative flex h-10 items-center border border-zinc-200 bg-white transition-all duration-300 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-500/20 dark:border-zinc-700 dark:bg-zinc-800">
                            {{-- Icône loupe --}}
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3" aria-hidden="true">
                                <svg class="h-5 w-5 text-zinc-400 transition-colors duration-300 group-focus-within:text-emerald-500 dark:text-zinc-500 dark:group-focus-within:text-emerald-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>

                            <input
                                type="search"
                                wire:model.live.debounce.250ms="search"
                                x-ref="searchInput"
                                placeholder="Rechercher une compétence..."
                                autocomplete="off"
                                spellcheck="false"
                                class="h-full w-full border-0 bg-transparent pl-10 pr-10 text-sm font-medium text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-0 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                                aria-label="Rechercher une compétence"
                            >

                            {{-- Spinner chargement --}}
                            <div wire:loading wire:target="search"
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3" aria-hidden="true">
                                <svg class="h-4 w-4 animate-spin text-emerald-500" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                </svg>
                            </div>

                            {{-- Bouton effacer --}}
                            <div wire:loading.remove wire:target="search" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button x-cloak x-show="$wire.search !== ''"
                                    @click="$wire.set('search', ''); $nextTick(() => $refs.searchInput?.focus())"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-75"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-75"
                                    class="text-zinc-400 transition-colors hover:text-zinc-600 dark:hover:text-zinc-300"
                                    aria-label="Effacer la recherche">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Panneau de filtre (statuts) --}}
                <div wire:cloak id="filters-panel" x-show="showFilters" x-collapse style="display: none">
                    <div class="mt-5 flex flex-col gap-4">
                        <fieldset>
                            <legend class="mb-2 text-sm font-medium text-zinc-700 dark:text-zinc-300">Catégorie :</legend>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" wire:click.preserve-scroll="$set('filter', 'all')"
                                    class="cursor-pointer select-none rounded px-4 py-2 text-sm font-medium transition-all duration-300 ease-out active:scale-95"
                                    :class="$wire.filter === 'all' ?
                                        'bg-emerald-500 text-white shadow-sm shadow-emerald-500/20 hover:bg-emerald-600' :
                                        'bg-zinc-50 text-zinc-600 hover:bg-zinc-100 hover:text-zinc-800 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-zinc-200'">
                                    Toutes
                                </button>

                                @foreach ($this->statuses as $key => $label)
                                    @if ($key !== 'all')
                                        <button type="button" wire:key="status-{{ $key }}"
                                            wire:click.preserve-scroll="$set('filter', '{{ $key }}')"
                                            class="cursor-pointer select-none px-4 py-2 text-sm font-medium transition-all duration-300 ease-out active:scale-95"
                                            :class="$wire.filter === '{{ $key }}' ?
                                                'bg-emerald-500 text-white shadow-emerald-500/20 hover:bg-emerald-600' :
                                                'bg-zinc-100 text-zinc-600 hover:bg-zinc-200 hover:text-zinc-800 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-zinc-200'">
                                            {{ $label }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="mb-2 text-sm font-medium text-zinc-700 dark:text-zinc-300">Trier par :</legend>
                            <div class="flex flex-wrap gap-2">
                                @foreach ([
            'level-desc' => 'Niveau max',
            'level-asc' => 'Niveau min',
            'name-asc' => 'Titre A→Z',
            'name-desc' => 'Titre Z→A',
        ] as $value => $label)
                                    <button type="button" wire:key="sort-{{ $value }}"
                                        wire:click.preserve-scroll="$set('sort', '{{ $value }}')"
                                        class="border px-4 py-2 text-sm font-medium transition-all duration-200"
                                        :class="$wire.sort === '{{ $value }}' ?
                                            'border-emerald-500 bg-emerald-50 text-emerald-700 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-300' :
                                            'border-zinc-200 bg-white text-zinc-600 hover:border-emerald-300 hover:text-emerald-700 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:border-emerald-500 dark:hover:text-emerald-200'">
                                        {{ $label }}
                                    </button>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mb-4 flex flex-wrap items-center justify-end gap-4">
                <nav class="flex items-center gap-1">
                    {{ $this->categories->links('pagination::custom') }}
                </nav>
            </div>

            @if ($this->categories->isEmpty())
                <div class="col-span-full py-16 lg:py-24">
                    <div x-data="{ shown: false }" x-intersect="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        class="transition-all duration-300 ease-out">
                        <div
                            class="mx-auto max-w-2xl rounded-3xl border border-dashed border-zinc-300 bg-zinc-50/60 px-8 py-12 text-center dark:border-zinc-700 dark:bg-zinc-900/60">
                            <div
                                class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                                <svg class="h-10 w-10 text-emerald-600 dark:text-emerald-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Aucune compétence trouvée</h3>
                            <p class="mt-2 text-sm leading-relaxed text-zinc-500 dark:text-zinc-400">Essayez d'ajuster vos
                                filtres ou votre terme de recherche.</p>
                            @if ($filter !== 'all' || $search || $sort !== 'level-desc')
                                <button wire:click="clearFilters"
                                    class="mt-6 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm shadow-emerald-200 transition-all duration-200 hover:bg-emerald-700 hover:shadow-md dark:bg-emerald-500 dark:hover:bg-emerald-400 dark:shadow-emerald-900/50">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Réinitialiser les filtres
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            {{-- Grille des catégories --}}
            <div wire:loading.class="opacity-50 pointer-events-none"
                wire:target="search,filter,sort,clearFilters,gotoPage,nextPage,previousPage"
                class="mt-5 transition-opacity duration-300 min-h-136">
                <div wire:transition="cards-grid" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($this->categories as $category)
                        <div x-cloak x-data="cspState" x-intersect="shown = true"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="transition-all duration-300 ease-out"
                            style="transition-delay: {{ $loop->index * 75 }}ms">
                            <div
                                class="group flex h-full flex-col rounded-2xl border border-zinc-200/70 bg-white p-6 shadow-sm transition-all duration-500 ease-out
                                hover:-translate-y-1 hover:border-emerald-300 hover:shadow-md hover:shadow-emerald-100/40
                                dark:border-zinc-700/60 dark:bg-zinc-900 dark:hover:border-emerald-700 dark:hover:shadow-emerald-900/20">
                                {{-- En‑tête de catégorie --}}
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="flex h-12 w-12 items-center justify-center rounded text-white"
                                        style="background-color: {{ $category->color }}">
                                        @if ($category->icon)
                                            @svg('heroicon-o-' . $category->icon, 'h-6 w-6')
                                        @else
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                                            {{ $category->name }}
                                        </h3>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                            {{ $category->count }} compétence(s)
                                        </p>
                                    </div>
                                </div>

                                {{-- Barres de compétences --}}
                                <div class="flex-1 space-y-5">
                                    @foreach ($category->skills as $skill)
                                        <div x-data="{ width: 0 }" x-init="$watch('shown', value => { if (value) setTimeout(() => width = {{ $skill->level }}, 100 + {{ $loop->index }} * 60) })" class="space-y-2">
                                            <div class="flex items-center gap-3 text-sm font-medium">
                                                {{-- Icône de la compétence --}}
                                                @if ($skill->icon)
                                                    <img loading="eager" decoding="async" src="{{ $skill->icon }}"
                                                        alt="{{ $skill->name }}"
                                                        class="h-8 w-8 rounded object-contain" />
                                                @else
                                                    <span
                                                        class="flex h-8 w-8 items-center justify-center rounded text-xs font-bold text-white"
                                                        style="background-color: {{ $category->color }}">
                                                        {{ strtoupper(substr($skill->name, 0, 2)) }}
                                                    </span>
                                                @endif
                                                <span
                                                    class="text-zinc-700 dark:text-zinc-300 flex-1">{{ $skill->name }}</span>
                                                <span class="text-xs text-zinc-500 dark:text-zinc-400 tabular-nums"
                                                    x-text="width + '%'">0%</span>
                                            </div>
                                            <div
                                                class="h-2 w-full overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">
                                                <div class="h-full rounded-full transition-all duration-700 ease-out"
                                                    :style="'width: ' + width + '%; background: linear-gradient(90deg, ' +
                                                        '{{ $category->color }}' + ', ' + '{{ $category->color }}' +
                                                        'cc)'">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-5 h-1 w-12 rounded-full opacity-20"
                                    style="background-color: {{ $category->color }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $this->categories->links('pagination::custom') }}
            </div>
        </section></div>
