@extends('layouts.web-admin')

@section('title', 'Seleccionar Usuario')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('content')

<img src="{{ asset('/web/img/doctora.png') }}" class="doctor-img" alt="Doctora">

<section class="ftco-section py-0">
	<div class="container bg-white minh-475 py-1">
		<div class="row pt-3">
			<div class="col-12 mb-3">
				<p class="h5 text-center">Seleccione el tipo de usuario con el que desea continuar en el sistema</p>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
				<div class="card">
					<div class="card-body text-center">
						<p class="h2 text-primary"><i class="fa fa-2x fa-user-md"></i></p>
						<p class="h3 text-uppercase">Médico</p>
						<a href="{{ route('web.selected.doctor') }}" class="btn btn-primary text-uppercase rounded">Elegir</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
				<div class="card">
					<div class="card-body text-center">
						<p class="h2 text-primary"><i class="fa fa-2x fa-user-injured"></i></p>
						<p class="h3 text-uppercase">Paciente</p>
						<a href="{{ route('web.selected.patient') }}" class="btn btn-primary text-uppercase rounded">Elegir</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

@endsection