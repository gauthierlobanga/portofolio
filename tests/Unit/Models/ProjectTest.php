<?php

use App\Models\Project;

it('can be created', function () {
    $project = Project::factory()->create([
        'title' => 'Test Project',
    ]);

    expect($project)->toBeInstanceOf(Project::class)
        ->and($project->title)->toBe('Test Project')
        ->and($project->slug)->not->toBeEmpty();
});

it('has a renderRichContent method', function () {
    $project = Project::factory()->create();

    expect(method_exists($project, 'renderRichContent'))->toBeTrue();
    expect($project->renderRichContent('content'))->toBeString();
});

it('can store external project urls', function () {
    $project = Project::factory()->create([
        'website_url' => 'https://example.com',
        'repository_url' => 'https://github.com/example/repo',
    ]);

    expect($project->website_url)->toBe('https://example.com')
        ->and($project->repository_url)->toBe('https://github.com/example/repo');
});
