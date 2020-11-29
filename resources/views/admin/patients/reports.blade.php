@extends('layouts.admin')

@section('title', 'Lista de Informes')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Lista de Informes</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Fecha</th>
										<th>Paciente</th>
										<th>Medico Tratante</th>
										<th>Estado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($reports as $report)
									<tr>
										<td>{{ $num++ }}</td>
										<td>{{ $report->created_at->format('d-m-Y') }}</td>
										<td>{{ $report->patient->people->name." ".$report->patient->people->first_lastname." ".$report->patient->people->second_lastname }}</td>
										<td>@if(!is_null($report->doctor)){{ $report->doctor->people->name." ".$report->doctor->people->first_lastname." ".$report->doctor->people->second_lastname }}@else{{ 'Desconocido' }}@endif</td>
										<td>{!! stateReport($report->state) !!}</td>
										<td>
											<div class="btn-group" role="group">
												<a href="{{ route('pacientes.reports.show', ['slug' => $report->patient->people->slug, 'report' => $report->slug]) }}" class="btn btn-primary btn-sm bs-tooltip" title="Informe"><i class="fa fa-eye"></i></a>
												@if(!is_null($report->recipe) && !empty($report->recipe))
												<a href="{{ route('informes.pdf.recipe', ['slug' => $report->slug]) }}" class="btn btn-secondary btn-sm bs-tooltip" title="Receta PDF" target="_blank"><i class="fa fa-file-pdf"></i></a>
												@endif
												@if(!is_null($report->order) && !empty($report->order))
												<a href="{{ route('informes.pdf.order', ['slug' => $report->slug]) }}" class="btn btn-info btn-sm bs-tooltip" title="Orden Médica PDF" target="_blank"><i class="fa fa-file-medical"></i></a>
												@endif
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/jszip.min.js') }}"></script>    
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection