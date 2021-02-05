<?php
  
namespace App\Http\Controllers;
  
use BotMan\BotMan\BotMan;
use App\Conversations\ConversationBot;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use Illuminate\Foundation\Inspiring;


  
class BotManController extends Controller
{
  
   

    public function handle()
    {
     
// se crea la instancia de botman

        $botman = app('botman');

        //esta función inicia un objeto de clase conversación, donde está toda la logica del bot
        $botman->hears('Hola', function($bot) {
            $bot->startConversation(new ConversationBot);
        });
        //esta linea captura cualquier texto que el usuario ingrese y no sea valido
        $botman->fallback(function($bot) {
            $bot->reply('Lo siento, no puedo entender lo que acaba de escribir, reintentelo por favor...');
        });
  

        $botman->listen($botman);
       
      
    }
  
 

   
   


}