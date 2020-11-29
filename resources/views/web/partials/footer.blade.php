<div class="page-footer font-small bg-blue-light">
	<div class="row mx-0 px-4">
		<div class="col-xl-3 col-lg-3 col-12 text-center text-lg-left py-3">
			<a href="{{ route('home') }}">
				<p class="w-100 border-right border-white mb-0">
					<img src="{{ asset('/web/img/logoblanco2.png') }}" width="200" alt="Logo">
				</p>
			</a>
			<div class="d-flex d-lg-none justify-content-center">
				@if(!is_null($setting->instagram) && !empty($setting->instagram))
				<a href="{{ $setting->instagram }}" class="mr-2">
					<img src="{{ asset('/web/img/instagram.png') }}" height="35" width="35" alt="Instagram">
				</a>
				@endif
				@if(!is_null($setting->facebook) && !empty($setting->facebook))
				<a href="{{ $setting->facebook }}">
					<img src="{{ asset('/web/img/facebook.png') }}" height="35" width="35" alt="Facebook">
				</a>
				@endif
			</div>
		</div>

		<div class="col-xl-6 col-lg-5 col-12 d-flex flex-column flex-lg-row text-center text-lg-left align-items-center py-0 py-lg-3 mb-3 mb-lg-0">
			<a href="{{ route('services', ['slug' => 'consulta-virtual']) }}"><p class="text-white lh-20 mb-0 mr-lg-4 mr-xl-5">Consulta Virtual</p></a>
			<a href="{{ route('services', ['slug' => 'medicos-a-domicilio']) }}"><p class="text-white lh-20 mb-0 mr-lg-4 mr-xl-5">Médico a Domicilio</p></a>
			<a href="{{ route('services', ['slug' => 'examenes-a-domicilio']) }}"><p class="text-white lh-20 mb-0">Exámenes a Domicilio</p></a>
		</div>

		<a href="{{ route('ingresar') }}" class="col-xl-2 col-lg-2 col-12 btn-orange d-flex py-2 py-lg-3 mb-3 mb-lg-0">
			<div class="d-flex align-items-center mx-auto">
				<p class="text-center text-white text-uppercase font-weight-bold lh-20 mb-0">Ingreso Médicos</p>
			</div>
		</a>

		<div class="col-xl-1 col-lg-2 col-12 d-none d-lg-block py-3">
			<div class="d-flex justify-content-end">
				@if(!is_null($setting->instagram) && !empty($setting->instagram))
				<a href="{{ $setting->instagram }}" class="mr-2">
					<img src="{{ asset('/web/img/instagram.png') }}" height="30" width="30" alt="Instagram">
				</a>
				@endif
				@if(!is_null($setting->facebook) && !empty($setting->facebook))
				<a href="{{ $setting->facebook }}">
					<img src="{{ asset('/web/img/facebook.png') }}" height="30" width="30" alt="Facebook">
				</a>
				@endif
			</div>
		</div>
	</div>
</div>

<footer class="page-footer font-small bg-blue-dark py-2">
	<div class="row mx-0">
		<div class="col-12">
			<p class="text-center text-white mb-0">Doctoonline.cl 2020. Todos los derechos reservados.</p>
		</div>
	</div>
</footer>