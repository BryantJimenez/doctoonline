@extends('layouts.web')

@section('title', 'Agenda')

@section('links')
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="ftco-section py-0" id="banner-about">
	<div class="row mx-0">
		<div class="col-12 px-0">
			<img src="{{ image_exist('/web/img/', 'imagen-agenda.png') }}" class="w-100" alt="Banner de agenda">
		</div>
	</div>
</section>

<section class="ftco-section bg-light shadow py-0">
	<div class="container">
		<div class="row">
			<div class="col-12 d-lg-flex justify-content-lg-center pt-4">
				<p class="h5 text-primary font-weight-bold text-phase mr-4">En Simples Pasos:</p>
				<div class="d-lg-inline-flex diary-phases">
					<div class="active">
						<p class="text-white bg-green font-weight-bold pl-4 pr-5 ml-4 mb-4 mb-xl-0">Identifición</p>
					</div>
					<div @if(session()->has('diary') && session('diary')[0]['phase']>=1) class="active" @endif>
						<p class="text-white @if(session()->has('diary') && session('diary')[0]['phase']>=1) bg-green @else bg-grey @endif font-weight-bold pl-4 pr-5 ml-4 mb-4 mb-xl-0">Área y Profesional</p>
					</div>
					<div @if(session()->has('diary') && session('diary')[0]['phase']>=2) class="active" @endif>
						<p class="text-white @if(session()->has('diary') && session('diary')[0]['phase']>=2) bg-green @else bg-grey @endif font-weight-bold pl-4 pr-5 ml-4 mb-4 mb-xl-0">Fecha y Hora</p>
					</div>
					<div @if(session()->has('diary') && session('diary')[0]['phase']>=3) class="active" @endif>
						<p class="text-white @if(session()->has('diary') && session('diary')[0]['phase']>=3) bg-green @else bg-grey @endif font-weight-bold pl-4 pr-5 ml-4 mb-4 mb-xl-0">Pago y Confirmación</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section py-0" id="diary-form">
	<div class="row mx-0">
		<div class="col-12 mt-1 mb-5">
			@if(is_null($phase))
			<div class="card bg-light shadow mx-xl-5 px-lg-5">
				<div class="card-body">
					<form action="{{ route('diary.store') }}" method="POST" class="form" id="formDiary">
						@csrf
						<div class="row">
							<div class="col-12 mb-xl-4">
								@include('admin.partials.errors')
							</div>

							<div class="col-12 mb-xl-4">
								<div class="row">
									<label class="h6 col-xl-2 col-lg-2 col-md-3 col-12 small text-uppercase font-weight-bold pt-3">RUT del Paciente:</label>
									<div class="form-group col-xl-5 col-lg-5 col-md-9 col-12">
										<div class="input-group">
											<input class="form-control rounded-1 number @error('dni') is-invalid @enderror" type="text" name="dni" required minlength="2" value="{{ old('dni') }}" id="valid-dni">
											<div class="input-group-append">
												<span class="input-group-text pt-0">-</span>
												<input class="form-control input-group-text bg-white text-left rounded-1 @error('verify_digit') is-invalid @enderror" type="text" name="verify_digit" required minlength="1" maxlength="1" value="{{ old('verify_digit') }}" id="valid-dv">
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
								<div class="row">
									<label class="h6 col-xl-2 col-lg-3 col-md-3 col-12 small font-weight-bold pt-3">Nombre:</label>
									<div class="form-group col-xl-10 col-lg-9 col-md-9 col-12">
										<input class="form-control rounded-1 exist-name @error('name') is-invalid @enderror" type="text" name="name" required value="{{ old('name') }}">
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
								<div class="row">
									<label class="h6 col-xl-2 col-lg-3 col-md-3 col-12 small font-weight-bold pt-3">Apellido:</label>
									<div class="form-group col-xl-10 col-lg-9 col-md-9 col-12">
										<input class="form-control rounded-1 exist-lastname @error('lastname') is-invalid @enderror" type="text" name="lastname" required value="{{ old('lastname') }}">
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
								<div class="row">
									<label class="h6 col-xl-2 col-lg-3 col-md-3 col-12 small font-weight-bold pt-3">Email:</label>
									<div class="form-group col-xl-10 col-lg-9 col-md-9 col-12">
										<input class="form-control rounded-1 exist-email @error('email') is-invalid @enderror" type="email" name="email" required value="{{ old('email') }}" id="email">
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
								<div class="row">
									<label class="h6 col-xl-2 col-lg-3 col-md-3 col-12 small font-weight-bold pt-3">Género:</label>
									<div class="form-group col-xl-10 col-lg-9 col-md-9 col-12">
										<select class="form-control rounded-1 exist-gender @error('gender') is-invalid @enderror" name="gender" required>
											<option @if(old('gender')=="Masculino") selected @endif>Masculino</option>
											<option @if(old('gender')=="Femenino") selected @endif>Femenino</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
								<div class="row">
									<label class="col-xl-3 col-lg-3 col-md-4 col-12 small font-weight-bold pt-2">Fecha de Nacimiento:</label>
									<div class="form-group col-xl-9 col-lg-9 col-md-8 col-12">
										<input class="form-control rounded-1 exist-birthday date @error('birthday') is-invalid @enderror" type="text" name="birthday" required value="{{ old('birthday') }}" id="flatpickr">
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
								<div class="row">
									<label class="col-xl-2 col-lg-3 col-md-3 col-12 small font-weight-bold pt-3">Teléfono:</label>
									<div class="form-group col-xl-10 col-lg-9 col-md-9 col-12">
										<input class="form-control rounded-1 exist-phone @error('phone') is-invalid @enderror" type="text" name="phone" required value="{{ old('phone') }}">
									</div>
								</div>
							</div>

							<div class="form-group text-right col-12">
								<button type="submit" class="btn btn-lg btn-orange-dark text-white font-weight-bold rounded px-5 py-2" action="diary">Continuar <i class="fa fa-angle-right ml-3 pt-1"></i></button>
							</div> 
						</div>
					</form>
				</div>
			</div>

			@elseif(session()->has('diary') && session('diary')[0]['phase']==1)

			<div class="card bg-light shadow mx-xl-5 px-lg-5">
				<div class="card-body">
					<form action="{{ route('diary.store.two') }}" method="POST" class="form" id="formDiaryTwo">
						@csrf
						<div class="row">
							<div class="col-12 mb-xl-4">
								@include('admin.partials.errors')
							</div>

							<div class="col-12 mb-xl-4">
								<div class="row">
									<label class="col-xl-2 col-lg-2 col-md-3 col-12 small font-weight-bold pt-2">Seleccione Tipo de Servicio:</label>
									<div class="form-group col-xl-5 col-lg-5 col-md-6 col-12">
										<select class="form-control rounded-1 @error('service_id') is-invalid @enderror" name="service_id" required id="selectServiceDiary">
											<option value="">Seleccione</option>
											@foreach($services as $service)
											<option @if(old('service_id')==$service->slug) selected @endif value="{{ $service->slug }}" type="{{ $service->type }}">{{ $service->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-12 d-none" id="serviceTypeDoctor">
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
										<div class="row">
											<label class="col-xl-3 col-lg-3 col-md-4 col-12 small font-weight-bold pt-2">Seleccione Especialidad:</label>
											<div class="form-group col-xl-9 col-lg-9 col-md-8 col-12">
												<select class="form-control rounded-1 @error('specialty_id') is-invalid @enderror" name="specialty_id" required id="selectSpecialties">
													<option value="">Seleccione</option>
													@foreach($specialties as $specialty)
													<option @if(old('specialty_id')==$specialty->slug) selected @endif value="{{ $specialty->slug }}">{{ $specialty->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
										<div class="row">
											<label class="col-xl-3 col-lg-3 col-md-4 col-12 small font-weight-bold pt-2">Médico Especialista:</label>
											<div class="form-group col-xl-9 col-lg-9 col-md-8 col-12">
												<select class="form-control rounded-1 @error('doctor_id') is-invalid @enderror" name="doctor_id" required id="selectDoctors">
													<option value="">Seleccione</option>
												</select>
											</div>
										</div>
									</div>

									<div class="col-12  mb-3" id="cardDoctor">
										<div class="row">
											<div class="col-xl-3 col-lg-3 col-md-4 col-12">
												<img src="{{ image_exist('/admins/img/template/', 'imagen.jpg') }}" class="w-100 rounded" id="photoDoctor" alt="Foto de Médico">
											</div>

											<div class="col-xl-9 col-lg-9 col-md-8 col-12">
												<div class="card border-0">
													<div class="card-body bg-white py-2">
														<p class="font-weight-bold mb-1"><span class="h5 text-muted font-weight-bold" id="nameDoctor"></span></p>
														<div class="font-weight-bold" id="descriptionDoctor"></div>
														<img src="{{ asset('/web/img/superintendencia.png') }}" width="200" alt="Logo de Superintendencia de Salud de Chile">
														<div class="text-yellow" id="starsDoctor"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 d-none" id="serviceTypeExam">
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
										<div class="row">
											<label class="col-xl-3 col-lg-3 col-md-4 col-12 small font-weight-bold pt-2">Seleccione Categoría:</label>
											<div class="form-group col-xl-9 col-lg-9 col-md-8 col-12">
												<select class="form-control rounded-1 @error('category_id') is-invalid @enderror" name="category_id" required id="selectCategories">
													<option value="">Seleccione</option>
													@foreach($categories as $category)
													<option @if(old('category_id')==$category->slug) selected @endif value="{{ $category->slug }}">{{ $category->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-xl-4">
										<div class="row">
											<label class="col-xl-3 col-lg-3 col-md-4 col-12 small font-weight-bold pt-2">Seleccione Subcategoría:</label>
											<div class="form-group col-xl-9 col-lg-9 col-md-8 col-12">
												<select class="form-control rounded-1 @error('subcategory_id') is-invalid @enderror" name="subcategory_id" required id="selectSubcategories">
													<option value="">Seleccione</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group text-right col-12">
								<button type="submit" class="btn btn-lg btn-orange-dark text-white font-weight-bold rounded px-5 py-2" action="diary">Continuar <i class="fa fa-angle-right ml-3 pt-1"></i></button>
							</div> 
						</div>
					</form>
				</div>
			</div>

			@elseif(session()->has('diary') && session('diary')[0]['phase']==2)

			<div class="card bg-light shadow mx-xl-5 px-lg-5">
				<div class="card-body">
					<form action="{{ route('diary.store.three') }}" method="POST" class="form" id="formDiaryThree">
						@csrf
						<div class="row">
							<div class="col-12 mb-xl-4">
								@include('admin.partials.errors')
							</div>

							<div class="col-xl-5 col-lg-6 col-md-6 col-12 mx-auto mb-xl-4">
								<div class="row">
									<label class="col-xl-3 col-lg-3 col-md-4 col-12 small font-weight-bold pt-2">Seleccione Fecha:</label>
									<div class="form-group col-xl-9 col-lg-9 col-md-8 col-12">
										<input class="form-control rounded-1 date @error('date') is-invalid @enderror" type="text" name="date" required value="{{ old('date') }}" id="selectDateDiary" service="{{ $service->slug }}" select="{{ $selected }}">
									</div>
								</div>
							</div>

							<div class="col-12" id="scheduleDiary">
								<p class="h5 text-primary text-center font-weight-bold">Horarios disponible para la fecha <span id="dateDiary">{{ date('d-m-Y') }}</span></p>
								<div class="row">
									<div class="col-xl-4 col-lg-6 col-md-9 col-12 mx-auto my-2">
										<div class="row" id="timeDiary">
											@forelse($times as $time)
											<div class="col-xl-4 col-lg-3 col-md-4 col-4">
												<p class="text-white text-center font-weight-bold @if($time['type']==1) bg-available @else bg-not-available @endif rounded p-1" type="{{ $time['type'] }}">{{ $time['time'] }}</p>
											</div>
											@empty
											<div class="col-12">
												<p class="h3 text-center text-danger font-weight-bold">No hay un horario disponible este día</p>
											</div>
											@endforelse
										</div>
									</div>
								</div>
							</div>

							<input type="hidden" name="time" id="inputTimeDiary">

							<div class="form-group text-right col-12">
								<button type="submit" class="btn btn-lg btn-orange-dark text-white font-weight-bold rounded px-5 py-2" disabled action="diary">Continuar <i class="fa fa-angle-right ml-3 pt-1"></i></button>
							</div> 
						</div>
					</form>
				</div>
			</div>

			@elseif(session()->has('diary') && session('diary')[0]['phase']==3)

			<div class="card bg-light shadow mx-xl-5 px-lg-5">
				<div class="card-body">
					<form action="{{ route('diary.store.four') }}" method="POST" class="form">
						@csrf
						<div class="row">
							@include('admin.partials.errors')

							<div class="col-12 text-center">
								<p class="h3 font-weight-bold mt-3">Pague en línea a travéz de Webpay Pago 100% seguro y rapido y en línea</p>
								<p class="h3 font-weight-bold mt-3 mb-4 mb-xl-5"><span class="text-primary">A Abonar:</span> {{ session('diary')[0]['service']->name }}: ${{ number_format($schedule->first()->price, 2, ",", ".") }} Pesos Chilenos</p>
							</div>

							<div class="col-xl-9 col-lg-9 col-md-10 col-12 text-center mx-auto mb-4 mb-xl-5">
								<img src="{{ image_exist('/web/img/', 'botonpago.png') }}" class="w-75 mb-xl-4" alt="Webpay Boton">
							</div>

							<div class="form-group text-right col-12">
								<button type="submit" class="btn btn-lg btn-orange-dark text-white font-weight-bold rounded px-5 py-2">Continuar <i class="fa fa-angle-right ml-3 pt-1"></i></button>
							</div> 
						</div>
					</form>
				</div>
			</div>

			@endif
		</div>
	</div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection