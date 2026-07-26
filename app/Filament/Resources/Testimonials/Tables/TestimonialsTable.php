<?php

namespace App\Filament\Resources\Testimonials\Tables;

use App\Models\Testimonial;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Photo')
                    ->getStateUsing(fn ($record) => $record->getFirstMediaUrl('photo', 'thumb'))
                    ->circular()
                    ->imageSize(40),

                TextColumn::make('name')
                    ->label('Témoin')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->role.($record->company ? ', '.$record->company : '')),

                TextColumn::make('content')
                    ->label('Témoignage')
                    ->limit(80)
                    ->searchable()
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
                ActionGroup::make([
                    Action::make('activate')
                        ->label('Activer')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Activer le témoignage')
                        ->modalDescription('Êtes-vous sûr de vouloir activer ce témoignage ?')
                        ->visible(fn (Testimonial $record): bool => ! $record->is_active)
                        ->action(fn (Testimonial $record) => $record->update(['is_active' => true])),

                    Action::make('deactivate')
                        ->label('Désactiver')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Désactiver le témoignage')
                        ->modalDescription('Êtes-vous sûr de vouloir désactiver ce témoignage ?')
                        ->visible(fn (Testimonial $record): bool => $record->is_active)
                        ->action(fn (Testimonial $record) => $record->update(['is_active' => false])),
                ])
                    ->label('Plus')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size('sm')
                    ->button()
                    ->color('gray'),
            ])
            ->toolbarActions([
                Action::make('activateAll')
                    ->label('Activer tout')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Activer tous les témoignages')
                    ->modalDescription('Êtes-vous sûr de vouloir activer tous les témoignages ?')
                    ->action(fn () => Testimonial::query()->update(['is_active' => true])),

                Action::make('deactivateAll')
                    ->label('Désactiver tout')
                    ->icon('heroicon-m-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Désactiver tous les témoignages')
                    ->modalDescription('Êtes-vous sûr de vouloir désactiver tous les témoignages ?')
                    ->action(fn () => Testimonial::query()->update(['is_active' => false])),

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    BulkAction::make('activate')
                        ->label('Activer les sélectionnés')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Activer les témoignages sélectionnés')
                        ->modalDescription('Êtes-vous sûr de vouloir activer tous les témoignages sélectionnés ?')
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),

                    BulkAction::make('deactivate')
                        ->label('Désactiver les sélectionnés')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Désactiver les témoignages sélectionnés')
                        ->modalDescription('Êtes-vous sûr de vouloir désactiver tous les témoignages sélectionnés ?')
                        ->action(fn ($records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->emptyStateHeading('Aucun témoignage')
            ->emptyStateDescription('Ajoutez le premier témoignage en cliquant sur "Nouveau témoignage".')
            ->emptyStateIcon('heroicon-o-chat-bubble-bottom-center-text')
            ->defaultSort('created_at', 'desc');
    }
}
