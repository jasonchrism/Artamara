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
    @vite('resources/css/app.css')
    @vite('resources/css/navigation.css')
    @stack('styles')
</head>

<body>
    <div id="app">
        {{-- navigation --}}
        @include('includes.navigation')

        {{-- content --}}
        @yield('content')

        {{-- footer --}}
        @include('includes.footer')

        @stack('after-scripts')
    </div>
</body>

</html>
