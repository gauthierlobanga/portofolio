<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h2 class="flex items-center gap-3 text-lg font-medium tracking-tight text-zinc-900 dark:text-white">
            <span class="flex h-10 w-10 items-center justify-center rounded-full border border-black/5 bg-zinc-50 dark:border-white/5 dark:bg-white/5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-emerald-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
            </span>
            Analytiques d'Apprentissage
        </h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Chart 1: Average Score -->
        <div class="bg-white dark:bg-zinc-800 p-6 rounded-3xl border border-zinc-200 dark:border-zinc-700 shadow-sm relative overflow-hidden group">
            <h3 class="text-lg font-medium text-zinc-900 dark:text-white mb-4">Score Moyen Global</h3>
            <div class="flex items-center gap-4">
                <div class="text-4xl font-bold text-emerald-500">{{ $averageScore }}%</div>
                <div class="text-sm text-zinc-500">Moyenne de vos évaluations notées</div>
            </div>
            
            <div x-data="averageScoreChart()" x-init="initChart" class="mt-6 flex justify-center">
                <div x-ref="chart"></div>
            </div>
        </div>

        <!-- Chart 2: Type distribution -->
        <div class="bg-white dark:bg-zinc-800 p-6 rounded-3xl border border-zinc-200 dark:border-zinc-700 shadow-sm relative overflow-hidden group">
            <h3 class="text-lg font-medium text-zinc-900 dark:text-white mb-4">Répartition des Évaluations</h3>
            <div x-data="typeDistributionChart()" x-init="initChart" class="mt-2 flex justify-center">
                <div x-ref="chart"></div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            const loadApexCharts = (callback) => {
                if (typeof ApexCharts !== 'undefined') {
                    callback();
                    return;
                }
                const script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
                script.onload = callback;
                document.head.appendChild(script);
            };

            Alpine.data('averageScoreChart', () => ({
                initChart() {
                    loadApexCharts(() => {
                        const options = {
                            series: [{{ $averageScore }}],
                            chart: { height: 250, type: 'radialBar' },
                            plotOptions: {
                                radialBar: {
                                    hollow: { size: '60%' },
                                    dataLabels: { showOn: 'always', name: { show: false }, value: { color: '#10B981', fontSize: '30px', show: true } }
                                }
                            },
                            colors: ['#10B981'],
                        };
                        const chart = new ApexCharts(this.$refs.chart, options);
                        chart.render();
                    });
                }
            }));

            Alpine.data('typeDistributionChart', () => ({
                initChart() {
                    loadApexCharts(() => {
                        const options = {
                            series: [{{ $typeDistribution->get('tp', 0) }}, {{ $typeDistribution->get('td', 0) }}, {{ $typeDistribution->get('exam', 0) }}, {{ $typeDistribution->get('quiz', 0) }}, {{ $typeDistribution->get('admission', 0) }}],
                            labels: ['TP', 'TD', 'Examen', 'Quiz', 'Admission'],
                            chart: { height: 250, type: 'donut' },
                            colors: ['#3B82F6', '#8B5CF6', '#F59E0B', '#10B981'],
                            legend: { position: 'bottom' }
                        };
                        const chart = new ApexCharts(this.$refs.chart, options);
                        chart.render();
                    });
                }
            }));
        });
    </script>
</div>
