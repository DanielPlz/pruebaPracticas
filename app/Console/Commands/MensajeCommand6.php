<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Twilio\Rest\Client;
use App\User;
use App\Cita;

class MensajeCommand6 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mensaje6:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando envia mensaje de recordatorio de la reserva mediante whatsapp 6 horas antes';

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
        $hora_cita =  date("H",strtotime($fecha_actual."+6 hours"));
        $citas = Cita::select('id','fecha','hora_inicio','servicio_id','modalidad','locacion','user_id')
                    ->where('estado','Confirmado')
                    ->where('fecha',date("Y-m-d",strtotime($fecha_actual."+6 hours")))->get();
        foreach($citas as $cita){
            $user = User::find($cita->user_id);
            $servicio = Cita::find($cita->id)->servicio->first();
            $profesional = User::find($servicio->user_id);
            $hora = explode(":",$cita->hora_inicio);
            if($hora_cita == $hora[0]){
                $numero = "+" . $user->telefono;
                $this->sendWhatsappNotification($cita, $profesional , $servicio, $numero);
            }
        }
    }

    private function sendWhatsappNotification($dato, $profesional, $servicio,string $recipient)
    {

        $twilio_whatsapp_number = getenv("TWILIO_WHATSAPP_FROM");
        $account_sid = getenv("TWILIO_AUTH_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        $hora = explode(":", $dato->hora_inicio);
        $hora = $hora[0] . ":" . $hora[1];
        if ($dato->modalidad == "Online") {
            $message = "*Recordatorio de su cita*\n\n_Detalles de su reserva_:\n\n"
                . "*Servicio:* " . $servicio->nombre . "\n"
                . "*Profesional:* " . $profesional->name . " " . $profesional->apellido . "\n"
                . "*Modalidad:* " . $dato->modalidad . "\n"
                . "*Fecha:* " . $dato->fecha . "\n"
                . "*Hora reserva:* " . $hora . "\n\n"
                ."_Si desea rechazar su cita, presione el enlace_\n"
                ."http://conexionsalud.cl/cita-pendiente/$dato->id\n"
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
                ."http://conexionsalud.cl/cita-pendiente/$dato->id\n"
                ."El tiempo para reembolsar su pago(85%) ha expirado, si cancela la cita no se hará la devolución";
        }
        return $client->messages->create("whatsapp:$recipient", array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
    }
}
