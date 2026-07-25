<?php

namespace App\Filament\Resources\ModuleProjects\RelationManagers;

use App\Filament\Resources\UserProjectSubmissions\Schemas\UserProjectSubmissionForm;
use App\Filament\Resources\UserProjectSubmissions\Tables\UserProjectSubmissionsTable;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class SubmissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'submissions';

    public function form(Schema $schema): Schema
    {
        return UserProjectSubmissionForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return UserProjectSubmissionsTable::configure($table)
            ->recordTitleAttribute('status')
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
