<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-zinc-50 antialiased dark:bg-zinc-950">
    {{-- Fond décoratif subtil --}}
    <div class="pointer-events-none fixed inset-0 z-0">
        <div
            class="absolute -top-40 right-0 h-150 w-150 rounded-full bg-gradient-to-br from-emerald-200/20 to-teal-100/0 blur-3xl dark:from-emerald-500/5 dark:to-transparent">
        </div>
        <div
            class="absolute -bottom-20 -left-20 h-125 w-125 rounded-full bg-gradient-to-tr from-zinc-200/40 to-emerald-100/0 blur-3xl dark:from-zinc-900/50 dark:to-transparent">
        </div>
    </div>

    <div class="relative z-10 flex min-h-screen flex-col items-center justify-center px-6 py-12 md:px-10">
        <div class="flex w-full max-w-md flex-col gap-6">
            {{-- Logo + Nom de l’application --}}
            <a href="{{ route('home') }}" wire:navigate
                class="group flex flex-col items-center gap-3 transition duration-300 hover:-translate-y-0.5">
                <x-app-logo />
            </a>

            {{-- Carte de formulaire --}}
            <div
                class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700/60 dark:bg-zinc-900">
                <div class="px-8 py-10">{{ $slot }}</div>
            </div>

            {{-- Pied de carte --}}
            <div class="text-center text-sm text-zinc-500 dark:text-zinc-400">
                @include('pages.auth._company-footer')
            </div>
        </div>
    </div>

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>
