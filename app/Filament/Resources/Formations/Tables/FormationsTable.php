<?php

namespace App\Filament\Resources\Formations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class FormationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('Couverture')
                    ->getStateUsing(fn ($record) => $record->getFirstMediaUrl('cover', 'thumb'))
                    ->imageSize(40)
                    ->toggleable(),

                SpatieMediaLibraryImageColumn::make('gallery')
                    ->collection('gallery')
                    ->label('Galerie')
                    ->conversion('thumb')
                    ->disk('public')
                    ->visibility('public')
                    ->imageSize(40)
                    ->circular()
                    ->stacked()
                    ->limit(2)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('title')
                    ->label('Formation')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => \Illuminate\Support\Str::limit(strip_tags($record->excerpt ?? ''), 80)),

                TextColumn::make('location')
                    ->label('Localisation')
                    ->searchable()
                    ->icon('heroicon-m-map-pin')
                    ->toggleable(),

                TextColumn::make('formationCategory.name')
                    ->label('Catégorie')
                    ->toggleable(),

                BadgeColumn::make('status')
                    ->label('Statut')
                    ->enum([
                        'planned' => 'Planifié',
                        'ongoing' => 'En cours',
                        'completed' => 'Terminé',
                    ])
                    ->colors([
                        'planned' => 'gray',
                        'ongoing' => 'warning',
                        'completed' => 'success',
                    ])
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label('Début')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('end_date')
                    ->label('Fin')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Création')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Mise à jour')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'planned' => 'Planifié',
                        'ongoing' => 'En cours',
                        'completed' => 'Terminé',
                    ]),
                SelectFilter::make('is_active')
                    ->label('Actif')
                    ->options([
                        1 => 'Oui',
                        0 => 'Non',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('start_date', 'desc');
    }
}
