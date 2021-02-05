<link href="assets/css/text.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<style>
    a {
        color: white;
    }

    a:hover {
        color: #FFBB00;
        ;
    }

    a:active {
        color: #FFBB00;
        ;
    }
</style>
<div class="container">
    <!-- INFORMACIÓN DEL COMERCIO -->
    <div style="text-align: center;">
        <img src="assets/img/logopsicotem3Transparente.png" style="width:100%; max-width:250px;">
    </div>
    <div class="mt-2" style="text-align: center;">
        <span>Psicólogos Temuco</span> |
        <span>Direccion, CL</span> <br>
        <span>(+56 9) 99976406</span> |
        <span>psicologostemuco@gmail.com</span>
    </div>
    <!-- INFORMACIÓN DEL COMERCIO -->
    <!-- INFORMACIÓN DEL CLIENTE -->
    <table class="table table-sm customer-grid mt-2">
        <thead>
            <tr style="background-color: #FFBB00;">
                <th colspan="4">INFORMACIÓN DE CLIENTE</th>
            </tr>
        </thead>
        <tr>
            <td> Nombre: </td>
            <td nowrap>
                {{$user->name}} {{$user->apellido}}
            </td>
            <td> Correo: </td>
            <td>
                {{$user->email }}
            </td>
        </tr>
    </table>
    <!-- INFORMACIÓN DEL CLIENTE -->
    <!-- INFORMACIÓN DEL TRANSACCIÓN -->
    <table class="table table-sm customer-grid mt-2">
        <tr style="background-color: #FFBB00;">
            <th colspan="5" style="font-size: small;">DATOS DE TRANSACCIÓN</th>
        </tr>
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
                <span>Cod. Autorización:</span>
            </td>
            <td>
                {{$pago->cod_autorizacion}}
            </td>
            <td>
                <span>N° de Cuotas:</span>
            </td>
            <td style="text-align: left;">
                {{$pago->cantidad_cuotas}} <span class="text-muted" style="font-size: x-small;"> (de $ {{$pago->monto_cuota }})</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span>Hora: </span>
            </td>
            <td>
                {{ date('H:i', strtotime($pago->fecha)) }}
            </td>
            <td>
                <span>Fecha: </span>
            </td>
            <td style="text-align: left;">
                {{ date('d-m-Y', strtotime($pago->fecha)) }}
            </td>
        </tr>
    </table>
    <!-- INFORMACIÓN DEL TRANSACCIÓN -->
    <!-- DETALLE DE TRANSACCIÓN -->
    <table class="table table-sm customer-grid mt-2">
        <thead style="background-color: #FFBB00; font-size: small;">
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
    <!-- DETALLE DE TRANSACCIÓN -->
    <!-- MENSAJES FINALES -->
    <div>
        <div class="text-right">¡Gracias por tu preferencia! </div>
        <div class="text-right">Equipo Psicólogos Temuco</div>
    </div>
    <div class="mt-2">
        <span>Aviso: El descuento aplicado al pago sera según la previsión de Salud.</span>
    </div>
    <!-- MENSAJES FINALES -->
    <!-- FOOTER -->
    <footer class="page-footer">
        <div style="background-color: #484AF0;">
            <!-- SEGURIDAD -->
            <table class="table table-sm table-borderless" style="font-size: x-small; background-color: #969BAA;">
                <tbody>
                    <tr>
                        <td rowspan="2" class="text-center mt-3">
                            <img src="assets/img/icons8_warning_shield_48.png">
                        </td>
                        <td> No abrá e-mail ni SMS desconocidos.</td>
                        <td> Mantenga actualizado su antivirus. </td>
                    </tr>
                    <tr>
                        <td>No haga clic en enlaces o archivos de esos e-mails ni SMS.</td>
                        <td>Desconfíe de mensajes de ofertas, promociones o premios increíbles. </td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            <!-- SEGURIDAD -->
            <!-- RR.SS -->
            <div class="row py-2 d-flex align-items-center">
                <div class="col-md-12 text-center" style="font-size: smaller;">
                    <a href="https://www.facebook.com/PsicologosTemucoIX/"> <img class="mt-1" src="assets/img/icons8_facebook_old_16.png"> | @PsicólogosTemucoIX </a>
                    <a href="https://www.linkedin.com/in/psicologos-temuco-7b6064196"> <img class="mt-1" src="assets/img/icons8_LinkedIn_16.png"> | Psicólogos Temuco </a>
                    <a href="https://www.instagram.com/psicologostemuco"> <img class="mt-1" src="assets/img/icons8_instagram_16.png"> | @psicologostemuco </a>
                </div>
            </div>
            <div class="text-center" style="color: white;">
                Psicólogos Temuco. Copyright &copy; Todos los derechos reservados.
            </div>
            <!-- RR.SS -->
        </div>
    </footer>
    <!-- FOOTER -->
</div>


<!-- <footer class="text-center mt-2" style="background-color: #484AF0; color: white;">
        <div style="justify-content: space-around;">
            <img class="mt-2" style="text-align: center;" src="assets/img/icons8_facebook_old_16.png"> |
            <a href=""> Psicólogos Temuco </a>
        </div>
        <div style="justify-content: space-around;">
            <img class="mt-2" style="text-align: center;" src="assets/img/icons8_instagram_16.png"> |
            <a href=""> Psicólogos Temuco </a>
        </div>
        <div style="justify-content: space-around;">
            <img class="mt-2" style="text-align: center;" src="assets/img/icons8_twitter_16.png"> |
            <a href=""> Psicólogos Temuco </a>
        </div>
        <div>Psicólogos Temuco. Copyright © Todos los derechos reservados.</div>

    </footer> -->

<!-- <tr>
            <td> Fecha Cita: </td>
            <td> {{ $cita->fecha }} </td>
            <td> Horario Cita: </td>
            <td> {{$cita->hora_inicio }} {{$cita->hora_termino }} </td>
        </tr> -->
