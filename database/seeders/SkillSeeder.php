<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $categories = SkillCategory::all()->keyBy('name');

        $skills = [
            // Langages
            ['name' => 'PHP', 'level' => 95, 'category' => 'Langages de programmation'],
            ['name' => 'JavaScript', 'level' => 90, 'category' => 'Langages de programmation'],
            ['name' => 'TypeScript', 'level' => 75, 'category' => 'Langages de programmation'],
            ['name' => 'Python', 'level' => 50, 'category' => 'Langages de programmation'],
            ['name' => 'SQL', 'level' => 85, 'category' => 'Langages de programmation'],

            // Backend
            ['name' => 'Laravel', 'level' => 95, 'category' => 'Frameworks Backend'],
            ['name' => 'Livewire', 'level' => 90, 'category' => 'Frameworks Backend'],
            ['name' => 'Symfony', 'level' => 60, 'category' => 'Frameworks Backend'],

            // Frontend
            ['name' => 'React', 'level' => 80, 'category' => 'Frameworks Frontend'],
            ['name' => 'Inertia.js', 'level' => 85, 'category' => 'Frameworks Frontend'],
            ['name' => 'Alpine.js', 'level' => 85, 'category' => 'Frameworks Frontend'],
            ['name' => 'Tailwind CSS', 'level' => 90, 'category' => 'Frameworks Frontend'],
            ['name' => 'Vue.js', 'level' => 55, 'category' => 'Frameworks Frontend'],

            // Bases de données
            ['name' => 'MySQL', 'level' => 85, 'category' => 'Bases de données'],
            ['name' => 'PostgreSQL', 'level' => 75, 'category' => 'Bases de données'],
            ['name' => 'SQL Server', 'level' => 60, 'category' => 'Bases de données'],
            ['name' => 'Redis', 'level' => 65, 'category' => 'Bases de données'],

            // API & Intégrations
            ['name' => 'REST API', 'level' => 90, 'category' => 'APIs & Intégrations'],
            ['name' => 'GraphQL', 'level' => 50, 'category' => 'APIs & Intégrations'],
            ['name' => 'Sanctum', 'level' => 80, 'category' => 'APIs & Intégrations'],

            // Outils
            ['name' => 'Git', 'level' => 90, 'category' => 'Outils de développement'],
            ['name' => 'Docker', 'level' => 75, 'category' => 'Conteneurisation & DevOps'],
            ['name' => 'GitHub Actions', 'level' => 70, 'category' => 'Versioning & Collaboration'],
            ['name' => 'VS Code', 'level' => 95, 'category' => 'Outils de développement'],

            // Bureautique
            ['name' => 'Word', 'level' => 90, 'category' => 'Suite Microsoft Office'],
            ['name' => 'Excel', 'level' => 85, 'category' => 'Suite Microsoft Office'],
            ['name' => 'PowerPoint', 'level' => 80, 'category' => 'Suite Microsoft Office'],

            // Analyse & BI
            ['name' => 'Power BI', 'level' => 70, 'category' => 'Business Intelligence'],
            ['name' => 'Power Query', 'level' => 75, 'category' => 'Analyse de données'],

            // Modélisation
            ['name' => 'UML', 'level' => 80, 'category' => 'Modélisation UML & Merise'],
            ['name' => 'Merise', 'level' => 75, 'category' => 'Modélisation UML & Merise'],

            // Panneaux d'admin
            ['name' => 'FilamentPHP', 'level' => 92, 'category' => 'Panneaux d\'administration'],

            // CMS
            ['name' => 'WordPress', 'level' => 60, 'category' => 'CMS & E‑commerce'],
        ];

        foreach ($skills as $skill) {
            $category = $categories->get($skill['category']);
            if ($category) {
                Skill::create([
                    'name' => $skill['name'],
                    'level' => $skill['level'],
                    'skill_category_id' => $category->id,
                ]);
            }
        }
    }
}
