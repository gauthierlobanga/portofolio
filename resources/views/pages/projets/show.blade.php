<?php

use Livewire\Component;
use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

new #[Layout('layouts::main')] class extends Component {
    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project->load(['tags', 'media']);
    }

    public function rendering(\Illuminate\View\View $view): void
    {
        $view->title($this->project->title);

        $imageUrl = $this->project->getFirstMediaUrl('cover') ?: asset('images/logo-app.svg');
        $description = $this->project->getPlainTextContent(160);

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Project',
            'name' => $this->project->title,
            'description' => $description,
            'image' => [$imageUrl],
            'url' => route('projects.show', $this->project->slug),
            'foundingDate' => $this->project->start_date?->format('Y-m-d'),
        ];

        $view->layoutData([
            'seoDescription' => $description,
            'seoImage' => $imageUrl,
            'seoType' => 'article',
            'seoKeywords' => $this->project->tags->pluck('name')->toArray(),
            'schema' => '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>',
        ]);
    }

    #[Computed]
    public function galleryImages()
    {
        return $this->project->getMedia('gallery')->map(
            fn($media) => [
                'url' => $media->getUrl(),
                'thumb' => $media->hasGeneratedConversion('thumb') ? $media->getUrl('thumb') : $media->getUrl(),
                'title' => $media->getCustomProperty('title') ?: $media->name,
                'description' => $media->getCustomProperty('description') ?: '',
                'alt' => $media->getCustomProperty('alt') ?: $this->project->title . ' – ' . ($media->name ?: 'Galerie'),
            ],
        );
    }

    // ===== M├ëTHODE POUR LES PDF =====
    #[Computed]
    public function pdfs()
    {
        return $this->project->getMedia('documents')->map(
            fn($media) => [
                'url' => $media->getUrl(),
                'name' => $media->name ?? ($media->file_name ?? 'Document'),
                'size' => $media->size,
                'file_name' => $media->file_name,
            ],
        );
    }

    #[Computed]
    public function hasPdf()
    {
        return $this->project->getMedia('documents')->isNotEmpty();
    }
};
?>

<div wire:transition="content" class="relative min-h-screen bg-white dark:bg-zinc-950">
    {{-- Decorative Backgrounds --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 right-0 h-120 w-120 rounded-full bg-emerald-500/10 blur-[120px] transform-gpu">
        </div>
        <div class="absolute -left-40 top-40 h-100 w-100 rounded-full bg-teal-500/10 blur-[120px] transform-gpu"></div>
    </div>

    {{-- Hero Section Projet --}}
    <section wire:cloak class="relative pt-16 pb-16 lg:pt-20 lg:pb-20 overflow-hidden" x-data="projectShowHeroReveal()">
        <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-16 lg:grid-cols-2 lg:gap-12 items-center">
                {{-- Contenu (Gauche) --}}
                <div class="flex flex-col items-start text-left">
                    {{-- Badges --}}
                    <div x-ref="badges" class="mb-6 flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-sm font-medium text-emerald-700 backdrop-blur-sm dark:border-emerald-400/30 dark:bg-emerald-500/10 dark:text-emerald-300">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                            </span>
                            {{ $project->status === 'completed' ? 'Terminé' : ($project->status === 'ongoing' ? 'En cours' : 'Planifié') }}
                        </span>

                        @if ($project->location)
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-white/50 px-3 py-1.5 text-sm font-medium text-zinc-700 backdrop-blur-sm dark:border-white/10 dark:bg-white/5 dark:text-zinc-300">
                                <svg class="h-4 w-4 text-zinc-400 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $project->location }}
                            </span>
                        @endif

                        @if ($project->tags->isNotEmpty())
                            @foreach ($project->tags->take(2) as $tag)
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-white/50 px-3 py-1.5 text-sm font-medium text-zinc-700 backdrop-blur-sm dark:border-white/10 dark:bg-white/5 dark:text-zinc-300">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                            @if($project->tags->count() > 2)
                                <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">+{{ $project->tags->count() - 2 }}</span>
                            @endif
                        @endif
                    </div>

                    {{-- Titre --}}
                    <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900 drop-shadow-sm sm:text-5xl lg:text-6xl leading-[1.1] dark:text-white dark:drop-shadow-xl">
                        {{ $project->title }}
                    </h1>

                    {{-- Sous-titre --}}
                    @if ($project->excerpt)
                        <div x-ref="subtitle" class="mt-6 max-w-2xl text-lg font-light leading-relaxed text-zinc-600 sm:text-xl dark:text-zinc-300">
                            {!! $project->renderRichContent('excerpt') !!}
                        </div>
                    @endif

                    {{-- Meta (Dates) --}}
                    <div x-ref="meta" class="mt-8 flex flex-wrap items-center gap-4 text-sm font-medium">
                        @if ($project->start_date)
                            <div class="flex items-center gap-3 rounded-2xl border border-zinc-200 bg-white/60 px-4 py-3 backdrop-blur-sm transition-colors hover:bg-white dark:border-white/10 dark:bg-white/5 dark:hover:bg-white/10">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/40">
                                    <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Début du projet</p>
                                    <p class="text-base text-zinc-900 dark:text-white">{{ $project->start_date->translatedFormat('F Y') }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($project->end_date)
                            <div class="flex items-center gap-3 rounded-2xl border border-zinc-200 bg-white/60 px-4 py-3 backdrop-blur-sm transition-colors hover:bg-white dark:border-white/10 dark:bg-white/5 dark:hover:bg-white/10">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900/40">
                                    <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Fin du projet</p>
                                    <p class="text-base text-zinc-900 dark:text-white">{{ $project->end_date->translatedFormat('F Y') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Actions --}}
                    @if ($project->website_url || $project->repository_url)
                        <div class="mt-10 flex flex-wrap items-center gap-4">
                            @if ($project->website_url)
                                <a href="{{ $project->website_url }}" target="_blank" rel="noopener noreferrer"
                                    class="group flex items-center gap-2 rounded-full bg-zinc-900 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-zinc-900/20 transition-all hover:-translate-y-0.5 hover:bg-zinc-800 hover:shadow-xl hover:shadow-zinc-900/30 dark:bg-white dark:text-zinc-900 dark:shadow-white/10 dark:hover:bg-zinc-100 dark:hover:shadow-white/20">
                                    Visiter le site
                                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            @endif
                            @if ($project->repository_url)
                                <a href="{{ $project->repository_url }}" target="_blank" rel="noopener noreferrer"
                                    class="group flex items-center gap-2 rounded-full border border-zinc-200 bg-white/50 px-7 py-3.5 text-sm font-bold text-zinc-900 shadow-sm backdrop-blur-sm transition-all hover:-translate-y-0.5 hover:border-zinc-300 hover:bg-white hover:shadow-md dark:border-zinc-700/50 dark:bg-zinc-800/50 dark:text-zinc-100 dark:hover:border-zinc-600 dark:hover:bg-zinc-800">
                                    <svg class="h-4 w-4 text-zinc-500 group-hover:text-zinc-900 dark:text-zinc-400 dark:group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.603-3.369-1.341-3.369-1.341-.454-1.154-1.109-1.462-1.109-1.462-.908-.62.069-.608.069-.608 1.003.071 1.531 1.032 1.531 1.032.892 1.528 2.341 1.087 2.91.832.091-.647.35-1.087.636-1.337-2.22-.253-4.555-1.111-4.555-4.944 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.646 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.116 2.504.34 1.91-1.294 2.75-1.025 2.75-1.025.545 1.376.202 2.393.1 2.646.64.699 1.028 1.592 1.028 2.683 0 3.842-2.337 4.687-4.566 4.935.359.31.679.923.679 1.861 0 1.343-.012 2.425-.012 2.754 0 .268.18.579.688.481A10.013 10.013 0 0022 12c0-5.523-4.477-10-10-10z" />
                                    </svg>
                                    Code source
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Cover Image (Droite) --}}
                <div class="relative w-full">
                    <div class="group relative overflow-hidden rounded-[2.5rem] border border-black/5 bg-zinc-100 shadow-2xl shadow-zinc-200/50 dark:border-white/10 dark:bg-zinc-900 dark:shadow-black/50">
                        @if($project->getFirstMediaUrl('cover'))
                            <img src="{{ $project->getFirstMediaUrl('cover') }}" alt="{{ $project->title }}" class="aspect-4/3 sm:aspect-3/2 lg:aspect-4/3 w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" loading="eager">
                        @else
                            <div class="flex aspect-4/3 sm:aspect-3/2 lg:aspect-4/3 w-full items-center justify-center bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-900">
                                <svg class="h-16 w-16 text-zinc-300 dark:text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 rounded-[2.5rem] ring-1 ring-inset ring-black/10 dark:ring-white/10 pointer-events-none"></div>
                        <div class="absolute inset-0 bg-gradient-to-tr from-zinc-950/20 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100 pointer-events-none"></div>
                    </div>

                    {{-- Floating Decorative Elements --}}
                    <div class="absolute -bottom-6 -left-6 -z-10 h-32 w-32 rounded-full bg-emerald-400/20 blur-2xl dark:bg-emerald-500/10"></div>
                    <div class="absolute -right-8 -top-8 -z-10 h-40 w-40 rounded-full bg-sky-400/20 blur-2xl dark:bg-sky-500/10"></div>
                </div>
            </div>
        </div>
    </section>
    {{-- Contenu & Galerie --}}
    <section class="relative py-10 lg:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            {{-- @assets
                <link rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
            @endassets --}}

            {{-- Contenu Prose --}}
            <div wire:cloak x-data="{ shown: false }" x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="fi-prose max-w-none transition-all duration-1000 ease-out
                        bg-white/50 dark:bg-zinc-900/50 backdrop-blur-xl p-8 md:p-12 w-full overflow-hidden"
                wire:ignore>
                {!! $project->renderRichContent('content') !!}
            </div>

            {{-- Étude de Cas --}}
            @if ($project->problematic || $project->solution || $project->results)
                <div wire:cloak x-data="{ shown: false }" x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    class="mt-16 space-y-8 transition-all duration-1000 ease-out delay-100">

                    @if ($project->problematic)
                        <div
                            class="rounded-2xl border border-rose-200/60 bg-rose-50/30 p-8 shadow-sm dark:border-rose-900/30 dark:bg-rose-900/10">
                            <h3 class="mb-4 flex items-center gap-3 text-xl font-bold text-rose-800 dark:text-rose-300">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                Problématique
                            </h3>
                            <div class="fi-prose max-w-none text-zinc-700 dark:text-zinc-300">
                                {!! $project->renderRichContent('problematic') !!}
                            </div>
                        </div>
                    @endif

                    @if ($project->solution)
                        <div
                            class="rounded-2xl border border-emerald-200/60 bg-emerald-50/30 p-8 shadow-sm dark:border-emerald-900/30 dark:bg-emerald-900/10">
                            <h3
                                class="mb-4 flex items-center gap-3 text-xl font-bold text-emerald-800 dark:text-emerald-300">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                    </path>
                                </svg>
                                Solution technique
                            </h3>
                            <div class="fi-prose max-w-none text-zinc-700 dark:text-zinc-300">
                                {!! $project->renderRichContent('solution') !!}
                            </div>
                        </div>
                    @endif

                    @if ($project->results)
                        <div
                            class="rounded-2xl border border-indigo-200/60 bg-indigo-50/30 p-8 shadow-sm dark:border-indigo-900/30 dark:bg-indigo-900/10">
                            <h3
                                class="mb-4 flex items-center gap-3 text-xl font-bold text-indigo-800 dark:text-indigo-300">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                Résultats & Impact
                            </h3>
                            <div class="fi-prose max-w-none text-zinc-700 dark:text-zinc-300">
                                {!! $project->renderRichContent('results') !!}
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            @script
                <script>
                    hljs.highlightAll();
                </script>
            @endscript

            {{-- Galerie --}}
            @if ($this->galleryImages->isNotEmpty())
                @php
                    $galleryJson = json_encode(
                        $this->galleryImages->values()->toArray(),
                        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                    );
                @endphp

                <div wire:cloak x-data="{ shown: false }" x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    class="mt-16 transition-all duration-700 ease-out">

                    {{-- En-tête de section --}}
                    <div
                        class="mb-6 flex items-center justify-between border-b border-zinc-200 pb-3 dark:border-zinc-800">
                        <h3 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">Galerie</h3>
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">
                            {{ $this->galleryImages->count() }}
                            {{ $this->galleryImages->count() > 1 ? 'médias' : 'média' }}
                        </span>
                    </div>

                    {{-- Composant carousel gallery --}}
                    <div x-data="{
                        images: {{ $galleryJson }},
                        lightboxOpen: false,
                        activeIndex: 0,
                        get activeImage() { return this.images[this.activeIndex]; },
                        open(index) {
                            this.activeIndex = index;
                            this.lightboxOpen = true;
                            document.body.style.overflow = 'hidden';
                        },
                        close() {
                            this.lightboxOpen = false;
                            document.body.style.overflow = '';
                        },
                        prev() { this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length; },
                        next() { this.activeIndex = (this.activeIndex + 1) % this.images.length; },
                    }" @keydown.escape.window="close()"
                        @keydown.arrow-left.window="lightboxOpen && prev()"
                        @keydown.arrow-right.window="lightboxOpen && next()">

                        {{-- Grille de miniatures --}}
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:gap-4">
                            @foreach ($this->galleryImages as $index => $image)
                                <button type="button" @click="open({{ $index }})"
                                    class="group relative aspect-square cursor-zoom-in overflow-hidden border border-zinc-200/50 bg-zinc-100 transition-all duration-300 hover:border-emerald-300 hover:shadow-md hover:shadow-emerald-500/10 dark:border-zinc-700/50 dark:bg-zinc-800 dark:hover:border-emerald-600">
                                    <img loading="eager" decoding="async" src="{{ $image['thumb'] }}"
                                        alt="{{ $image['alt'] }}"
                                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">

                                    {{-- Overlay dégradé --}}
                                    <div
                                        class="absolute inset-0 bg-linear-to-t from-zinc-950/65 via-zinc-950/10 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                    </div>

                                    {{-- Titre + zoom icon --}}
                                    <div
                                        class="absolute inset-x-0 bottom-0 flex translate-y-2 flex-col gap-1 p-3 opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                        @if ($image['title'])
                                            <p class="truncate text-xs font-semibold text-white drop-shadow">
                                                {{ $image['title'] }}</p>
                                        @endif
                                        <div class="flex items-center gap-1.5">
                                            <span
                                                class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500/80 text-white backdrop-blur-sm">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                            </span>
                                            <span class="text-2xs font-medium text-white/80">Agrandir</span>
                                        </div>
                                    </div>

                                    {{-- Compteur --}}
                                    <span
                                        class="absolute top-2 right-2 rounded-full bg-zinc-900/50 px-2 py-0.5 text-2xs font-mono text-white/60 backdrop-blur-sm">{{ $index + 1 }}/{{ $this->galleryImages->count() }}</span>
                                </button>
                            @endforeach
                        </div>

                        {{-- Lightbox Carousel --}}
                        <template x-teleport="body">
                            <div x-show="lightboxOpen" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="fixed inset-0 z-200 flex flex-col bg-zinc-950/97 backdrop-blur-sm" wire:cloak>

                                {{-- Barre supérieure --}}
                                <div
                                    class="flex shrink-0 items-center justify-between border-b border-white/10 px-4 py-3 sm:px-6">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="rounded-full bg-emerald-500/20 px-3 py-1 text-xs font-semibold text-emerald-400">
                                            Galerie — <span x-text="activeIndex + 1"></span>/<span
                                                x-text="images.length"></span>
                                        </span>
                                        <p class="hidden truncate text-sm font-medium text-white sm:block max-w-xs"
                                            x-text="activeImage?.title || ''"></p>
                                    </div>
                                    <button @click="close()"
                                        class="flex h-9 w-9 items-center justify-center rounded-full border border-white/10 bg-white/5 text-white transition hover:bg-white/15 hover:border-white/20"
                                        aria-label="Fermer">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- Zone image principale --}}
                                <div
                                    class="relative flex flex-1 items-center justify-center overflow-hidden px-14 py-4 sm:px-20">

                                    {{-- Précédent --}}
                                    <button @click="prev()"
                                        class="absolute left-3 z-10 flex h-11 w-11 items-center justify-center rounded-full border border-white/10 bg-white/5 text-white transition hover:bg-emerald-500/30 hover:border-emerald-500/50 hover:scale-105 sm:left-5"
                                        aria-label="Image précédente">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>

                                    {{-- Image + texte --}}
                                    <div class="flex max-h-full max-w-5xl flex-col items-center gap-5">
                                        <div class="relative overflow-hidden rounded-sm">
                                            <img :src="activeImage?.url" :alt="activeImage?.alt || ''"
                                                class="max-h-[58vh] w-auto max-w-full object-contain sm:max-h-[63vh]"
                                                x-transition:enter="transition ease-out duration-250"
                                                x-transition:enter-start="opacity-0 scale-97"
                                                x-transition:enter-end="opacity-100 scale-100">
                                        </div>

                                        {{-- Titre + Description --}}
                                        <div class="w-full max-w-2xl text-center"
                                            x-show="activeImage?.title || activeImage?.description"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 translate-y-2"
                                            x-transition:enter-end="opacity-100 translate-y-0">
                                            <p class="text-base font-semibold text-white" x-text="activeImage?.title">
                                            </p>
                                            <p class="mt-1 text-sm leading-relaxed text-zinc-400"
                                                x-text="activeImage?.description" x-show="activeImage?.description">
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Suivant --}}
                                    <button @click="next()"
                                        class="absolute right-3 z-10 flex h-11 w-11 items-center justify-center rounded-full border border-white/10 bg-white/5 text-white transition hover:bg-emerald-500/30 hover:border-emerald-500/50 hover:scale-105 sm:right-5"
                                        aria-label="Image suivante">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- Bande de miniatures + raccourcis --}}
                                <div class="shrink-0 border-t border-white/10 bg-zinc-900/60 px-4 py-3">
                                    <div class="flex items-center justify-center gap-2 overflow-x-auto pb-1">
                                        <template x-for="(img, i) in images" :key="i">
                                            <button type="button" @click="activeIndex = i"
                                                :class="activeIndex === i ?
                                                    'opacity-100 scale-105' :
                                                    'opacity-40 hover:opacity-75'"
                                                class="relative h-14 w-14 shrink-0 overflow-hidden rounded-md transition-all duration-200">
                                                <img :src="img.thumb" :alt="img.alt || ''"
                                                    class="h-full w-full object-cover">
                                            </button>
                                        </template>
                                    </div>
                                    <p class="mt-2 text-center text-2xs text-zinc-600">← → pour naviguer · <kbd
                                            class="rounded bg-zinc-800 px-1 py-0.5 font-mono text-zinc-400">Esc</kbd>
                                        pour fermer</p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ==================== DOCUMENTS PDF ==================== --}}
    @if ($project->hasPdf())
        <div wire:cloak x-data="{ shown: false }" x-intersect.once="shown = true"
            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="mt-24 transition-all duration-1000 delay-300 ease-out">

            <div class="mb-8 flex items-center justify-between border-b border-zinc-200 pb-4 dark:border-zinc-800">
                <h3 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                    <span class="inline-flex items-center gap-3">
                        <svg class="h-7 w-7 text-emerald-600 dark:text-emerald-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Documents du projet
                    </span>
                </h3>
                <span
                    class="rounded-full bg-zinc-100 px-3 py-1 text-sm font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                    {{ $project->getMedia('documents')->count() }} PDF
                </span>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($project->getMedia('documents') as $pdf)
                    <x-pdf-viewer :pdfUrl="$pdf->getUrl()"
                        label="{{ $pdf->name ?? ($pdf->file_name ?? 'Lire le document') }}"
                        modalTitle="{{ $pdf->name ?? ($pdf->file_name ?? 'Document PDF') }}"
                        buttonClass="group flex items-center gap-3 rounded-xl border border-zinc-200/60 bg-white/50 p-4 transition-all duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:bg-emerald-50/50 hover:shadow-lg hover:shadow-emerald-500/10 dark:border-zinc-800/60 dark:bg-zinc-900/50 dark:hover:border-emerald-700 dark:hover:bg-emerald-900/20">
                        <template x-slot:icon>
                            <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </template>
                        <span
                            class="flex-1 text-sm font-medium text-zinc-900 dark:text-white truncate">{{ $pdf->name ?? ($pdf->file_name ?? 'Document') }}</span>
                        <span class="text-xs text-zinc-400 dark:text-zinc-500">{{ round($pdf->size / 1024) }}
                            KB</span>
                    </x-pdf-viewer>
                @endforeach
            </div>
        </div>
    @endif
</div>
