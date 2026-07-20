<?php

namespace App\Filament\Resources\Skills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LaraZeus\Progress\Tables\Columns\CircleProgress;
use LaraZeus\Progress\Tables\Columns\ProgressBar;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->category),

                CircleProgress::make('level')
                    ->getStateUsing(fn ($record) => [
                        'total' => 100,
                        'progress' => $record->level,
                    ])
                    ->hideProgressValue(false),

                TextColumn::make('categorySkill.name')
                    ->label('Catégorie')
                    ->badge()
                    ->color(fn ($record) => $record->categorySkill?->color ?? 'gray')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'Frontend' => 'Frontend',
                        'Backend' => 'Backend',
                        'Base de données' => 'Base de données',
                        'DevOps' => 'DevOps',
                        'Outils' => 'Outils',
                        'Bureautique' => 'Bureautique',
                    ]),
                Filter::make('level')
                    ->schema([
                        Select::make('operator')
                            ->options([
                                '>=' => 'Au moins',
                                '<=' => 'Au plus',
                                '=' => 'Égal à',
                            ])
                            ->default('>=')
                            ->selectablePlaceholder(false),
                        TextInput::make('value')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(50),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['value'] ?? null,
                                fn (Builder $query, $value) => $query->where('level', $data['operator'], $value)
                            );
                    }),
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
            ->defaultSort('category')
            ->striped();
    }
}
