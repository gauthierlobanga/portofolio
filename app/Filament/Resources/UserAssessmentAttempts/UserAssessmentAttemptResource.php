<?php

namespace App\Filament\Resources\UserAssessmentAttempts;

use App\Filament\Resources\UserAssessmentAttempts\Pages\CreateUserAssessmentAttempt;
use App\Filament\Resources\UserAssessmentAttempts\Pages\EditUserAssessmentAttempt;
use App\Filament\Resources\UserAssessmentAttempts\Pages\ListUserAssessmentAttempts;
use App\Filament\Resources\UserAssessmentAttempts\Schemas\UserAssessmentAttemptForm;
use App\Filament\Resources\UserAssessmentAttempts\Tables\UserAssessmentAttemptsTable;
use App\Models\UserAssessmentAttempt;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UserAssessmentAttemptResource extends Resource
{
    protected static ?string $model = UserAssessmentAttempt::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencilSquare;

    protected static string|UnitEnum|null $navigationGroup = 'Utilisateurs';

    public static function form(Schema $schema): Schema
    {
        return UserAssessmentAttemptForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserAssessmentAttemptsTable::configure($table);
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
            'index' => ListUserAssessmentAttempts::route('/'),
            'create' => CreateUserAssessmentAttempt::route('/create'),
            'edit' => EditUserAssessmentAttempt::route('/{record}/edit'),
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
