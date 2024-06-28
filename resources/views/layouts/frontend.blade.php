<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        .leaflet-pane {
            z-index: 0 !important;
        }
    </style>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/swiper/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/leaflet/leaflet.css') }}">

    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-montserrat text-gray-900" style="background-color: #000000; max-width: 100vw">
    <div class="mx-auto">
        <div class="my-auto min-h-screen"
            style="{{ !request()->routeIs(['splash','detail','checkout']) ? 'padding-bottom: 15%' : '' }}">
            {{ $slot }}
        </div>

        @if (!request()->routeIs(['splash','detail','checkout']))
        @include('layouts.bottom-navigation')
        @endif
        @stack('modals')
    </div>
    <script src="{{ asset('assets/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/leaflet/leaflet.js') }}"></script>
    @stack('scripts')
</body>

</html>