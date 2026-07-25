<?php

namespace App\Filament\Resources\FormationRegistrations\Tables;

use App\Actions\Formations\ChangeFormationRegistrationStatus;
use App\Exceptions\Formations\FormationRegistrationException;
use App\Models\Formation;
use App\Models\FormationRegistration;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FormationRegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('formation.title')
                    ->label('Formation')
                    ->searchable()
                    ->sortable()
                    ->description(fn (FormationRegistration $record): string => $record->formation?->delivery_mode_label ?? 'Non précisé'),

                TextColumn::make('user.name')
                    ->label('Participant')
                    ->searchable()
                    ->sortable()
                    ->description(fn (FormationRegistration $record): string => $record->user?->email ?? 'Email indisponible'),

                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => FormationRegistration::statusOptions()[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        FormationRegistration::STATUS_APPROVED => 'success',
                        FormationRegistration::STATUS_REJECTED => 'danger',
                        FormationRegistration::STATUS_CANCELLED => 'gray',
                        FormationRegistration::STATUS_WAITLISTED => 'warning',
                        default => 'info',
                    })
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label('Paiement')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => FormationRegistration::paymentStatusOptions()[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        FormationRegistration::PAYMENT_PAID,
                        FormationRegistration::PAYMENT_FREE => 'success',
                        FormationRegistration::PAYMENT_FAILED => 'danger',
                        default => 'warning',
                    })
                    ->sortable(),

                TextColumn::make('attendance_status')
                    ->label('Présence')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => FormationRegistration::attendanceStatusOptions()[$state] ?? $state)
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('amount')
                    ->label('Montant')
                    ->money(fn (FormationRegistration $record): string => $record->currency)
                    ->placeholder('Gratuit')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Demande reçue')
                    ->dateTime('d/m/Y H:i')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options(FormationRegistration::statusOptions())
                    ->multiple(),

                SelectFilter::make('payment_status')
                    ->label('Paiement')
                    ->options(FormationRegistration::paymentStatusOptions())
                    ->multiple(),

                SelectFilter::make('attendance_status')
                    ->label('Présence')
                    ->options(FormationRegistration::attendanceStatusOptions())
                    ->multiple(),

                SelectFilter::make('delivery_mode')
                    ->label('Mode')
                    ->options(Formation::deliveryModes())
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'] ?? null,
                            fn (Builder $query, string $value): Builder => $query->whereHas(
                                'formation',
                                fn (Builder $formationQuery): Builder => $formationQuery->where('delivery_mode', $value),
                            ),
                        );
                    }),

                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    Action::make('approve')
                        ->label('Approuver')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn (FormationRegistration $record): bool => in_array($record->status, [
                            FormationRegistration::STATUS_PENDING,
                            FormationRegistration::STATUS_WAITLISTED,
                        ], true))
                        ->action(function (FormationRegistration $record): void {
                            try {
                                (new ChangeFormationRegistrationStatus)($record, FormationRegistration::STATUS_APPROVED);
                                Notification::make()->success()->title('Inscription approuvée')->send();
                            } catch (FormationRegistrationException $exception) {
                                Notification::make()->danger()->title($exception->getMessage())->send();
                            }
                        }),

                    Action::make('reject')
                        ->label('Refuser')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (FormationRegistration $record): bool => $record->isOpen())
                        ->action(function (FormationRegistration $record): void {
                            (new ChangeFormationRegistrationStatus)($record, FormationRegistration::STATUS_REJECTED);
                            Notification::make()->success()->title('Inscription refusée')->send();
                        }),

                    Action::make('cancel')
                        ->label('Annuler')
                        ->icon('heroicon-o-no-symbol')
                        ->color('gray')
                        ->requiresConfirmation()
                        ->visible(fn (FormationRegistration $record): bool => $record->isOpen())
                        ->action(function (FormationRegistration $record): void {
                            (new ChangeFormationRegistrationStatus)($record, FormationRegistration::STATUS_CANCELLED);
                            Notification::make()->success()->title('Inscription annulée')->send();
                        }),

                    Action::make('mark_paid')
                        ->label('Marquer payée')
                        ->icon('heroicon-o-banknotes')
                        ->color('success')
                        ->visible(fn (FormationRegistration $record): bool => $record->amount !== null
                            && $record->payment_status !== FormationRegistration::PAYMENT_PAID)
                        ->action(function (FormationRegistration $record): void {
                            $record->update(['payment_status' => FormationRegistration::PAYMENT_PAID]);
                            Notification::make()->success()->title('Paiement enregistré')->send();
                        }),

                    Action::make('mark_attended')
                        ->label('Marquer présent')
                        ->icon('heroicon-o-user-plus')
                        ->color('success')
                        ->visible(fn (FormationRegistration $record): bool => $record->status === FormationRegistration::STATUS_APPROVED)
                        ->action(function (FormationRegistration $record): void {
                            $record->update(['attendance_status' => FormationRegistration::ATTENDANCE_ATTENDED]);
                            Notification::make()->success()->title('Présence enregistrée')->send();
                        }),

                    Action::make('mark_absent')
                        ->label('Marquer absent')
                        ->icon('heroicon-o-user-minus')
                        ->color('warning')
                        ->visible(fn (FormationRegistration $record): bool => $record->status === FormationRegistration::STATUS_APPROVED)
                        ->action(function (FormationRegistration $record): void {
                            $record->update(['attendance_status' => FormationRegistration::ATTENDANCE_ABSENT]);
                            Notification::make()->success()->title('Absence enregistrée')->send();
                        }),

                    EditAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
