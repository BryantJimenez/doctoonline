@extends('layouts.web-admin')

@section('title', 'Editar Informe')

@section('title.header', 'Bienvenido al Sistema Docto Online')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/uploader/jquery.dm-uploader.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/uploader/styles.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="ftco-section py-0">
    <div class="container py-1">
        <div class="row minh-475">
            <div class="col-12 bg-white mx-auto">
                <div class="row">
                    <div class="col-12">
                        <p class="h5 text-primary text-uppercase font-weight-bold mt-3"><img src="{{ asset('/web/img/cruz.png') }}" class="mr-2" height="30" width="30"> Informe Medico</p>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('reports.edit', ['slug' => $report->slug]) }}" class="btn @if(is_null($phase)) btn-primary @else btn-dark @endif rounded-0 text-uppercase mt-2 py-xl-2">Consulta</a>
                        <a href="{{ route('reports.edit', ['slug' => $report->slug, 'phase' => 'segundo']) }}" class="btn @if(!is_null($phase) && $phase=="segundo") btn-primary @else btn-dark @endif rounded-0 text-uppercase mt-2 py-xl-2">Revisión</a>
                        <a href="{{ route('reports.edit', ['slug' => $report->slug, 'phase' => 'tercero']) }}" class="btn @if(!is_null($phase) && $phase=="tercero") btn-primary @else btn-dark @endif rounded-0 text-uppercase mt-2 py-xl-2">Ordenes y Examenes</a>
                        <a href="{{ route('reports.edit', ['slug' => $report->slug, 'phase' => 'cuarto']) }}" class="btn @if(!is_null($phase) && $phase=="cuarto") btn-primary @else btn-dark @endif rounded-0 text-uppercase mt-2 py-xl-2">Recetas</a>
                        <a href="{{ route('reports.edit', ['slug' => $report->slug, 'phase' => 'quinto']) }}" class="btn @if(!is_null($phase) && $phase=="quinto") btn-primary @else btn-dark @endif rounded-0 text-uppercase mt-2 py-xl-2">Resultados Examenes</a>
                        <a href="{{ route('reports.edit', ['slug' => $report->slug, 'phase' => 'sexto']) }}" class="btn @if(!is_null($phase) && $phase=="sexto") btn-primary @else btn-dark @endif rounded-0 text-uppercase mt-2 py-xl-2">Informe Medico</a>
                    </div>
                </div>

                @if(is_null($phase))

                <form action="{{ route('reports.update.one', ['slug' => $report->slug]) }}" method="POST" id="formReport">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-12">
                            @include('admin.partials.errors')
                        </div>

                        <div class="form-group col-12">
                            <label class="col-form-label">Motivo de la Consulta<b class="text-danger">*</b></label>
                            <textarea class="form-control @error('reason') is-invalid @enderror" name="reason" required placeholder="Introduzca el motivo de la consulta" rows="2">{{ $report->reason }}</textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="card bg-yellow-light rounded-0">
                                <div class="card-body py-3">
                                    <div class="row mb-xl-1 mb-xl-1">
                                        <div class="col-12">
                                            <label class="col-form-label">Antecedentes Patológicos Personales del Paciente</label>
                                        </div>
                                        <div class="col-xl-2 col-12 mb-2">
                                            <select class="form-control @error('select_personal_history') is-invalid @enderror" name="select_personal_history" required>
                                                <option @if($report->select_personal_history=="No") selected @endif>No</option>
                                                <option @if($report->select_personal_history=="Si") selected @endif>Si</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-10 col-12 mb-2">
                                            <select class="form-control @error('disease_personal') is-invalid @enderror" name="disease_personal[]" @if($report->select_personal_history=="No") disabled @endif>
                                                <option value="">Seleccione Enfermedad Actual</option>
                                                @foreach($diseases as $disease)
                                                @if(!is_null($report->diseases) && count($report->diseases)>0)
                                                <option value="{{ $disease->slug }}"  @if($report->diseases[0]->disease_id==$disease->id) selected @endif>{{ $disease->name }}</option>
                                                @else
                                                <option value="{{ $disease->slug }}">{{ $disease->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <textarea class="form-control @error('personal_history') is-invalid @enderror" name="personal_history" @if($report->select_personal_history=="No") disabled @endif placeholder="Comentarios" rows="2">{{ $report->personal_history }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-xl-1 mb-xl-1">
                                        <div class="col-12">
                                            <label class="col-form-label">Antecedentes Patológicos Quirúrgicos</label>
                                        </div>
                                        <div class="col-xl-2 col-12 mb-2">
                                            <select class="form-control @error('select_surgical_history') is-invalid @enderror" name="select_surgical_history" required>
                                                <option @if($report->select_surgical_history=="No") selected @endif>No</option>
                                                <option @if($report->select_surgical_history=="Si") selected @endif>Si</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-10 col-12 mb-2">
                                            <select class="form-control @error('surgicals') is-invalid @enderror" name="surgicals[]" @if($report->select_surgical_history=="No") disabled @endif>
                                                <option value="">Seleccione Operación Quirúrgica</option>
                                                @foreach($operations as $operation)
                                                @if(!is_null($report->operations) && count($report->operations)>0)
                                                <option value="{{ $operation->slug }}" @if($report->operations[0]->id==$operation->id) selected @endif>{{ $operation->name }}</option>
                                                @else
                                                <option value="{{ $operation->slug }}">{{ $operation->name }}</option>
                                                @endif
                                                
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <textarea class="form-control @error('surgical_history') is-invalid @enderror" name="surgical_history" @if($report->select_surgical_history=="No") disabled @endif placeholder="Comentarios" rows="2">{{ $report->surgical_history }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-xl-1 mb-xl-1">
                                        <div class="col-12">
                                            <label class="col-form-label">Antecedentes Patológicos Familiares</label>
                                        </div>
                                        <div class="col-xl-2 col-12 mb-2">
                                            <select class="form-control @error('select_family_history') is-invalid @enderror" name="select_family_history" required>
                                                <option @if($report->select_family_history=="No") selected @endif>No</option>
                                                <option @if($report->select_family_history=="Si") selected @endif>Si</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-10 col-12 mb-2">
                                            <select class="form-control @error('disease_family') is-invalid @enderror" name="disease_family[]" @if($report->select_family_history=="No") disabled @endif>
                                                <option value="">Seleccione Enfermedad</option>
                                                @foreach($diseases as $disease)
                                                @if(!is_null($report->familiars) && count($report->familiars)>0)
                                                <option value="{{ $disease->slug }}" @if($report->familiars[0]->disease_id==$disease->id) selected @endif>{{ $disease->name }}</option>
                                                @else
                                                <option value="{{ $disease->slug }}">{{ $disease->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <textarea class="form-control @error('family_history') is-invalid @enderror" name="family_history" @if($report->select_family_history=="No") disabled @endif placeholder="Comentarios" rows="2">{{ $report->family_history }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-xl-1 mb-xl-1">
                                        <div class="col-12">
                                            <label class="col-form-label">Antecedentes Alérgicos</label>
                                        </div>
                                        <div class="col-xl-4 col-12 mb-2">
                                            <textarea class="form-control @error('medicines') is-invalid @enderror" name="medicines" placeholder="Medicamentos" rows="3">{{ $report->medicines }}</textarea>
                                        </div>
                                        <div class="col-xl-4 col-12 mb-2">
                                            <textarea class="form-control @error('foods') is-invalid @enderror" name="foods" placeholder="Alimentos" rows="3">{{ $report->foods }}</textarea>
                                        </div>
                                        <div class="col-xl-4 col-12 mb-2">
                                            <textarea class="form-control @error('others_allergies') is-invalid @enderror" name="others_allergies" placeholder="Otros" rows="3">{{ $report->others_allergies }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <p class="h5 text-primary"><img src="{{ asset('/web/img/cruz.png') }}" class="mr-1" height="25" width="25" alt="Logo"> Hábitos Toxicos</p>
                        </div>

                        <div class="col-12 mb-2">
                            <div class="card bg-yellow-light rounded-0">
                                <div class="card-body py-3">
                                    <div class="row mb-xl-1 mb-xl-1">
                                        <div class="col-xl-2 col-12 mb-2">
                                            <label class="col-form-label">Tabaco</label>
                                            <select class="form-control @error('tobacco') is-invalid @enderror" name="tobacco" required>
                                                <option @if($report->tobacco=="No") selected @endif>No</option>
                                                <option @if($report->tobacco=="Si") selected @endif>Si</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-5 col-12 mb-2">
                                            <label class="col-form-label">N° de Cigarros al Día</label>
                                            <input type="text" class="form-control int @error('number_cigarettes') is-invalid @enderror" name="number_cigarettes" @if($report->tobacco=="No") disabled @endif value="{{ $report->number_cigarettes }}">
                                        </div>
                                        <div class="col-xl-5 col-12 mb-2">
                                            <label class="col-form-label">Años de Fumador</label>
                                            <input type="text" class="form-control int @error('years_smoker') is-invalid @enderror" name="years_smoker" @if($report->tobacco=="No") disabled @endif value="{{ $report->years_smoker }}">
                                        </div>
                                        <div class="col-12">
                                            <p>Prevalencia del fumador: <span class="smoker_calc">{{ number_format(($report->number_cigarettes*$report->years_smoker)/20, 2, ".", "") }}</span></p>
                                        </div>
                                    </div>

                                    <div class="row mb-xl-1 mb-xl-1">
                                        <div class="col-xl-2 col-12 mb-2">
                                            <label class="col-form-label">Alcohol</label>
                                            <select class="form-control @error('alcohol') is-invalid @enderror" name="alcohol" required>
                                                <option @if($report->alcohol=="No") selected @endif>No</option>
                                                <option @if($report->alcohol=="Si") selected @endif>Si</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-5 col-12 mb-2">
                                            <label class="col-form-label">Litros al Día</label>
                                            <input type="text" class="form-control int @error('number_liters') is-invalid @enderror" name="number_liters" @if($report->alcohol=="No") disabled @endif value="{{ $report->number_liters }}">
                                        </div>
                                        <div class="col-xl-5 col-12 mb-2">
                                            <label class="col-form-label">Años de Consumo</label>
                                            <input type="text" class="form-control int @error('years_taker') is-invalid @enderror" name="years_taker" @if($report->alcohol=="No") disabled @endif value="{{ $report->years_taker }}">
                                        </div>
                                    </div>

                                    <div class="row mb-xl-1 mb-xl-1">
                                        <div class="col-xl-2 col-12 mb-2">
                                            <label class="col-form-label">Drogas</label>
                                            <select class="form-control @error('drugs') is-invalid @enderror" name="drugs" required>
                                                <option @if($report->drugs=="No") selected @endif>No</option>
                                                <option @if($report->drugs=="Si") selected @endif>Si</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-10 col-12 mb-2">
                                            <label class="col-form-label">Años de Consumo</label>
                                            <input type="text" class="form-control int @error('years_consumption') is-invalid @enderror" name="years_consumption" @if($report->drugs=="No") disabled @endif value="{{ $report->years_consumption }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="col-form-label">Indique Cuales Drogas</label>
                                            <textarea class="form-control @error('indicate_drugs') is-invalid @enderror" name="indicate_drugs" @if($report->drugs=="No") disabled @endif placeholder="Indique alguna droga" rows="2">{{ $report->indicate_drugs }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label class="col-form-label">Historia de la Enfermedad Actual<b class="text-danger">*</b></label>
                            <textarea class="form-control @error('disease_current') is-invalid @enderror" name="disease_current" placeholder="Introduzca si existe alguna enfermad actual" rows="5">{{ $report->disease_current }}</textarea>
                        </div>

                        <div class="form-group d-flex justify-content-end col-12">
                            <a href="{{ route('search') }}" class="btn btn-danger rounded mr-2">Salir</a>
                            <button type="submit" class="btn btn-primary rounded" action="report">Guardar y Siguiente</button>
                        </div>
                    </div>
                </form>

                @elseif($phase=="segundo")

                <form action="{{ route('reports.update.two', ['slug' => $report->slug]) }}" method="POST" id="formReportTwo">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-12">
                            @include('admin.partials.errors')
                        </div>

                        <div class="col-12">
                            <p class="h5 text-primary"><img src="{{ asset('/web/img/cruz.png') }}" class="mr-1" height="25" width="25"> Examen Físico</p>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="card bg-orange-light rounded-0">
                                <div class="card-body py-3">
                                    <div class="row mb-xl-1 mb-xl-1">
                                        <div class="col-xl-6 col-12 mb-2">
                                            <div class="row">
                                                <div class="col-xl-5 col-12">
                                                    <p class="text-xl-right text-dark mb-0 mt-1">Peso</p>
                                                </div>
                                                <div class="col-xl-7 col-12">
                                                    <input type="text" class="form-control weight @error('weight') is-invalid @enderror" name="weight" required value="{{ $report->weight }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="text-dark mb-0 mt-1">Sexo del Paciente: <span class="text-primary">{{ $report->patient->people->gender }}</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-2">
                                            <div class="row">
                                                <div class="col-xl-5 col-12">
                                                    <p class="text-xl-right text-dark mb-0 mt-1">Altura</p>
                                                </div>
                                                <div class="col-xl-7 col-12">
                                                    <input type="text" class="form-control height @error('height') is-invalid @enderror" name="height" required value="{{ $report->height }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="text-dark mb-0 mt-1">Calculo IMC: <span class="text-primary imc">{{ number_format($report->weight/$report->height*$report->height, 2, ".", ",")." Kg/M2" }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="card bg-orange-light rounded-0">
                                <div class="card-body py-3">
                                    <div class="row mb-xl-1 mb-xl-1">
                                        <div class="col-xl-6 col-12 mb-2">
                                            <div class="row">
                                                <div class="col-xl-5 col-12">
                                                    <p class="text-xl-right text-dark mb-0 mt-1">Temperatura</p>
                                                </div>
                                                <div class="col-xl-7 col-12">
                                                    <input type="text" class="form-control temperature @error('temperature') is-invalid @enderror" name="temperature" required value="{{ $report->temperature }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-2">
                                            <div class="row">
                                                <div class="col-xl-5 col-12">
                                                    <p class="text-xl-right text-dark mb-0 mt-1">Pulso</p>
                                                </div>
                                                <div class="col-xl-7 col-12">
                                                    <input type="text" class="form-control int @error('pulse') is-invalid @enderror" name="pulse" required value="{{ $report->pulse }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-2">
                                            <div class="row">
                                                <div class="col-xl-5 col-12">
                                                    <p class="text-xl-right text-dark mb-0 mt-1">Presión Art. Sistolica</p>
                                                </div>
                                                <div class="col-xl-7 col-12">
                                                    <input type="text" class="form-control pressure @error('systolic_pressure') is-invalid @enderror" name="systolic_pressure" required value="{{ $report->systolic_pressure }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-2">
                                            <div class="row">
                                                <div class="col-xl-5 col-12">
                                                    <p class="text-xl-right text-dark mb-0">Frec. Respiratoria</p>
                                                </div>
                                                <div class="col-xl-7 col-12">
                                                    <input type="text" class="form-control frequency @error('frequency') is-invalid @enderror" name="frequency" required value="{{ $report->frequency }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-2">
                                            <div class="row">
                                                <div class="col-xl-5 col-12">
                                                    <p class="text-xl-right text-dark mb-0 mt-1">Presión Art. Distolica</p>
                                                </div>
                                                <div class="col-xl-7 col-12">
                                                    <input type="text" class="form-control pressure @error('dystolic_pressure') is-invalid @enderror" name="dystolic_pressure" required value="{{ $report->dystolic_pressure }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <div class="card bg-orange-light rounded-0">
                                <div class="card-body py-3">
                                    <div class="row">
                                        <div class="col-xl-6 col-12">
                                            <label class="text-dark col-form-label">Mucosas</label>
                                            <textarea class="form-control @error('mucous') is-invalid @enderror" name="mucous" placeholder="Introduzca una explicación" rows="2">{{ $report->mucous }}</textarea>
                                        </div>

                                        <div class="col-xl-6 col-12">
                                            <label class="text-dark col-form-label">Cabeza y Cuello</label>
                                            <textarea class="form-control @error('head_neck') is-invalid @enderror" name="head_neck" placeholder="Introduzca una explicación" rows="2">{{ $report->head_neck }}</textarea>
                                        </div>

                                        <div class="col-xl-6 col-12">
                                            <label class="text-dark col-form-label">Sist. Respiratorio</label>
                                            <textarea class="form-control @error('respiratory') is-invalid @enderror" name="respiratory" placeholder="Introduzca una explicación" rows="2">{{ $report->respiratory }}</textarea>
                                        </div>

                                        <div class="col-xl-6 col-12">
                                            <label class="text-dark col-form-label">Sist. Cardiovascular</label>
                                            <textarea class="form-control @error('cardiovascular') is-invalid @enderror" name="cardiovascular" placeholder="Introduzca una explicación" rows="2">{{ $report->cardiovascular }}</textarea>
                                        </div>

                                        <div class="col-xl-6 col-12">
                                            <label class="text-dark col-form-label">Abdomen</label>
                                            <textarea class="form-control @error('abdomen') is-invalid @enderror" name="abdomen" placeholder="Introduzca una explicación" rows="2">{{ $report->abdomen }}</textarea>
                                        </div>

                                        <div class="col-xl-6 col-12">
                                            <label class="text-dark col-form-label">Otros</label>
                                            <textarea class="form-control @error('others_exams') is-invalid @enderror" name="others_exams" placeholder="Introduzca una explicación" rows="2">{{ $report->others_exams }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-end col-12">
                            <a href="{{ route('search') }}" class="btn btn-danger rounded mr-2">Salir</a>
                            <button type="submit" class="btn btn-primary rounded" action="report">Guardar y Siguiente</button>
                        </div>
                    </div>
                </form>

                @elseif($phase=="tercero")

                <form action="{{ route('reports.update.three', ['slug' => $report->slug]) }}" method="POST" id="formReportThree">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-12">
                            @include('admin.partials.errors')
                        </div>

                        <div class="form-group col-12">
                            <label class="col-form-label">Orden Médica</label>
                            <textarea class="form-control @error('order') is-invalid @enderror" name="order" placeholder="Introduzca la orden médica" rows="4">{{ $report->order }}</textarea>
                        </div>

                        <div class="form-group col-12 d-flex justify-content-between">
                            <p class="h5 text-primary"><img src="{{ asset('/web/img/cruz.png') }}" class="mr-1" height="25" width="25"> Examenes</p>
                            <button type="button" class="btn btn-primary rounded py-xl-2" id="addExam">Agregar Examen</button>
                        </div>

                        <div class="form-group col-12">
                            <p class="h5 text-center text-primary font-weight-bold">Examenes que el Paciente debe Realizarse</p>
                            <select class="form-control select2 @error('exam_id') is-invalid @enderror" name="exam_id[]" multiple id="selectExam">
                                <option value="">Seleccione</option>
                                @if(!is_null($report->exams) && count($report->exams)>0)
                                {!! selectReport($exams, $report->exams) !!}
                                @else
                                @foreach($exams as $exam)
                                <option value="{{ $exam->slug }}">{{ $exam->subcategory->category->name." | ".$exam->subcategory->name." | ".$exam->type->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group d-flex justify-content-end col-12">
                            <a href="{{ route('search') }}" class="btn btn-danger rounded mr-2">Salir</a>
                            <button type="submit" class="btn btn-primary rounded" action="report">Guardar</button>
                        </div>
                    </div>
                </form>

                @elseif($phase=="cuarto")

                <form action="{{ route('reports.update.four', ['slug' => $report->slug]) }}" method="POST" id="formReportFour">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-12">
                            @include('admin.partials.errors')
                        </div>

                        <div class="form-group col-12">
                            <label class="col-form-label">Receta Médica</label>
                            <textarea class="form-control @error('recipe') is-invalid @enderror" name="recipe" placeholder="Introduzca la receta médica" rows="6">{{ $report->recipe }}</textarea>
                        </div>

                        <div class="form-group d-flex justify-content-end col-12">
                            <a href="{{ route('search') }}" class="btn btn-danger rounded mr-2">Salir</a>
                            <button type="submit" class="btn btn-primary rounded" action="report">Guardar</button>
                        </div>
                    </div>
                </form>

                @elseif($phase=="quinto")

                <form action="{{ route('reports.update.five', ['slug' => $report->slug]) }}" method="POST" id="formReportFive">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-12">
                            @include('admin.partials.errors')
                        </div>

                        @forelse($report->exams as $exam)
                        <div class="form-group col-12">
                            <label class="col-form-label">Resultados de Examenes Médicos</label>
                            <div class="exams py-3 px-4">
                                <p class="h5 font-weight-bold text-blue-dark mb-0">{{ $exam->exam->subcategory->category->name." | ".$exam->exam->subcategory->name." | ".$exam->exam->type->name }}</p>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label class="col-form-label">Describa el Resultado<b class="text-danger">*</b></label>
                            <textarea class="form-control" name="results[]" required placeholder="Introduzca el resultado" rows="4">{{ $exam->results }}</textarea>
                        </div>

                        <div class="form-group col-12">
                            <label class="col-form-label">Adjuntar Imagenes (Opcional)</label>
                            <div class="dm-uploader bg-white text-center py-4 px-2" exam="{{ $exam->exam->slug }}">
                                <h3 class="text-muted">Arrastra aquí tus imágenes</h3>
                                <div class="btn btn-primary btn-block rounded">
                                    <span>Selecciona un archivo</span>
                                    <input type="file" title="Selecciona un archivo" multiple>
                                </div>
                            </div>
                            <p class="response text-left py-0" exam="{{ $exam->exam->slug }}"></p>
                        </div>

                        <div class="col-12">
                            <div class="row images" exam="{{ $exam->exam->slug }}">
                                @foreach($report->images as $image)
                                @if($exam->exam_id==$image->exam_id)
                                <div class="form-group col-lg-2 col-md-3 col-sm-6 col-12" element="{{ $num }}">
                                    <img src="{{ asset('/admins/img/reports/'.$image->image) }}" class="rounded img-fluid" alt="Imagen del vehículo">
                                    <button type="button" class="btn btn-danger btn-sm btn-circle btn-absolute-right removeImage" image="{{ $num }}" urlImage="{{ asset('/admins/img/reports/'.$image->image) }}"><i class="fa fa-trash"></i></button>
                                </div>
                                @php $num++ @endphp
                                @endif
                                @endforeach
                            </div>
                        </div>

                        @if(!$loop->last)
                        <div class="col-12">
                            <hr class="border-primary my-1">
                        </div>
                        @endif

                        @empty
                        <div class="col-12">
                            <p class="h4 text-danger text-center py-5">No hay examenes que deban realizarse</p>
                        </div>
                        @endforelse

                        <input type="hidden" id="slug" value="{{ $report->slug }}">

                        <div class="form-group d-flex justify-content-end col-12">
                            <a href="{{ route('search') }}" class="btn btn-danger rounded mr-2">Salir</a>
                            <button type="submit" class="btn btn-primary rounded" action="report">Guardar</button>
                        </div>
                    </div>
                </form>

                @elseif($phase=="sexto")

                <form action="{{ route('reports.update.six', ['slug' => $report->slug]) }}" method="POST" id="formReportSix">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-12">
                            @include('admin.partials.errors')
                        </div>

                        <div class="form-group col-12">
                            <label class="col-form-label">Informe Médico<b class="text-danger">*</b></label>
                            <textarea class="form-control @error('report') is-invalid @enderror" name="report" required placeholder="Introduzca el informe médico" rows="7">{{ $report->report }}</textarea>
                        </div>

                        <div class="form-group d-flex justify-content-end col-12">
                            <a href="{{ route('search') }}" class="btn btn-danger rounded mr-2">Salir</a>
                            <button type="submit" class="btn btn-primary rounded" action="report">Guardar</button>
                        </div>
                    </div>
                </form>

                @endif
            </div>
        </div>
    </div>
</section>

@if(!is_null($phase) && $phase=="tercero")
<div class="modal fade" id="addExamModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Examen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
                <div class="row">
                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
                        <label class="col-form-label">Categoría<b class="text-danger">*</b></label>
                        <select class="form-control" name="categoryExam" id="selectCategories">
                            <option value="">Seleccione</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
                        <label class="col-form-label">Subcategoría<b class="text-danger">*</b></label>
                        <select class="form-control" name="subcategoryExam" disabled id="selectSubcategories">
                            <option value="">Seleccione</option>
                        </select>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
                        <label class="col-form-label">Tipo<b class="text-danger">*</b></label>
                        <select class="form-control" name="typeExam">
                            <option value="">Seleccione</option>
                            @foreach($types as $type)
                            <option value="{{ $type->slug }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
                        <label class="col-form-label">Código Fonasa</label>
                        <input type="text" class="form-control" disabled id="code">
                    </div>

                    <div class="form-group col-12">
                        <p class="text-danger d-none" id="examErrors"></p>
                    </div>
                </div>

                <div class="alert alert-success d-none" id="examAlertSuccess">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        <li>Se ha registrado el examen exitoamente.</li>
                    </ul>
                </div>
                <div class="alert alert-danger d-none" id="examAlertDanger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        <li>Ha ocurrido un error, intentelo denuevo.</li>
                    </ul>
                </div>
                <div class="alert alert-warning d-none" id="examAlertExist">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        <li>El examen ya se encuentra registrado.</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary rounded" id="submitExam">Guardar</button>
                <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/uploader/jquery.dm-uploader.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection