<?php

use App\Filament\Resources\Formations\Pages\ListFormations;
use App\Filament\Resources\Formations\Tables\FormationsTable;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Filament\Resources\Projects\Tables\ProjectsTable;
use App\Filament\Resources\Services\Pages\ListServices;
use App\Filament\Resources\Services\Tables\ServicesTable;
use App\Filament\Resources\Skills\Pages\ListSkills;
use App\Filament\Resources\Skills\Tables\SkillsTable;
use Filament\Tables\Table;
use LaraZeus\Progress\Tables\Columns\CircleProgress;

function tableColumnNames(string $pageClass, string $tableClass): array
{
    $table = $tableClass::configure(Table::make(new $pageClass));

    return array_map(
        fn ($column): string => $column->getName(),
        $table->getColumns(),
    );
}

it('exposes service and related resource relationship columns', function () {
    expect(tableColumnNames(ListServices::class, ServicesTable::class))
        ->toContain('projects_count', 'posts_count');

    expect(tableColumnNames(ListProjects::class, ProjectsTable::class))
        ->toContain('services_count');

    expect(tableColumnNames(ListPosts::class, PostsTable::class))
        ->toContain('services_count');
});

it('keeps skill progress values visible as percentages', function () {
    $table = SkillsTable::configure(Table::make(new ListSkills));
    $levelColumn = collect($table->getColumns())->first(
        fn ($column): bool => $column->getName() === 'level',
    );

    expect($levelColumn)
        ->toBeInstanceOf(CircleProgress::class)
        ->and($levelColumn->getCanShow())->toBeTrue();
});

it('exposes formation delivery and registration tracking columns', function () {
    expect(tableColumnNames(ListFormations::class, FormationsTable::class))
        ->toContain(
            'delivery_mode',
            'published_at',
            'price',
            'capacity',
            'registrations_count',
            'registration_deadline',
        );
});
