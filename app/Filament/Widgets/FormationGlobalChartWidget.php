<?php

namespace App\Filament\Widgets;

use App\Models\FormationRegistration;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class FormationGlobalChartWidget extends ChartWidget
{
    protected ?string $heading = 'Inscriptions aux formations (6 derniers mois)';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = ucfirst($month->translatedFormat('F Y'));
            $data[] = FormationRegistration::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Nouvelles inscriptions',
                    'data' => $data,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
