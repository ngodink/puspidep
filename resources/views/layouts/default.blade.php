<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="language" content="{{ app()->getLocale() }}" />
    <meta name='keywords' content="@yield('meta_keywords', 'puspidep')"/>
    <meta name='geo.placename' content='Indonesia'/>
    <meta name='audience' content='all'/>
    <meta name='rating' content='general'/>
    <meta name='author' content="@yield('meta_author', config('app.name'))"/>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="@yield('meta_url', url()->current())" />
    <meta property="og:title" content="@yield('title'){{ config('app.name') }}" />
    <meta property="og:image" content="@yield('meta_image', asset('img/logo/rounded-bw-128.png'))" />
    <meta property="og:description" content="@yield('meta_description', 'Pusat Pengkajian Islam Demokrasi dan Perdamaian')" />
    @if(env('APP_DEBUG', false) == false)
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
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
