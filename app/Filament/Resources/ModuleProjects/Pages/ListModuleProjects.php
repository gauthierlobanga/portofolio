<?php

namespace App\Filament\Resources\ModuleProjects\Pages;

use App\Filament\Resources\ModuleProjects\ModuleProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModuleProjects extends ListRecords
{
    protected static string $resource = ModuleProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
