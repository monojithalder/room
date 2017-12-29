<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script type="text/javascript" src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    @yield('custom-include')
    @yield('custom-internal-css')
</head>
<body class="@yield('body-class')">
    @include('inc.navbar')
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('custom-script')
</body>
</html>