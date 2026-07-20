<?php

use App\Models\Skill;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function skills(): Collection
    {
        return Skill::with('categorySkill')
            ->get()
            ->sortBy([
                ['categorySkill.sort_order', 'asc'],
                ['level', 'desc'],
            ]);
    }

    #[Computed]
    public function categories(): Collection
    {
        return $this->skills->groupBy('skill_category_id');
    }
};
