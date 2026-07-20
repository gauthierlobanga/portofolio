<?php

use Livewire\Component;
use App\Models\Service;
use App\Models\Project;
use App\Models\Post;
use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Cache;
use App\Settings\AboutSettings;
use App\Settings\SettingApp;
use Illuminate\Support\Facades\Storage;
use App\Concerns\Traits\HasImageUrl;

new #[Layout('layouts::main')] class extends Component {
    use HasImageUrl;

    #[Computed]
    public function about(): AboutSettings
    {
        return app(AboutSettings::class);
    }

    #[Computed]
    public function settings(): SettingApp
    {
        return app(SettingApp::class);
    }

    #[Computed]
    public function projects()
    {
        return Cache::remember(
            'home_projects',
            3600,
            fn() => Project::with('media')
                ->active()
                ->whereIn('status', ['ongoing', 'completed'])
                ->latest('start_date')
                ->limit(3)
                ->get(),
        );
    }

    #[Computed]
    public function posts()
    {
        return Cache::remember(
            'home_posts',
            3600,
            fn() => Post::with(['user', 'categories'])
                ->published()
                ->latest('published_at')
                ->limit(3)
                ->get(),
        );
    }

    #[Computed]
    public function testimonials()
    {
        return Cache::remember('home_testimonials', 3600, fn() => Testimonial::active()->latest()->limit(3)->get());
    }

    #[Computed]
    public function stats()
    {
        return Cache::remember(
            'home_stats',
            7200,
            fn() => [
                'projects' => Project::active()->count(),
                'posts' => Post::published()->count(),
                'testimonials' => Testimonial::active()->count(),
                'services' => Service::active()->count(),
            ],
        );
    }

    public function rendering(\Illuminate\View\View $view): void
    {
        $view->title('Accueil');

        // Récupération des réseaux sociaux pour le schema
        $settings = $this->settings;
        $sameAs = array_filter([$settings->facebook_url, $settings->instagram_url, $settings->x_url, $settings->linkedin_url, $settings->youtube_url]);

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Gauthier Lobanga',
            'url' => url('/'),
            'image' => $this->about->hero_image_url ? $this->imageUrl($this->about->hero_image_url) : $this->imageUrl('images/gaudev-hero.png'),
            'description' => 'Gauthier Lobanga – Développeur Web Full‑Stack spécialisé Laravel, TALL stack (Tailwind CSS, Alpine.js, Livewire, Laravel), React (Starter Kit) et Inertia.js. Architecture moderne avec Filament, API robustes et interfaces performantes. Découvrez mon portfolio, mes projets et mon savoir‑faire.',
            'sameAs' => $sameAs,
        ];

        $view->layoutData([
            'seoDescription' => 'Gauthier Lobanga – Développeur Web Full‑Stack spécialisé Laravel, TALL stack (Tailwind CSS, Alpine.js, Livewire, Laravel), React (Starter Kit) et Inertia.js. Bienvenue sur mon portfolio professionnel.',
            'seoKeywords' => ['Gauthier Lobanga', 'portfolio', 'développeur web', 'TALL stack', 'Filament', 'Laravel', 'Livewire', 'RDC', 'React', 'Inertia.js', 'développement web', 'projets web', 'services web', 'front-end', 'back-end', 'full-stack', 'web design', 'web development', 'web applications', 'web solutions', 'web services', 'formation web', 'web tutorials', 'web resources', 'web technologies', 'web programming', 'web frameworks', 'web tools', 'web optimization', 'web performance', 'web security', 'web accessibility'],
            'schema' => '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>',
        ]);
    }
};
?>

<div class="bg-white text-zinc-700 antialiased dark:bg-zinc-950 dark:text-zinc-300">

    {{-- ========== HERO ACCUEIL UNIFIÉ – Plus de duplication, animations OK ========== --}}
    <section x-cloak class="relative overflow-hidden bg-slate-900 dark:bg-zinc-950" x-data="homeHeroReveal">
        @php
            $heroImage = $this->about->hero_image_url
                ? $this->imageUrl($this->about->hero_image_url)
                : $this->imageUrl('images/gaudev-hero.png');
            $settings = $this->settings;
        @endphp

        <div class="flex flex-col lg:flex-row lg:min-h-[50svh] max-w-7xl mx-auto">
            {{-- Texte --}}
            <div
                class="flex items-center justify-center lg:justify-start w-full lg:w-1/2 px-6 py-12 lg:py-16 lg:px-12 order-2 lg:order-1">
                <div class="w-full max-w-xl">
                    <h1 x-ref="title"
                        class="text-5xl md:text-6xl font-extrabold tracking-tight text-white leading-tight">
                        {{ $this->about->hero_title }}
                    </h1>

                    <div x-ref="author" class="mt-4 flex items-center gap-3">
                        <div class="h-px w-16 bg-emerald-500/80"></div>
                        <p class="text-2xl font-extrabold tracking-tight text-emerald-300 lg:text-3xl">
                            Full-Stack Web Developer
                        </p>
                        <div class="h-px w-16 bg-emerald-500/80 hidden sm:block"></div>
                    </div>

                    <p x-ref="subtitle" class="mt-8 text-xl leading-7 text-zinc-300 md:text-2xl">
                        {{ $this->about->hero_subtitle }}
                    </p>

                    {{-- Liens sociaux (un seul bloc) --}}
                    <div x-cloak x-data="{}" class="block">
                        <div x-data="{}" x-init="$nextTick(() => {
                            if (!$refs.socialHeader) return;
                            const tl = gsap.timeline({
                                scrollTrigger: {
                                    trigger: $refs.socialHeader,
                                    start: 'top bottom-=150px',
                                },
                            });
                            if ($refs.social_1) tl.fromTo($refs.social_1, { autoAlpha: 0, y: -20 }, { autoAlpha: 1, y: 0, duration: 0.6, ease: 'circ.out' });
                            if ($refs.social_2) tl.fromTo($refs.social_2, { autoAlpha: 0, x: -20, y: 20 }, { autoAlpha: 1, x: 0, y: 0, duration: 0.6, ease: 'circ.out' }, '>-0.5');
                            if ($refs.social_3) tl.fromTo($refs.social_3, { autoAlpha: 0, y: 20 }, { autoAlpha: 1, y: 0, duration: 0.6, ease: 'circ.out' }, '>-0.5');
                            if ($refs.social_4) tl.fromTo($refs.social_4, { autoAlpha: 0, x: 20, y: 20 }, { autoAlpha: 1, x: 0, y: 0, duration: 0.6, ease: 'circ.out' }, '>-0.5');
                            if ($refs.social_5) tl.fromTo($refs.social_5, { autoAlpha: 0, y: 20 }, { autoAlpha: 1, y: 0, duration: 0.6, ease: 'circ.out' }, '>-0.5');
                        })">
                            <ul x-ref="socialHeader"
                                class="flex items-center my-8 space-x-7 justify-center lg:justify-start">
                                @if ($settings->facebook_url)
                                    <li x-ref="social_1">
                                        <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener"
                                            class="transition duration-300 text-gray-400 opacity-80 hover:opacity-100 hover:text-blue-600 dark:hover:text-blue-400">
                                            <svg fill="currentColor" viewBox="0 0 24 24" class="h-6 w-6">
                                                <path
                                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                                @if ($settings->instagram_url)
                                    <li x-ref="social_2">
                                        <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener"
                                            class="transition duration-300 text-gray-400 opacity-80 hover:opacity-100 hover:text-pink-600 dark:hover:text-pink-400">
                                            <svg fill="currentColor" viewBox="0 0 24 24" class="h-6 w-6">
                                                <path
                                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                                @if ($settings->x_url)
                                    <li x-ref="social_3">
                                        <a href="{{ $settings->x_url }}" target="_blank" rel="noopener"
                                            class="transition duration-300 text-gray-400 opacity-80 hover:opacity-100 hover:text-black dark:hover:text-white">
                                            <svg fill="currentColor" viewBox="0 0 24 24" class="h-6 w-6">
                                                <path
                                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                                @if ($settings->linkedin_url)
                                    <li x-ref="social_4">
                                        <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener"
                                            class="transition duration-300 text-gray-400 opacity-80 hover:opacity-100 hover:text-blue-700 dark:hover:text-blue-400">
                                            <svg fill="currentColor" viewBox="0 0 24 24" class="h-6 w-6">
                                                <path
                                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                                @if ($settings->youtube_url)
                                    <li x-ref="social_5">
                                        <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener"
                                            class="transition duration-300 text-gray-400 opacity-80 hover:opacity-100 hover:text-red-600 dark:hover:text-red-400">
                                            <svg fill="currentColor" viewBox="0 0 24 24" class="h-6 w-6">
                                                <path
                                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                                <li x-ref="social_6">
                                    <a href="mailto:{{ $settings->email }}"
                                        class="transition duration-300 text-gray-400 opacity-80 hover:opacity-100 hover:text-red-500 dark:hover:text-red-400">
                                        <svg fill="currentColor" viewBox="0 0 24 24" class="h-6 w-6">
                                            <path
                                                d="M12 12.713l-11.985-9.713h23.971l-11.986 9.713zm-5.425-1.822l-6.575-5.329v12.501l6.575-7.172zm10.85 0l6.575 7.172v-12.501l-6.575 5.329zm-1.557 1.261l-3.868 3.135-3.868-3.135-8.11 8.848h23.956l-8.11-8.848z" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Boutons CTA --}}
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
                        <a href="{{ route('about') }}" wire:navigate
                            class="group relative inline-flex h-14 items-center justify-center border border-zinc-500/50 px-8 font-semibold text-white transition-all duration-300 hover:bg-white/10 active:scale-[0.97] text-lg">
                            <span class="flex items-center gap-2.5">
                                En savoir plus
                                <svg class="h-5 w-5 transition-transform group-hover:translate-x-1.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <div x-ref="decoLine" class="mt-12 h-0.5 w-0 bg-linear-to-r from-emerald-500 to-transparent">
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="w-full lg:w-1/2 order-1 lg:order-2 flex items-end justify-center lg:justify-end">
                <img x-ref="bgImage" src="{{ $heroImage }}" alt="Portrait de Gauthier Lobanga"
                    class="max-h-[50vh] lg:max-h-full w-auto object-contain mx-auto lg:mx-0" />
            </div>
        </div>
    </section>

    {{-- ========== SERVICES ========== --}}
    <livewire:service.service />

    {{-- ========== Compétences ========== --}}
    <livewire:skill.skill />


    {{-- ========== PROJECTS ========== --}}
    <livewire:projects.projects />

    {{-- ========== FORMATIONS ========== --}}
    <livewire:formation />

    {{-- ========== TESTIMONIALS ========== --}}
    <livewire:equipe.equipe />

    {{-- ========== Blog ========== --}}
    <livewire:blog.blog />

    {{-- ========== STATISTIQUES et CONTACT ========== --}}
    <livewire:stats.stats />
</div>
