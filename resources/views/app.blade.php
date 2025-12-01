<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title inertia>{{ config('app.name', 'NoflayHub') }}</title>
    <meta name="description" content="NoflayHub - Plateforme de location immobilière au Sénégal. Trouvez votre logement idéal : villas, appartements, chambres, studios et terrains à louer.">
    <meta name="keywords" content="location Sénégal, immobilier Sénégal, villa à louer, appartement à louer, chambre à louer, studio à louer, terrain à louer, location Dakar, location Thiès, location Saint-Louis, NoflayHub">
    <meta name="author" content="NoflayHub">
    <meta name="robots" content="index, follow">
    <meta name="language" content="French">
    <meta name="revisit-after" content="7 days">
    <meta name="theme-color" content="#eb2d53">
    
    <link rel="icon" type="image/png" href="{{ asset('storage/n.png') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    {{-- pwa --}}
    @PwaHead

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
</body>

</html>
