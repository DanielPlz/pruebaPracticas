@include('partials.head')

<div class='header w-100'>
    <div class='d-flex justify-content-center'>
        <div class='container p-lg-0 pl-4 pr-4  inner'>
            <div class='row mt-5 w-100 d-flex justify-content-center'>
                <div class='col-lg-6 p-0'>
                    <div class='banner w-100'>
                        <div class='text-center mb-5'>
                            @switch($resp)
                            @case(0)
                            <div class='alert alert-success text-center'>
                                ¡Se ha realizado con éxito su reserva y su cita se encuentra pagada!
                                Se ha enviado una copia a su correo registrado.
                                Este mensaje es automático, será redirigido al detalle de su pago en
                                <span id='relojito'>15</span> segundos...
                            </div>
                            <div class="card text-center">
                                <div class="card-header">
                                    Resumen de Compra Realizada
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Datos del Pago</h5>
                                    <p class="card-text">Orden de Compra: {{ $pago->orden_compra }}</p>
                                    <p class="card-text">Monto: $ {{ $pago->monto }}</p>
                                    <p class="card-text">Cod. Autorización: {{ $pago->cod_autorizacion }}</p>
                                    <p class="card-text">Fecha Transaccion: {{ $pago->fecha }}</p>
                                    <p class="card-text">Tipo de Pago: {{ $pago->tipo_pago }}</p>
                                    <p class="card-text">Tipo de Cuota: {{ $pago->tipo_cuota }}</p>
                                    <p class="card-text">Cantidad de cuotas: {{ $pago->cantidad_cuotas }}</p>
                                    <p class="card-text">Monto de Cuota: {{ $pago->monto_cuota }}</p>
                                    <p class="card-text">N° Cita: {{ $pago->numero_tarjeta }}</p>
                                    <p class="card-text">Cita: {{ $pago->id_cita}}</p>
                                    <p class="card-text">Paciente: {{ $pago->id_paciente }}</p>
                                    <p class="card-text">Servicio: {{ $pago->id_servicio }}</p>

                                    <a href="{{route('pasareladepago.webpay.ordencompra', $pago->orden_compra)}}" class="btn btn-primary"> Ir a Detalle de Pago</a>
                                </div>
                                <div class="card-footer text-muted">
                                    Esto es un resumen de su pago. Para descargar el comprobante lo encontrará en su lista de pagos.
                                </div>
                            </div>
                            @break
                            @case(-1)
                            <div class='alert alert-danger text-center'>
                                Ha ocurrido un error al procesar la transacción (Orden de Compra: {{ $pago->orden_compra }}).
                                Por favor, verifique los datos ingresados al momento de pagar.
                                Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                            </div>
                            @break
                            @case(-2)
                            <div class='alert alert-danger text-center'>
                                Ha ocurrido un error al procesar la transacción .
                                Por favor, verifique los datos de su tarjeta y/o su cuenta asociada.
                                Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                            </div>
                            @break
                            @case(-3)
                            <div class='alert alert-danger text-center'>
                                Ha ocurrido un error al procesar la transacción, su pago a sido rechazado (Orden de Compra: {{ $pago->orden_compra }}).
                                Por favor, verifique su cuenta.
                                Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                            </div>
                            @break
                            @case(-4)
                            <div class='alert alert-danger text-center'>
                                Ha ocurrido un error, la transacción ha sido rechazada (Orden de Compra: {{ $pago->orden_compra }}).
                                Por Favor consulte con el banco de su tarjeta.
                                Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                            </div>
                            @break
                            @case(-5)
                            <div class='alert alert-danger text-center'>
                                ¡Ha ocurrido un error, verifique el estado de su cuenta con su banco! (Orden de Compra: {{ $pago->orden_compra }})
                                Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                            </div>
                            @break
                            @case(-6)
                            <div class='alert alert-danger text-center'>
                                El pago ha sido anulado (Orden de Compra: {{ $pago->orden_compra }}), no se ha generado ningun cargo a su tarjeta.
                                Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                            </div>
                            @break
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script type='text/javascript'>
    window.onload = updateClock;
    var totalTime = 15;

    function updateClock() {
        document.getElementById('relojito').innerHTML = totalTime;
        if (totalTime == 0) {
            if ({{ $resp }} === 0) {
                window.location.replace('/pasareladepago/webpay/ordencompra/{{ $pago->orden_compra }}');
            } else {
                window.location.replace('/pasareladepago/webpay/listCitas');
            }

        } else {
            totalTime -= 1;
            setTimeout('updateClock()', 1500);
        }
    }
</script>
@endsection


@include('partials.footer')
