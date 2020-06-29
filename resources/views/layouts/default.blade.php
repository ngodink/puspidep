<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    @if(env('APP_DEBUG', false) == false)
        <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    @endif
    <link href="{{ asset('vendor/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    <title>@yield('title') @yield('titleTemplate', config('app.name', 'Application'))</title>
    @stack('style')
</head>
<body class="@yield('bodyclass')">
    
    @yield('main')

    <script src="{{ asset('js/script.min.js') }}"></script>
    @stack('script')
</body>
</html>
