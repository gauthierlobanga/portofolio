<?php

namespace App\Filament\Resources\Formations\RelationManagers;

use App\Filament\Resources\FormationModules\Schemas\FormationModuleForm;
use App\Filament\Resources\FormationModules\Tables\FormationModulesTable;
use Filament\Actions\AssociateAction;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ModulesRelationManager extends RelationManager
{
    protected static string $relationship = 'modules';

    public function form(Schema $schema): Schema
    {
        return FormationModuleForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return FormationModulesTable::configure($table)
            ->recordTitleAttribute('title')
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make()
                    ->preloadRecordSelect(),
            ]);
    }
}
