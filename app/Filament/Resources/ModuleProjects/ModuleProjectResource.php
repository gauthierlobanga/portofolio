<?php

namespace App\Filament\Resources\ModuleProjects;

use App\Filament\Resources\ModuleProjects\Pages\CreateModuleProject;
use App\Filament\Resources\ModuleProjects\Pages\EditModuleProject;
use App\Filament\Resources\ModuleProjects\Pages\ListModuleProjects;
use App\Filament\Resources\ModuleProjects\RelationManagers\SubmissionsRelationManager;
use App\Filament\Resources\ModuleProjects\Schemas\ModuleProjectForm;
use App\Filament\Resources\ModuleProjects\Tables\ModuleProjectsTable;
use App\Models\ModuleProject;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ModuleProjectResource extends Resource
{
    protected static ?string $model = ModuleProject::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBeaker;

    protected static string|\UnitEnum|null $navigationGroup = 'Portofolio';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ModuleProjectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModuleProjectsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SubmissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListModuleProjects::route('/'),
            'create' => CreateModuleProject::route('/create'),
            'edit' => EditModuleProject::route('/{record}/edit'),
        ];
    }
}
