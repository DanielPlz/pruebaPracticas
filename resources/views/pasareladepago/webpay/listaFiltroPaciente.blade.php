@extends('layouts.dashboard')
@extends('layouts.app')
@section('contentSidebar')

@if (session('mensaje'))
<div class="alert alert-success text-center">
    {{session('mensaje')}}
</div>
@endif

<div class="container">
    <div class="table-responsive">
        <div class="text-center mb-4 mt-5">
            <h1 class="title-1">Lista de Citas</h1>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="title-4 text-center">N°</th>
                    <th scope="col" class="title-4 text-center">RUT</th>
                    <th scope="col" class="title-4 text-center">Paciente</th>
                    <th scope="col" class="title-4 text-center">Servicio</th>
                    <th scope="col" class="title-4 text-center">Fecha</th>
                    <th scope="col" class="title-4 text-center">Horario
                        <span class="text-muted">(Inicio - Termino)</span></th>|
                    <th scope="col" class="title-4 text-center">Modalidad</th>
                    <th scope="col" class="title-4 text-center">Confirmación</th>
                    <th scope="col" class="title-4 text-center">Pago</th>
                    <th scope="col" class="title-4 text-center">Prevision</th>
                </tr>
            </thead>

            <form action="{{route('pasareladepago.webpay.filtrarPaciente')}}" method="GET">
                @csrf
                <div class="form-inline float-right mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #484AF0; color: white">
                            Buscar Por
                        </span>
                    </div>
                    <select class="custom-select" name="buscarpor">
                        <option value="" selected>Selecionar...</option>
                        <option value="rut">RUT</option>
                        <option value="nombre">Nombre</option>
                        <!-- <option value="3">Three</option> -->
                    </select>
                    <!-- <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #484AF0;">
                            <i class="fas fa-search" style="color:white"></i></span>
                        <input type="text" class="form-control" name="rut" placeholder="Ingrese RUT">
                    </div> -->
                    <!-- <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #484AF0;">
                            <i class="fas fa-search" style="color:white"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Nombre o Apellido del Paciente">
                    </div> -->
                    <div class="input-group-prepend">
                        <!-- <span class="input-group-text" style="background-color: #484AF0;">
                            <<i class="fas fa-search" style="color:white"></i>
                        </span> -->
                        <input type="text" class="form-control" name="buscar" placeholder="Ingrese los datos">
                    </div>
                    <div class=" input-group-append">
                        <input class="btn btn-primary" style="background-color: #484AF0;" type="submit" value="Filtrar"></input>
                    </div>
                </div>

            </form>
            <br>
            <tbody>
                @foreach ($cita as $citas)
                <tr>
                    <th scope="row" class="text-center">{{$rank++}}</th>
                    <td class="text-center">{{$citas->rutPaciente}}</td>
                    <td class="text-center">{{$citas->paciente}}</td>
                    <td class="text-center">{{$citas->servicio}}</td>
                    <td class="text-center">{{$citas->fecha}}</td>
                    <td class="text-center">{{$citas->horario}}</td>
                    <td class="text-center">{{$citas->modalidad}}</td>
                    <td class="text-center" style="color: #FFF">
                        @if ($citas->estado === 'Sin Confirmar')
                        <span class="badge bg-danger">{{$citas->estado}}</span>
                        @elseif ($citas->estado === 'Confirmado')
                        <span class="badge bg-warning">{{$citas->estado}}</span>
                        @else
                        <span class="badge bg-success">{{$citas->estado}}</span>
                        @endif
                    </td>
                    <td class="text-center" style="color: #FFF">
                        @if($citas->estado_pago === 'Pagado')
                        <span class="badge bg-success">{{$citas->estado_pago}}</span>
                        @else
                        <span class="badge bg-danger">{{$citas->estado_pago}}</span>
                        @endif
                    </td>
                    <td class="text-center">{{$citas->prevision}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
        @if(Session::has('aviso'))
        <div>{{Session::get('aviso')}}</div>
        @endif
    </div>
</div>
<ul class="pagination justify-content-center">{{$cita->appends(request()->query())->links()}}</ul>
@stop
