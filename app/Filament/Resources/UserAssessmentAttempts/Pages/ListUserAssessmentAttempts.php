<?php

namespace App\Filament\Resources\UserAssessmentAttempts\Pages;

use App\Filament\Resources\UserAssessmentAttempts\UserAssessmentAttemptResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserAssessmentAttempts extends ListRecords
{
    protected static string $resource = UserAssessmentAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
