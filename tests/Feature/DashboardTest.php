<?php

use App\Models\Faq;
use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertOk();
});

test('authenticated users see the faq section on the dashboard', function () {
    $user = User::factory()->create();
    $faq = Faq::query()->create([
        'question' => 'Question visible sur le dashboard',
        'answer' => 'Réponse visible sur le dashboard.',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee('Questions fréquentes')
        ->assertSee($faq->question);
});
