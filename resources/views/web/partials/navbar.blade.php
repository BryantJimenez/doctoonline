<section class="ftco-section d-none d-lg-block d-xl-block py-0">
	<div class="row py-4 mx-0 border-bottom-3">
		<div class="col-12 d-flex justify-content-between">
			<a href="{{ route('home') }}"><img src="{{ asset('/web/img/logo.png') }}" width="210" height="47" alt="Logo"></a>
			<div class="w-400 d-flex">
				<a href="https://api.whatsapp.com/send?phone={{ Str::slug($setting->phone, "") }}&text=Hola, dame tu nombre, teléfono y te contactaremos" target="_blank" class="w-50 d-flex justify-content-end">
					<img src="{{ asset('/web/img/whatsapp.png') }}" width="45" height="45" alt="Icono Whatsapp">
					<p class="text-muted lh-18 mb-0 pt-2 pl-3">
						<b>{{ $setting->phone }}</b>
						<br>
						<span class="small">{{ $setting->email }}</span>
					</p>
				</a>
				<a href="{{ route('ingresar') }}" class="w-50 d-flex justify-content-end">
					<img src="{{ asset('/web/img/usuario.png') }}" width="45" height="45" alt="Icono Usuario">
					<p class="text-muted lh-18 mb-0 pt-2 pl-3">
						<b>Tu Cuenta</b>
						<br>
						<span class="small">Acceso Clientes</span>
					</p>
				</a>
			</div>
		</div>
	</div>
</section>

<nav class="navbar sticky-top navbar-light navbar-expand-lg bg-white py-2 py-lg-0" id="navbar">
	<a href="javascript:void(0);"><img src="{{ asset('/web/img/logo.png') }}" class="d-block d-lg-none d-xl-none" width="210" height="47" alt="Logo"></a>
	<button class="navbar-toggler d-block d-lg-none d-xl-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link {{ active('/') }} font-weight-bold mr-0 mr-lg-2 mr-xl-4" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ active('quienes-somos') }} font-weight-bold mx-0 mx-lg-2 mx-xl-4" href="{{ route('about') }}">Quienes Somos</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link font-weight-bold dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Servicios
				</a>
				<div class="dropdown-menu services-dropdown bg-blue-extralight rounded-0" aria-labelledby="navbarDropdown">
					<div class="col-12">
						<div class="row">
							@foreach($services as $service)
							<div class="col-lg-12 col-md-6 col-sm-6 col-12 mb-2">
								<a href="{{ route('services', ['slug' => $service->slug]) }}" class="row">
									<div class="col-5">
										<img src="{{ image_exist('/admins/img/services/', $service->image) }}" class="w-100" alt="{{ $service->name }}">
									</div>
									<div class="col-7">
										<p class="text-blue-dark text-uppercase font-weight-bold mt-lg-4">{{ $service->name }}</p>
									</div>
								</a>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</li>
			<li class="nav-item d-block d-lg-none">
				<a class="nav-link {{ active('agendar') }} font-weight-bold ml-0 ml-lg-2 ml-xl-4" href="{{ route('diary') }}">Agenda tu Hora</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ active('noticias/novedades') }} font-weight-bold mx-0 mx-lg-2 mx-xl-4" href="{{ route('news', ['category' => 'novedades']) }}">Novedades</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ active('noticias/convenios') }} font-weight-bold mx-0 mx-lg-2 mx-xl-4" href="{{ route('news', ['category' => 'convenios']) }}">Convenios</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ active('trabaja-con-nosotros') }} font-weight-bold ml-0 ml-lg-2 ml-xl-4" href="{{ route('applicant') }}">Trabaja con Nosotros</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ active('contacto') }} font-weight-bold ml-0 ml-lg-2 ml-xl-4" href="{{ route('contact') }}">Contacto</a>
			</li>
		</ul>
		<div class="form-inline d-none d-lg-block">
			<a href="{{ route('diary') }}" class="text-white text-uppercase btn-orange font-weight-bold py-0-8 px-diary-button">Agenda tu Hora</a>
		</div>
	</div>
</nav>