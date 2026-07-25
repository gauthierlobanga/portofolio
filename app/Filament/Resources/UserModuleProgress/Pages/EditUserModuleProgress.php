<?php

namespace App\Filament\Resources\UserModuleProgress\Pages;

use App\Filament\Resources\UserModuleProgress\UserModuleProgressResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserModuleProgress extends EditRecord
{
    protected static string $resource = UserModuleProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
