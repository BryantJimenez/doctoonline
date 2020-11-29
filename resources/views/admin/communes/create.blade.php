@extends('layouts.admin')

@section('title', 'Crear Comunas')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Crear Comunas</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('comunas.store') }}" method="POST" class="form" id="formCommune">
							@csrf
							<div class="row">
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Región<b class="text-danger">*</b></label>
									<select class="form-control @error('region_id') is-invalid @enderror" name="region_id" required id="selectRegions">
										<option value="">Seleccione</option>
										@foreach($regions as $region)
										<option @if($region->id==old('region_id')) selected @endif value="{{ $region->id }}">{{ $region->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Provincia<b class="text-danger">*</b></label>
									<select class="form-control @error('province_id') is-invalid @enderror" name="province_id" required disabled id="selectProvinces">
										<option value="">Seleccione</option>
										@foreach($provinces as $province)
										<option @if($province->id==old('province_id')) selected @endif value="{{ $province->id }}">{{ $province->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="commune">Guardar</button>
										<a href="{{ route('comunas.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection