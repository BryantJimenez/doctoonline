@extends('layouts.web-admin')

@section('title', 'Crear Paciente')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('links')
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="ftco-section py-0">
    <div class="container py-1">
        <div class="row minh-475">
            <div class="col-12 bg-white mx-auto">
                <form action="{{ route('web.patients.store') }}" method="POST" enctype="multipart/form-data" id="formPatient" class="my-3">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-12">
                            @include('admin.partials.errors')
                        </div>

                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-12 custom-file d-flex flex-column">
                            <img src="{{ asset('/web/img/fondodefoto.png') }}" width="120" height="120" class="mx-auto">
                            <img src="{{ image_exist('/admins/img/users/', 'usuario.png', true) }}" width="95" height="95" class="file-photo rounded-circle mx-auto">
                            <p class="small text-primary text-center mt-3 mb-0">Ingrese su Foto</p>
                            <input type="file" name="photo" accept="image/*" id="file-hidden">
                        </div>

                        <div class="col-lg-9 col-md-9 col-sm-9 col-12">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label">RUT<b class="text-danger">*</b></label>
                                    <div class="input-group">
                                        <input class="form-control number @error('dni') is-invalid @enderror" type="text" name="dni" required placeholder="Introduzca el RUT" minlength="2" value="{{ old('dni') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text pt-0">-</span>
                                            <input class="form-control input-group-text bg-white text-left @error('verify_digit') is-invalid @enderror" type="text" name="verify_digit" required minlength="1" maxlength="1" placeholder="Introduzca el DV" value="{{ old('verify_digit') }}" id="dv">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 mt-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Introduzca un correo electrónico" required value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Nombres<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Introduzca sus nombres" required value="{{ old('name') }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Apellido Paterno<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('first_lastname') is-invalid @enderror" name="first_lastname" placeholder="Introduzca su apellido paterno" required value="{{ old('first_lastname') }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Apellido Materno<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('second_lastname') is-invalid @enderror" name="second_lastname" placeholder="Introduzca su apellido materno" required value="{{ old('second_lastname') }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Teléfono Fijo<b class="text-danger">*</b></label>
                            <input type="text" class="form-control number @error('phone') is-invalid @enderror" name="phone" placeholder="Introduzca un teléfono fijo" required value="{{ old('phone') }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Móvil<b class="text-danger">*</b></label>
                            <input type="text" class="form-control number @error('celular') is-invalid @enderror" name="celular" placeholder="Introduzca un móvil" required value="{{ old('celular') }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Género<b class="text-danger">*</b></label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                <option value="">Seleccione</option>
                                <option @if(old('gender')=="Masculino") selected @endif>Masculino</option>
                                <option @if(old('gender')=="Femenino") selected @endif>Femenino</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">País<b class="text-danger">*</b></label>
                            <select class="form-control @error('country_id') is-invalid @enderror" name="country_id" required>
                                <option value="">Seleccione</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}" @if($country->id==old('country_id')) selected @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Región<b class="text-danger">*</b></label>
                            <select class="form-control @error('region_id') is-invalid @enderror" name="region_id" required id="selectRegions">
                                <option value="">Seleccione</option>
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}" @if($region->id==old('region_id')) selected @endif>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Provincia<b class="text-danger">*</b></label>
                            <select class="form-control @error('province_id') is-invalid @enderror" name="province_id" disabled required id="selectProvinces">
                                <option value="">Seleccione</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Comuna<b class="text-danger">*</b></label>
                            <select class="form-control @error('commune_id') is-invalid @enderror" name="commune_id" disabled required id="selectCommunes">
                                <option value="">Seleccione</option>
                            </select>
                        </div>

                        <div class="form-group col-12 mt-2">
                            <label class="col-form-label">Dirección<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Introduzca su dirección" required value="{{ old('address') }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Código Postal<b class="text-danger">*</b></label>
                            <input type="text" class="form-control number @error('postal') is-invalid @enderror" name="postal" placeholder="Introduzca su código postal" required value="{{ old('postal') }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Fecha de Nacimiento<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" placeholder="Seleccione" required id="flatpickr">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Edad</label>
                            <input class="form-control" type="text" disabled placeholder="Edad" id="age">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Estado Civil<b class="text-danger">*</b></label>
                            <select class="form-control @error('civil_state') is-invalid @enderror" name="civil_state" required>
                                <option value="">Seleccione</option>
                                <option @if(old('civil_state')=="Soltero") selected @endif>Soltero</option>
                                <option @if(old('civil_state')=="Casado") selected @endif>Casado</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Situación Laboral<b class="text-danger">*</b></label>
                            <select class="form-control @error('laboral') is-invalid @enderror" name="laboral" required>
                                <option value="">Seleccione</option>
                                <option @if(old('laboral')=="Empleado") selected @endif>Empleado</option>
                                <option @if(old('laboral')=="Cesante") selected @endif>Cesante</option>
                                <option @if(old('laboral')=="Jubilado") selected @endif>Jubilado</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Nivel Educacional<b class="text-danger">*</b></label>
                            <select class="form-control @error('study_id') is-invalid @enderror" name="study_id" required>
                                <option value="">Seleccione</option>
                                @foreach($studies as $study)
                                <option value="{{ $study->slug }}" @if($study->slug==old('study_id')) selected @endif>{{ $study->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Aseguradora de Salud<b class="text-danger">*</b></label>
                            <select class="form-control @error('insurer_id') is-invalid @enderror" name="insurer_id" required>
                                <option value="">Seleccione</option>
                                @foreach($insurers as $insurer)
                                <option value="{{ $insurer->slug }}" @if($insurer->slug==old('insurer_id')) selected @endif>{{ $insurer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">¿Tiene Hijos?<b class="text-danger">*</b></label>
                            <select class="form-control question_children @error('question_children') is-invalid @enderror" name="question_children" required>
                                <option>No</option>
                                <option>Si</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2 children-content d-none">
                            <label class="col-form-label">¿Cuántos Hijos Tiene?<b class="text-danger">*</b></label>
                            <input class="form-control children @error('children') is-invalid @enderror" type="text" name="children" required disabled placeholder="Introduce la cantidad de hijos" min="1" max="99" value="1">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-12 mt-2">
                            <label class="col-form-label">Contraseña<b class="text-danger">*</b></label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Contraseña" id="password">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-12 mt-2">
                            <label class="col-form-label">Confirmar Contraseña<b class="text-danger">*</b></label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirme su contraseña">
                        </div>
                        <div class="form-group d-flex justify-content-center col-12">
                            <button type="submit" class="btn btn-primary rounded text-uppercase px-5" action="patient">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection