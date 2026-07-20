{{-- resources/views/livewire/skills-section.blade.php --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-slate-50 py-24 sm:py-32 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-950">
    <div class="absolute inset-0 -z-10 opacity-80">
        <div class="absolute left-1/2 top-0 h-72 w-72 -translate-x-1/2 rounded-full bg-emerald-500/10 blur-3xl"></div>
        <div class="absolute right-0 top-24 h-96 w-96 rounded-full bg-teal-400/10 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(16,185,129,0.12),_transparent_22%),radial-gradient(circle_at_bottom_right,_rgba(14,165,233,0.08),_transparent_20%)]"></div>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center mb-16 sm:mb-20">
            @if ($this->about->skill_title || $this->about->skill_subtitle)
                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-100/80 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-emerald-700 shadow-sm shadow-emerald-200/40 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-200">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 15V9a5 5 0 0110 0v6" />
                        <path d="M2 15h12" />
                        <path d="M17 17h5" />
                        <path d="M17 21h5" />
                    </svg>
                    Section Compétences
                </div>
            @endif

            <h2 class="mt-6 text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-5xl">
                {{ $this->about->skill_title ?: 'Compétences' }}
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                {{ $this->about->skill_subtitle ?: 'Un aperçu des technologies et outils que je maîtrise au quotidien.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($this->categories as $categoryId => $skills)
                @php
                    $category = $skills->first()->categorySkill;
                    $color = $category?->color ?? '#10b981';
                @endphp

                <div x-data="{ shown: false, animated: false }"
                    x-intersect.threshold.25="shown = true; if (!animated) { animated = true; $nextTick(() => { animateBars(); }); }"
                    class="group relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/90 p-6 shadow-[0_40px_120px_-60px_rgba(16,185,129,0.45)] transition duration-500 ease-out hover:-translate-y-1 hover:shadow-[0_40px_120px_-50px_rgba(16,185,129,0.2)] dark:border-zinc-800/70 dark:bg-zinc-950/90 dark:shadow-[0_40px_120px_-60px_rgba(15,23,42,0.65)]"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-r from-emerald-500/10 via-transparent to-teal-400/10"></div>
                    <div class="relative">
                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-gradient-to-br from-emerald-500 to-teal-500 text-white shadow-lg shadow-emerald-500/20">
                                @if ($category && $category->icon)
                                    @svg('heroicon-o-' . $category->icon, 'h-6 w-6')
                                @else
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                @endif
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-emerald-600 dark:text-emerald-400">
                                    {{ $category?->name ?? 'Non classé' }}
                                </p>
                                <h3 class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-white">
                                    {{ $category?->name ?: 'Compétences' }}
                                </h3>
                            </div>

                            <span class="ml-auto inline-flex items-center rounded-full border border-zinc-200 bg-zinc-100 px-3 py-1 text-xs font-semibold uppercase text-zinc-700 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300">
                                {{ $skills->count() }} compétences
                            </span>
                        </div>

                        <div class="mt-6 grid gap-4">
                            @foreach ($skills as $skill)
                                <div x-data="{ width: 0 }"
                                    x-init="$watch('shown', value => { if (value) setTimeout(() => width = {{ $skill->level }}, 100 + {{ $loop->index }} * 60) })"
                                    class="rounded-3xl border border-zinc-200/70 bg-zinc-50 p-4 dark:border-zinc-800/70 dark:bg-zinc-900/80">
                                    <div class="flex items-center justify-between gap-4 text-sm font-semibold text-zinc-900 dark:text-white">
                                        <span>{{ $skill->name }}</span>
                                        <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-zinc-500 dark:bg-zinc-800 dark:text-zinc-300"
                                            x-text="width + '%'">0%</span>
                                    </div>
                                    <div class="mt-3 h-2.5 overflow-hidden rounded-full bg-zinc-200 dark:bg-zinc-800">
                                        <div class="h-full rounded-full transition-all duration-1000 ease-out"
                                            :style="'width: ' + width + '%; background: linear-gradient(90deg, ' + '{{ $color }}' + ', ' + '{{ $color }}' + 'cc)'">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-between gap-3 text-sm text-zinc-500 dark:text-zinc-400">
                        <span class="inline-flex items-center gap-2 rounded-full bg-zinc-100 px-3 py-1 dark:bg-zinc-900">
                            <span class="h-2.5 w-2.5 rounded-full" style="background-color: {{ $color }}"></span>
                            Progression visuelle
                        </span>
                        <span class="hidden sm:inline text-xs uppercase tracking-[0.24em] text-zinc-400">Design premium</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
