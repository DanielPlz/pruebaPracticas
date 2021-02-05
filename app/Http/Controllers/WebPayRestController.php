<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Pago;
use App\Servicio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Transbank\Webpay\WebpayPlus\Transaction;

class WebPayRestController extends Controller
{

    /**
     *  Crea la transacción utilizando los métodos de WebPayPlus REST.
     *
     * Este método se encarga de asignar los datos necesarios para enviar a Transbank y recuperar el token y la URL para el formulario de este.
     * Incluido a esto se establece los datos para un objeto de clase Pago que será guardado en una session
     * para ser recuperada posteriormente para confirmar la transacción.
     *
     *  @author Matias Soto Leiva
     *  @param  Any     $request Información de la cita a pagar.
     *  @return Any     La vista de checkout.blade.php junto a los datos de token_ws y la URL del comercio.
     */
    public function createdTransaction(Request $request)
    {
        session_start();
        /* ========= Instancia de los Modelos a ocupar =========== */
        $cita       = new Cita();
        $servicio   = new Servicio();
        $pago       = new Pago();
        $user       = new User();
        /* ============================================================== */
        $req = $request->input('id_cita');
        $n = auth()->user()->id;
        $cita = cita::findOrFail($req);
        $servicio = servicio::findOrFail($cita->servicio_id);
        $user = user::findOrFail($n);

        /* ========== Creación de datos para TBK ===================== */

        $buy_order  = strval(rand(0, 10000000));
        $session_id = strval(rand(60000, 9000000)) . $buy_order;
        $amount     = $cita->precio;

        /* ========== Los valores se guardan en la base de datos ===================== */

        $pago->orden_compra = $buy_order;
        $pago->monto = $amount;
        $pago->id_cita = $cita->id;
        $pago->id_paciente = $user->id;
        $pago->id_servicio = $servicio->id;
        session()->put('pago', $pago);
        //$pago->save();

        /* ========== URL de retorno al comercio y token de TBK ===================== */
        $return_url = 'http://localhost:8000/pasareladepago/webpay/rest/return';
        $response = Transaction::create($buy_order, $session_id, $amount, $return_url);
        $return_url = $response->getUrl();
        $token = $response->getToken();

        return view('pasareladepago.webpay.rest.checkout', ['return' => $return_url, 'token' => $token, 'cita' => $cita, 'servicio' => $servicio]);
    }


    /**
     *  Evalua la transacción realizada para enviar las respuestas correspondientes para el cliente.
     *
     * Este método se encarga de evaluar mediante el método commit el token_ws generado por la transacción.
     * El método devuelve una respuesta con los datos de la transacción, se hace uso especifico de responseCode
     * para evaluar la transacción y elegir el bloque de código para retornar la vista correspondiente.
     *
     *  @author Matias Soto Leiva
     *  @param  Any     $request Información de la transacción realizada.
     *  @return Any     La vista de return.blade.php junto a los datos de de la transacción.
     */
    public function commitedTransaction(Request $request)
    {
        /* Recupera la session de pago para obtener la orden de compra */
        $pago = new Pago();
        $pago = Session::get('pago');
        try {

            $req = $request->except('_token');
            $resp = Transaction::commit($req["token_ws"]);

            switch ($resp->getResponseCode()) {
                case 0:
                    /*La orden de compra se genera en la createdTransaction*/
                    $pago->orden_compra = $resp->getBuyOrder();
                    $pago->monto = $resp->getAmount();
                    $pago->cod_autorizacion = $resp->getAuthorizationCode();
                    $fechaTransaccion = $resp->getTransactionDate();
                    $fechaTransaccion = date('Y-m-d H:m:s', strtotime($fechaTransaccion));
                    $numero_tarjeta = $resp->getCardDetail();
                    $pago->numero_tarjeta = $numero_tarjeta['card_number'];

                    $pago->fecha = $fechaTransaccion;

                    switch ($resp->getPaymentTypeCode()) {
                        case ('VD'):
                            $pago->tipo_pago = "Débito";
                            $pago->cantidad_cuotas = $resp->getInstallmentsNumber();
                            $pago->monto_cuota = $resp->getInstallmentsAmount();
                            $pago->tipo_cuota = 'No Aplica';
                            break;
                        case ('VN');
                            $pago->tipo_pago = 'Venta Normal';
                            $pago->cantidad_cuotas = $resp->getInstallmentsNumber();
                            $pago->monto_cuota = $resp->getInstallmentsAmount();
                            $pago->tipo_cuota = 'Sin Interés';
                            break;
                        case ('SI'):
                            $pago->tipo_pago = "Crédito";
                            $pago->cantidad_cuotas = $resp->getInstallmentsNumber();
                            $pago->monto_cuota = $resp->getInstallmentsAmount();
                            $pago->tipo_cuota = 'Sin interés';
                            break;
                        case ('S2'):
                            $pago->tipo_pago = "Crédito";
                            $pago->cantidad_cuotas = $resp->getInstallmentsNumber();
                            $pago->monto_cuota = $resp->getInstallmentsAmount();
                            $pago->tipo_cuota = 'Sin interés';
                            break;
                        case ('VP'):
                            $pago->tipo_pago = "Tarjeta de Prepago";
                            $pago->cantidad_cuotas = $resp->getInstallmentsNumber();
                            $pago->monto_cuota = $resp->getInstallmentsAmount();
                            $pago->tipo_cuota = 'No Aplica';
                            break;
                    }

                    $pago->id_cita = $pago->id_cita;
                    $cita = Cita::findOrFail($pago->id_cita);
                    $cita->estado = "Confirmado";
                    $cita->estado_pago = "Pagado";
                    $pago->id_paciente = auth()->user()->id;
                    $pago->id_servicio = $pago->id_servicio;
                    $cita->save();
                    $pago->save();
                    return view('pasareladepago.webpay.rest.return', ['pago' => $pago, 'resp' => $resp->getResponseCode()]);
                    Session::forget('pago');
                    break;
                case -1:
                    return view('pasareladepago.webpay.rest.return', ['pago' => $pago, 'resp' => $resp->getResponseCode()]);
                    Session::forget('pago');
                    break;
                case -2:
                    return view('pasareladepago.webpay.rest.return', ['pago' => $pago, 'resp' => $resp->getResponseCode()]);
                    Session::forget('pago');
                    break;
                case -3:
                    return view('pasareladepago.webpay.rest.return', ['pago' => $pago, 'resp' => $resp->getResponseCode()]);
                    Session::forget('pago');
                    break;
                case -4:
                    return view('pasareladepago.webpay.rest.return', ['pago' => $pago, 'resp' => $resp->getResponseCode()]);
                    Session::forget('pago');
                    break;
                case -5:
                    return view('pasareladepago.webpay.rest.return', ['pago' => $pago, 'resp' => $resp->getResponseCode()]);
                    Session::forget('pago');
                    break;
            }
        } catch (\Throwable $th) {
            /*
            * El uso del número -6 es lógica interna, debido a que al anular la transacción está no devuelve nada
            * en el response desde TBK, puesto que nunca se ejecuta el bloque para confirmar esté.
            */
            return view('pasareladepago.webpay.rest.return', ['resp' => -6, 'pago' => $pago]);
            Session::forget('pago');
        }
    }

    public function transaccionReserva(Request $request)
    {
        try {
            session_start();
            /* ========= Instancia de los Modelos a ocupar =========== */
            // $reserva             = new Reserva();
            // $pago                = new Pago();
            // $detallePago         = new DetallePago();
            // $servicio            = new ServicioPsicologo();
            // $user                = new User();

            /* ============================================================== */
            // $req = $request->input('id_cita');
            // $reserva = reserva::findOrFail($req);
            // $servicio = servicioPsicologo::findOrFail($reserva->id_servicio_psicologo);
            // $user = user::findOrFail(auth()->user()->id);

            /* ========== Creación de datos para TBK ===================== */

            // $buy_order  = strval(rand(0, 10000000));
            // $session_id = strval(rand(60000, 9000000)) . $buy_order;
            // $amount     = $reserva->precio;

            /* ========== Los valores para la session ===================== */

            // $pago->orden_compra = $buy_order;
            // $pago->monto = $amount;
            // $detallePago->id_servicio = $servicio->idservicio_psicologo;
            // $pago->id_user = $user->id;
            // $procesoPago = array($pago, $detallePago);
            // session()->put('pago', $procesoPago);

            /* ========== URL de retorno al comercio y token de TBK ===================== */

            // $return_url = 'http://localhost:8000/pasareladepago/webpay/rest/return';
            // $response = Transaction::create($buy_order, $session_id, $amount, $return_url);
            // $return_url = $response->getUrl();
            // $token = $response->getToken();

            // return view('pasareladepago.webpay.rest.checkout', ['return' => $return_url, 'token' => $token, 'reserva' => $reserva, 'servicio' => $servicio]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function transaccionSuscripcion(Request $request)
    {
        try {
            session_start();
            /* ========= Instancia de los Modelos a ocupar =========== */
            // $pago                = new Pago();
            // $detallePago         = new DetallePago();
            // $suscripcion         = new Suscripcion();
            // $user                = new User();

            /* ============================================================== */
            // $req = $request->input('id_suscripcion');
            // $user = user::findOrFail(auth()->user()->id);

            /* ========== Creación de datos para TBK ===================== */

            // $buy_order  = strval(rand(0, 10000000));
            // $session_id = strval(rand(60000, 9000000)) . $buy_order;
            // $amount     = $suscripcion->precio;

            /* ========== Los valores para la session ===================== */

            // $pago->orden_compra          = $buy_order;
            // $pago->monto                 = $amount;
            // $detallePago->id_suscripcion = $suscripcion->id_suscripcion;
            // $pago->id_user               = $user->id;
            // $procesoPago = array($pago, $detallePago);
            // session()->put('pago', $procesoPago);

            /* ========== URL de retorno al comercio y token de TBK ===================== */
            // $return_url = 'http://localhost:8000/pasareladepago/webpay/rest/return';
            // $response = Transaction::create($buy_order, $session_id, $amount, $return_url);
            // $return_url = $response->getUrl();
            // $token = $response->getToken();

            // return view('pasareladepago.webpay.rest.checkout', ['return' => $return_url, 'token' => $token, 'cita' => $cita, 'servicio' => $servicio]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function transaccionMembresia(Request $request)
    {
        try {
            session_start();
            /* ========= Instancia de los Modelos a ocupar =========== */
            // $membresia           = new Membresia();
            // $detallePago         = new DetallePago();
            // $pago                = new Pago();
            // $user                = new User();

            /* ============================================================== */
            /* RECUPERAR ID DE MEMBRESIA*/
            // $req = $request->input('id_membresia');
            // $membresia = Membresia::findOrFail($req);
            // $user = user::findOrFail(auth()->user()->id);

            /* ========== Creación de datos para TBK ===================== */

            // $buy_order  = strval(rand(0, 10000000));
            // $session_id = strval(rand(60000, 9000000)) . $buy_order;
            // $amount     = $membresia->precio;

            /* ========== Los valores para la session ===================== */

            // $pago->orden_compra = $buy_order;
            // $pago->monto = $amount;
            // $detallePago->id_membresia = $membresia->id_membresia;
            // $pago->id_user = $user->id;
            // $procesoPago = array($pago, $detallePago);
            // session()->put('pago', $procesoPago);

            /* ========== URL de retorno al comercio y token de TBK ===================== */
            // $return_url = 'http://localhost:8000/pasareladepago/webpay/rest/return';
            // $response = Transaction::create($buy_order, $session_id, $amount, $return_url);
            // $return_url = $response->getUrl();
            // $token = $response->getToken();

            // return view('pasareladepago.webpay.rest.checkout', ['return' => $return_url, 'token' => $token, 'cita' => $cita, 'servicio' => $servicio]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
