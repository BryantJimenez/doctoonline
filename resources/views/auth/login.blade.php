@extends('layouts.auth')

@section('title', 'Ingresar')

@section('content')

<div class="form-container outer" style="background-color: #7CBED4;">
  <div class="form-form">
    <div class="form-form-wrap">
      <div class="form-container">
        <div class="form-content">

          {{-- <h1 class="">Ingresar</h1> --}}
          <img src="{{ asset('/admins/img/logoadmin1.png') }}" class="mb-3" alt="Logo">

          @include('admin.partials.errors')

          <form class="text-left" action="{{ route('login') }}" method="POST" id="formLogin">
            {{ csrf_field() }}
            <div class="form">

              <div id="username-field" class="field-wrapper input">
                <label for="email">CORREO</label>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ 'admin@gmail.com' }}" value="{{ old('email') }}">
              </div>

              <div id="password-field" class="field-wrapper input mb-2">
                <div class="d-flex justify-content-between">
                  <label for="password">CONTRASEÑA</label>
                  <a href="{{ route('password.request') }}" class="forgot-pass-link">Olvidé mi contraseña</a>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="********">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
              </div>
              <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                  <button type="submit" class="btn btn-primary font-weight-bold" style="background-color: #7CBED4 !important; border: 1px solid #7CBED4;" action="login">Ingresar</button>
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