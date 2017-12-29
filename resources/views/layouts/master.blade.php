<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom_css/chandra.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom_css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom_css/panel.css')}}">
    <script type="text/javascript" src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    @yield('custom-include')
    @yield('custom-internal-css')
</head>
<body class="@yield('body-class')">
    @include('inc.navbar')
    @yield('content')
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom_js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom_js/metisMenu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom_js/rightside_bar.js') }}" type="text/javascript"></script>
    @yield('custom-script')
</body>
</html>