<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\FormationModule;
use App\Models\ModuleProject;
use App\Models\User;
use App\Models\UserModuleProgress;
use App\Models\UserProjectSubmission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FormationModuleSeeder extends Seeder
{
    public function run(): void
    {
        $formations = Formation::all();
        $users = User::all();

        if ($formations->isEmpty() || $users->isEmpty()) {
            $this->command->info('Aucune formation ou utilisateur trouvé, seed ignoré.');

            return;
        }

        foreach ($formations->take(3) as $formation) {
            $modules = [
                ['title' => 'Introduction & Fondamentaux', 'description' => 'Présentation du cours, objectifs et prérequis.', 'order' => 1],
                ['title' => 'Environnement de développement', 'description' => 'Installation et configuration des outils nécessaires.', 'order' => 2],
                ['title' => 'Concepts avancés', 'description' => 'Exploration en profondeur des concepts clés.', 'order' => 3],
                ['title' => 'Pratiques et ateliers', 'description' => 'Exercices pratiques et projets guidés.', 'order' => 4],
                ['title' => 'Projet final de module', 'description' => 'Projet intégrateur de toutes les compétences acquises.', 'order' => 5],
            ];

            foreach ($modules as $moduleData) {
                $module = FormationModule::firstOrCreate(
                    ['formation_id' => $formation->id, 'title' => $moduleData['title']],
                    [
                        'id' => Str::uuid(),
                        'description' => $moduleData['description'],
                        'sort_order' => $moduleData['order'],
                    ]
                );

                // Add 1 project per module
                $project = ModuleProject::firstOrCreate(
                    ['formation_module_id' => $module->id, 'title' => 'Projet - '.$moduleData['title']],
                    [
                        'id' => Str::uuid(),
                        'description' => 'Projet de fin de module à rendre avant la session suivante.',
                    ]
                );

                // Seed progress for each user registered to this formation
                foreach ($users->take(5) as $user) {
                    $isRegistered = $user->formationRegistrations()->where('formation_id', $formation->id)->exists();
                    if (! $isRegistered) {
                        continue;
                    }

                    $statuses = ['pending', 'in_progress', 'completed'];
                    $status = $statuses[array_rand($statuses)];

                    UserModuleProgress::firstOrCreate(
                        ['user_id' => $user->id, 'formation_module_id' => $module->id],
                        [
                            'status' => $status,
                            'completed_at' => $status === 'completed' ? now()->subDays(rand(1, 30)) : null,
                        ]
                    );

                    $projectStatuses = ['pending', 'submitted', 'graded'];
                    $projectStatus = $projectStatuses[array_rand($projectStatuses)];
                    $grades = ['A', 'B', 'C', 'TB'];

                    UserProjectSubmission::firstOrCreate(
                        ['user_id' => $user->id, 'module_project_id' => $project->id],
                        [
                            'status' => $projectStatus,
                            'grade' => $projectStatus === 'graded' ? $grades[array_rand($grades)] : null,
                            'feedback' => $projectStatus === 'graded' ? 'Très bon travail, continuez ainsi !' : null,
                        ]
                    );
                }
            }
        }

        $this->command->info('Modules, projets et progression seedés avec succès.');
    }
}
