<?php

use App\Models\FormationModule;
use App\Models\FormationRegistration;
use App\Models\UserModuleProgress;
use App\Models\UserProjectSubmission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mes Formations')] #[Layout('layouts::app')] class extends Component {
    public string $activeTab = 'all';
    public ?string $cancellingId = null;

    public function mount(): void
    {
        if (!Auth::check()) {
            $this->redirect(route('login'), navigate: true);
        }
    }

    #[Computed]
    public function registrations(): Collection
    {
        $query = Auth::user()
            ->formationRegistrations()
            ->with(['formation.category', 'formation.media'])
            ->latest();

        return match ($this->activeTab) {
            'active' => $query->whereIn('status', ['approved', 'pending', 'waitlisted'])->get(),
            'completed' => $query->where('attendance_status', 'attended')->get(),
            'cancelled' => $query->whereIn('status', ['cancelled', 'rejected'])->get(),
            default => $query->get(),
        };
    }

    #[Computed]
    public function stats(): array
    {
        $all = Auth::user()->formationRegistrations();

        return [
            'total' => $all->count(),
            'active' => $all
                ->clone()
                ->whereIn('status', ['approved', 'pending', 'waitlisted'])
                ->count(),
            'completed' => $all->clone()->where('attendance_status', 'attended')->count(),
            'cancelled' => $all
                ->clone()
                ->whereIn('status', ['cancelled', 'rejected'])
                ->count(),
        ];
    }

    #[Computed]
    public function chartData(): array
    {
        $registrations = Auth::user()->formationRegistrations()->get();

        // 1. Payment Stats (Payé vs En attente)
        $totalPaid = $registrations->where('payment_status', 'paid')->sum('amount') ?? 0;
        $totalPending = $registrations->where('payment_status', 'pending')->sum('amount') ?? 0;

        // 2. Progress Stats (Inscrit, Présent, Absent)
        $attendance = [
            'registered' => $registrations->where('attendance_status', 'registered')->count(),
            'attended' => $registrations->where('attendance_status', 'attended')->count(),
            'absent' => $registrations->where('attendance_status', 'absent')->count(),
        ];

        return [
            'payments' => [
                'series' => [$totalPaid, $totalPending],
                'labels' => ['Payé', 'En attente'],
                'hasData' => $totalPaid + $totalPending > 0,
            ],
            'attendance' => [
                'series' => [$attendance['registered'], $attendance['attended'], $attendance['absent']],
                'labels' => ['En cours', 'Terminées', 'Absences'],
                'hasData' => array_sum($attendance) > 0,
            ],
        ];
    }

    #[Computed]
    public function moduleChartData(): array
    {
        $user = Auth::user();

        // Get all formation IDs the user is registered to
        $formationIds = $user
            ->formationRegistrations()
            ->whereIn('status', ['approved', 'pending', 'waitlisted'])
            ->pluck('formation_id');

        // Get all modules for those formations, with user progress
        $modules = FormationModule::whereIn('formation_id', $formationIds)
            ->with(['userProgress' => fn($q) => $q->where('user_id', $user->id)])
            ->with(['projects.submissions' => fn($q) => $q->where('user_id', $user->id)])
            ->get();

        $totalModules = $modules->count();
        $completedModules = $modules->filter(fn($m) => $m->userProgress->first()?->status === 'completed')->count();
        $inProgressModules = $modules->filter(fn($m) => $m->userProgress->first()?->status === 'in_progress')->count();
        $pendingModules = $totalModules - $completedModules - $inProgressModules;

        // Projects across all those modules
        $allProjects = $modules->flatMap(fn($m) => $m->projects);
        $totalProjects = $allProjects->count();
        $gradedProjects = $allProjects->filter(fn($p) => $p->submissions->first()?->status === 'graded')->count();
        $submittedProjects = $allProjects->filter(fn($p) => $p->submissions->first()?->status === 'submitted')->count();
        $pendingProjects = $totalProjects - $gradedProjects - $submittedProjects;

        // Per-formation module breakdown for bar chart
        $formationBreakdown = $user
            ->formationRegistrations()
            ->with(['formation' => fn($q) => $q->with(['modules.userProgress' => fn($q2) => $q2->where('user_id', $user->id)])])
            ->whereIn('status', ['approved', 'pending', 'waitlisted'])
            ->get()
            ->map(function ($reg) {
                $formation = $reg->formation;
                if (!$formation) {
                    return null;
                }
                $mods = $formation->modules;
                $total = $mods->count();
                $done = $mods->filter(fn($m) => $m->userProgress->first()?->status === 'completed')->count();
                return [
                    'name' => \Illuminate\Support\Str::limit($formation->title, 22),
                    'total' => $total,
                    'done' => $done,
                    'pct' => $total > 0 ? round(($done / $total) * 100) : 0,
                ];
            })
            ->filter()
            ->values();

        $moduleCompletionPct = $totalModules > 0 ? round(($completedModules / $totalModules) * 100) : 0;

        return [
            'totalModules' => $totalModules,
            'completedModules' => $completedModules,
            'inProgressModules' => $inProgressModules,
            'pendingModules' => $pendingModules,
            'moduleCompletionPct' => $moduleCompletionPct,
            'totalProjects' => $totalProjects,
            'gradedProjects' => $gradedProjects,
            'submittedProjects' => $submittedProjects,
            'pendingProjects' => $pendingProjects,
            'formationBreakdown' => $formationBreakdown,
            'hasModuleData' => $totalModules > 0,
            'hasProjectData' => $totalProjects > 0,
        ];
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function confirmCancel(string $id): void
    {
        $this->cancellingId = $id;
    }

    public function cancelRegistration(): void
    {
        $registration = Auth::user()->formationRegistrations()->find($this->cancellingId);

        if (!$registration) {
            $this->cancellingId = null;

            return;
        }

        if (!in_array($registration->status, ['pending', 'waitlisted'], true)) {
            \Flux\Flux::toast(variant: 'danger', text: 'Impossible d\'annuler cette inscription.');
            $this->cancellingId = null;

            return;
        }

        $registration->update([
            'status' => FormationRegistration::STATUS_CANCELLED,
            'cancelled_at' => now(),
        ]);

        unset($this->registrations, $this->stats);
        $this->cancellingId = null;
        \Flux\Flux::toast(variant: 'success', text: 'Inscription annulée avec succès.');
    }

    public function rendering(\Illuminate\View\View $view): void
    {
        $view->title('Mes Formations');
        $view->layoutData([
            'seoDescription' => 'Suivez vos formations inscrites, leur statut et votre progression.',
            'seoType' => 'website',
        ]);
    }
};
?>

<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950">

    {{-- ==================== HERO ==================== --}}
    <section
        class="relative overflow-hidden border-b border-zinc-200 bg-white py-12 dark:border-zinc-800 dark:bg-zinc-900/40 sm:py-16">
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            <div class="absolute -left-24 -top-24 h-72 w-72 rounded-full bg-emerald-400/10 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-16 h-72 w-72 rounded-full bg-teal-400/8 blur-3xl"></div>
            <div
                class="absolute inset-0 opacity-30 bg-[linear-gradient(to_right,#a1a1aa12_1px,transparent_1px),linear-gradient(to_bottom,#a1a1aa12_1px,transparent_1px)] bg-size-[40px_40px]">
            </div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <flux:badge
                        class="border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300 mb-3">
                        Espace personnel
                    </flux:badge>
                    <h1 class="text-3xl font-bold tracking-tight text-zinc-950 dark:text-white sm:text-4xl">
                        Mes Formations
                    </h1>
                    <p class="mt-2 text-base text-zinc-500 dark:text-zinc-400">
                        Suivez vos inscriptions, statuts de paiement et prochaines échéances en temps réel.
                    </p>
                </div>
                <a href="{{ route('formations.index') }}" wire:navigate
                    class="group inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white px-5 py-2.5 text-sm font-semibold text-zinc-700 shadow-sm transition-all hover:border-emerald-300 hover:text-emerald-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                    <flux:icon.academic-cap class="size-4" />
                    Explorer les formations
                </a>
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- ==================== STATS ==================== --}}
        <div class="mb-8 grid grid-cols-2 gap-3 sm:grid-cols-4">
            @php
                $statItems = [
                    ['label' => 'Total', 'value' => $this->stats['total'], 'color' => 'zinc', 'icon' => 'queue-list'],
                    [
                        'label' => 'Actives',
                        'value' => $this->stats['active'],
                        'color' => 'emerald',
                        'icon' => 'play-circle',
                    ],
                    [
                        'label' => 'Terminées',
                        'value' => $this->stats['completed'],
                        'color' => 'blue',
                        'icon' => 'check-badge',
                    ],
                    [
                        'label' => 'Annulées',
                        'value' => $this->stats['cancelled'],
                        'color' => 'red',
                        'icon' => 'x-circle',
                    ],
                ];
                $colorMap = [
                    'zinc' => 'bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300',
                    'emerald' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-400',
                    'blue' => 'bg-blue-50 text-blue-700 dark:bg-blue-950/50 dark:text-blue-400',
                    'red' => 'bg-red-50 text-red-600 dark:bg-red-950/50 dark:text-red-400',
                ];
            @endphp
            @foreach ($statItems as $stat)
                <div
                    class="group relative overflow-hidden rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">
                                {{ $stat['label'] }}</p>
                            <p class="mt-2 text-3xl font-bold text-zinc-950 dark:text-white"
                                wire:loading.class="opacity-40" wire:target="setTab">
                                {{ $stat['value'] }}
                            </p>
                        </div>
                        <span
                            class="flex size-9 shrink-0 items-center justify-center rounded-xl {{ $colorMap[$stat['color']] }}">
                            <flux:icon :icon="$stat['icon']" class="size-4" />
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ==================== CHARTS (Flowbite / ApexCharts) ==================== --}}
        <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-2" wire:ignore>
            {{-- Paiements --}}
            <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900"
                x-data="{
                    init() {
                            const data = @js($this->chartData);
                            if (!data.payments.hasData) return;

                            if (typeof ApexCharts === 'undefined') {
                                const script = document.createElement('script');
                                script.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
                                script.onload = () => this.renderChart(data);
                                document.head.appendChild(script);
                            } else {
                                this.renderChart(data);
                            }
                        },
                        renderChart(data) {
                            const options = {
                                series: data.payments.series,
                                labels: data.payments.labels,
                                colors: ['#10b981', '#f59e0b'],
                                chart: { type: 'donut', height: 320, fontFamily: 'inherit', background: 'transparent' },
                                plotOptions: { pie: { donut: { size: '75%' } } },
                                stroke: { show: false },
                                dataLabels: { enabled: false },
                                legend: { position: 'bottom', labels: { colors: 'currentColor' } },
                                theme: { mode: document.documentElement.classList.contains('dark') ? 'dark' : 'light' }
                            };
                            const chart = new ApexCharts(this.$refs.paymentChart, options);
                            chart.render();
                        }
                }">
                <div class="mb-4">
                    <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Suivi des paiements</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Répartition des frais d'inscription.</p>
                </div>
                <div x-ref="paymentChart" class="flex justify-center min-h-80">
                    @if (!$this->chartData['payments']['hasData'])
                        <div class="flex items-center justify-center h-full text-sm text-zinc-400">Aucune donnée
                            financière</div>
                    @endif
                </div>
            </div>

            {{-- Progression --}}
            <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900"
                x-data="{
                    init() {
                            const data = @js($this->chartData);
                            if (!data.attendance.hasData) return;

                            if (typeof ApexCharts === 'undefined') {
                                const script = document.createElement('script');
                                script.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
                                script.onload = () => this.renderChart(data);
                                document.head.appendChild(script);
                            } else {
                                this.renderChart(data);
                            }
                        },
                        renderChart(data) {
                            const options = {
                                series: [{ name: 'Formations', data: data.attendance.series }],
                                xaxis: { categories: data.attendance.labels, labels: { style: { colors: 'currentColor', fontFamily: 'inherit' } }, axisBorder: { show: false }, axisTicks: { show: false } },
                                colors: ['#3b82f6', '#10b981', '#ef4444'],
                                chart: { type: 'bar', height: 320, fontFamily: 'inherit', background: 'transparent', toolbar: { show: false } },
                                plotOptions: { bar: { borderRadius: 6, distributed: true, columnWidth: '40%' } },
                                dataLabels: { enabled: false },
                                legend: { show: false },
                                grid: { strokeDashArray: 4, borderColor: 'rgba(161, 161, 170, 0.2)' },
                                theme: { mode: document.documentElement.classList.contains('dark') ? 'dark' : 'light' }
                            };
                            const chart = new ApexCharts(this.$refs.progressChart, options);
                            chart.render();
                        }
                }">
                <div class="mb-4">
                    <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Progression Globale</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Statut de vos participations.</p>
                </div>
                <div x-ref="progressChart" class="min-h-80">
                    @if (!$this->chartData['attendance']['hasData'])
                        <div class="flex items-center justify-center h-80 text-sm text-zinc-400">Aucune donnée de
                            progression</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ==================== MODULES & PROJETS (Shadcn-style Charts) ==================== --}}
        @php $mcd = $this->moduleChartData; @endphp
        @if ($mcd['hasModuleData'] || $mcd['hasProjectData'])
            <div class="mb-8 space-y-6" wire:ignore>

                {{-- Section header --}}
                <div class="flex items-center gap-3">
                    <div
                        class="h-px flex-1 bg-linear-to-r from-transparent via-zinc-200 to-transparent dark:via-zinc-800">
                    </div>
                    <div
                        class="flex items-center gap-2 rounded-full border border-zinc-200 bg-white px-4 py-1.5 dark:border-zinc-700 dark:bg-zinc-900">
                        <span class="relative flex size-2">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-violet-400 opacity-75"></span>
                            <span class="relative inline-flex size-2 rounded-full bg-violet-500"></span>
                        </span>
                        <span
                            class="text-xs font-semibold tracking-widest text-zinc-500 uppercase dark:text-zinc-400">Progression
                            pédagogique</span>
                    </div>
                    <div
                        class="h-px flex-1 bg-linear-to-r from-transparent via-zinc-200 to-transparent dark:via-zinc-800">
                    </div>
                </div>

                {{-- Row 1: Radial Module + Projects donut --}}
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                    {{-- Radial: Module Completion --}}
                    <div class="col-span-1 overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900"
                        x-data="{
                            init() {
                                const pct = @js($mcd['moduleCompletionPct']);
                                const done = @js($mcd['completedModules']);
                                const total = @js($mcd['totalModules']);
                                const isDark = document.documentElement.classList.contains('dark');
                                const loadChart = () => {
                                    const opts = {
                                        series: [pct],
                                        chart: { type: 'radialBar', height: 280, fontFamily: 'inherit', background: 'transparent', sparkline: { enabled: true } },
                                        plotOptions: {
                                            radialBar: {
                                                startAngle: -130,
                                                endAngle: 130,
                                                hollow: { margin: 0, size: '68%' },
                                                track: { background: isDark ? '#27272a' : '#f4f4f5', strokeWidth: '100%', margin: 0 },
                                                dataLabels: {
                                                    name: { show: true, color: isDark ? '#a1a1aa' : '#71717a', fontSize: '13px', offsetY: 28, formatter: () => 'Modules terminés' },
                                                    value: { show: true, color: isDark ? '#f4f4f5' : '#18181b', fontSize: '36px', fontWeight: 700, offsetY: -14, formatter: v => `${v}%` }
                                                }
                                            }
                                        },
                                        fill: {
                                            type: 'gradient',
                                            gradient: { shade: 'dark', type: 'horizontal', gradientToColors: ['#8b5cf6'], stops: [0, 100], colorStops: [{ offset: 0, color: '#6366f1', opacity: 1 }, { offset: 100, color: '#8b5cf6', opacity: 1 }] }
                                        },
                                        stroke: { lineCap: 'round' },
                                        labels: ['Modules terminés'],
                                    };
                                    new ApexCharts(this.$refs.radialChart, opts).render();
                                };
                                typeof ApexCharts !== 'undefined' ? loadChart() : (() => { const s = document.createElement('script');
                                    s.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
                                    s.onload = loadChart;
                                    document.head.appendChild(s); })();
                            }
                        }">
                        <div
                            class="flex items-center justify-between border-b border-zinc-100 px-5 py-4 dark:border-zinc-800">
                            <div>
                                <p class="text-sm font-semibold text-zinc-900 dark:text-white">Achèvement des modules
                                </p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                    {{ $mcd['completedModules'] }}/{{ $mcd['totalModules'] }} modules validés</p>
                            </div>
                            <div
                                class="flex size-9 items-center justify-center rounded-xl bg-violet-50 dark:bg-violet-950/40">
                                <flux:icon.chart-bar-square class="size-5 text-violet-600 dark:text-violet-400" />
                            </div>
                        </div>
                        <div x-ref="radialChart" class="px-2"></div>
                        {{-- Module status pills --}}
                        <div
                            class="flex items-center justify-center gap-4 border-t border-zinc-100 px-5 py-3 dark:border-zinc-800">
                            <span class="flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                                <span class="inline-block size-2 rounded-full bg-violet-500"></span> Terminés:
                                {{ $mcd['completedModules'] }}
                            </span>
                            <span class="flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                                <span class="inline-block size-2 rounded-full bg-amber-400"></span> En cours:
                                {{ $mcd['inProgressModules'] }}
                            </span>
                            <span class="flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                                <span class="inline-block size-2 rounded-full bg-zinc-300 dark:bg-zinc-600"></span> À
                                faire: {{ $mcd['pendingModules'] }}
                            </span>
                        </div>
                    </div>

                    {{-- Projects status donut --}}
                    <div class="col-span-1 overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900"
                        x-data="{
                            init() {
                                const d = @js([$mcd['gradedProjects'], $mcd['submittedProjects'], $mcd['pendingProjects']]);
                                const hasData = d.reduce((a, b) => a + b, 0) > 0;
                                if (!hasData) return;
                                const isDark = document.documentElement.classList.contains('dark');
                                const loadChart = () => {
                                    const opts = {
                                        series: d,
                                        labels: ['Validés', 'Soumis', 'En attente'],
                                        colors: ['#22c55e', '#3b82f6', '#a1a1aa'],
                                        chart: { type: 'donut', height: 280, fontFamily: 'inherit', background: 'transparent' },
                                        plotOptions: { pie: { donut: { size: '70%', labels: { show: true, name: { show: true, color: isDark ? '#a1a1aa' : '#71717a', fontSize: '12px', offsetY: 10 }, value: { show: true, color: isDark ? '#f4f4f5' : '#18181b', fontSize: '28px', fontWeight: 700, offsetY: -10 }, total: { show: true, label: 'Total', color: isDark ? '#a1a1aa' : '#71717a', fontSize: '13px', fontWeight: 400, formatter: w => w.globals.seriesTotals.reduce((a, b) => a + b, 0) } } } } },
                                        stroke: { show: false },
                                        dataLabels: { enabled: false },
                                        legend: { position: 'bottom', fontSize: '12px', labels: { colors: isDark ? '#a1a1aa' : '#71717a' }, markers: { width: 8, height: 8, radius: 4 } },
                                        theme: { mode: isDark ? 'dark' : 'light' }
                                    };
                                    new ApexCharts(this.$refs.projectDonut, opts).render();
                                };
                                typeof ApexCharts !== 'undefined' ? loadChart() : (() => { const s = document.createElement('script');
                                    s.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
                                    s.onload = loadChart;
                                    document.head.appendChild(s); })();
                            }
                        }">
                        <div
                            class="flex items-center justify-between border-b border-zinc-100 px-5 py-4 dark:border-zinc-800">
                            <div>
                                <p class="text-sm font-semibold text-zinc-900 dark:text-white">Projets de fin de module
                                </p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $mcd['totalProjects'] }} projets
                                    au total</p>
                            </div>
                            <div
                                class="flex size-9 items-center justify-center rounded-xl bg-blue-50 dark:bg-blue-950/40">
                                <flux:icon.document-check class="size-5 text-blue-600 dark:text-blue-400" />
                            </div>
                        </div>
                        @if ($mcd['hasProjectData'])
                            <div x-ref="projectDonut"></div>
                        @else
                            <div class="flex h-70 items-center justify-center text-sm text-zinc-400 dark:text-zinc-600">
                                Aucun projet assigné</div>
                        @endif
                    </div>

                    {{-- Project Status Cards (list) --}}
                    <div
                        class="col-span-1 overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                        <div
                            class="flex items-center justify-between border-b border-zinc-100 px-5 py-4 dark:border-zinc-800">
                            <div>
                                <p class="text-sm font-semibold text-zinc-900 dark:text-white">Récapitulatif</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">Vue d'ensemble rapide</p>
                            </div>
                            <div
                                class="flex size-9 items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-950/40">
                                <flux:icon.squares-2x2 class="size-5 text-emerald-600 dark:text-emerald-400" />
                            </div>
                        </div>
                        <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                            @foreach ([
        ['label' => 'Modules terminés', 'value' => $mcd['completedModules'], 'total' => $mcd['totalModules'], 'color' => 'bg-violet-500', 'icon' => 'check-circle', 'text' => 'text-violet-600 dark:text-violet-400'],
        ['label' => 'Modules en cours', 'value' => $mcd['inProgressModules'], 'total' => $mcd['totalModules'], 'color' => 'bg-amber-400', 'icon' => 'arrow-path', 'text' => 'text-amber-600 dark:text-amber-400'],
        ['label' => 'Projets validés', 'value' => $mcd['gradedProjects'], 'total' => $mcd['totalProjects'], 'color' => 'bg-emerald-500', 'icon' => 'academic-cap', 'text' => 'text-emerald-600 dark:text-emerald-400'],
        ['label' => 'Projets soumis', 'value' => $mcd['submittedProjects'], 'total' => $mcd['totalProjects'], 'color' => 'bg-blue-500', 'icon' => 'paper-airplane', 'text' => 'text-blue-600 dark:text-blue-400'],
        ['label' => 'Projets en attente', 'value' => $mcd['pendingProjects'], 'total' => $mcd['totalProjects'], 'color' => 'bg-zinc-400', 'icon' => 'clock', 'text' => 'text-zinc-500 dark:text-zinc-400'],
    ] as $item)
                                <div class="flex items-center gap-3 px-5 py-3">
                                    <flux:icon :icon="$item['icon']" class="size-4 shrink-0 {{ $item['text'] }}" />
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate">
                                            {{ $item['label'] }}</p>
                                        <div class="mt-1 flex items-center gap-2">
                                            <div
                                                class="h-1 flex-1 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">
                                                <div class="h-full rounded-full transition-all duration-700 {{ $item['color'] }}"
                                                    style="width: {{ $item['total'] > 0 ? round(($item['value'] / $item['total']) * 100) : 0 }}%">
                                                </div>
                                            </div>
                                            <span
                                                class="text-xs font-semibold text-zinc-700 dark:text-zinc-300 shrink-0">{{ $item['value'] }}/{{ $item['total'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Row 2: Per-formation module progress horizontal bars --}}
                @if ($mcd['formationBreakdown']->isNotEmpty())
                    <div class="overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900"
                        x-data="{
                            init() {
                                const breakdown = @js($mcd['formationBreakdown']);
                                if (!breakdown || breakdown.length === 0) return;
                                const isDark = document.documentElement.classList.contains('dark');
                                const loadChart = () => {
                                    const opts = {
                                        series: [
                                            { name: 'Terminés', data: breakdown.map(f => f.done) },
                                            { name: 'Restants', data: breakdown.map(f => f.total - f.done) },
                                        ],
                                        chart: { type: 'bar', height: Math.max(180, breakdown.length * 64), fontFamily: 'inherit', background: 'transparent', stacked: true, toolbar: { show: false } },
                                        plotOptions: { bar: { horizontal: true, borderRadius: 4, borderRadiusApplication: 'end', barHeight: '52%' } },
                                        colors: ['#8b5cf6', isDark ? '#3f3f46' : '#e4e4e7'],
                                        dataLabels: {
                                            enabled: true,
                                            formatter: (val, opts) => opts.seriesIndex === 0 && val > 0 ? val : '',
                                            style: { colors: ['#fff'], fontSize: '11px', fontWeight: 600 },
                                            dropShadow: { enabled: false }
                                        },
                                        xaxis: { categories: breakdown.map(f => f.name), labels: { style: { colors: isDark ? '#71717a' : '#a1a1aa', fontSize: '12px' }, formatter: v => Math.round(v) }, axisBorder: { show: false }, axisTicks: { show: false } },
                                        yaxis: { labels: { style: { colors: isDark ? '#a1a1aa' : '#71717a', fontSize: '12px', fontFamily: 'inherit' } } },
                                        grid: { borderColor: isDark ? '#27272a' : '#f4f4f5', strokeDashArray: 4, xaxis: { lines: { show: true } }, yaxis: { lines: { show: false } } },
                                        legend: { position: 'top', horizontalAlign: 'left', fontSize: '12px', labels: { colors: isDark ? '#a1a1aa' : '#71717a' }, markers: { width: 8, height: 8, radius: 4 } },
                                        tooltip: { shared: true, intersect: false },
                                        theme: { mode: isDark ? 'dark' : 'light' }
                                    };
                                    new ApexCharts(this.$refs.breakdownChart, opts).render();
                                };
                                typeof ApexCharts !== 'undefined' ? loadChart() : (() => { const s = document.createElement('script');
                                    s.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
                                    s.onload = loadChart;
                                    document.head.appendChild(s); })();
                            }
                        }">
                        <div
                            class="flex items-center justify-between border-b border-zinc-100 px-5 py-4 dark:border-zinc-800">
                            <div>
                                <p class="text-sm font-semibold text-zinc-900 dark:text-white">Avancement par formation
                                </p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">Modules terminés versus restants par
                                    cours</p>
                            </div>
                            <div
                                class="flex size-9 items-center justify-center rounded-xl bg-violet-50 dark:bg-violet-950/40">
                                <flux:icon.presentation-chart-bar class="size-5 text-violet-600 dark:text-violet-400" />
                            </div>
                        </div>
                        <div x-ref="breakdownChart" class="px-2"></div>
                    </div>
                @endif

            </div>
        @endif

        {{-- ==================== TABS ==================== --}}

        <div
            class="mb-6 flex items-center gap-1 overflow-x-auto rounded-xl border border-zinc-200/80 bg-white p-1 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            @php
                $tabs = [
                    ['key' => 'all', 'label' => 'Toutes', 'count' => $this->stats['total']],
                    ['key' => 'active', 'label' => 'Actives', 'count' => $this->stats['active']],
                    ['key' => 'completed', 'label' => 'Terminées', 'count' => $this->stats['completed']],
                    ['key' => 'cancelled', 'label' => 'Annulées', 'count' => $this->stats['cancelled']],
                ];
            @endphp
            @foreach ($tabs as $tab)
                <button wire:click="setTab('{{ $tab['key'] }}')"
                    class="relative flex flex-1 items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-medium transition-all duration-200
                        {{ $activeTab === $tab['key']
                            ? 'bg-emerald-600 text-white shadow-sm'
                            : 'text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white' }}"
                    id="tab-{{ $tab['key'] }}">
                    <span>{{ $tab['label'] }}</span>
                    <span
                        class="min-w-5 rounded-full px-1.5 py-0.5 text-xs font-semibold
                        {{ $activeTab === $tab['key']
                            ? 'bg-white/20 text-white'
                            : 'bg-zinc-100 text-zinc-600 dark:bg-zinc-700 dark:text-zinc-300' }}">
                        {{ $tab['count'] }}
                    </span>
                </button>
            @endforeach
        </div>

        {{-- ==================== LISTE DES INSCRIPTIONS ==================== --}}
        <div class="space-y-4" wire:poll.30s wire:loading.class="opacity-60" wire:target="setTab">

            @forelse ($this->registrations as $registration)
                @php
                    $formation = $registration->formation;

                    // Statut badge
                    $statusConfig = match ($registration->status) {
                        'approved' => [
                            'label' => 'Approuvée',
                            'class' =>
                                'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300',
                        ],
                        'pending' => [
                            'label' => 'En attente',
                            'class' =>
                                'border-yellow-200 bg-yellow-50 text-yellow-700 dark:border-yellow-800 dark:bg-yellow-950/50 dark:text-yellow-300',
                        ],
                        'waitlisted' => [
                            'label' => 'Liste d\'attente',
                            'class' =>
                                'border-blue-200 bg-blue-50 text-blue-700 dark:border-blue-800 dark:bg-blue-950/50 dark:text-blue-300',
                        ],
                        'cancelled' => [
                            'label' => 'Annulée',
                            'class' =>
                                'border-zinc-200 bg-zinc-100 text-zinc-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-400',
                        ],
                        'rejected' => [
                            'label' => 'Refusée',
                            'class' =>
                                'border-red-200 bg-red-50 text-red-700 dark:border-red-800 dark:bg-red-950/50 dark:text-red-400',
                        ],
                        default => [
                            'label' => ucfirst($registration->status),
                            'class' =>
                                'border-zinc-200 bg-zinc-100 text-zinc-500 dark:border-zinc-700 dark:bg-zinc-800',
                        ],
                    };

                    // Paiement badge
                    $paymentConfig = match ($registration->payment_status) {
                        'free' => [
                            'label' => 'Gratuite',
                            'class' => 'text-zinc-500 dark:text-zinc-400',
                            'icon' => 'gift',
                        ],
                        'paid' => [
                            'label' => 'Payée',
                            'class' => 'text-emerald-600 dark:text-emerald-400',
                            'icon' => 'check-circle',
                        ],
                        'pending' => [
                            'label' => 'Paiement en attente',
                            'class' => 'text-yellow-600 dark:text-yellow-400',
                            'icon' => 'clock',
                        ],
                        'failed' => [
                            'label' => 'Paiement échoué',
                            'class' => 'text-red-600 dark:text-red-400',
                            'icon' => 'x-circle',
                        ],
                        'refunded' => [
                            'label' => 'Remboursée',
                            'class' => 'text-blue-600 dark:text-blue-400',
                            'icon' => 'arrow-uturn-left',
                        ],
                        default => [
                            'label' => $registration->payment_status,
                            'class' => 'text-zinc-500',
                            'icon' => 'credit-card',
                        ],
                    };

                    // Présence badge
                    $attendanceConfig = match ($registration->attendance_status) {
                        'attended' => [
                            'label' => 'Présent',
                            'class' => 'text-emerald-600 dark:text-emerald-400',
                            'icon' => 'check-badge',
                        ],
                        'absent' => [
                            'label' => 'Absent',
                            'class' => 'text-red-500 dark:text-red-400',
                            'icon' => 'x-mark',
                        ],
                        'registered' => [
                            'label' => 'Inscrit',
                            'class' => 'text-blue-600 dark:text-blue-400',
                            'icon' => 'user-circle',
                        ],
                        default => [
                            'label' => $registration->attendance_status,
                            'class' => 'text-zinc-500',
                            'icon' => 'question-mark-circle',
                        ],
                    };

                    $canCancel = in_array($registration->status, ['pending', 'waitlisted'], true);

                    // Progression temporelle (basée sur les dates de la formation)
                    $progress = 0;
                    $progressLabel = '';
                    if ($formation->start_date && $formation->end_date) {
                        $now = now();
                        $start = \Carbon\Carbon::parse($formation->start_date);
                        $end = \Carbon\Carbon::parse($formation->end_date);
                        if ($now->lt($start)) {
                            $progress = 0;
                            $progressLabel = 'À venir';
                        } elseif ($now->gt($end)) {
                            $progress = 100;
                            $progressLabel = 'Terminée';
                        } else {
                            $total = $start->diffInMinutes($end);
                            $elapsed = $start->diffInMinutes($now);
                            $progress = $total > 0 ? min(100, intval(($elapsed / $total) * 100)) : 0;
                            $progressLabel = "En cours · {$progress}%";
                        }
                    }
                @endphp

                <article wire:key="reg-{{ $registration->id }}"
                    class="group overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm transition-all hover:border-emerald-200 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-emerald-800">

                    {{-- Cover image bar --}}
                    @if ($formation->cover_url)
                        <div class="h-1.5 w-full bg-linear-to-r from-emerald-500 to-teal-400 opacity-80"></div>
                    @endif

                    <div class="p-5 sm:p-6">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                            {{-- Infos principale --}}
                            <div class="flex items-start gap-4">
                                {{-- Cover thumbnail --}}
                                @if ($formation->thumb_url)
                                    <div class="hidden shrink-0 sm:block">
                                        <img src="{{ $formation->thumb_url }}" alt="{{ $formation->title }}"
                                            class="size-16 rounded-xl border border-zinc-100 object-cover dark:border-zinc-800">
                                    </div>
                                @else
                                    <div
                                        class="hidden size-16 shrink-0 items-center justify-center rounded-xl bg-linear-to-br from-emerald-100 to-teal-100 dark:from-emerald-950 dark:to-teal-950 sm:flex">
                                        <flux:icon.academic-cap
                                            class="size-7 text-emerald-600 dark:text-emerald-400" />
                                    </div>
                                @endif

                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <flux:badge class="{{ $statusConfig['class'] }} text-xs">
                                            {{ $statusConfig['label'] }}
                                        </flux:badge>
                                        @if ($formation->category)
                                            <span class="text-xs text-zinc-400 dark:text-zinc-500">
                                                {{ $formation->category->name }}
                                            </span>
                                        @endif
                                    </div>
                                    <h2 class="mt-1.5 text-base font-semibold text-zinc-900 dark:text-white">
                                        <a href="{{ route('formations.show', $formation) }}" wire:navigate
                                            class="transition hover:text-emerald-600 dark:hover:text-emerald-400">
                                            {{ $formation->title }}
                                        </a>
                                    </h2>
                                    @if ($formation->subtitle)
                                        <p class="mt-0.5 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-1">
                                            {{ $formation->subtitle }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="flex shrink-0 items-center gap-2">
                                <a href="{{ route('formations.show', $formation) }}" wire:navigate
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-zinc-200 bg-zinc-50 px-3 py-1.5 text-xs font-medium text-zinc-700 transition hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                                    <flux:icon.arrow-top-right-on-square class="size-3.5" />
                                    Accéder
                                </a>
                                @if ($canCancel)
                                    <button type="button" wire:click="confirmCancel('{{ $registration->id }}')"
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-zinc-200 bg-zinc-50 px-3 py-1.5 text-xs font-medium text-zinc-500 transition hover:border-red-300 hover:bg-red-50 hover:text-red-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:border-red-800 dark:hover:text-red-400">
                                        <flux:icon.x-mark class="size-3.5" />
                                        Annuler
                                    </button>
                                @endif
                            </div>
                        </div>

                        {{-- Méta-données --}}
                        <div
                            class="mt-4 grid grid-cols-2 gap-2 border-t border-zinc-100 pt-4 dark:border-zinc-800 sm:grid-cols-4">

                            {{-- Paiement --}}
                            <div class="flex items-center gap-2">
                                <flux:icon :icon="$paymentConfig['icon']"
                                    class="size-4 shrink-0 {{ $paymentConfig['class'] }}" />
                                <div>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500">Paiement</p>
                                    <p class="text-xs font-semibold {{ $paymentConfig['class'] }}">
                                        {{ $paymentConfig['label'] }}
                                        @if ($registration->amount && $registration->payment_status !== 'free')
                                            · {{ number_format((float) $registration->amount, 0, ',', ' ') }}
                                            {{ $registration->currency }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Présence --}}
                            <div class="flex items-center gap-2">
                                <flux:icon :icon="$attendanceConfig['icon']"
                                    class="size-4 shrink-0 {{ $attendanceConfig['class'] }}" />
                                <div>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500">Présence</p>
                                    <p class="text-xs font-semibold {{ $attendanceConfig['class'] }}">
                                        {{ $attendanceConfig['label'] }}
                                    </p>
                                </div>
                            </div>

                            {{-- Dates --}}
                            <div class="flex items-center gap-2">
                                <flux:icon.calendar-days class="size-4 shrink-0 text-zinc-400 dark:text-zinc-500" />
                                <div>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500">Période</p>
                                    <p class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">
                                        @if ($formation->start_date)
                                            {{ \Carbon\Carbon::parse($formation->start_date)->translatedFormat('d M Y') }}
                                            @if ($formation->end_date)
                                                →
                                                {{ \Carbon\Carbon::parse($formation->end_date)->translatedFormat('d M Y') }}
                                            @endif
                                        @else
                                            <span class="text-zinc-400">Non défini</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Inscrit le --}}
                            <div class="flex items-center gap-2">
                                <flux:icon.clock class="size-4 shrink-0 text-zinc-400 dark:text-zinc-500" />
                                <div>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500">Inscrit le</p>
                                    <p class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">
                                        {{ $registration->created_at->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Barre de progression temporelle --}}
                        @if ($progress > 0 || $progressLabel === 'À venir')
                            <div class="mt-4">
                                <div
                                    class="flex items-center justify-between text-xs text-zinc-400 dark:text-zinc-500 mb-1.5">
                                    <span>Progression</span>
                                    <span
                                        class="font-medium {{ $progress >= 100 ? 'text-emerald-600 dark:text-emerald-400' : ($progress > 0 ? 'text-blue-600 dark:text-blue-400' : 'text-zinc-400') }}">
                                        {{ $progressLabel ?: "{$progress}%" }}
                                    </span>
                                </div>
                                <div class="h-1.5 w-full overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <div class="h-full rounded-full transition-all duration-700
                                        {{ $progress >= 100 ? 'bg-emerald-500' : 'bg-linear-to-r from-emerald-500 to-teal-400' }}"
                                        style="width: {{ $progress }}%">
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Prochaine échéance (si à venir) --}}
                        @if ($formation->start_date && now()->lt(\Carbon\Carbon::parse($formation->start_date)))
                            @php
                                $daysLeft = now()->diffInDays(\Carbon\Carbon::parse($formation->start_date));
                                $urgency =
                                    $daysLeft <= 3
                                        ? 'text-red-600 dark:text-red-400'
                                        : ($daysLeft <= 7
                                            ? 'text-yellow-600 dark:text-yellow-400'
                                            : 'text-emerald-600 dark:text-emerald-400');
                            @endphp
                            <div
                                class="mt-3 flex items-center gap-2 rounded-lg border border-dashed border-zinc-200 bg-zinc-50 px-3 py-2 dark:border-zinc-700 dark:bg-zinc-800/60">
                                <flux:icon.bell-alert class="size-4 {{ $urgency }}" />
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                    Prochaine échéance : <span class="font-semibold {{ $urgency }}">dans
                                        {{ $daysLeft }} jour{{ $daysLeft > 1 ? 's' : '' }}</span>
                                    · {{ \Carbon\Carbon::parse($formation->start_date)->translatedFormat('l d F Y') }}
                                </p>
                            </div>
                        @endif

                        {{-- Accès en ligne (badge si online) --}}
                        @if ($formation->location && str_contains(strtolower($formation->location), 'en ligne'))
                            <div
                                class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 dark:border-blue-800 dark:bg-blue-950/50 dark:text-blue-300">
                                <flux:icon.signal class="size-3.5" />
                                Accès en ligne disponible
                            </div>
                        @elseif ($formation->location)
                            <div
                                class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-zinc-50 px-3 py-1 text-xs font-medium text-zinc-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-400">
                                <flux:icon.map-pin class="size-3.5" />
                                {{ $formation->location }}
                            </div>
                        @endif
                    </div>
                </article>
            @empty
                <div
                    class="rounded-2xl border border-dashed border-zinc-300 bg-white px-6 py-20 text-center dark:border-zinc-700 dark:bg-zinc-900">
                    <div
                        class="mx-auto flex size-14 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                        <flux:icon.academic-cap class="size-7 text-zinc-400 dark:text-zinc-500" />
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-zinc-900 dark:text-white">Aucune formation
                        @if ($activeTab !== 'all')
                            dans cette catégorie
                        @endif
                    </h3>
                    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                        @if ($activeTab === 'all')
                            Vous n'avez pas encore rejoint de formation. Explorez notre catalogue !
                        @else
                            Essayez un autre filtre ou inscrivez-vous à une formation.
                        @endif
                    </p>
                    <a href="{{ route('formations.index') }}" wire:navigate
                        class="mt-6 inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        Voir les formations
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Indicateur de mise à jour en temps réel --}}
        <div class="mt-6 flex items-center justify-center gap-2 text-xs text-zinc-400 dark:text-zinc-500">
            <span class="relative flex size-2">
                <span
                    class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex size-2 rounded-full bg-emerald-500"></span>
            </span>
            Mise à jour automatique toutes les 30 secondes
        </div>
    </div>

    {{-- ==================== MODALE CONFIRMATION ANNULATION ==================== --}}
    <flux:modal wire:model.self="cancellingId" name="cancel-confirm" class="max-w-md p-0! overflow-hidden">

        {{-- Accent top bar --}}
        <div class="h-1 w-full bg-linear-to-r from-red-500 via-rose-500 to-pink-500"></div>

        <div class="p-6">
            {{-- Icon + heading --}}
            <div class="flex items-start gap-4">
                <div
                    class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-red-50 ring-1 ring-red-100 dark:bg-red-950/40 dark:ring-red-900/50">
                    <flux:icon.exclamation-triangle class="size-6 text-red-600 dark:text-red-400" />
                </div>
                <div class="flex-1 min-w-0 pt-0.5">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-white">
                        Confirmer l'annulation
                    </h2>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">
                        Souhaitez-vous annuler votre inscription à cette formation ?
                    </p>
                </div>
            </div>

            {{-- Warning notice --}}
            <div
                class="mt-5 flex items-start gap-3 rounded-xl border border-amber-200/70 bg-amber-50/80 px-4 py-3 dark:border-amber-800/40 dark:bg-amber-950/30">
                <flux:icon.information-circle class="mt-0.5 size-4 shrink-0 text-amber-600 dark:text-amber-400" />
                <p class="text-xs leading-relaxed text-amber-700 dark:text-amber-300">
                    <span class="font-semibold">Cette action est irréversible.</span>
                    Votre place sera libérée et une confirmation vous sera envoyée par e-mail.
                </p>
            </div>

            {{-- Actions --}}
            <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row">
                <flux:button wire:click="$set('cancellingId', null)"
                    class="flex-1 rounded-xl! border-zinc-200! bg-white! text-zinc-700! hover:bg-zinc-50! dark:border-zinc-700! dark:bg-zinc-800/60! dark:text-zinc-300! dark:hover:bg-zinc-800!">
                    <flux:icon.arrow-left class="size-4 mr-1.5" />
                    Non, garder mon inscription
                </flux:button>

                <button type="button" wire:click="cancelRegistration" wire:loading.attr="disabled"
                    class="group relative flex flex-1 items-center justify-center gap-2 overflow-hidden rounded-xl bg-linear-to-r from-red-600 to-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-red-500/20 transition-all hover:from-red-700 hover:to-rose-700 hover:shadow-red-500/30 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-60">
                    <span wire:loading.remove wire:target="cancelRegistration" class="flex items-center gap-2">
                        <flux:icon.x-mark class="size-4" />
                        Oui, annuler l'inscription
                    </span>
                    <span wire:loading wire:target="cancelRegistration" class="flex items-center gap-2">
                        <svg class="size-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Annulation en cours…
                    </span>
                    {{-- shine effect --}}
                    <span
                        class="absolute inset-0 -translate-x-full skew-x-12 bg-white/10 transition-transform duration-700 group-hover:translate-x-full"
                        aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </flux:modal>
</div>
