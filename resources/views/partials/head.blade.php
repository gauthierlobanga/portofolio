<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

@php
    $faviconUrl = \App\Support\Branding\Favicon::currentUrl();

    // Paramètres de l'application
$appSettings = app(\App\Settings\SettingApp::class);
$aboutSettings = app(\App\Settings\AboutSettings::class);

// Logo de l'application (dynamique)
    $appLogo = $appSettings->logoUrl() ?: asset('images/cadersa-logo.png');

    // Image SEO (utilisée à la fois pour Open Graph et le schéma)
    $seoImage = $seoImage ?? $appLogo;

    // Adresses : utiliser le tableau $addresses de SettingApp
    $addresses = $appSettings->addresses ?? [];
    if (!empty($addresses) && is_array($addresses)) {
        $firstAddress = reset($addresses);
        $street = $firstAddress['address'] ?? ($firstAddress['street'] ?? '');
        $locality = $firstAddress['city'] ?? ($firstAddress['locality'] ?? 'Bukavu');
        $region = $firstAddress['state'] ?? ($firstAddress['region'] ?? 'Sud-Kivu');
        $country = $firstAddress['country'] ?? 'CD';
    } else {
        // Fallback sur l'adresse de AboutSettings
    $street = $aboutSettings->address ?? 'Av. Mbaki N° 041, Q. Ndedere';
    $locality = 'Bukavu';
    $region = 'Sud-Kivu';
    $country = 'CD';
}

// Construction du schéma Organization
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $appSettings->name ?? config('app.name', 'CADERSA ASBL'),
    'url' => url('/'),
    'logo' => $appLogo,
    'description' =>
        'Centre d’Appui au Développement Rural et à la Sécurité Alimentaire. CADERSA accompagne les communautés congolaises à travers des projets agricoles, sociaux et environnementaux.',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $street,
        'addressLocality' => $locality,
        'addressRegion' => $region,
        'addressCountry' => $country,
    ],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'telephone' => $appSettings->phone,
        'contactType' => 'customer service',
        'email' => $appSettings->email,
    ],
    'sameAs' => array_values(
            array_filter([
                $appSettings->facebook_url,
                $appSettings->x_url,
                $appSettings->linkedin_url,
                $appSettings->youtube_url,
            ]),
        ),
    ];
@endphp

<x-seo :title="$title ?? null" :description="$seoDescription ?? null" :image="$seoImage" :url="$seoUrl ?? null" :type="$seoType ?? 'website'" :keywords="$seoKeywords ?? null">
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
</x-seo>

{{-- Google Analytics (ne se chargera que si "Analytiques" est accepté) --}}
<x-cookie-script type="analytics">
    <!-- Remplacez G-XXXXXXX par votre vrai code Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-XXXXXXX');
    </script>
</x-cookie-script>

{{-- Pixel Facebook / Autres trackers publicitaires (ne se chargera que si "Marketing" est accepté) --}}
<x-cookie-script type="marketing">
    <!-- Insérez ici votre code de suivi publicitaire (Pixel FB, LinkedIn Insight, etc.) -->
    <script>
        // Code de suivi marketing...
    </script>
</x-cookie-script>

@include('feed::links')
{{-- Favicon --}}
<link id="favicon" rel="icon" href="{{ $faviconUrl }}" data-favicon-href="{{ $faviconUrl }}">
<link id="apple-touch-icon" rel="apple-touch-icon" href="{{ $faviconUrl }}">
<style>
    body {
        font-family: 'Inter', sans-serif;
        overflow-x: hidden;
    }


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
@vite('resources/css/app.css')
@fluxAppearance
@livewireStyles
@filamentStyles
