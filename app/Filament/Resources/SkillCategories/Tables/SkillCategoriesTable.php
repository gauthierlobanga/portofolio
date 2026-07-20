<?php

namespace App\Filament\Resources\SkillCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SkillCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->slug),

                ColorColumn::make('color')
                    ->label('Couleur')
                    ->copyable()
                    ->tooltip(fn ($record) => $record->color),

                TextColumn::make('icon')
                    ->label('Icône')
                    ->formatStateUsing(fn (string $state): string => "heroicon-o-{$state}")
                    ->icon(fn (string $state): string => "heroicon-o-{$state}")
                    ->searchable(),

                TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('skills_count')
                    ->label('Compétences')
                    ->counts('skills')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Mis à jour')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            ->defaultSort('sort_order')
            ->striped();
    }
}
