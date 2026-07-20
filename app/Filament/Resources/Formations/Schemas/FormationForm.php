<?php

namespace App\Filament\Resources\Formations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\ToolbarButtonGroup;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class FormationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informations générales')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),
                            ]),

                        // Catégorie de la formation
                        \Filament\Forms\Components\Select::make('formation_category_id')
                            ->label('Catégorie')
                            ->relationship('formationCategory', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                \Filament\Forms\Components\TextInput::make('name')->required()->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('slug')->maxLength(255),
                                \Filament\Forms\Components\ColorPicker::make('color')->label('Couleur')->default('#6b7280'),
                                \Filament\Forms\Components\TextInput::make('icon')->label('Icône (optionnel)')->maxLength(255),
                            ])
                            ->placeholder('Choisissez une catégorie'),

                        Textarea::make('subtitle')
                            ->label('Sous-titre')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        RichEditor::make('excerpt')
                            ->label('Résumé')
                            ->maxLength(500)
                            ->columnSpanFull()
                            ->json()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link'],
                                [ToolbarButtonGroup::make('Heading', ['h2', 'h3'])->textualButtons()->icon('fi-o-heading')],
                                ['blockquote', 'bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ]),

                        RichEditor::make('content')
                            ->label('Description complète')
                            ->columnSpanFull()
                            ->json()
                            ->fileAttachmentsDisk('media')
                            ->fileAttachmentsDirectory('formations/content')
                            ->fileAttachmentsAcceptedFileTypes(['image/png', 'image/jpeg'])
                            ->resizableImages()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link', 'attachFiles'],
                                [ToolbarButtonGroup::make('Heading', ['h1', 'h2', 'h3'])->textualButtons()->icon('fi-o-heading')],
                                ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                ['table'],
                                ['undo', 'redo'],
                            ]),
                    ]),

                Section::make('Média')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('formations/covers')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull()
                            ->helperText('Format 16:9 recommandé, max 5 Mo.'),

                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->label('Galerie d\'images')
                            ->collection('gallery')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->responsiveImages()
                            ->conversion('thumb')
                            ->disk('public')
                            ->directory('formations/gallery')
                            ->visibility('public')
                            ->maxFiles(10)
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->reorderable()
                            ->appendFiles()
                            ->panelLayout('grid')
                            ->columnSpanFull()
                            ->helperText('Images supplémentaires (max 10 fichiers, 5MB chacun).'),
                    ]),

                Section::make('Détails')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('location')
                                    ->label('Localisation')
                                    ->maxLength(255),

                                ToggleButtons::make('status')
                                    ->label('Statut')
                                    ->options([
                                        'planned' => 'Planifié',
                                        'ongoing' => 'En cours',
                                        'completed' => 'Terminé',
                                    ])
                                    ->colors([
                                        'planned' => 'gray',
                                        'ongoing' => 'warning',
                                        'completed' => 'success',
                                    ])
                                    ->icons([
                                        'planned' => 'heroicon-o-calendar',
                                        'ongoing' => 'heroicon-o-clock',
                                        'completed' => 'heroicon-o-check-circle',
                                    ])
                                    ->inline()
                                    ->required()
                                    ->default('planned'),

                                DatePicker::make('start_date')
                                    ->label('Date de début')
                                    ->native(false)
                                    ->displayFormat('d/m/Y'),

                                DatePicker::make('end_date')
                                    ->label('Date de fin')
                                    ->native(false)
                                    ->displayFormat('d/m/Y')
                                    ->after('start_date'),
                            ]),
                    ]),

                Section::make('Paramètres')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),
            ]);
    }
}
