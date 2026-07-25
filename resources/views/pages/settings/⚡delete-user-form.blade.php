<?php

use Livewire\Component;

new class extends Component {}; ?>

<section class="space-y-6">
    <div class="relative mb-5">
        <flux:heading size="lg" class="text-red-600 dark:text-red-400">{{ __('Delete account') }}</flux:heading>
        <flux:subheading>{{ __('Delete your account and all of its resources') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" data-test="delete-user-button">
            {{ __('Delete account') }}
        </flux:button>
    </flux:modal.trigger>

    <livewire:pages::settings.delete-user-modal />
</section>
