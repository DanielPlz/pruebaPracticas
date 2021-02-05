@extends('layouts.app')
@section('navbar')
@include('partials.navbar')
@endsection
@section('content')
@section('hero-title', 'Registrate')
@section('hero-text')
Bienvenido a la seccion de registro, selecciona el tipo de usuario para continuar
@endsection
@section('hero-image')
<img src="{{asset('assets/img/inscripcion.svg')}}" class="img-fluid">
@endsection
@include('templates.hero.hero')
<link href="{{asset('assets/css/formulario.css')}}" rel="stylesheet">
<br>
<div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="col-12">
                    <!-- Material inline 1 -->
                    <h3 style="text-align: center;">¿Que tipo de usuario eres?</h3>
                        <div class="radio-buttons">
                            <label class="custom-radio">
                                <span class="radio-btn"><i class="las la-check"></i>
                                <a href="{{ route('register') }}">
                                <div class="hobbies-icon">
                                <i class="fas fa-user"></i>
                                        <h3>Paciente</h3>
                                    </div>
                                </a>
                                </span>
                            </label>
                            <label class="custom-radio">
                                <span class="radio-btn"><i class="las la-check"></i>
                                <a href="{{ route('register_psicologo') }}">
                                    <div class="hobbies-icon">
                                    <i class="far fa-id-badge"></i>
                                        <h3>Psicólogo</h3>
                                    </div>
                                </span>
                            </label>
                        </div>                </div>
            </div>
        </div>
</div>
@include('partials.footer')

@endsection
@section('script')
<script src="{{asset('assets/js/contacto/contacto.js')}}"></script>
@endsection
