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
    @stack('styles')
</head>

<body>
    <div id="app">

        @include('includes.admin-navigation')

        {{-- content --}}
        @yield('content')

        @include('includes.scripts')
        @stack('after-scripts')

    </div>
</body>

</html>
