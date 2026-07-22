<?php

namespace App\Filament\Resources\Experiences\Tables;

use App\Models\Experience;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExperiencesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Poste')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->company),

                TextColumn::make('position')
                    ->label('Rôle')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label('Début')
                    ->date('d/m/Y')
                    ->sortable()
                    ->description(fn ($record) => $record->end_date ? '→ '.$record->end_date->format('d/m/Y') : 'Aujourd’hui'),

                TextColumn::make('location')
                    ->label('Lieu')
                    ->searchable()
                    ->icon('heroicon-m-map-pin')
                    ->toggleable(),

                TextColumn::make('technologies')
                    ->label('Technologies')
                    ->badge()
                    ->separator(',')
                    ->toggleable(),

                IconColumn::make('is_current')
                    ->label('En cours')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('is_current')
                    ->label('Statut')
                    ->options([
                        1 => 'En cours',
                        0 => 'Terminé',
                    ]),
                SelectFilter::make('company')
                    ->label('Entreprise')
                    ->options(fn () => Experience::distinct()->pluck('company', 'company')->toArray()),
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
            ->defaultSort('start_date', 'desc')
            ->striped()
            ->emptyStateHeading('Aucune expérience enregistrée')
            ->emptyStateDescription('Ajoutez votre première expérience professionnelle pour enrichir votre portfolio.')
            ->emptyStateIcon(Heroicon::OutlinedBriefcase)
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }
}
