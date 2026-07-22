<?php

namespace App\Filament\Resources\Education\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EducationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Établissement et diplôme')
                    ->description('Informations sur l’institution et la formation suivie.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('institution')
                                    ->label('Établissement')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ex. : Université de Kinshasa'),
                                TextInput::make('degree')
                                    ->label('Diplôme / Certificat')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ex. : Licence en Informatique'),
                            ]),
                        TextInput::make('field_of_study')
                            ->label('Domaine d’études')
                            ->maxLength(255)
                            ->placeholder('Ex. : Génie Logiciel'),
                    ]),

                Section::make('Période et statut')
                    ->description('Dates de début et de fin de la formation.')
                    ->icon('heroicon-o-calendar')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DatePicker::make('start_date')
                                    ->label('Date de début')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d/m/Y'),
                                DatePicker::make('end_date')
                                    ->label('Date de fin')
                                    ->native(false)
                                    ->displayFormat('d/m/Y')
                                    ->after('start_date')
                                    ->helperText('Laissez vide si en cours.'),
                                Toggle::make('is_current')
                                    ->label('En cours')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->helperText('Activez si vous suivez encore cette formation.'),
                            ]),
                    ]),

                Section::make('Description')
                    ->description('Détails supplémentaires sur la formation.')
                    ->icon('heroicon-o-pencil-square')
                    ->schema([
                        RichEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->json()
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList',
                                'undo', 'redo',
                            ]),
                    ]),

                Section::make('Paramètres')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Ordre d’affichage')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Plus petit = premier.'),
                    ]),
            ]);
    }
}
