@extends('layouts.admin')

@section('title', 'Reserva')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos del Paciente</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Nombre Completo:</b> {{ $diary->name." ".$diary->lastname }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>RUT:</b> {{ number_format($diary->dni, 0, ".", ".")."-".$diary->verify_digit }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Género:</b> {{ $diary->gender }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Teléfono:</b> {{ $diary->phone }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Email:</b> {{ $diary->email }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Fecha de Nacimiento:</b> {{ date("d-m-Y", strtotime($diary->birthday)) }}</span>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos de la Reserva</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Servicio:</b> {{ $diary->diary_service->service->name }}</span>
							</li>
							@if($diary->diary_service->service->type==1)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Especialidad:</b> {{ $diary->diary_service->doctor_service->specialty->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Médico:</b> {{ $diary->diary_service->doctor_service->people->name." ".$diary->diary_service->doctor_service->people->first_lastname." ".$diary->diary_service->doctor_service->people->second_lastname }}</span>
							</li>
							@endif
							@if($diary->diary_service->service->type==2)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Examen:</b> {{ $diary->diary_service->exam_service->subcategory_diary->category->name." | ".$diary->diary_service->exam_service->subcategory_diary->name }}</span>
							</li>
							@endif
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Precio:</b> ${{ number_format($diary->amount, 2, ",", ".") }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Fecha y Hora:</b> {{ date("d-m-Y H:i A", strtotime($diary->date." ".$diary->time)) }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Estado:</b> {!! stateDiary($diary->state) !!}</span>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	@if(!is_null($diary->payment))
	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos del Pago</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Metodo:</b> {{ $diary->payment->method }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Motivo:</b> {{ $diary->payment->subject }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Precio:</b> ${{ number_format($diary->payment->amount, 0, ".", ".") }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cuota:</b> -${{ number_format($diary->payment->fee, 0, ".", ".") }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Impuestos:</b> -${{ number_format($diary->payment->taxes, 0, ".", ".") }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Saldo:</b> ${{ number_format($diary->payment->balance, 0, ".", ".") }}</span>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>
	@endif

	<div class="col-12 layout-top-spacing">
		<a href="{{ route('reservas.index') }}" class="btn btn-secondary">Volver</a>
	</div>
</div>

@endsection