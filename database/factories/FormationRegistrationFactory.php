<?php

namespace Database\Factories;

use App\Models\Formation;
use App\Models\FormationRegistration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FormationRegistration>
 */
class FormationRegistrationFactory extends Factory
{
    protected $model = FormationRegistration::class;

    public function definition(): array
    {
        return [
            'formation_id' => Formation::factory(),
            'user_id' => User::factory(),
            'status' => FormationRegistration::STATUS_PENDING,
            'payment_status' => FormationRegistration::PAYMENT_FREE,
            'amount' => null,
            'currency' => 'EUR',
            'payment_reference' => null,
            'attendance_status' => FormationRegistration::ATTENDANCE_REGISTERED,
            'terms_accepted_at' => now(),
            'approved_at' => null,
            'cancelled_at' => null,
            'message' => fake()->optional()->paragraph(),
            'admin_notes' => null,
        ];
    }

    public function approved(): static
    {
        return $this->state([
            'status' => FormationRegistration::STATUS_APPROVED,
            'approved_at' => now(),
        ]);
    }

    public function waitlisted(): static
    {
        return $this->state([
            'status' => FormationRegistration::STATUS_WAITLISTED,
        ]);
    }
}
