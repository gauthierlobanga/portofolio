<?php

namespace App\Filament\Widgets;

use App\Models\FormationModule;
use App\Models\ModuleProject;
use App\Models\UserProjectSubmission;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FormationModuleStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Modules', FormationModule::count())
                ->description('Tous les modules de formation')
                ->descriptionIcon('heroicon-m-square-3-stack-3d')
                ->color('primary'),

            Stat::make('Total Projets', ModuleProject::count())
                ->description('Projets créés')
                ->descriptionIcon('heroicon-m-beaker')
                ->color('success'),

            Stat::make('Projets Soumis', UserProjectSubmission::count())
                ->description('Total des soumissions')
                ->descriptionIcon('heroicon-m-document-check')
                ->color('info'),
        ];
    }
}
