@props([
    'sidebar' => false,
])

@php
    $settings = app(\App\Settings\SettingApp::class);
    $logoUrl = $settings->logoUrl();
    $appName = $settings->name;
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 sm:gap-3']) }}>
    <img src="{{ $logoUrl ?? Storage::url('images/logo.svg') }}" alt="{{ $appName }}"
        class="h-20 sm:h-20 w-auto object-contain" />
</div>
