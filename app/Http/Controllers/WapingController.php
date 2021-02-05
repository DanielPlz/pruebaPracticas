<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cita;
use Twilio\Rest\Client;
use App\Providers\RouteServiceProvider;
use App\User;


class WapingController extends Controller
{

public function email(){

    return view('emails/contacto');
}
   
    protected function create()
    {
        
        $now = new \DateTime();
        $fecha_actual = $now->format('Y-m-d H:i:s');
        $citas = Cita::select('id')
                ->where('estado','Confirmado')
                ->where('fecha',date("Y-m-d",strtotime($fecha_actual)))
                ->where('hora_inicio','<=', date("H:i:s",strtotime($fecha_actual)))
                ->get();
        foreach($citas as $cita){
            Cita::where('id',$cita->id)->update(['estado'=>'Realizado']);
        }
    }
    

    private function sendWhatsappNotification($dato, $profesional, $servicio,string $recipient)
    {

        //Se realiza la configuracion de twilio para poder realizar la conexion de una API
        $account_sid  =  getenv ( 'TWILIO_SID' );
        $auth_token  =  getenv ( 'TWILIO_AUTH_TOKEN' );
        $twilio_number  =  "+14155238886" ;

        //Se guardan las credenciales de la api en una variable
        $client = new client ( $account_sid,$auth_token );
        
        //se realiza la misma particion de la hora obtenida para poder definir cuando se le enviara el sms al paciente
        $hora = explode(":",$dato->hora_inicio);
        $hora = $hora[0] . ":" . $hora[1];
        if ($dato->modalidad == "Online") {
            $message = "*Recordatorio de su cita*\n\n_Detalles de su reserva_:\n\n"
                . "*Servicio:* " . $servicio->nombre . "\n"
                . "*Profesional:* " . $profesional->name . " " . $profesional->apellido . "\n"
                . "*Modalidad:* " . $dato->modalidad . "\n"
                . "*Fecha:* " . $dato->fecha . "\n"
                . "*Hora reserva:* " . $hora . "\n\n"
                ."_Si desea rechazar su cita, presione el enlace_\n"
                ."http://psicologostemuco.cl/cita-pendiente/$dato->id\n"
                ."El tiempo para reembolsar su pago(85%) ha expirado, si cancela la cita no se hará la devolución";
        } else {
            $message = "*Recordatorio de su cita*\n\n_Detalles de su reserva_:\n\n"
                . "*Servicio:* " . $servicio->nombre . "\n"
                . "*Profesional:* " . $profesional->name . " " . $profesional->apellido . "\n"
                . "*Modalidad:* " . $dato->modalidad . "\n"
                . "*Ubicación:* " . $dato->locacion . "\n"
                . "*Fecha:* " . $dato->fecha . "\n"
                . "*Hora reserva:* " . $hora . "\n\n"
                ."_Si desea rechazar su cita, presione el enlace_\n"
                ."http://psicologostemuco.cl/cita-pendiente/$dato->id\n"
                ."El tiempo para reembolsar su pago(85%) ha expirado, si cancela la cita no se hará la devolución";
        }

        //finalmente se realiza el envio con todos los parametros designados.
    $client->messages->create("$recipient", array('from' => "$twilio_number", 'body'=> $message));
    
    }
}
