<?php

use App\Models\Skill;
use App\Settings\AboutSettings;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function skills(): Collection
    {
        return Skill::with(['categorySkill', 'media'])
            ->get()
            ->sortBy([
                ['categorySkill.sort_order', 'asc'],
                ['level', 'desc'],
            ]);
    }

    #[Computed]
    public function categories(): Collection
    {
        return $this->skills
            ->groupBy(fn ($skill) => $skill->skill_category_id ?? 'none')
            ->take(6);
    }

    #[Computed]
    public function about(): AboutSettings
    {
        return app(AboutSettings::class);
    }
};
