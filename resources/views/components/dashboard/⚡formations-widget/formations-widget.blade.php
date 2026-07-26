<div class="flex flex-col gap-4" wire:poll.60s>

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h2 class="flex items-center gap-3 text-lg font-medium tracking-tight text-zinc-900 dark:text-white">
            <span class="flex h-10 w-10 items-center justify-center rounded-full border border-black/5 bg-zinc-50 dark:border-white/5 dark:bg-white/5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-emerald-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.241-3.342m-14.491 0A50.652 50.652 0 0 1 12 10.147m3.241 3.342a50.638 50.638 0 0 1-3.241 3.342" />
                </svg>
            </span>
            Mes Formations
        </h2>

        <div class="flex items-center gap-3">
            @if ($this->activeCount > 0)
                <span class="flex h-6 min-w-[1.5rem] items-center justify-center rounded-full bg-emerald-100 px-2 text-xs font-semibold text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">
                    {{ $this->activeCount }} active{{ $this->activeCount > 1 ? 's' : '' }}
                </span>
            @endif
            <a href="{{ route('formations.suivi') }}" wire:navigate
                class="group inline-flex items-center gap-1.5 text-sm font-medium text-zinc-500 transition hover:text-emerald-600 dark:text-zinc-400 dark:hover:text-emerald-400">
                Tout voir
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 transition-transform duration-200 group-hover:translate-x-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>

    @if ($this->registrations->isEmpty())
        {{-- État vide --}}
        <div class="flex flex-col items-center justify-center gap-4 rounded-3xl border border-dashed border-black/10 bg-zinc-50/50 px-6 py-12 text-center dark:border-white/10 dark:bg-white/5">
            <div class="flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-zinc-400 dark:text-zinc-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.241-3.342m-14.491 0A50.652 50.652 0 0 1 12 10.147m3.241 3.342a50.638 50.638 0 0 1-3.241 3.342" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Aucune formation active</p>
                <p class="mt-1 text-xs text-zinc-400 dark:text-zinc-500">Découvrez nos formations et inscrivez-vous dès maintenant.</p>
            </div>
            <a href="{{ route('formations.index') }}" wire:navigate
                class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                Explorer les formations
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
            @foreach ($this->registrations as $registration)
                @php
                    $formation = $registration->formation;
                    $statusConfig = match($registration->status) {
                        'approved'   => ['dot' => 'bg-emerald-500', 'label' => 'Approuvée', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                        'pending'    => ['dot' => 'bg-yellow-400',  'label' => 'En attente', 'text' => 'text-yellow-600 dark:text-yellow-400'],
                        'waitlisted' => ['dot' => 'bg-blue-400',    'label' => 'Liste d\'attente', 'text' => 'text-blue-600 dark:text-blue-400'],
                        default      => ['dot' => 'bg-zinc-400',    'label' => ucfirst($registration->status), 'text' => 'text-zinc-500'],
                    };

                    // Calcul progression
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
                    @if(!$isApproved) wire:click.prevent="notifyNotApproved" @else wire:navigate @endif
                    wire:key="widget-reg-{{ $registration->id }}"
                    class="group flex flex-col gap-3 rounded-2xl border border-black/5 bg-zinc-50/50 p-4 backdrop-blur-sm transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-emerald-200 hover:bg-white hover:shadow-md dark:border-white/5 dark:bg-white/5 dark:hover:border-emerald-800 dark:hover:bg-white/10 {{ !$isApproved ? 'opacity-70 cursor-not-allowed' : '' }}">

                    <div class="flex items-start gap-3">
                        {{-- Thumbnail ou icône --}}
                        @if ($formation->thumb_url)
                            <img src="{{ $formation->thumb_url }}" alt="{{ $formation->title }}"
                                class="size-12 shrink-0 rounded-xl object-cover border border-zinc-100 dark:border-zinc-800">
                        @else
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-950 dark:to-teal-950">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-emerald-600 dark:text-emerald-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.241-3.342" />
                                </svg>
                            </div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-zinc-900 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition">
                                {{ $formation->title }}
                            </p>
                            <div class="mt-1 flex items-center gap-1.5">
                                <span class="size-1.5 shrink-0 rounded-full {{ $statusConfig['dot'] }}"></span>
                                <span class="text-xs {{ $statusConfig['text'] }}">{{ $statusConfig['label'] }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Barre de progression --}}
                    @if ($progress > 0 || $formation->start_date)
                        <div>
                            <div class="flex items-center justify-between text-xs text-zinc-400 dark:text-zinc-500 mb-1">
                                <span>Progression</span>
                                <span>{{ $progress }}%</span>
                            </div>
                            <div class="h-1 w-full overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">
                                <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-teal-400 transition-all duration-700"
                                    style="width: {{ $progress }}%">
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Prochaine date --}}
                    @if ($formation->start_date)
                        <p class="flex items-center gap-1.5 text-xs text-zinc-400 dark:text-zinc-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            {{ \Carbon\Carbon::parse($formation->start_date)->translatedFormat('d M Y') }}
                        </p>
                    @endif
                </a>
            @endforeach
        </div>

        @if ($this->totalCount > 4)
            <a href="{{ route('formations.suivi') }}" wire:navigate
                class="flex items-center justify-center gap-2 rounded-2xl border border-dashed border-black/10 bg-zinc-50/50 py-3 text-sm font-medium text-zinc-500 transition hover:bg-zinc-100 dark:border-white/10 dark:bg-white/5 dark:text-zinc-400 dark:hover:bg-white/10">
                Voir {{ $this->totalCount - 4 }} autre{{ $this->totalCount - 4 > 1 ? 's' : '' }} formation{{ $this->totalCount - 4 > 1 ? 's' : '' }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        @endif
    @endif

    {{-- Indicateur live --}}
    <div class="flex items-center gap-1.5 text-xs text-zinc-400 dark:text-zinc-500">
        <span class="relative flex size-1.5">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex size-1.5 rounded-full bg-emerald-500"></span>
        </span>
        Mis à jour automatiquement toutes les 60s
    </div>
</div>