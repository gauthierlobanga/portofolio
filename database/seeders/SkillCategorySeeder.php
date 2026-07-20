<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // -------- Développement Web --------
            ['name' => 'Langages de programmation', 'color' => '#3b82f6', 'icon' => 'code-bracket', 'sort_order' => 1],
            ['name' => 'Frameworks Backend', 'color' => '#10b981', 'icon' => 'server', 'sort_order' => 2],
            ['name' => 'Frameworks Frontend', 'color' => '#06b6d4', 'icon' => 'rectangle-group', 'sort_order' => 3],
            ['name' => 'Bases de données', 'color' => '#f59e0b', 'icon' => 'circle-stack', 'sort_order' => 4],
            ['name' => 'APIs & Intégrations', 'color' => '#8b5cf6', 'icon' => 'arrows-right-left', 'sort_order' => 5],

            // -------- Outils & Environnement --------
            ['name' => 'Outils de développement', 'color' => '#6b7280', 'icon' => 'wrench-screwdriver', 'sort_order' => 6],
            ['name' => 'Conteneurisation & DevOps', 'color' => '#ef4444', 'icon' => 'cube-transparent', 'sort_order' => 7],
            ['name' => 'Versioning & Collaboration', 'color' => '#f97316', 'icon' => 'arrow-path', 'sort_order' => 8],

            // -------- Bureautique & Analyse --------
            ['name' => 'Suite Microsoft Office', 'color' => '#2563eb', 'icon' => 'document-text', 'sort_order' => 9],
            ['name' => 'Analyse de données', 'color' => '#0891b2', 'icon' => 'chart-pie', 'sort_order' => 10],
            ['name' => 'Business Intelligence', 'color' => '#7c3aed', 'icon' => 'presentation-chart-bar', 'sort_order' => 11],

            // -------- Conception & Modélisation --------
            ['name' => 'Modélisation UML & Merise', 'color' => '#db2777', 'icon' => 'pencil-square', 'sort_order' => 12],
            ['name' => 'Architecture logicielle', 'color' => '#4f46e5', 'icon' => 'squares-2x2', 'sort_order' => 13],

            // -------- Web Sémantique & Standards --------
            ['name' => 'Web sémantique', 'color' => '#0e7490', 'icon' => 'globe-alt', 'sort_order' => 14],

            // -------- Administration & Panels --------
            ['name' => 'Panneaux d\'administration', 'color' => '#059669', 'icon' => 'rectangle-stack', 'sort_order' => 15],

            // -------- CMS & E‑commerce --------
            ['name' => 'CMS & E‑commerce', 'color' => '#d97706', 'icon' => 'shopping-cart', 'sort_order' => 16],
        ];

        foreach ($categories as $category) {
            $category['slug'] = Str::slug($category['name']);
            SkillCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('✅ Toutes les catégories de compétences ont été créées avec succès.');
    }
}
