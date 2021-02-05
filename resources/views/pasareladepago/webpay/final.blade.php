@session_start();

@if (isset($_SESSION['responseCode']))
    @switch($_SESSION['responseCode'])
        @case(0)
                <div class='header w-100'>
                    <div class='d-flex justify-content-center'>
                        <div class='container p-lg-0 pl-4 pr-4  inner'>
                            <div class='row mt-5 w-100 d-flex justify-content-center'>
                                <div class='col-lg-6 p-0'>
                                    <div class='banner w-100'>
                                        <div class='text-center mb-5'>
                                            <div class='alert alert-success text-center'>¡Se ha realizado con éxito su reserva!.
                                                Este mensaje es automático, será redirigido en <span id='relojito'>10</span> segundos...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @case(-1)
                <div class='header w-100'>
                    <div class='d-flex justify-content-center'>
                        <div class='container p-lg-0 pl-4 pr-4  inner'>
                            <div class='row mt-5 w-100 d-flex justify-content-center'>
                                <div class='col-lg-6 p-0'>
                                    <div class='banner w-100'>
                                        <div class='text-center mb-5'>
                                            <div class='alert alert-danger text-center'>
                                                Ha ocurrido un error en la transacción, compruebe los datos ingresados en la transacción. Por favor, verifique su cuenta.
                                                Este mensaje es automático, será redirigido en <span id='relojito'>10</span> segundos...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @case(-2)
                <div class='header w-100'>
                    <div class='d-flex justify-content-center'>
                        <div class='container p-lg-0 pl-4 pr-4  inner'>
                            <div class='row mt-5 w-100 d-flex justify-content-center'>
                                <div class='col-lg-6 p-0'>
                                    <div class='banner w-100'>
                                        <div class='text-center mb-5'>
                                            <div class='alert alert-danger text-center'>Ha ocurrido un error al procesar la transacción. Por favor, verifique su cuenta.
                                                Este mensaje es automático, será redirigido en <span id='relojito'>10</span> segundos...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @case(-3)
                <div class='header w-100'>
                    <div class='d-flex justify-content-center'>
                        <div class='container p-lg-0 pl-4 pr-4  inner'>
                            <div class='row mt-5 w-100 d-flex justify-content-center'>
                                <div class='col-lg-6 p-0'>
                                    <div class='banner w-100'>
                                        <div class='text-center mb-5'>
                                            <div class='alert alert-success text-center'>Ha ocurrido un error interno desde Transbank. Por favor, verifique su cuenta."
                                                Este mensaje es automático, será redirigido en <span id='relojito'>10</span> segundos...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @case(-4)
                <div class='header w-100'>
                    <div class='d-flex justify-content-center'>
                        <div class='container p-lg-0 pl-4 pr-4  inner'>
                            <div class='row mt-5 w-100 d-flex justify-content-center'>
                                <div class='col-lg-6 p-0'>
                                    <div class='banner w-100'>
                                        <div class='text-center mb-5'>
                                            <div class='alert alert-success text-center'>Ha ocurrido un error, la transacción ha sido rechazada. Favor consulte con el banco de su tarjeta.
                                                Este mensaje es automático, será redirigido en <span id='relojito'>10</span> segundos...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @case(-5)
                <div class='header w-100'>
                    <div class='d-flex justify-content-center'>
                        <div class='container p-lg-0 pl-4 pr-4  inner'>
                            <div class='row mt-5 w-100 d-flex justify-content-center'>
                                <div class='col-lg-6 p-0'>
                                    <div class='banner w-100'>
                                        <div class='text-center mb-5'>
                                            <div class='alert alert-success text-center'>¡Ha ocurrido un error, verifique su estado de cuenta y su cuenta con su banco.
                                                Este mensaje es automático, será redirigido en <span id='relojito'>10</span> segundos...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @default

    @endswitch
@else
                <div class='header w-100'>
                    <div class='d-flex justify-content-center'>
                        <div class='container p-lg-0 pl-4 pr-4  inner'>
                            <div class='row mt-5 w-100 d-flex justify-content-center'>
                                <div class='col-lg-6 p-0'>
                                    <div class='banner w-100'>
                                        <div class='text-center mb-5'>
                                            <div class='alert alert-success text-center'>El pago ha sido anulado, no se ha generado ningun cargo a su tarjeta.
                                                Este mensaje es automático, será redirigido en <span id='relojito'>10</span> segundos...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endif


 <script type='text/javascript'>
                    window.onload = updateClock;
                        var totalTime = 10;
                        function updateClock() {
                            document.getElementById('relojito').innerHTML = totalTime;
                            if(totalTime==0){
                                window.location.replace('/pasareladepago/webpay/listCitas');
                                window.open('/pasareladepago/webpay/visualizardetalle/18', '_blank');

                            }else{
                                totalTime-=1;
                                setTimeout('updateClock()',1000);
                            }
                        }
                </script>


@extends('layouts.app')

<?php

session_start();
//  var_dump($_SESSION['responseCode']);

if (isset($_SESSION['responseCode'])) {
    switch ($_SESSION['responseCode']) {
        case (0):
            echo mensajeAlerta("¡Se ha realizado con éxito su reserva!.", "success");
            echo scriptCuentaRegresiva();
            session_destroy();
            break;
        case (-1):
            echo mensajeAlerta("Ha ocurrido un error en la transacción, compruebe los datos ingresados en la transacción. Por favor, verifique su cuenta.", "danger");
            echo scriptCuentaRegresiva();
            session_destroy();
            break;
        case (-2):
            echo mensajeAlerta("Ha ocurrido un error al procesar la transacción. Por favor, verifique su cuenta.", "danger");
            echo scriptCuentaRegresiva();
            session_destroy();
            break;
        case (-3):
            echo mensajeAlerta("Ha ocurrido un error interno desde Transbank. Por favor, verifique su cuenta.", "danger");
            echo scriptCuentaRegresiva();
            session_destroy();
            break;
        case (-4):
            echo mensajeAlerta("Ha ocurrido un error, la transacción ha sido rechazada. Favor consulte con el banco de su tarjeta.", "danger");
            echo scriptCuentaRegresiva();
            session_destroy();
            break;
        case (-5):
            echo mensajeAlerta("Ha ocurrido un error, verifique su estado de cuenta y su cuenta con su banco.", "danger");
            echo scriptCuentaRegresiva();
            session_destroy();
            break;
    }
} else {
    echo mensajeAlerta('El pago ha sido anulado, no se ha generado ningun cargo a su tarjeta.', "danger");
    echo scriptCuentaRegresiva();
    session_destroy();
}




/**
 * TODO: Función de mensaje alerta.
 * Retorna una bloque de HTML personalizado con el mensaje de alerta correspondiente.
 * @param String $mensaje  -> Mensaje de alerta según resultado de la transacción
 * @param String $tipo     -> Valor correspondiente a si la alerta será a modo de error o de éxito.
 * @return $html
 */
function mensajeAlerta($mensaje, $tipo)
{
    $html =
        "<div class='header w-100'>
        <div class='d-flex justify-content-center'>
            <div class='container p-lg-0 pl-4 pr-4  inner'>
                <div class='row mt-5 w-100 d-flex justify-content-center'>
                    <div class='col-lg-6 p-0'>
                        <div class='banner w-100'>
                            <div class='text-center mb-5'>
                                <div class='alert alert-" . $tipo . " text-center'>"
                                    . $mensaje . "
                                    Este mensaje es automático, será redirigido en <span id='relojito'>10</span> segundos...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
    return $html;
}

/**
 * TODO: Función para retornar script de cuenta regresiva.
 * Retorna una bloque de JavaScript para realizar una cuenta regresiva desde 10 segundos.
 * NOTE: Según sea la necesidad puede cambiar la página a redireccionar.
 * @return $script
 */
function scriptCuentaRegresiva()
{
    // $pago = $_SESSION['pago'];
    $script = " <script type='text/javascript'>
                    window.onload = updateClock;
                        var totalTime = 10;
                        function updateClock() {
                            document.getElementById('relojito').innerHTML = totalTime;
                            if(totalTime==0){
                                window.location.replace('/pasareladepago/webpay/listCitas');
                                window.open('/pasareladepago/webpay/visualizardetalle/18', '_blank');

                            }else{
                                totalTime-=1;
                                setTimeout('updateClock()',1000);
                            }
                        }
                </script>";
    return $script;
}

?>
