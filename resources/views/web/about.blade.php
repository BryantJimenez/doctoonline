@extends('layouts.web')

@section('title', 'Quienes Somos')

@section('content')

<section class="ftco-section py-0" id="banner-about">
	<div class="row mx-0">
		<div class="col-12 px-0">
			<img src="{{ image_exist('/admins/img/aboutus/', $setting->banner) }}" class="w-100" alt="Banner de quienes somos">
		</div>
	</div>
</section>

<section class="ftco-section mt-4 py-0">
	<div class="row mx-0 px-lg-5">
		<div class="col-xl-6 col-lg-6 col-md-6 col-12">
			<p class="h4 font-weight-bold text-blue mb-4"><img src="{{ asset('/web/img/cruz.png') }}" class="mr-1" height="25" width="25"> Quienes Somos:</p>
			<div class="text-about text-muted mb-2">
				{!! $setting->about !!}
			</div>

			<img src="{{ asset('/web/img/logo.png') }}" class="float-right mr-lg-5 mb-2" width="210" height="47" alt="Logo">
		</div>

		<div class="col-xl-6 col-lg-6 col-md-6 col-12">
			<div class="row">
				<div class="col-12 mb-2">
					<div class="card border-0 bg-blue-dark">
						<div class="card-body">
							<p class="h4 text-white text-uppercase text-center">Misión:</p>
							<div class="text-about text-white">
								{!! $setting->mission !!}
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 mb-2">
					<div class="card border-0 bg-blue-dark">
						<div class="card-body py-2 px-3">
							<p class="h4 text-white text-uppercase text-center">Visión:</p>
							<div class="text-about text-white">
								{!! $setting->vision !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection