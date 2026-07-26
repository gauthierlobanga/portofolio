<?php

use App\Filament\Resources\Comments\CommentResource;
use App\Models\Comment;
use App\Models\Formation;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('includes comments for all commentable types in the Filament comment resource', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();
    $formation = Formation::factory()->create();

    Comment::create([
        'commentable_type' => Post::class,
        'commentable_id' => $post->getKey(),
        'user_id' => $user->getKey(),
        'content' => 'Post comment',
        'ip_address' => '127.0.0.1',
        'user_agent' => 'testing',
        'status' => Comment::STATUS_PENDING,
    ]);

    Comment::create([
        'commentable_type' => Formation::class,
        'commentable_id' => $formation->getKey(),
        'user_id' => $user->getKey(),
        'content' => 'Formation comment',
        'ip_address' => '127.0.0.1',
        'user_agent' => 'testing',
        'status' => Comment::STATUS_PENDING,
    ]);

    expect(CommentResource::getEloquentQuery()->count())->toBe(2);
    expect(intval(CommentResource::getNavigationBadge()))->toBe(2);
});
