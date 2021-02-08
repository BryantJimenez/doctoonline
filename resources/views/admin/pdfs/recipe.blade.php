<!DOCTYPE html>
<html>
<head>
	<title>Receta</title>
	<link href="{{ public_path('/admins/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

	<style>
		@page { margin: 200px 70px 80px; }
		#header { 
			position: fixed;
			left: 0px;
			top: -100px;
			right: 0px;
			height: 95px;
			text-align: center;
		}

		#header div img {
			margin-top: 10px;
		}

		#footer {
			position: fixed;
			left: 0px;
			bottom: -80px;
			right: 0px;
			height: 80px;
			text-align: center;
		}

		body, h1, h2, h3, h4, h5, h6, p {
			font-family: "Times New Roman" !important;
		}

		.border-dark {
			border-bottom: 2px solid #000000;
		}

		table tr, table tr td, .table td {
			margin: 0 !important;
			padding: 0 !important;
			border: 1px solid #ffffff !important;
		}
	</style>

	<div id="header">
		<div class="w-50">
			<img src="{{ public_path('/web/img/logo.png') }}" class="w-50 pt-3">
		</div>
		@if(!is_null($report->doctor))
		<div class="w-50 ml-auto" style="margin-top: -80px;">
			<h6 class="text-center" style="font-weight: 400 !important;">@if($report->doctor->people->gender=="Femenino"){{ "Dra. " }}@else{{ "Dr. " }}@endif{{ $report->doctor->people->name." ".$report->doctor->people->first_lastname." ".$report->doctor->people->second_lastname }}<br><span class="text-uppercase">{{ $report->doctor->profession->name }}</span><br>{{ "RUT: ".number_format($report->doctor->people->dni, 0, ".", ".")."-".$report->doctor->people->verify_digit }}<br>{{ "S.I.S N° ".$report->doctor->number_doctor }}</h6>
		</div>
		@endif
	</div>

	<div id="footer">
		<p class="font-weight-bold text-uppercase">No autorizo cambios de prescripción</p>
	</div>

	<div id="content">

		<div class="w-100 border-dark">
			<p class="mb-2">Fecha: {{ $report->created_at->format('d/m/Y') }}</p>
		</div>

		<div class="w-100 mb-4 border-dark">
			<table class="table mt-2">
				<tbody>
					<tr>
						<td>Nombre Paciente: {{ $report->patient->people->name." ".$report->patient->people->first_lastname." ".$report->patient->people->second_lastname }}</td>
						<td>Edad: {{ age(date('Y-m-d', strtotime($report->patient->people->birthday))) }}</td>
					</tr>
					<tr>
						<td>RUT: {{ number_format($report->patient->people->dni, 0, ".", ".")."-".$report->patient->people->verify_digit }}</td>
						<td>Comuna: @if(!is_null($report->patient->people->commune)){{ $report->patient->people->commune->name }}@else{{ "No Ingresado" }}@endif</td>
					</tr>
					<tr>
						<td colspan="2">Dirección: {{ $report->patient->people->address }}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="w-100 mb-3">
			<p class="mb-1">Ref:</p>
			<div class="pl-5">
				{!! $report->recipe !!}
			</div>
		</div>

		<div class="w-100">
			<p class="text-center mb-0">
				<img src="{{ public_path('/admins/img/doctors/'.$report->doctor->signature) }}" style="max-width: 150px;">
			</p>
			@if(!is_null($report->doctor))
			<h6 class="text-center" style="font-weight: 400 !important;">@if($report->doctor->people->gender=="Femenino"){{ "Dra. " }}@else{{ "Dr. " }}@endif{{ $report->doctor->people->name." ".$report->doctor->people->first_lastname." ".$report->doctor->people->second_lastname }}<br><span class="text-uppercase">{{ $report->doctor->profession->name }}</span><br>{{ "RUT: ".number_format($report->doctor->people->dni, 0, ".", ".")."-".$report->doctor->people->verify_digit }}</h6>
			@endif
		</div>
	</div>

</body>
</html>