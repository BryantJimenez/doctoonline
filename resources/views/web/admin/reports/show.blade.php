@extends('layouts.web-admin')

@section('title', 'Informe Médico')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('content')

<section class="ftco-section py-0">
    <div class="container py-1">
        <div class="row minh-475">
            <div class="col-12 bg-white mx-auto">
                <p class="pt-3">
                    <span class="h5 text-uppercase border-bottom-title text-primary">Informe Médico</span>
                </p>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Paciente:</b> {{ number_format($report->patient->people->dni, 0, ".", ".")."-".$report->patient->people->verify_digit." - ".$report->patient->people->name." ".$report->patient->people->first_lastname." ".$report->patient->people->second_lastname }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Médico Tratante:</b> @if(!is_null($report->doctor)){{ number_format($report->doctor->people->dni, 0, ".", ".")."-".$report->doctor->people->verify_digit." - ".$report->doctor->people->name." ".$report->doctor->people->first_lastname." ".$report->doctor->people->second_lastname }}@else{{ 'Desconocido' }}@endif</p>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Motivo:</b> {{ $report->reason }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Presenta Antecedentes Patológicos Personales el Paciente?</b> {{ $report->select_personal_history }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Presenta Antecedentes Patológicos Quirúrgicos?</b> {{ $report->select_surgical_history }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Presenta Antecedentes Patológicos Familiares?</b> {{ $report->select_family_history }}</p>
                    </div>

                    @if($report->select_personal_history=="Si")
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Enfermedad Actual:</b>
                            @forelse($report->diseases as $disease)
                            @if($loop->index!=0){{ ", " }}@endif
                            {{ $disease->disease->name }}
                            @empty
                            {{ 'No Ingresado' }}
                            @endforelse
                        </p>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Descripción de Enfermedad Actual:</b> @if(!empty($report->personal_history) && !is_null($report->personal_history)){{ $report->personal_history }}@else{{ "No Ingresada" }}@endif</p>
                    </div>
                    @endif

                    @if($report->select_surgical_history=="Si")
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Operación Quirurgica:</b> 
                            @forelse($report->operations as $operation)
                            @if($loop->index!=0){{ ", " }}@endif
                            {{ $operation->name }}
                            @empty
                            {{ 'No Ingresado' }}
                            @endforelse
                        </p>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Descripción de las Operaciones Quirurgicas:</b> @if(!empty($report->surgical_history) && !is_null($report->surgical_history)){{ $report->surgical_history }}@else{{ "No Ingresada" }}@endif</p>
                    </div>
                    @endif

                    @if($report->select_family_history=="Si")
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Enfermedad del Familiar:</b> 
                            @forelse($report->familiars as $familiar)
                            @if($loop->index!=0){{ ", " }}@endif
                            {{ $familiar->disease->name }}
                            @empty
                            {{ 'No Ingresado' }}
                            @endforelse
                        </p>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Descripción de la Enfermedad:</b> @if(!empty($report->family_history) && !is_null($report->family_history)){{ $report->family_history }}@else{{ "No Ingresada" }}@endif</p>
                    </div>
                    @endif

                    @if((!is_null($report->medicines) && !empty($report->medicines)) || (!is_null($report->foods) && !empty($report->foods)) || (!is_null($report->others_allergies) && !empty($report->others_allergies)))
                    <div class="col-12">
                        <hr class="border-primary my-1">
                    </div>

                    <div class="col-12 my-2">
                        <p class="h5 text-primary mb-0">Antecedentes Alérgicos</p>
                    </div>

                    @if(!is_null($report->medicines) && !empty($report->medicines))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Medicinas:</b> {{ $report->medicines }}</p>
                    </div>
                    @endif

                    @if(!is_null($report->foods) && !empty($report->foods))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Alimentos:</b> {{ $report->foods }}</p>
                    </div>
                    @endif

                    @if(!is_null($report->others_allergies) && !empty($report->others_allergies))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Otras:</b> {{ $report->others_allergies }}</p>
                    </div>
                    @endif
                    @endif

                    <div class="col-12">
                        <hr class="border-primary my-1">
                    </div>

                    <div class="col-12 my-2">
                        <p class="h5 text-primary mb-0">Hábitos Toxicos</p>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Tabaco:</b> {{ $report->tobacco }}</p>
                    </div>

                    @if($report->tobacco=="Si")
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>N° de Cigarros al Día:</b> @if(!empty($report->number_cigarettes) && !is_null($report->number_cigarettes)){{ $report->number_cigarettes }}@else{{ "No Ingresada" }}@endif</p>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Años de Fumador:</b> @if(!empty($report->years_smoker) && !is_null($report->years_smoker)){{ $report->years_smoker }}@else{{ "No Ingresada" }}@endif</p>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Prevalencia del fumador:</b> @if(!empty($report->years_smoker) && !is_null($report->years_smoker) && !empty($report->number_cigarettes) && !is_null($report->number_cigarettes)){{ number_format(($report->number_cigarettes*$report->years_smoker)/20, 2, ".", "") }}@else{{ "No Ingresada" }}@endif</p>
                    </div>
                    @endif

                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Alcohol:</b> {{ $report->alcohol }}</p>
                    </div>

                    @if($report->alcohol=="Si")
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Litros al Día:</b> @if(!empty($report->number_liters) && !is_null($report->number_liters)){{ $report->number_liters }}@else{{ "No Ingresada" }}@endif</p>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Años de Consumo:</b> @if(!empty($report->years_taker) && !is_null($report->years_taker)){{ $report->years_taker }}@else{{ "No Ingresada" }}@endif</p>
                    </div>
                    @endif

                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Drogas:</b> {{ $report->drugs }}</p>
                    </div>

                    @if($report->drugs=="Si")
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Años de Consumo:</b> @if(!empty($report->years_consumption) && !is_null($report->years_consumption)){{ $report->years_consumption }}@else{{ "No Ingresada" }}@endif</p>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Cuales Drogas:</b> @if(!empty($report->indicate_drugs) && !is_null($report->indicate_drugs)){{ $report->indicate_drugs }}@else{{ "No Ingresada" }}@endif</p>
                    </div>
                    @endif

                    <div class="col-12">
                        <hr class="border-primary my-1">
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Historia de la Enfermedad Actual:</b> {{ $report->disease_current }}</p>
                    </div>

                    @if($report->weight>0 || $report->height>0 || $report->temperature>0 || $report->systolic_pressure>0 || $report->dystolic_pressure>0 || $report->pulse>0 || $report->frequency>0)
                    <div class="col-12">
                        <hr class="border-primary my-1">
                    </div>

                    <div class="col-12 my-2">
                        <p class="h5 text-primary mb-0">Examen Físico</p>
                    </div>

                    @if($report->weight>0)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Peso:</b> {{ $report->weight." Kgs" }}</p>
                    </div>
                    @endif

                    @if($report->height>0)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Altura:</b> {{ $report->height." Mts" }}</p>
                    </div>
                    @endif

                    @if($report->weight>0 && $report->height>0)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>IMC:</b> @if($report->height>0){{ number_format($report->weight/$report->height*$report->height, 2, ".", ",")." Kg/M2" }}@else{{ "La altura no puede ser 0." }}@endif</p>
                    </div>
                    @endif

                    @if($report->temperature>0)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Temperatura:</b> {{ $report->temperature." °C" }}</p>
                    </div>
                    @endif

                    @if($report->systolic_pressure>0)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Presión Art. Sistolica:</b> {{ $report->systolic_pressure }}</p>
                    </div>
                    @endif

                    @if($report->dystolic_pressure>0)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Presión Art. Distolica:</b> {{ $report->dystolic_pressure }}</p>
                    </div>
                    @endif

                    @if($report->pulse>0)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Pulso:</b> {{ $report->pulse }}</p>
                    </div>
                    @endif

                    @if($report->frequency>0)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Frec. Respiratoria:</b> {{ $report->frequency }}</p>
                    </div>
                    @endif

                    @if((!is_null($report->mucous) && !empty($report->mucous)) || (!is_null($report->head_neck) && !empty($report->head_neck)) || (!is_null($report->respiratory) && !empty($report->respiratory)) || (!is_null($report->cardiovascular) && !empty($report->cardiovascular)) || (!is_null($report->abdomen) && !empty($report->abdomen)) || (!is_null($report->others_exams) && !empty($report->others_exams)))
                    @if(!is_null($report->mucous) && !empty($report->mucous))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Mucosas:</b> {{ $report->mucous }}</p>
                    </div>
                    @endif

                    @if(!is_null($report->head_neck) && !empty($report->head_neck))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Cabeza y Cuello:</b> {{ $report->head_neck }}</p>
                    </div>
                    @endif

                    @if(!is_null($report->respiratory) && !empty($report->respiratory))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Sist. Respiratorio:</b> {{ $report->respiratory }}</p>
                    </div>
                    @endif

                    @if(!is_null($report->cardiovascular) && !empty($report->cardiovascular))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Sist. Cardiovascular:</b> {{ $report->cardiovascular }}</p>
                    </div>
                    @endif

                    @if(!is_null($report->abdomen) && !empty($report->abdomen))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Abdomen:</b> {{ $report->abdomen }}</p>
                    </div>
                    @endif

                    @if(!is_null($report->others_exams) && !empty($report->others_exams))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Otros:</b> {{ $report->others_exams }}</p>
                    </div>
                    @endif

                    <div class="col-12">
                        <hr class="border-primary my-1">
                    </div>
                    @endif
                    @endif

                    @if(!empty($report->order) && !is_null($report->order))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Orden Médica:</b> @if(empty($report->order) && is_null($report->order)){{ "No Ingresada" }}@endif</p>
                        @if(!empty($report->order) && !is_null($report->order)){!! $report->order !!}@endif
                    </div>

                    @if(!is_null($report->exams) && count($report->exams)>0)
                    <div class="col-12 my-2">
                        <p class="h5 text-primary mb-0">Examenes</p>
                    </div>

                    @foreach($report->exams as $exam)
                    <div class="col-12">
                        <div class="exams py-2 px-3">
                            <p class="h5 font-weight-bold text-blue-dark mb-0">{{ $exam->exam->subcategory->category->name." | ".$exam->exam->subcategory->name." | ".$exam->exam->type->name }}</p>
                        </div>
                    </div>

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Resultado del Examen:</b> @if(!empty($exam->results) && !is_null($report->results)){{ "No Ingresado" }}@else{{ $exam->results }}@endif</p>
                    </div>

                    @foreach($report->images as $image)
                    @if($exam->exam_id==$image->exam_id)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-1">
                        <img src="{{ image_exist('/admins/img/reports/', $image->image, false, false) }}" class="w-100" alt="Imagen de la consulta">
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                    @endif

                    <div class="col-12">
                        <hr class="border-primary my-1">
                    </div>
                    @endif

                    @if(!empty($report->recipe) && !is_null($report->recipe))
                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Receta Médica:</b> @if(empty($report->recipe) && is_null($report->recipe)){{ "No Ingresada" }}@endif</p>
                        @if(!empty($report->recipe) && !is_null($report->recipe)){!! $report->recipe !!}@endif
                    </div>
                    @endif

                    <div class="col-12 my-2">
                        <p class="h6 text-black mb-0"><b>Informe Médico:</b> {{ $report->report }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                        <p class="h6 text-black"><b>Fecha de la Consulta:</b> {{ $report->created_at->format('d-m-Y') }}</p>
                    </div>

                    <div class="d-flex justify-content-center col-12 my-4">
                        @if(!is_null($report->recipe) && !empty($report->recipe))
                        <a href="{{ route('reports.pdf.recipe', ['slug' => $report->slug]) }}" class="btn btn-primary rounded text-uppercase px-5 mr-2" target="_blank">Receta PDF</a>
                        @endif
                        <a href="{{ route('search') }}" class="btn btn-secondary rounded text-uppercase px-5">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection