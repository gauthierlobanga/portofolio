<?php

namespace App\Filament\Resources\FormationModules\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class FormationModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informations du module')
                    ->columns(2)
                    ->schema([
                        Select::make('formation_id')
                            ->relationship('formation', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        TextInput::make('order_column')
                            ->label('Ordre')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true)
                            ->columnSpanFull(),
                    ]),

                Section::make('Contenu')
                    ->schema([
                        RichEditor::make('description')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
