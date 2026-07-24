<?php

use Livewire\Component;
use App\Models\Formation;
use App\Models\FormationCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Transition;
use Livewire\Attributes\Lazy;
use App\Settings\AboutSettings;
use Illuminate\Database\Eloquent\Builder;

new #[Lazy] #[Layout('layouts::main')] class extends Component {
    use \Livewire\WithPagination;

    protected $scrollToTop = false;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'cat')]
    public ?string $category = null;

    #[Url(as: 'sort')]
    public string $sort = 'newest';

    public function with(): array
    {
        $sorts = ['newest', 'oldest', 'name-asc', 'name-desc'];
        $categories = FormationCategory::orderBy('sort_order')->get();

        if (! $categories->contains('slug', $this->category)) {
            $this->category = null;
        }

        if (! in_array($this->sort, $sorts, true)) {
            $this->sort = 'newest';
        }

        $formations = $this->search === ''
            ? $this->applyFormationFilters(Formation::query())->paginate(9)
            : Formation::search($this->search)
                ->query(fn (Builder $query): Builder => $this->applyFormationFilters($query))
                ->paginate(9);

        return [
            'formations' => $formations,
            'categories' => $categories,
        ];
    }

    private function applyFormationFilters(Builder $query): Builder
    {
        return $query
            ->with(['category', 'media', 'user'])
            ->active()
            ->when($this->category, fn (Builder $query): Builder => $query->whereHas(
                'category',
                fn (Builder $categoryQuery): Builder => $categoryQuery->where('slug', $this->category)
            ))
            ->when($this->sort === 'oldest', fn (Builder $query): Builder => $query->oldest('created_at'))
            ->when($this->sort === 'name-asc', fn (Builder $query): Builder => $query->orderBy('title'))
            ->when($this->sort === 'name-desc', fn (Builder $query): Builder => $query->orderByDesc('title'))
            ->when($this->sort === 'newest', fn (Builder $query): Builder => $query->latest('created_at'));
    }

    public function updatedSearch(string $value): void
    {
        $this->search = $this->normalizeSearch($value);
        $this->resetPage();
    }

    public function updatedCategory(?string $value = null): void
    {
        $this->resetPage();
    }

    public function updatedSort(): void
    {
        $this->resetPage();
    }

    private function normalizeSearch(string $value): string
    {
        $value = preg_replace('/\s+/u', ' ', trim($value)) ?? '';

        return mb_substr($value, 0, 120);
    }

    #[Transition(skip: true)]
    public function clearFilters(): void
    {
        $this->reset(['search', 'category', 'sort']);
        $this->resetPage();
    }

    public function getStatsProperty(): array
    {
        return [
            'Formations' => Formation::published()->count(),
            'Catégories' => FormationCategory::count(),
            'Niveaux' => Formation::published()->distinct()->count(),
        ];
    }

    public function getAboutProperty(): AboutSettings
    {
        return app(AboutSettings::class);
    }
};
?>

<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950">
    {{-- ========== HEADER ========== --}}
    <x-formations-banner :stats="$this->stats" :about="$this->about" />

    {{-- ========== SECTION FILTRES + LISTE ========== --}}
    @island
        <section id="scroll-to-reference" data-preserve-scroll x-data="{ showFilters: false, sortOpen: false }"
            @keydown.window.slash="if (!$event.target.matches('input, textarea, select, [contenteditable]')) { $event.preventDefault(); $refs.searchInput.focus() }"
            aria-label="Recherche et filtres des formations"
            class="scroll-mt-11 px-5 py-8 xs:px-8 md:p-10 mx-auto max-w-7xl lg:px-12">

            <div class="mb-5">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Toutes les formations</h2>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Parcourez les programmes de formation de CADERSA</p>
            </div>

            {{-- Barre de recherche + bouton filtres --}}
            <section class="flex w-full flex-col-reverse gap-3 sm:flex-row sm:items-center" role="search"
                aria-label="Rechercher dans les formations">
                <div class="flex items-center">
                    {{-- Bouton Filtres --}}
                    <button type="button" x-ref="filtersButton" @click="showFilters = !showFilters"
                        :aria-expanded="showFilters" aria-controls="filters-panel"
                        class="group inline-flex h-10 items-center cursor-pointer gap-2 border border-zinc-200 bg-white px-4 text-sm font-medium text-zinc-600 transition-all duration-300 ease-out hover:border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:bg-zinc-700 dark:hover:text-zinc-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/50 focus-visible:ring-offset-2 active:scale-[0.97]"
                        :class="showFilters ?
                            'border-emerald-500! bg-emerald-50! text-emerald-700! shadow-emerald-100! hover:bg-emerald-100! dark:border-emerald-400! dark:bg-emerald-900/20! dark:text-emerald-300! dark:hover:bg-emerald-900/30!' :
                            ''">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
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

                    {{-- Bouton Reset (affiché si au moins un filtre actif) --}}
                    <div x-show="$wire.category || $wire.sort !== 'newest' || $wire.search !== ''" x-cloak
                        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="grid transition-all duration-500 ease-out">
                        <div class="flex items-center overflow-hidden">
                            <div class="px-1 transition-opacity duration-500 ease-out opacity-100">
                                <svg class="h-px w-5 text-zinc-300 dark:text-zinc-600" viewBox="0 0 20 1" fill="none">
                                    <line stroke="currentColor" y1="0.5" x2="20" y2="0.5"
                                        stroke-dasharray="4 4" />
                                </svg>
                            </div>
                            <button type="button" wire:click="clearFilters" @click="showFilters = false"
                                :inert="!$wire.category && $wire.sort === 'newest' && $wire.search === ''"
                                :aria-hidden="!$wire.category && $wire.sort === 'newest' && $wire.search === ''"
                                class="group inline-flex h-10 items-center justify-center gap-1.5 border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-600 shadow-sm transition-all duration-300 ease-out hover:border-red-300 hover:bg-red-50 hover:text-red-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:border-red-800 dark:hover:bg-red-900/20 dark:hover:text-red-400 active:scale-[0.97]">
                                <svg class="size-4 transition-transform duration-300 group-hover:rotate-180"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>Réinitialiser</span>
                                <span
                                    class="inline-grid h-5 min-w-5 place-items-center rounded-full bg-emerald-500 px-1 text-xs font-bold text-white"
                                    x-text="($wire.category ? 1 : 0) + ($wire.sort !== 'newest' ? 1 : 0) + ($wire.search !== '' ? 1 : 0)"></span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Champ de recherche --}}
                <div class="grow">
                    <div
                        class="group relative flex h-10 items-center border border-zinc-200 bg-white transition-all duration-300 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-500/20 dark:border-zinc-700 dark:bg-zinc-800">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-zinc-400 transition-colors duration-300 group-focus-within:text-emerald-500 dark:text-zinc-500 dark:group-focus-within:text-emerald-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input autocomplete="off"
                            id="formation-search" type="search" enterkeyhint="search"
                            class="h-full w-full border-0 bg-transparent pl-10 pr-12 text-sm font-medium text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-0 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                            wire:model.live.debounce.250ms.preserve-scroll="search" x-ref="searchInput"
                            placeholder="Rechercher une formation..." aria-label="Rechercher une formation">
                        <button x-cloak x-show="$wire.search !== ''"
                            @click="$wire.set('search', ''); $nextTick(() => $refs.searchInput?.focus())"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-75"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-400 transition-colors hover:text-zinc-600 dark:hover:text-zinc-300"
                            aria-label="Effacer la recherche">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <span wire:loading.delay wire:target="search,category,sort,clearFilters,gotoPage,nextPage,previousPage"
                            class="pointer-events-none absolute right-10 inline-flex items-center gap-1 text-xs text-emerald-600 dark:text-emerald-400"
                            aria-live="polite">
                            <span class="size-3 animate-spin rounded-full border-2 border-current border-r-transparent"
                                aria-hidden="true"></span>
                            <span class="sr-only">Recherche en cours</span>
                        </span>
                    </div>
                </div>
            </section>

            {{-- Panneau de filtre (catégories) --}}
            <div x-cloak id="filters-panel" x-show="showFilters" x-collapse style="display: none">
                <div class="mt-5 flex flex-col gap-4">
                    <fieldset>
                        <legend class="mb-2 text-sm font-medium text-zinc-700 dark:text-zinc-300">Catégorie :</legend>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" wire:click.preserve-scroll="$set('category', null)"
                                class="cursor-pointer select-none rounded px-4 py-2 text-sm font-medium transition-all duration-300 ease-out active:scale-95"
                                :class="!$wire.category ?
                                    'bg-emerald-500 text-white shadow-sm shadow-emerald-500/20 hover:bg-emerald-600' :
                                    'bg-zinc-50 text-zinc-600 hover:bg-zinc-100 hover:text-zinc-800 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-zinc-200'">
                                Toutes
                            </button>

                            @foreach ($categories as $cat)
                                <button type="button" wire:key="cat-{{ $cat->id }}"
                                    wire:click.preserve-scroll="$set('category', '{{ $cat->slug }}')"
                                    class="cursor-pointer select-none rounded px-4 py-2 text-sm font-medium transition-all duration-300 ease-out active:scale-95 shadow-sm hover:shadow-md"
                                    :class="$wire.category === '{{ $cat->slug }}' ?
                                        'bg-emerald-500 text-white shadow-emerald-500/20 hover:bg-emerald-600' :
                                        'bg-zinc-100 text-zinc-600 hover:bg-zinc-200 hover:text-zinc-800 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-zinc-200'">
                                    {{ $cat->name }}
                                </button>
                            @endforeach
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend class="mb-2 text-sm font-medium text-zinc-700 dark:text-zinc-300">Trier par :</legend>
                        <div class="flex flex-wrap gap-2">
                            @foreach ([
            'newest' => 'Plus récents',
            'oldest' => 'Plus anciens',
            'popular' => 'Populaires',
            'name-asc' => 'Titre A→Z',
            'name-desc' => 'Titre Z→A',
        ] as $value => $label)
                                <button type="button" wire:key="sort-{{ $value }}"
                                    wire:click.preserve-scroll="$set('sort', '{{ $value }}')"
                                    class="rounded border px-4 py-2 text-sm font-medium transition-all duration-200"
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

            <!-- Pagination -->
            <div class="mt-2 flex flex-wrap items-center justify-end gap-4">
                <nav class="flex items-center gap-1">
                    {{ $formations->links('pagination::custom') }}
                </nav>
            </div>

            {{-- ========== SECTION GRILLE  ========== --}}
            <div wire:loading.class="opacity-50 pointer-events-none"
                wire:target="search,category,sort,clearFilters,gotoPage,nextPage,previousPage"
                wire:transition
                class="mt-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 auto-rows-fr items-start gap-7 transition-opacity duration-300"
                aria-label="Liste des formations">
                @forelse ($formations as $formation)
                    <a wire:navigate href="{{ route('formations.show', $formation) }}"
                        class="group relative flex h-full flex-col border border-zinc-200/50 bg-white transition-all duration-500 ease-out
                  hover:-translate-y-1 hover:border-emerald-300 hover:shadow hover:shadow-emerald-100/30
                  dark:border-zinc-700/60 dark:bg-zinc-900 dark:hover:border-emerald-700 dark:hover:shadow-emerald-900/20"
                        wire:key="formation-{{ $formation->id }}" aria-label="{{ $formation->title }}">

                        {{-- Image (gallery) --}}
                        <div
                            class="relative overflow-hidden ring-1 ring-zinc-200 transition duration-500 ease-out group-hover:ring-emerald-300 dark:ring-zinc-700 dark:group-hover:ring-emerald-700">
                            @if ($formation->hasMedia('gallery'))
                                <img loading="eager" decoding="async"
                                    src="{{ $formation->getFirstMediaUrl('gallery', 'card') }}"
                                    alt="{{ $formation->title }}"
                                    class="aspect-video w-full object-cover transition duration-300 ease-out group-hover:scale-105" />
                            @else
                                <div
                                    class="flex aspect-video w-full items-center justify-center bg-zinc-100 text-zinc-400 dark:bg-zinc-800">
                                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Contenu --}}
                        <div class="flex flex-1 flex-col gap-2 p-4">
                            {{-- Titre animé --}}
                            {{-- <div
                                class="relative transition duration-300 ease-out will-change-transform group-hover:translate-x-4.5">
                                <div x-data="rotatingBadge" class="absolute top-1/2 -left-4 -translate-y-1/2">
                                    <div
                                        class="translate-x-0.5 opacity-0 transition duration-300 ease-out will-change-transform group-hover:translate-x-0 group-hover:opacity-100">
                                        <div data-rotating class="flex items-center gap-0.75">
                                            <div class="flex flex-col gap-1">
                                                <div data-box class="size-0.75 bg-current"></div>
                                                <div data-box class="size-0.75 bg-current"></div>
                                            </div>
                                            <div data-box class="size-0.75 bg-current"></div>
                                        </div>
                                    </div>
                                </div>
                                <p
                                    class="line-clamp-1 font-outfit font-medium text-zinc-900 transition-colors duration-300 group-hover:text-emerald-600 dark:text-white dark:group-hover:text-emerald-400">
                                    {{ $formation->title }}
                                </p>
                            </div> --}}
                            <div
                                class="relative transition duration-300 ease-out will-change-transform group-hover:translate-x-2">
                                <p
                                    class="line-clamp-1 font-outfit font-medium text-zinc-900 transition-colors duration-300 group-hover:text-emerald-600 dark:text-white dark:group-hover:text-emerald-400">
                                    {{ $formation->title }}
                                </p>
                            </div>

                            {{-- Résumé --}}
                            <p class="line-clamp-2 text-sm text-zinc-500 dark:text-zinc-400">
                                {{ $formation->getPlainTextContent(120) }}
                            </p>

                            {{-- Infos : chapitres + catégorie --}}
                            <div class="mt-3 flex flex-wrap items-center justify-between gap-3">
                                <span
                                    class="inline-flex items-center gap-1.5 text-xs font-medium text-zinc-500 dark:text-zinc-400">
                                    {{-- Icône chapitres --}}
                                    <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    {{ $formation->chaptersCount() }} chapitres
                                </span>

                                @if ($formation->category)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200/60 bg-white px-2 py-0.5 text-xs font-medium dark:border-zinc-700 dark:bg-zinc-800">
                                        {{ $formation->category->name }}
                                    </span>
                                @endif
                            </div>

                            {{-- Dates --}}
                            @if ($formation->start_date)
                                <div class="text-xs text-zinc-400 dark:text-zinc-500">
                                    {{ $formation->start_date->translatedFormat('d M Y') }}
                                    @if ($formation->end_date)
                                        → {{ $formation->end_date->translatedFormat('d M Y') }}
                                    @endif
                                </div>
                            @endif
                        </div>

                        {{-- Barre inférieure (statut + bouton) --}}
                        <div class="flex h-11 items-stretch text-sm font-medium">
                            <div
                                class="inline-flex min-w-25 items-center justify-center border-r border-r-white/20 dark:border-r-zinc-700/30 px-3 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300">
                                <span
                                    class="inline-flex items-center gap-1.5 bg-transparent px-2.5 py-0.5 text-xs font-semibold">
                                    {{ match ($formation->status) {
                                        'planned' => 'Planifié',
                                        'ongoing' => 'En cours',
                                        'completed' => 'Terminé',
                                        default => $formation->status,
                                    } }}
                                </span>
                            </div>
                            <div
                                class="inline-flex grow items-center justify-between gap-3 px-4 bg-emerald-50 text-emerald-700 transition-all duration-300 ease-out group-hover:bg-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-300 dark:group-hover:bg-emerald-900/30">
                                <span>Détails</span>
                                <span class="transition duration-300 ease-out group-hover:translate-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3" viewBox="0 0 28 22"
                                        fill="none">
                                        <path class="fill-current"
                                            d="M1 10H5.96e-08V12H1V10ZM27 12C27.55 12 28 11.55 28 11C28 10.45 27.55 10 27 10V12ZM18 1V5.96e-08H16V1H18ZM26.42 11.78C26.91 12.04 27.51 11.86 27.78 11.38C28.04 10.89 27.86 10.29 27.38 10.02L26.42 11.78ZM16 20.9V21.9H18V20.9H16ZM1 12H26.9V10H1V12ZM26.9 12H27V10H26.9V12ZM16 1C16 2.47 16.8 3.88 17.77 5.08C18.77 6.3 20.07 7.45 21.34 8.43C22.61 9.41 23.88 10.25 24.83 10.83C25.3 11.13 25.7 11.36 25.97 11.52C26.11 11.6 26.22 11.67 26.3 11.71C26.34 11.73 26.37 11.75 26.39 11.76C26.4 11.76 26.41 11.77 26.41 11.77C26.42 11.77 26.42 11.77 26.42 11.77C26.42 11.78 26.42 11.78 26.9 10.9C27.38 10.02 27.38 10.02 27.38 10.02C27.38 10.02 27.38 10.02 27.38 10.02C27.38 10.02 27.38 10.02 27.38 10.02C27.37 10.02 27.36 10.02 27.35 10.01C27.34 10.01 27.31 9.98 27.28 9.97C27.21 9.93 27.11 9.87 26.97 9.79C26.71 9.64 26.33 9.42 25.88 9.14C24.97 8.57 23.76 7.78 22.56 6.85C21.35 5.91 20.18 4.87 19.32 3.81C18.44 2.73 18 1.78 18 1H16ZM26.9 11C26.52 10.07 26.52 10.07 26.52 10.07L26.52 10.07L26.52 10.07L26.51 10.07L26.5 10.07L26.49 10.09L26.47 10.1L26.4 10.13L26.07 10.27L24.9 10.82C23.95 11.31 22.66 12.01 21.38 12.92C20.09 13.82 18.77 14.94 17.75 16.25C16.74 17.57 16 19.13 16 20.9H18C18 19.71 18.5 18.57 19.34 17.47C20.18 16.38 21.33 15.39 22.52 14.56C23.71 13.72 24.9 13.06 25.8 12.61C26.25 12.38 26.62 12.21 26.88 12.1C27.01 12.04 27.11 12 27.18 11.97C27.21 11.95 27.24 11.94 27.25 11.94C27.26 11.93 27.27 11.93 27.27 11.93L27.27 11.93L27.27 11.93C27.27 11.93 27.27 11.93 27.27 11.93C27.27 11.93 27.27 11.93 26.9 11Z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 lg:py-24">
                        <div x-data="{ shown: false }" x-intersect="shown = true"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                            class="transition-all duration-300 ease-out">
                            <div
                                class="mx-auto max-w-7xl rounded-3xl border border-dashed border-zinc-300 bg-zinc-50/60 px-8 py-12 text-center dark:border-zinc-700 dark:bg-zinc-900/60">
                                <div
                                    class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                                    <svg class="h-10 w-10 text-emerald-600 dark:text-emerald-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Aucune formation trouvée</h3>
                                <p class="mt-2 text-sm leading-relaxed text-zinc-500 dark:text-zinc-400">
                                    Essayez d'ajuster votre recherche ou vos filtres.
                                </p>
                                @if ($search || $category || $sort !== 'newest')
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
                @endforelse
            </div>

        </section>
    @endisland
</div>

@placeholder
    @php
        $stats = [
            'Formations' => \App\Models\Formation::published()->count(),
            'Catégories' => \App\Models\FormationCategory::count(),
            'Niveaux' => \App\Models\Formation::published()->distinct()->count(),
        ];
        $about = app(\App\Settings\AboutSettings::class);
    @endphp
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-950">
        <x-formations-banner :stats="$stats" :about="$about" />

        {{-- Skeleton pour la zone Filtres + Liste --}}
        <section class="px-5 py-8 xs:px-8 md:p-10 mx-auto max-w-7xl lg:px-12 animate-pulse">
            <div class="mb-5 space-y-3">
                <div class="h-8 w-48 bg-zinc-200 dark:bg-zinc-800 rounded-lg"></div>
                <div class="h-4 w-72 bg-zinc-200 dark:bg-zinc-800 rounded-lg"></div>
            </div>
            
            <div class="flex w-full flex-col-reverse gap-3 sm:flex-row sm:items-center">
                <div class="h-10 w-24 bg-zinc-200 dark:bg-zinc-800 rounded-lg"></div>
                <div class="h-10 grow bg-zinc-200 dark:bg-zinc-800 rounded-lg"></div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                @for ($i = 0; $i < 6; $i++)
                    <div class="flex h-96 flex-col border border-zinc-200/50 bg-white dark:border-zinc-700/60 dark:bg-zinc-900 rounded-xl overflow-hidden">
                        <div class="aspect-video w-full bg-zinc-200 dark:bg-zinc-800"></div>
                        <div class="flex flex-1 flex-col gap-4 p-4">
                            <div class="h-6 w-3/4 bg-zinc-200 dark:bg-zinc-800 rounded"></div>
                            <div class="space-y-2">
                                <div class="h-4 w-full bg-zinc-200 dark:bg-zinc-800 rounded"></div>
                                <div class="h-4 w-5/6 bg-zinc-200 dark:bg-zinc-800 rounded"></div>
                            </div>
                            <div class="mt-auto flex items-center justify-between">
                                <div class="h-4 w-20 bg-zinc-200 dark:bg-zinc-800 rounded"></div>
                                <div class="h-6 w-16 bg-zinc-200 dark:bg-zinc-800 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </section>
    </div>
@endplaceholder
