<?php

namespace App\Filament\Resources\FormationModules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FormationModulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('formation.title')
                    ->label('Formation')
                    ->sortable()
                    ->searchable()
                    ->description(fn ($record): ?string => $record->formation?->excerpt
                            ? Str::limit(
                                is_array($record->formation->excerpt)
                                    ? strip_tags($record->formation->getPlainTextContent() ?? '')
                                    : strip_tags($record->formation->excerpt),
                                80
                            )
                            : null,
                        position: 'below'
                    ),
                TextColumn::make('title')
                    ->label('Module')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                TextColumn::make('projects_count')
                    ->counts('projects')
                    ->label('Projets')
                    ->badge()
                    ->color('info')
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Ajouté le')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Mis à jour')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                SelectFilter::make('formation_id')
                    ->label('Formation')
                    ->relationship('formation', 'title')
                    ->searchable()
                    ->preload(),

                TernaryFilter::make('is_active')
                    ->label('Actif'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->searchOnBlur()
            ->striped();
    }
}
