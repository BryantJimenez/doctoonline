@extends('layouts.web-admin')

@section('title', 'Buscar Paciente')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('links')
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
            <div class="col-lg-8 col-md-8 col-sm-7 col-12">
                <div class="form-group mt-3">
                    <label class="col-form-label">Busque un paciente por su RUT</label>
                    <div class="input-group">
                        <input class="form-control number py-4" type="text" name="search" placeholder="Ingrese un RUT" id="searchPatient">
                        <div class="input-group-append">
                            <span class="input-group-text pt-0">-</span>
                            <input class="form-control input-group-text bg-white text-left py-4" type="text" name="verify_digit" required minlength="1" maxlength="1" placeholder="Introduzca el DV" id="searchDv">
                            <button class="btn btn-sm btn-primary px-4" type="button" id="searchButtonPatient"><img src="{{ asset('/web/img/iconobuscar.png') }}" width="30" height="30"></button>
                        </div>
                    </div>
                    <p class="text-danger font-weight-bold d-none" id="searchErrors"></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-12 mt-1">
                <a href="{{ route('web.patients.create') }}" class="btn btn-lg btn-primary rounded text-uppercase float-sm-right mt-lg-5 mt-md-5 mt-sm-5">Agregar Paciente</a>
            </div>

            <div class="col-12 d-none" id="emptyPatient">
                <p class="h4 text-danger text-center text-uppercase">No existe el paciente buscado, por favor agregue al paciente</p>
            </div>

            @if(session('patient'))
            <div class="col-12" id="dataPatient">
                <p class="h6 text-uppercase text-primary pt-2">Paciente Encontrado</p>
                <div class="row justify-content-between bg-grey py-1 my-2 mx-1">
                    <div class="col-lg-4 col-md-3 col-12 text-uppercase">
                        <img src="@if(session('patient')->photo){{ image_exist('/admins/img/users/', session('patient')->photo, true) }}@else{{ image_exist('/admins/img/users/', 'usuario.png', true) }}@endif" class="rounded-circle mr-1" width="48" height="48" id="photoUser">
                        <span class="small" id="nameUser">{{ session('patient')->name." ".session('patient')->first_lastname." ".session('patient')->second_lastname }}</span>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12 text-uppercase py-2">
                        <span class="small" id="dniUser">RUT: {{ number_format(session('patient')->dni, 0, ".", ".")."-".session('patient')->verify_digit }}</span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 text-uppercase py-2">
                        <span class="small" id="movilUser">MÓVIL: {{ session('patient')->celular }}</span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 py-1">
                        <a href="{{ route('reports.create', ['slug' => session('patient')->slug]) }}" class="btn btn-sm btn-primary text-uppercase rounded float-lg-right" id="btnAddReport">Agregar Informe</a>
                    </div>
                </div>
            </div>

            <div class="col-12" id="reportsPatient">
                <p class="h6 text-uppercase text-primary pt-2 px-2">Últimas Consultas del Paciente</p>
                <div class="table-responsive mb-4">
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
                        <tbody id="reportsRow">
                            @php $num=count(session('patient')->patient->reports) @endphp
                            @foreach(session('patient')->patient->reports as $report)
                            <tr>
                                <td>{{ $num-- }}</td>
                                <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>@if(!is_null($report->doctor)){{ $report->doctor->people->name." ".$report->doctor->people->first_lastname." ".$report->doctor->people->second_lastname }}@else{{ 'Desconocido' }}@endif</td>
                                <td>@if($report->state==2){{ "Abierto" }}@else{{ "Cerrado" }}@endif</td>
                                <td>
                                    @if($report->state==2)
                                    <a href="{{ route('reports.show', ['slug' => $report->slug]) }}" class="btn btn-primary rounded">CONTINUAR</a>
                                    @else
                                    <a href="{{ route('reports.show', ['slug' => $report->slug]) }}" class="btn btn-sm btn-primary rounded mr-1"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('reports.edit', ['slug' => $report->slug]) }}" class="btn btn-sm btn-primary rounded mr-1"><i class="fa fa-edit"></i></a>
                                    @if(!is_null($report->recipe) && !empty($report->recipe))
                                    <a href="{{ route('reports.pdf.recipe', ['slug' => $report->slug]) }}" class="btn btn-sm btn-primary rounded" target="_blank"><i class="fa fa-file-pdf"></i></a>
                                    @endif
                                    @if(!is_null($report->order) && !empty($report->order))
                                    <a href="{{ route('reports.pdf.order', ['slug' => $report->slug]) }}" class="btn btn-sm btn-primary rounded" target="_blank"><i class="fa fa-file"></i></a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="col-12 d-none" id="dataPatient">
                <p class="h6 text-uppercase text-primary pt-2">Paciente Encontrado</p>
                <div class="row justify-content-between bg-grey py-1 my-2 mx-1">
                    <div class="col-lg-4 col-md-3 col-12 text-uppercase">
                        <img src="#" class="rounded-circle mr-1" width="48" height="48" id="photoUser">
                        <span class="small" id="nameUser"></span>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12 text-uppercase py-2">
                        <span class="small" id="dniUser"></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 text-uppercase py-2">
                        <span class="small" id="movilUser"></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 text-uppercase py-1">
                        <a href="#" class="btn btn-sm btn-primary text-uppercase rounded float-lg-right" id="btnAddReport">Agregar Informe</a>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none" id="reportsPatient">
                <p class="h6 text-uppercase text-primary pt-2 px-2">Últimas Consultas del Paciente</p>
                <div class="table-responsive mb-4">
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
                        <tbody id="reportsRow">
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
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
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection