<?php

namespace App\Filament\Resources\FormationModules\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
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
                            ->label('Titre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                if (! $get('slug') && $state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Identifiant unique pour l\'URL'),

                        TextInput::make('sort_order')
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
