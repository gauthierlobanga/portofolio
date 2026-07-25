<?php

namespace App\Filament\Resources\UserProjectSubmissions\Pages;

use App\Filament\Resources\UserProjectSubmissions\UserProjectSubmissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserProjectSubmissions extends ListRecords
{
    protected static string $resource = UserProjectSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
