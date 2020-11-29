@extends('layouts.web')

@section('title', 'Pago Exitoso')

@section('content')

<section class="ftco-section py-0" id="banner-about">
	<div class="row mx-0">
		<div class="col-12 px-0">
			<img src="{{ image_exist('/web/img/', 'imagen-agenda.png') }}" class="w-100" alt="Banner de agenda">
		</div>
	</div>
</section>

<section class="ftco-section bg-light shadow py-0">
	<div class="container">
		<div class="row">
			<div class="col-12 d-lg-flex pt-4">
				<p class="h5 text-primary font-weight-bold text-phase mr-4">En Simples Pasos:</p>
				<div class="d-lg-inline-flex diary-phases">
					<div class="active">
						<p class="text-white bg-green font-weight-bold pl-4 pr-5 ml-4 mb-4 mb-xl-0">Identifición</p>
					</div>
					<div class="active">
						<p class="text-white bg-green font-weight-bold pl-4 pr-5 ml-4 mb-4 mb-xl-0">Área y Profesional</p>
					</div>
					<div class="active">
						<p class="text-white bg-green font-weight-bold pl-4 pr-5 ml-4 mb-4 mb-xl-0">Fecha y Hora</p>
					</div>
					<div class="active">
						<p class="text-white bg-green font-weight-bold pl-4 pr-5 ml-4 mb-4 mb-xl-0">Pago y Confirmación</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section py-0" id="diary-form">
	<div class="row mx-0">
		<div class="col-12 mt-1 mb-5">
			<div class="card bg-light shadow mx-xl-5 px-lg-5">
				<div class="card-body">
					<div class="row">
						<div class="col-12 text-center mb-xl-5">
							<img src="{{ image_exist('/web/img/', 'listo.png') }}" width="150" class="mb-xl-4 mt-3" alt="Listo">
							<p class="h3 text-green font-weight-bold">Listo! su Pago fue realizado de manera exitosa, ya se registro su agenda para el día {{ date("d-m-Y", strtotime($diary->date)) }} a las {{ date("H:i A", strtotime($diary->time)) }} una cita del servicio {{ $diary->diary_service->service->name }}</p>
							<p class="h5 px-lg-5 px-xl-0">* Cualquier cambio de horario, día o cancelación debe comunicarse con nosotros a nuestros teléfonos: <span class="h4 text-green font-weight-bold">{{ $setting->phone }} <i class="fa fa-2x fa-whatsapp"></i></span></p>
						</div>

						<div class="form-group text-right col-12">
							<a href="{{ route('home') }}" class="btn btn-lg btn-orange-dark text-white font-weight-bold rounded px-5 py-2">Continuar <i class="fa fa-angle-right ml-3 pt-1"></i></a>
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection