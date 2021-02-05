@extends('layouts.dashboard')
@extends('layouts.app')
@section('contentSidebar')

@if (session('mensaje'))
<div class="alert alert-success text-center">
    {{session('mensaje')}}
</div>
@endif

<div class="container">

    <a href="{{route('pasareladepago.webpay.vista')}}">
        <button type="submit" class="btn btn-primary">Lista de pagos</button>

    </a>


    <div class="table-responsive">
        <div class="text-center mb-4">
            <h1 class="title-1">Lista de Citas</h1>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="title-4 text-center">N°</th>
                    <th scope="col" class="title-4 text-center">Fecha</th>
                    <th scope="col" class="title-4 text-center">Hora inicio</th>
                    <th scope="col" class="title-4 text-center">Hora Termino</th>
                    <th scope="col" class="title-4 text-center">Modalidad</th>
                    <th scope="col" class="title-4 text-center">Confirmación</th>
                    <th scope="col" class="title-4 text-center">Pago</th>
                    <th scope="col" class="title-4 text-center">Prevision</th>
                    <th scope="col" class="title-4 text-center">Isapre</th>
                    <th scope="col" class="title-4 text-center">Precio</th>
                    <th scope="col" class="title-4 text-center">Pagar</th>
                </tr>
            </thead>
            <div>
                <form action="{{route('pasareladepago.webpay.filtroEstado')}}" method="GET">
                    @csrf
                    Fecha:
                    <select name="estadoPago">
                        <option value="Pendiente" selected>pendiente</option>
                        <option value="Pagado">Pagado</option>
                    </select>

                    <input type="submit" value="Filtrar">
                </form>
            </div>
            <br>
            <tbody>
                @foreach ($cita as $citas)
                <tr>
                    <th scope="row" class="text-center">{{$rank++}}</th>
                    <td class="text-center">{{ date('d-m-Y', strtotime($citas->fecha))}}</td>
                    <td class="text-center">{{ date('H:m', strtotime($citas->hora_inicio)) }}</td>
                    <td class="text-center">{{ date('H:m', strtotime($citas->hora_termino)) }}</td>
                    <td class="text-center">{{$citas->modalidad}}</td>
                    <td class="text-center">{{$citas->estado}}</td>
                    <td class="text-center">{{$citas->estado_pago}}</td>
                    <td class="text-center">{{$citas->prevision}}</td>
                    <td class="text-center">{{$citas->isapre}}</td>
                    <td class="text-center">{{$citas->precio}}</td>
                    <td class="text-center">
                        <form action="{{route('pasareladepago.webpay.rest.checkout')}}" method="POST">
                            @csrf
                            <input type="hidden" name="citaID" value="{{$citas->id}}">
                            <button type="submit" class="btn btn-primary">Pagar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(Session::has('aviso'))
        <div>{{Session::get('aviso')}}</div>
        @endif
    </div>
</div>
<ul class="pagination justify-content-center">{{$cita->links()}}</ul>
@stop
