@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
<div class="container" style="margin-top: 100px; min-height: 100vh;">
    <div class="row text-center d-flex justify-content-center">
        <div class="col-12 d-flex justify-content-center mb-2">
            <h1 class="title-3 darkblue-text">Elige tu terapeuta</h1>
        </div>
        <div class="col-12 d-flex justify-content-center p-0">
            <div class="line"></div>
        </div>
    </div>
    <form method="get"class="form-inline" action="{{ route('results') }}">
        <input class="form-control form-control-sm mr-sm-2" name="datoFiltro" type="text" placeholder="Ingrese un nombre, apellido, titulo" />
        <button class="form-control mr-sm-2 btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    <div class="row pt-5 pb-5">
        @foreach($profesionales as $profesional)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="row no-gutters d-flex justify-content-center">
                        <div class="col-4">
                            <div class="card-body p-2">
                                @if($profesional->avatar)
                                    <img src="{{$profesional->avatar}}" class="avatar rounded-circle align-self-center" alt="">
                                @else
                                    <img src="{{asset('assets/img/avatar.png')}}" class="avatar align-self-center" alt=""> 
                                @endif
                            </div>
                        </div>
                        <div class="col-8 align-self-center">
                            <div class="card-body p-2">
                                <a href="{{route('profile', $profesional->id)}}">
                                    <h5 class="title-4 darkblue-text mb-0">{{$profesional->name.' '.$profesional->apellido}}</h5>
                                </a>
                                <p class="text-4 bluegray-text mb-0">
                                    {{$profesional->info->titulo.' - '.$profesional->info->modalidad_atencion}}
                                </p>
                                <p class="text-4 bluegray-text mb-0">
                                    {{$profesional->direccion}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters d-flex justify-content-center">
                        
                        <div class="col-4 text-center">
                            <div class="card-body p-2 align-self-center">
                                <h5 class="text-4 bluegray-text mb-0">Edad</h5>
                                <p class="text-4 darkblue-text text-bold mb-0">
                                    35 años
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div class="card-body p-2 align-self-center">
                                <h5 class="text-4 bluegray-text mb-0">Estrellas</h5>
                                <p class="text-4 darkblue-text text-bold mb-0">
                                    4.5
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div class="card-body p-2 align-self-center">
                                <h5 class="text-4 bluegray-text mb-0">Costo</h5>
                                <p class="text-4 darkblue-text text-bold mb-0">
                                    4.900/hr
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection