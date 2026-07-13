<x-layouts::main title="Mentions Légales">
    <div class="relative min-h-[50vh] overflow-hidden bg-zinc-50 py-24 dark:bg-zinc-900">
        {{-- Décoration d'arrière-plan --}}
        <div class="pointer-events-none absolute inset-0 z-0 flex justify-center">
            <div
                class="absolute -top-[20%] left-1/2 aspect-square w-[800px] -translate-x-1/2 rounded-full bg-linear-to-br from-emerald-100/40 to-teal-50/10 blur-[100px] dark:from-emerald-500/10 dark:to-transparent">
            </div>
            <div
                class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay dark:opacity-10">
            </div>
        </div>

        <div class="relative z-10 mx-auto max-w-4xl px-6 lg:px-8">
            <div class="text-center">
                <flux:badge color="emerald" class="mb-4">Informations Juridiques</flux:badge>
                <h1 class="text-4xl font-bold tracking-tight text-zinc-900 sm:text-5xl dark:text-white">
                    Mentions Légales
                </h1>
                <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                    Transparence et conformité concernant l'édition et l'hébergement du site de CADERSA ASBL.
                </p>
            </div>
        </div>
    </div>

    <div class="relative z-20 mx-auto -mt-12 max-w-4xl px-6 pb-24 lg:px-8">
        <div
            class="overflow-hidden rounded-3xl border border-zinc-200/60 bg-white/80 p-8 shadow-xl shadow-zinc-200/20 backdrop-blur-xl sm:p-12 dark:border-zinc-800/60 dark:bg-zinc-900/80 dark:shadow-none">
            
            <div class="prose prose-lg prose-emerald max-w-none dark:prose-invert
                prose-headings:font-bold prose-headings:tracking-tight prose-headings:text-zinc-900 dark:prose-headings:text-zinc-100
                prose-h2:mt-10 prose-h2:mb-4 prose-h2:border-b prose-h2:border-zinc-200 prose-h2:pb-2 dark:prose-h2:border-zinc-800
                prose-h3:mt-8 prose-h3:mb-3
                prose-p:leading-relaxed prose-p:text-zinc-600 dark:prose-p:text-zinc-400
                prose-a:text-emerald-600 hover:prose-a:text-emerald-500 prose-a:no-underline hover:prose-a:underline dark:prose-a:text-emerald-400">
                @php
                    $content = app(\App\Settings\LegalSettings::class)->content;
                @endphp
                @if(!empty($content) && isset($content['type']))
                    {!! (new \Tiptap\Editor)->setContent($content)->getHTML() !!}
                @else
                    <p>Contenu en cours de rédaction...</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.main>
