<section class="border-t border-zinc-200 bg-white py-24 dark:border-zinc-800 dark:bg-zinc-950">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center mb-16" x-data="cspState" x-intersect="shown = true">
            @if ($this->about->blog_hero_badge)
                <p class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 transition-all duration-700 delay-100 ease-out"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    {{ $this->about->blog_hero_badge }}
                </p>
            @endif

            <h2 class="mt-4 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white sm:text-5xl lg:text-5xl transition-all duration-700 delay-100 ease-out"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                {{ $this->about->blog_hero_title ?: 'Le pouls de CADERSA ASBL' }}
            </h2>
            <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400 transition-all duration-700 delay-200 ease-out"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                {{ $this->about->blog_hero_subtitle ?: 'Retrouvez des articles, des nouvelles et des ressources pour mieux comprendre nos actions et nos engagements.' }}
            </p>

            @if ($this->about->blog_content_title || $this->about->blog_content_subtitle)
                <div class="mt-10 rounded-3xl border border-zinc-200 bg-zinc-50 p-6 dark:border-zinc-800 dark:bg-zinc-900"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    @if ($this->about->blog_content_title)
                        <h3 class="text-xl font-semibold text-zinc-900 dark:text-white">
                            {{ $this->about->blog_content_title }}
                        </h3>
                    @endif
                    @if ($this->about->blog_content_subtitle)
                        <p class="mt-3 text-sm leading-7 text-zinc-600 dark:text-zinc-400">
                            {{ $this->about->blog_content_subtitle }}
                        </p>
                    @endif
                </div>
            @endif

            @if ($this->about->blog_banner_title || $this->about->blog_banner_subtitle)
                <div class="mt-8 rounded-3xl border border-emerald-200 bg-emerald-50 p-6 dark:border-emerald-700/30 dark:bg-emerald-900/20"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    @if ($this->about->blog_banner_title)
                        <h4 class="text-lg font-semibold text-emerald-900 dark:text-emerald-200">
                            {{ $this->about->blog_banner_title }}
                        </h4>
                    @endif
                    @if ($this->about->blog_banner_subtitle)
                        <p class="mt-2 text-sm leading-7 text-emerald-700 dark:text-emerald-300">
                            {{ $this->about->blog_banner_subtitle }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @forelse ($this->posts as $post)
                <article class="group overflow-hidden rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-950">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-zinc-900 dark:text-white">{{ $post->title }}</h3>
                        <p class="mt-3 text-sm text-zinc-500 dark:text-zinc-400">{{ $post->getPlainTextContent(120) }}</p>
                    </div>
                    <div class="mt-auto flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400">
                        <span>{{ $post->published_at?->translatedFormat('d F Y') ?? $post->created_at->translatedFormat('d F Y') }}</span>
                        <a href="{{ route('posts.show', $post) }}" wire:navigate class="font-semibold text-emerald-600 transition hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300">Lire</a>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-zinc-200 bg-zinc-50 p-10 text-center dark:border-zinc-800 dark:bg-zinc-900">
                    <p class="text-zinc-500 dark:text-zinc-400">Aucun article disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
