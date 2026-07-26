<?php

use App\Models\Assessment;
use App\Models\Formation;
use App\Models\FormationModule;
use Livewire\Livewire;

it('changes the displayed formation module when a learner selects it', function () {
    $formation = Formation::factory()->create([
        'is_active' => true,
        'published_at' => now(),
    ]);

    $firstModule = FormationModule::query()->create([
        'formation_id' => $formation->getKey(),
        'title' => 'Module fondations',
        'description' => '<p>Contenu des fondations.</p><script>alert("xss")</script>',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $secondModule = FormationModule::query()->create([
        'formation_id' => $formation->getKey(),
        'title' => 'Module pratique',
        'description' => '<p>Contenu pratique.</p>',
        'sort_order' => 2,
        'is_active' => true,
    ]);

    Livewire::test('pages::formations.show', ['formation' => $formation])
        ->assertSet('activeModule', null)
        ->call('setModule', $firstModule->getKey())
        ->assertSet('activeModule', $firstModule->getKey())
        ->assertSee($firstModule->title)
        ->assertSee('Contenu des fondations')
        ->assertDontSee('<script', false)
        ->call('setModule', $secondModule->getKey())
        ->assertSet('activeModule', $secondModule->getKey())
        ->assertSee($secondModule->title);
});

it('rejects a module that belongs to another formation', function () {
    $formation = Formation::factory()->create([
        'is_active' => true,
        'published_at' => now(),
    ]);
    $otherFormation = Formation::factory()->create();
    $otherModule = FormationModule::query()->create([
        'formation_id' => $otherFormation->getKey(),
        'title' => 'Module privé',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    Livewire::test('pages::formations.show', ['formation' => $formation])
        ->call('setModule', $otherModule->getKey())
        ->assertSet('activeModule', null)
        ->assertHasErrors('module');
});

it('renders formation assessments in the right sidebar after key information', function () {
    $formation = Formation::factory()->create([
        'is_active' => true,
        'published_at' => now(),
    ]);

    Assessment::query()->create([
        'formation_id' => $formation->getKey(),
        'title' => 'Test d’admission',
        'description' => 'Évaluation préalable à la formation.',
        'type' => 'admission',
        'duration_minutes' => 30,
        'passing_score' => 70,
        'is_active' => true,
    ]);

    Livewire::test('pages::formations.show', ['formation' => $formation])
        ->assertSeeInOrder(['Informations clés', 'Évaluations disponibles', 'Test d’admission']);
});
