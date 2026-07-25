<?php

namespace App\Filament\Resources\UserProjectSubmissions\Pages;

use App\Filament\Resources\UserProjectSubmissions\UserProjectSubmissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserProjectSubmission extends EditRecord
{
    protected static string $resource = UserProjectSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
