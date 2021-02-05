@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 text-center">
                <h1 class="title-3">Felicidades {{auth()->user()->name}}</h1>
                <p class="text-3">Tu informacion fue validada con exito, ahora excoge el plan que mas se adecue a ti</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-5">Holi</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection