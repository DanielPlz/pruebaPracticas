<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactoBD;
use DB;
use Illuminate\Console\Command;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail; //Importante incluir la clase Mail, que será la encargada del envío

class ContactoController extends Controller
{
    //esta funcón muestra la vista contacto
    public function Cont(){
        
        return view('contacto.contacto');
    }

    //esta funcion cumple tres roles Guardar en bbdd/ mandar los datos a un wspp/ mandar los datos al correo de coexion salud
    public function agregar(Request $request){
       
        //obtenemos los datos del formulario
        $rut = $request->get('rut2');
        $tipo = $request->get('radious'); 
        $nombre = $request->get('nombre');
        $apellido = $request->get('apellido');
        $telefono = $request->get('telefono');
        $correo = $request->get('correo');
        $region = $request->get('region');
        $comuna = $request->get('comuna');
        $calle = $request->get('calle');
        $casa = $request->get('numcasa');
        $depto = $request->get('numdepto'); 

        //una variable de seguridad
        $conf = 0;
        //se guardan los datos en una BBDD, Tambien se capturan las excepciones como la duplicidad de datos
        try{
            ContactoBD::create([
                'rut' => $rut,
                'tipo_us'=> $tipo, 
                'nombre_cont_us'=> $nombre,
                'apellido_cont_us'=> $apellido,
                'telefono_cont_us'=> $telefono,
                'correo_cont_us'=> $correo,
                'region_cont_us'=> $region,
                'comuna_cont_us'=> $comuna,
                'calle_cont_us'=> $calle,
                'no_casa_cont_us'=> $casa,
                'no_depto_cont_us'=> $depto,     
            ]);
                
        }catch(\Illuminate\Database\QueryException $e){

            //si el intento falla la variable de seguridad cambia, lo que impide el envio del correo y el wspp
            $conf=1;
            //mensaje de error al usuario
            echo'<script type="text/javascript">
            alert("Error de duplicidad en correo/Rut, espere a que le contacten ");
            window.location.href="'.route('Contacto').'";
            </script>';


        }

       //se ejectua si la bbdd tuvo exito
    if($conf==0){
        //se inicializa twilio
        
        $twilio_whatsapp_number = getenv("TWILIO_WHATSAPP_FROM"); //<-- NO HACE EL LLAMADO AL .env
        $account_sid = getenv("TWILIO_AUTH_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $client = new Client($account_sid, $auth_token);
        //se crea el mensaje de wspp
        $message = "*Hola*\n\nSoy botman y vengo a informar que un usuario quiere establecer contacto, Responde a los siguientes datos:\n\n"
        . "*RUT:* " . $rut. "\n"
        . "*Tipo de usuario:* " . $tipo . " \n"
        . "*Nombre:* " . $nombre . " " . $apellido . "\n"
        . "*Telefono:* " . $telefono . "\n"
        . "*Correo:* " . $correo . "\n"
        . "*Region:* " . $region . "\n"
        ."*Comuna:* " . $comuna ."\n"
        ."*Calle:* " . $calle ."\n"
        ."*Nro Casa:* " . $casa ."\n"
        ."*Nro Depto:* " . $depto ."\n";


        //se envia el mensaje de wspp, el numero objetivo es el de Sebastián Martínez (practicante), cambiarlo a wspp de ejecutivo, cuando se posea licencia de twilio.
        $client->messages->create("whatsapp:+56964704766", array('from' => "whatsapp:+14155238886", 'body' => $message));  // <--   

        //se inicializa el proceso de envío de correo
        $subject = "Datos de contacto: ";
        $for = "prdlc94@gmail.com"; //correo de destino (para pruebas ingresar correo personal)
        FacadesMail::send('contacto/correo',$request->all(), function($msj) use($subject,$for){
            $msj->from("no-reply@psicologostemuco.cl","Conexión Salud");
            $msj->subject($subject);
            $msj->to($for);
        });

        //REVISAR ECHO (NO ESTA EJECUTANDO)
        echo'<script type="text/javascript">
        alert("Un ejecutivo lo contactará en la brevedad ");
        window.location.href="'.route('Contacto').'";
        </script>'; 
        return redirect()->back();
    } 
    }
}
