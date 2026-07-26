<?php

namespace App\Filament\Resources\UserProjectSubmissions;

use App\Filament\Resources\UserProjectSubmissions\Pages\CreateUserProjectSubmission;
use App\Filament\Resources\UserProjectSubmissions\Pages\EditUserProjectSubmission;
use App\Filament\Resources\UserProjectSubmissions\Pages\ListUserProjectSubmissions;
use App\Filament\Resources\UserProjectSubmissions\Schemas\UserProjectSubmissionForm;
use App\Filament\Resources\UserProjectSubmissions\Tables\UserProjectSubmissionsTable;
use App\Models\UserProjectSubmission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserProjectSubmissionResource extends Resource
{
    protected static ?string $model = UserProjectSubmission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    protected static string|\UnitEnum|null $navigationGroup = 'Utilisateurs';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return UserProjectSubmissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserProjectSubmissionsTable::configure($table);
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
            'index' => ListUserProjectSubmissions::route('/'),
            'create' => CreateUserProjectSubmission::route('/create'),
            'edit' => EditUserProjectSubmission::route('/{record}/edit'),
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
