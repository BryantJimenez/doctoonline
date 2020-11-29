@extends('layouts.web')

@section('title', 'Trabaja con Nosotros')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="ftco-section py-5" id="banner-news">
    <div class="row mx-0">
        <div class="col-md-12 text-center">
            <span class="h5 text-uppercase font-weight-bold text-white position-relative m-0"><img src="{{ asset('/web/img/logoblanco.png') }}" alt="Logo"> Trabaja con Nosotros</span>
        </div>
    </div>
</section>

<section class="ftco-section py-0">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4">
                @include('admin.partials.errors')

                <form action="{{ route('solicitudes.store') }}" method="POST" class="form" id="formApplicantWeb" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
                            <label class="col-form-label">Nombre</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}">
                        </div>

                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
                            <label class="col-form-label">Correo Electrónico</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Introduzca un correo electrónico" value="{{ old('email') }}">
                        </div>

                        <div class="form-group col-12">
                            <label class="col-form-label">Mensaje</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" required placeholder="Introduzca un mensaje" rows="8">{{ old('message') }}</textarea>
                        </div>

                        <div class="form-group col-12">
                            <label class="col-form-label">Documento</label>
                            <input type="file" name="file" class="dropify" data-height="125" data-max-file-size="20M" />
                        </div>

                        <div class="form-group text-center col-12">
                            <button type="submit" class="btn btn-orange text-white text-uppercase font-weight-bold rounded px-5" action="applicant">Enviar</button>
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
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection