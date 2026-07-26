<?php

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Service;
use App\Models\User;

it('can be created', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create([
        'title' => 'Test Post',
        'user_id' => $user->id,
    ]);

    expect($post)->toBeInstanceOf(Post::class)
        ->and($post->title)->toBe('Test Post')
        ->and($post->slug)->not->toBeEmpty();
});

it('belongs to a user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    expect($post->user)->toBeInstanceOf(User::class)
        ->and($post->user->id)->toBe($user->id);
});

it('has a renderRichContent method', function () {
    $post = Post::factory()->create();

    expect(method_exists($post, 'renderRichContent'))->toBeTrue();
    expect($post->renderRichContent('content'))->toBeString();
});

it('exposes its service relationship', function () {
    $post = Post::factory()->create();
    $service = Service::factory()->create();

    $post->services()->attach($service);

    expect($post->services()->whereKey($service->id)->exists())->toBeTrue();
});

it('can sync the primary category pivot', function () {
    $post = Post::factory()->create();
    $categoryOne = PostCategory::create([
        'nom' => 'Category One',
        'slug' => 'category-one',
    ]);
    $categoryTwo = PostCategory::create([
        'nom' => 'Category Two',
        'slug' => 'category-two',
    ]);

    $post->categories()->attach([$categoryOne->id, $categoryTwo->id]);

    $post->syncPrimaryCategory($categoryOne->id);
    $post->refresh();

    expect($post->categories()->wherePivot('est_principale', true)->pluck('posts_categories.id')->all())
        ->toEqual([$categoryOne->id]);

    $post->syncPrimaryCategory($categoryTwo->id);
    $post->refresh();

    expect($post->categories()->wherePivot('est_principale', true)->pluck('posts_categories.id')->all())
        ->toEqual([$categoryTwo->id]);
});
