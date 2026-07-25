<?php

namespace App\Filament\Resources\UserModuleProgress\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserModuleProgressForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Suivi Module')
                    ->columns(2)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('formation_module_id')
                            ->relationship('module', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('status')
                            ->options([
                                'pending' => 'En attente',
                                'in_progress' => 'En cours',
                                'completed' => 'Terminé',
                            ])
                            ->required()
                            ->default('pending'),

                        TextInput::make('score')
                            ->label('Score')
                            ->numeric()
                            ->default(0),

                        DateTimePicker::make('started_at')
                            ->label('Date de début'),

                        DateTimePicker::make('completed_at')
                            ->label('Date de fin'),
                    ]),
            ]);
    }
}
