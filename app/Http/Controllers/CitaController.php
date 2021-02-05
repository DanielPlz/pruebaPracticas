<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Cita;
use App\User;
use App\Servicio;
use App\PagoCliente;
use App\ModalidadServicio;
use App\PrecioServicio;
use App\IsapreServicio;
use Illuminate\Support\Facades\Mail;
use App\Mail\Testmail;
use App\InfoProfesional;
use DateTime;
use Date;

class CitaController extends Controller
{
    //se obtiene el formulario de la reserva de cita y se guardan los datos en  el modelo cita para guardarlos en la base de datos,
    //despuesse envia los datos al controlador de envio de correo para enviar el correo a al paciente
    public function store(Request $request)
    {

        $cita = new Cita();
        if (auth()->user()) {

            $cita->user_id = auth()->user()->id;
        }
        $cita->servicio_id = $request->get('servicio_id');
        $cita->locacion = $request->input('direccionD');
        $cita->hora_inicio = $request->input('radio_horas');
        $cita->hora_termino = $request->input('hora_terminoD');
        $cita->fecha = $request->get('fecha');
        $cita->modalidad = $request->get('modalidad');
        $cita->prevision = $request->get('prevision');
        $cita->precio = $request->get('precioD');
        $cita->estado = ('Sin Confirmar');
        $cita->estado_pago = ('Pendiente');
        $cita->rut = $request->input("rutD");
        $cita->correo = $request->input("correo");
        $cita->telefono = "+569" . $request->input('telefono');
        if ($request->get('prevision') == "Isapre") {
            $cita->isapre = $request->get('isapre');
        };
        $cita->save();
        //el guardado de los valores de cita se realizan una vez el pago sea exitoso
        //por el codigo de respuesta de transbank

        //el correo es enviado una vez confirmado el pago
        Mail::to($cita->correo)->send(new Testmail($cita));

        //creamos una session temporal con los valores a guardar
        //session(['citaPago' => $cita]);

        //despues de seleccionar los detalles de la reserva, reedireccionamos al pago
        //return view('pasareladepago/webpay/pagar');

        return back()->with('message', array('title' => '¡Solicitud registrada con exito!', 'body' => 'La confirmación de la hora y responsable será enviada a su correo'));
    }

    public function llamarServicio(Request $request)
    {
        if ($request->ajax()) {
            $servicios = Servicio::where('id', $request->servicio_id)->get();
            return json_encode($servicios);
        }
    }

    //se hace una peticion ajax para obtener las modalidades, prevision y precios disponibles para el servicio seleccionado
    //para despues al final enviar un arreeglo con todos los datos solicitados
    public function modalidadall(Request $request)
    {
        if ($request->ajax()) {
            $modalidades = ModalidadServicio::where('servicio_id', $request->servicio_id)->get();
            $modalidad = array();
            foreach ($modalidades as $modalida) {
                if ($modalida->presencial == 1) {
                    array_push($modalidad, "Presencial");
                }
                if ($modalida->online == 1) {
                    array_push($modalidad, "Online");
                }
                if ($modalida->visita == 1) {
                    array_push($modalidad, "Visita");
                }
            };
            $precioPrevision = array();
            $prevision = array();


            $precios = PrecioServicio::where('Servicio_id', $request->servicio_id)->get();
            foreach ($precios as $precio) {
                if ($precio->precioFonasa != "") {
                    array_push($prevision, "Fonasa");
                    array_push($precioPrevision, $precio->precioFonasa);
                }
                if ($precio->precioIsapre != "") {
                    array_push($prevision, "Isapre");
                    array_push($precioPrevision, $precio->precioIsapre);
                }
                if ($precio->precioParticular != "") {
                    array_push($prevision, "Particular");
                    array_push($precioPrevision, $precio->precioParticular);
                }
            };

            return json_encode([$modalidad, $precioPrevision, $prevision]);
        }
    }
    // se hace una peticion ajax si el usuario esta logeado y si lo está,se envia un arreglo con los datos que se solicitan del usuario logeado
    public function User(Request $request)
    {
        if (auth()->user()) {
            $direccion = auth()->user()->direccion;
            $correo = auth()->user()->email;
            $telefono = auth()->user()->telefono;
            $rut = auth()->user()->rut;
            return json_encode([$direccion, $correo, $telefono, $rut]);
        } else {
            return json_decode("0");
        }
    }
    //Se obtienen los precios de las previsiones
    public function Precio(Request $request)
    {
        if ($request->ajax()) {
            $precios = PrecioServicio::where('Servicio_id', $request->servicio_id)->get();
            $precio = array();
            foreach ($precios as $p) {
                if ("Isapre" == $request->prevision) {
                    array_push($precio, $p->precioIsapre);
                }
                if ("Fonasa" == $request->prevision) {
                    array_push($precio, $p->precioFonasa);
                }
                if ("Particular" == $request->prevision) {
                    array_push($precio, $p->precioParticular);
                }
            }

            return json_encode($precio);
        }
    }
    //Es una peticion ajax para obtener las isapres disponibles que tenga el servicio seleccionado para asi enviar un arreglo con los datos
    public function Isapres(Request $request)
    {
        if ($request->ajax()) {
            $arrayIsapre = array();
            $isapres = IsapreServicio::where('servicio_id', $request->servicio_id)->get();
            foreach ($isapres as $isapre) {
                if ($isapre->banmedica == 1) {
                    array_push($arrayIsapre, 'banmedica');
                }
                if ($isapre->consalud == 1) {
                    array_push($arrayIsapre, 'consalud');
                }
                if ($isapre->colmena == 1) {
                    array_push($arrayIsapre, 'colmena');
                }
                if ($isapre->cruzblanca == 1) {
                    array_push($arrayIsapre, 'cruzblanca');
                }
                if ($isapre->masvida == 1) {
                    array_push($arrayIsapre, 'masvida');
                }
                if ($isapre->vidatres == 1) {
                    array_push($arrayIsapre, 'vidatres');
                }
            };
            return json_encode($arrayIsapre);
        }
    }

    //Estados:
    //estado = 1 es mayor de 12 horas y menor que 24, este le permite rechazar la cita con devolución de dinero.
    //estado = 2 es menor de 12 horas, este le permite rechazar la cita pero sin devolución.
    //estado = 3 es mayor de 24 horas, este le permite rechazar o reagendar la cita. Si rechaza se le devuelve el dinero.
    //estado = 4, este no le permite hacer ninguna acción, ya que no es su cita.

    public function rechazo($id)
    {
        if (auth()->user()) {
            $cita = Cita::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->where('estado', "Confirmado")
                ->get();
            if ($cita != "[]") {
                $now = new \DateTime();
                $fecha_hora = $now->format('H:i:s');
                $hora_cita = Cita::select('hora_inicio', 'fecha')
                    ->where('id', $id)->get();

                $fecha_cita = $hora_cita[0]->fecha . " " . $hora_cita[0]->hora_inicio;

                $fecha_cita_bd = date("Y-m-d H:i", strtotime($fecha_cita));
                $fecha_12 = date("Y-m-d H:i", strtotime($fecha_hora . "+12 hours"));
                $fecha_24 = date("Y-m-d H:i", strtotime($fecha_hora . "+24 hours"));


                if ($fecha_cita_bd >=  $fecha_12) {

                    if ($fecha_cita_bd >= $fecha_24) {
                        $estado = 3;
                        $servicio = Cita::find($id)->servicio;
                        $modalidad = Servicio::find($servicio->id)->modalidad;
                        $cita = Servicio::find($servicio->id)->cita->where('id', $id)->first();
                        return view('emails.citaDinamica', compact('estado', 'servicio', 'cita', 'modalidad', 'id'));
                    } else {
                        $estado = 1;
                        return view('emails.citaDinamica', compact('estado', 'id'));
                    }
                }

                if ($fecha_cita_bd < $fecha_12) {
                    $estado = 2;
                    return view('emails.citaDinamica', compact('estado', 'id'));
                }
            } else {
                $cita = Cita::where('user_id', auth()->user()->id)
                    ->where('id', $id)
                    ->get();
                if ($cita != "[]") {
                    if ($cita->estado = "Realizado") {
                        $titulo = "Cita realizada";
                        $txt = "Su cita ya ha sido realizada con exito.";
                        return view('emails.citaRechazada', compact('txt', 'titulo'));
                    } else {
                        $titulo = "Cita rechazada";
                        $txt = "Su cita ya ha sido rechazada anteriormente.";
                        return view('emails.citaRechazada', compact('txt', 'titulo'));
                    }
                } else {
                    $estado = 4;
                    return view('emails.citaDinamica', compact('estado'));
                }
            }
        } else {
            return view('auth.login');
        }
    }
    //Se analiza el id de la cita para validar si dicha cita ya fue rechazada o si la cita pertenece a la cuenta de la persona que inició sesión
    public function analizar($id)
    {
        if (auth()->user()) {

            $cita = Cita::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->where('estado', "Confirmado")
                ->get();

            if ($cita != "[]") {
                return view('emails.citaPendiente')->with('id', $id);
            } else {
                $cita = Cita::where('user_id', auth()->user()->id)
                    ->where('id', $id)
                    ->get();
                if ($cita != "[]") {
                    $titulo = "Cita rechazada";
                    $txt = "Su cita ya ha sido rechazada anteriormente.";
                    return view('emails.citaRechazada', compact('txt', 'titulo'));
                } else {
                    $estado = 4;
                    return view('emails.citaDinamica', compact('estado'));
                }
            }
        } else {
            return view('auth.login');
        }
    }
    //Al presionar el boton de confirmar rechazo, este va rechazar la cita y dependiendo del estado se decide si se devolvera un porcentaje del dinero
    public function confirmarRechazo($id, $estado)
    {
        if ($estado == 1 || $estado == 3) {

            //envia el correo
            //aqui coloca tu funcion del webpay de reembolso, muchas gracias.
            /* if(si devolucion es correcta){
                Cita::where('id',$id)->update(['estado'=> 'Rechazado']);
                $txt = "Su cita ha sido rechazada con éxito y se le ha reembolsado su pago.";
                return view('emails.citaRechazada',compact('txt'));
            } */
        }

        if ($estado == 2) {
            Cita::where('id', $id)->update(['estado' => 'Rechazado']);
            $txt = "Su cita ha sido rechazada con éxito.";
            return view('emails.citaRechazada', compact('txt'));
        }
    }
    //Se obtiene un formulario para actualizar la cita(reagendar cita) para los pacientes que tengan disponible esta opción
    public function update(Request $request)
    {
        Cita::where('id', $request->input('cita_id'))
            ->update([
                'modalidad' => $request->get('modalidad'),
                'locacion' => $request->get('direccionD'),
                'hora_inicio' => $request->input('radio_horas'),
                'hora_termino' => $request->input('hora_terminoD'),
                'fecha' => $request->input('fecha')
            ]);
    }
    //Se obtienen las horas disponibles para reservar una cita
    public function horaNoDisponible(Request $request)
    {

        $servicio = Servicio::select('user_id', 'duracion')
            ->where('id', $request->servicio_id)
            ->get()->first();
        $user = Servicio::select('id')
            ->where('user_id', $servicio->user_id)
            ->get();
        $infoProfesional = InfoProfesional::select('hora_inicio', 'hora_termino', 'hora_almuerzo')
            ->where('user_id', $servicio->user_id)
            ->get()->first();
        $arrayCitas = array();
        $now = new \DateTime();
        $fecha_actual = $now->format('Y-m-d');
        $fecha_hora = $now->format('H:i') . ":00";
        //$fecha_hora = "16:20:00";
        $parte = explode(":", date("H:i:i", strtotime($fecha_hora . "+1 hour")));
        switch (true) {
            case ($parte[1] >= 30):
                $fecha_1hora = ($parte[0] + 1) . ":00:00";
                break;
            case ($parte[1] < 30):
                $fecha_1hora = $parte[0] . ":00:00";
                break;
        }
        //hora de colacion del profesional
        $inicio_almuerzo = $infoProfesional->hora_almuerzo;
        $termino_almuerzo = date("H:i:s", strtotime($infoProfesional->hora_almuerzo . "+1 hour"));
        //horas de trabajo del profecional
        $inicio_trabajo = $infoProfesional->hora_inicio;
        $termino_trabajo = $infoProfesional->hora_termino;
        //switch para buscar las citas  ya agendadas al seleccionar una fecha y guardar dichas citas en un arreglo
        switch (true) {
                //caso 1 si fecha seleccionada es igual a la fecha actual
            case ($request->fecha == $fecha_actual):
                //switch para identificar las citas agendadas en la fecha actual
                switch (true) {
                        //caso 1.1 si la hora actual esta entre las horas de colacion
                    case ($fecha_hora >= $inicio_almuerzo && $fecha_hora <= $termino_almuerzo
                        || $fecha_1hora > $inicio_almuerzo && $fecha_1hora <= $termino_almuerzo):

                        foreach ($user as $id) {
                            $partes = [];
                            $citas = Cita::select('hora_inicio', 'hora_termino')
                                ->where('fecha', $request->fecha)
                                ->where('servicio_id', $id->id)
                                ->where('hora_inicio', '>=', $fecha_hora)
                                ->where('estado', '!=', 'Rechazado')
                                ->orderBy('hora_inicio', 'asc')
                                ->get();
                            foreach ($citas as $cita) {

                                $partes["hora_inicio"] = $cita->hora_inicio;
                                $partes["hora_termino"] = $cita->hora_termino;
                                array_push($arrayCitas, $partes);
                            }
                        }
                        $fechaInicioProfesional = new DateTime($termino_almuerzo);
                        break;
                        //caso 1.2 si la hora actual es menos a la hora en que el profesional entra a colacion
                    case ($fecha_hora < $inicio_almuerzo):

                        foreach ($user as $id) {
                            $partes = [];

                            $citas = Cita::select('hora_inicio', 'hora_termino')
                                ->where('fecha', $request->fecha)
                                ->where('servicio_id', $id->id)
                                ->where('hora_termino', '>=', $fecha_1hora)
                                ->where('estado', '!=', 'Rechazado')
                                ->orderBy('hora_inicio', 'asc')
                                ->get();
                            foreach ($citas as $cita) {

                                $partes["hora_inicio"] = $cita->hora_inicio;
                                $partes["hora_termino"] = $cita->hora_termino;
                                array_push($arrayCitas, $partes);
                            }
                        }
                        //switch para identificar el inicio de las citas disponible
                        switch (true) {
                            case ($arrayCitas != []):
                                if ($arrayCitas[0]["hora_termino"] > $fecha_1hora && $arrayCitas[0]["hora_inicio"] < $fecha_1hora) {
                                    $fechaInicioProfesional = new DateTime($arrayCitas[0]["hora_inicio"]);
                                } else {

                                    $fechaInicioProfesional = new DateTime($fecha_1hora);
                                }
                                break;
                            case ($arrayCitas == []):
                                $fechaInicioProfesional = new DateTime($fecha_1hora);
                                break;
                        }
                        $hora_almuerzo = [];
                        $hora_almuerzo["hora_inicio"] = $inicio_almuerzo;
                        $hora_almuerzo["hora_termino"] = $termino_almuerzo;
                        array_push($arrayCitas, $hora_almuerzo);

                        break;
                        //caso 1.3 si la hora actual es mayor a la hora de termino de colacion del profesional
                    case ($fecha_hora > $termino_almuerzo):
                        foreach ($user as $id) {
                            $partes = [];

                            $citas = Cita::select('hora_inicio', 'hora_termino')
                                ->where('fecha', $request->fecha)
                                ->where('servicio_id', $id->id)
                                ->where('hora_termino', '>=', $fecha_1hora)
                                ->where('estado', '!=', 'Rechazado')
                                ->orderBy('hora_inicio', 'asc')
                                ->get();
                            foreach ($citas as $cita) {

                                $partes["hora_inicio"] = $cita->hora_inicio;
                                $partes["hora_termino"] = $cita->hora_termino;
                                array_push($arrayCitas, $partes);
                            }
                        }
                        //switch para identificar el inicio de las citas disponible
                        switch (true) {
                            case ($arrayCitas != []):
                                if ($arrayCitas[0]["hora_termino"] > $fecha_1hora && $arrayCitas[0]["hora_inicio"] < $fecha_1hora) {
                                    $fechaInicioProfesional = new DateTime($arrayCitas[0]["hora_inicio"]);
                                } else {

                                    $fechaInicioProfesional = new DateTime($fecha_1hora);
                                }
                                break;
                            case ($arrayCitas == []):
                                $fechaInicioProfesional = new DateTime($fecha_1hora);
                                break;
                        }

                        break;
                }
                break;
                //caso 2 si fecha seleccionada es mayor a la fecha actual
            case ($request->fecha > $fecha_actual):
                $fechaInicioProfesional = new DateTime($inicio_trabajo);
                foreach ($user as $id) {
                    $citas = Cita::select('hora_inicio', 'hora_termino')
                        ->where('fecha', $request->fecha)
                        ->where('servicio_id', $id->id)
                        ->where('estado', '!=', 'Rechazado')
                        ->orderBy('hora_inicio', 'asc')
                        ->get();
                    foreach ($citas as $cita) {

                        $partes["hora_inicio"] = $cita->hora_inicio;
                        $partes["hora_termino"] = $cita->hora_termino;
                        array_push($arrayCitas, $partes);
                    }
                }
                $hora_almuerzo = [];
                $hora_almuerzo["hora_inicio"] = $inicio_almuerzo;
                $hora_almuerzo["hora_termino"] = $termino_almuerzo;
                array_push($arrayCitas, $hora_almuerzo);
                break;
        }
        //ordenar de forma ascendente las citas guardadas en el arreglo
        sort($arrayCitas);


        $fechaTerminoProfesional = new DateTime($termino_trabajo);
        $duracion = new DateTime($servicio->duracion);
        $duracion = $duracion->format("H:i");
        $minutos = explode(":", $duracion);
        $minutos = ($minutos[0] * 60) + $minutos[1];

        $array = array();
        switch (true) {
            case ($arrayCitas == []):
                $fecha1 = $fechaInicioProfesional;
                $fecha2 = $fechaTerminoProfesional;
                $intervalo = $this->numero($fecha1, $fecha2);
                $arreglo = $this->dispinible($intervalo, $duracion, $fecha1, $fecha2, $minutos);
                foreach ($arreglo as $dato) {
                    array_push($array, $dato);
                }
                break;
            case ($arrayCitas != []):
                for ($i = 0; $i < count($arrayCitas); $i++) {
                    if ($i == 0) {
                        $fecha1 = $fechaInicioProfesional;
                        $fecha2 = new DateTime($arrayCitas[$i]["hora_inicio"]);
                        $intervalo = $this->numero($fecha1, $fecha2);
                        $arreglo = $this->dispinible($intervalo, $duracion, $fecha1, $fecha2, $minutos);
                        foreach ($arreglo as $dato) {
                            array_push($array, $dato);
                        }
                    }

                    if ($i == count($arrayCitas) - 1) {
                        $fecha1 = new DateTime($arrayCitas[$i]["hora_termino"]);
                        $fecha2 = $fechaTerminoProfesional;

                        $intervalo = $this->numero($fecha1, $fecha2);
                        $arreglo = $this->dispinible($intervalo, $duracion, $fecha1, $fecha2, $minutos);
                        foreach ($arreglo as $dato) {
                            array_push($array, $dato);
                        }
                    }
                }
                if (count($arrayCitas) > 1) {
                    $final = count($arrayCitas) - 2;
                    for ($f = 0; $f <= $final; $f++) {

                        $fecha1 = new DateTime($arrayCitas[$f]["hora_termino"]);
                        $fecha2 = new DateTime($arrayCitas[$f + 1]["hora_inicio"]);

                        $intervalo = $this->numero($fecha1, $fecha2);
                        $arreglo = $this->dispinible($intervalo, $duracion, $fecha1, $fecha2, $minutos);
                        foreach ($arreglo as $dato) {
                            array_push($array, $dato);
                        }
                    }
                }
                break;
        }

        sort($array, SORT_STRING);
        return json_encode($array);
    }

    //función para transformar las horas que terminen en "0" y pasarlas a "00", ejemplo: 10:03:0 se transforma a 10:03:00 y este mismo paso se puede hacer con los minutos
    private function numero($fecha1, $fecha2)
    {
        $intervalo = $fecha2->diff($fecha1);
        $intervalo = $intervalo->format('%H:%i');
        $partes = explode(":", $intervalo);
        if ($partes[1] == '0') {
            $intervalo = $partes[0] . ":00";
        }
        if ($partes[0] == '0') {
            $intervalo = '00:' . $partes[1];
        }
        return $intervalo;
    }
    //función para obtener las horas disponibles
    private function dispinible($intervalo, $duracion, $fecha1, $fecha2, $minutos)
    {
        $array = array();
        if ($intervalo >= $duracion) {
            array_push($array, $fecha1->format("H:i:s"));
            $suma = date("H:i:s", strtotime($fecha1->format("H:i:s") . "+" . $minutos . "minute"));
            $suma = new DateTime($suma);
            $intervalo = $this->numero($suma, $fecha2);
            $cita = $suma->format("H:i:s");
            while ($intervalo >= $duracion) {
                array_push($array, $cita);
                $suma = $suma->format("H:i:s");
                $suma = date("H:i:s", strtotime($suma . "+" . $minutos . " minute"));
                $suma = new DateTime($suma);
                $intervalo = $this->numero($suma, $fecha2);
                $cita = $suma->format("H:i:s");
            }
        }
        return $array;
    }
}
