@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    @section('hero-title2', 'Acerca de nosotros')
        @section('hero-text2')
        Somos un emprendimiento web que  potencia los servicios de salud mental. 
Comienza a mediados del año 2018 con la conformación del equipo compuesto por cuatro profesionales.
Estamos reunidos en torno a los principios de la libertad y autonomía, tanto de nuestros psicólogos colaboradores como de la ciudadanía.
Pretendemos así contribuir a la democratización de la salud mental en Temuco y nuestro país
        @endsection
    @section('hero-image')
    <img src="{{asset('assets/img/about.jpg')}}" class="img-fluid">
@endsection
@include('templates.hero.hero2')

<div class="container pl-3 pr-3">
    <div class="row pt-5 pb-5 d-flex justify-content-center">
        <div class="col-md-4 mb-3">
            <div class="icon d-flex justify-content-center mb-3">
                <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                <i class="fas fa-people-carry fa-fw align-self-center"></i>
                </div>
            </div>
            <div class="text-center">
                <h1 class="title-4 darkblue-text mb-3">Misión</h1>
                <p class="text-4 bluegray-text">
                Facilitar el acceso a servicios de salud mental para la comunidad de Temuco, generando una plataforma web que conecta a personas con problemas de salud mental y psicólogos clínicos.
                </p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="icon d-flex justify-content-center mb-3">
                <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                    <i class="far fa-flag fa-fw align-self-center"></i>
                </div>
            </div>
            <div class="text-center">
                <h1 class="title-4 darkblue-text mb-3">Visión</h1>
                <p class="text-4 bluegray-text">
                Para el año 2024 posicionarnos como una de las plataforma especializada en la promoción, prevención y tratamiento de los problemas de salud mental en nuestra región, siendo reconocida a nivel nacional, con miras a una expansión en Latinoamérica.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container pl-3 pr-3">
    <div class="row pt-5 pb-5 d-flex justify-content-center">
        <div class="col-md-12 text-center mb-4"> 
        <div class="icon d-flex justify-content-center mb-3">
                <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                <i class="far fa-edit align-self-center"></i>
                </div>
            </div>
           
            <h1 class="title-4 darkblue-text mb-3">Nuestros valores</h1>
            <p class="text-4 bluegray-text">
            Verificamos que nuestros psicólogos colaboradores estén habilitados legalmente para el ejercicio de su profesión y otorgamos herramientas digitales para fortalecer el vínculo terapéutico, el seguimiento de los avances, entre otros.             </p>
        </div>
        <div class="col-md-4 mb-3">
            <div class="icon d-flex justify-content-center mb-3">
                <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                    <i class="far fa-user fa-fw align-self-center"></i>
                </div>
            </div>
            <div class="text-center">
                
                <h1 class="title-4 darkblue-text mb-3">Responsabilidad </h1>
                <p class="text-4 bluegray-text">
                   
                </p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="icon d-flex justify-content-center mb-3">
                <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                <i class="fas fa-dove align-self-center"></i>
                </div>
            </div>
            <div class="text-center">
                <h1 class="title-4 darkblue-text mb-3">Libertad</h1>
                <p class="text-4 bluegray-text">
                   
                </p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="icon d-flex justify-content-center mb-3">
                <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                <i class="fas fa-user-friends align-self-center"></i>
                </div>
            </div>
            <div class="text-center">
                <h1 class="title-4 darkblue-text mb-3">Colaboración</h1>
                <p class="text-4 bluegray-text">
                   
                </p>
            </div>
        </div>
    </div>
</div>


@endsection

