@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    @section('hero-title', 'Inscripcion de terapeutas')
    @section('hero-text')
    Bienvenido a Psicólogos Temuco la red de terapia online mas grande. Te invitamos a registrar tu cuenta o iniciar sesion para completar el proceso de inscripcion.
    @endsection
    @section('hero-image')
    <img src="{{asset('assets/img/inscripcion.svg')}}" class="img-fluid">
    @endsection
    @include('templates.hero.hero')
    <div class="container pl-3 pr-3">
        <div class="row pt-5 pb-5 d-flex justify-content-center">
            <div class="col-md-12 text-center mb-4">
                <h1 class="title-4 darkblue-text mb-3">Expande tu potencial</h1>
                <p class="text-4 bluegray-text">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                </p>
            </div>
            <div class="col-md-4 mb-3">
                <div class="icon d-flex justify-content-center mb-3">
                    <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                        <i class="far fa-flag fa-fw align-self-center"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="title-4 darkblue-text mb-3">Publica tus servicios</h1>
                    <p class="text-4 bluegray-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet accusamus mollitia quibusdam hic placeat quasi.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="icon d-flex justify-content-center mb-3">
                    <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                        <i class="far fa-clock fa-fw align-self-center"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="title-4 darkblue-text mb-3">Administra tus tiempos</h1>
                    <p class="text-4 bluegray-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet accusamus mollitia quibusdam hic placeat quasi.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="icon d-flex justify-content-center mb-3">
                    <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                        <i class="far fa-comments fa-fw align-self-center"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="title-4 darkblue-text mb-3">Participa en la comunidad</h1>
                    <p class="text-4 bluegray-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet accusamus mollitia quibusdam hic placeat quasi.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection