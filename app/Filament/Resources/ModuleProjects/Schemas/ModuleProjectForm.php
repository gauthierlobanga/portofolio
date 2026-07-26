<?php

namespace App\Filament\Resources\ModuleProjects\Schemas;

// use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ModuleProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Tabs::make('Projet de module')
                    ->tabs([
                        Tab::make('Détails')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Select::make('formation_module_id')
                                            ->label('Module associé')
                                            ->relationship('module', 'title')
                                            ->required()
                                            ->searchable()
                                            ->preload()
                                            ->helperText('Choisissez le module auquel ce projet appartient.'),

                                        TextInput::make('title')
                                            ->label('Titre du projet')
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpan(1),
                                    ]),

                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('deadline_days')
                                            ->label('Délai (jours)')
                                            ->numeric()
                                            ->default(7)
                                            ->minValue(1)
                                            ->suffix('jours')
                                            ->helperText('Nombre de jours accordés pour rendre le projet.'),

                                        TextInput::make('points')
                                            ->label('Points / Note max')
                                            ->numeric()
                                            ->default(100)
                                            ->minValue(0)
                                            ->maxValue(1000)
                                            ->suffix('pts'),

                                        Toggle::make('is_mandatory')
                                            ->label('Obligatoire')
                                            ->default(true)
                                            ->onIcon('heroicon-o-check')
                                            ->offIcon('heroicon-o-x-mark')
                                            ->helperText('Si activé, le projet est requis pour valider le module.'),
                                    ]),
                            ]),

                        Tab::make('Contenu & médias')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                RichEditor::make('description')
                                    ->label('Description / Consignes')
                                    ->required()
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline',
                                        'bulletList', 'orderedList',
                                        'link', 'blockquote',
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('module-projects/descriptions')
                                    ->columnSpanFull(),

                                // FileUpload::make('documents')
                                //     ->label('Documents ressources')
                                //     ->multiple()
                                //     ->disk('public')
                                //     ->directory('module-projects/documents')
                                //     ->acceptedFileTypes(['application/pdf', 'application/zip', 'image/*'])
                                //     ->maxSize(10240)
                                //     ->helperText('Ajoutez des énoncés, gabarits ou fichiers utiles.')
                                //     ->columnSpanFull(),

                                // FileUpload::make('cover_image')
                                //     ->label('Image de couverture')
                                //     ->image()
                                //     ->disk('public')
                                //     ->directory('module-projects/covers')
                                //     ->imageEditor()
                                //     ->columnSpanFull(),
                            ]),
                    ])
                    ->persistTabInQueryString()
                    ->columnSpanFull(),
            ]);
    }
}
