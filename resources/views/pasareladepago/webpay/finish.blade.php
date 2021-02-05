@extends('pasareladepago.webpay.layoutvoucher')
@if (Session::get('responseCode') !== null)
    @switch(Session::get('responseCode'))
        @case(0)
            @section('msje')
                    <div class='alert alert-success text-center'>
                        ¡Se ha realizado con éxito su reserva y su cita se encuentra pagada!
                        Se ha enviado una copia a su correo registrado.
                        Este mensaje es automático, será redirigido al detalle de su pago en
                        <span id='relojito'>15</span> segundos...
                    </div>
                    <object id="pdf" class="embed-responsive-item"
                        data="{{route('pasareladepago.webpay.visualizaciondetalle', Session::get('pago'))}}#zoom=0&toolbar=0&navpanes=0&scrollbar=0"
                        type="application/pdf" width="100%" height="600px">
                            <embed class="embed-responsive-item"
                            src="{{route('pasareladepago.webpay.visualizaciondetalle', Session::get('pago'))}}#zoom=0&toolbar=0&navpanes=0&scrollbar=0"
                            type="application/pdf" sandbox/>
                    </object>
            @endsection
            @section('script')
                <script type='text/javascript'>
                    window.onload = updateClock;
                        var totalTime = 15;
                            function updateClock()
                            {
                                document.getElementById('relojito').innerHTML = totalTime;
                                if(totalTime == 0){
                                        window.location.replace("/pasareladepago/webpay/ordencompra/{{ Session::get('pago') }}")
                                } else {
                                        totalTime-=1;
                                        setTimeout('updateClock()', 1500);
                                }
                            }
                </script>
            @endsection
            @php
                Session::forget('pago');
                Session::forget('responseCode');
            @endphp
            @break
        @case(-1)
            @php
                Session::forget('responseCode');
                Session::forget('pago');
            @endphp
            @section('msje')
                <div class='alert alert-danger text-center'>
                    Ha ocurrido un error al procesar la transacción (Orden de Compra: {{ Session::get('orderbuy') }}).
                    Por favor, verifique los datos ingresados al momento de pagar.
                    Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                </div>
            @endsection
            @section('script')
                <script type='text/javascript'>
                    window.onload = updateClock;
                        var totalTime = 15;
                            function updateClock()
                            {
                                document.getElementById('relojito').innerHTML = totalTime;
                                if(totalTime == 0){
                                            window.location.replace('/pasareladepago/webpay/listCitas')
                                } else {
                                        totalTime-=1;
                                        setTimeout('updateClock()', 1500);
                                    }
                            }
                </script>
            @endsection
            @break
        @case(-2)
                @php
                    Session::forget('responseCode');
                    Session::forget('pago');
                @endphp
                @section('msje')
                    <div class='alert alert-danger text-center'>
                        Ha ocurrido un error al procesar la transacción (Orden de Compra: {{ Session::get('orderbuy') }}).
                        Por favor, verifique los datos de su tarjeta y/o su cuenta asociada.
                        Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                    </div>
                @endsection
            @section('script')
                <script type='text/javascript'>
                    window.onload = updateClock;
                        var totalTime = 15;
                            function updateClock()
                            {
                                document.getElementById('relojito').innerHTML = totalTime;
                                if(totalTime == 0){
                                            window.location.replace('/pasareladepago/webpay/listCitas')
                                } else {
                                        totalTime-=1;
                                        setTimeout('updateClock()', 1500);
                                    }
                            }
                </script>
            @endsection
            @break
        @case(-3)
            @php
                Session::forget('responseCode');
                Session::forget('pago');
            @endphp
            @section('msje')
                <div class='alert alert-danger text-center'>
                    Ha ocurrido un error al procesar la transacción, su pago a sido rechazado (Orden de Compra: {{ Session::get('orderbuy') }}). Por favor, verifique su cuenta.
                    Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                </div>
            @endsection
            @section('script')
                <script type='text/javascript'>
                    window.onload = updateClock;
                        var totalTime = 15;
                            function updateClock()
                            {
                                document.getElementById('relojito').innerHTML = totalTime;
                                if(totalTime == 0){
                                            window.location.replace('/pasareladepago/webpay/listCitas')
                                } else {
                                        totalTime-=1;
                                        setTimeout('updateClock()', 1500);
                                    }
                            }
                </script>
            @endsection
            @break
        @case(-4)
            @php
                Session::forget('responseCode');
                Session::forget('pago');
            @endphp
            @section('msje')
                <div class='alert alert-danger text-center'>
                    Ha ocurrido un error, la transacción ha sido rechazada (Orden de Compra: {{ Session::get('orderbuy') }}). Favor consulte con el banco de su tarjeta.
                    Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                </div>
            @endsection
            @section('script')
                <script type='text/javascript'>
                    window.onload = updateClock;
                        var totalTime = 15;
                            function updateClock()
                            {
                                document.getElementById('relojito').innerHTML = totalTime;
                                if(totalTime == 0){
                                            window.location.replace('/pasareladepago/webpay/listCitas')
                                } else {
                                        totalTime-=1;
                                        setTimeout('updateClock()', 1500);
                                    }
                            }
                </script>
            @endsection
            @break
        @case(-5)
            @php
                Session::forget('responseCode');
                Session::forget('pago');
            @endphp
            @section('msje')
                    <div class='alert alert-danger text-center'>
                        ¡Ha ocurrido un error, verifique el estado de su cuenta con su banco! (Orden de Compra: {{ Session::get('orderbuy') }})
                        Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
                    </div>
            @endsection
            @section('script')
                <script type='text/javascript'>
                    window.onload = updateClock;
                        var totalTime = 15;
                            function updateClock()
                            {
                                document.getElementById('relojito').innerHTML = totalTime;
                                if(totalTime == 0){
                                            window.location.replace('/pasareladepago/webpay/listCitas')
                                } else {
                                        totalTime-=1;
                                        setTimeout('updateClock()', 1500);
                                    }
                            }
                </script>
            @endsection
            @break
    @endswitch
@else

    @section('msje')
        <div class='alert alert-danger text-center'>
                    El pago ha sido anulado (Orden de Compra: {{ Session::get('orderbuy') }}), no se ha generado ningun cargo a su tarjeta.
                    Este mensaje es automático, será redirigido en <span id='relojito'>15</span> segundos...
        </div>
    @endsection
    @section('script')
        <script type='text/javascript'>
            window.onload = updateClock;
                var totalTime = 15;
                    function updateClock()
                    {
                        document.getElementById('relojito').innerHTML = totalTime;
                        if(totalTime == 0){
                                    window.location.replace('/pasareladepago/webpay/listCitas')
                        } else {
                                totalTime-=1;
                                setTimeout('updateClock()', 1500);
                            }
                    }
        </script>
    @endsection

@endif


@php
    Session::forget('responseCode');
    Session::forget('pago');
    Session::forget('orderbuy');
@endphp


