@extends('layouts.admin')

@section('title', 'Editar Médico')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
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
						<h4>Editar Médico</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('medicos.update', ['slug' => $doctor->slug]) }}" method="POST" class="form" id="formDoctorEdit" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Foto (Opcional)</label>
									<input type="file" name="photo" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/users/', $doctor->photo, true) }}" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<div class="row">
										<div class="form-group col-12">
											<label class="col-form-label">RUT<b class="text-danger">*</b></label>
											<div class="input-group">
												<input class="form-control number @error('dni') is-invalid @enderror" type="text" name="dni" required placeholder="Introduzca el RUT" minlength="2" value="{{ $doctor->dni }}">
												<div class="input-group-append">
													<span class="input-group-text">-</span>
													<input class="form-control input-group-text bg-white text-left @error('verify_digit') is-invalid @enderror" type="text" name="verify_digit" required minlength="1" maxlength="1" placeholder="Introduzca el DV" value="{{ $doctor->verify_digit }}" id="dv">
												</div>
											</div>
										</div>

										<div class="form-group col-12">
											<label class="col-form-label">Nombres<b class="text-danger">*</b></label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca los nombres" value="{{ $doctor->name }}">
										</div>
									</div> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Apellido Paterno<b class="text-danger">*</b></label>
									<input class="form-control @error('first_lastname') is-invalid @enderror" type="text" name="first_lastname" required placeholder="Introduzca el apellido paterno" value="{{ $doctor->first_lastname }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Apellido Materno<b class="text-danger">*</b></label>
									<input class="form-control @error('second_lastname') is-invalid @enderror" type="text" name="second_lastname" required placeholder="Introduzca el apellido materno" value="{{ $doctor->second_lastname }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Teléfono Fijo<b class="text-danger">*</b></label>
									<input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Introduzca un teléfono fijo" value="{{ $doctor->phone }}" id="phone">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Móvil<b class="text-danger">*</b></label>
									<input class="form-control number @error('celular') is-invalid @enderror" type="text" name="celular" required placeholder="Introduzca un teléfono móvil" value="{{ $doctor->celular }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Género<b class="text-danger">*</b></label>
									<select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
										<option value="">Seleccione</option>
										<option @if($doctor->gender=="Masculino") selected @endif>Masculino</option>
										<option @if($doctor->gender=="Femenino") selected @endif>Femenino</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">País<b class="text-danger">*</b></label>
									<select class="form-control @error('country_id') is-invalid @enderror" name="country_id" required>
										<option value="">Seleccione</option>
										@foreach($countries as $country)
										<option value="{{ $country->id }}" @if($country->id==$doctor->country_id) selected @endif>{{ $country->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Región<b class="text-danger">*</b></label>
									<select class="form-control @error('region_id') is-invalid @enderror" name="region_id" required id="selectRegions">
										<option value="">Seleccione</option>
										@foreach($regions as $region)
										<option value="{{ $region->id }}" @if($region->id==$doctor->commune->province->region_id) selected @endif>{{ $region->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Provincia<b class="text-danger">*</b></label>
									<select class="form-control @error('province_id') is-invalid @enderror" name="province_id" required id="selectProvinces">
										<option value="">Seleccione</option>
										@foreach($provinces as $province)
										<option value="{{ $province->id }}" @if($province->id==$doctor->commune->province_id) selected @endif>{{ $province->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Comuna<b class="text-danger">*</b></label>
									<select class="form-control @error('commune_id') is-invalid @enderror" name="commune_id" required id="selectCommunes">
										<option value="">Seleccione</option>
										@foreach($communes as $commune)
										<option value="{{ $commune->id }}" @if($commune->id==$doctor->commune_id) selected @endif>{{ $commune->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Codigo Postal<b class="text-danger">*</b></label>
									<input class="form-control number @error('postal') is-invalid @enderror" type="text" name="postal" required placeholder="Introduzca un codigo postal" value="{{ $doctor->postal }}">
								</div>

								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Dirección<b class="text-danger">*</b></label>
									<input class="form-control @error('address') is-invalid @enderror" type="text" name="address" required placeholder="Introduzca una dirección" value="{{ $doctor->address }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Fecha de Nacimiento<b class="text-danger">*</b></label>
									<input class="form-control date @error('birthday') is-invalid @enderror" type="text" name="birthday" required placeholder="Seleccione" value="{{ date('d-m-Y', strtotime($doctor->birthday)) }}" id="flatpickr">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Edad</label>
									<input class="form-control" type="text" disabled value="{{ age(date('Y-m-d', strtotime($doctor->birthday))) }}" id="age">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Correo Electrónico<b class="text-danger">*</b></label>
									<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Introduzca un correo electrónico" value="{{ $doctor->email }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Profesión<b class="text-danger">*</b></label>
									<select class="form-control @error('profession_id') is-invalid @enderror" name="profession_id" required>
										<option value="">Seleccione</option>
										@foreach($professions as $profession)
										<option value="{{ $profession->slug }}" @if($doctor->doctor->profession->slug==$profession->slug) selected @endif>{{ $profession->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">N° de Coleagiado Médico<b class="text-danger">*</b></label>
									<input class="form-control number @error('number_doctor') is-invalid @enderror" type="text" name="number_doctor" required placeholder="Introduzca el n° de colegiado" value="{{ $doctor->doctor->number_doctor }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">N° de Inscripción ISP<b class="text-danger">*</b></label>
									<input class="form-control number @error('inscription') is-invalid @enderror" type="text" name="inscription" required placeholder="Introduzca el n° de inscripción" value="{{ $doctor->doctor->inscription }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Firma<b class="text-danger">*</b></label>
									<input type="file" name="signature" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/doctors/', $doctor->doctor->signature) }}" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Especialidad<b class="text-danger">*</b></label>
									<select class="form-control select2 @error('specialty_id') is-invalid @enderror" name="specialty_id[]" required multiple>
										<option value="">Seleccione</option>
										{!! selectArray($specialties, $doctor->doctor->specialties) !!}
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Contraseña</label>
									<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="********" id="password">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Confirmar Contraseña</label>
									<input class="form-control" type="password" name="password_confirmation" placeholder="********">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="doctor">Actualizar</button>
										<a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/select2/custom-select2.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection