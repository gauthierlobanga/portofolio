<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Settings\AboutSettings;
use App\Concerns\Traits\HasImageUrl;

new class extends Component {
    use HasImageUrl;

    #[Computed]
    public function about(): AboutSettings
    {
        return app(AboutSettings::class);
    }
};
?>

<div wire:cloak class="flex-1 w-full overflow-hidden" x-data="heroImageReveal">
    <div class="relative w-full mt-8 md:mt-0">
        {{-- Halo lumineux discret --}}
        <div class="absolute -inset-4 bg-emerald-500/10 dark:bg-emerald-400/10 blur-3xl"></div>

        {{-- Image avec animation d’entrée --}}
        <div x-ref="takeOff" class="relative z-10">
            @php
                $heroImage = $this->about->hero_image_url
                    ? $this->imageUrl($this->about->hero_image_url)
                    : $this->imageUrl('images/gaudev-hero.png');
            @endphp
            <img src="{{ $heroImage }}"
                 class="w-full h-auto object-contain"
                 alt="Portrait de Gauthier Lobanga"
                 loading="eager"
                 fetchpriority="high" />
        </div>
    </div>
</div>
