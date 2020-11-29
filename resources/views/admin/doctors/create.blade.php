@extends('layouts.admin')

@section('title', 'Crear Médicos')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing @if(!is_null(old('dni'))) d-none @endif" id="layout-search">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Buscar Médico</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">
				<div class="row">
					<div class="col-12">
						<p class="text-muted">Ingrese el RUT y el dígito verificador para buscarlo.</p>
						<div class="row">
							<div class="form-group col-xl-10 col-lg-9 col-md-9 col-12">
								<div class="input-group">
									<input class="form-control number" type="text" minlength="1" maxlength="11" placeholder="Introduzca el RUT" value="{{ old('dni') }}" id="search-rut">
									<div class="input-group-append">
										<span class="input-group-text">-</span>
										<input class="form-control input-group-text bg-white text-left" type="text" name="verify_digit" minlength="1" maxlength="1" placeholder="Introduzca el DV" value="{{ old('verify_digit') }}" id="search-dv">
									</div>
								</div>
								<p class="text-danger font-weight-bold" id="rutErrors"></p>
							</div>
							<div class="form-group col-xl-2 col-lg-3 col-md-3 col-12">
								<button class="btn btn-primary w-100 pt-2 pb-3" type="doctor" id="btn-search-rut">Buscar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 layout-spacing @if(!is_null(old('slug')) || is_null(old('dni'))) d-none @endif" id="layout-new-user">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Crear Médicos</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('medicos.store') }}" method="POST" class="form" id="formDoctor" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Foto (Opcional)</label>
									<input type="file" name="photo" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<div class="row">
										<div class="form-group col-12">
											<label class="col-form-label">RUT<b class="text-danger">*</b></label>
											<div class="input-group">
												<input class="form-control number @error('dni') is-invalid @enderror" type="text" name="dni" readonly required placeholder="Introduzca el RUT" minlength="2" value="{{ old('dni') }}">
												<div class="input-group-append">
													<span class="input-group-text">-</span>
													<input class="form-control input-group-text bg-white text-left @error('verify_digit') is-invalid @enderror" type="text" name="verify_digit" readonly required minlength="1" maxlength="1" placeholder="Introduzca el DV" value="{{ old('verify_digit') }}" id="dv">
												</div>
											</div>
										</div>

										<div class="form-group col-12">
											<label class="col-form-label">Nombres<b class="text-danger">*</b></label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca los nombres" value="{{ old('name') }}">
										</div>
									</div> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Apellido Paterno<b class="text-danger">*</b></label>
									<input class="form-control @error('first_lastname') is-invalid @enderror" type="text" name="first_lastname" required placeholder="Introduzca el apellido paterno" value="{{ old('first_lastname') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Apellido Materno<b class="text-danger">*</b></label>
									<input class="form-control @error('second_lastname') is-invalid @enderror" type="text" name="second_lastname" required placeholder="Introduzca el apellido materno" value="{{ old('second_lastname') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Teléfono Fijo<b class="text-danger">*</b></label>
									<input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Introduzca un teléfono fijo" value="{{ old('phone') }}" id="phone">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Móvil<b class="text-danger">*</b></label>
									<input class="form-control number @error('celular') is-invalid @enderror" type="text" name="celular" required placeholder="Introduzca un teléfono móvil" value="{{ old('celular') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Género<b class="text-danger">*</b></label>
									<select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
										<option value="">Seleccione</option>
										<option @if(old('gender')=="Masculino") selected @endif>Masculino</option>
										<option @if(old('gender')=="Femenino") selected @endif>Femenino</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">País<b class="text-danger">*</b></label>
									<select class="form-control @error('country_id') is-invalid @enderror" name="country_id" required>
										<option value="">Seleccione</option>
										@foreach($countries as $country)
										<option value="{{ $country->id }}" @if($country->id==old('country_id')) selected @endif>{{ $country->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Región<b class="text-danger">*</b></label>
									<select class="form-control @error('region_id') is-invalid @enderror" name="region_id" required id="selectRegions">
										<option value="">Seleccione</option>
										@foreach($regions as $region)
										<option value="{{ $region->id }}" @if($region->id==old('region_id')) selected @endif>{{ $region->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Provincia<b class="text-danger">*</b></label>
									<select class="form-control @error('province_id') is-invalid @enderror" name="province_id" @if(empty(old('region_id'))) disabled @endif required id="selectProvinces">
										<option value="">Seleccione</option>
										@if(!empty(old('region_id')))
										{!! selectProvince(old('province_id'), old('region_id')) !!}
										@endif
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Comuna<b class="text-danger">*</b></label>
									<select class="form-control @error('commune_id') is-invalid @enderror" name="commune_id" @if(empty(old('commune_id'))) disabled @endif required id="selectCommunes">
										<option value="">Seleccione</option>
										@if(!empty(old('province_id')))
										{!! selectCommune(old('commune_id'), old('province_id')) !!}
										@endif
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Codigo Postal<b class="text-danger">*</b></label>
									<input class="form-control number @error('postal') is-invalid @enderror" type="text" name="postal" required placeholder="Introduzca un codigo postal" value="{{ old('postal') }}">
								</div>

								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Dirección<b class="text-danger">*</b></label>
									<input class="form-control @error('address') is-invalid @enderror" type="text" name="address" required placeholder="Introduzca una dirección" value="{{ old('address') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Fecha de Nacimiento<b class="text-danger">*</b></label>
									<input class="form-control date @error('birthday') is-invalid @enderror" type="text" name="birthday" required placeholder="Seleccione" value="{{ old('birthday') }}" id="flatpickr">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Edad</label>
									<input class="form-control" type="text" disabled value="@if(!empty(old('birthday'))){{ age(date('Y-m-d', strtotime(old('birthday')))) }}@endif" id="age">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Correo Electrónico<b class="text-danger">*</b></label>
									<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Introduzca un correo electrónico" value="{{ old('email') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Profesión<b class="text-danger">*</b></label>
									<select class="form-control @error('profession_id') is-invalid @enderror" name="profession_id" required>
										<option value="">Seleccione</option>
										@foreach($professions as $profession)
										<option value="{{ $profession->slug }}" @if(old('profession')==$profession->slug) selected @endif>{{ $profession->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">N° de Coleagiado Médico<b class="text-danger">*</b></label>
									<input class="form-control number @error('number_doctor') is-invalid @enderror" type="text" name="number_doctor" required placeholder="Introduzca el n° de colegiado" value="{{ old('number_doctor') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">N° de Inscripción ISP<b class="text-danger">*</b></label>
									<input class="form-control number @error('inscription') is-invalid @enderror" type="text" name="inscription" required placeholder="Introduzca el n° de inscripción" value="{{ old('inscription') }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Firma<b class="text-danger">*</b></label>
									<input type="file" name="signature" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Especialidad<b class="text-danger">*</b></label>
									<select class="form-control select2 @error('specialty_id') is-invalid @enderror" name="specialty_id[]" required multiple>
										<option value="">Seleccione</option>
										@foreach($specialties as $specialty)
										<option value="{{ $specialty->slug }}">{{ $specialty->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Contraseña<b class="text-danger">*</b></label>
									<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required placeholder="********" id="password">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Confirmar Contraseña<b class="text-danger">*</b></label>
									<input class="form-control" type="password" name="password_confirmation" required placeholder="********">
								</div>
								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="doctor">Guardar</button>
										<a href="{{ route('medicos.index') }}" class="btn btn-secondary">Volver</a>
									</div>
								</div> 
							</div>
						</form>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

	<div class="col-12 layout-spacing @if(is_null(old('slug')) && is_null(old('dni'))) d-none @endif" id="layout-old-user">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Crear Médicos</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('medicos.store') }}" method="POST" class="form" id="formDoctorOld" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<input type="hidden" name="dni" value="{{ old('dni') }}" id="rut-hidden">
								<input type="hidden" name="verify_digit" value="{{ old('verify_digit') }}" id="dv-hidden">
								<input type="hidden" name="slug" value="{{ old('slug') }}" id="slug-hidden">

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">RUT</label>
									<input class="form-control" type="text" readonly name="exist-rut" value="{{ old('exist-rut') }}" id="exist-rut">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Nombre Completo</label>
									<input class="form-control" type="text" readonly name="exist-name" value="{{ old('exist-name') }}" id="exist-name">
								</div>							

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Teléfono Fijo</label>
									<input class="form-control" type="text" readonly name="exist-phone" value="{{ old('exist-phone') }}" id="exist-phone">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Móvil</label>
									<input class="form-control" type="text" readonly name="exist-celular" value="{{ old('exist-celular') }}" id="exist-celular">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Género</label>
									<input class="form-control" type="text" readonly name="exist-gender" value="{{ old('exist-gender') }}" id="exist-gender">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Codigo Postal</label>
									<input class="form-control" type="text" readonly name="exist-postal" value="{{ old('exist-postal') }}" id="exist-postal">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">País / Región / Provincia / Comuna</label>
									<input class="form-control" type="text" readonly name="exist-address-place" value="{{ old('exist-address-place') }}" id="exist-address-place">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Dirección</label>
									<input class="form-control" type="text" readonly name="exist-address" value="{{ old('exist-address') }}" id="exist-address">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Fecha de Nacimiento</label>
									<input class="form-control" type="text" readonly name="exist-birthday" value="{{ old('exist-birthday') }}" id="exist-birthday">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Edad</label>
									<input class="form-control" type="text" readonly name="exist-age" value="{{ old('exist-age') }}" id="exist-age">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Correo Electrónico</label>
									<input class="form-control" type="text" readonly name="exist-email" value="{{ old('exist-email') }}" id="exist-email">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Profesión<b class="text-danger">*</b></label>
									<select class="form-control @error('profession_id') is-invalid @enderror" name="profession_id" required>
										<option value="">Seleccione</option>
										@foreach($professions as $profession)
										<option value="{{ $profession->slug }}" @if(old('profession')==$profession->slug) selected @endif>{{ $profession->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">N° de Coleagiado Médico<b class="text-danger">*</b></label>
									<input class="form-control number @error('number_doctor') is-invalid @enderror" type="text" name="number_doctor" required placeholder="Introduzca el n° de colegiado" value="{{ old('number_doctor') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">N° de Inscripción ISP<b class="text-danger">*</b></label>
									<input class="form-control number @error('inscription') is-invalid @enderror" type="text" name="inscription" required placeholder="Introduzca el n° de inscripción" value="{{ old('inscription') }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Firma<b class="text-danger">*</b></label>
									<input type="file" name="signature" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Especialidad<b class="text-danger">*</b></label>
									<select class="form-control select2 @error('specialty_id') is-invalid @enderror" name="specialty_id[]" required multiple>
										<option value="">Seleccione</option>
										@foreach($specialties as $specialty)
										<option value="{{ $specialty->slug }}">{{ $specialty->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="doctorOld">Guardar</button>
										<a href="{{ route('medicos.index') }}" class="btn btn-secondary">Volver</a>
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
<script type="text/javascript" src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection