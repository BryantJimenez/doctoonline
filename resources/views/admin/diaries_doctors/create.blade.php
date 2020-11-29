@extends('layouts.admin')

@section('title', 'Crear Médico de Agenda')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Crear Médico de Agenda</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('medicos.agenda.store') }}" method="POST" class="form" id="formDiaryDoctor">
							@csrf
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Médico<b class="text-danger">*</b></label>
									<select class="form-control @error('doctor_id') is-invalid @enderror" name="doctor_id" required>
										<option value="">Seleccione</option>
										@foreach($doctors as $doctor)
										@if(is_null($doctor->diary_doctor))
										<option @if($doctor->people->slug==old('doctor_id')) selected @endif value="{{ $doctor->people->slug }}">{{ $doctor->people->name." ".$doctor->people->first_lastname." ".$doctor->people->second_lastname }}</option>
										@endif
										@endforeach
									</select>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Descripción<b class="text-danger">*</b></label>
									<textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Introduzca una descripción" id="content-description" rows="6">{{ old('description') }}</textarea>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Calificación<b class="text-danger">*</b></label>
									<select class="form-control @error('rating') is-invalid @enderror" name="rating" required>
										<option value="">Seleccione</option>
										<option @if(old('rating')==1) selected @endif value="1">1 Estrella</option>
										<option @if(old('rating')==2) selected @endif value="2">2 Estrellas</option>
										<option @if(old('rating')==3) selected @endif value="3">3 Estrellas</option>
										<option @if(old('rating')==4) selected @endif value="4">4 Estrellas</option>
										<option @if(old('rating')==5) selected @endif value="5">5 Estrellas</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Servicios<b class="text-danger">*</b></label>
									<select class="form-control select2 @error('service_id') is-invalid @enderror" name="service_id[]" required multiple id="selectServiceDoctor">
										@foreach($services as $service)
										<option value="{{ $service->slug }}">{{ $service->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-12" id="doctorUrl">
									<label class="col-form-label">Url<b class="d-none text-danger">*</b></label>
									<input class="form-control @error('url') is-invalid @enderror" name="url" placeholder="Introduzca una url" value="{{ old('url') }}">
								</div>

								<div class="col-12" id="serviceSchedule">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="doctor">Guardar</button>
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
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection