<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonio;
use App\User;

class TestimonioController extends Controller
{
     public function store(Request $request){
        $testimonio = new Testimonio();
        $testimonio->titulo = $request->get('titulo');
        $testimonio->comentario = $request->get('comentario');
        $testimonio->valoracion = $request->get('valoracion');
        if ($request->get('anonimo')) {
            $testimonio->anonimo = 1;
        } else {
            $testimonio->anonimo = 0;
        }
        $testimonio->profesional_id = $request->get('profesional_id');
        $testimonio->paciente_id = auth()->user()->id;
        $testimonio->save();

        return back()->with('success', 'Testimonio registrado con exito!');
        // //definir variables
        // $uid = $request->input('userId');
        // $pid = $request->input('numeroPsicologo');
        // //Select testimonios por id de usuario y psicologo
        // $testiSelect = \DB::table('item_rating')
        //             ->where('userId', '=', $uid)
        //             ->where('numeroPsicologo', '=', $pid)
        //             ->get();
        // $testiCount = $testiSelect->count();
        // //validación de máximo 3 testimonios por usuario a un psicólogo
        // if($testiCount<3){
        //     //asignar los registros del form a un modelo
        //     $rat = new Rating();
        //     $rat->userId = $request->input('userId');
        //     $rat->ratingNumber = $request->input('rating');
        //     $rat->title = $request->input('title');
        //     $rat->comments = $request->get('comment');
        //     $rat->numeroPsicologo = $request->input('numeroPsicologo');
        //     $rat->anon = $request->input('anonHidden');
        //     //insertar en la bd
        //     $rat->save();

        //     return redirect()->back()->with('alert','testimonio');
        // }else{
        //     return redirect()->back()->with('alert','error');
        // }

    }

    public function update(Request $request){
        //definir variables
        $ratingNumber = $request->input('ratingUp');
        $title = $request->input('title'); 
        $comments = $request->get('comment');
        $ratingId = $request->input('ratingIdx');
        //buscar el testimonio que se quiere modificar
        $upTesti = Rating::find($ratingId);
        //asignar datos de la variable al testimonio modificado
        $upTesti->ratingNumber = $ratingNumber;
        $upTesti->comments = $comments;
        $upTesti->title = $title;
        //actualizar testimonio
        $upTesti->update();

        return redirect()->back()->with('alert', 'modificar');
        
    }

    public function insertarValo(Request $request){
        //recorrido para las 8 valoraciones
        for($z=1;$z<=8;$z++){
            //definir variables
            $uid = $request->input('userId');
            $pid = $request->input('numeroPsicologo');
            //validación de insertar valoración, solo 1 por usuario por cada psicólogo
            $existe = Valoracion::where([
                ['userId', '=', $uid],
                ['psicologoId', '=', $pid],
                ['tipoValoracion_idTipo', '=', $z]
              ])->first();
            if ($existe === null) {
                //asignar valores al modelo
                $addVal = new Valoracion();
                $addVal->userId = $request->input('userId');
                $addVal->psicologoId = $request->input('numeroPsicologo');
                $addVal->rating = $request->input('rating'.$z);
                $addVal->tipoValoracion_idTipo = $z;
                //insertar valoración
                $addVal->save();
            }else{
                return redirect()->back()->with('alert', 'errorV');
            }
        }return redirect()->back()->with('alert', 'valoracion');
        
    }
    //pendiente
    public static function datosModi($ratingId){
        /* $ratingId = $request->input('ratingId'); */
        $datosModi = DB::table('item_rating')
        ->select('ratingNumber','title','comments')
        ->where('ratingId', '=', $ratingId)
        ->get();
        return view('datosModi',compact('datosModi'));
        
    }
    
    public function aceptarTesti(Request $request){
        $ratingId = $request->input('ratingId');
        $aceptTesti = Rating::find($ratingId);
        $x=1;
        $aceptTesti->status = $x;
        $aceptTesti->update();
        return redirect()->back();
    }

/*     public function rechazarTesti(Request $request){
        $ratingId = $request->input('ratingId');
        $rechazarTesti = Rating::find($ratingId);
        $rechazarTesti->delete();
        return redirect()->back();
    } */

    public static function nombreUsuario($id,$ratingId){
        $nombre = DB::table('item_rating')
            ->join('pacientes', 'userId', '=', 'id')
            ->select('pacientes.usuario','item_rating.anon')
            ->where('item_rating.userId', '=', $id)
            ->where('item_rating.ratingId', '=', $ratingId)
            ->get();
        $user = $nombre[0]->usuario;
        if($nombre[0]->anon == 0){
            $user = "Anónimo";
        }
        return $user;
    }

    //funciones para obtener los nombres e imprimirlos en el mail

    public static function nombrePacienteMail($id){
        $nombre = DB::table('pacientes')
            ->select('usuario')
            ->where('id', '=', $id)
            ->get();
        $paciente = $nombre[0]->usuario;
        return $paciente;
    }
    public static function nombreProfesionalMail($id){
        $nombre = DB::table('psicologos')
            ->select('usuario')
            ->where('numero', '=', $id)
            ->get();
        $profesional = $nombre[0]->usuario;
        return $profesional;
    }
}
