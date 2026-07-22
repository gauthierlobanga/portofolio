<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informations générales')
                    ->description('Poste, entreprise et lieu.')
                    ->icon('heroicon-o-briefcase')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titre du poste')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ex. : Développeur Full‑Stack'),
                                TextInput::make('company')
                                    ->label('Entreprise')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ex. : Freelance, Startup'),
                            ]),
                        TextInput::make('position')
                            ->label('Intitulé exact')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex. : Lead Developer'),
                        TextInput::make('location')
                            ->label('Lieu')
                            ->maxLength(255)
                            ->placeholder('Ex. : Kinshasa, Remote'),
                    ]),

                Section::make('Période')
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
                                    ->helperText('Laissez vide si poste actuel.'),
                                Toggle::make('is_current')
                                    ->label('Poste actuel')
                                    ->onColor('success')
                                    ->offColor('danger'),
                            ]),
                    ]),

                Section::make('Description')
                    ->icon('heroicon-o-pencil-square')
                    ->schema([
                        RichEditor::make('description')
                            ->label('Missions et réalisations')
                            ->columnSpanFull()
                            ->json()
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList', 'blockquote',
                                'undo', 'redo',
                            ]),
                    ]),

                Section::make('Technologies utilisées')
                    ->icon('heroicon-o-code-bracket')
                    ->schema([
                        TagsInput::make('technologies')
                            ->label('Technologies')
                            ->placeholder('Ajoutez une technologie et validez avec Entrée')
                            ->suggestions([
                                'Laravel', 'Livewire', 'Alpine.js', 'Tailwind CSS',
                                'React', 'Inertia.js', 'Vue.js', 'MySQL', 'PostgreSQL',
                                'Docker', 'Git', 'Figma', 'PHP', 'JavaScript', 'TypeScript',
                            ])
                            ->columnSpanFull(),
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
