<?php

namespace App\Filament\Resources\UserProjectSubmissions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserProjectSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Soumission Projet')
                    ->columns(2)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('module_project_id')
                            ->relationship('project', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('submission_url')
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        RichEditor::make('notes')
                            ->label('Notes de l\'étudiant')
                            ->columnSpanFull(),

                        Select::make('status')
                            ->options([
                                'pending' => 'En attente',
                                'submitted' => 'Soumis',
                                'graded' => 'Noté',
                                'rejected' => 'Rejeté',
                            ])
                            ->required()
                            ->default('pending'),

                        TextInput::make('grade')
                            ->label('Note / Points')
                            ->numeric()
                            ->default(0),

                        DateTimePicker::make('submitted_at')
                            ->label('Date de soumission'),

                        DateTimePicker::make('graded_at')
                            ->label('Date de notation'),

                        RichEditor::make('feedback')
                            ->label('Feedback du formateur')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
