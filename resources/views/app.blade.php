<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO Meta Tags --}}
    <title inertia>{{ config('app.name', 'NoflayHub') }}</title>
    <meta name="description" content="Découvrez NoflayHub, la plateforme N°1 de location et vente immobilière au Sénégal. Trouvez villas, appartements, terrains et véhicules. Affaires rapides et sécurisées.">
    <meta name="keywords" content="immobilier Sénégal, location villa, appartement Dakar, terrain Sénégal, voiture occasion, covoiturage, services Sénégal, NoflayHub">
    <meta name="author" content="NoflayHub">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="language" content="French">
    <meta name="revisit-after" content="3 days">
    <meta name="theme-color" content="#eb2d53">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="NoflayHub - Marketplace Immobilier & Automobile">
    <meta property="og:description" content="Découvrez NoflayHub, la plateforme N°1 de location et vente immobilière au Sénégal. Trouvez villas, appartements, terrains et véhicules.">
    <meta property="og:image" content="{{ asset('logo.png') }}">
    <meta property="og:site_name" content="NoflayHub">
    <meta property="og:locale" content="fr_SN">
    
    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="NoflayHub - Marketplace Immobilier & Automobile">
    <meta property="twitter:description" content="Découvrez NoflayHub, la plateforme N°1 de location et vente immobilière au Sénégal.">
    <meta property="twitter:image" content="{{ asset('logo.png') }}">
    
    {{-- Google & Verification --}}
    @if(config('seo.google.site_verification'))
    <meta name="google-site-verification" content="{{ config('seo.google.site_verification') }}">
    @endif
    
    @if(config('seo.bing.site_verification'))
    <meta name="msvalidate.01" content="{{ config('seo.bing.site_verification') }}">
    @endif
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- Alternate Links pour Multilangues (à ajouter si multilingue) --}}
    <link rel="alternate" hreflang="fr" href="{{ url()->current() }}" />
    {{-- pwa --}}
    @PwaHead

    {{-- SEO Scripts (Analytics, Google Tag Manager, etc.) --}}
    @include('components.seo-scripts')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    {{-- logo --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Montserrat:ital,wght@0,400;1,500&display=swap"
        rel="stylesheet">

    {{-- aniation --}}
    <!-- Liens CDN pour Swiper.js -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead



    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }


        /* body {
            background-color: black;
        } */
    </style>
</head>

<body class="font-sans antialiased">
    @inertia
    @RegisterServiceWorkerScript
    
    <!-- Script pour gérer les cookies -->
    <script>
        // Fonction utilitaire pour vérifier le consentement aux cookies
        window.hasCookieConsent = function() {
            const consent = localStorage.getItem('cookie_consent');
            return consent === 'accepted' || consent === 'custom';
        };
        
        // Fonction pour obtenir les préférences de cookies
        window.getCookiePreferences = function() {
            const prefs = localStorage.getItem('cookie_preferences');
            if (prefs) {
                try {
                    return JSON.parse(prefs);
                } catch (e) {
                    return null;
                }
            }
            return null;
        };
    </script>
</body>

</html>
