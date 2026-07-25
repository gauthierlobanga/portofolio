<?php

use App\Models\FormationRegistration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function registrations(): Collection
    {
        return Auth::user()
            ->formationRegistrations()
            ->with(['formation.category', 'formation.media'])
            ->whereIn('status', [
                FormationRegistration::STATUS_APPROVED,
                FormationRegistration::STATUS_PENDING,
                FormationRegistration::STATUS_WAITLISTED,
            ])
            ->latest()
            ->limit(4)
            ->get();
    }

    #[Computed]
    public function totalCount(): int
    {
        return Auth::user()->formationRegistrations()->count();
    }

    #[Computed]
    public function activeCount(): int
    {
        return Auth::user()
            ->formationRegistrations()
            ->whereIn('status', [
                FormationRegistration::STATUS_APPROVED,
                FormationRegistration::STATUS_PENDING,
                FormationRegistration::STATUS_WAITLISTED,
            ])
            ->count();
    }
};