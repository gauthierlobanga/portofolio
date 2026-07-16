@php
    use App\Settings\AboutSettings;

    $about = app(AboutSettings::class);

    $email = $about->contact_email ?? config('app.contact_email', 'contact@cadersa.org');
    $phone = $about->contact_phone ?? config('app.contact_phone', '+243 812 345 678');
    $address = $about->address ?? config('app.address', 'Goma, République Démocratique du Congo');
@endphp

<div class="mt-6 border-t border-zinc-100 pt-6 text-center dark:border-zinc-800">
    <div class="mx-auto max-w-xs space-y-4 text-sm text-zinc-500 dark:text-zinc-400">
        {{-- Coordonnées --}}
        <div class="space-y-2">
            @if ($address)
                <div class="flex items-start justify-center gap-2">
                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-emerald-500" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <span class="leading-relaxed">{{ $address }}</span>
                </div>
            @endif

            <div class="flex flex-wrap items-center justify-center gap-x-3 gap-y-1">
                @if ($email)
                    <a href="mailto:{{ $email }}"
                        class="inline-flex items-center gap-1.5 rounded-md px-2 py-1 text-zinc-500 transition-colors hover:bg-zinc-100 hover:text-zinc-700 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-200">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        {{ $email }}
                    </a>
                @endif
                @if ($phone)
                    <span class="inline-flex items-center gap-1.5 rounded-md px-2 py-1">
                        <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        {{ $phone }}
                    </span>
                @endif
            </div>
        </div>

        {{-- Copyright --}}
        <p class="text-xs text-zinc-400 dark:text-zinc-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('Tous droits réservés') }}.
        </p>

        {{-- Lien vers à propos --}}
        <a href="{{ route('about') }}" wire:navigate
            class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-600 transition-colors hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300">
            {{ __('En savoir plus sur nous') }}
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>
</div>
