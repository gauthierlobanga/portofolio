<?php

use App\Actions\Formations\ChangeFormationRegistrationStatus;
use App\Actions\Formations\RegisterForFormation;
use App\Exceptions\Formations\FormationRegistrationException;
use App\Models\Formation;
use App\Models\FormationRegistration;
use App\Models\Role;
use App\Models\User;
use App\Notifications\FormationRegistrationAdminAlert;
use App\Notifications\FormationRegistrationStatusChanged;
use App\Notifications\FormationRegistrationSubmitted;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('creates a pending registration for a verified user', function () {
    $formation = Formation::factory()->create([
        'status' => 'planned',
        'is_active' => true,
        'price' => null,
        'capacity' => 20,
        'registration_deadline' => now()->addWeek(),
    ]);
    $user = User::factory()->create();

    $registration = (new RegisterForFormation)($formation, $user, 'Je souhaite participer.', true);

    expect($registration->status)->toBe(FormationRegistration::STATUS_PENDING)
        ->and($registration->payment_status)->toBe(FormationRegistration::PAYMENT_FREE)
        ->and($registration->message)->toBe('Je souhaite participer.')
        ->and($registration->formation->is($formation))->toBeTrue()
        ->and($registration->user->is($user))->toBeTrue();

    $this->assertDatabaseHas('formation_registrations', [
        'formation_id' => $formation->getKey(),
        'user_id' => $user->getKey(),
        'status' => FormationRegistration::STATUS_PENDING,
    ]);
});

it('places a full formation registration on the waitlist and promotes it after cancellation', function () {
    Notification::fake();

    $formation = Formation::factory()->create([
        'status' => 'planned',
        'is_active' => true,
        'capacity' => 1,
        'registration_deadline' => now()->addWeek(),
    ]);
    $approvedUser = User::factory()->create();
    $waitlistedUser = User::factory()->create();

    $approved = FormationRegistration::factory()->approved()->create([
        'formation_id' => $formation->getKey(),
        'user_id' => $approvedUser->getKey(),
    ]);
    $waitlisted = (new RegisterForFormation)($formation, $waitlistedUser, '', true);

    expect($waitlisted->status)->toBe(FormationRegistration::STATUS_WAITLISTED);

    (new ChangeFormationRegistrationStatus)($approved, FormationRegistration::STATUS_CANCELLED);

    expect($waitlisted->fresh()->status)->toBe(FormationRegistration::STATUS_APPROVED)
        ->and($waitlisted->fresh()->approved_at)->not->toBeNull();

    Notification::assertSentTo($approvedUser, FormationRegistrationStatusChanged::class);
    Notification::assertSentTo($waitlistedUser, FormationRegistrationStatusChanged::class);
});

it('submits a registration from the formation page and notifies the participant and administrators', function () {
    Notification::fake();

    $formation = Formation::factory()->create([
        'status' => 'planned',
        'is_active' => true,
        'price' => 125,
        'currency' => 'EUR',
        'capacity' => null,
        'registration_deadline' => now()->addWeek(),
    ]);
    $user = User::factory()->create();
    $admin = User::factory()->create();
    $admin->assignRole(Role::findOrCreate('admin', 'web'));

    actingAs($user);

    Livewire::test('pages::formations.show', ['formation' => $formation])
        ->set('registrationMessage', 'Je suis disponible le week-end.')
        ->set('termsAccepted', true)
        ->call('register')
        ->assertSet('showRegistrationModal', false)
        ->assertSet('registrationSuccessMessage', 'Votre demande d’inscription a bien été envoyée.');

    $registration = FormationRegistration::query()->firstOrFail();

    expect($registration->amount)->toBe('125.00')
        ->and($registration->payment_status)->toBe(FormationRegistration::PAYMENT_PENDING);

    Notification::assertSentTo($user, FormationRegistrationSubmitted::class);
    Notification::assertSentTo($admin, FormationRegistrationAdminAlert::class);
});

it('rejects unverified users and duplicate active registrations', function () {
    $formation = Formation::factory()->create([
        'status' => 'planned',
        'is_active' => true,
        'registration_deadline' => now()->addWeek(),
    ]);
    $unverifiedUser = User::factory()->unverified()->create();

    expect(fn () => (new RegisterForFormation)($formation, $unverifiedUser, '', true))
        ->toThrow(FormationRegistrationException::class);

    $verifiedUser = User::factory()->create();
    (new RegisterForFormation)($formation, $verifiedUser, '', true);

    expect(fn () => (new RegisterForFormation)($formation, $verifiedUser, '', true))
        ->toThrow(FormationRegistrationException::class, 'déjà inscrit');
});

it('reveals the online access link only to an approved participant', function () {
    $formation = Formation::factory()->create([
        'status' => 'planned',
        'is_active' => true,
        'delivery_mode' => 'online',
        'online_url' => 'https://example.test/live-formation',
    ]);
    $approvedUser = User::factory()->create();
    $pendingUser = User::factory()->create();

    FormationRegistration::factory()->approved()->create([
        'formation_id' => $formation->getKey(),
        'user_id' => $approvedUser->getKey(),
    ]);
    FormationRegistration::factory()->create([
        'formation_id' => $formation->getKey(),
        'user_id' => $pendingUser->getKey(),
    ]);

    actingAs($approvedUser);

    Livewire::test('pages::formations.show', ['formation' => $formation])
        ->assertSee('https://example.test/live-formation');

    actingAs($pendingUser);

    Livewire::test('pages::formations.show', ['formation' => $formation])
        ->assertDontSee('https://example.test/live-formation');
});

it('allows a user to register again after a previous registration was deleted', function () {
    $formation = Formation::factory()->create([
        'status' => 'planned',
        'is_active' => true,
        'registration_deadline' => now()->addWeek(),
    ]);
    $user = User::factory()->create();

    $previousRegistration = (new RegisterForFormation)($formation, $user, '', true);
    $previousRegistration->delete();

    $newRegistration = (new RegisterForFormation)($formation, $user, 'Nouvelle demande.', true);

    expect($newRegistration->getKey())->toBe($previousRegistration->getKey())
        ->and($newRegistration->trashed())->toBeFalse()
        ->and($newRegistration->message)->toBe('Nouvelle demande.');
});
