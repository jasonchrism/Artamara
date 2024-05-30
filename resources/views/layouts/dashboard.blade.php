<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- meta --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('resources/css/dashboard.css')
    @vite('resources/css/sidebar.css')
    @vite('resources/css/header.css')
    @stack('styles')
</head>

<body>
    <div id="app">
        @include('includes.sidebar')
        <div class="wrapper">
                @include('includes.header')
                @yield('content')
        </div>

        {{-- content --}}

        @include('includes.scripts')
        @stack('after-scripts')

    </div>
</body>

</html>
