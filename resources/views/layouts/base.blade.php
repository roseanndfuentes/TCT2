<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @wireUiScripts
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src=" https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js "></script>
    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
    @stack('styles')
    @yield('head')
</head>

<body class="font-sans bg-indigo-50 antialiased">
    <x-notifications />
    @yield('content')
    @livewireScripts
    <x-dialog />
    @stack('scripts')
    @yield('scripts')
</body>

</html>
