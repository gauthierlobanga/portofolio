<?php

use App\Models\Faq;
use Livewire\Livewire;

use function Pest\Laravel\get;

beforeEach(function (): void {
    $this->withoutVite();
});

it('loads the public faq page', function () {
    Faq::query()->create([
        'question' => 'Comment démarrer un projet ?',
        'answer' => 'Contactez-moi pour définir votre besoin.',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    get('/faq')
        ->assertSuccessful()
        ->assertSee('Questions fréquentes')
        ->assertSee('Comment démarrer un projet ?');
});

it('filters active faqs from the livewire page', function () {
    $tarifs = Faq::query()->create([
        'question' => 'Quels sont vos tarifs ?',
        'answer' => 'Un devis est établi après analyse du besoin.',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $inactive = Faq::query()->create([
        'question' => 'Question inactive',
        'answer' => 'Cette question ne doit pas apparaître.',
        'is_active' => false,
        'sort_order' => 2,
    ]);

    Livewire::test('pages::faq.index')
        ->assertSee($tarifs->question)
        ->assertDontSee($inactive->question)
        ->set('search', 'tarifs')
        ->assertSee($tarifs->question)
        ->assertDontSee($inactive->question);
});

it('renders a searchable faq preview on the contact page', function () {
    foreach (range(1, 7) as $sortOrder) {
        Faq::query()->create([
            'question' => "Question contact {$sortOrder}",
            'answer' => "Réponse contact {$sortOrder}.",
            'is_active' => true,
            'sort_order' => $sortOrder,
        ]);
    }

    get('/contact')
        ->assertSuccessful()
        ->assertSee('Question contact 1')
        ->assertDontSee('Question contact 7');

    Livewire::test('faq.faq')
        ->set('search', 'contact 7')
        ->assertSee('Question contact 7')
        ->assertDontSee('Question contact 1');
});
