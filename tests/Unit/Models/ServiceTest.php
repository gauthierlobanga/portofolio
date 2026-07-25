<?php

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;

it('can be created', function () {
    $service = Service::factory()->create([
        'title' => 'Test Service',
    ]);

    expect($service)->toBeInstanceOf(Service::class)
        ->and($service->title)->toBe('Test Service')
        ->and($service->slug)->not->toBeEmpty();
});

it('has a renderRichContent method', function () {
    $service = Service::factory()->create();

    expect(method_exists($service, 'renderRichContent'))->toBeTrue();
    expect($service->renderRichContent('content'))->toBeString();
});

it('exposes its project and post relationships', function () {
    $service = Service::factory()->create();
    $project = Project::factory()->create();
    $post = Post::factory()->create();

    $service->projects()->attach($project);
    $service->posts()->attach($post);

    expect($service->projects()->whereKey($project->id)->exists())->toBeTrue()
        ->and($service->posts()->whereKey($post->id)->exists())->toBeTrue();
});
