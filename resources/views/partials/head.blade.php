<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

@php
    $faviconUrl = \App\Support\Branding\Favicon::currentUrl();

    // Paramètres de l'application
$appSettings = app(\App\Settings\SettingApp::class);
$aboutSettings = app(\App\Settings\AboutSettings::class);

// Logo de l'application (dynamique)
    $appLogo = $appSettings->logoUrl() ?: asset('images/logo-app.svg');

    // Image SEO (utilisée à la fois pour Open Graph et le schéma)
    $seoImage = $seoImage ?? $appLogo;

    // Adresses : utiliser le tableau $addresses de SettingApp
    $addresses = $appSettings->addresses ?? [];
    if (!empty($addresses) && is_array($addresses)) {
        $firstAddress = reset($addresses);
        $street = $firstAddress['address'] ?? ($firstAddress['street'] ?? '');
        $locality = $firstAddress['city'] ?? ($firstAddress['locality'] ?? 'Kinshasa');
        $region = $firstAddress['state'] ?? ($firstAddress['region'] ?? 'Kinshasa');
        $country = $firstAddress['country'] ?? 'CD';
    } else {
        // Fallback sur l'adresse de AboutSettings
    $street = $aboutSettings->address ?? 'Kinshasa Ngaliema, République Démocratique du Congo';
    $locality = 'Kinshasa';
    $region = 'Kinshasa';
    $country = 'CD';
}

// Construction du schéma Person par défaut
if (!isset($schema)) {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => $appSettings->name ?? config('app.name', 'Gauthier Lobanga'),
        'jobTitle' => 'Développeur Web',
        'url' => url('/'),
        'image' => $appLogo,
        'description' => 'Portfolio de développeur passionné par la création d\'applications web performantes et d\'expériences utilisateur uniques.',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $street,
            'addressLocality' => $locality,
            'addressRegion' => $region,
            'addressCountry' => $country,
        ],
        'sameAs' => array_values(
            array_filter([
                $appSettings->facebook_url ?? null,
                $appSettings->x_url ?? null,
                $appSettings->linkedin_url ?? null,
                $appSettings->youtube_url ?? null,
                'https://github.com/gauthierlobanga'
            ]),
        ),
    ];
}
@endphp

<x-seo :title="$title ?? null" :description="$seoDescription ?? null" :image="$seoImage" :url="$seoUrl ?? null" :type="$seoType ?? 'website'" :keywords="$seoKeywords ?? null">
    @if(isset($schema) && is_string($schema))
        {!! $schema !!}
    @else
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
    @endif
</x-seo>

@include('feed::links')

@if(app()->environment('production'))
    <script defer data-domain="{{ parse_url(config('app.url'), PHP_URL_HOST) }}" src="https://plausible.io/js/script.js"></script>
@endif

{{-- Favicon --}}
<link id="favicon" rel="icon" href="{{ $faviconUrl }}" data-favicon-href="{{ $faviconUrl }}">
<link id="apple-touch-icon" rel="apple-touch-icon" href="{{ $faviconUrl }}">
<link rel="preconnect" href="https://fonts.bunny.net">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300..700;1,14..32,300..500&family=Playfair+Display:wght@600;700;800&display=swap">
<style>
    /* removed overflow-x: hidden to allow position: sticky to work */
    .glass-panel {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }

    [x-cloak] {
        display: none !important;
    }

    .no-transition,
    .no-transition * {
        transition: none !important;
    }
</style>

@fonts
@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
@livewireStyles
@stack('styles')

