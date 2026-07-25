<?php

namespace App\Filament\Resources\FormationRegistrations\Pages;

use App\Filament\Resources\FormationRegistrations\FormationRegistrationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditFormationRegistration extends EditRecord
{
    protected static string $resource = FormationRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
