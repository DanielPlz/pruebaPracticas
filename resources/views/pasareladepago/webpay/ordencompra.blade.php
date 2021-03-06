@extends('layouts.dashboard')
@extends('layouts.app')
@section('contentSidebar')

@if (session('mensaje'))
<div class="alert alert-success text-center" id="mensajeAviso">
    {{session('mensaje')}}
</div>
@endif


<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <h3>Detalle Orden de Compra</h3>
            <!-- DATOS CLIENTE -->
            <table class="table table-responsive-sm customer-grid mt-2">
                <thead>
                    <tr style="background-color: #FFBB00;">
                        <th colspan="4">INFORMACIÓN DE CLIENTE</th>
                    </tr>
                </thead>
                <tr>
                    <td class="td-grey" width="20%">Nombre: </td>
                    <td> {{$user->name}} {{$user->apellido}}</td>
                    <td class="td-grey">Correo: </td>
                    <td> {{$user->email}}</td>
                </tr>
            </table>
            <!-- DATOS CLIENTE -->

            <!-- DATOS DE TRANSACCIÓN -->
            <table class="table table-responsive-sm customer-grid">
                <thead>
                    <tr style="background-color: #FFBB00;">
                        <th colspan="7">DATOS DE TRANSACCIÓN</th>
                    </tr>
                </thead>
                <tr>
                    <td colspan="2" nowrap>
                        <span>Orden de Compra:</span>
                    </td>
                    <td style="text-align: left">
                        {{$pago->orden_compra}}
                    </td>
                    <td>
                        <span>Tipo de Pago:</span>
                    </td>
                    <td style="text-align: left" nowrap>
                        {{$pago->tipo_pago}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span>N° de Tarjeta:</span>
                    </td>
                    <td>
                        {{$pago->numero_tarjeta}}
                    </td>
                    <td nowrap>
                        <span>Tipo de Cuota:</span>
                    </td>
                    <td nowrap style="text-align: left">
                        {{$pago->tipo_cuota}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span>C&oacute;digo Autorización:</span>
                    </td>
                    <td>
                        {{$pago->cod_autorizacion}}
                    </td>
                    <td>
                        <span>N° de Cuotas:</span>
                    </td>
                    <td style="text-align: left;">
                        {{$pago->cantidad_cuotas}} <span class="text-muted" style="font-size: small;"> (de $ {{$pago->monto_cuota }})</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span>Hora Transacción: </span>
                    </td>
                    <td>
                        {{ date('H:i:s', strtotime($pago->fecha)) }}
                    </td>
                    <td>
                        <span>Fecha Transacción: </span>
                    </td>
                    <td style="text-align: left;">
                        {{ date('Y-m-d', strtotime($pago->fecha)) }}
                    </td>
                </tr>
            </table>
            <!-- DATOS DE TRANSACCIÓN -->

            <!-- DETALLE COMPRA -->
            <table class="table table-responsive-sm customer-grid mt-2">
                <thead style="background-color: #FFBB00;">
                    <tr>
                        <th>Descripción</th>
                        <th>Fecha Cita</th>
                        <th>Hora Cita</th>
                        <th>&nbsp;</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $servicio->descripcion }}
                        </td>
                        <td>
                            {{ $cita->fecha }}
                        </td>
                        <td colspan="2">
                            {{ date('H:i', strtotime($cita->hora_inicio)) }} - {{ date('H:i', strtotime($cita->hora_termino)) }}
                        </td>
                        <td>
                            $ {{ $pago->monto }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">
                            Subtotal
                            <span class="text-muted" style="font-size: xx-small;"> (CLP)</span>
                            :
                        </td>
                        <td>$ {{ $pago->monto }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Desc. (x%):</td>
                        <td>$ 0</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">
                            Total
                            <span class="text-muted" style="font-size: xx-small;"> (CLP)</span>
                            :
                        </td>
                        <td> $ {{ $pago->monto }}</td>
                    </tr>
                </tfoot>
            </table>
            <!-- DETALLE COMPRA -->
        </div>
        <!-- ACCIONES -->
        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-auto mr-auto">
                    <form action="{{route('pasareladepago.webpay.correoopcional')}}" method="POST">
                        @csrf
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping">Correo Electronico:</span>
                            </div>
                            <input name="pagid" type="hidden" value="{{$pago->id}}">
                            <input type="email" class="form-control" placeholder="Ingrese un correo electrónico opcional" name="mail">
                            <button type="submit" class="btn btn-info" id="enviar">
                                Enviar
                                <i class="far fa-envelope"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-auto">
                    <form action="{{route('pasareladepago.webpay.pagodetalle',$pago)}}">
                        @csrf
                        <div class="input-group flex-nowrap">
                            <button type="submit" class="btn btn-success">
                                Descargar
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ACCIONES -->
    </div>
</div>

@stop

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $("#mensajeAviso").fadeOut(5000);
        }, 3000);

    });
</script>
@endsection
