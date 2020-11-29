@extends('layouts.auth')

@section('title', 'Recuperar Contraseña')

@section('content')

<div class="form-container outer" style="background-color: #7CBED4;">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">Recuperar Contraseña</h1>

                    @include('admin.partials.errors')

                    <form class="text-left" action="{{ route('password.email') }}" method="POST" id="formLogin">
                        {{ csrf_field() }}
                        <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <label for="email">CORREO</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ 'admin@gmail.com' }}" autocomplete="email" autofocus value="{{ old('email') }}">
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" action="login">Enviar</button>
                                </div>
                            </div>

                            <div class="d-sm-flex justify-content-center mt-3">
                                <div class="field-wrapper">
                                  <p class="text-center">Deseas ingresar? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Ingresa</b></a></p>
                              </div>
                          </div>

                      </div>
                  </form>

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
@endsection