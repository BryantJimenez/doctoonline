@extends('layouts.web')

@section('title', 'Registrarse')

@section('links')
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="ftco-section py-0">
	<div class="vh-100 w-100">
		<div class="row mx-0">
			<div class="col-12 pt-2 mt-5 mb-4 mx-auto" id="login">
				<div class="card border-0 mx-xl-5">
					<a href="{{ route('home') }}" class="text-center">
						<img src="{{ asset('/web/img/logo-login.png') }}" class="mt-2 mb-2 mt-xl-3 mb-xl-4" alt="Logo">
					</a>
					<form class="card-body" action="{{ route('register.custom') }}" method="POST" id="formRegister">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-12">
								@include('admin.partials.errors')

								@if(session('error.register'))
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<ul>
										<li>{{ session('error.register') }}</li>
									</ul>
								</div>
								@endif
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<div class="input-group">
									<input class="form-control rounded-1 number @error('dni') is-invalid @enderror" type="text" name="dni" required placeholder="RUT" minlength="2" value="{{ old('dni') }}">
									<div class="input-group-append">
										<span class="input-group-text pt-0">-</span>
										<input class="form-control input-group-text bg-white text-left rounded-1 @error('verify_digit') is-invalid @enderror" type="text" name="verify_digit" required minlength="1" maxlength="1" placeholder="DV" value="{{ old('verify_digit') }}" id="dv">
									</div>
								</div>
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<input class="form-control rounded-1 @error('name') is-invalid @enderror" type="text" name="name" required placeholder="NOMBRES" value="{{ old('name') }}">
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<input class="form-control rounded-1 @error('first_lastname') is-invalid @enderror" type="text" name="first_lastname" required placeholder="APELLIDO PATERNO" value="{{ old('first_lastname') }}">
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<input class="form-control rounded-1 @error('second_lastname') is-invalid @enderror" type="text" name="second_lastname" required placeholder="APELLIDO MATERNO" value="{{ old('second_lastname') }}">
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<select class="form-control rounded-1 @error('gender') is-invalid @enderror" name="gender" required>
									<option value="">GENERO</option>
									<option @if(old('gender')=="Masculino") selected @endif>Masculino</option>
									<option @if(old('gender')=="Femenino") selected @endif>Femenino</option>
								</select>
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<select class="form-control rounded-1 @error('country_id') is-invalid @enderror" name="country_id" required>
									<option value="">PAÍS</option>
									@foreach($countries as $country)
									<option value="{{ $country->id }}" @if($country->id==old('country_id')) selected @endif>{{ $country->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<select class="form-control rounded-1 @error('region_id') is-invalid @enderror" name="region_id" required id="selectRegions">
									<option value="">REGIÓN</option>
									@foreach($regions as $region)
									<option value="{{ $region->id }}" @if($region->id==old('region_id')) selected @endif>{{ $region->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<select class="form-control rounded-1 @error('province_id') is-invalid @enderror" name="province_id" @if(empty(old('region_id'))) disabled @endif required id="selectProvinces">
									<option value="">PROVINCIA</option>
									@if(!empty(old('region_id')))
									{!! selectProvince(old('province_id'), old('region_id')) !!}
									@endif
								</select>
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<select class="form-control rounded-1 @error('commune_id') is-invalid @enderror" name="commune_id" @if(empty(old('commune_id'))) disabled @endif required id="selectCommunes">
									<option value="">COMUNA</option>
									@if(!empty(old('province_id')))
									{!! selectCommune(old('commune_id'), old('province_id')) !!}
									@endif
								</select>
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<input class="form-control rounded-1 date @error('birthday') is-invalid @enderror" type="text" name="birthday" required placeholder="FECHA DE NACIMIENTO" value="{{ old('birthday') }}" id="flatpickr">
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<input class="form-control rounded-1 @error('email') is-invalid @enderror" type="email" name="email" required placeholder="EMAIL" value="{{ old('email') }}" id="email">
							</div>

							<div class="form-group col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
								<input class="form-control rounded-1 @error('password') is-invalid @enderror" type="password" name="password" placeholder="CLAVE" id="password">
							</div>

							<div class="form-group col-12 mb-2">
                                <input type="checkbox" name="terms" required value="checked" id="terms-conditions">
                                <label class="h5 text-body small mb-0" for="terms-conditions">Acepto <a href="javascript:void(0);" class="text-primary" data-dismiss="modal" data-toggle="modal" data-target="#modal-terms">Términos y condiciones</a></label>
                            </div>

							<div class="form-group col-12">
								<button type="submit" class="btn btn-blue-light text-white font-weight-bold text-uppercase rounded-1 w-100 py-3" action="register">Registrarse</button>
							</div>

							<div class="form-group col-12 text-center">
								<a href="{{ route('recuperar') }}" class="h5 text-dark">Olvidaste tú Clave?</a>
							</div>
						</div>
					</form>
					<div class="card-footer bg-red-dark">
						<a href="{{ route('ingresar') }}"><p class="h6 font-weight-bold text-white text-uppercase text-center mb-0 py-xl-2">Iniciar Sesión</p></a>
					</div>
				</div>

			</div>
		</div>

	</div>
</section>

<div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Términos y Condiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vh-70 overflow-scroll">
                <div class="row">
                    <div class="col-12">
                        {!! $setting->terms !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection