<?php

namespace App\Filament\Resources\Education\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EducationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('institution')
                    ->required(),
                TextInput::make('degree')
                    ->required(),
                TextInput::make('field_of_study'),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('description')
                    ->columnSpanFull(),
                Toggle::make('is_current')
                    ->required(),

            ]);
    }
}
