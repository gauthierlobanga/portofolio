<?php

namespace App\Filament\Resources\FormationModules\Pages;

use App\Filament\Resources\FormationModules\FormationModuleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFormationModules extends ListRecords
{
    protected static string $resource = FormationModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
