<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>{{ config('dotzone.cms.name') }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="theme-color" content="#FFFFFF" />
    <meta name="author" content="Ahmad Chebbo">
    <meta name="robots" content="index, nofollow">
    <link rel="icon" href="{{ asset('manage/images/icon-dark.png') }}" type="image/png">
    <!--Begin::CSS-->
    <link href="{{ asset('manage/css/custom.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('manage/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('manage/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    @yield('styles')

</head>
<body>

@yield('content')

<script src="{{ asset('manage/js/plugins.bundle.js') }}"></script>
<script src="{{ asset('manage/js/scripts.bundle.js') }}"></script>
@yield('scripts')
</body>
</html>
