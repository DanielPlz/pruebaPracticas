@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
<input type="hidden" id="idPerfil" value="{{auth()->id()}}">
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-lg-4">
            @include('perfil.includes.information')
        </div>
        <div class="col-lg-5">
            <div class="card mb-3">
                <div class="card-body">
                    <p class="darblue-text title-4 text-bold mb-3">Acerca</p>
                    <p class="text-4 bluegray-text">{{$user->info->descripcion}}</p>                                   
                </div>
            </div>
            @include('perfil.includes.stadistics')
            @include('perfil.includes.reviews')
        </div>
        <div class="col-lg-3">
            @include('perfil.includes.options')
        </div>
    </div>
</div>

@endsection


