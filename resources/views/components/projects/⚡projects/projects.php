<?php

use App\Models\Project;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::main')] class extends Component
{
    #[Computed]
    public function projects(): Collection
    {
        return Project::with('media')
            ->active()
            ->where('status', 'completed')
            ->latest('end_date')
            ->take(9)
            ->get();
    }
};
