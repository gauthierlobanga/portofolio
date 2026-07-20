<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Settings\AboutSettings;

new #[Layout('layouts::main')] class extends Component {

    #[Computed]
    public function about(): AboutSettings
    {
        return app(AboutSettings::class);
    }
};
