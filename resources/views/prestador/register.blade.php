@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
<div class="form-inner" style="background-image: url('{{asset('assets/img/fondo-a.jpg')}}')">
    <div class="h-100 indigo-overlay d-flex justify-content-center">
        <div class="h-100 container mt-3">
            <div class="h-100 row">
                <div class="col-lg-6 align-self-center">
                    <div class="text-lg-left text-center mb-lg-0 mt-lg-0 mt-4 mb-4">
                        <h1 class="title-2 yellow-text">Unete a Psicólogos Temuco</h1>
                        <h2 class="text-2 white-text text-regular">Si eres un profesional de la salud y deseas ofrecer tus servicios en Psicólogos Temuco, te invitamos a ingresar tus datos para finalizar el registro</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 align-self-center">
                    <div class="card mb-4 pl-3 pr-3">
                        <div class="card-header white border-0 d-flex justify-content-center">
                            <img src="{{asset('assets/img/logopsicotem3.PNG')}}" height="70px">
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/create_profesional" id="regform">
                                @csrf
                                <!-- Circles which indicates the steps of the form: -->
                                @include('prestador.steps')
                                <!-- One "tab" for each step in the form: -->
                                @include('prestador.tabs')
                            </form>
                            <div class="mt-5">
                                <div class="col-lg-4 col-6 float-left">
                                     <button type="button" class="btn btn-block rounded-pill indigo-border white indigo-text text-4" id="prevBtn" onclick="nextPrev(-1)">Atras</button>
                                </div>
                                <div class="col-lg-4 col-6 float-right">
                                    <button type="button" class="btn btn-block rounded-pill indigo white-text text-4" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection