<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('/admins/img/favicon.ico') }}"/> --}}
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('/admins/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admins/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admins/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('/admins/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admins/css/forms/switches.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
</head>
<body class="form">

    @yield('content')

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/admins/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('/admins/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('/admins/js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script src="{{ asset('/admins/js/authentication/form-2.js') }}"></script>
    <script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
    @include('admin.partials.notifications')
</body>
</html>