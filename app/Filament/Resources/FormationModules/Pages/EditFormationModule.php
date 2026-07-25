<?php

namespace App\Filament\Resources\FormationModules\Pages;

use App\Filament\Resources\FormationModules\FormationModuleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFormationModule extends EditRecord
{
    protected static string $resource = FormationModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
