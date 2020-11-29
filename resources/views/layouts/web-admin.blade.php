<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>

	{{-- <link rel="icon" href="{{ asset('/auth/images/icons/favicon.ico') }}" type="image/x-icon" /> --}}

	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('/web/css/fontawesome/all.min.css') }}">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('/web/css/bootstrap.css') }}" rel="stylesheet">
	
	@yield('links')

	<!-- Style CSS -->
	<link href="{{ asset('/web/css/style-admin.css') }}" rel="stylesheet">
	<!-- Style CSS -->
</head>
<body class="goto-here bg-light-grey">

	@include('web.admin.partials.navbar')

	@yield('content')
	
	@include('web.partials.loader')

	<!-- JQuery -->
	<script type="text/javascript" src="{{ asset('/web/js/jquery-3.4.1.min.js') }}"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="{{ asset('/web/js/popper.min.js') }}"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="{{ asset('/web/js/bootstrap.min.js') }}"></script>

	@yield('scripts')

	<!-- Scripts -->
	<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
	<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
	<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
	<script src="{{ asset('/admins/js/validate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/web/js/script-admin.js') }}"></script>
	@include('admin.partials.notifications')
</body>
</html>