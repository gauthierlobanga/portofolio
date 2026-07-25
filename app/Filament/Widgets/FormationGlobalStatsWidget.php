<?php

namespace App\Filament\Widgets;

use App\Models\FormationRegistration;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FormationGlobalStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalRevenue = FormationRegistration::where('payment_status', 'paid')->sum('amount');
        $totalPending = FormationRegistration::where('payment_status', 'pending')->sum('amount');
        $totalStudents = FormationRegistration::whereIn('status', ['approved', 'pending'])->distinct('user_id')->count('user_id');

        return [
            Stat::make('Revenus (Payé)', number_format($totalRevenue, 2, ',', ' ').' €')
                ->description('Total des inscriptions payées')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('En attente', number_format($totalPending, 2, ',', ' ').' €')
                ->description('Paiements en attente')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Apprenants actifs', $totalStudents)
                ->description('Total d\'utilisateurs uniques inscrits')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
