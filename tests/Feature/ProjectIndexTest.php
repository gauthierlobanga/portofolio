<?php

use App\Models\Project;

use function Pest\Laravel\get;

beforeEach(function (): void {
    $this->withoutVite();
});

it('filters projects by status from the url', function () {
    $completedProject = Project::factory()->create([
        'title' => 'Projet hydraulique termine',
        'status' => 'completed',
        'is_active' => true,
    ]);

    $ongoingProject = Project::factory()->create([
        'title' => 'Projet agricole en cours',
        'status' => 'ongoing',
        'is_active' => true,
    ]);

    get('/projects?status=completed')
        ->assertOk()
        ->assertSee($completedProject->title)
        ->assertDontSee($ongoingProject->title);
});

it('ignores invalid status and sort values from the url', function () {
    $plannedProject = Project::factory()->create([
        'title' => 'Projet planifie visible',
        'status' => 'planned',
        'is_active' => true,
    ]);

    $completedProject = Project::factory()->create([
        'title' => 'Projet termine visible',
        'status' => 'completed',
        'is_active' => true,
    ]);

    get('/projects?status=not-a-status&sort=not-a-sort')
        ->assertOk()
        ->assertSee($plannedProject->title)
        ->assertSee($completedProject->title);
});


it('does not predefine Alpine before Filament loads its scripts', function () {
    get('/admin/login')
        ->assertRedirect('/login')
        ->assertDontSee('window.Alpine = window.Alpine || {}', false);
});
