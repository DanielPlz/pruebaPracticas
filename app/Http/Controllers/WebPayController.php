<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Cita;
use App\Servicio;
use App\User;
use Illuminate\Session\SessionManager;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;


class WebPayController extends Controller
{
    public function index()
    {
        return view('pasareladepago.webpay.index');
    }

    public function pagar()
    {

        return view('pasareladepago.webpay.pagar');
    }
    public function response()
    {

        return view('pasareladepago.webpay.response');
    }
    //funcion que retorna la vista del estado de la compra si fue aprobada o rechazada
    public function finish()
    {
        return view('pasareladepago.webpay.finish');
    }

    //funcion que muestra el registro de las transacciones del usuario
    public function vista()
    {
        $pagos = new Pago();
        $cita = new Cita();
        $servicios = new Servicio();
        if (auth()->user()) {
            $n = $cita->user_id = auth()->user()->id;
            $pagos = Pago::where('id_paciente', '=', $n)->orderBy('fecha', 'desc')->paginate(5);
            $servicios = Servicio::where('user_id', '=', $n);
            $rank = $pagos->firstItem();
            return view('pasareladepago.webpay.vista', ['servicios' => $servicios, 'pagos' => $pagos, 'rank' => $rank]);
        }
    }

    /**
     *  TODO: funcion que carga la vista que se genera el formato pdf descargado.
     *  Retorna un objeto de PDF con los datos correspondientes al pago realizado
     *  @param  Any             -> Identificador del pago a descargar.
     *  @return $pdf
     */
    public function pagodetalle($id)
    {
        $cita = new Cita();
        $servicio = new Servicio();
        $user = new User();
        $pago = new Pago();
        $pago = Pago::findOrFail($id);
        $cita = cita::findOrFail($pago->id_cita);
        $servicio = servicio::findOrFail($cita->servicio_id);
        $user = user::findOrFail($pago->id_paciente);
        $pdf = PDF::loadView('pasareladepago.webpay.pagodetalle', compact('pago', 'servicio', 'user', 'cita'));
        return $pdf->download("pago-detalle-" . $pago->fecha . ".pdf");
        // return $pdf->stream("pago-detalle-" . $pago->fecha . ".pdf");
    }

    /**
     *  TODO: Función que prepara el PDF para ser previsualizado y envía una copia de esta al correo del usuario.
     *  Retorna un objeto de PDF con los datos correspondientes del pago.
     *  @param  Any     $id -> Identificador del pago a descargar.
     *  @return $pdf
     */
    public function visualizacionDetalle($id)
    {
        $cita = new Cita();
        $servicio = new Servicio();
        $user = new User();
        $pago = new Pago();

        $n = auth()->user()->id;

        $pago = Pago::findOrFail($id);
        $cita = cita::findOrFail($pago->id_cita);
        $servicio = servicio::findOrFail($cita->servicio_id);
        $user = user::findOrFail($n);
        /** ENVIO CORREO */
        $subject = "Copia De Pago";
        $for = $cita->correo;
        FacadesMail::send(
            'pasareladepago.webpay.email',
            compact('pago', 'servicio', 'cita', 'user'),
            function ($msj) use ($subject, $for) {
                $msj->from("contacto@psicologostemuco.cl", "Psicólogos Temuco");
                $msj->subject($subject);
                $msj->to($for);
            }
        );
        /** FIN ENVIO CORREO */
        $pdf = PDF::loadView('pasareladepago.webpay.pagodetalle', compact('pago', 'servicio', 'user', 'cita'));
        return $pdf->stream("pago-detalle-" . $pago->fecha . ".pdf");
    }

    /**
     *  TODO: Función que busca y envía los datos necesarios para mostrar una vista con los detalles del pago especifico.
     *  Retorna una vista con los objetos necesarios para ser cargados.
     *  @param  Any     $id -> Identificador del pago a buscar.
     *  @return $pdf
     */
    public function ordenDeCompra($id)
    {

        $cita = new Cita();
        $servicio = new Servicio();
        $user = new User();
        $pago = new Pago();

        $n = auth()->user()->id;
        $user = user::findOrFail($n);
        $pago = Pago::where('orden_compra', $id)->first();
        $cita = cita::findOrFail($pago->id_cita);
        $servicio = servicio::findOrFail($cita->servicio_id);

        return view('pasareladepago.webpay.ordencompra', compact('pago', 'servicio', 'user', 'cita'));
    }


    public function correo(Request $request)
    {
        $cita = new Cita();
        $servicio = new Servicio();
        $user = new User();
        $pago = new Pago();
        $idpago = $request->input('id');
        $pago = Pago::findOrFail($idpago);
        $cita = cita::findOrFail($pago->id_cita);
        $servicio = servicio::findOrFail($cita->servicio_id);
        $user = user::findOrFail($pago->id_paciente);
        //se ingresa el asunto y para quien sera el correo
        $subject = "Copia De Pago";
        //$for cambiar por variable de correo de la cuenta
        $for = $cita->correo;
        //se configura el envio del correo, ingresando las vistas que se mostraran cómo correo
        FacadesMail::send('pasareladepago.webpay.email', compact('pago', 'servicio', 'cita', 'user'), function ($msj) use ($subject, $for) {
            // $msj->from("contacto@conexionsalud.cl", "Conexión Salud");
            $msj->from("contacto@psicologostemuco.cl", "Psicólogos Temuco");
            $msj->subject($subject);
            $msj->to($for);
        });
        //se retorna a la pagina con un mensaje notificando que el correo ha sido enviado
        return redirect()->back()->with('mensaje', 'Pago enviado a su correo electronico');
    }

    /**
     *  TODO: Función que busca y envía mediante correo una copia del comprobante de pago.
     *  Retorna a la vista de lista de Citas.
     *  @param  Any     $request Identificador del pago a buscar.
     *  @return $pdf
     */
    public function correoOpcional(Request $request)
    {
        try {
            if (auth()->user()) {
                $user = new User();
                $n = auth()->user()->id;
                $user = user::findOrFail($n);

                $cita = new Cita();
                $servicio = new Servicio();
                $pago = new Pago();

                $idpago = $request->input('pagid');
                $mail = $request->input('mail');
                $pago = Pago::findOrFail($idpago);

                $pago = Pago::findOrFail($pago->id);
                $cita = cita::findOrFail($pago->id_cita);
                $servicio = servicio::findOrFail($cita->servicio_id);

                //se ingresa el asunto y para quien sera el correo
                $subject = "Copia De Pago";
                //$for cambiar por variable de correo de la cuenta
                $for = $mail;
                //se configura el envio del correo, ingresando las vistas que se mostraran cómo correo
                FacadesMail::send('pasareladepago.webpay.email', compact('pago', 'servicio', 'cita', 'user'), function ($msj) use ($subject, $for) {
                    $msj->from("contacto@psicologostemuco.cl", "Psicólogos Temuco");
                    $msj->subject($subject);
                    $msj->to($for);
                });
                //se retorna a la pagina con un mensaje notificando que el correo ha sido enviado
                return redirect()->back()->with('mensaje', 'Una copia del pago ha sido enviada al correo que ha ingresado');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    //cuadro de busquedad por orden de compra en vista dashboard paciente
    public function busqueda(Request $request)
    {
        $orden = $request->get("orden");
        $pagos = Pago::orderBy('id', 'DESC')->where('ordendecompra', 'LIKE', "%$orden%")->paginate(5);
        $rank = 1;
        return view('pasareladepago.webpay.vista', compact('pagos', 'rank'));
    }

    public function filtro($mes = null, $ano = null, SessionManager $sessionManager)
    {

        $cita = new Cita();
        $aviso = "";
        //se obtiene los valores del mes y del año capturados por la URL y previamente seleccionados por el usuario en los "SELECT"
        $month = Input::get('mes');
        $year = Input::get('ano');
        $pagos = new Pago();
        if (auth()->user()) {
            $n = $cita->user_id = auth()->user()->id;
        }
        //se valida si los 2 selects fueron distintos de 0(no selecciona nada) y realiza la busqueda según el mes y el año
        if ($month != 0 && $year != 0) {
            $pagos = Pago::where('user_id', '=', $n)->orderBy('id', 'DESC')->whereMonth('created_at', $month)->whereYear('created_at', $year)->paginate(5)->appends(request()->query());
            $rank = 1;
            if ($pagos->isEmpty()) {
                $sessionManager->flash('aviso', 'No se encuentran resultados!, busque otros filtros');
            }
        }
        //si no selecciona los 2 campos, se comprueba si selecciono solo 1 de los select, en este caso se comprueba el mes primero y se realiza la busqueda de los pagos del mes
        elseif (!$month == 0) {
            $pagos = Pago::where('user_id', '=', $n)->orderBy('id', 'DESC')->whereMonth('created_at', $month)->paginate(5)->appends(request()->query());
            $rank = 1;
            if ($pagos->isEmpty()) {
                $sessionManager->flash('aviso', 'No se encuentran resultados!, busque otros filtros');
            }
        }
        //si no se seleccciono el mes, pero si el año, se realiza la busqueda de los pagos del año
        elseif (!$year == 0) {
            $pagos = Pago::where('user_id', '=', $n)->orderBy('id', 'DESC')->whereYear('created_at', $year)->paginate(5)->appends(request()->query());
            $rank = 1;
            if ($pagos->isEmpty()) {
                $sessionManager->flash('aviso', 'No se encuentran resultados!, busque otros filtros');
            }
        }
        //si bien no selecciona ningun mes ni año, se entrega nuevamente la lista de pagos del usuario
        elseif ($month == 0 && $year == 0) {
            if (auth()->user()) {

                $n = $cita->user_id = auth()->user()->id;
                $rank = 1;
                $pagos = Pago::where('user_id', '=', $n)->orderBy('fecha', 'desc')->paginate(5);
                $sessionManager->flash('aviso', 'No se encuentran resultados!, busque otros filtros');
            }
        }

        return view('pasareladepago.webpay.vista', compact('pagos', 'rank', 'month', 'year'));
    }

    public function listarCitas()
    {

        $cita = new Cita();
        $servicios = new Servicio();
        if (auth()->user()) {
            $n = $cita->user_id = auth()->user()->id;
            $cita = Cita::where('user_id', '=', $n)->orderBy('fecha', 'desc')->paginate(5);
            $servicios = Servicio::where('user_id', '=', $n);
            $rank = $cita->firstItem();
            return view('pasareladepago.webpay.listCitas', ['servicios' => $servicios, 'cita' => $cita, 'rank' => $rank]);
        }
    }

    public function filtrarEstado($estadoPago = null)
    {
        $cita = new Cita();
        $estadoP = Input::get('estadoPago');
        $servicios = new Servicio();
        if (auth()->user()) {
            $n = $cita->user_id = auth()->user()->id;
            if ($estadoP != '0') {
                $cita = Cita::where('user_id', '=', $n)->orderBy('fecha', 'desc')->where('estado_pago', '=', $estadoP)->paginate(5);
                //$pagos=Pago::where('user_id', '=', $n)->orderBy('fecha', 'desc')->paginate(5);
                $servicios = Servicio::where('user_id', '=', $n);
                $rank = $cita->firstItem();
                return view('pasareladepago.webpay.listCitas', ['servicios' => $servicios, 'cita' => $cita, 'rank' => $rank]);
            } else {
                return $this->listarCitas();
            }
        }
    }

    /**
     * TODO: Función de listar reservas de un profesional
     *  Retorna una lista que corresponde a las citas asociadas al profesional.
     *  @return $array          -> Retorna a la vista la lista correspondiente.
     */
    public function listaReservasProfesional()
    {
        $array = [];
        if (auth()->user()) {
            $n = auth()->user()->id;
            $array =
                Cita::select(
                    'cita.id',
                    'cita.user_id',
                    'cita.servicio_id',
                    'cita.fecha',
                    DB::raw("CONCAT(p.name, ' ', p.apellido) AS paciente"),
                    'p.rut AS rutPaciente',
                    'servicio.nombre as servicio',
                    DB::raw("CONCAT(cita.hora_inicio, '-', cita.hora_termino) as horario"),
                    'cita.modalidad',
                    'cita.estado',
                    'cita.estado_pago',
                    'cita.prevision',
                    'servicio.user_id'
                )
                ->from('cita')
                ->join('servicio', function ($join) {
                    $join->on('cita.servicio_id', '=', 'servicio.id');
                })
                ->join('users', function ($join) {
                    $join->on('servicio.user_id', '=', 'users.id');
                })
                ->join('users as p', function ($join) {
                    $join->on('cita.user_id', '=', 'p.id');
                })
                ->where('servicio.user_id', '=', $n)
                ->paginate(5);
            $rank = $array->firstItem();
            //$rank = 6;
            return view('pasareladepago.webpay.listaProfesional', ['cita' => $array, 'rank' => $rank]);
        }
    }

    /**
     * TODO: Función de filtrar paciente por rut o nombre
     * Retorna una lista que corresponde a los datos según el parámetro con el cual se filtrará.
     * @param String $rut      -> Valor correspondiente al rut a evaluar
     * @param String $name     -> Valor correspondiente al nombre a evaluar.
     * @return $array          -> Retorna a la vista la lista filtrada según corresponda.
     */
    public function filtrarPaciente(Request $request)
    {
        $array = [];
        $name = $request->get('buscar'); //Input::get('buscar');
        if (auth()->user()) {
            $n = auth()->user()->id;
            if (!($name == null || $name == '')) {
                $array =
                    Cita::select(
                        'cita.id',
                        'cita.user_id',
                        'cita.servicio_id',
                        'cita.fecha',
                        DB::raw("CONCAT(p.name, ' ', p.apellido) AS paciente"),
                        'p.rut AS rutPaciente',
                        'servicio.nombre as servicio',
                        DB::raw("CONCAT(cita.hora_inicio, '-', cita.hora_termino) AS horario"),
                        'cita.modalidad',
                        'cita.estado',
                        'cita.estado_pago',
                        'cita.prevision',
                        'servicio.user_id'
                    )
                    ->from('cita')
                    ->join('servicio', function ($join) {
                        $join->on('cita.servicio_id', '=', 'servicio.id');
                    })
                    ->join('users', function ($join) {
                        $join->on('servicio.user_id', '=', 'users.id');
                    })
                    ->join('users as p', function ($join) {
                        $join->on('p.id', '=', 'cita.user_id');
                    })
                    ->where(function ($query) use ($name) {
                        $query->where('p.rut', '=', $name);
                        $query->orWhere('p.name', 'LIKE', "%$name%");
                        $query->orWhere('p.apellido', 'LIKE', "%$name%");
                    })
                    ->where('servicio.user_id', '=', $n)

                    ->paginate(5)->appends(request()->query());
            }
            if (($name == null || $name = '')) {
                return $this->listaReservasProfesional();
            }
            $rank = $array->firstItem();
            return view('pasareladepago.webpay.listaProfesional', ['cita' => $array, 'rank' => $rank]);
        }
    }


    /**
     * Convert a rut to only alphanumeric values. It removes '.' it may contain.
     * Example: 22.452.225-8 gets converted to 22452225-8
     * Example: 22.452.2258  gets converted to 22452225-8
     * @param  String $rut The rut to be formated
     * @return String      The formated rut
     */
    protected function formatearRutSinPuntosSoloGuion($rut)
    {
        $quitar = array(".");
        $rut_sin_puntos = str_replace($quitar, "", $rut);
        if (strpos($rut_sin_puntos, '-') === false) {
            //Si no tiene se lo agrego
            $rut_sin_puntos = substr_replace($rut_sin_puntos, '-', strlen($rut_sin_puntos) - 1, 0);
        }
        return $rut_sin_puntos;
    }
}
