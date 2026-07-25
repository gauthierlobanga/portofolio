<?php

namespace App\Filament\Resources\FormationModules\RelationManagers;

use App\Filament\Resources\ModuleProjects\Schemas\ModuleProjectForm;
use App\Filament\Resources\ModuleProjects\Tables\ModuleProjectsTable;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'projects';

    public function form(Schema $schema): Schema
    {
        return ModuleProjectForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return ModuleProjectsTable::configure($table)
            ->recordTitleAttribute('title')
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
