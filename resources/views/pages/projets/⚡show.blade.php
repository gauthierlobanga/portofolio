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

        $imageUrl = $this->project->getFirstMediaUrl('featured') ?: asset('images/logo-app.svg');
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
                'url'   => $media->getUrl(),
                'thumb' => $media->hasGeneratedConversion('thumb') ? $media->getUrl('thumb') : $media->getUrl(),
                'title' => $media->getCustomProperty('title') ?: $media->name,
                'description' => $media->getCustomProperty('description') ?: '',
                'alt'   => $media->getCustomProperty('alt') ?: ($this->project->title . ' – ' . ($media->name ?: 'Galerie')),
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

<div class="relative min-h-screen bg-white dark:bg-zinc-950">
    {{-- Decorative Backgrounds --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 right-0 h-120 w-120 rounded-full bg-emerald-500/10 blur-[120px] transform-gpu">
        </div>
        <div class="absolute -left-40 top-40 h-100 w-100 rounded-full bg-teal-500/10 blur-[120px] transform-gpu"></div>
    </div>

    {{-- Hero Section Projet --}}
    <section wire:cloak class="relative flex min-h-[70vh] items-center overflow-hidden" x-data="projectShowHeroReveal()">

        {{-- Background Image --}}
        <div x-ref="bg" class="absolute inset-0">
            @if ($project->hasMedia('cover'))
                <img fetchpriority="high" loading="eager" src="{{ $project->getFirstMediaUrl('cover') }}" alt="{{ $project->title }}"
                    class="h-full w-full object-cover origin-center" loading="eager">
            @else
                <div class="h-full w-full bg-linear-to-br from-zinc-100 to-zinc-200 dark:from-zinc-900 dark:to-zinc-950"></div>
            @endif

            {{-- Overlay Moderne (Adaptatif Light/Dark) --}}
            <div class="absolute inset-0 dark:bg-zinc-950/70"></div>
            <div class="absolute inset-0 bg-linear-to-b from-white/80 via-white/40 to-white/90 dark:from-zinc-950/80 dark:via-zinc-950/40 dark:to-zinc-950/90"></div>

            {{-- Accents lumineux émeraude --}}
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(16,185,129,0.15),transparent_50%)] dark:bg-[radial-gradient(circle_at_top_left,rgba(16,185,129,0.25),transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,rgba(20,184,166,0.10),transparent_50%)] dark:bg-[radial-gradient(circle_at_bottom_right,rgba(20,184,166,0.15),transparent_50%)]"></div>

            {{-- Effet de texture (grain léger) --}}
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>
        </div>

        {{-- Contenu --}}
        <div class="relative z-10 mx-auto max-w-5xl px-6 pt-20 pb-16 text-center lg:px-8">
            {{-- Badges --}}
            <div x-ref="badges" class="mb-8 flex flex-wrap items-center justify-center gap-3">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-1.5 text-sm font-medium text-emerald-700 backdrop-blur-sm dark:border-emerald-400/30 dark:bg-emerald-500/20 dark:text-emerald-200">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                    </span>
                    {{ $project->status === 'completed' ? 'Terminé' : ($project->status === 'ongoing' ? 'En cours' : 'Planifié') }}
                </span>

                @if ($project->location)
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white/50 px-4 py-1.5 text-sm font-medium text-zinc-700 backdrop-blur-sm dark:border-white/10 dark:bg-white/10 dark:text-zinc-200">
                        <svg class="h-4 w-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $project->location }}
                    </span>
                @endif

                @if ($project->tags->isNotEmpty())
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white/50 px-4 py-1.5 text-sm font-medium text-zinc-700 backdrop-blur-sm dark:border-white/10 dark:bg-white/10 dark:text-zinc-200">
                        <svg class="h-4 w-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        {{ $project->tags->first()->name }}
                    </span>
                @endif
            </div>

            {{-- Titre --}}
            <h1 class="mx-auto max-w-4xl text-4xl font-extrabold tracking-tight text-zinc-900 drop-shadow-sm sm:text-5xl lg:text-7xl leading-tighter dark:text-white dark:drop-shadow-xl">
                {{ $project->title }}
            </h1>

            {{-- Sous-titre --}}
            @if ($project->excerpt)
                <div x-ref="subtitle"
                    class="mx-auto mt-6 max-w-2xl text-lg font-light leading-relaxed text-zinc-600 sm:text-xl dark:text-zinc-300 dark:drop-shadow-md">
                    {!! $project->renderRichContent('excerpt') !!}
                </div>
            @endif

            {{-- Meta --}}
            <div x-ref="meta"
                class="mt-10 flex flex-wrap items-center justify-center gap-x-8 gap-y-3 text-sm font-medium">
                @if ($project->start_date)
                    <div
                        class="flex items-center gap-2.5 rounded-full border border-zinc-200 bg-white/50 px-4 py-2 backdrop-blur-sm dark:border-white/10 dark:bg-white/5">
                        <svg class="h-4.5 w-4.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-zinc-600 dark:text-zinc-300">Début : <span
                                class="font-semibold text-zinc-900 dark:text-white">{{ $project->start_date->translatedFormat('F Y') }}</span></span>
                    </div>
                @endif
                @if ($project->end_date)
                    <div
                        class="flex items-center gap-2.5 rounded-full border border-zinc-200 bg-white/50 px-4 py-2 backdrop-blur-sm dark:border-white/10 dark:bg-white/5">
                        <svg class="h-4.5 w-4.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-zinc-600 dark:text-zinc-300">Fin : <span
                                class="font-semibold text-zinc-900 dark:text-white">{{ $project->end_date->translatedFormat('F Y') }}</span></span>
                    </div>
                @endif

            </div>
        </div>
    </section>

    {{-- Contenu & Galerie --}}
    <section class="relative py-20 lg:py-32">
        <div class="mx-auto max-w-4xl px-6 lg:px-8">
            {{-- Contenu Prose --}}
            <div wire:cloak x-data="{ shown: false }" x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="fi-prose max-w-none transition-all duration-1000 ease-out
                        bg-white/50 dark:bg-zinc-900/50 backdrop-blur-xl p-8 md:p-12 w-full">
                {!! $project->renderRichContent('content') !!}
            </div>

            {{-- Galerie --}}
            @if ($this->galleryImages->isNotEmpty())
                @php
                    $galleryJson = json_encode($this->galleryImages->values()->toArray(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                @endphp

                <div wire:cloak x-data="{ shown: false }" x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    class="mt-16 transition-all duration-700 ease-out">

                    {{-- En-tête de section --}}
                    <div class="mb-6 flex items-center justify-between border-b border-zinc-200 pb-3 dark:border-zinc-800">
                        <h3 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">Galerie</h3>
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">
                            {{ $this->galleryImages->count() }}
                            {{ $this->galleryImages->count() > 1 ? 'médias' : 'média' }}
                        </span>
                    </div>

                    {{-- Composant carousel gallery --}}
                    <div
                        x-data="{
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
                        }"
                        @keydown.escape.window="close()"
                        @keydown.arrow-left.window="lightboxOpen && prev()"
                        @keydown.arrow-right.window="lightboxOpen && next()">

                        {{-- Grille de miniatures --}}
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:gap-4">
                            @foreach ($this->galleryImages as $index => $image)
                                <button type="button" @click="open({{ $index }})"
                                    class="group relative aspect-square cursor-zoom-in overflow-hidden border border-zinc-200/50 bg-zinc-100 transition-all duration-300 hover:border-emerald-300 hover:shadow-md hover:shadow-emerald-500/10 dark:border-zinc-700/50 dark:bg-zinc-800 dark:hover:border-emerald-600">
                                    <img loading="eager" decoding="async"
                                        src="{{ $image['thumb'] }}"
                                        alt="{{ $image['alt'] }}"
                                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">

                                    {{-- Overlay dégradé --}}
                                    <div class="absolute inset-0 bg-linear-to-t from-zinc-950/65 via-zinc-950/10 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                                    {{-- Titre + zoom icon --}}
                                    <div class="absolute inset-x-0 bottom-0 flex translate-y-2 flex-col gap-1 p-3 opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                        @if ($image['title'])
                                            <p class="truncate text-xs font-semibold text-white drop-shadow">{{ $image['title'] }}</p>
                                        @endif
                                        <div class="flex items-center gap-1.5">
                                            <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500/80 text-white backdrop-blur-sm">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                            </span>
                                            <span class="text-2xs font-medium text-white/80">Agrandir</span>
                                        </div>
                                    </div>

                                    {{-- Compteur --}}
                                    <span class="absolute top-2 right-2 rounded-full bg-zinc-900/50 px-2 py-0.5 text-2xs font-mono text-white/60 backdrop-blur-sm">{{ $index + 1 }}/{{ $this->galleryImages->count() }}</span>
                                </button>
                            @endforeach
                        </div>

                        {{-- Lightbox Carousel --}}
                        <template x-teleport="body">
                            <div x-show="lightboxOpen"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="fixed inset-0 z-200 flex flex-col bg-zinc-950/97 backdrop-blur-sm"
                                wire:cloak>

                                {{-- Barre supérieure --}}
                                <div class="flex shrink-0 items-center justify-between border-b border-white/10 px-4 py-3 sm:px-6">
                                    <div class="flex items-center gap-3">
                                        <span class="rounded-full bg-emerald-500/20 px-3 py-1 text-xs font-semibold text-emerald-400">
                                            Galerie — <span x-text="activeIndex + 1"></span>/<span x-text="images.length"></span>
                                        </span>
                                        <p class="hidden truncate text-sm font-medium text-white sm:block max-w-xs" x-text="activeImage?.title || ''"></p>
                                    </div>
                                    <button @click="close()"
                                        class="flex h-9 w-9 items-center justify-center rounded-full border border-white/10 bg-white/5 text-white transition hover:bg-white/15 hover:border-white/20"
                                        aria-label="Fermer">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- Zone image principale --}}
                                <div class="relative flex flex-1 items-center justify-center overflow-hidden px-14 py-4 sm:px-20">

                                    {{-- Précédent --}}
                                    <button @click="prev()"
                                        class="absolute left-3 z-10 flex h-11 w-11 items-center justify-center rounded-full border border-white/10 bg-white/5 text-white transition hover:bg-emerald-500/30 hover:border-emerald-500/50 hover:scale-105 sm:left-5"
                                        aria-label="Image précédente">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>

                                    {{-- Image + texte --}}
                                    <div class="flex max-h-full max-w-5xl flex-col items-center gap-5">
                                        <div class="relative overflow-hidden rounded-sm">
                                            <img :src="activeImage?.url"
                                                :alt="activeImage?.alt || ''"
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
                                            <p class="text-base font-semibold text-white" x-text="activeImage?.title"></p>
                                            <p class="mt-1 text-sm leading-relaxed text-zinc-400" x-text="activeImage?.description" x-show="activeImage?.description"></p>
                                        </div>
                                    </div>

                                    {{-- Suivant --}}
                                    <button @click="next()"
                                        class="absolute right-3 z-10 flex h-11 w-11 items-center justify-center rounded-full border border-white/10 bg-white/5 text-white transition hover:bg-emerald-500/30 hover:border-emerald-500/50 hover:scale-105 sm:right-5"
                                        aria-label="Image suivante">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- Bande de miniatures + raccourcis --}}
                                <div class="shrink-0 border-t border-white/10 bg-zinc-900/60 px-4 py-3">
                                    <div class="flex items-center justify-center gap-2 overflow-x-auto pb-1">
                                        <template x-for="(img, i) in images" :key="i">
                                            <button type="button" @click="activeIndex = i"
                                                :class="activeIndex === i
                                                    ? 'ring-2 ring-emerald-400 ring-offset-2 ring-offset-zinc-950 opacity-100 scale-105'
                                                    : 'opacity-40 hover:opacity-75'"
                                                class="relative h-14 w-14 shrink-0 overflow-hidden rounded-md transition-all duration-200">
                                                <img :src="img.thumb" :alt="img.alt || ''" class="h-full w-full object-cover">
                                            </button>
                                        </template>
                                    </div>
                                    <p class="mt-2 text-center text-2xs text-zinc-600">← → pour naviguer · <kbd class="rounded bg-zinc-800 px-1 py-0.5 font-mono text-zinc-400">Esc</kbd> pour fermer</p>
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

