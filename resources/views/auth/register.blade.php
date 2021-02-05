@extends('layouts.app')
@include('partials.head')
<link href="{{ asset('assets/css/register.css') }}" rel="stylesheet">

<div id="box_registro">

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
        style="background:url(../assets/img/tranquilidad1.jpg) no-repeat center center; background-size: cover">
      

        <div class="auth-box on-sidebar p-4 bg-white m-0 rounded box-shadow" style="top: 0; right: 10rem; height: 100%; width: 150%;box-shadow: 10px 10px 20px #666;">
            <div>
                <div class="logo text-center">
                <a class="navbar-brand d-flex justify-content-center" href="{{ url('/') }}">
                        <br><img src="assets/img/logopsicotem3Transparente.png" style="width:100%; max-width:200px; alt=" Home">
                    </a>
                </div>
                <h3 class="box-title mt-5 mb-0">Registro Paciente</h3>
               
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                    $tipo=1;
                    @endphp
                        <form class="form-horizontal mt-3 form-material" action="{{url('/auth/register_psicologo/'.$tipo)}}" id="formulario">
                            @csrf
                            <!--Rut-->
                            <div class="form-group mt-3">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" placeholder="Rut" name="rut" id="rut" required
                                    onBlur="valRun(this.value);" onKeyPress="return soloNumerosRut(event)">
                                    <span class=invalid-feedback id="msgRun"></span>
                                    @error('rut')
                                    <div class="alert alert-danger small" role="alert" name="msgRun"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            </div>
                            <!--nombres-->
                            <div class="form-group mt-3">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" placeholder="Nombre" name="nombres" id="nombres" 
                                    onKeyPress="return sololetras(event,true)" onpaste="return false
                                        @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres') }}">

                                    @error('nombres')
                                    <div class="alert alert-danger small" role="alert"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <!--Apellido paterno-->
                                <div class="form-group col-6">
                                    <input class="form-control" type="text" required="" placeholder="Apellido Paterno" name="apellido_pa" id="apellido_pa" 
                                    onKeyPress="return sololetras(event,true)" onpaste="return false" @error('apellido_pa') is-invalid @enderror" name="apellido_pa" value="{{ old('apellido_pa') }}">
                                    @error('apellido_pa')
                                    <div class="alert alert-danger small" role="alert"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                                <!--Apellido materno-->
                                <div class="form-group col-6">
                                    <input class="form-control" type="text" required="" placeholder="Apellido Materno" name="apellido_ma" id="apellido_ma" 
                                    onKeyPress="return sololetras(event,true)" onpaste="return false
                                        @error('apellido_ma');" is-invalid @enderror" name="apellido_ma" value="{{ old('apellido_ma') }}">

                                    @error('apellido_ma')
                                    <div class="alert alert-danger small" role="alert"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            </div>
                            <!--Email-->
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input class="form-control" type="email" required="" placeholder="Correo" name="email" id="email" 
                                    onBlur="valCorreo(this.value);" onpaste="return false
                                        @error('email');" is-invalid @enderror" name="email" value="{{ old('email') }}">

                                    @error('email')
                                    <div class="alert alert-danger small" role="alert"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                                <span class="valid-feedback text-danger" id="msgEmail"></span>
                            </div>
                            <!--Contraseña-->
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" required="" placeholder="Contraseña" name="contraseña" id="contraseña">
                                </div>
                                @error('contraseña')
                                    <div class="alert alert-danger small" role="alert"><strong>{{ $message }}</strong></div>
                                    @enderror
                            </div>
                            <!--Confirmar contraseña-->
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" required="" placeholder="Confirmar Contraseña" name="contraseña_conf" id="contraseña_conf">
                                </div>
                                @error('contraseña_conf')
                                    <div class="alert alert-danger small" role="alert"><strong>{{ $message }}</strong></div>
                                    @enderror
                            </div>
                            <!--
                            <div class="form-group mb-3">
                                <div class="">
                                    <div class="checkbox checkbox-primary pt-0">
                                        <input id="checkbox-signup" type="checkbox" class="chk-col-indigo material-inputs">
                                            <label for="checkbox-signup"> Acepto todos los <a href="#">Terminos</a></label>
                                    </div>
                                </div>
                            </div>
                            -->
                            <div class="form-group text-center mt-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block waves-effect waves-light" type="submit">Registrarse</button>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="col-sm-12 text-center">
                                <p>¿Ya tienes una cuenta? <a href="{{url('/login')}}" class="text-info ml-1">
                                    Iniciar Sesión</a></p>
                                </div>
                            </div>

                            <div class="text-center mb-2 mt-1">
                                <span class="text">O puedes iniciar con tus redes</span>
                            </div>

                            <div class="pl-4 pr-4">
                                <a href="{{ url('/auth/redirect/google') }}" class="btn btn-google btn-block mb-3">
                                    <i class="fab fa-google mr-2"></i>
                                    Registrarse con Google
                                </a>
                            </div>
                            <div class="pl-4 pr-4">

                            <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-facebook btn-block mb-3">
                                    <i class="fab fa-facebook mr-2"></i>
                                    Registrarse con Facebook
                                </a>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script src="{{ asset('assets/js/auth/validaciones.js') }}"></script>
<script src="{{ asset('assets/js/auth/limitar_caracteres.js') }}"></script>
@endsection