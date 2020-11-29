@extends('layouts.web')

@section('title', 'Ingresar')

@section('content')

<section class="ftco-section py-0">
	<div class="bg-blue-light vh-100 w-100">
		<div class="row mx-0">
			<img src="{{ asset('/web/img/medico.png') }}" class="doctor-img" alt="Médico">
			<div class="offset-xl-1 offset-lg-1 col-xl-6 col-12 mt-4 d-none d-xl-block">
				<a href="{{ route('home') }}">
					<img src="{{ asset('/web/img/logoblanco2.png') }}" class="login-logo-white mt-3" width="300" height="70" alt="Logo">
				</a>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-8 col-sm-10 col-12 mt-2 pt-2 mx-auto mr-login">
				<div class="card border-0" id="login">
					<a href="{{ route('home') }}" class="text-center">
						<img src="{{ asset('/web/img/logo-login.png') }}" class="login-logo mt-2 mb-2 mt-xl-3 mb-xl-4" alt="Logo">
					</a>
					<form class="card-body" action="{{ route('login.custom') }}" method="POST" id="formLogin">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-12">
								@include('admin.partials.errors')

								@if(session('error.login'))
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<ul>
										<li>{{ session('error.login') }}</li>
									</ul>
								</div>
								@endif
							</div>

							<div class="form-group col-12 mb-4">
								<input class="form-control rounded-1 @error('email') is-invalid @enderror" type="email" name="email" required placeholder="EMAIL" value="{{ old('email') }}" id="email">
							</div>

							<div class="form-group col-12 mb-4">
								<input class="form-control rounded-1 @error('password') is-invalid @enderror" type="password" name="password" required placeholder="CLAVE" id="password">
							</div>

							<div class="form-group col-12">
								<button type="submit" class="btn btn-blue-light text-white font-weight-bold text-uppercase rounded-1 w-100 py-3" action="login">Ingresar</button>
							</div>

							<div class="form-group col-12 text-center">
								<a href="{{ route('recuperar') }}" class="h5 text-dark">Olvidaste tú Clave?</a>
							</div>
						</div>
					</form>
					<div class="card-footer bg-red-dark">
						<a href="{{ route('registro') }}"><p class="h6 font-weight-bold text-white text-uppercase text-center mb-0 py-xl-2">Registrate</p></a>
					</div>
				</div>

			</div>
		</div>

	</div>
</section>

@endsection