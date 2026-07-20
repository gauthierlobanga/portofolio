<?php

namespace Database\Factories;

use App\Models\FormationCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FormationCategory>
 */
class FormationCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => ucfirst($name),
            'slug' => \Illuminate\Support\Str::slug($name),
            'icon' => null,
            'color' => $this->faker->optional()->safeHexColor(),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
