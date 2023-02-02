<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Dotzone Group') }} | {{ __('messages.dotzoneGroup') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="theme-color" content="#FFFFFF" />
    <meta name="author" content="Ahmad Chebbo">
    <meta name="robots" content="index, nofollow">
    <link rel="icon" href="{{ Config::get('settings.site_favicon') }}" type="image/png">
    <!--Begin::CSS-->
    <link href="{{ asset('css/custom.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    @yield('styles')

</head>
<body>

@yield('content')

<script src="{{ asset('js/plugins.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>
@yield('scripts')
</body>
</html>
