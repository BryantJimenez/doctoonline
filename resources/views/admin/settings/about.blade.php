@extends('layouts.admin')

@section('title', 'Editar Quienes Somos')

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
						<h4>Editar Quienes Somos</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('nosotros.update') }}" method="POST" class="form" id="formAbout" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Banner</label>
									<input type="file" name="banner" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/aboutus/', $setting->banner) }}" />
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Quienes Somos</label>
									<textarea class="form-control @error('about') is-invalid @enderror" name="about" placeholder="Ingrese el texto de quienes somos" id="content-about" rows="6">{{ $setting->about }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Misión</label>
									<textarea class="form-control @error('mission') is-invalid @enderror" name="mission" placeholder="Ingrese la misión" id="content-mission" rows="6">{{ $setting->mission }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Visión</label>
									<textarea class="form-control @error('vision') is-invalid @enderror" name="vision" placeholder="Ingrese la visión" id="content-vision" rows="6">{{ $setting->vision }}</textarea>
								</div>

								<div class="form-group col-12">
									<button type="submit" class="btn btn-primary" action="about">Actualizar</button>
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