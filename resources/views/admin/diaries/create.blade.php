@extends('layouts.admin')

@section('title', 'Crear Reserva')

@section('links')
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Crear Reserva</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('reservas.store') }}" method="POST" class="form" id="formDiaryCreate">
							@csrf
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">RUT<b class="text-danger">*</b></label>
									<div class="input-group">
										<input class="form-control number @error('dni') is-invalid @enderror" type="text" name="dni" required placeholder="Introduzca el RUT" minlength="2" value="{{ old('dni') }}" id="valid-dni">
										<div class="input-group-append">
											<span class="input-group-text">-</span>
											<input class="form-control input-group-text bg-white text-left @error('verify_digit') is-invalid @enderror" type="text" name="verify_digit" required minlength="1" maxlength="1" placeholder="Introduzca el DV" value="{{ old('verify_digit') }}" id="valid-dv">
										</div>
									</div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
									<input class="form-control exist-name @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca el nombre" value="{{ old('name') }}"> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Apellido<b class="text-danger">*</b></label>
									<input class="form-control exist-lastname @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Introduzca el apellido" value="{{ old('lastname') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Correo Electrónico<b class="text-danger">*</b></label>
									<input class="form-control exist-email @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Introduzca un correo electrónico" value="{{ old('email') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Género<b class="text-danger">*</b></label>
									<select class="form-control exist-gender @error('gender') is-invalid @enderror" name="gender" required>
										<option value="">Seleccione</option>
										<option @if(old('gender')=="Masculino") selected @endif>Masculino</option>
										<option @if(old('gender')=="Femenino") selected @endif>Femenino</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Fecha de Nacimiento<b class="text-danger">*</b></label>
									<input class="form-control exist-birthday date @error('birthday') is-invalid @enderror" type="text" name="birthday" required placeholder="Seleccione" value="{{ old('birthday') }}" id="flatpickr">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Teléfono<b class="text-danger">*</b></label>
									<input class="form-control exist-phone @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Introduzca un teléfono" value="{{ old('phone') }}" id="phone">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Servicio<b class="text-danger">*</b></label>
									<select class="form-control @error('service_id') is-invalid @enderror" name="service_id" required id="selectServiceDiary">
										<option value="">Seleccione</option>
										@foreach($services as $service)
										<option value="{{ $service->slug }}" @if($service->slug==old('service_id')) selected @endif type="{{ $service->type }}">{{ $service->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="col-12 d-none" id="serviceTypeDoctor">
									<div class="row">
										<div class="form-group col-lg-6 col-md-6 col-12">
											<label class="col-form-label">Especialidad<b class="text-danger">*</b></label>
											<select class="form-control @error('specialty_id') is-invalid @enderror" name="specialty_id" required id="selectSpecialties">
												<option value="">Seleccione</option>
												@foreach($specialties as $specialty)
												<option value="{{ $specialty->slug }}">{{ $specialty->name }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group col-lg-6 col-md-6 col-12">
											<label class="col-form-label">Médico Especialista<b class="text-danger">*</b></label>
											<select class="form-control @error('doctor_id') is-invalid @enderror" name="doctor_id" required id="selectDoctors">
												<option value="">Seleccione</option>
											</select>
										</div>
									</div>
								</div>

								<div class="col-12 d-none" id="serviceTypeExam">
									<div class="row">
										<div class="form-group col-lg-6 col-md-6 col-12">
											<label class="col-form-label">Categoría<b class="text-danger">*</b></label>
											<select class="form-control @error('category_id') is-invalid @enderror" name="category_id" required id="selectCategoriesDiaries">
												<option value="">Seleccione</option>
												@foreach($categories as $category)
												<option value="{{ $category->slug }}" @if($category->slug==old('category_id')) selected @endif>{{ $category->name }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group col-lg-6 col-md-6 col-12">
											<label class="col-form-label">Subcategoría<b class="text-danger">*</b></label>
											<select class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" required id="selectSubcategoriesDiaries">
												<option value="">Seleccione</option>
											</select>
										</div>
									</div>
								</div>

								<div class="col-12 d-none" id="diaryDateTime">
									<div class="row">
										<div class="form-group col-lg-6 col-md-6 col-12">
											<label class="col-form-label">Fecha<b class="text-danger">*</b></label>
											<input class="form-control date @error('date') is-invalid @enderror" type="text" name="date" required placeholder="Seleccione" id="selectDateDiary">
										</div>

										<div class="form-group col-lg-6 col-md-6 col-12">
											<label class="col-form-label">Hora<b class="text-danger">*</b></label>
											<select class="form-control @error('time') is-invalid @enderror" name="time" required id="selectTimeDiary">
												<option value="">Seleccione</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="diary">Guardar</button>
										<a href="{{ route('reservas.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection