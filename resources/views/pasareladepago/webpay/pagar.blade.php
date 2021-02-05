<?php

use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\RedirectorHelper;
use App\Cita;

require_once './../vendor/autoload.php';

$bag = CertificationBagFactory::integrationWebpayNormal();
$webpay = TransbankServiceFactory::normal($bag);
//$cita= $_POST["cita"];

$idCita = $_POST["citaID"];
//$precio=$_POST["precioCita"];
$citaP = new Cita();
$citaP = cita::findOrFail($idCita);
// echo($citaP->precio);
// echo($citaP->id);
// echo($citaP);

//echo($cita);
//echo($CitaP->precio);
//session(['citaID' => $idCita]);

session(['citaSession' => $citaP]);

//echo($cita);
//echo($precio);

$returnUrl = 'http://localhost:8000/pasareladepago/webpay/response';
$finalUrl = 'http://localhost:8000/pasareladepago/webpay/finish';
$orderBuy = rand(1, 100000);
session()->put('orderbuy', $orderBuy);
// $webpay->addTransactionDetail($citaP->precio, '' . rand(1, 100000)); //(monto, sessionID, Orden de compra)
$webpay->addTransactionDetail($citaP->precio, '' . $orderBuy);
$response = $webpay->initTransaction($returnUrl, $finalUrl);



// Asociar mi transaccion con mi token
echo RedirectorHelper::redirectHTML($response->url, $response->token);
