@extends('layouts.dashboard')
{{-- @extends('layouts.app')--}}
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
                    <th scope="col" class="title-4 text-center">Fecha</th>
                    <th scope="col" class="title-4 text-center">Hora inicio</th>
                    <th scope="col" class="title-4 text-center">Hora Termino</th>
                    <th scope="col" class="title-4 text-center">Modalidad</th>
                    <th scope="col" class="title-4 text-center">Confirmación</th>
                    <th scope="col" class="title-4 text-center">Pago</th>
{{--                    <th scope="col" class="title-4 text-center">Prevision</th>--}}
{{--                    <th scope="col" class="title-4 text-center">Isapre</th>--}}
                    <th scope="col" class="title-4 text-center">Precio</th>
                    <th scope="col" class="title-4 text-center">Pagar</th>
                </tr>
            </thead>
            <div>
                <form action="{{route('pasareladepago.webpay.filtroEstado')}}" method="GET">
                    @csrf
                    <div class="input-group mb-3">
                        <select class="custom-select" name="estadoPago">
                            <option value='0' selected>Seleccionar...</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Pagado">Pagado</option>
                        </select>
                        <div class="input-group-append">
                            <input class="btn btn-primary" style="background-color: #3B83AE;" type="submit" value="Filtrar">
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <tbody>
                @foreach ($reserva as $reservas)

                <tr>
                    <th scope="row" class="text-center">{{$rank++}}</th>
                    <td class="text-center">{{ date('d-m-Y', strtotime($reservas->fecha))}}</td>
                    <td class="text-center">{{ date('H:m', strtotime($reservas->hora_inicio)) }}</td>
                    <td class="text-center">{{ date('H:m', strtotime($reservas->hora_termino)) }}</td>
                    <td class="text-center">{{$reservas->modalidad}}</td>
                    <td class="text-center" style="color: #FFF">
                        @if ($reservas->confirmacion === 'Sin Confirmar')
                        <span class="badge bg-danger">{{$reservas->confirmacion}}</span>
                        @elseif ($reservas->estado === 'Confirmado')
                        <span class="badge bg-warning">{{$reservas->confirmacion}}</span>
                        @else
                        <span class="badge bg-success">{{$reservas->confirmacion}}</span>
                        @endif
                    </td>
                    <td class="text-center" style="color: #FFF">
                        @if($reservas->estado_pago === 'Pagado')
                        <span class="badge bg-success">{{$reservas->estado_pago}}</span>
                        @else
                        <span class="badge bg-danger">{{$reservas->estado_pago}}</span>
                        @endif
                    </td>
{{--                    <td class="text-center">{{$reservas->prevision}}</td>--}}
{{--                    <td class="text-center">{{$reservas->isapre}}</td>--}}
                    <td class="text-center">{{$reservas->precio}}</td>
                    @if($reservas->estado_pago=="Pendiente")
                    <td class="text-center" style="color: #FFF">
                        <form action="{{route('pasareladepago.webpay.rest.checkout')}}" method="POST">
                            <input type="hidden" name="id_cita" value="{{$reservas->id}}">
                            <button type="submit" class="btn btn-danger">Pagar</button>
                        </form>
                    </td>
                    @else
                    <td>
                        <button type="button" class="btn btn-block btn-success" disabled>
                            <i class="far fa-check-circle" style="font-size: 24px;"></i>
                        </button>
                    </td>
                    @endif
                </tr>

                @endforeach
            </tbody>
        </table>
        @if(Session::has('aviso'))
        <div>{{Session::get('aviso')}}</div>
        @endif
    </div>
</div>
<ul class="pagination justify-content-center">{{$reserva->appends(request()->query())->links()}}</ul>
@stop
