<?php

namespace App\Filament\Resources\ModuleProjects\Schemas;


use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ModuleProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informations du projet')
                    ->columns(2)
                    ->schema([
                        Select::make('formation_module_id')
                            ->relationship('module', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('deadline_days')
                            ->label('Délai (jours)')
                            ->numeric()
                            ->default(7),

                        TextInput::make('points')
                            ->label('Points / Note max')
                            ->numeric()
                            ->default(100),

                        Toggle::make('is_mandatory')
                            ->label('Obligatoire')
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
