<?php

namespace App\Livewire\Dashboard;

use App\Models\UserAssessmentAttempt;
use Livewire\Component;

class LearnerAnalyticsWidget extends Component
{
    public function render()
    {
        $user = auth()->user();

        $attempts = UserAssessmentAttempt::with('assessment.module')
            ->where('user_id', $user->id)
            ->where('status', 'graded')
            ->get();

        $averageScore = $attempts->avg('score') ?? 0;

        $typeDistribution = $attempts->groupBy(function ($attempt) {
            return $attempt->assessment->type;
        })->map->count();

        return view('livewire.dashboard.learner-analytics-widget', [
            'attempts' => $attempts,
            'averageScore' => round($averageScore, 2),
            'typeDistribution' => $typeDistribution,
        ]);
    }
}
