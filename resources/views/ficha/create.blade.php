@extends('layouts.dashboard')
@section('contentSidebar')
<!-- INICIO MENÚ 'DIAGNÓSTICO PSICOLÓGICO'-->
<div class="container_information">
    <div class="row_diagnostico_manual">
        <div class="col">
            <a href="{{route('information', $paciente->id)}}" class="btn btn-danger">Volver</a>
        </div>
        <div class="col">
            <h3 class="card-title">Diagnósticos Psicológicos</h3>
        </div>
        <div class="col">
            <h5>Paciente : {{$paciente->name}} {{$paciente->apellido}}</h5>
            <h5>N° Ficha : {{$paciente->id}}</h5>
        </div>
    </div>
</div>
<!-- TÉRMINO MENÚ 'DIAGNÓSTICO PSICOLÓGICO' -->





@if(@isset($diagnostico))
<div class="card text-center container_information">
    <div class="card-body">
        <h3 class="card-title">Diagnóstico creado</h3>
        <a href="{{route('show', $paciente->id)}}" class="btn btn-primary">Ver Diagnóstico</a>
    </div>
</div>

@else


<!-- INICIO DESCRIPCIÓN DIAGNÓSTICO PSICOLÓGICO -->
<div class="card text-center container_information">
    <div class="card-body">
        <h3 class="card-title">Crear nuevo Diagnóstico psicológico</h3>
        <form action="{{route('guardarDiagnosticoBD', $paciente->id)}}" method="post" role="form">

            @csrf
            <div class="form-group">
                <textarea class="form-control" id="txt_nuevo_diagnostico" name="txt_nuevo_diagnostico" rows="8" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Diagnóstico</button>
        </form>
    </div>
</div>


@endif


<!-- TÉRMINO DESCRIPCIÓN DIAGNÓSTICO PSICOLÓGICO -->
<!-- MANUALES -->

<!-- Consulta por si se recibe la variable manuales, (si existe un manual ingresado en base de datos) -->








<div class="card text-center container_information">
    <h3 class="card-title">Manual Diagnóstico</h3>
    <div class="description">
<!-- DROPDOWN PARA SELECCIONAR MANUAL -->

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Selecciona Manual
            </button>


            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                @foreach($manuales as $manual )

                <a class="dropdown-item" data-toggle="collapse" href="#m{{$manual->cant_eje}}" role="button" aria-expanded="false" aria-controls="ctn_evaluacion1">{{$manual->descripcion}}</a>
                @endforeach
            </div>

         
            <div class="collapse multi-collapse ctn_comentario mt-4" id="m6">
    
                <form action="" method="post" role="form">

                    @csrf
                    <div class="evaluacion__1">
                        <label for="">Eje 1</label>
                        <textarea class="form-control" id="txt_guardar_eje1" name="txt_guardar_eje1" rows="2" placeholder="Trastornos Clínicos" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <label for="">Eje 2</label>
                        <textarea class="form-control" id="txt_guardar_eje2" name="txt_guardar_eje2" rows="2" placeholder="Trastornos de la persona" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <label for="">Eje 3</label>
                        <textarea class="form-control" id="txt_guardar_eje3" name="txt_guardar_eje3" rows="2" placeholder="Enfermedades Médicas" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <label for="">Eje 4</label>
                        <textarea class="form-control" id="txt_guardar_eje4" name="txt_guardar_eje4" rows="2" placeholder="EAG (0-100)" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <label for="">Eje 5</label>
                        <textarea class="form-control" id="txt_guardar_eje5" name="txt_guardar_eje5" rows="2" placeholder="EEAG (0-100)" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <label for="">Eje 6</label>
                        <textarea class="form-control" id="txt_guardar_eje6" name="txt_guardar_eje6" rows="2" placeholder="EEAG (0-100)" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <button type="submit" class="btn btn-primary" id="manual1" name="btn_manual1">Guardar Cambios</button>
                    </div>
                </form>


            </div>

            <div class="collapse multi-collapse ctn_comentario mt-4" id="m4">
    
    <form action="" method="post" role="form">

        @csrf
        <div class="evaluacion__1">
            <label for="">Eje 1</label>
            <textarea class="form-control" id="txt_guardar_eje1" name="txt_guardar_eje1" rows="2" placeholder="Trastornos Clínicos" required></textarea>
        </div>
        <div class="evaluacion__1">
            <label for="">Eje 2</label>
            <textarea class="form-control" id="txt_guardar_eje2" name="txt_guardar_eje2" rows="2" placeholder="Trastornos de la persona" required></textarea>
        </div>
        <div class="evaluacion__1">
            <label for="">Eje 3</label>
            <textarea class="form-control" id="txt_guardar_eje3" name="txt_guardar_eje3" rows="2" placeholder="Enfermedades Médicas" required></textarea>
        </div>
        <div class="evaluacion__1">
            <label for="">Eje 4</label>
            <textarea class="form-control" id="txt_guardar_eje4" name="txt_guardar_eje4" rows="2" placeholder="EAG (0-100)" required></textarea>
        </div>
        <div class="evaluacion__1">
            <label for="">Eje 5</label>
            <textarea class="form-control" id="txt_guardar_eje5" name="txt_guardar_eje5" rows="2" placeholder="EEAG (0-100)" required></textarea>
        </div>
        <div class="evaluacion__1">
            <label for="">Eje 6</label>
            <textarea class="form-control" id="txt_guardar_eje6" name="txt_guardar_eje6" rows="2" placeholder="EEAG (0-100)" required></textarea>
        </div>
        <div class="evaluacion__1">
            <button type="submit" class="btn btn-primary" id="manual1" name="btn_manual1">Guardar Cambios</button>
        </div>
    </form>


</div>

            
        </div>



    </div>
</div>

</div>
<!-- TÉRMINO MANUALES DIAGNÓSTICO -->
@endsection