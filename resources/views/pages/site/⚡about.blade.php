<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Settings\AboutSettings;
use App\Concerns\Traits\HasImageUrl;

new #[Layout('layouts::main')] class extends Component {
    use HasImageUrl;

    #[Computed]
    public function about(): AboutSettings
    {
        return app(AboutSettings::class);
    }
};
?>

<div>
    {{-- ========== HERO ABOUT – Responsive, image en arrière-plan sur mobile/tablette ========== --}}
    <section x-cloak class="relative overflow-hidden bg-slate-900 dark:bg-zinc-950" x-data="aboutHeroReveal">
        @php
            $heroImage =
                $this->imageUrl($this->about->hero_image_url) ?: $this->imageUrl('images/gaudev-hero.png');
        @endphp

        {{-- Image de fond visible uniquement sur mobile/tablette (overlay pour lisibilité) --}}
        <img x-ref="bgImage" src="{{ $heroImage }}" alt="Portrait de Gauthier Lobanga"
            class="absolute inset-0 h-full w-full object-cover lg:hidden" />
        <div class="absolute inset-0 bg-slate-900/70 dark:bg-zinc-950/70 backdrop-blur lg:hidden"></div>

        <div class="relative flex flex-col lg:flex-row lg:min-h-[50svh] max-w-7xl mx-auto">
            {{-- Colonne texte (toujours à gauche sur desktop) --}}
            <div
                class="flex items-center justify-center lg:justify-start w-full lg:w-1/2 px-6 py-12 lg:py-16 lg:px-12 order-1 lg:order-1">
                <div class="w-full max-w-xl">
                    <div x-ref="badge"
                        class="inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-4 py-2 backdrop-blur">
                        <span class="flex h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                        <span class="text-sm font-medium tracking-wide text-zinc-200">
                            {{ $this->about->hero_badge ?: 'Développeur Full‑Stack' }}
                        </span>
                    </div>

                    <h1 x-ref="title"
                        class="mt-8 text-5xl md:text-7xl font-extrabold tracking-tight text-white leading-tight">
                        {{ $this->about->hero_title ?: 'À propos de moi' }}
                    </h1>

                    <div x-ref="author" class="mt-4 flex items-center gap-3">
                        <div class="h-px w-16 bg-emerald-500/80"></div>
                        <p class="text-2xl font-extrabold tracking-tight text-emerald-300 lg:text-3xl">
                            Gauthier Lobanga
                        </p>
                        <div class="h-px w-16 bg-emerald-500/80 hidden sm:block"></div>
                    </div>

                    <p x-ref="subtitle" class="mt-8 text-xl leading-7 text-zinc-300 md:text-2xl">
                        {{ $this->about->hero_subtitle ?: 'Développeur web passionné, spécialisé TALL stack, React, Inertia.js et Filament.' }}
                    </p>

                    <div x-ref="buttons" class="mt-10 flex flex-col sm:flex-row items-center gap-5">
                        <a href="{{ route('projects.index') }}" wire:navigate
                            class="group relative inline-flex h-14 items-center justify-center border border-emerald-600 bg-emerald-600 px-8 font-semibold text-white transition-all duration-300 hover:bg-emerald-700 hover:border-emerald-700 active:scale-[0.97] text-lg">
                            <span class="flex items-center gap-2.5">
                                Découvrir mes projets
                                <svg class="h-5 w-5 transition-transform group-hover:translate-x-1.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </span>
                        </a>
                        <a href="{{ route('contact') }}" wire:navigate
                            class="group relative inline-flex h-14 items-center justify-center border border-zinc-500/50 px-8 font-semibold text-white transition-all duration-300 hover:bg-white/10 active:scale-[0.97] text-lg">
                            <span class="flex items-center gap-2.5">
                                Me contacter
                                <svg class="h-5 w-5 transition-transform group-hover:translate-x-1.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <div x-ref="decoLine" class="mt-12 h-0.5 w-0 bg-gradient-to-r from-emerald-500 to-transparent">
                    </div>
                </div>
            </div>

            {{-- Colonne image (uniquement visible sur desktop) --}}
            <div class="hidden lg:flex w-full lg:w-1/2 order-2 lg:order-2 items-end justify-center lg:justify-end">
                <img src="{{ $heroImage }}" alt="Portrait de Gauthier Lobanga"
                    class="max-h-[50vh] lg:max-h-full w-auto object-contain mx-auto lg:mx-0" />
            </div>
        </div>
    </section>

    {{-- ========== À PROPOS ========== --}}
    <section id="about" x-cloak class="relative overflow-hidden bg-white dark:bg-zinc-950 py-24">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute left-0 top-0 h-128 w-lg rounded-full bg-emerald-500/5 blur-[140px] transform-gpu">
            </div>
            <div class="absolute right-0 bottom-0 h-112 w-md rounded-full bg-teal-500/5 blur-[140px] transform-gpu">
            </div>
        </div>

        <div x-data="aboutQuoteReveal" class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- Bloc principal --}}
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-16 items-center mb-24">
                {{-- Texte --}}
                <div x-cloak class="max-w-3xl" x-data="cspState" x-intersect="shown = true">
                    <span
                        class="inline-flex items-center rounded-full border border-emerald-500/20 bg-emerald-500/10 px-4 py-2 text-sm font-medium text-emerald-700 dark:text-emerald-400 backdrop-blur-sm transition-all duration-700 ease-out"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        {{ $this->about->hero_badge ?: 'Développeur Full‑Stack' }}
                    </span>

                    <h2 class="mt-6 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white lg:text-5xl transition-all duration-700 delay-100 ease-out"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                        {{ $this->about->hero_title ?: 'À propos de moi' }}
                    </h2>

                    <div class="mt-8 prose prose-lg prose-zinc dark:prose-invert max-w-none transition-all duration-700 delay-200 ease-out"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                        @php $aboutBlocks = $this->about->aboutBlocks(); @endphp
                        @if (!empty($aboutBlocks))
                            @foreach ($aboutBlocks as $block)
                                @if (!empty($block['title']))
                                    <h3>{{ $block['title'] }}</h3>
                                @endif
                                @if (!empty($block['description']))
                                    @if (is_array($block['description']) && isset($block['description']['type']))
                                        {!! new \Tiptap\Editor()->setContent($block['description'])->getHTML() !!}
                                    @else
                                        {!! $block['description'] !!}
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <p>Je suis un développeur web full‑stack basé en RDC, spécialisé dans la création
                                d’applications web modernes avec <strong>Laravel, Livewire, Alpine.js, Tailwind CSS,
                                    Filament, React et Inertia.js</strong>.</p>
                            <p>Passionné par le code propre et les solutions performantes, j’accompagne mes clients de
                                l’analyse du besoin jusqu’à la mise en production, en passant par la conception d’APIs
                                robustes et la création de tableaux de bord intuitifs.</p>
                            <p>Curieux et autodidacte, je me tiens constamment à jour des dernières évolutions du
                                développement web. Mon objectif : fournir des outils numériques de qualité qui aident
                                les entreprises et les particuliers à atteindre leurs objectifs.</p>
                        @endif
                    </div>
                </div>

                {{-- Image --}}
                <div x-cloak class="relative" x-data="{ shown: false }" x-intersect="shown = true">
                    <div class="relative overflow-hidden transition-all duration-1000 delay-300 ease-out"
                        :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'">
                        @php $aboutImage = $aboutBlocks[0]['image_url'] ?? $this->about->about_image_url ?? null; @endphp
                        <img src="{{ $aboutImage ? $this->imageUrl($aboutImage) : $this->imageUrl('images/gauthier-lobanga.jpg') }}"
                            alt="Gauthier Lobanga" class="w-full h-full object-contain aspect-4/3" />
                        <div class="absolute inset-0 ring-1 ring-inset ring-zinc-900/10 dark:ring-white/10"></div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 -z-10 transition-all duration-1000 delay-500 ease-out"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                        <svg class="w-32 h-32 text-emerald-500/20" fill="currentColor" viewBox="0 0 100 100">
                            <pattern id="dots" x="0" y="0" width="20" height="20"
                                patternUnits="userSpaceOnUse">
                                <circle cx="2" cy="2" r="2" />
                            </pattern>
                            <rect width="100" height="100" fill="url(#dots)" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Vision --}}
            @php $visionBlocks = $this->about->visionBlocks(); @endphp
            <div x-cloak x-data="cspState" x-intersect="shown = true"
                class="mt-20 grid gap-12 lg:grid-cols-2 lg:items-center overflow-hidden">
                <div class="relative order-2 lg:order-1 transition-all duration-1200 ease-out delay-100"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-16'">
                    <div class="overflow-hidden border border-zinc-200/60 dark:border-white/10">
                        @php $visionImage = $visionBlocks[0]['image_url'] ?? $this->about->about_image_url ?? null; @endphp
                        <img src="{{ $visionImage ? $this->imageUrl($visionImage) : $this->imageUrl('images/gauthier-lobanga.jpg') }}"
                            alt="Vision" class="aspect-4/3 w-full object-cover">
                    </div>
                </div>
                <div class="order-1 lg:order-2 space-y-6 lg:pl-10 transition-all duration-1200 ease-out delay-300"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">Ma vision</h3>
                    </div>
                    <div class="prose prose-lg prose-zinc dark:prose-invert max-w-none">
                        @if (!empty($visionBlocks))
                            @foreach ($visionBlocks as $block)
                                @if (!empty($block['title']))
                                    <h4>{{ $block['title'] }}</h4>
                                @endif
                                @if (!empty($block['description']))
                                    @if (is_array($block['description']) && isset($block['description']['type']))
                                        {!! new \Tiptap\Editor()->setContent($block['description'])->getHTML() !!}
                                    @else
                                        {!! $block['description'] !!}
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <p>Je crois fermement que le code bien écrit est un levier puissant pour résoudre des
                                problèmes réels. Mon ambition est de rendre la technologie accessible à tous, en
                                proposant des solutions sur mesure, durables et évolutives, quel que soit le budget ou
                                le secteur d’activité.</p>
                            <p>Je m’engage à rester à l’écoute, à communiquer de manière transparente et à livrer un
                                travail de qualité qui dépasse les attentes.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Mission --}}
            @php $missionBlocks = $this->about->missionBlocks(); @endphp
            <div x-cloak x-data="cspState" x-intersect="shown = true"
                class="mt-32 grid gap-12 lg:grid-cols-2 lg:items-center overflow-hidden">
                <div class="order-1 space-y-6 lg:pr-10 transition-all duration-1200 ease-out delay-100"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-16'">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-500/10 text-teal-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">Ma mission</h3>
                    </div>
                    <div class="prose prose-lg prose-zinc dark:prose-invert max-w-none">
                        @if (!empty($missionBlocks))
                            @foreach ($missionBlocks as $block)
                                @if (!empty($block['title']))
                                    <h4>{{ $block['title'] }}</h4>
                                @endif
                                @if (!empty($block['description']))
                                    @if (is_array($block['description']) && isset($block['description']['type']))
                                        {!! new \Tiptap\Editor()->setContent($block['description'])->getHTML() !!}
                                    @else
                                        {!! $block['description'] !!}
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <p>Ma mission est d’aider les entrepreneurs, les PME et les ONG à se digitaliser
                                efficacement. Je mets mes compétences en développement web au service de projets qui ont
                                du sens, en apportant des solutions pragmatiques, sécurisées et esthétiques.</p>
                            <p>À travers mes formations et mes articles de blog, je partage mes connaissances pour
                                contribuer à l’émergence d’une nouvelle génération de développeurs en Afrique et
                                au‑delà.</p>
                        @endif
                    </div>
                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('projects.index') }}" wire:navigate
                            class="inline-flex h-14 items-center justify-center border-2 border-emerald-500 bg-emerald-500 px-8 font-semibold text-white transition hover:bg-emerald-600 active:scale-[0.97]">
                            Voir mes projets
                        </a>
                        <a href="{{ route('contact') }}" wire:navigate
                            class="inline-flex h-14 items-center justify-center border border-zinc-300 dark:border-zinc-600 px-8 font-semibold text-zinc-900 dark:text-white transition hover:bg-zinc-100 dark:hover:bg-zinc-800 active:scale-[0.97]">
                            Me contacter
                        </a>
                    </div>
                </div>
                <div class="relative order-2 transition-all duration-1200 ease-out delay-300"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'">
                    <div class="overflow-hidden border border-zinc-200/60 dark:border-white/10">
                        @php $missionImage = $missionBlocks[0]['image_url'] ?? $this->about->about_image_url ?? null; @endphp
                        <img src="{{ $missionImage ? $this->imageUrl($missionImage) : $this->imageUrl('images/gauthier-lobanga.jpg') }}"
                            alt="Mission" class="aspect-4/3 w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
