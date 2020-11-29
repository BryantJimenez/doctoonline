@extends('layouts.admin')

@section('title', 'Editar Médico de Agenda')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/select2/select2.min.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Editar Médico de Agenda</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('medicos.agenda.update', ['slug' => $doctor->slug]) }}" method="POST" class="form" id="formDiaryDoctor">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Descripción<b class="text-danger">*</b></label>
									<textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Introduzca una descripción" id="content-description" rows="6">{{ $doctor->doctor->diary_doctor->description }}</textarea>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Calificación<b class="text-danger">*</b></label>
									<select class="form-control @error('rating') is-invalid @enderror" name="rating" required>
										<option value="">Seleccione</option>
										<option @if($doctor->doctor->diary_doctor->rating==1) selected @endif value="1">1 Estrella</option>
										<option @if($doctor->doctor->diary_doctor->rating==2) selected @endif value="2">2 Estrellas</option>
										<option @if($doctor->doctor->diary_doctor->rating==3) selected @endif value="3">3 Estrellas</option>
										<option @if($doctor->doctor->diary_doctor->rating==4) selected @endif value="4">4 Estrellas</option>
										<option @if($doctor->doctor->diary_doctor->rating==5) selected @endif value="5">5 Estrellas</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Servicios<b class="text-danger">*</b></label>
									<select class="form-control select2 @error('service_id') is-invalid @enderror" name="service_id[]" required multiple id="selectServiceDoctor">
										{!! selectServices($services, $doctor->doctor->diary_doctor->schedules) !!}
									</select>
								</div>

								<div class="form-group col-12" id="doctorUrl">
									<label class="col-form-label">Url<b class="{{ urlDoctorService($doctor->doctor->diary_doctor->schedules, 1) }} text-danger">*</b></label>
									<input class="form-control @error('url') is-invalid @enderror" name="url" {{ urlDoctorService($doctor->doctor->diary_doctor->schedules, 2) }} placeholder="Introduzca una url" value="{{ $doctor->doctor->diary_doctor->url }}">
								</div>

								<div class="col-12" id="serviceSchedule">
									@foreach($doctor->doctor->diary_doctor->schedules->unique('service_id') as $schedule)
									<div class="row" id="{{ $schedule->service->slug }}">
										<div class="col-12">
											<p class="font-weight-bold">{{ $schedule->service->name }}
												<button type="button" class="btn btn-sm btn-primary diary-add-day px-2 py-1 ml-2" service="{{ $schedule->service->slug }}"><i class="fa fa-plus"></i></button>
												<button type="button" class="btn btn-sm btn-danger diary-remove-day @if(count($doctor->doctor->diary_doctor->schedules->where('service_id', $schedule->service->id))==1) d-none @endif px-2 py-1 ml-2" service="{{ $schedule->service->slug }}"><i class="fa fa-minus"></i></button>
											</p>
										</div>

										<div class="col-12" service="{{ $schedule->service->slug }}">
											@foreach($doctor->doctor->diary_doctor->schedules->where('service_id', $schedule->service->id) as $schedule)
											<div class="row" schedule="{{ $num }}">
												<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
													<label class="col-form-label">Día<b class="text-danger">*</b></label>
													<select class="form-control" name="day[]" required>
														<option @if($schedule->day==1) selected @endif value="1">{{ day(1) }}</option>
														<option @if($schedule->day==2) selected @endif value="2">{{ day(2) }}</option>
														<option @if($schedule->day==3) selected @endif value="3">{{ day(3) }}</option>
														<option @if($schedule->day==4) selected @endif value="4">{{ day(4) }}</option>
														<option @if($schedule->day==5) selected @endif value="5">{{ day(5) }}</option>
														<option @if($schedule->day==6) selected @endif value="6">{{ day(6) }}</option>
														<option @if($schedule->day==0) selected @endif value="0">{{ day(0) }}</option>
													</select>
												</div>
												<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
													<label class="col-form-label">Hora de Inicio<b class="text-danger">*</b></label>
													<input class="form-control @error('start') is-invalid @enderror" type="text" required name="start[]" placeholder="Seleccione" id="{{ $schedule->service->slug }}StartFlatpickr{{ $num }}" value="{{ date('H:i', strtotime($schedule->start)) }}">
												</div>
												<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
													<label class="col-form-label">Hora Final<b class="text-danger">*</b></label>
													<input class="form-control @error('end') is-invalid @enderror" type="text" name="end[]" placeholder="Seleccione" id="{{ $schedule->service->slug }}EndFlatpickr{{ $num }}" value="{{ date('H:i', strtotime($schedule->end)) }}">
												</div>
												<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
													<label class="col-form-label">Precio<b class="text-danger">*</b></label>
													<input class="form-control decimal @error('price') is-invalid @enderror" type="text" name="price[]" required placeholder="Introduzca un precio" value="{{ number_format($schedule->price, 2, '.', '') }}">
												</div>
												<input class="form-control" type="hidden" name="service[]" value="{{ $schedule->service->slug }}">
											</div>
											@php $num++ @endphp
											@endforeach
										</div>
									</div>
									@php $num=0 @endphp
									@endforeach
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="doctor">Actualizar</button>
										<a href="{{ route('medicos.agenda.index') }}" class="btn btn-secondary">Volver</a>
									</div>
								</div> 
							</div>
						</form>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/select2/custom-select2.js') }}"></script>
<script src="{{ asset('/admins/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection