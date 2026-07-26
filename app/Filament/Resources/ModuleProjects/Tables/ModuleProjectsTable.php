<?php

namespace App\Filament\Resources\ModuleProjects\Tables;

use App\Models\ModuleProject;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ModuleProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(ModuleProject::query()->with('module.formation'))
            ->columns([
                TextColumn::make('module.title')
                    ->label('Module')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('title')
                    ->label('Projet')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('deadline_days')
                    ->label('Délai')
                    ->suffix(' jours')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('points')
                    ->label('Points')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_mandatory')
                    ->label('Obligatoire')
                    ->boolean(),
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
            ]);
    }
}
