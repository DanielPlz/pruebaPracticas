@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    @include('partials.card-head')
    @section('hero-title', 'Registro para Psicólogos')
        @section('hero-text')
            Ingrese sus datos para crear su cuenta de psicólogo.
        @endsection
        @section('hero-image')
            <img src="{{asset('assets/img/inscripcion.svg')}}" class="img-fluid">
        @endsection
    @include('templates.hero.hero')
<form method="POST" action="{{ route('registerpsi') }}">
    @csrf
    <div class="container">
    <br>
    <div class="form-group row pl-4 pr-4">
        <div class="col-md-6">
            <label for="name">{{ __('Nombre') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="lastname">{{ __('Apellido') }}</label>
            <input id="lastname" type="text" class="form-control @error('apellido') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

            @error('apellido')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- <div class="form-group row pl-4 pr-4">
        <label for="rut" class="col-md-12">{{ __('RUT') }}</label>

        <div class="col-md-12">
            <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" required autocomplete="rut">

            @error('rut')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div> -->
    <div class="form-group row pl-4 pr-4">
        <label for="email" class="col-md-12">{{ __('Correo') }}</label>

        <div class="col-md-12">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row pl-4 pr-4 mb-5">
        <div class="col-md-6">
            <label for="password">{{ __('Contraseña') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="password-confirm">{{ __('Confirmar contraseña') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>
    <!--
        <div class="col-md-6">
            <label for="tipo">{{ __('Tipo') }}</label>
            <input id="tipo" type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" value="{{ old('tipo') }}" required autocomplete="tipo" autofocus>
            @error('tipo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    -->
    <div class="form-group row mb-3 pl-4 pr-4">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success btn-block pt-2 pb-2">
                {{ __('Registrar cuenta') }}
            </button>
        </div>
    </div>
</form>
</div>
<div class="card-footer">
    <div class="text-center mb-4 mt-3">
        <h2 class="text">O ingresa con tus redes</h2>
    </div>
    <div class="pl-4 pr-4">
        <a href="{{ url('/auth/redirect/google') }}" class="btn btn-google btn-block mb-3">
            <i class="fab fa-google mr-2"></i>
            Registrarse con Google
        </a>
        <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-facebook btn-block mb-3">
            <i class="fab fa-facebook mr-2"></i>
            Registrarse con Facebook
        </a>
    </div>
</div>
</div>
@endsection
