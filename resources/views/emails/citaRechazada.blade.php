@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('header')
<div class="header w-100">
    <div class="d-flex justify-content-center">
        <div class="container p-lg-0 pl-4 pr-4  inner">
            <div class="row mt-5 w-100 d-flex justify-content-center">
                <div class="col-lg-6 p-0">
                <div class="banner w-100">
    <div class="text-center mb-5">
        <h1 class="title-1 mb-5 darkblue-text" id="titulo">{{$titulo}}</h1>
        <h1 class="text-1 mb-5 bluegray-text text-regular" id="descripcion">
            {{$txt}}
        </h1>
        <div class="row d-flex justify-content-center"id ="div">
            <div class="col-lg-5 float-left" >
                 <a href="#" class="btn transparent indigo-text text-4 text-medium btn-block p-2" >
                    Contáctanos <i class="fas fa-phone fa-fw pink-text"></i> 
                </a>
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
