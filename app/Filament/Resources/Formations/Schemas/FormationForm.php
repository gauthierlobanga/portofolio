<?php

namespace App\Filament\Resources\Formations\Schemas;

use App\Models\Formation;
use App\Models\FormationCategory;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                    ->description('Titre, slug et catégorie de la formation.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titre')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->helperText('Généré automatiquement si laissé vide.'),
                            ]),

                        Select::make('formation_category_id')
                            ->label('Catégorie')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nom de la catégorie')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->maxLength(255),
                                ColorPicker::make('color')
                                    ->label('Couleur')
                                    ->default('#6b7280'),
                                TextInput::make('icon')
                                    ->label('Icône (optionnel)')
                                    ->maxLength(255),
                            ])
                            ->placeholder('Choisissez ou créez une catégorie'),
                    ]),

                Section::make('Description')
                    ->description('Résumé et contenu détaillé.')
                    ->icon('heroicon-o-pencil-square')
                    ->schema([
                        TextInput::make('subtitle')
                            ->label('Sous‑titre')
                            ->maxLength(255),

                        RichEditor::make('excerpt')
                            ->label('Résumé')
                            ->maxLength(500)
                            ->columnSpanFull()
                            ->json()
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike', 'link',
                                'h2', 'h3',
                                'blockquote', 'bulletList', 'orderedList',
                                'undo', 'redo',
                            ]),

                        RichEditor::make('content')
                            ->label('Contenu complet')
                            ->columnSpanFull()
                            ->json()
                            ->fileAttachmentsDisk('media')
                            ->fileAttachmentsDirectory('formations/content')
                            ->fileAttachmentsAcceptedFileTypes(['image/png', 'image/jpeg'])
                            ->resizableImages()
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike', 'link', 'attachFiles',
                                'h1', 'h2', 'h3',
                                'blockquote', 'codeBlock', 'bulletList', 'orderedList',
                                'table',
                                'undo', 'redo',
                            ]),
                    ]),

                Section::make('Médias')
                    ->description('Image de couverture et galerie.')
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
                            ->helperText('Format 16:9 recommandé, max 5 Mo.')
                            ->columnSpanFull(),

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
                            ->customProperties([
                                'title' => '',
                                'description' => '',
                                'alt' => '',
                            ])
                            ->helperText('Images supplémentaires (max 10 fichiers, 5 Mo chacun). Cliquez sur une image pour ajouter un titre, une description et un texte alternatif.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Vidéos')
                    ->description('Ajoutez une vidéo pour chaque chapitre ou leçon. Une fois la vidéo téléversée, cliquez sur le bouton d\'édition (icône crayon) du média pour renseigner la propriété personnalisée "target_id" (ex: chapter-0, chapter-2-lesson-1).')
                    ->icon('heroicon-o-video-camera')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('videos')
                            ->collection('videos')
                            ->multiple()
                            ->disk('public')
                            ->directory('formations/videos')
                            ->visibility('public')
                            ->acceptedFileTypes(['video/*'])  // ✅ accepte tout type MIME vidéo
                            ->maxSize(102400)
                            ->helperText('Formats acceptés : tous types vidéo (MP4, WebM, OGG, MOV, AVI, MKV, etc.)')
                            ->customProperties(fn () => ['target_id' => ''])
                            ->panelLayout('list')
                            ->reorderable()
                            ->appendFiles(),
                    ]),

                Section::make('Détails de la formation')
                    ->description('Dates, localisation et statut.')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('location')
                                    ->label('Localisation')
                                    ->maxLength(255),

                                Select::make('delivery_mode')
                                    ->label('Mode de formation')
                                    ->options(Formation::deliveryModes())
                                    ->required()
                                    ->default('online')
                                    ->live(),

                                TextInput::make('duration')
                                    ->label('Durée')
                                    ->maxLength(255)
                                    ->placeholder('ex: 3h30, 2 jours, etc.'),

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

                                Select::make('niveau')
                                    ->label('Niveau')
                                    ->options([
                                        'Débutant' => 'Débutant',
                                        'Intermédiaire' => 'Intermédiaire',
                                        'Junior' => 'Junior',
                                        'Senior' => 'Senior',
                                        'Avancé' => 'Avancé',
                                        'Tous niveaux' => 'Tous niveaux',
                                    ])
                                    ->nullable()
                                    ->searchable(),

                                DatePicker::make('start_date')
                                    ->label('Date de début')
                                    ->native(false)
                                    ->displayFormat('d/m/Y'),

                                DatePicker::make('end_date')
                                    ->label('Date de fin')
                                    ->native(false)
                                    ->displayFormat('d/m/Y')
                                    ->after('start_date')
                                    ->helperText('Optionnelle.'),

                                DateTimePicker::make('published_at')
                                    ->label('Date de publication')
                                    ->native(false)
                                    ->seconds(false)
                                    ->displayFormat('d/m/Y H:i')
                                    ->helperText('Date prévue de publication de la formation.'),
                            ]),
                    ]),

                Section::make('Inscription et accès')
                    ->description('Tarif, capacité et informations nécessaires à l’inscription.')
                    ->icon('heroicon-o-ticket')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('price')
                                    ->label('Tarif')
                                    ->numeric()
                                    ->minValue(0)
                                    ->step(0.01)
                                    ->prefixIcon('heroicon-m-banknotes')
                                    ->helperText('Laissez vide pour une formation gratuite.'),

                                Select::make('currency')
                                    ->label('Devise')
                                    ->options(Formation::currencyOptions())
                                    ->required()
                                    ->default('EUR'),

                                TextInput::make('capacity')
                                    ->label('Nombre de places')
                                    ->numeric()
                                    ->integer()
                                    ->minValue(1)
                                    ->nullable()
                                    ->helperText('Laissez vide pour un nombre de places illimité.'),

                                DatePicker::make('registration_deadline')
                                    ->label('Clôture des inscriptions')
                                    ->native(false)
                                    ->displayFormat('d/m/Y')
                                    ->helperText('Laissez vide pour garder les inscriptions ouvertes jusqu’au début de la session.'),

                                TextInput::make('online_url')
                                    ->label('Lien d’accès en ligne')
                                    ->url()
                                    ->maxLength(2048)
                                    ->visible(fn (callable $get): bool => in_array($get('delivery_mode'), ['online', 'hybrid'], true))
                                    ->required(fn (callable $get): bool => in_array($get('delivery_mode'), ['online', 'hybrid'], true))
                                    ->helperText('Ce lien sera communiqué uniquement aux participants approuvés.')
                                    ->columnSpanFull(),

                                Textarea::make('payment_instructions')
                                    ->label('Instructions de paiement')
                                    ->rows(4)
                                    ->maxLength(2000)
                                    ->placeholder('Coordonnées bancaires, Mobile Money ou consignes de paiement manuel…')
                                    ->helperText('Utilisé pour les formations payantes avant intégration d’un prestataire de paiement.')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Tags')
                    ->description('Mots-clés associés à la formation.')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        SpatieTagsInput::make('tags')
                            ->label('Tags')
                            ->suggestions(function () {
                                // Récupère les noms des catégories de formation comme suggestions de base
                                $categoryNames = FormationCategory::pluck('name')->toArray();
                                // Ajoute des tags complémentaires
                                $extraTags = ['Débutant', 'Intermédiaire', 'Avancé', 'Certifiant', 'Présentiel', 'Distanciel'];

                                return array_merge($categoryNames, $extraTags);
                            })
                            ->columnSpanFull(),
                    ]),

                Section::make('Paramètres')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Grid::make(3)
                            ->schema([

                                // --- Nouveau champ utilisateur ---
                                Select::make('user_id')
                                    ->label('Auteur')
                                    ->relationship('user', 'name') // suppose que la relation s'appelle 'user' dans le modèle
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('Choisissez un auteur')
                                    ->helperText('Personne qui dispense la formation.'),

                                TextInput::make('sort_order')
                                    ->label('Ordre d\'affichage')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->helperText('Plus petit = premier.'),

                                ToggleButtons::make('is_active')
                                    ->label('Visibilité')
                                    ->options([
                                        '1' => 'Actif',
                                        '0' => 'Inactif',
                                    ])
                                    ->colors([
                                        '1' => 'success',
                                        '0' => 'danger',
                                    ])
                                    ->icons([
                                        '1' => 'heroicon-o-eye',
                                        '0' => 'heroicon-o-eye-slash',
                                    ])
                                    ->inline()
                                    ->required()
                                    ->default('1'),
                            ]),
                    ]),
            ]);
    }
}
