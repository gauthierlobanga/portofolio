<x-layouts::app :title="__('Suivi de mes formations')">
    <div class="flex flex-col gap-12 px-4 py-8 lg:px-8 max-w-7xl mx-auto w-full">

        <div class="flex items-center justify-between">
            <h1 class="flex items-center gap-3 text-3xl font-light tracking-tight text-zinc-900 dark:text-white md:text-4xl">
                <span class="flex h-12 w-12 items-center justify-center rounded-full border border-black/5 bg-zinc-50 dark:border-white/5 dark:bg-white/5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.241-3.342m-14.491 0A50.652 50.652 0 0 1 12 10.147m3.241 3.342a50.638 50.638 0 0 1-3.241 3.342" />
                    </svg>
                </span>
                Suivi de mes formations
            </h1>
            <a href="{{ route('dashboard') }}" wire:navigate class="text-sm font-medium text-zinc-500 hover:text-emerald-600 dark:text-zinc-400 dark:hover:text-emerald-400">
                &larr; Retour au dashboard
            </a>
        </div>

        @if ($registrations->isEmpty())
            <div class="flex flex-col items-center justify-center gap-4 rounded-4xl border border-dashed border-black/10 bg-zinc-50/50 px-6 py-16 text-center dark:border-white/10 dark:bg-white/5">
                <div class="flex size-16 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-zinc-400 dark:text-zinc-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.241-3.342m-14.491 0A50.652 50.652 0 0 1 12 10.147m3.241 3.342a50.638 50.638 0 0 1-3.241 3.342" />
                    </svg>
                </div>
                <div>
                    <p class="text-base font-medium text-zinc-700 dark:text-zinc-300">Vous n'êtes inscrit à aucune formation.</p>
                    <p class="mt-1 text-sm text-zinc-400 dark:text-zinc-500">Découvrez notre catalogue et commencez votre apprentissage.</p>
                </div>
                <a href="{{ route('formations.index') }}" wire:navigate
                    class="mt-4 inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Explorer les formations
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($registrations as $registration)
                    @php
                        $formation = $registration->formation;
                        $statusConfig = match($registration->status) {
                            'approved'   => ['dot' => 'bg-emerald-500', 'label' => 'Approuvée', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                            'pending'    => ['dot' => 'bg-yellow-400',  'label' => 'En attente', 'text' => 'text-yellow-600 dark:text-yellow-400'],
                            'waitlisted' => ['dot' => 'bg-blue-400',    'label' => 'Liste d\'attente', 'text' => 'text-blue-600 dark:text-blue-400'],
                            default      => ['dot' => 'bg-zinc-400',    'label' => ucfirst($registration->status), 'text' => 'text-zinc-500'],
                        };

                        $paymentStatusConfig = match($registration->payment_status) {
                            'paid'    => ['bg' => 'bg-emerald-100 dark:bg-emerald-900/30', 'text' => 'text-emerald-700 dark:text-emerald-400', 'label' => 'Payée'],
                            'free'    => ['bg' => 'bg-zinc-100 dark:bg-zinc-800', 'text' => 'text-zinc-700 dark:text-zinc-400', 'label' => 'Gratuite'],
                            'pending' => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30', 'text' => 'text-yellow-700 dark:text-yellow-400', 'label' => 'En attente'],
                            default   => ['bg' => 'bg-zinc-100 dark:bg-zinc-800', 'text' => 'text-zinc-700 dark:text-zinc-400', 'label' => ucfirst($registration->payment_status)],
                        };

                        $progress = 0;
                        if ($formation->start_date && $formation->end_date) {
                            $now = now();
                            $start = \Carbon\Carbon::parse($formation->start_date);
                            $end   = \Carbon\Carbon::parse($formation->end_date);
                            if ($now->gt($start)) {
                                $total   = $start->diffInMinutes($end);
                                $elapsed = $start->diffInMinutes($now);
                                $progress = $total > 0 ? min(100, intval(($elapsed / $total) * 100)) : 0;
                            }
                        }

                        $isApproved = $registration->status === 'approved' && $registration->payment_status === 'paid';
                    @endphp

                    <a href="{{ $isApproved ? route('formations.show', $formation) : '#' }}"
                        @if(!$isApproved) x-data x-on:click.prevent="Flux.toast({text: 'Votre inscription nécessite l\'approbation de l\'administrateur et le paiement.', variant: 'danger'})" @else wire:navigate @endif
                        class="group flex flex-col gap-4 rounded-xl border border-black/5 bg-zinc-50/50 p-6 backdrop-blur-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:border-emerald-200 hover:bg-white hover:shadow dark:border-white/5 dark:bg-white/5 dark:hover:border-emerald-800 dark:hover:bg-white/10 {{ !$isApproved ? 'opacity-80' : '' }}">

                        <div class="flex items-start gap-4">
                            @if ($formation->thumb_url)
                                <img src="{{ $formation->thumb_url }}" alt="{{ $formation->title }}"
                                    class="size-16 shrink-0 rounded-xl object-cover border border-zinc-100 dark:border-zinc-800">
                            @else
                                <div class="flex size-16 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-950 dark:to-teal-950">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-emerald-600 dark:text-emerald-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.241-3.342" />
                                    </svg>
                                </div>
                            @endif

                            <div class="min-w-0 flex-1">
                                <p class="truncate text-base font-semibold text-zinc-900 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition">
                                    {{ $formation->title }}
                                </p>
                                <div class="mt-2 flex flex-col gap-1.5">
                                    <div class="flex items-center gap-1.5">
                                        <span class="size-2 shrink-0 rounded-full {{ $statusConfig['dot'] }}"></span>
                                        <span class="text-sm font-medium {{ $statusConfig['text'] }}">{{ $statusConfig['label'] }}</span>
                                    </div>
                                    <span class="inline-flex items-center w-max rounded-full px-2 py-0.5 text-xs font-medium {{ $paymentStatusConfig['bg'] }} {{ $paymentStatusConfig['text'] }}">
                                        {{ $paymentStatusConfig['label'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if ($progress > 0 || $formation->start_date)
                            <div class="mt-2">
                                <div class="flex items-center justify-between text-sm text-zinc-500 dark:text-zinc-400 mb-2">
                                    <span>Progression</span>
                                    <span class="font-medium">{{ $progress }}%</span>
                                </div>
                                <div class="h-1.5 w-full overflow-hidden rounded-full bg-zinc-200 dark:bg-zinc-700">
                                    <div class="h-full rounded-full bg-linear-to-r from-emerald-500 to-teal-400 transition-all duration-700"
                                        style="width: {{ $progress }}%">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif

    </div>
</x-layouts::app>
