<?php

namespace App\Filament\Resources\UserProjectSubmissions\Pages;

use App\Filament\Resources\UserProjectSubmissions\UserProjectSubmissionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserProjectSubmission extends CreateRecord
{
    protected static string $resource = UserProjectSubmissionResource::class;
}
