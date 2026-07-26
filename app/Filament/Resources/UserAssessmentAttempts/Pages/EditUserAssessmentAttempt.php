<?php

namespace App\Filament\Resources\UserAssessmentAttempts\Pages;

use App\Filament\Resources\UserAssessmentAttempts\UserAssessmentAttemptResource;
use App\Models\FormationRegistration;
use App\Models\UserModuleProgress;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserAssessmentAttempt extends EditRecord
{
    protected static string $resource = UserAssessmentAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $attempt = $this->record;

        $totalPointsAwarded = $attempt->answers()->sum('points_awarded');
        $totalPointsPossible = $attempt->assessment->questions()->sum('points');

        $percentage = $totalPointsPossible > 0 ? ($totalPointsAwarded / $totalPointsPossible) * 100 : 0;

        $passed = $percentage >= $attempt->assessment->passing_score;

        $attempt->update([
            'score' => $percentage,
            'passed' => $passed,
        ]);

        if ($passed && $attempt->assessment->formation_module_id) {
            UserModuleProgress::updateOrCreate(
                [
                    'user_id' => $attempt->user_id,
                    'formation_module_id' => $attempt->assessment->formation_module_id,
                ],
                ['is_completed' => true, 'completed_at' => now()]
            );
        }

        if ($passed && $attempt->assessment->type === 'admission' && $attempt->assessment->formation_id) {
            $registration = FormationRegistration::where('user_id', $attempt->user_id)
                ->where('formation_id', $attempt->assessment->formation_id)
                ->first();

            if ($registration) {
                $notes = $registration->admin_notes ? $registration->admin_notes."\n" : '';
                $registration->update([
                    'admin_notes' => $notes.'Test d\'admission réussi avec un score de '.$percentage.'% le '.now()->format('d/m/Y H:i'),
                ]);
            }
        }
    }
}
