<?php

namespace App\Filament\Resources\FormationModules\RelationManagers;

use App\Filament\Resources\UserModuleProgress\Schemas\UserModuleProgressForm;
use App\Filament\Resources\UserModuleProgress\Tables\UserModuleProgressTable;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class UserProgressRelationManager extends RelationManager
{
    protected static string $relationship = 'userProgress';

    public function form(Schema $schema): Schema
    {
        return UserModuleProgressForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return UserModuleProgressTable::configure($table)
            ->recordTitleAttribute('status')
            ->headerActions([
               CreateAction::make(),
            ]);
    }
}
