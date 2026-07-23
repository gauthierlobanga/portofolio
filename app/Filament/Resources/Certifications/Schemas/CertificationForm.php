<?php

namespace App\Filament\Resources\Certifications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CertificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations sur la certification')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nom de la certification')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('issuer')
                                ->label('Organisme de délivrance')
                                ->maxLength(255),
                            DatePicker::make('date')
                                ->label('Date d\'obtention')
                                ->native(false)
                                ->displayFormat('d/m/Y'),
                            TextInput::make('credential_url')
                                ->label('URL de vérification')
                                ->url()
                                ->maxLength(255),
                        ]),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Badge / Image')
                            ->collection('image')
                            ->image()
                            ->disk('public')
                            ->directory('certifications')
                            ->visibility('public')
                            ->maxSize(2048),
                    ]),
                Section::make('Paramètres')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('is_active')
                                ->label('Actif')
                                ->default(true)
                                ->onColor('success')
                                ->offColor('danger'),
                            TextInput::make('sort_order')
                                ->label('Ordre d\'affichage')
                                ->required()
                                ->numeric()
                                ->default(0),
                        ]),
                    ]),
            ]);
    }
}
