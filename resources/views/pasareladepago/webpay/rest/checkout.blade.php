@include('partials.head')


<div class='header w-100'>
    <div class='d-flex justify-content-center'>
        <div class='container p-lg-0 pl-4 pr-4  inner'>
            <div class='row mt-5 w-100 d-flex justify-content-center'>
                <div class='col-lg-6 p-0'>
                    <div class='banner w-100'>
                        <div class='text-center mb-5'>
                            <div class="card text-center">
                                <div class="card-header">
                                    Proceso de Pago
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Datos de la Reserva</h5>
                                    <p class="card-text"> Usted realizará el pago para la siguiente reserva: </p>
                                    <span>N° de Cita: {{ $cita->id }}</span>
                                    <br>
                                    <span>Valor Cita: $ {{ $cita->precio }}</span>
                                    <br>
                                    <span>Hora de Cita: {{date('H:i', strtotime($cita->fecha))}} </span>
                                    <br>
                                    <span>Fecha de Cita: {{date('d-m-Y', strtotime($cita->fecha))}} </span>
                                    <br>
                                    <span>Servicio: {{ print_r($servicio['nombre']) }} </span>
                                </div>
                                <div class="card-footer">
                                    <div class="btn-group" role="group">
                                        <a href="/pasareladepago/webpay/listCitas">
                                            <button class="btn btn-danger">Volver Atrás</button>
                                        </a>
                                        <form method="post" action="{{$return}}">
                                            <input type="hidden" name="token_ws" value="{{$token}}" />
                                            <input class="btn btn-primary" type="submit" value="Ir a pagar" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('partials.footer')
