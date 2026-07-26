<?php

namespace App\Filament\Resources\UserAssessmentAttempts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserAssessmentAttemptForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations de la tentative')
                    ->columns(3)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->disabled(),
                        Select::make('assessment_id')
                            ->relationship('assessment', 'title')
                            ->disabled(),
                        Select::make('status')
                            ->options([
                                'pending' => 'En cours',
                                'completed' => 'Terminé',
                                'graded' => 'Corrigé',
                            ])
                            ->required(),
                        TextInput::make('score')
                            ->numeric()
                            ->disabled(),
                        Toggle::make('passed')
                            ->disabled(),
                    ]),
                Section::make('Correction des réponses')
                    ->schema([
                        Repeater::make('answers')
                            ->relationship()
                            ->schema([
                                TextInput::make('question_text')
                                    ->label('Question')
                                    ->formatStateUsing(fn ($record) => $record?->question?->question_text)
                                    ->disabled()
                                    ->columnSpanFull(),
                                Textarea::make('answer_text')
                                    ->label('Réponse de l\'étudiant')
                                    ->disabled()
                                    ->columnSpanFull(),
                                TextInput::make('points_awarded')
                                    ->label('Points accordés')
                                    ->numeric()
                                    ->required(),
                                Toggle::make('is_correct')
                                    ->label('Est correcte ?'),
                            ])
                            ->columns(2)
                            ->disableItemCreation()
                            ->disableItemDeletion()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => 'Réponse'),
                    ]),
                DateTimePicker::make('started_at')->disabled(),
                DateTimePicker::make('completed_at')->disabled(),
            ]);
    }
}
