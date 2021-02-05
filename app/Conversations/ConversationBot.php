<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\prueba_chatbot;
use DB;
use Illuminate\Console\Command;
use Twilio\Rest\Client;
session_start();


class ConversationBot extends Conversation
{
   /**
     * primera pregunta
     */
    public function hello()
    {
        $question = Question::create("Hola,¿Que tipo de usuario eres?") //hacemos una pregunta al usuario
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Paciente')->value('paciente'),//Primera opcion, esta tendra el valor paciente
                Button::create('Psicólogo')->value('Pro'), //Segunda opcion, esta tendra el valor Pro
            ]);
        //Cuando el usuario elija la respuesta, se enviará el valor aquí:
        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'paciente') {//Si es el value paciente, se activa el metodo categorias
                    $this->categorias();
                } else if ($answer->getValue() === 'Pro'){  //Si el value corresponde a Pro, se activa el metodo admi
                    $this->prof1();
                }
            }
        });
    }
//Esta función presenta las categorias de preguntas que el bot puede responder
    public function categorias()
    {
        $question = Question::create("¿De que se trata su pregunta? ") 
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Reserva de hora con especialista')->value('Reserva'),
                Button::create('Medio de Pago')->value('Pago'), 
                Button::create('Comunicación con el profesional tratante')->value('Comun'),
                Button::create('Recordatorio de cita')->value('Recor'), 

              
            ]);
            return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'Reserva') {
                    $this->say('Reservas');
                    $this->reserv();
                } else if ($answer->getValue() === 'Pago'){
                    $this->say('Metodos de pago');
                    $this->pago();
                }
                else if ($answer->getValue() === 'Comun'){
                    $this->say('Comunicación');
                    $this->comun();
                }
                else if ($answer->getValue() === 'Recor'){
                    $this->say('Recordatorio de cita');
                }
             
                
            }
        });
    }

  //Esta función corresponde a la seccion de preguntas de reserva 
    public function reserv(){
        $question = Question::create("¿Cual es su pregunta? ") 
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('¿Como puedo agendar una hora?')->value('1'),
                Button::create('¿Puedo cambiar la fecha o cancelar una reserva?')->value('2'), 
                Button::create('¿De que maneras puedo recibir el servicio?')->value('3'),
                Button::create('¿Puedo hacer una reserva para otra persona?')->value('4'), 
              
            ]);
       
        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === '1') {
                    $this->say('En la lista de psicologos hay un botón al costado de cada profesional que dice "Reservar cita" una vez 
                    que se haga clic en este apartado se abrirá una ventana en la cual usted debe ingresar su correo, telefono y RUT, luego
                    al oprimir siguiente, aparecerán los servicios que ud requiere, la modalidad y si tiene ud previción, en la pagina siguiente
                    aparecerá un detalle de sus datos, los cuales deberá aceptar junto a los terminos y condiciones de uso, una vez realizada esta acción
                    ud debe pagar la cita y para concluir agendar la hora');
                  $this->finRsv();
                } else if ($answer->getValue() === '2'){
                    $this->say('La reservacion se puede cancelar con 12 horas de antelacion a la hora de la reserva, y solo se le devolvera el 85% del costo de la reserva. 
                    <br> <br> Se puede cambiar la hora de la reserva 24 horas previo a la hora de reserva.');
                    $this->finRsv();
                }
                else if ($answer->getValue() === '3'){
                    $this->say('El servicio lo puede recibir en 3 modalidades diferentes: <br> <br> - Presencial: El profesional lo citara a su lugar de trabajo. 
                    <br> <br> - Online: La visita se hara a traves de una herramienta externa de transmision en vivo dada por el profesional. <br> <br> 
                    - Visita: El profesional se acercara a su residencia para darle el servicio.');
                    $this->finRsv();
                }
                else if ($answer->getValue() === '4'){
                    $this->say('Si, usted puede reservar por un tercero aceptando los terminos y condiciones de uso.');
                    $this->finRsv();
                }
             
                
            }
        });
    }
//Esta función corresponde a el fin de la seccion de reserva
    public function finRsv(){
        $question = Question::create("¿Tiene usted otra pregunta? ") 
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason')
        ->addButtons([
            /*Button::create('Sí, sobre el mismo tema')->value('1'),
            Button::create('Sí, sobre otro tema')->value('2'), 
            Button::create('No, muchas gracias')->value('3'),
            Button::create('Esta respuesta no me satisface, me gustaria comunicarme con un administrador')->value('4'),*/ 
          
            Button::create('Sí')->value('1'),
            Button::create('No')->value('2'), 
        ]);
    
    return $this->ask($question, function (Answer $answer) {
        if ($answer->isInteractiveMessageReply()) {
            if ($answer->getValue() === '1') {//Si es el value who, contestará con este mensaje
                $this->reserv();
              
            } else if ($answer->getValue() === '2'){
                $this->categorias();
            }
            else if ($answer->getValue() === '3'){
                $this->despedida();// una funcion de despedida
            }
            else if ($answer->getValue() === '4'){
                $this->ejecutivo(); //una funcion donde se muestre el link a hubspot
            }
         
            
        }
    });
    }

    //respuesta de metodo de pagos
    public function pago(){
        $question = Question::create("¿Cual es su pregunta? ") 
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('¿cual tarjeta se puede utilizar para el pago de un servicio?')->value('1'),
                Button::create('¿conexion salud acepta el pago a traves de cuotas?')->value('2'), 
                Button::create('¿como obtengo mi recibo?')->value('3'),
                Button::create('¿la tarjeta de pago debe estar asociada a alguna casa comercial o banco?')->value('4'),
                Button::create('¿se puede paga en efectivo?')->value('5'), 
                Button::create('¿puedo dar uso a plan isapre o fonasa?')->value('6'), 
              
            ]);
        
        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === '1') {//Si es el value who, contestará con este mensaje
                    $this->say('Acepta todo tipo de tarjeta de credito, debito y prepago que esten ligadas a Transbank.');
                  $this->finPago();
                } else if ($answer->getValue() === '2'){
                    $this->say('Si, actualmente Conexion Salud acepta pago de 2 y 3 cuotas, credito y prepago.');
                    $this->finPago();
                }
                else if ($answer->getValue() === '3'){
                    $this->say('Usted al realizar el pago de un servicio a traves de Transbank, este le dara un comprobante el cual
                    podra descargar en formato .PDF');
                    $this->finPago();
                }
                else if ($answer->getValue() === '4'){
                    $this->say('Si, tanto su tarjeta de debito, credito o prepago deben estar asociadas a un banco o casa comercial.');
                    $this->finPago();
                }
                else if ($answer->getValue() === '5'){
                    $this->say('Actualmente no se puede realizar pagos en efectivo.');
                    $this->finPago();
                }
                else if ($answer->getValue() === '6'){
                    $this->say('Si, se puede dar uso del plan isapre o fonasa dependiendo de cada profesional. El descuento se aplica previo al cobro que se hace por Transferencia.');
                    $this->finPago();
                }
             
                
            }
        });
    }

    public function finPago(){
        $question = Question::create("¿Tiene ud otra pregunta? ") 
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason')
        ->addButtons([
            Button::create('Sí, sobre el mismo tema')->value('1'),
            Button::create('Sí, sobre otro tema')->value('2'), 
            Button::create('No, muchas gracias')->value('3'),
            Button::create('Esta respuesta no me satisface, me gustaria comunicarme con un administrador')->value('4'), //Segunda opcion, esta tendra el value info
          
        ]);

    return $this->ask($question, function (Answer $answer) {
        if ($answer->isInteractiveMessageReply()) {
            if ($answer->getValue() === '1') {
                $this->pago();
              
            } else if ($answer->getValue() === '2'){
                $this->categorias();
            }
            else if ($answer->getValue() === '3'){
                $this->despedida();
            }
            else if ($answer->getValue() === '4'){
                $this->ejecutivo(); 
            }
         
            
        }
    });
    }

      //respuesta de comunicacion
      public function comun(){
        $question = Question::create("¿Cual es su pregunta? ") 
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('¿Como puedo comunicarme con el profesional tratante?')->value('1'),
                Button::create('¿De que manera puedo evaluar el servicio recivido?')->value('2'),
       
              
            ]);
      
        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === '1') {
                    $this->say('¿como puedo comunicarme con el profecional tratante?');
                    $this->say('Existen varias maneras de comunicarse con el profesional, ademas de sus propias redes sociales, el sistema
                    conexion salud cuenta con un chat en vivo, el cual solo es accesible si ud posee una cuenta en la pagina, este está disponible en
                    la seccion de profesionales y la respuesta depende de la disponibilidad del profesional.');
                  $this->finCom();
                } else if ($answer->getValue() === '2'){
                    $this->say('Ud puede evaluar el servicio recivido a través de un sistema de evaluacion disponible en la ficha
                    del profesional, el cual consiste en una calificacion de estrellas, ademas puede ud dejar comentarios en la misma sección.');
                    $this->finCom();
                }
              
             
                
            }
        });
    }

    public function finCom(){
        $question = Question::create("¿Tiene ud otra pregunta? ") 
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason')
        ->addButtons([
            Button::create('Sí, sobre el mismo tema')->value('1'),
            Button::create('Sí, sobre otro tema')->value('2'),
            Button::create('No, muchas gracias')->value('3'),
            Button::create('Esta respuesta no me satisface, me gustaria comunicarme con un administrador')->value('4'), 
          
        ]);
    
    return $this->ask($question, function (Answer $answer) {
        if ($answer->isInteractiveMessageReply()) {
            if ($answer->getValue() === '1') {
                $this->comun();
              
            } else if ($answer->getValue() === '2'){
                $this->categorias();
            }
            else if ($answer->getValue() === '3'){
                $this->despedida();// una funcion de despedida
            }
            else if ($answer->getValue() === '4'){
                $this->ejecutivo(); //una funcion donde se muestre el link a hubspot
            }
         
            
        }
    });
    }

          //respuesta de recordatorio
    public function recor(){
            $question = Question::create("¿Cual es su pregunta? ") 
                ->fallback('Unable to ask question')
                ->callbackId('ask_reason')
                ->addButtons([
                    Button::create('¿Que es el recordatorio de citas?')->value('1'),
                    Button::create('¿Como accedo al recordatorio?')->value('2'), 
                    Button::create('¿Donde y cuando reciviré el recordatorio?')->value('2'),
                  
                ]);
       
            return $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    if ($answer->getValue() === '1') {
                        $this->say('Se trata de un sistema automatico, que tiene la finalidad de confirmar su asistencia a una cita
                        momentos previos a que esta se realize, en esta función además ud puede anular su cita. ');
                      $this->finRecor();
                    } else if ($answer->getValue() === '2'){
                        $this->say('Una vez haga una reservación los recordatorios llegarán automaticamente a los medios de comunicación que ud nos 
                        facilita al momento de hacer su reserva.');
                        $this->finRecor();
                    } else if ($answer->getValue() === '3'){
                        $this->say('Ud recibirá el recordatorio en formato sms, wspp y en correo electronico y recivirá el mensaje 48, 24 y 12 horas antes de la cita.');
                        $this->finRecor();
                    }
                  
                 
                    
                }
            });
        }
    
        public function finRecor(){
            $question = Question::create("¿Tiene ud otra pregunta? ")
            ->fallback('Unable to ask question') 
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Sí, sobre el mismo tema')->value('1'),
                Button::create('Sí, sobre otro tema')->value('2'), 
                Button::create('No, muchas gracias')->value('3'),
                Button::create('Esta respuesta no me satisface, me gustaria comunicarme con un administrador')->value('4'), 
              
            ]);
      
        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === '1') {
                    $this->recor();
                  
                } else if ($answer->getValue() === '2'){
                    $this->categorias();
                }
                else if ($answer->getValue() === '3'){
                    $this->despedida();// una funcion de despedida
                }
                else if ($answer->getValue() === '4'){
                    $this->ejecutivo(); //una funcion donde se muestre el link a hubspot
                }
             
                
            }
        });
        }
    
   

        //Esta función se despide del usuario 
        public function despedida()
    {
        $this->say('Muchas gracias por hacer uso de nuestro ChatBot. Esperando haber resuelto todas sus dudas, se despide atentamente el equipo de Conexión Salud.');
    }
// esta función lleva a hubspot
    public function ejecutivo()
    {
        $this->say('Para poder comunicarse con algun ejecutivo, haga click <a href="https://meetings.hubspot.com/sergio-pino" target="_blank">aqui</a>');
    }
 //Funcion de administrador
    public function prof1(){
    
        $question = Question::create("Para contratar un plan profesional, conocer los beneficios y servicios de los planes
        a los que puede optar, porfavor haganos llegar sus datos a través de una de las siguientes opciones  ") //Saludamos al usuario
        ->fallback('Unable to ask question')
        ->callbackId('ask_reason')
        ->addButtons([
        //Primera opcion, esta tendra el value who
            Button::create('Nos contactamos con usted')->value('Ing'), //Segunda opcion, esta tendra el value info
            Button::create('Video conferencia')->value('VC'),
      
          
        ]);
    //Cuando el usuario elija la respuesta, se enviará el value aquí:
    return $this->ask($question, function (Answer $answer) {
        if ($answer->isInteractiveMessageReply()) {
           if ($answer->getValue() === 'Ing'){
           
                $this->contacto();
            }  else if ($answer->getValue() === 'VC'){
                $this->say('Video Conferencia');
                $this->ejecutivo();
            }     
                 
        }
    });



    }




//ruta a la pestaña contacto
        public function contacto()
    {
        $this->say('Para poder contactarse con conexión salud, dirijase <a href="'.route('Contacto').'" target="_parent">aqui</a>');
    }


  
   
    /**
     * se inicia la conversación y se llama a la función hello
     */
    public function run()
    {
        $this->hello();
    }
}