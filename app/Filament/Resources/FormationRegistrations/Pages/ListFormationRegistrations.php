<?php

namespace App\Filament\Resources\FormationRegistrations\Pages;

use App\Filament\Resources\FormationRegistrations\FormationRegistrationResource;
use Filament\Resources\Pages\ListRecords;

class ListFormationRegistrations extends ListRecords
{
    protected static string $resource = FormationRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
