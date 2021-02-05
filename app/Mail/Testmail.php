<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Servicio;
use App\User;

class Testmail extends Mailable
{
    use Queueable, SerializesModels;

    public $asunto = 'reserva cita';
    public $mensaje;
    public $ApellidoPaciente;
    public $nombrepacientecorreo;
    public $servicios;
    public $profesionals;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cita)
    {
        
        if(auth()->user()){
            $this->nombrepacientecorreo = auth()->user()->name;
            $this->ApellidoPaciente = auth()->user()->apellido;
        }
        
       // utilizar eloquent 

        $servicio = Servicio::select('nombre','user_id')
                    ->where('servicio.id','=',$cita->servicio_id)
                    ->get();
        
        $profesional = User::select('name','apellido')
                    ->where('id','=',$servicio[0]->user_id)
                    ->get();   

        $this->mensaje = $cita;
        $this->servicios=$servicio;
        $this->profesionals=$profesional;   
           
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('emails.contact');
        

    }
}
