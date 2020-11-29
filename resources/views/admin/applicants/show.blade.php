@extends('layouts.admin')

@section('title', 'Bolsa de Trabajo')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
	<div class="col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos de la Solicitud</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Nombre:</b> {{ $applicant->name }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Email:</b> {{ $applicant->email }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Mensaje:</b> {{ $applicant->message }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Archivo:</b> <a href="{{ asset('/admins/img/applicants/'.$applicant->file) }}" target="_blank">{{ $applicant->file }}</a></span>
							</li>
						</ul>
					</div> 

					<div class="form-group col-12">
						<div class="btn-group" role="group">
							<a href="{{ route('solicitudes.index') }}" class="btn btn-secondary">Volver</a>
						</div>
					</div>                                 
				</div>
			</div>
		</div>
	</div>
</div>

@endsection