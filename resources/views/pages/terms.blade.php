<x-layouts::main title="Conditions Générales d'Utilisation">
    <div class="relative min-h-[50vh] flex flex-col items-center justify-center overflow-hidden bg-white py-24 dark:bg-zinc-950">
        {{-- Décoration d'arrière-plan épurée --}}
        <div class="pointer-events-none absolute inset-0 z-0 flex justify-center">
            {{-- Gradient subtil --}}
            <div class="absolute top-[-20%] left-1/2 aspect-square w-[800px] -translate-x-1/2 rounded-full bg-linear-to-br from-emerald-100/40 via-transparent to-transparent blur-[100px] dark:from-emerald-900/20 dark:to-transparent">
            </div>
            {{-- Grid Pattern --}}
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:24px_24px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]">
            </div>
        </div>

        @php $settings = app(\App\Settings\TermsSettings::class); @endphp
        <div class="relative z-10 mx-auto max-w-5xl px-6 lg:px-8">
            <div class="flex flex-col items-center text-center">
                {{-- Icône Terms Moderne --}}
                <div class="relative mb-8 flex h-24 w-24 items-center justify-center rounded-3xl bg-linear-to-b from-emerald-50 to-white p-4 shadow-xl shadow-emerald-900/5 ring-1 ring-emerald-900/10 transition-transform duration-500 hover:scale-105 dark:from-emerald-900/20 dark:to-zinc-900 dark:shadow-emerald-900/20 dark:ring-emerald-500/20">
                    <div class="absolute inset-0 rounded-3xl bg-emerald-500/10 blur-xl dark:bg-emerald-500/20"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="relative h-12 w-12 text-emerald-600 dark:text-emerald-400 drop-shadow-sm transition-transform duration-500 hover:rotate-12" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" x2="8" y1="13" y2="13"/>
                        <line x1="16" x2="8" y1="17" y2="17"/>
                        <line x1="10" x2="8" y1="9" y2="9"/>
                    </svg>
                </div>

                <flux:badge color="emerald" class="mb-6 rounded-full px-4 py-1.5 text-sm shadow-sm">{{ $settings->hero_badge ?: 'Règles d\'Usage' }}</flux:badge>
                
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-zinc-900 font-serif dark:text-white">
                    {{ $settings->hero_title ?: 'Conditions d\'Utilisation' }}
                </h1>
                
                <p class="mt-6 max-w-2xl text-lg sm:text-xl leading-8 text-zinc-600 dark:text-zinc-400">
                    {{ $settings->hero_subtitle ?: 'Les règles régissant l\'utilisation de notre plateforme web et nos services.' }}
                </p>
            </div>
        </div>
    </div>

    <div class="relative z-0 mx-auto -mt-12 max-w-4xl px-6 pb-24 lg:px-8">
        <div
            class="overflow-hidden rounded-3xl border border-zinc-200/60 bg-white/80 p-8 shadow-xl shadow-zinc-200/20 backdrop-blur-xl sm:p-12 dark:border-zinc-800/60 dark:bg-zinc-900/80 dark:shadow-none">

            <div
                class="w-full max-w-none
                text-zinc-700 dark:text-zinc-300 text-base leading-relaxed
                [&>p]:mb-5 [&>p]:leading-relaxed
                [&>h1]:text-4xl [&>h1]:font-extrabold [&>h1]:tracking-tight [&>h1]:text-zinc-900 dark:[&>h1]:text-white [&>h1]:mb-8
                [&>h2]:text-3xl [&>h2]:font-extrabold [&>h2]:tracking-tight [&>h2]:text-zinc-900 dark:[&>h2]:text-white [&>h2]:mt-12 [&>h2]:mb-6 [&>h2]:border-b [&>h2]:border-emerald-100 dark:[&>h2]:border-emerald-900/30 [&>h2]:pb-4
                [&>h3]:text-2xl [&>h3]:font-bold [&>h3]:text-zinc-800 dark:[&>h3]:text-zinc-100 [&>h3]:mt-10 [&>h3]:mb-4
                [&_a]:font-medium [&_a]:text-emerald-600 dark:[&_a]:text-emerald-400 [&_a]:underline [&_a]:underline-offset-4 [&_a]:decoration-emerald-200 dark:[&_a]:decoration-emerald-900 hover:[&_a]:decoration-emerald-600 dark:hover:[&_a]:decoration-emerald-400 [&_a]:transition-colors
                [&>blockquote]:pl-6 [&>blockquote]:py-4 [&>blockquote]:my-8 [&>blockquote]:border-l-4 [&>blockquote]:border-emerald-500 [&>blockquote]:bg-linear-to-r [&>blockquote]:from-emerald-50 [&>blockquote]:to-transparent dark:[&>blockquote]:from-emerald-900/20 [&>blockquote]:rounded-r-2xl [&>blockquote]:text-xl [&>blockquote]:italic [&>blockquote]:text-emerald-900 dark:[&>blockquote]:text-emerald-100 [&>blockquote]:font-serif
                [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:mb-6 [&>ul]:space-y-3 [&>ul>li]:pl-2 [&>ul>li::marker]:text-emerald-500
                [&>ol]:list-decimal [&>ol]:pl-6 [&>ol]:mb-6 [&>ol]:space-y-3 [&>ol>li]:pl-2 [&>ol>li::marker]:text-emerald-500
                [&_img]:rounded-3xl [&_img]:shadow-2xl [&_img]:my-10 [&_img]:border [&_img]:border-zinc-100 dark:[&_img]:border-zinc-800 [&_img]:mx-auto
                [&_strong]:font-semibold [&_strong]:text-zinc-900 dark:[&_strong]:text-white">
                @php
                    $content = app(\App\Settings\TermsSettings::class)->content;
                @endphp
                @if (!empty($content) && isset($content['type']))
                    {!! new \Tiptap\Editor()->setContent($content)->getHTML() !!}
                @else
                    <p>Contenu en cours de rédaction...</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts::main>
