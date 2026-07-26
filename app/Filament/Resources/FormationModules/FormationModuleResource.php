<?php

namespace App\Filament\Resources\FormationModules;

use App\Enums\NavigationGroup;
use App\Filament\Resources\FormationModules\Pages\CreateFormationModule;
use App\Filament\Resources\FormationModules\Pages\EditFormationModule;
use App\Filament\Resources\FormationModules\Pages\ListFormationModules;
use App\Filament\Resources\FormationModules\RelationManagers\ProjectsRelationManager;
use App\Filament\Resources\FormationModules\RelationManagers\UserProgressRelationManager;
use App\Filament\Resources\FormationModules\Schemas\FormationModuleForm;
use App\Filament\Resources\FormationModules\Tables\FormationModulesTable;
use App\Models\FormationModule;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class FormationModuleResource extends Resource
{
    protected static ?string $model = FormationModule::class;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::Content;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return FormationModuleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FormationModulesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ProjectsRelationManager::class,
            UserProgressRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFormationModules::route('/'),
            'create' => CreateFormationModule::route('/create'),
            'edit' => EditFormationModule::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'warning';
    }
}
