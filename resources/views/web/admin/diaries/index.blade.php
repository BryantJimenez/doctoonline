@extends('layouts.web-admin')

@section('title', 'Agenda')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('links')
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<img src="{{ asset('/web/img/doctora.png') }}" class="doctor-img" alt="Doctora">

<section class="ftco-section py-0">
    <div class="container bg-white py-1">
        <div class="row minh-475">
            <div class="col-12">
                <div class="form-group mb-3">
                    <label class="col-form-label">Seleccione un Fecha</label>
                    <input class="form-control" type="text" value="{{ date('d-m-Y') }}" slug="{{ session('user')[0]->slug }}" id="diariesDate">
                </div>

                <p class="h6 text-uppercase text-primary pt-2 px-2">Reservas de la fecha <span id="dateDiary">{{ date('d-m-Y') }}</span></p>
                <div class="table-responsive mb-4">
                    <table class="table table-hover table-normal">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha y Hora</th>
                                <th>Paciente</th>
                                <th>Servicio</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="diaryRow">
                            @foreach($diaries->where('date', date('Y-m-d')) as $diary)
                            <tr>
                                <td>{{ $num++ }}</td>
                                <td>{{ date('d-m-Y H:i A', strtotime($diary->date." ".$diary->time)) }}</td>
                                <td>{{ $diary->name." ".$diary->lastname }}</td>
                                <td>{{ $diary->diary_service->service->name }}</td>
                                <td>{!! stateDiary($diary->state) !!}</td>
                                <td>
                                    <a href="{{ route('diaries.show', ['slug' => $diary->slug]) }}" class="btn btn-sm btn-primary text-uppercase rounded">Ver</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/jszip.min.js') }}"></script>    
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection