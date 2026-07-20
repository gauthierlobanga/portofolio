<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\FormationCategory::factory()->createMany([
            ['name' => 'Techniques agricoles', 'slug' => 'techniques-agricoles', 'color' => '#10b981', 'sort_order' => 10],
            ['name' => 'Gestion de projet', 'slug' => 'gestion-de-projet', 'color' => '#0ea5e9', 'sort_order' => 20],
            ['name' => 'Formation communautaire', 'slug' => 'formation-communautaire', 'color' => '#f59e0b', 'sort_order' => 30],
            ['name' => 'Agronomie & sol', 'slug' => 'agronomie-sol', 'color' => '#7c3aed', 'sort_order' => 40],
        ]);
    }
}
