<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use storage;
use DB;
use Twilio\Rest\Client;
use App\Providers\RouteServiceProvider;



class SmsController extends Controller
{

    Protected function create(){
        $now=new \DateTime();
        $hora_actual=$now->format('Y-m-d H:i:s');
        
        $hora=date('H',strtotime($hora_actual.'+6 hours'));
     
        $user= DB::table('cita')
            ->join('users','cita.user_id','=','users.id')
            ->select('users.telefono','cita.fecha','cita.hora_inicio','cita.modalidad','cita.locacion','cita.servicio_id')
            ->where('cita.estado','=','Confirmado')
            ->where('cita.fecha', '=', $now->format('Y-m-d'))
            ->get();
          
        foreach($user as $dato){
          $profesional= DB::table('servicio')
            ->join('users','servicio.user_id','=','users.id')
            ->select('users.name','users.apellido','servicio.nombre')
            ->where('servicio.id','=',$dato->servicio_id)
            ->get();

            $partes = explode(":", $dato->hora_inicio);

            if($hora==$partes[0]){
                $numero = "+". $dato->telefono;
         
              $this->sendsmsnew($dato, $profesional[0], $numero);

            }
        }
    }
    
        private function sendsmsnew($dato , $profesional , string $recipient){
        
            $account_sid  =  getenv ( 'TWILIO_SID' );
            $auth_token  =  getenv ( 'TWILIO_AUTH_TOKEN' );
            $twilio_number  =  getenv ( 'TWILIO_NUMBER' );
    
            $client = new client ( $account_sid,$auth_token );
            
            $hora = explode(":",$dato->hora_inicio);
            $hora = $hora[0] . ":" . $hora[1];
    
            if($dato->modalidad == "Online"){
                $message = "Recordatorio de su cita". "\n"
                . "servicio: ".  $profesional->nombre. "\n"
                . "Profesional: " . $profesional->name . " " . $profesional->apellido. "\n"
                . "Modalidad: " . $dato->modalidad . "\n"
                . "Fecha: " . $dato->fecha . "\n"
                . "Hora de la reserva: " . $hora;
    
            }else{
                $message = "Recordatorio de su cita". "\n"
                . "servicio: " . $profesional->nombre . "\n"
                . "Profesional: " . $profesional->name . " " . $profesional->apellido . "\n"
                . "Modalidad: " . $dato->modalidad . "\n"
                . "Fecha: " . $dato->fecha . "\n"
                . "Hora de la reserva: " . $hora 
                . "ubicacion: " . $dato->locacion ;
    
            }

            
        $client->messages->create("$recipient", array('from' => "$twilio_number", 'body'=> $message));
        
        }
        
}

    


