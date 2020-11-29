@extends('layouts.web-admin')

@section('title', 'Reserva')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('content')

<section class="ftco-section py-0">
    <div class="container py-1">
        <div class="row minh-475">
            <div class="col-12 bg-white mx-auto">
                <p class="pt-3">
                    <span class="h5 text-uppercase border-bottom-title text-primary">Reserva</span>
                </p>
                <div class="row">
                    <div class="col-12 my-2">
                        <p class="h5 text-primary mb-0">Datos del Paciente</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Nombre Completo:</b> {{ $diary->name." ".$diary->lastname }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>RUT:</b> {{ number_format($diary->dni, 0, ".", ".")."-".$diary->verify_digit }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Género:</b> {{ $diary->gender }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Teléfono:</b> {{ $diary->phone }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Email:</b> {{ $diary->email }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Fecha de Nacimiento:</b> {{ date("d-m-Y", strtotime($diary->birthday)) }}</p>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h5 text-primary mb-0">Datos de la Reserva</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Servicio:</b> {{ $diary->diary_service->service->name }}</p>
                    </div>

                    @if($diary->diary_service->service->type==1)
                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Especialidad:</b> {{ $diary->diary_service->doctor_service->specialty->name }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Médico:</b> {{ $diary->diary_service->doctor_service->people->name." ".$diary->diary_service->doctor_service->people->first_lastname." ".$diary->diary_service->doctor_service->people->second_lastname }}</p>
                    </div>
                    @endif

                    @if($diary->diary_service->service->type==2)
                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Examen:</b> {{ $diary->diary_service->exam_service->subcategory->category->name." | ".$diary->diary_service->exam_service->subcategory_diary->name }}</p>
                    </div>
                    @endif

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Precio:</b> ${{ number_format($diary->amount, 2, ",", ".") }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Fecha y Hora:</b> {{ date("d-m-Y H:i A", strtotime($diary->date." ".$diary->time)) }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Estado:</b> {!! stateDiary($diary->state) !!}</p>
                    </div>

                    <div class="d-flex justify-content-center col-12 my-4">
                        <a href="{{ route('diaries') }}" class="btn btn-secondary rounded text-uppercase px-5">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection