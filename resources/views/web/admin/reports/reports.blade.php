@extends('layouts.web-admin')

@section('title', 'Informes Médicos')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
@endsection

@section('content')

<img src="{{ asset('/web/img/doctora.png') }}" class="doctor-img" alt="Doctora">

<section class="ftco-section py-0">
    <div class="container bg-white py-1">
        <div class="row minh-475">
            <div class="col-12">
                <p class="pt-2"><img src="{{ asset('/web/img/cruz.png') }}" width="50" height="50"> <span class="h4 text-uppercase border-bottom-title text-primary ml-2">Informes Médicos</span></p>
                <div class="table-responsive mb-4 mt-4">
                    <table class="table table-hover table-normal">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Motivo de Consulta</th>
                                <th>Médico Tratante</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>{{ $num++ }}</td>
                                <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>@if(!is_null($report->doctor)){{ $report->doctor->people->name." ".$report->doctor->people->first_lastname." ".$report->doctor->people->second_lastname }}@else{{ 'Desconocido' }}@endif</td>
                                <td>@if($report->state==2){{ "Abierto" }}@else{{ "Cerrado" }}@endif</td>
                                <td>
                                    <a href="{{ route('reports.show', ['slug' => $report->slug]) }}" class="btn btn-sm btn-primary rounded mr-2"><i class="fa fa-eye"></i></a>
                                    @if(!is_null($report->recipe) && !empty($report->recipe))
                                    <a href="{{ route('reports.pdf.recipe', ['slug' => $report->slug]) }}" class="btn btn-sm btn-primary rounded" target="_blank"><i class="fa fa-file-pdf"></i></a>
                                    @endif
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
@endsection