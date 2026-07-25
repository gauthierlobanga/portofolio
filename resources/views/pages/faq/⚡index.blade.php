<?php

use App\Models\Faq;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Transition;
use Livewire\Component;

new #[Layout('layouts::main')] class extends Component
{
    #[Url(as: 'q')]
    public string $search = '';

    #[Transition(skip: true)]
    public function clearSearch(): void
    {
        $this->reset('search');
    }

    public function updatedSearch(string $value): void
    {
        $this->search = mb_substr(trim($value), 0, 120);
    }

    #[Computed]
    public function faqs(): Collection
    {
        $search = trim($this->search);

        return Faq::query()
            ->active()
            ->ordered()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $term = '%' . $search . '%';
                $query->where(function (Builder $query) use ($term): void {
                    $query
                        ->where('question', 'like', $term)
                        ->orWhere('answer', 'like', $term);
                });
            })
            ->get();
    }

    public function rendering(View $view): void
    {
        $view->title('Questions fréquentes');
        $view->layoutData([
            'seoDescription' => 'Retrouvez les réponses aux questions fréquentes sur mes services, formations et collaborations.',
            'seoType' => 'website',
        ]);
    }
};
?>

<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950">

    {{-- ==================== HERO ==================== --}}
    <section class="relative overflow-hidden border-b border-zinc-200 bg-white py-20 dark:border-zinc-800 dark:bg-zinc-900/40 sm:py-28">
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            <div class="absolute -left-32 -top-40 h-96 w-96 rounded-full bg-emerald-400/15 blur-3xl"></div>
            <div class="absolute -bottom-48 -right-24 h-96 w-96 rounded-full bg-teal-400/10 blur-3xl"></div>
            <div class="absolute inset-0 opacity-40 bg-[linear-gradient(to_right,#a1a1aa18_1px,transparent_1px),linear-gradient(to_bottom,#a1a1aa18_1px,transparent_1px)] bg-size-[32px_32px] mask-[radial-gradient(ellipse_at_center,#000_30%,transparent_75%)]"></div>
        </div>

        <div class="relative mx-auto max-w-4xl px-6 text-center lg:px-8">
            <flux:badge class="border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300">
                Centre d'aide
            </flux:badge>
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-zinc-950 dark:text-white sm:text-6xl">
                Les réponses aux questions<br class="hidden sm:block"> que vous vous posez
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                Explorez les réponses essentielles avant de démarrer une collaboration, une formation ou un nouveau projet.
            </p>
        </div>
    </section>

    {{-- ==================== SECTION LISTE FAQ ==================== --}}
    <section class="px-5 py-8 xs:px-8 md:p-10 mx-auto max-w-4xl lg:px-12">

        {{-- Barre de recherche (même pattern que Skills/Projets/Formations) --}}
        <div class="mb-6" x-data="{}">
            <section class="flex w-full flex-col-reverse gap-3 sm:flex-row sm:items-center" role="search">

                {{-- Bouton Reset (apparaît si recherche active) --}}
                <div x-show="$wire.search !== ''" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="flex items-center">
                    <div class="px-1">
                        <svg class="h-px w-5 text-zinc-300 dark:text-zinc-600" viewBox="0 0 20 1" fill="none">
                            <line stroke="currentColor" y1="0.5" x2="20" y2="0.5" stroke-dasharray="4 4" />
                        </svg>
                    </div>
                    <button type="button" wire:click="clearSearch"
                        class="group inline-flex h-10 items-center justify-center gap-1.5 border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-600 shadow-sm transition-all duration-300 ease-out hover:border-red-300 hover:bg-red-50 hover:text-red-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:border-red-800 dark:hover:bg-red-900/20 dark:hover:text-red-400 active:scale-[0.97]">
                        <svg class="size-4 transition-transform duration-300 group-hover:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Réinitialiser</span>
                    </button>
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
                        placeholder="Rechercher une question, un mot-clé…"
                        autocomplete="off"
                        spellcheck="false"
                        class="h-10 w-full border border-zinc-200 bg-white pl-9 pr-9 text-sm text-zinc-900 placeholder-zinc-400 shadow-sm outline-none transition-all duration-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder-zinc-500 dark:focus:border-emerald-500 dark:focus:ring-emerald-500/20"
                        id="faq-search-input"
                        aria-label="Rechercher dans la FAQ"
                    >

                    {{-- Spinner de chargement --}}
                    <div wire:loading wire:target="search"
                        class="pointer-events-none absolute right-3 flex items-center" aria-hidden="true">
                        <svg class="size-4 animate-spin text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                        </svg>
                    </div>
                    {{-- Icône clear quand texte présent et pas en loading --}}
                    <div wire:loading.remove wire:target="search"
                        x-show="$wire.search !== ''" x-cloak
                        class="pointer-events-none absolute right-3 flex items-center" aria-hidden="true">
                        <svg class="size-3.5 text-zinc-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </section>
        </div>

        {{-- En-tête résultats --}}
        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600 dark:text-emerald-400">FAQ</p>
                <h2 class="mt-2 text-2xl font-bold text-zinc-950 dark:text-white sm:text-3xl">
                    Questions fréquentes
                </h2>
            </div>
            <span class="hidden rounded-full border border-zinc-200 bg-white px-3 py-1 text-sm text-zinc-500 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-400 sm:inline-flex" wire:loading.class="opacity-50" wire:target="search">
                {{ $this->faqs->count() }} {{ $this->faqs->count() > 1 ? 'réponses' : 'réponse' }}
            </span>
        </div>

        {{-- Liste accordéon --}}
        <div x-data="{ open: null }" class="space-y-4" wire:loading.class="opacity-60" wire:target="search">
            @forelse ($this->faqs as $faq)
                <article
                    wire:key="faq-{{ $faq->id }}"
                    class="overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm transition hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-900/5 dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-emerald-800"
                >
                    <button
                        type="button"
                        class="flex w-full items-center justify-between gap-6 px-5 py-5 text-left sm:px-7"
                        @click="open = open === '{{ $faq->id }}' ? null : '{{ $faq->id }}'"
                        :aria-expanded="open === '{{ $faq->id }}' ? 'true' : 'false'"
                        aria-controls="faq-answer-{{ $faq->id }}"
                    >
                        <span class="text-base font-semibold text-zinc-900 dark:text-white sm:text-lg">
                            {{ $faq->question }}
                        </span>
                        <span
                            class="flex size-9 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-700 transition-transform duration-300 dark:bg-emerald-950/50 dark:text-emerald-300"
                            :class="open === '{{ $faq->id }}' ? 'rotate-45' : ''"
                            aria-hidden="true"
                        >
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" d="M12 5v14M5 12h14" />
                            </svg>
                        </span>
                    </button>

                    <div
                        id="faq-answer-{{ $faq->id }}"
                        x-cloak
                        x-show="open === '{{ $faq->id }}'"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2"
                        class="border-t border-zinc-100 px-5 pb-6 pt-5 dark:border-zinc-800 sm:px-7"
                    >
                        <div class="prose prose-zinc max-w-none text-sm leading-7 dark:prose-invert sm:text-base">
                            {!! $faq->formatted_answer !!}
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-dashed border-zinc-300 bg-white px-6 py-16 text-center dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="mx-auto flex size-12 items-center justify-center rounded-full bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 9a2.5 2.5 0 1 1 4.7 1.2c-.6.9-1.7 1.2-2.2 2.1-.2.3-.3.7-.3 1.2M12 17.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-zinc-900 dark:text-white">Aucun résultat</h3>
                    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                        Essayez un autre mot-clé ou contactez-moi directement.
                    </p>
                    <a href="{{ route('contact') }}" wire:navigate class="mt-6 inline-flex items-center rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        Poser une question
                    </a>
                </div>
            @endforelse
        </div>
    </section>
</div>
