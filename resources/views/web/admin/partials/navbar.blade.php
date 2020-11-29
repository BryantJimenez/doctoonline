<nav class="navbar shadow-dark navbar-dark navbar-expand-lg mt-4">
	<div class="container px-0">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-12">
				<a href="{{ route('web.profile') }}"><img src="{{ asset('/web/img/logo.png') }}" class="logo"></a>
			</div>
			<div class="col-lg-8 col-md-8 col-12 pt-2">
				<p class="h5 text-uppercase text-primary text-right mt-1">@yield('title.header')</p>
			</div>
			@if(session('user') && request()->is('seleccionar')===false)
			<div class="col-12 mt-2">
				<a href="{{ route('web.profile') }}" class="btn btn-primary rounded text-uppercase mt-2 py-xl-2">Mi Perfil</a>
				<a href="{{ route('web.profile.edit') }}" class="btn btn-primary rounded text-uppercase mt-2 py-xl-2">Editar Perfil</a>
				@if(session('user')[0]->type=="1")
				<a href="{{ route('search') }}" class="btn btn-primary rounded text-uppercase mt-2 py-xl-2">Informes Médicos</a>
				@endif
				@if(session('user')[0]->type=="2")
				<a href="{{ route('reports') }}" class="btn btn-primary rounded text-uppercase mt-2 py-xl-2">Informes Médicos</a>
				@endif
				@if(session('user')[0]->type=="1")
				<a href="{{ route('diaries') }}" class="btn btn-primary rounded text-uppercase mt-2 py-xl-2">Mi Agenda</a>
				@endif
				@if(!is_null(session('user')[0]->patient) && !is_null(session('user')[0]->doctor))
				@if(session('user')[0]->type=="1")
				<a href="{{ route('web.selected.patient') }}" class="btn btn-primary rounded mt-2 py-xl-2"><i class="fa fa-user-injured"></i></a>
				@endif
				@if(session('user')[0]->type=="2")
				<a href="{{ route('web.selected.doctor') }}" class="btn btn-primary rounded mt-2 py-xl-2"><i class="fa fa-user-md"></i></a>
				@endif
				@endif
				<a href="{{ route('logout.custom') }}" class="btn btn-danger rounded text-uppercase text-white float-md-right mt-2 py-xl-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Cerrar Sesión</a>
				<form id="logout-form" action="{{ route('logout.custom') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
			@endif
		</div>
	</div>
</nav> 