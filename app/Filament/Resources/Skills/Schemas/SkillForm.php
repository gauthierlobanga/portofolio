<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Slider;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informations principales')
                    ->description('Définissez le nom et la catégorie de la compétence.')
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Grid::make(2) // nom + catégorie côte à côte sur écran large
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nom de la compétence')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Ex. : Laravel, React, Docker')
                                    ->helperText('Le nom affiché sur votre portfolio.'),
                                Select::make('skill_category_id')
                                    ->label('Catégorie')
                                    ->relationship('categorySkill', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Nom de la catégorie')
                                            ->required()
                                            ->maxLength(100),
                                        ColorPicker::make('color')
                                            ->label('Couleur')
                                            ->default('#6b7280'),
                                        Select::make('icon')
                                            ->label('Icône')
                                            ->options(
                                                \App\Filament\Resources\SkillCategories\Schemas\SkillCategoryForm::heroiconOptions()
                                            )
                                            ->searchable(),
                                    ])
                                    ->placeholder('Choisissez ou créez une catégorie'),
                            ]),
                    ]),

                Section::make('Niveau de maîtrise')
                    ->description('Indiquez votre niveau actuel pour cette compétence.')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        Slider::make('level')
                            ->label('Pourcentage de maîtrise')
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(5)
                            ->default(50)
                            ->required()
                            ->helperText('Glissez pour ajuster.')
                            ->hint(fn ($state) => $state . '%')
                            ->columnSpanFull(),
                    ]),

                Section::make('Icône personnalisée')
                    ->description('Optionnel : importez une icône pour remplacer celle de la catégorie.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('icon')
                            ->collection('icon')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('skills/icons')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->helperText('Format recommandé : PNG ou SVG, max 2 Mo.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
