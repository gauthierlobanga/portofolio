<?php

namespace App\Filament\Resources\UserModuleProgress;

use App\Filament\Resources\UserModuleProgress\Pages\CreateUserModuleProgress;
use App\Filament\Resources\UserModuleProgress\Pages\EditUserModuleProgress;
use App\Filament\Resources\UserModuleProgress\Pages\ListUserModuleProgress;
use App\Filament\Resources\UserModuleProgress\Schemas\UserModuleProgressForm;
use App\Filament\Resources\UserModuleProgress\Tables\UserModuleProgressTable;
use App\Models\UserModuleProgress;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserModuleProgressResource extends Resource
{
    protected static ?string $model = UserModuleProgress::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static string|\UnitEnum|null $navigationGroup = 'Utilisateurs';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return UserModuleProgressForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserModuleProgressTable::configure($table);
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
            'index' => ListUserModuleProgress::route('/'),
            'create' => CreateUserModuleProgress::route('/create'),
            'edit' => EditUserModuleProgress::route('/{record}/edit'),
        ];
    }
}
