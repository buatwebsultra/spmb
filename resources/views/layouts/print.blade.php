<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    {{-- @vite(['resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-016aeda7.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-3df8c8d7.css') }}">
    <script src="{{ asset('build/assets/app-4bab669b.js') }}" defer></script>
    
    @livewireStyles
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    @livewireScripts
</body>
