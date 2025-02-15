<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    @PwaHead

    {{-- <link rel="icon" type="image/png" href="{{ asset('storage/slide/n.png') }}"> --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link rel="icon" type="image/png" href="/https://noflayhub.com/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/https://noflayhub.com/favicon.svg" />
    <link rel="shortcut icon" href="/https://noflayhub.com/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/https://noflayhub.com/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Noflayhub" />
    <link rel="manifest" href="/https://noflayhub.com/site.webmanifest" />


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
