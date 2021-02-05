@extends('layouts.app')

@section('header')
<div class="login-inner w-100">
    <div class="container h-100">
        <div class="row no-gutters h-100 justify-content-center">
            <div class="col-lg-5 col-12 align-self-center">
                @if (session('email'))
                        <div class="alert alert-danger" role="alert">
                            Tu cuenta ya esta registrada, utiliza tu correo para ingresar.
                        </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-danger text-center" role="alert">
                    {{ session('status') }}
                    </div>
                @endif
                <div class="card rounded-border">
                    <div class="card-body">
                        <form method="POST" action="{{ route('logear', $tipo) }}">
                            @csrf
                            <div class="logo text-center">
                    <span class="db">
                        <br>
                        <a class="navbar-brand d-flex justify-content-center" href="{{ url('/') }}">
                               <img src="{{ asset('assets/img/logopsicotem3Transparente.png') }}" height="60px" />
                         </a>
                        
                    </span>
                </div><br><br>
                            <div class="text-center mb-4">
                                <h1 class="title-2 darkblue-text">¡Bienvenido!</h1>
                                <h2 class="text-3 bluegray-text">Inicia sesion para acceder al sitio</h2>
                            </div>
                            <div class="form-group row pl-4 pr-4 mb-3">
                                <label for="email" class="col-md-12 text-4 darkblue-text text-bold">{{ __('Correo') }}</label>
                                <div class="col-md-12">
                                @if (session('email'))
                                <input id="email" type="email" class="text-4 bluegray-text form-control pt-2 pb-2 @error('email') is-invalid @enderror" name="email" " required autocomplete="email" autofocus  value="{{session('email')}}">

                                @else 
                                <input id="email" type="email" class="text-4 bluegray-text form-control pt-2 pb-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @endif

                                    @error('email')
                                        <span class="invalid-feedback text-4" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row pl-4 pr-4 mb-5">
                                <label for="password" class="col-md-12 text-4 darkblue-text text-bold">{{ __('Contraseña') }}</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="pt-2 pb-2 text-4 bluegray-text form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0 pl-4 pr-4">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn indigo white-text text-4 text-medium btn-block mb-3">
                                        <i class="fas fa-sign-in-alt pink-text fa-fw"></i> {{ __('Iniciar sesion') }}
                                    </button>
                                    @if($tipo==1)
                                    <h2 class="text-4 bluegray-text mb-4">O ingresa con tus redes</h2>
                                    
                                    <a href="{{ url('/auth/redirect/google') }}" class="btn google white-text text-4 text-medium btn-block mb-3">
                                        <i class="fab fa-google fa-fw"></i>
                                        Ingresar con Google
                                    </a>
                                    <a href="{{ url('/auth/redirect/facebook') }}" class="btn facebook white-text text-4 text-medium btn-block mb-3">
                                        <i class="fab fa-facebook fa-fw"></i>
                                        Ingresar con Facebook
                                    </a>
                            @endif
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-4 bluegray-text" href="{{ route('password.request') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif

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