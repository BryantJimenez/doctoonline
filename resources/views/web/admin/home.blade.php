@extends('layouts.web-admin')

@section('title', 'Perfil')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('content')

<img src="{{ asset('/web/img/doctora.png') }}" class="doctor-img" alt="Doctora">

<section class="ftco-section py-0">
    <div class="container bg-white minh-475 py-1">
        <div class="row pt-3">
            <div class="col-lg-3 col-md-3 col-12">
                <img src="{{ asset('/web/img/fondodefoto.png') }}" class="float-left float-md-right">
                <img src="{{ image_exist('/admins/img/users/', session('user')[0]->photo, true) }}" width="145" height="135" class="position-absolute rounded-circle photo-right">
            </div>
            @if(session('user')[0]->type=="1")
            <div class="col-lg-9 col-md-9 col-12">
                <p class="h4 text-primary text-uppercase"><span class="border-bottom-title">{{ session('user')[0]->name." ".session('user')[0]->first_lastname." ".session('user')[0]->second_lastname }}</span></p>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/iconomaletin.png') }}" width="18" height="15"><span class="text-primary pl-2">N° de Colegiado:</span> @if(!is_null(session('user')[0]->doctor)){{ session('user')[0]->doctor->number_doctor }}@endif</p>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/iconomaletin.png') }}" width="18" height="15"><span class="text-primary pl-2">Especialidad:</span> 
                        @if(!is_null(session('user')[0]->doctor))
                        @forelse(session('user')[0]->doctor->specialties as $specialty)
                        @if($loop->index!=0){{ ", " }}@endif
                        {{ $specialty->name }}
                        @empty
                        {{ 'No Ingresado' }}
                        @endforelse
                        @endif</p>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/rut.png') }}" width="19" height="15"><span class="text-primary pl-2">RUT:</span> {{ number_format(session('user')[0]->dni, 0, ".", ".")."-".session('user')[0]->verify_digit }}</p>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/iconomaletin.png') }}" width="18" height="15"><span class="text-primary pl-2">N° de ISP:</span> @if(!is_null(session('user')[0]->doctor)){{ session('user')[0]->doctor->inscription }}@endif</p>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/sexo.png') }}" width="15" height="15"><span class="text-primary pl-2">Género:</span> {{ session('user')[0]->gender }}</p>
                    </div>

                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">Dirección:</span> @if(!empty(session('user')[0]->address)){{ session('user')[0]->address }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/codigopostal.png') }}" width="20" height="15"><span class="text-primary pl-2">Cod. Postal:</span> @if(!empty(session('user')[0]->postal)){{ session('user')[0]->postal }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">País:</span> @if(!is_null(session('user')[0]->country)){{ session('user')[0]->country->name }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">Provincia:</span> @if(!is_null(session('user')[0]->commune->province)){{ session('user')[0]->commune->province->name }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">Región:</span> @if(!is_null(session('user')[0]->commune->province->region)){{ session('user')[0]->commune->province->region->name }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">Comuna:</span> @if(!is_null(session('user')[0]->commune)){{ session('user')[0]->commune->name }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/telefono.png') }}" width="15" height="15"><span class="text-primary pl-2">Teléfono Fijo:</span> @if(!empty(session('user')[0]->phone)){{ session('user')[0]->phone }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/celular.png') }}" width="13" height="18"><span class="text-primary pl-2">Móvil:</span> @if(!empty(session('user')[0]->celular)){{ session('user')[0]->celular }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/fecha.png') }}" width="15" height="15"><span class="text-primary pl-2">Fecha de Nacimiento:</span> {{ date("d-m-Y", strtotime(session('user')[0]->birthday))." (".age(session('user')[0]->birthday).")" }}</p>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/email.png') }}" width="20" height="15"><span class="text-primary pl-2">E-mail:</span> {{ session('user')[0]->email }}</p>
                    </div>

                    <div class="col-12">
                        <p class="h6 my-3"><span class="text-primary pl-2">Firma Digital:</span> @if(!is_null(session('user')[0]->doctor))<img src="{{ image_exist('/admins/img/doctors/', session('user')[0]->doctor->signature) }}" class="signature ml-2">@endif</p>
                    </div>
                </div>
            </div>
            @elseif(session('user')[0]->type=="2")
            <div class="col-lg-9 col-md-9 col-12">
                <p class="h4 text-primary text-uppercase"><span class="border-bottom-title">{{ session('user')[0]->name." ".session('user')[0]->first_lastname." ".session('user')[0]->second_lastname }}</span></p>
                <div class="row">
                    <div class="col-xl-5 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/fecha.png') }}" width="15" height="15"><span class="text-primary pl-2">Fecha de Nacimiento:</span> {{ date("d-m-Y", strtotime(session('user')[0]->birthday)) }}</p>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">País:</span> @if(!is_null(session('user')[0]->country)){{ session('user')[0]->country->name }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">Provincia:</span> @if(!is_null(session('user')[0]->commune->province)){{ session('user')[0]->commune->province->name }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-xl-5 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/rut.png') }}" width="19" height="15"><span class="text-primary pl-2">Documento:</span> {{ number_format(session('user')[0]->dni, 0, ".", ".")."-".session('user')[0]->verify_digit }}</p>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">Región:</span> @if(!is_null(session('user')[0]->commune->province->region)){{ session('user')[0]->commune->province->region->name }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">Comuna:</span> @if(!is_null(session('user')[0]->commune)){{ session('user')[0]->commune->name }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/geo.png') }}" width="15" height="17"><span class="text-primary pl-2">Dirección:</span> @if(!empty(session('user')[0]->address)){{ session('user')[0]->address }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/codigopostal.png') }}" width="20" height="15"><span class="text-primary pl-2">Cod. Postal:</span> @if(!empty(session('user')[0]->postal)){{ session('user')[0]->postal }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/email.png') }}" width="20" height="15"><span class="text-primary pl-2">E-mail:</span> {{ session('user')[0]->email }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/telefono.png') }}" width="15" height="15"><span class="text-primary pl-2">Teléfono Fijo:</span> @if(!empty(session('user')[0]->phone)){{ session('user')[0]->phone }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/celular.png') }}" width="13" height="18"><span class="text-primary pl-2">Móvil:</span> @if(!empty(session('user')[0]->celular)){{ session('user')[0]->celular }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/sexo.png') }}" width="15" height="15"><span class="text-primary pl-2">Género:</span> {{ session('user')[0]->gender }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <p class="h6 my-3"><img src="{{ asset('/web/img/estadocivil.png') }}" width="18" height="15"><span class="text-primary pl-2">Civil:</span> @if(!is_null(session('user')[0]->patient) && !empty(session('user')[0]->patient->civil_state)){{ session('user')[0]->patient->civil_state }}@else{{ 'No Ingresado' }}@endif</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                <p class="h6 my-3"><span class="text-primary">Hijos:</span> @if(!is_null(session('user')[0]->patient) && session('user')[0]->patient->children>0){{ "Si (".session('user')[0]->patient->children." Hijos)" }}@else{{ "No" }}@endif</p>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                <p class="h6 my-3"><span class="text-primary">Sit. Laboral:</span> @if(!is_null(session('user')[0]->patient) && !empty(session('user')[0]->patient->laboral)){{ session('user')[0]->patient->laboral }}@else{{ 'No Ingresado' }}@endif</p>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                <p class="h6 my-3"><span class="text-primary">Educación:</span> @if(!is_null(session('user')[0]->patient) && !is_null(session('user')[0]->patient->study)){{ session('user')[0]->patient->study->name }}@else{{ 'No Ingresado' }}@endif</p>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                <p class="h6 my-3"><span class="text-primary">Aseguradora:</span> @if(!is_null(session('user')[0]->patient) && !is_null(session('user')[0]->patient->insurer)){{ session('user')[0]->patient->insurer->name }}@else{{ 'No Ingresado' }}@endif</p>
            </div>
            @endif
        </div>
    </div>
</section>

@endsection