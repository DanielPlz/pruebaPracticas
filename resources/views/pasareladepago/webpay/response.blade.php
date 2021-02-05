<?php

session_start();

use App\Pago;
use App\Cita;
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\RedirectorHelper;
use Freshwork\Transbank\TransbankServiceFactory;

require_once './../vendor/autoload.php';

$bag = CertificationBagFactory::integrationWebpayNormal();
$webpay = TransbankServiceFactory::normal($bag);

$result = $webpay->getTransactionResult();

$output = $result->detailOutput;

session()->put('responseCode', $result->detailOutput->responseCode);




if ($result->detailOutput->responseCode == 0) {

    /* ============================================================== */
    /*  Asignación de la fecha de TransBank y formato                 */
    /* ============================================================== */

    $dt = new DateTime($result->transactionDate);
    $dt->format('Y-m-d H:m:s');

    /* ============================================================== */
    /*  Instancia del modelo de Pago y Cita                           */
    /* ============================================================== */
    $pago = new Pago();
    $cita = new Cita();
    //$CitaPago = session('citaPago');
    $CitaP = session('citaSession');
    $cita = $CitaP;
    //$idCit= session('citaID');
    //echo(session('citaID'));
    // echo("<br>");
    //echo($CitaP['id']);
    // echo($CitaP->id);
    //echo($idCit);

    /* ============================================================== */
    /*  Captura del id de usuario                                     */
    /* ============================================================== */
    if (auth()->user()) {
        $cita->user_id = auth()->user()->id;
    }

    /* ============================================================== */
    /*  Asignación de datos para guardar en Base de Datos             */
    /* ============================================================== */
    $pago->fecha = $dt;
    switch ($output->paymentTypeCode) {
        case ($output->paymentTypeCode == 'VN'):
            $pago->tipo_pago = "Crédito";
            $pago->tipo_cuota = 'Sin cuotas';
            break;
        case ($output->paymentTypeCode == 'VD'):
            $pago->tipo_pago = "Débito";
            $pago->tipo_cuota = 'No Aplica';
            break;
        case ($output->paymentTypeCode == 'SI'):
            $pago->tipo_pago = "Crédito";
            $pago->tipo_cuota = 'Sin interés';
            break;
        case ($output->paymentTypeCode == 'S2'):
            $pago->tipo_pago = "Crédito";
            $pago->tipo_cuota = 'Sin interés';
            break;
        case ($output->paymentTypeCode == 'VP'):
            $pago->tipo_pago = "Tarjeta de Prepago";
            $pago->tipo_cuota = 'No Aplica';
            break;
    }

    $pago->ordendecompra = $result->buyOrder;
    $pago->numerodetarjeta = $result->cardDetail->cardNumber;
    $pago->cod_autorizacion = $output->authorizationCode;
    $pago->cuotas = $output->sharesNumber;
    $pago->fechaexpiraciontarjeta = $result->cardDetail->cardExpirationDate;

    $pago->monto = $output->amount;
    $pago->cita_id = $CitaP->id;
    $pago->user_id = $cita->user_id;

    $pago->save();

    $pago = $pago->latest('id')->first();
    $padig = $pago->id;
    session()->put('pago', $padig);

    $cita->estado = "Confirmado";
    //$cita->estado_pago = "Pagado";
    $cita->save();
} else {
    // echo ($ordendecompra = $result->buyOrder);
    // echo ("<br>");
    // echo ($_POST["token_ws"]);
    // echo ("<br>");
    // var_dump($_SESSION['responseCode']);
    // die();
}

$webpay->acknowledgeTransaction();

echo RedirectorHelper::redirectBackNormal($result->urlRedirection);



    //llamamos modelo y valores cita para guardar el registro de reserva en base de datos
    /*
    $cita->user_id = $CitaPago->user_id;
        $cita->servicio_id = $CitaPago->servicio_id;
        $cita->locacion = $CitaPago->locacion;
        $cita->fecha = $CitaPago->fecha;
        $cita->hora_inicio = $CitaPago->hora_inicio;
        $cita->hora_termino = $CitaPago->hora_termino;
        $cita->modalidad = $CitaPago->modalidad;
        $cita->prevision = $CitaPago->prevision;
        $cita->precio = $CitaPago->precio;
        $cita->estado = $CitaPago->estado;
        $cita->rut = $CitaPago->rut;
        $cita->correo = $CitaPago->correo;
        $cita->telefono = $CitaPago->telefono;
        $cita->isapre = $CitaPago->isapre;
        $cita -> save();

    */
