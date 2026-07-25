<?php

namespace App\Filament\Resources\Formations\RelationManagers;

use App\Filament\Resources\FormationRegistrations\Schemas\FormationRegistrationForm;
use App\Filament\Resources\FormationRegistrations\Tables\FormationRegistrationsTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class RegistrationsRelationManager extends RelationManager
{
    protected static string $relationship = 'registrations';

    public function form(Schema $schema): Schema
    {
        return FormationRegistrationForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return FormationRegistrationsTable::configure($table);
    }
}
