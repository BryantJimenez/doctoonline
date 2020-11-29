@extends('layouts.web')

@section('title', $service->name)

@section('content')

<section class="ftco-section py-0" id="banner-about">
	<div class="row mx-0">
		<div class="col-12 px-0">
			<img src="{{ image_exist('/admins/img/services/', $service->banner) }}" class="w-100" alt="{{ 'Banner de '.$service->name }}">
		</div>
	</div>
</section>

<section class="ftco-section mt-4 py-0">
	<div class="row mx-0 px-lg-5">
		<div class="col-xl-6 col-lg-6 col-md-6 col-12">
			<p class="h4 font-weight-bold text-blue mb-4"><img src="{{ asset('/web/img/cruz.png') }}" class="mr-1" height="25" width="25"> {{ $service->title }}</p>
			<div class="text-about text-muted mb-2">
				{!! $service->description !!}
			</div>

			<img src="{{ asset('/web/img/logo.png') }}" class="float-right mr-lg-5 mb-2" width="210" height="47" alt="Logo">
		</div>

		<div class="col-xl-6 col-lg-6 col-md-6 col-12">
			<div class="row">
				<div class="col-12 mb-2">
					<div class="card border-0 bg-blue-dark">
						<div class="card-body">
							<p class="h4 text-white text-center">{{ $service->diary_title }}</p>
							<div class="text-about text-white">
								{!! $service->diary_description !!}
								<a href="{{ route('ingresar') }}" class="btn btn-lg btn-white text-dark text-uppercase font-weight-bold rounded w-100 mt-3">Ingresa Aquí</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 mb-2">
					<div class="card border-0 bg-blue-dark">
						<div class="card-body py-2 px-3">
							<p class="h4 text-white text-center">{{ $service->app_title }}</p>
							<div class="text-about text-white">
								{!! $service->app_description !!}
								<div class="row mt-3">
									<div class="col-lg-6 col-12 mb-2">
										<img src="{{ asset('/web/img/android.png') }}" class="w-100">
									</div>
									<div class="col-lg-6 col-12 mb-2">
										<p class="text-center">(Proximamente Habilitada)</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection