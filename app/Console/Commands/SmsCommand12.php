<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cita;
use App\User;
use Twilio\Rest\Client;

class SmsCommand12 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms12:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando envia mensaje de recordatorio de la reserva mediante mensaje de texto 13 horas antes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $now = new \DateTime();
        $fecha_actual = $now->format('Y-m-d H:i:s');
        $hora_cita =  date("H",strtotime($fecha_actual."+12 hours"));
        $citas = Cita::where('estado','Confirmado')
        ->where('fecha',date("Y-m-d",strtotime($fecha_actual."+12 hours")))->get();

        foreach($citas as $cita){
            $servicio = Cita::find($cita->id)->servicio->first();
            $profesional = User::find($servicio->user_id);

            $hora = explode(":",$cita->hora_inicio);
            if($hora_cita == $hora[0]){
            $numero = "+" . $cita->telefono;
            $this->sendsmsnew12($cita, $profesional,$servicio,$numero);
             }
        }  

    }
    
    private function sendsmsnew12($dato , $profesional , $servicio ,string $recipient){

        //Se realiza la configuracion de twilio para poder realizar la conexion de una API
        $account_sid  =  getenv ( 'TWILIO_SID' );
        $auth_token  =  getenv ( 'TWILIO_AUTH_TOKEN' );
        $twilio_number  =  getenv ( 'TWILIO_NUMBER' );

        //Se guardan las credenciales de la api en una variable
        $client = new client ( $account_sid,$auth_token );
        
        //se realiza la misma particion de la hora obtenida para poder definir cuando se le enviara el sms al paciente
        $hora = explode(":",$dato->hora_inicio);
        $hora = $hora[0] . ":" . $hora[1];

        //se realiza una consulta que al momento de ser una modalidad u otra enviara diferentes tipos de sms al paciente
        if($dato->modalidad == "Online"){
            $message = "Recordatorio de su cita". "\n"
            . "servicio: ".  $servicio->nombre. "\n"
            . "Profesional: " . $profesional->name . " " . $profesional->apellido. "\n"
            . "Modalidad: " . $dato->modalidad . "\n"
            . "Fecha: " . $dato->fecha . "\n"
            . "Hora de la reserva: " . $hora;

        }else{
            $message = "Recordatorio de su cita". "\n"
            . "servicio: " . $servicio->nombre . "\n"
            . "Profesional: " . $profesional->name . " " . $profesional->apellido . "\n"
            . "Modalidad: " . $dato->modalidad . "\n"
            . "Fecha: " . $dato->fecha . "\n"
            . "ubicacion: " . $dato->locacion . "\n"
            . "Hora de la reserva: " . $hora ;
            
        }

        //finalmente se realiza el envio con todos los parametros designados.
    $client->messages->create("$recipient", array('from' => "$twilio_number", 'body'=> $message));
    
    }
}

