<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cita;
use App\user;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function indexAgenda(){
        return view("agenda.calendario");
    }

    //metodo para listar las citas, ocupando inner join

    public function listarAgenda(){
        $agenda = [];
        $user_id=auth()->user()->id;
        $agenda = Cita::select(

            'cita.locacion',
            'cita.modalidad',
            'cita.estado_pago',
            'cita.prevision',
            'cita.telefono',
            'cita.precio',
            'cita.fecha',
            'cita.hora_inicio',
            'cita.hora_termino',
            
            DB::raw("CONCAT(users.name,' ',users.apellido) AS paciente"),
            DB::raw("CONCAT(servicio.nombre) AS servicio"),
            DB::raw("CONCAT(users.name) AS psicologo")

        )
        ->from('cita')
        ->join('users', function ($join) {
            $join->on('cita.user_id', '=', 'users.id');
        })
        ->join('servicio', function ($join) {
            $join->on('cita.servicio_id', '=', 'servicio.id');
        })
        //consulta destinada a filtrar la informacion por el id del psicologo
        ->join('users as psi', function ($join){
            $join->on('psi.id', '=', 'servicio.user_id');
        })
        ->where('psi.id', '=', $user_id)
        ->get();

        
        foreach($agenda as $value){
            $nuevaAgenda[] = [
                //informacion de las propiedades netamente relacionadas a fullcalendar    
            "title"=>$value->paciente,
            "start"=>$value->fecha." ".$value->hora_inicio,
            "end"=>$value->fecha." ".$value->hora_termino,
            "backgroundColor"=>$value->modalidad == "Online" ? "#1cc961":"#d44f9f",
            "textColor"=>"#fff",
                //informacion que se desea obtener de la cita para mostrar, utilizando la funcionalidad de propiedades exstendidas de fullcalendar.
            "extendedProps"=>[
                "nombre"=>$value->paciente,
                "fecha"=>$value->fecha,
                "estado_pago"=>$value->estado_pago, 
                "modalidad"=>$value->modalidad,
                "servicio"=>$value->servicio,
                "prevision"=>$value->prevision,
                "precio"=>$value->precio,
                "telefono"=>$value->telefono,
                "hora_inicio"=>$value->hora_inicio,
                "hora_termino"=>$value->hora_termino,
                ]
            
            ];

        } 

        return response()->json($nuevaAgenda);

    }


}
