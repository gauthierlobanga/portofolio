<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\TextColor;
use Filament\Forms\Components\RichEditor\ToolbarButtonGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
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
                                    ->label('Titre')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->label('Slug'),
                            ]),

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
                            ->required()
                            ->columnSpanFull()
                            ->json()
                            ->fileAttachmentsDisk('media')
                            ->fileAttachmentsDirectory('services/content')
                            ->fileAttachmentsAcceptedFileTypes(['image/png', 'image/jpeg'])
                            ->resizableImages()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link', 'attachFiles'],
                                [ToolbarButtonGroup::make('Heading', ['h1', 'h2', 'h3'])->textualButtons()->icon('fi-o-heading')],
                                [ToolbarButtonGroup::make('Alignment', ['alignStart', 'alignCenter', 'alignEnd', 'alignJustify'])],
                                ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                ['table'],
                                ['undo', 'redo'],
                            ])
                            ->floatingToolbars([
                                'paragraph' => ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript'],
                                'heading' => ['h1', 'h2', 'h3'],
                                'table' => ['tableAddColumnBefore', 'tableAddColumnAfter', 'tableDeleteColumn', 'tableAddRowBefore', 'tableAddRowAfter', 'tableDeleteRow', 'tableMergeCells', 'tableSplitCell', 'tableToggleHeaderRow', 'tableToggleHeaderCell', 'tableDelete'],
                            ])
                            ->textColors([
                                'brand' => TextColor::make('Brand', '#0ea5e9'),
                                'warning' => TextColor::make('Warning', '#f59e0b', darkColor: '#fbbf24'),
                                ...TextColor::getDefaults(),
                            ]),
                    ]),

                Section::make('Média')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->label('Image principale')
                                    ->collection('image')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->directory('services/images')
                                    ->visibility('public')
                                    ->maxSize(5120)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->customProperties([
                                        'title' => '',
                                        'description' => '',
                                        'alt' => '',
                                    ])
                                    ->helperText('Format 16:9 recommandé, max 5 Mo. Cliquez sur l\'image pour ajouter titre/alt.'),

                                SpatieMediaLibraryFileUpload::make('service_icon')
                                    ->label('Icône (Image)')
                                    ->collection('service_icon')
                                    ->image()
                                    ->disk('public')
                                    ->directory('services/icons')
                                    ->visibility('public')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/png', 'image/webp', 'image/svg+xml'])
                                    ->helperText('Format carré recommandé (PNG, SVG, WEBP), max 2 Mo.'),
                            ]),

                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->label('Galerie d’images')
                            ->collection('gallery')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->responsiveImages()
                            ->conversion('thumb')
                            ->disk('public')
                            ->directory('services/gallery')
                            ->visibility('public')
                            ->maxFiles(10)
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->reorderable()
                            ->appendFiles()
                            ->panelLayout('grid')
                            ->customProperties([
                                'title' => '',
                                'description' => '',
                                'alt' => '',
                            ])
                            ->helperText('Images supplémentaires du service, 5 Mo maximum par fichier.')
                            ->columnSpanFull(),
                    ]),

                // ========== NOUVELLE SECTION : DOCUMENTS PDF ==========
                Section::make('Documents PDF')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('documents')
                            ->label('Brochures et documents PDF')
                            ->collection('documents')
                            ->multiple()
                            ->disk('public')
                            ->directory('services/documents')
                            ->visibility('public')
                            ->maxFiles(5)
                            ->maxSize(10240) // 10 MB
                            ->acceptedFileTypes(['application/pdf'])
                            ->downloadable()
                            ->previewable(true)
                            ->openable()
                            ->reorderable()
                            ->appendFiles()
                            ->columnSpanFull()
                            ->helperText('Téléchargez les brochures ou documents descriptifs du service (PDF). Poids max : 10 Mo par fichier.'),
                    ]),

                Section::make('Paramètres')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('icon')
                                    ->label('Icône (Texte/Classe CSS)')
                                    ->maxLength(255)
                                    ->helperText('Optionnel si une image est fournie. Exemple : heroicon-o-academic-cap, fas fa-leaf ou code SVG.'),

                                Toggle::make('is_active')
                                    ->label('Actif')
                                    ->default(true)
                                    ->onColor('success')
                                    ->offColor('danger'),

                                TextInput::make('sort_order')
                                    ->label('Ordre d’affichage')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),
                            ]),
                    ]),

                Section::make('Relations')
                    ->icon('heroicon-o-link')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('projects')
                                    ->label('Projets associés')
                                    ->relationship('projects', 'title')
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),

                                Select::make('posts')
                                    ->label('Articles associés')
                                    ->relationship('posts', 'title')
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),
                            ]),
                    ]),

                Section::make('Tags')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        SpatieTagsInput::make('tags')
                            ->label('Tags')
                            ->type('services')
                            ->splitKeys(['Tab', ' ', ','])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
