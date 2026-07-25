<?php

namespace App\Filament\Resources\FormationModules\Tables;


use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FormationModulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('formation.title')
                    ->label('Formation')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('order_column')
                    ->label('Ordre')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),

                TextColumn::make('projects_count')
                    ->counts('projects')
                    ->label('Projets')
                    ->badge(),
            ])
            ->defaultSort('order_column')
            ->reorderable('order_column')
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
