@extends('layouts.app')
@section('navbar')
@include('partials.navbar')
@endsection
@section('content')
@section('hero-title', 'Contactanos')
@section('hero-text')
En esta seccion puede dejar sus datos para que un ejecutivo se contacte con usted
@endsection
@section('hero-image')
<img src="{{asset('assets/img/inscripcion.svg')}}" class="img-fluid">
@endsection
@include('templates.hero.hero')
<link href="{{asset('assets/css/formulario.css')}}" rel="stylesheet">
<br>
<div class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                <p></p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p></p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p></p>
            </div>
        </div>
    </div>
    <br>
    <form role="form" action="{{route('ContactoAgregar')}}" id="form_contacto" method="POST">
        {{csrf_field()}}
        <div class="row setup-content" id="step-1">
            <div class="col-12">
                <div class="col-12">
                    <!-- Material inline 1 -->
                    <div class="main-container2">
                    <h3 style="text-align: center;">¿Que tipo de usuario eres?</h3>
                        <div class="radio-buttons">
                            <label class="custom-radio">
                                <input type="radio" name="radious" id="RadioUsuario" value="Paciente" checked>
                                <span class="radio-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="https://img.icons8.com/material-rounded/64/000000/person-male.png" />
                                        <h3>Paciente</h3>
                                    </div>
                                </span>
                            </label>
                            <label class="custom-radio">
                                <input type="radio" name="radious" id="RadioUsuario" value="Profesional">
                                <span class="radio-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="https://img.icons8.com/cotton/64/000000/stethoscope.png" />
                                        <h3>Psicólogo</h3>
                                    </div>
                                </span>
                            </label>
                            <!--<label class="custom-radio">
                                <input type="radio" name="radious" id="RadioUsuario" value="Empresa">
                                <span class="radio-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="https://img.icons8.com/ios-filled/64/000000/company.png" />
                                        <h3>Empresa</h3>
                                    </div>
                                </span>
                            </label>-->
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Siguiente</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-2">
            <div class="col-12">
                <div class="col-12">
                    <h3 style="text-align: center;">Datos</h3>
                    <div class="form-group">
                        <label class="control-label">Nombre o nombre Empresa</label>
                        <input maxlength="100" type="text" data-error="campo obligatorio" name="nombre" data-success="Correcto" id="nombre" required="required" class="form-control" placeholder="Escriba su nombre" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Apellido o nombre completo representante Empresa</label>
                        <input maxlength="100" type="text" id="apellido" name="apellido" required="required" class="form-control" placeholder="Escriba su apellido" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Rut</label>
                        <input maxlength="100" type="text" id="rut2" name="rut2" required="required" class="form-control" placeholder="Escriba su rut" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Celular</label>
                        <input maxlength="100" type="tel" id="telefono" name="telefono" value="+569" required="required" class="form-control" placeholder="Escriba su celular" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Correo</label>
                        <input maxlength="100" type="text" id="correo" name="correo" value="" required="required" class="form-control" placeholder="Escriba su correo" />
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Siguiente</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-12">
                <div class="col-12">
                    <h3 style="text-align: center;"> Direccion</h3>
                    <label class="control-label">Región</label>
                    <div class="form-group">
                    <select class="custom-select text-4 bluegray-text" name="region" id="select_regiones">
                        <option value="" class="text-4 bluegray-text">----Seleccione su región----</option>
                    </select>
                    </div>
                    <div class="form-group" id="select_comunas"> </div>                
                    <div class="form-group">
                        <label class="control-label">Calle</label>  
                        <input maxlength="100" type="text" id="calle" name="calle" required="required" class="form-control" placeholder="Escriba su dirección" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Numero casa</label>
                        <input maxlength="100" type="text" id="numcasa" name="numcasa" required="required" class="form-control" placeholder="Escriba su enumarecion(si vive en depto repita su numeracion)" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Departamento</label>
                        <input maxlength="100" type="text" id="numdepto" name="numdepto" required="required" class="form-control" placeholder="Numero departamento(si vive en casa repita su numero)" />
                    </div>
                    <button class="btn btn-success btn-lg pull-right" type="submit">Enviar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@include('templates.welcome.howworks')
@endsection
@section('script')
<script src="{{asset('assets/js/contacto/contacto.js')}}"></script>
@endsection