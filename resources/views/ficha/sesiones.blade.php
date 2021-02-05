@extends('layouts.dashboard')
@section('contentSidebar')

<!-- INICIO CONTENIDO MENÚ SESIONES -->
<!-- Encabezado -->
<div class="container_information">
    <div class="row_diagnostico_manual">
        <div class="col">
            <a href="{{route('information', $paciente->id)}}" class="btn btn-danger stretched-link">Volver</a>
        </div>
        <div class="col">
            <h3 class="card-title">Menú Sesiones</h3>
        </div>
        <div class="col">
            <h5>Paciente : {{$paciente->name}} {{$paciente->apellido}}</h5>
            <h5>N° Ficha : {{$paciente->id}}</h5>
        </div>
    </div>
</div>
<!-- Encabezado -->

<div class="card text-center container_information ">

        <form method="get">
            <input class="form-control mr-sm-2" name="number" type="search" placeholder="Buscar Sesión" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>


    <div class="contenedor_sesiones responsive">
        <!-- Sesiones -->
        @foreach ($sesiones as $sesion)
        <div class="card" >
            <ul class="list-group list-group-flush">
                <div class="encabezado">
                    <label for="">Sesi&oacute;n</label>
                    <label for="">N° {{$sesion->numero_sesion}}</label>
                </div>
                <li class="list-group-item">{{$sesion->fecha}}</li>
                <li class="list-group-item">{{$sesion->descripcion}}</li>
            </ul>
            <div class="card-body">
                <label for="">Periodo {{$sesion->periodo}}</label>
                <label for="">Comentarios 0</label>
            </div>

        </div>
        @endforeach
        <!-- Fin sesiones -->


    </div>
    {!!$sesiones->render()!!}


    <a class="btn btn-success btn_comentario" data-toggle="collapse" href="#ctn_sesion" role="button" aria-expanded="false" aria-controls="ctn_evaluacion1">Crear Nueva Sesión</a>
    <div class="collapse multi-collapse ctn_comentario" id="ctn_sesion">
        <div class="container_information">
            <div class="row_diagnostico_manual">
                <form action="{{route('guardarSesionBD', $paciente->id)}}" method="post" role="form">
                    @csrf
                    <div class="form-group">
                    <label for="">Nueva Sesi&oacute;n</label>

                        <!-- id autoincrementable -->
                        <!-- Número de sesión -->
                        <input type="number" class="form-control form_sesion" name="txt_numero_sesion" id="txt_numero_sesion" placeholder="Número de la sesión" required>
                        <!-- id ficha $paciente_id -->
                        <textarea class="form-control form_sesion" id="txt_descripcion_sesion" name="txt_descripcion_sesion" placeholder="Ingrese descripción" rows="2" required></textarea>
                        <input class="form-control form_sesion" name="txt_fecha_sesion" type="date" value="" id="txt_fecha_sesion" required>

                        <!-- ejemplo para testeo 2020-10-20 -->
                        <input type="number" class="form-control form_sesion" name="txt_periodo" id="txt_periodo" placeholder="Ingrese periodo" required>
                        <!-- created_at automático-->
                        <!-- updated_at automático -->
                    </div>

                    <div class="evaluacion__1">
                        <button type="submit" class="btn btn-success" id="sesion" name="btn_sesion">Guardar Sesi&oacute;n</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<!-- TÉRMINO MENÚ SESIONES -->
@endsection