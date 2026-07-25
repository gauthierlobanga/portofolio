<?php

namespace App\Filament\Resources\UserModuleProgress\Pages;

use App\Filament\Resources\UserModuleProgress\UserModuleProgressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserModuleProgress extends ListRecords
{
    protected static string $resource = UserModuleProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
