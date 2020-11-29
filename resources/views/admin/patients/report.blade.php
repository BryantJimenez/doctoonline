@extends('layouts.admin')

@section('title', 'Informe Médico')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos del Paciente</h3>
				</div>
				<div class="text-center user-info">
					<img src="{{ image_exist('/admins/img/users/', $report->patient->people->photo, true) }}" width="90" height="90" alt="Foto de perfil">
					<p class="">{{ $report->patient->people->name." ".$report->patient->people->first_lastname." ".$report->patient->people->second_lastname }}</p>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled">
							<li class="contacts-block__item">
								<i class="fa fa-id-card mr-3"></i> {{ number_format($report->patient->people->dni, 0, ".", ".")."-".$report->patient->people->verify_digit }}
							</li>
							<li class="contacts-block__item">
								<i class="fa fa-user mr-3"></i> {{ $report->patient->people->gender }}
							</li>
							<li class="contacts-block__item">
								<i class="fa fa-phone mr-3"></i> {{ $report->patient->people->celular }}
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>{{ date("d-m-Y", strtotime($report->patient->people->birthday)) }}
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>{!! state($report->patient->state) !!}
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos del Médico</h3>
				</div>
				<div class="text-center user-info">
					<img src="@if(!is_null($report->doctor)){{ image_exist('/admins/img/users/', $report->doctor->people->photo, true) }}@else{{ image_exist('/admins/img/users/', 'usuario.png', true) }}@endif" width="90" height="90" alt="Foto de perfil">
					<p class="">@if(!is_null($report->doctor)){{ $report->doctor->people->name." ".$report->doctor->people->first_lastname." ".$report->doctor->people->second_lastname }}@else{{ 'Desconocido' }}@endif</p>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled">
							<li class="contacts-block__item">
								<i class="fa fa-id-card mr-3"></i> @if(!is_null($report->doctor)){{ number_format($report->doctor->people->dni, 0, ".", ".")."-".$report->doctor->people->verify_digit }}@else{{ 'Desconocido' }}@endif
							</li>
							<li class="contacts-block__item">
								<i class="fa fa-user mr-3"></i> {{ $report->doctor->people->gender }}
							</li>
							<li class="contacts-block__item">
								<i class="fa fa-phone mr-3"></i> {{ $report->doctor->people->celular }}
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>@if(!is_null($report->doctor)){{ date("d-m-Y", strtotime($report->doctor->people->birthday)) }}@else{{ 'Desconocido' }}@endif
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>@if(!is_null($report->doctor)){!! state($report->doctor->state) !!}@else{{ 'Desconocido' }}@endif
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos de la Consulta</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Fecha de la Consulta:</b> {{ $report->created_at->format('d-m-Y') }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Motivo:</b> {{ $report->reason }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Presenta Antecedentes Patológicos Personales el Paciente?</b> {{ $report->select_personal_history }}</span>
							</li>

							@if($report->select_personal_history=="Si")
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Enfermedad Actual:</b> 
									@forelse($report->diseases as $disease)
									@if($loop->index!=0){{ ", " }}@endif
									{{ $disease->disease->name }}
									@empty
									{{ 'No Ingresado' }}
									@endforelse
								</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Descripción de la Enfermedad Actual:</b> @if(!empty($report->personal_history) && !is_null($report->personal_history)){{ $report->personal_history }}@else{{ "No Ingresada" }}@endif</span>
							</li>
							@endif

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Presenta Antecedentes Patológicos Quirúrgicos?</b> {{ $report->select_surgical_history }}</span>
							</li>

							@if($report->select_surgical_history=="Si")
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Operación Quirurgica:</b> 
									@forelse($report->operations as $operation)
									@if($loop->index!=0){{ ", " }}@endif
									{{ $operation->name }}
									@empty
									{{ 'No Ingresado' }}
									@endforelse
								</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Descripción de las Operaciones Quirurgicas:</b> @if(!empty($report->surgical_history) && !is_null($report->surgical_history)){{ $report->surgical_history }}@else{{ "No Ingresada" }}@endif</span>
							</li>
							@endif

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Presenta Antecedentes Patológicos Familiares?</b> {{ $report->select_family_history }}</span>
							</li>

							@if($report->select_family_history=="Si")
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Enfermedad del Familiar:</b> 
									@forelse($report->familiars as $familiar)
									@if($loop->index!=0){{ ", " }}@endif
									{{ $familiar->disease->name }}
									@empty
									{{ 'No Ingresado' }}
									@endforelse
								</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Descripción de la Enfermedad:</b> @if(!empty($report->family_history) && !is_null($report->family_history)){{ $report->family_history }}@else{{ "No Ingresada" }}@endif</span>
							</li>
							@endif

							@if((!is_null($report->medicines) && !empty($report->medicines)) || (!is_null($report->foods) && !empty($report->foods)) || (!is_null($report->others_allergies) && !empty($report->others_allergies)))
							<li class="contacts-block__item">
								<hr class="border-primary my-1">
							</li>

							<li class="contacts-block__item">
								<span class="h5 text-primary">Antecedentes Alérgicos</span>
							</li>

							@if(!is_null($report->medicines) && !empty($report->medicines))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Medicinas:</b> {{ $report->medicines }}</span>
							</li>
							@endif

							@if(!is_null($report->foods) && !empty($report->foods))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Alimentos:</b> {{ $report->foods }}</span>
							</li>
							@endif

							@if(!is_null($report->others_allergies) && !empty($report->others_allergies))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Otras:</b> {{ $report->others_allergies }}</span>
							</li>
							@endif
							@endif

							<li class="contacts-block__item">
								<hr class="border-primary my-1">
							</li>

							<li class="contacts-block__item">
								<span class="h5 text-primary">Hábitos Toxicos</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Tabaco:</b> {{ $report->tobacco }}</span>
							</li>

							@if($report->tobacco=="Si")
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>N° de Cigarros al Día:</b> @if(!empty($report->number_cigarettes) && !is_null($report->number_cigarettes)){{ $report->number_cigarettes }}@else{{ "No Ingresada" }}@endif</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Años de Fumador:</b> @if(!empty($report->years_smoker) && !is_null($report->years_smoker)){{ $report->years_smoker }}@else{{ "No Ingresada" }}@endif</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Prevalencia del fumador:</b> @if(!empty($report->years_smoker) && !is_null($report->years_smoker) && !empty($report->number_cigarettes) && !is_null($report->number_cigarettes)){{ number_format(($report->number_cigarettes*$report->years_smoker)/20, 2, ".", "") }}@else{{ "No Ingresada" }}@endif</span>
							</li>
							@endif

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Alcohol:</b> {{ $report->alcohol }}</span>
							</li>

							@if($report->alcohol=="Si")
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Litros al Día:</b> @if(!empty($report->number_liters) && !is_null($report->number_liters)){{ $report->number_liters }}@else{{ "No Ingresada" }}@endif</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Años de Consumo:</b> @if(!empty($report->years_taker) && !is_null($report->years_taker)){{ $report->years_taker }}@else{{ "No Ingresada" }}@endif</span>
							</li>
							@endif

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Drogas:</b> {{ $report->drugs }}</span>
							</li>

							@if($report->drugs=="Si")
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Años de Consumo:</b> @if(!empty($report->years_consumption) && !is_null($report->years_consumption)){{ $report->years_consumption }}@else{{ "No Ingresada" }}@endif</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cuales Drogas:</b> @if(!empty($report->indicate_drugs) && !is_null($report->indicate_drugs)){{ $report->indicate_drugs }}@else{{ "No Ingresada" }}@endif</span>
							</li>
							@endif

							<li class="contacts-block__item">
								<hr class="border-primary my-1">
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Historia de la Enfermedad Actual:</b> {{ $report->disease_current }}</span>
							</li>

							@if($report->phase>=2 && ($report->weight>0 || $report->height>0 || $report->temperature>0 || $report->systolic_pressure>0 || $report->dystolic_pressure>0 || $report->pulse>0 || $report->frequency>0))
							<li class="contacts-block__item">
								<hr class="border-primary my-1">
							</li>

							<li class="contacts-block__item">
								<span class="h5 text-primary">Examen Físico</span>
							</li>

							@if($report->weight>0)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Peso:</b> {{ $report->weight." Kgs" }}</span>
							</li>
							@endif

							@if($report->height>0)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Altura:</b> {{ $report->height." Mts" }}</span>
							</li>
							@endif

							@if($report->weight>0 && $report->height>0)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>IMC:</b> {{ number_format($report->weight/$report->height*$report->height, 2, ".", ",")." Kg/M2" }}</span>
							</li>
							@endif

							@if($report->temperature>0)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Temperatura:</b> {{ $report->temperature." °C" }}</span>
							</li>
							@endif

							@if($report->systolic_pressure>0)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Presión Art. Sistolica:</b> {{ $report->systolic_pressure }}</span>
							</li>
							@endif

							@if($report->dystolic_pressure>0)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Presión Art. Distolica:</b> {{ $report->dystolic_pressure }}</span>
							</li>
							@endif

							@if($report->pulse>0)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Pulso:</b> {{ $report->pulse }}</span>
							</li>
							@endif

							@if($report->frequency>0)
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Frec. Respiratoria:</b> {{ $report->frequency }}</span>
							</li>
							@endif

							@if((!is_null($report->mucous) && !empty($report->mucous)) || (!is_null($report->head_neck) && !empty($report->head_neck)) || (!is_null($report->respiratory) && !empty($report->respiratory)) || (!is_null($report->cardiovascular) && !empty($report->cardiovascular)) || (!is_null($report->abdomen) && !empty($report->abdomen)) || (!is_null($report->others_exams) && !empty($report->others_exams)))
							<li class="contacts-block__item">
								<hr class="border-primary my-1">
							</li>

							@if(!is_null($report->mucous) && !empty($report->mucous))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Mucosas:</b> {{ $report->mucous }}</span>
							</li>
							@endif

							@if(!is_null($report->head_neck) && !empty($report->head_neck))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cabeza y Cuello:</b> {{ $report->head_neck }}</span>
							</li>
							@endif

							@if(!is_null($report->respiratory) && !empty($report->respiratory))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Sist. Respiratorio:</b> {{ $report->respiratory }}</span>
							</li>
							@endif

							@if(!is_null($report->cardiovascular) && !empty($report->cardiovascular))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Sist. Cardiovascular:</b> {{ $report->cardiovascular }}</span>
							</li>
							@endif

							@if(!is_null($report->abdomen) && !empty($report->abdomen))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Abdomen:</b> {{ $report->abdomen }}</span>
							</li>
							@endif

							@if(!is_null($report->others_exams) && !empty($report->others_exams))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Otros:</b> {{ $report->others_exams }}</span>
							</li>
							@endif
							@endif

							@endif

							@if($report->phase>=3 || (!empty($report->order) && !is_null($report->order)))
							<li class="contacts-block__item">
								<hr class="border-primary my-1">
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Orden Médica:</b> @if(!empty($report->order) && !is_null($report->order)){{ $report->order }}@else{{ "No Ingresada" }}@endif</span>
							</li>

							@if(!is_null($report->exams) && count($report->exams)>0)
							<li class="contacts-block__item">
								<span class="h5 text-primary">Examenes</span>
							</li>

							@foreach($report->exams as $exam)
							<li class="contacts-block__item">
								<div class="row">
									<div class="col-12">
										<div class="bg-primary py-2 px-3">
											<p class="h5 font-weight-bold text-white mb-0">{{ $exam->exam->subcategory->category->name." | ".$exam->exam->subcategory->name." | ".$exam->exam->type->name }}</p>
										</div>
									</div>

									<div class="col-12 my-2">
										<p class="h6 text-black mb-0"><b>Resultado del Examen:</b> @empty($exam->results){{ "No Ingresado" }}@else{{ $exam->results }}@endempty</p>
									</div>

									@foreach($report->images as $image)
									@if($exam->exam_id==$image->exam_id)
									<div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-1">
										<img src="{{ image_exist('/admins/img/reports/', $image->image, false, false) }}" class="w-100" alt="Imagen de la consulta">
									</div>
									@endif
									@endforeach
								</div>
							</li>
							@endforeach
							@endif

							@endif

							@if($report->phase>=4 || (!empty($report->recipe) && !is_null($report->recipe)))
							<li class="contacts-block__item">
								<hr class="border-primary my-1">
							</li>
							
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Receta Médica:</b> @if(!empty($report->recipe) && !is_null($report->recipe)){{ $report->recipe }}@else{{ "No Ingresada" }}@endif</span>
							</li>
							@endif

							@if($report->phase==6)
							<li class="contacts-block__item">
								<hr class="border-primary my-1">
							</li>
							
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Informe Médico:</b> {{ $report->report }}</span>
							</li>
							@endif
						</ul>
					</div>

					<div class="form-group col-12">
						<div class="btn-group" role="group">
							@if(!is_null($report->recipe) && !empty($report->recipe))
							<a href="{{ route('informes.pdf.recipe', ['slug' => $report->slug]) }}" class="btn btn-primary" target="_blank">Receta PDF</a>
							@endif
							<a href="{{ route('pacientes.reports', ['slug' => $slug]) }}" class="btn btn-secondary">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection