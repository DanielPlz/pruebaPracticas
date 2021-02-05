<?php

namespace App\Http\Controllers;

use App\User;
use App\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    function _contruct(){
        $this->middLeware('auth');
    }
    /*
        'Function index' que permite obtener el listado de todos los usuarios a excepción del usuario que esta 'logeado' actualmente,
        dicho listado sera compartido con la vista chatform donde el profesional podrá seleccionar un usuario cliente como destinatario 
        de mensaje.
    */
    function index(){
        $users = User::select('id', 'name', 'apellido', 'avatar', 'email', 'tipo')
        ->where('id', '!=', Auth::id())
        ->get();
        $notReadList = [];
        foreach ($users as $user) {
            $messages = Mensaje::select('from')
            ->where([ 'from' => $user->id, 'to' => Auth::id(), 'is_read' => 0 ])
            ->count();
            array_push($notReadList, ['from' => $user->id, 'count' => $messages]);
        }
        return view('chat.chatform', ['users' => $users, 'notReadList' => $notReadList]);
    }
    /*
        Function que permite obtener el conteo de mensajes que han sido leidos entre un chat ya iniciado.
    */
    public function getReadMessages($id, Request $request){
        if($request->ajax()){
            $messages = Mensaje::select('*')
            ->where(['from' =>  $id, 'to' => Auth::id(), 'is_read' => 0])
            ->count();
            return response()->json($messages, 200);
        }else{
            return response()->json('No es posible mostrar el contenido solicitado', 200);
        }
    }
    /*
        Function que permite obtener el listado de mensajes a partir del id de usuario receptor del mensaje a enviar, al igual que marcará 
        como leídos los mensajes que sean cargados.
        El listado obtendio será compartido a la vista en formato JSON para poder procesarlos mediante AJAX y cargarlos en la vista correspondiente
        sea esta el chat modal para usuarios o bien el panel chat de profesional. 
    */    
    public function getMessage($user_id, Request $request){
        if($request->ajax()){
            $my_id = Auth::id();
            Mensaje::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

            $messages = Mensaje::where(function ($query) use ($user_id, $my_id){
                $query->where('from', $user_id)->where('to', $my_id);
            })->orWhere(function ($query) use ($user_id, $my_id) {
                $query->where('from', $my_id)->where('to',$user_id);
            })->get();

            return response()->json($messages, 200);
        }else{
            return response()->json('No es posible mostrar el contenido solicitado', 200);
        }
    }
    /* 
        Function que permite descargar un archivo a partido del nombre de este, buscandolo dentro del disco publico ubicado en 'Storage/app/public',
        validando su existencia para que en función de si este no es encontrado se retorne un mensaje indicando lo sucedido a la vista o bien si realmente
        está en la ruta mencionada que se descargue el archivo solicitado.
    */    
    public function downloadFile($file){
        $existe = Storage::disk('public')->exists($file);
        if ($existe) {
            return Storage::download("public/$file");
        } else {            
            return Storage::download("public/no_disponible.png");
        }
    }
    /*
        Function que permite enviar un mensaje hacia otro usuario. Validando si desde el cliente se ha seleccionado el envio de un archivo
        ya sea un documento pdf, docx o bien uan imagen (jpeg, jpg, png). En el caso de que se detecte el envio del archivo se obtendran 
        algunos datos relevantes del mismo, ya sea nombre, extención y tipo de archivo con la finalidad de validar que sea un elemento valido
        para su guardado, en caso de serlo se enviará al disco publico para su almacenaje e igualmente en la base de datos almacenamos el nombre dato
        al archivo para su posterior recuperacion. Y en el caso de no enviar un archivo desde el cliente todo lo anterior sera omitido. 
        posterior a ello se verifica que el mensaje tenga contendio para proceder al guardado del mismo. 
        Esto con actualización en tiempo real de esta acción. Debido a la implementacion de Pusher, que
        mediante la creacion de canales y subcripción a ellos mantendremos una comunicación en tiempo ral entre cliente y servidor.
    */
    public function sendMessage(Request $request){
        $from = Auth::id();
        $to = $request->receiver_id;
        //comprobando si el usuario a enviado un archivo
        $archivo = $request->file('fileUser');
        $infoSave = [];
        if ($archivo) {
            //guardando informacion del archivo
            $fileOriginalName = $archivo->getClientOriginalName();
            $fileType = '';
            $fileExtend = $archivo->getClientOriginalExtension();
            $validateImage = \Validator::make($request ->all(), [
                'fileUser' => 'image|mimes:jpg,jpeg,png,svg|max:12000'
            ]);
            $validateDocument = \Validator::make($request ->all(), [
                'fileUser' => 'mimes:docx,pdf|max:12000'
            ]);
            //es una imagen
            if(!$validateImage->fails()){
                $fileType = 'image';
            }
            //es una documento
            if(!$validateDocument->fails()){
                $fileType = $fileExtend;
            }
            if (!$validateImage->fails() || !$validateDocument->fails()) {
                $image_name = time().$fileOriginalName;
                $archivo->storeAs('public', $image_name);
                //guardando un mensaje con el nombre del archivo
                $data = new Mensaje();
                $data->from = $from;
                $data->to = $to;
                $data->message = $image_name;
                $data->type_content = $fileType;
                $data->is_read = 0;
                $data->save();
                array_push($infoSave, $data);
            }else{
                $info = ['extend' => 'Su archivo fue rechazado'];
                array_push($infoSave, $info);
            }
        }
        $validateMessage = \Validator::make($request ->all(), [
            'message' => 'min:1|max:300'
        ]);
        if(!$validateMessage->fails()){
            //guardado un mensaje
            $data = new Mensaje();
            $data->from = $from;
            $data->to = $to;
            $data->message = $request->message;
            $data->type_content = 'text';
            $data->is_read = 0;
            $data->save();
            array_push($infoSave, ['messageSend' => $data]);
            $options = array(
                'cluster' => 'us2',
                'useTLS' => true
            );
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $data = ['from' => $from, 'to' => $to];
            $pusher->trigger('my-channel', 'my-event', $data);

            return response()->json($infoSave, 200);
        }else{
            $info = ['messageError' => 'Recuerde. su mensaje será guardado si contiene entre 1 y 300 caracteres '];
            array_push($infoSave, $info);
            return response()->json($infoSave, 200);
        }
    }
    /* 
        Function que permite mostrar un archivo a partir de su nombre, buscandolo dentro del disco publico ubicado en 'Storage/app/public', validando su
        existencia para que en el caso de no ser encontrado se retorne un mensaje a la vista indicando lo sucedido o bien en el caso de ser encontrado, que 
        se imprima en la vista ( <img src> )
    */    
    public function showFile($fileName){
        $existe = Storage::disk('public')->exists($fileName);
        if ($existe) {
            $archivo = Storage::disk('public')->get($fileName);
            return new Response($archivo, 200);
        }else{
            $archivo = Storage::disk('public')->get('no_disponible.png');
            return new Response($archivo, 200);
        }
    }

}
