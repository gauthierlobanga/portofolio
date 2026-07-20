<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formations = \App\Models\Formation::factory()->count(8)->create();

        $categories = \App\Models\FormationCategory::pluck('id')->toArray();
        if (!empty($categories)) {
            foreach ($formations as $formation) {
                $formation->formation_category_id = $this->fakerCategory($categories);
                $formation->save();
            }
        }
    }

    protected function fakerCategory(array $categories): int
    {
        // simple random pick
        return $categories[array_rand($categories)];
    }
}
