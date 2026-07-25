<?php

namespace App\Filament\Resources\ModuleProjects\Pages;

use App\Filament\Resources\ModuleProjects\ModuleProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModuleProject extends EditRecord
{
    protected static string $resource = ModuleProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
