<?php

namespace App\Filament\Resources\FormationRegistrations;

use App\Enums\NavigationGroup;
use App\Filament\Resources\FormationRegistrations\Pages\EditFormationRegistration;
use App\Filament\Resources\FormationRegistrations\Pages\ListFormationRegistrations;
use App\Filament\Resources\FormationRegistrations\Schemas\FormationRegistrationForm;
use App\Filament\Resources\FormationRegistrations\Tables\FormationRegistrationsTable;
use App\Models\FormationRegistration;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class FormationRegistrationResource extends Resource
{
    protected static ?string $model = FormationRegistration::class;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::Content;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getNavigationLabel(): string
    {
        return 'Inscriptions aux formations';
    }

    public static function getModelLabel(): string
    {
        return 'inscription';
    }

    public static function getPluralModelLabel(): string
    {
        return 'inscriptions';
    }

    public static function form(Schema $schema): Schema
    {
        return FormationRegistrationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FormationRegistrationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFormationRegistrations::route('/'),
            'edit' => EditFormationRegistration::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): null|string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'warning';
    }
}
