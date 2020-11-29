@extends('layouts.admin')

@section('title', 'Editar Servicio')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
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
						<h4>Editar Servicio</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('servicios.update', ['slug' => $service->slug]) }}" method="POST" class="form" id="formServiceEdit" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ $service->name }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Tipo<b class="text-danger">*</b></label>
									<select class="form-control @error('type') is-invalid @enderror" name="type" required>
										<option value="">Seleccione</option>
										<option @if($service->type==1) selected @endif value="1">Médicos</option>
										<option @if($service->type==2) selected @endif value="2">Examenes</option>
									</select>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Imagen<b class="text-danger">*</b></label>
									<input type="file" name="image" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/services/', $service->image) }}" />
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Banner<b class="text-danger">*</b></label>
									<input type="file" name="banner" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/services/', $service->banner) }}" />
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Título<b class="text-danger">*</b></label>
									<input class="form-control @error('title') is-invalid @enderror" type="text" name="title" required placeholder="Introduzca un título" value="{{ $service->title }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Descripción<b class="text-danger">*</b></label>
									<textarea class="form-control @error('description') is-invalid @enderror" required name="description" placeholder="Introduce una descripción" id="content-description" rows="3">{{ $service->description }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Icono<b class="text-danger">*</b></label>
									<input type="file" name="icon" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/services/', $service->icon) }}" />
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Texto del Home<b class="text-danger">*</b></label>
									<input class="form-control @error('line') is-invalid @enderror" type="text" name="line" required placeholder="Introduzca un texto" value="{{ $service->line }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Título de Agenda<b class="text-danger">*</b></label>
									<input class="form-control @error('diary_title') is-invalid @enderror" type="text" name="diary_title" required placeholder="Introduzca un texto" value="{{ $service->diary_title }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Texto de Agenda<b class="text-danger">*</b></label>
									<textarea class="form-control @error('diary_description') is-invalid @enderror" required name="diary_description" placeholder="Introduce una descripción" id="content-diary-description" rows="3">{{ $service->diary_description }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Título de App<b class="text-danger">*</b></label>
									<input class="form-control @error('app_title') is-invalid @enderror" type="text" name="app_title" required placeholder="Introduzca un texto" value="{{ $service->app_title }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Texto de App<b class="text-danger">*</b></label>
									<textarea class="form-control @error('app_description') is-invalid @enderror" required name="app_description" placeholder="Introduce una descripción" id="content-app-description" rows="3">{{ $service->app_description }}</textarea>
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Destacado<b class="text-danger">*</b></label>
									<select class="form-control @error('featured') is-invalid @enderror" name="featured" required>
										<option value="1" @if($service->featured=="1") selected @endif>Si</option>
										<option value="0" @if($service->featured=="0") selected @endif>No</option>
									</select>
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Estado<b class="text-danger">*</b></label>
									<select class="form-control @error('state') is-invalid @enderror" name="state" required>
										<option value="1" @if($service->state=="1") selected @endif>Activo</option>
										<option value="0" @if($service->state=="0") selected @endif>Inactivo</option>
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="service">Actualizar</button>
										<a href="{{ route('servicios.index') }}" class="btn btn-secondary">Volver</a>
									</div>
								</div> 
							</div>
						</form>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection