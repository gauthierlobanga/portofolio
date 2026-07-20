<?php

namespace Database\Factories;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Formation>
 */
class FormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->optional(0.7)->dateTimeBetween('-1 years', '+1 years');
        $end = $start ? $this->faker->optional(0.6)->dateTimeBetween($start, '+1 years') : null;

        $title = $this->faker->sentence(4);
        return [
            'title' => $title,
            'slug' => 
                \Illuminate\Support\Str::slug($title) . '-' . $this->faker->unique()->numerify('##'),
            'subtitle' => $this->faker->optional()->sentence(6),
            'excerpt' => $this->faker->optional()->paragraph(2),
            'content' => $this->faker->optional()->paragraphs(5, true),
            'location' => $this->faker->optional()->city(),
            'status' => $this->faker->randomElement(['planned','ongoing','completed']),
            'is_active' => $this->faker->boolean(80),
            'start_date' => $start ? $start->format('Y-m-d') : null,
            'end_date' => $end ? $end->format('Y-m-d') : null,
            'published_at' => $this->faker->optional(0.6)->dateTimeBetween('-1 years', 'now'),
            'meta' => null,
            'sort_order' => $this->faker->optional()->numberBetween(1, 200),
        ];
    }
}
