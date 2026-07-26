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

/* Livewire View Transition styles for `content` group and types forward/backward */
::view-transition-old(content) {
    animation: 300ms ease-out both slide-out-left;
}

::view-transition-new(content) {
    animation: 300ms ease-in both slide-in-right;
}

html:active-view-transition-type(forward) {
    &::view-transition-old(content) {
        animation: 300ms ease-out both slide-out-left;
    }
    &::view-transition-new(content) {
        animation: 300ms ease-in both slide-in-right;
    }
}

html:active-view-transition-type(backward) {
    &::view-transition-old(content) {
        animation: 300ms ease-out both slide-out-right;
    }
    &::view-transition-new(content) {
        animation: 300ms ease-in both slide-in-left;
    }
}

@keyframes slide-out-left {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(-100%); opacity: 0; }
}
@keyframes slide-in-right {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
@keyframes slide-out-right {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}
@keyframes slide-in-left {
    from { transform: translateX(-100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
</style>

@fonts
@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
@livewireStyles
@stack('styles')

<style>
    /* Disable page scroll when `.no-scroll` is applied */
    .no-scroll, .no-scroll body {
        overflow: hidden !important;
        height: 100% !important;
        width: 100% !important;
        position: static !important;
    }
</style>

<script>
    (function () {
        const KEY = 'preserveScrollY';

        // Only act when the clicked actionable element (anchor/button) itself
        // has the data-preserve-scroll attribute. This avoids capturing clicks
        // inside sections that happen to carry the attribute on a parent.
        document.addEventListener('click', function (e) {
            // Find the actionable element the user actually clicked (anchor or button)
            const actionable = e.target.closest('a[href], button[type="button"], [role="button"]');
            if (!actionable) return;

            if (!actionable.hasAttribute('data-preserve-scroll')) return;

            // If this is a programmatic click triggered by the view-transition flow,
            // allow the default action to proceed (do nothing).
            if (actionable.dataset.vtPending === '1') {
                delete actionable.dataset.vtPending;
                return;
            }

            // Only handle same-origin links (external links should behave normally)
            if (actionable.tagName.toLowerCase() === 'a') {
                const href = actionable.getAttribute('href') || '';
                if (/^\w+:\/\//.test(href)) {
                    try {
                        const url = new URL(href, location.href);
                        if (url.origin !== location.origin) return; // external
                    } catch (err) {
                        // if URL parse fails, allow default
                    }
                }
            }

            e.preventDefault();

            const href = actionable.getAttribute('href');
            try {
                sessionStorage.setItem(KEY, String(window.scrollY || window.pageYOffset || 0));
            } catch (err) {
                // ignore storage errors
            }

            // lock scrolling visually while transitioning
            document.documentElement.classList.add('no-scroll');

            const navigate = () => {
                try {
                    // Mark as pending so our handler ignores the programmatic click
                    actionable.dataset.vtPending = '1';
                    // Trigger the native click event so Livewire's wire:navigate handlers
                    // (if present) will receive it and perform their client-side navigation.
                    // Using a timeout lets the dataset flag set before the event fires.
                    setTimeout(() => actionable.click(), 0);
                } catch (err) {
                    // Fallback to full navigation
                    if (href) window.location.href = href;
                }
            };

            if (typeof document.startViewTransition === 'function') {
                try {
                    document.startViewTransition(() => {
                        navigate();
                    });
                } catch (err) {
                    navigate();
                }
            } else {
                navigate();
            }
        }, true);

        // On page load, restore scroll position if present and remove the lock
        window.addEventListener('DOMContentLoaded', function () {
            try {
                const v = sessionStorage.getItem(KEY);
                if (v !== null) {
                    const y = parseInt(v, 10) || 0;
                    // Use setTimeout to wait for layout to stabilize if needed
                    setTimeout(() => {
                        window.scrollTo({ top: y, left: 0, behavior: 'auto' });
                        window.dispatchEvent(new Event('scroll'));
                        try { sessionStorage.removeItem(KEY); } catch (e) {}
                    }, 5);
                }
            } catch (err) {
                // ignore
            }

            // Ensure lock is removed after load
            document.documentElement.classList.remove('no-scroll');
        });
    })();
</script>

    