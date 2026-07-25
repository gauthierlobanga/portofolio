<?php

namespace App\Filament\Resources\FormationRegistrations\Schemas;

use App\Models\FormationRegistration;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FormationRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('Participant et formation')
                    ->columnSpan(1)
                    ->schema([
                        Select::make('formation_id')
                            ->label('Formation')
                            ->relationship('formation', 'title')
                            ->searchable()
                            ->preload()
                            ->disabled()
                            ->dehydrated(false)
                            ->required(),

                        Select::make('user_id')
                            ->label('Participant')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->disabled()
                            ->dehydrated(false)
                            ->required(),

                        Textarea::make('message')
                            ->label('Message du participant')
                            ->rows(5)
                            ->disabled()
                            ->dehydrated(false),
                    ]),

                Section::make('Suivi')
                    ->columnSpan(1)
                    ->schema([
                        Select::make('status')
                            ->label('Statut')
                            ->options(FormationRegistration::statusOptions())
                            ->disabled()
                            ->dehydrated(false),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('amount')
                                    ->label('Montant')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(false),

                                TextInput::make('currency')
                                    ->label('Devise')
                                    ->disabled()
                                    ->dehydrated(false),
                            ]),

                        Select::make('payment_status')
                            ->label('Paiement')
                            ->options(FormationRegistration::paymentStatusOptions())
                            ->required(),

                        TextInput::make('payment_reference')
                            ->label('Référence de paiement')
                            ->maxLength(255),

                        Select::make('attendance_status')
                            ->label('Présence')
                            ->options(FormationRegistration::attendanceStatusOptions())
                            ->required(),

                        DateTimePicker::make('terms_accepted_at')
                            ->label('Conditions acceptées le')
                            ->native(false)
                            ->disabled()
                            ->dehydrated(false),
                    ]),

                Section::make('Notes administratives')
                    ->columnSpanFull()
                    ->schema([
                        Textarea::make('admin_notes')
                            ->label('Notes')
                            ->rows(5)
                            ->maxLength(5000)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
