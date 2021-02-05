<?php

namespace App\Http\Controllers;

use App\Cita;
use App\ModalidadServicio;
use App\Reserva;
use App\ServicioPsicologo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     *  Recupera los datos de las reservas de un usuario desde la base de datos.
     *  Retorna a la vista y los objetos necesarios para ser mostrados.
     *  @param
     *  @return view
     */
    public function listarReservas()
    {
        try {

            if (auth()->user()) {
                $reserva    = Reserva::select('*')->where('id_paciente', '=' , auth()->user()->id)->orderBy('fecha', 'desc')->paginate(5);
//                $servicio   = ServicioPsicologo::where('idservicio_psicologo', '=', $reserva->id_servicio_psicologo)->first();
//                print_r($reserva->id_servicio_psicologo);
//                echo('<br>');
//                print_r($reserva->precio);
//                echo('<br>');
//                print_r($servicio->id_psicologo);
//                echo('<br>');
//                print_r($reserva->modalidad);
//                echo('<br>');
//                print_r($reserva->fecha);
//                echo('<br>');
//                print_r($servicio->id_servicio);
//                die();
//                $n = $reserva->user_id = auth()->user()->id;
//                $cita = Reserva::where('user_id', '=', $n)->orderBy('fecha', 'desc')->paginate(5);
//                $servicios = Servicio::where('user_id', '=', $n);
                $rank = $reserva->firstItem();
                return view('pasareladepago.webpay.listCitas', ['reserva' => $reserva, 'rank' => $rank]);
            }
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     *  FIXME: Función de listar reservas de un profesional
     *  Retorna una lista que corresponde a las reservas asociadas al profesional.
     *  @return $array          Retorna a la vista la lista correspondiente.
     */
    public function listaReservasProfesional()
    {
        try {
            if (auth()->user()) {
                $n = auth()->user()->id;
                $array =
                    Reserva::select('*')
                        ->join('servicio_psicologo', function ($join) {
                            $join->on('reserva.id_servicio_psicologo', '=', 'servicio_psicologo.idservicio_psicologo');
                        })
                        ->join('paciente', function ($join) {
                            $join->on('reserva.id_paciente', '=', 'paciente.id_paciente');
                        })
                        ->join('persona', function ($join) {
                            $join->on('paciente.id_persona', '=', 'persona.id_persona');
                        })
                        ->where('servicio_psicologo.id_psicologo', $n)
//                        ->get()
                        ->paginate(5);
//                $rank = $array->firstItem();
                $rank = 6;

//                dd($array);
//                die();
                return view('pasareladepago.webpay.listaProfesional', ['cita' => $array, 'rank' => $rank]);
            }
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }
}

