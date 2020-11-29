@extends('layouts.web-admin')

@section('title', 'Editar Perfil')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/select2/select2.min.css') }}">
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<img src="{{ asset('/web/img/doctora.png') }}" class="doctor-img" alt="Doctora">

<section class="ftco-section py-0">
    <div class="container py-1">
        <div class="row minh-475">
            <div class="col-12 bg-white mx-auto">
                <form action="{{ route('web.profile.update') }}" method="POST" enctype="multipart/form-data" id="formRegisterEdit" class="my-3">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-12">
                            @include('admin.partials.errors')
                        </div>

                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-12 custom-file d-flex flex-column">
                            <img src="{{ asset('/web/img/fondodefoto.png') }}" width="120" height="120" class="mx-auto">
                            <img src="{{ image_exist('/admins/img/users/', session('user')[0]->photo, true) }}" width="95" height="95" class="file-photo rounded-circle mx-auto">
                            <p class="small text-primary text-center mt-3 mb-0">Ingrese su Foto</p>
                            <input type="file" name="photo" accept="image/*" id="file-hidden">
                        </div>

                        <div class="col-lg-9 col-md-9 col-sm-9 col-12">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="col-form-label">RUT<b class="text-danger">*</b></label>
                                    <div class="input-group">
                                        <input class="form-control number @error('dni') is-invalid @enderror" type="text" name="dni" required placeholder="Introduzca el RUT" minlength="2" value="{{ session('user')[0]->dni }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text pt-0">-</span>
                                            <input class="form-control input-group-text bg-white text-left @error('verify_digit') is-invalid @enderror" type="text" name="verify_digit" required minlength="1" maxlength="1" placeholder="Introduzca el DV" value="{{ session('user')[0]->verify_digit }}" id="dv">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label class="col-form-label">Correo Electrónico</label>
                                    <input type="text" class="form-control" disabled placeholder="Correo electrónico" value="{{ session('user')[0]->email }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Nombres<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Introduzca sus nombres" required value="{{ session('user')[0]->name }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Apellido Paterno<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('first_lastname') is-invalid @enderror" name="first_lastname" placeholder="Introduzca su apellido paterno" required value="{{ session('user')[0]->first_lastname }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Apellido Materno<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('second_lastname') is-invalid @enderror" name="second_lastname" placeholder="Introduzca su apellido materno" required value="{{ session('user')[0]->second_lastname }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Teléfono Fijo<b class="text-danger">*</b></label>
                            <input type="text" class="form-control number @error('phone') is-invalid @enderror" name="phone" placeholder="Introduzca un teléfono fijo" required value="{{ session('user')[0]->phone }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Móvil<b class="text-danger">*</b></label>
                            <input type="text" class="form-control number @error('celular') is-invalid @enderror" name="celular" placeholder="Introduzca un móvil" required value="{{ session('user')[0]->celular }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Género<b class="text-danger">*</b></label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                <option value="">Seleccione</option>
                                <option @if(session('user')[0]->gender=="Masculino") selected @endif>Masculino</option>
                                <option @if(session('user')[0]->gender=="Femenino") selected @endif>Femenino</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">País<b class="text-danger">*</b></label>
                            <select class="form-control @error('country_id') is-invalid @enderror" name="country_id" required>
                                <option value="">Seleccione</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}" @if($country->id==session('user')[0]->country_id) selected @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Región<b class="text-danger">*</b></label>
                            <select class="form-control @error('region_id') is-invalid @enderror" name="region_id" required id="selectRegions">
                                <option value="">Seleccione</option>
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}" @if($region->id==session('user')[0]->commune->province->region_id) selected @endif>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Provincia<b class="text-danger">*</b></label>
                            <select class="form-control @error('province_id') is-invalid @enderror" name="province_id" required id="selectProvinces">
                                <option value="">Seleccione</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}" @if($province->id==session('user')[0]->commune->province_id) selected @endif>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Comuna<b class="text-danger">*</b></label>
                            <select class="form-control @error('commune_id') is-invalid @enderror" name="commune_id" required id="selectCommunes">
                                <option value="">Seleccione</option>
                                @foreach($communes as $commune)
                                <option value="{{ $commune->id }}" @if($commune->id==session('user')[0]->commune_id) selected @endif>{{ $commune->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 mt-2">
                            <label class="col-form-label">Dirección<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Introduzca su dirección" required value="{{ session('user')[0]->address }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Código Postal<b class="text-danger">*</b></label>
                            <input type="text" class="form-control number @error('postal') is-invalid @enderror" name="postal" placeholder="Introduzca su código postal" required value="{{ session('user')[0]->postal }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Fecha de Nacimiento<b class="text-danger">*</b></label>
                            <input type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" placeholder="Seleccione" required value="{{ date('d-m-Y', strtotime(session('user')[0]->birthday)) }}" id="flatpickr">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Edad</label>
                            <input class="form-control" type="text" disabled placeholder="Edad" value="{{ age(date('Y-m-d', strtotime(session('user')[0]->birthday))) }}" id="age">
                        </div>

                        @if(session('user')[0]->type=="1")
                        <div class="form-group col-lg-6 col-md-6 col-12 mt-2">
                            <label class="col-form-label">Profesión<b class="text-danger">*</b></label>
                            <select class="form-control @error('profession_id') is-invalid @enderror" name="profession_id" required>
                                <option value="">Seleccione</option>
                                @foreach($professions as $profession)
                                <option value="{{ $profession->slug }}" @if(session('user')[0]->doctor->profession->slug==$profession->slug) selected @endif>{{ $profession->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-12 mt-2">
                            <label class="col-form-label">N° de Coleagiado Médico<b class="text-danger">*</b></label>
                            <input class="form-control number @error('number_doctor') is-invalid @enderror" type="text" name="number_doctor" required placeholder="Introduzca el n° de colegiado" value="{{ session('user')[0]->doctor->number_doctor }}">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-12 mt-2">
                            <label class="col-form-label">N° de Inscripción ISP<b class="text-danger">*</b></label>
                            <input class="form-control number @error('inscription') is-invalid @enderror" type="text" name="inscription" required placeholder="Introduzca el n° de inscripción" value="{{ session('user')[0]->doctor->inscription }}">
                        </div>

                        <div class="form-group col-12 mt-2">
                            <label class="col-form-label">Firma<b class="text-danger">*</b></label>
                            <input type="file" name="signature" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/doctors/', session('user')[0]->doctor->signature) }}" />
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-12 mt-2">
                            <label class="col-form-label">Especialidad<b class="text-danger">*</b></label>
                            <select class="form-control select2 @error('specialty_id') is-invalid @enderror" name="specialty_id[]" required multiple>
                                <option value="">Seleccione</option>
                                {!! selectArray($specialties, session('user')[0]->doctor->specialties) !!}
                            </select>
                        </div>
                        @elseif(session('user')[0]->type=="2")
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Estado Civil<b class="text-danger">*</b></label>
                            <select class="form-control @error('civil_state') is-invalid @enderror" name="civil_state" required>
                                <option value="">Seleccione</option>
                                <option @if(session('user')[0]->patient->civil_state=="Soltero") selected @endif>Soltero</option>
                                <option @if(session('user')[0]->patient->civil_state=="Casado") selected @endif>Casado</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Situación Laboral<b class="text-danger">*</b></label>
                            <select class="form-control @error('laboral') is-invalid @enderror" name="laboral" required>
                                <option value="">Seleccione</option>
                                <option @if(session('user')[0]->patient->laboral=="Empleado") selected @endif>Empleado</option>
                                <option @if(session('user')[0]->patient->laboral=="Cesante") selected @endif>Cesante</option>
                                <option @if(session('user')[0]->patient->laboral=="Jubilado") selected @endif>Jubilado</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Nivel Educacional<b class="text-danger">*</b></label>
                            <select class="form-control @error('study_id') is-invalid @enderror" name="study_id" required>
                                <option value="">Seleccione</option>
                                @foreach($studies as $study)
                                <option value="{{ $study->slug }}" @if($study->id==session('user')[0]->patient->study_id) selected @endif>{{ $study->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">Aseguradora de Salud<b class="text-danger">*</b></label>
                            <select class="form-control @error('insurer_id') is-invalid @enderror" name="insurer_id" required>
                                <option value="">Seleccione</option>
                                @foreach($insurers as $insurer)
                                <option value="{{ $insurer->slug }}" @if($insurer->id==session('user')[0]->patient->insurer_id) selected @endif>{{ $insurer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                            <label class="col-form-label">¿Tiene Hijos?<b class="text-danger">*</b></label>
                            <select class="form-control question_children @error('question_children') is-invalid @enderror" name="question_children" required>
                                <option @if(is_null(session('user')[0]->patient->children) || session('user')[0]->patient->children==0) selected @endif>No</option>
                                <option @if(session('user')[0]->patient->children>0) selected @endif>Si</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12 mt-2 children-content @if(is_null(session('user')[0]->patient->children) || session('user')[0]->patient->children==0) d-none @endif">
                            <label class="col-form-label">¿Cuántos Hijos Tiene?<b class="text-danger">*</b></label>
                            <input class="form-control children @error('children') is-invalid @enderror" type="text" name="children" required @if(is_null(session('user')[0]->patient->children) || session('user')[0]->patient->children==0) disabled @endif placeholder="Introduce la cantidad de hijos" min="1" max="99" value="@if(session('user')[0]->patient->children>0){{ session('user')[0]->patient->children }}@else{{ "1" }}@endif">
                        </div>
                        @endif

                        <div class="form-group col-lg-6 col-md-6 col-12 mt-2">
                            <label class="col-form-label">Contraseña</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Introduzca su contraseña" id="password">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-12 mt-2">
                            <label class="col-form-label">Confirmar Contraseña</label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirme su contraseña">
                        </div>
                        <div class="form-group d-flex justify-content-center col-12">
                            <button type="submit" class="btn btn-primary rounded text-uppercase px-5" action="register">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/select2/custom-select2.js') }}"></script>
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