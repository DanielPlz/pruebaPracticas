@extends('layouts.app')
<link href="{{ asset('assets/css/register.css') }}" rel="stylesheet">

@section('header')
    <div class="login-inner w-100">
        <div class="container h-100">
            <div class="row no-gutters h-100 justify-content-center">
                <div class="col-lg-5 col-12 align-self-center">
                    <div class="card rounded-border contenedor_conf">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h1 class="title-2 darkblue-text">Confirmar solicitud de registro</h1>
                                <h2 class="text-3 bluegray-text">Estimado Psicólogo:</h2>
                            </div>
                            <div class="form-group row pl-4 pr-4 mb-1">
                                <p class="text-justify"><b>Su solicitud de registro se ingresará al sistema.</b></p>
                            </div>

                            <div class="form-group row pl-4 pr-4 mb-1">
                                <p class="text-justify"><b>Puede seleccionar realizar solicitud para enviar
                                    de manera automática un correo con la solicitud de registro. Esta
                                    será verificada y se le notificará en un plazo máximo de 48 hrs.</b></p>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-12 text-center">
                                <div class="col-12">
                                    <a href="{{ url('/') }}"
                                        class="btn btn-danger white-text text-4 text-medium mb-3">
                                        <i class="fas fa-undo-alt"></i>
                                        Volver al inicio
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/auth/limitar_caracteres.js') }}"></script>
@endsection
