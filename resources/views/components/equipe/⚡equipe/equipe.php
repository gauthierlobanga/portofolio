<?php

use App\Models\TeamMember;
use App\Settings\AboutSettings;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function members()
    {
        return TeamMember::query()
            ->orderBy('sort_order')
            ->get();
    }

    #[Computed]
    public function about(): AboutSettings
    {
        return app(AboutSettings::class);
    }
};
