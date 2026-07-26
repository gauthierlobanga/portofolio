<?php

namespace App\Filament\Resources\Assessments\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class AssessmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Évaluation')
                    ->tabs([
                        Tab::make('Détails')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Select::make('formation_id')
                                            ->relationship('formation', 'title')
                                            ->required()
                                            ->searchable()
                                            ->preload()
                                            ->columnSpan(1),
                                        Select::make('formation_module_id')
                                            ->relationship('module', 'title')
                                            ->nullable()
                                            ->searchable()
                                            ->preload()
                                            ->columnSpan(1),
                                    ]),
                                TextInput::make('title')
                                    ->required()
                                    ->columnSpanFull()
                                    ->helperText('Le titre doit être clair et descriptif.'),
                                RichEditor::make('description')
                                    ->columnSpanFull()
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link'])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('assessments')
                                    ->helperText('Description optionnelle de l’évaluation.'),
                                Grid::make(3)
                                    ->schema([
                                        ToggleButtons::make('type')
                                            ->options([
                                                'test_admission' => 'Test d’admission',
                                                'tp' => 'TP',
                                                'td' => 'TD',
                                                'examen' => 'Examen',
                                            ])
                                            ->icons([
                                                'test_admission' => 'heroicon-o-academic-cap',
                                                'tp' => 'heroicon-o-beaker',
                                                'td' => 'heroicon-o-pencil',
                                                'examen' => 'heroicon-o-document-text',
                                            ])
                                            ->inline()
                                            ->required()
                                            ->columnSpanFull(),
                                        TextInput::make('duration_minutes')
                                            ->numeric()
                                            ->label('Durée (min)')
                                            ->minValue(1)
                                            ->suffix('minutes')
                                            ->columnSpan(1),
                                        TextInput::make('passing_score')
                                            ->required()
                                            ->numeric()
                                            ->default(50)
                                            ->minValue(0)
                                            ->maxValue(100)
                                            ->suffix('%')
                                            ->columnSpan(1),
                                        Toggle::make('is_active')
                                            ->label('Activer l’évaluation')
                                            ->onIcon('heroicon-o-check')
                                            ->offIcon('heroicon-o-x-mark')
                                            ->default(true)
                                            ->columnSpan(1),
                                    ]),
                            ]),

                        Tab::make('Questions')
                            ->icon('heroicon-o-question-mark-circle')
                            ->badge(fn (Get $get): int => count($get('questions') ?? []))
                            ->schema([
                                Text::make(fn (Get $get): string => number_format(collect($get('questions') ?? [])->sum(fn ($q) => floatval($q['points'] ?? 0)), 1).' points')
                                    ->size('lg')
                                    ->color('secondary')
                                    ->badge(false),
                                Repeater::make('questions')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('question_text')
                                            ->required()
                                            ->columnSpanFull()
                                            ->live(onBlur: true),
                                        Select::make('type')
                                            ->options([
                                                'multiple_choice' => 'QCM (Choix multiple)',
                                                'text' => 'Texte libre',
                                                'code_editor' => 'Éditeur de code',
                                            ])
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                                if ($state !== 'multiple_choice') {
                                                    $set('options', []); // vider si changement
                                                }
                                            }),
                                        TextInput::make('points')
                                            ->required()
                                            ->numeric()
                                            ->default(1)
                                            ->minValue(0)
                                            ->live(onBlur: true),
                                        // Le Repeater d'options n'apparaît que pour QCM
                                        Repeater::make('options')
                                            ->relationship()
                                            ->schema([
                                                TextInput::make('option_text')
                                                    ->required()
                                                    ->columnSpan(2),
                                                Toggle::make('is_correct')
                                                    ->label('Correcte')
                                                    ->inline(false),
                                            ])
                                            ->columns(3)
                                            ->columnSpanFull()
                                            ->visible(fn (Get $get) => $get('type') === 'multiple_choice')
                                            ->addActionLabel('Ajouter une option')
                                            ->reorderableWithDragAndDrop()
                                            ->cloneable()
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['option_text'] ?? 'Option sans texte')
                                            ->minItems(2)
                                            ->maxItems(8),
                                    ])
                                    ->columns(3)
                                    ->addActionLabel('Ajouter une question')
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['question_text'] ?? 'Nouvelle question')
                                    ->orderColumn('sort_order')
                                    ->reorderableWithDragAndDrop()
                                    ->cloneable()
                                    ->minItems(1)
                                    ->maxItems(100),
                            ]),
                    ])
                    ->persistTabInQueryString()
                    ->columnSpanFull(),
            ]);
    }
}
