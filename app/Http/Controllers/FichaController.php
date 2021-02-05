<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\carbon;
use App\Session;
use App\comentarios;
use App\Diagnostico;
use App\Diagnostico_por_eje;
use App\Ficha;
use App\Ficha_caso;
use App\Ficha_caso_profesional;
use App\Ficha_casos_profesional;
use App\Ficha_derivacion;
use App\Ficha_diagnostico_eje;
use App\Ficha_diagnostico_general;
use App\Ficha_diagnostico_por_eje;
use App\Ficha_egreso_caso;
use App\Ficha_eje_manual;
use App\Ficha_observacion;
use App\Ficha_sesion;
use App\Ficha_tipo_egreso;
use App\FichaSesion;
use App\info_paciente;
use App\Info_Profesional;
use App\InfoProfesional;
use App\Manual;
use App\Observacion;
use App\Paciente;
use App\Paciente_profesional;
use App\Persona;
use App\Psicologo;
use App\Servicio;
use App\Sesion;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Hamcrest\Core\HasToString;
use Symfony\Polyfill\Intl\Idn\Info;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\each;

class FichaController extends Controller
{


    //Metodo para buscar pacientes asocioados al un profecional

    public function buscarPacientes(Request $request, $id)
    {

        //buscar id  info del profesinal
        $info_profesional  = Psicologo::where('id_user', $id)->first();
        // Buscar todos los pacientes relacionadas con el profesional

        $pacientes = FichaSesion::with('ficha','reserva', 'reserva.paciente', 'reserva.paciente.persona')
            ->where('id_psicologo', $info_profesional->id_psicologo)->get();
           // ->orderBy('fecha', 'DESC');
           // ->paginate(5);

           $Fichita = FichaSesion::where('id_psicologo', $info_profesional->id_psicologo )->get();
         //  var_dump($pacientes->reserva->paciente->persona->rut).die;



                // $pacientes->reserva->paciente->persona
        //Evitamos que los pacientes se dupliquen haciendo una lista de pacientes unicos
        $pacientesUnicos = collect([]);
        foreach ($pacientes as $pac) {  
            if (!$pacientesUnicos->contains($pac))
                $pacientesUnicos->add($pac, $pac->ficha);
        }
        $nom = request()->name;

        // Lista de Todas las personas que tengan nombre parecido A $nom 
        $buscarPaciente = Persona::where('nombre', 'LIKE', '%' . $nom . '%')
            ->orwhere('apellido_paterno', 'LIKE', '%' . $nom . '%')
            ->orwhere('rut', 'LIKE', '%' . $nom . '%')->get();


        $buscarPacientes = collect([]);
       // Si Los pacientes asociados al profesional coinciden con algun objeto de la lista Buscar paciente
       // lo anade a la collect, la cual va a contener datos de la tabla Persona
       foreach ($buscarPaciente as $pa) {
          foreach ($pacientesUnicos as $pas) {
               if ($pa->id_persona == $pas->reserva->paciente->persona->id_persona) {
            $buscarPacientes->add($pa);
               }
            }
       }   


        return view('ficha.pacientes', compact('pacientes', 'buscarPacientes', 'info_profesional'));
    }
   

    //Consulta de vista 'information.blade' para retornar datos de pacientes
    public function informationPaciente($idpa, $idpo)
    {
        //Solicitamos los datos del paciente por su id 
        $paciente = Paciente::with('persona')->where('id_persona',$idpa)->first() ;
        //Solicitamos los datos del caso del paciente
      
     
        $ficha = Ficha::where('id_paciente', $paciente->id_paciente)->first();
      

        //Definimos fecha nacimiento 
        $fecha_n = Carbon::parse($paciente->persona->fecha_nacimiento);
        //Calculamos la edad
        $edad = carbon::now()->diffInYears($fecha_n);

      
        //Solicitamos datos relacionados al caso 'servicio' 'info_profesional'
        $sesiones = FichaSesion::where('id_ficha', $ficha->id_ficha)->get();
        


        return view('ficha.information', compact('paciente', 'ficha', 'sesiones', 'idpo' , 'edad'));
    }
    
  
    //Metodo utilisado para entregar datos
    public function Sesion($idpa, $idpo, $ids, $ns, $sr, $idc, $nomc, $caes)
    {    
        $observaciones = Ficha_observacion::where('id_sesion', $ids)->orderby('id', 'DESC')->get();
        $paciente = info_paciente::find($idpa);
        $manual = Ficha_eje_manual::with('ficha_manual')->get();
        $tipo_alta = Ficha_tipo_egreso::all();


        $fecha_n = Carbon::parse($paciente->fecha_nac);
        $edad = carbon::now()->diffInYears($fecha_n);
        //Array con todos los manuales
        $manuni = collect([]);
        foreach ($manual as $ma) {
            if (!$manuni->contains($ma->ficha_manual))
                $manuni->add($ma->ficha_manual);
        }

        $diagnosticog = ficha_diagnostico_general::where('id_sesion', $ids)->first();
        $manualC = Ficha_diagnostico_por_eje::with('ficha_diagnostico_eje', 'ficha_diagnostico_eje.ficha_eje_manual', 
        'ficha_diagnostico_eje.ficha_eje_manual.ficha_manual')
            ->where('id_sesion', $ids)->get();
        //Comprobar si existe el manual
        if ($manualC->count() > 0) {
            foreach ($manualC as $ma) {
                $manuniC = $ma->ficha_diagnostico_eje->ficha_eje_manual->ficha_manual;
                $fecha = $ma->ficha_diagnostico_eje;
            }
        } else {
            $manuniC = 1;
            $fecha = 1;
        }
        return view('ficha.Sesion', compact('paciente', 'observaciones', 'ns', 'sr', 'ids',
         'idpo', 'manuni', 'manual', 'manualC', 'manuniC', 'diagnosticog', 'fecha', 'idc', 'nomc' , 'tipo_alta' , 'caes' , 'edad'));
    }



// Método utilizado para Crear observacion
    public function crearObservacion(Request $request, $ids)
    {   
        $request->validate(['txt_observacion' => 'required',]);
        $observacion = new Ficha_observacion();
        $observacion->observacion =  request()->txt_observacion;
        $observacion->id_sesion =  $ids;
        $observacion->save();
        return back();
    }

// Método utilizado para crear un registro dee diagnóstico Diagnostico General
    public function crearDiagnosticoG(Request $request, $ids)
    {   
        
        $request->validate(['txt_diagnostico_g' => 'required',]);

        $Diagnostico = new Ficha_diagnostico_general();
        $Diagnostico->diag_gral =  request()->txt_diagnostico_g;
        $Diagnostico->id_sesion =  $ids;
        $Diagnostico->save();

        return back();
    }

// Método utilizado para crear un registro dee diagnóstico Diagnostico por Manual

   /*  public function crearDiagnosticoM(Request $request,$ids)
    {
    

        $ejes = collect([]);
        $manualeGuardado= false;

        for ($i = 1; $i <= 30; $i++) {
            if ($request->input('txt_eje_' . $i) !== null) {
                $manuale = new Ficha_diagnostico_eje();
                $manuale->descripcion = $request->input('txt_eje_' . $i);
                $manuale->id_eje = $request->input('txt_id_' . $i);
                if( $manuale->save()){
                    $manualeGuardado= true;
                }
               

                $ejes->add($manuale->id);
            }
        }
        

        foreach ($ejes as $eje) {
            $diagnosticoM = new Ficha_diagnostico_por_eje();
            $diagnosticoM->id_diag =  $eje;
            $diagnosticoM->id_sesion =  $ids;
            $diagnosticoM->save();
        }
        
         if ($manualeGuardado) {
            return back()->with('successem', 'Manual Creado Correctamente');
        } else {
            return back()->with('warning', 'Porfavor Completar todos los campos');
        }

    
    } */
    public function crearDiagnosticoM(Request $request,  $ids)
    {
        $ejes = collect([]);
        $manual = 1;

        for ($i = 1; $i <= 30; $i++) {
            if ($request->input('txt_eje_' . $i) !== null) {
               $manual = $request->input('txt_id_' . $i);
            }
        }
        $nm = Ficha_eje_manual::where('id' , $manual)->first();
        $ejesm = Ficha_eje_manual::where('id_manual' , $nm->id_manual)->get();


        foreach ($ejesm as $ej){
            if ($request->input('txt_eje_' . $ej->id) == null) {
                $manuale = new Ficha_diagnostico_eje();
            $manuale->descripcion = "";
            $manuale->id_eje = $request->input('txt_id_' . $ej->id);
            $manuale->save();
            $ejes->add($manuale->id);
           
        }else{
            $manuale = new Ficha_diagnostico_eje();
            $manuale->descripcion = $request->input('txt_eje_' . $ej->id);
            $manuale->id_eje = $request->input('txt_id_' . $ej->id);
            $manuale->save();
            $ejes->add($manuale->id);
        }

        }
        foreach ($ejes as $eje) {
            $diagnosticoM = new Ficha_diagnostico_por_eje();
            $diagnosticoM->id_diag =  $eje;
            $diagnosticoM->id_sesion =  $ids;
            $diagnosticoM->save();
        }


     
        return back()->with('success', 'Manual Creado');
    }

    // Método utilizado para actualizar diagnóstico General
    public function editarDiagnosticoG(Request $request, $ids)
    {
        // Guardamos los datos ingresados al diagnostico correspondiente a la sesion respectiva
        $editarDiagnostico = ficha_diagnostico_general::where('id_sesion', $ids)->first();
        $editarDiagnostico->diag_gral = $request->txt_diagnostico_g;
       //guardamos los datos de la fecha de creacion del diagnostico y la fecha actual
        $fecha_c = Carbon::parse($editarDiagnostico->created_at);
        $fecha_u = carbon::now();

        //Restriccion del plazo editable (Despues de 6 meses)
        if ($fecha_u->diffInMonths($fecha_c) >= 6) {
            return back()->with('successem', 'No esta dentro del plazo  para editar!. Por favor contactar con el administrador');
        } else {
           //Devolvemos una alerta segun el resultado
            if ($editarDiagnostico->save()) {
                return back()->with('success', 'Diagnóstico Editado Correctamente!');
            } elseif (!$editarDiagnostico->save()) {
                return back()->with('warning', 'Error al actualizar datos!');
            } else {
                return back();
            }
        }
    }

    
    // Método utilizado para actualizar diagnóstico por Manual
    public function editarDiagnosticoM(Request $request,  $ids)
    {
       //Consultamos todos los datos a la bd de las tablas correspondientes a manual segun la sesion 
        $manualC = Ficha_diagnostico_por_eje::with('ficha_diagnostico_eje', 'ficha_diagnostico_eje.ficha_eje_manual', 'ficha_diagnostico_eje.ficha_eje_manual.ficha_manual')
            ->where('id_sesion', $ids)->get();
        //Recorremos cada eje y ingresamos informacion en los ejes
        foreach ($manualC as $manu) {

            $manualeditar = Ficha_diagnostico_eje::findOrFail($manu->ficha_diagnostico_eje->id);
            $manualeditar->descripcion = $request->input('txt_'.$manu->ficha_diagnostico_eje->id);
         //guardamos los datos de la fecha de creacion del diagnostico y la fecha actual     
        $fecha_c = Carbon::parse($manualeditar->created_at);
        if (carbon::now()->diffInMonths($fecha_c) <= 6) {
            $manualeditar->save();
        }
        }
          //Restriccion del plazo editable (Despues de 6 meses)
        if (carbon::now()->diffInMonths($fecha_c) >= 6) {
            return back()->with('successem', 'No esta dentro del plazo para Editar. Por favor contactar con el administrador');
        } else {
            //Devolvemos una alerta segun el resultado
            if ($manualeditar->save()) {
                return back()->with('successm', 'Manual Editado Correctamente.');
            } elseif (!$manualeditar->save()) {
                return back()->with('successm', 'Manual no editado.');
            } else {
                return back();
            }
        }
    }
    // Método utilizado para egresar paciente
    public function egresarPaciente(Request $request, $idpa, $idpo, $idc, $sr, $nomc , $alta)
    {
        //Solicitamos la informacion del paciente
        $paciente = info_paciente::find($idpa);
        //Solicitamos a la bd todos las sesiones correspondientes al caso
        $sesiones = Ficha_sesion::with('servicio')->where('id_caso', $idc)->get();
        ////Solicitamos a la bd el dato correspondiente al tipo de egreso con el fin de buscar la descripcion del tipo de egreso
        $altad = Ficha_tipo_egreso::find($alta);
        //Solicitamos los datos del caso correspondiente
        $fechaC = Ficha_caso::find($idc);
        $nom = request()->name;
        $tit = request()->piscologo;

       // $buscarProfesional = user::with('Info_Profesional')->where('name', 'LIKE', '%' . $nom . '%')->get();
         $nom = request()->name;

        $profesionales = DB::table('users as u')->select('u.*' , 'ip.*')->join('info_profesional as ip', 'u.id', 'ip.user_id')->where('name', 'LIKE', '%' . $nom . '%')
        ->orwhere('apellido', 'LIKE', '%' . $nom . '%')->orwhere('titulo', 'LIKE', '%' . $nom . '%')
        ->paginate(2);

     
        
        //inner  join
        $id_s = collect([]);
        foreach ($sesiones as $sesion) {
            $id_s->add($sesion->id);
        }
        //Solicitamos a la bd las observaciones de la sesion
        $observaciones = Ficha_observacion::wherein('id_sesion', $id_s)->get();
        //Solicitamos a la bd el diagnostico general correspondiente a la sesion
        $diagnosticoG = Ficha_diagnostico_general::wherein('id_sesion', $id_s)->get();
        ////Solicitamos a la bd concadenando las tablas referentes a manual
        $manualC = Ficha_diagnostico_por_eje::with('ficha_diagnostico_eje', 'ficha_diagnostico_eje.ficha_eje_manual', 'ficha_diagnostico_eje.ficha_eje_manual.ficha_manual')
            ->wherein('id_sesion', $id_s)->get();

       //Definimos fecha actual 
      $date = carbon::now();
      $fechah = $date->format('Y-d-m');

      if($alta == 3){

        return view('ficha.derivarPaciente', compact('paciente', 'sr', 'nomc', 'sesiones', 'observaciones', 'diagnosticoG', 'manualC', 'idc', 'idpo' , 'idpa', 'alta' , 'altad' , 'fechah', 'fechaC' , 'profesionales'));
      }else{
        return view('ficha.egresarPaciente', compact('paciente', 'sr', 'nomc', 'sesiones', 'observaciones', 'diagnosticoG', 'manualC', 'idc', 'idpo' , 'idpa', 'alta' , 'altad' , 'fechah', 'fechaC'));
    }
    }


    // Método utilizado para confirmar egreso
    public function confirmarEgreso( $idpo, $idc , $alta, $idpa)
    {
        //Definimos los datos requeridos para Egresar paciente
        $EgresoPaciente = new Ficha_egreso_caso();
        $EgresoPaciente->fecha_egreso = carbon::now();
        $EgresoPaciente->id_caso = $idc;
        $EgresoPaciente->id_tipo_egreso = $alta;
        $EgresoPaciente->id_profesional  = $idpo;
        //Guardamos todos los datos definidos
        $EgresoPaciente->save();
        //Buscamos el tipo de alta mediante el id
        $altad = Ficha_tipo_egreso::find($alta);
        //Buscamos el caso correspondiente a egresar
        $caso = Ficha_casos_profesional::where('id_caso', $idc)->where('id_profesional',$idpo)->first();
        //Definimos el estado del caso con "cerrado" y descripcion de alta
        $caso->estado = "Cerrado - ".$altad->descripcion;
        //guardamos el caso
        $caso->save();

        return redirect()->route('information', ['idpa' => $idpa ,'idpo' => $idpo]);

    }
    

    public function confirmarDerivacion( $idpo, $idc, $idpa , $idpod)
    {
                //Definimos los datos requeridos para Egresar paciente
        $derivarPaciente = new Ficha_derivacion();
        $derivarPaciente->id_caso = $idc;
        $derivarPaciente->id_prof_referente = $idpo;
        $derivarPaciente->id_prof_derivado  = $idpod;
        $derivarPaciente->aprobado  = false;
        //Guardamos todos los datos definidos
        $derivarPaciente->save();
       
        $caso = Ficha_casos_profesional::where('id_caso', $idc)->where('id_profesional',$idpo)->first();
        //Definimos el estado del caso con "cerrado" y descripcion de alta
        $caso->estado = "En espera - aporbacion del Paciente";
        //guardamos el caso
        $caso->save();



        return redirect()->route('information', ['idpa' => $idpa ,'idpo' => $idpo]);

    }


    public function aceptarDerivacion( $idc)
    {

        //Definimos los datos requeridos para Egresar paciente
        $Tderivar = Ficha_derivacion::where('id_caso', $idc)->orderBy('id' , 'DESC')->first();
        $Tderivar->aprobado = true;
        $Tderivar->save();
        

        $Ncaso = new Ficha_casos_profesional();
        $Ncaso->id_caso = $idc;
        $Ncaso->id_profesional = $Tderivar->id_prof_derivado;
        $Ncaso->fecha = carbon::now();
        $Ncaso->estado = "Activo";
        $Ncaso->save();

        $prof = Info_Profesional::find($Tderivar->id_prof_derivado);

        $caso = Ficha_casos_profesional::where('id_caso', $idc)->where('id_profesional',$Tderivar->id_prof_referente)->first();
        //Definimos el estado del caso con "cerrado" y descripcion de alta
        $caso->estado = "Derivado Al Profesional ".$prof->user->name ." ".$prof->user->apellido  ;
        //guardamos el caso
        $caso->save();


        return back();

    }







    //Consulta de vista 'show.blade' para retornar datos de pacientes
    public function verDiagnostico()
    {

        return view('ficha.show');
    }


    //Consulta de vista 'create.blade' para retornar datos de pacientes
    public function crearDiagnostico($id)
    {
        //$pacientes = \DB::table('users')->select('id','rut','name','apellido','email')->get();
        $paciente = User::find($id);
        $diagnostico = Diagnostico::find($id);
        $manuales = Manual::select()->get();
        //  $manuales = $manuales = Manual::where('id_ficha', $id)->get();

        // $verificarmanual = count($manuales);

        // var_dump($manu); die();

        return view('ficha.create', compact('paciente', 'diagnostico', 'manuales'));
    }



    // Método para almacenar diagnóstico en base de datos
    public function guardarDiagnostico($id)
    {
        $paciente = User::find($id);
        $diagnostico = new Diagnostico;
        $diagnostico->id = $id;
        $diagnostico->descripcion = request()->txt_nuevo_diagnostico;
        $diagnostico->id_ficha = $id;



        // alert
        if ($diagnostico->save()) {
            return view('ficha.create', compact('paciente', 'diagnostico'))->with('successgd', 'Diagnóstico ingresado correctamente.');
        } elseif (!$diagnostico->save()) {
            return view('ficha.create', compact('paciente', 'diagnostico'))->with('successgd', 'Diagnóstico NO ingresado.');
        } else {
            return back();
        }
    }


    // Método utilizado para actualizar diagnóstico
    public function updateDiagnostico(Request $request, $id)
    {
        $diagnosticoUpdate = Diagnostico::findOrFail($id);
        $diagnosticoUpdate->descripcion = $request->txt_editar_diagnostico;

        // alert
        if ($diagnosticoUpdate->save()) {
            return back()->with('success', 'Datos actualizados!');
        } elseif (!$diagnosticoUpdate->save()) {
            return back()->with('warning', 'Error al actualizar datos!');
        } else {
            return back();
        }
    }


    // Método para almacenar manual diagnóstico en base de datos
    public function guardarManual($id)
    {
        $paciente = User::find($id);
        $manual = new Manual;
        $manual->tipo_manual = request()->tipo_oculto;
        $manual->eje1 = request()->txt_evaluacion_eje1;
        $manual->eje2 = request()->txt_evaluacion_eje2;
        $manual->eje3 = request()->txt_evaluacion_eje3;
        $manual->eje4 = request()->txt_evaluacion_eje4;
        $manual->eje5 = request()->txt_evaluacion_eje5;
        $manual->eje5 = request()->txt_evaluacion_eje5;
        $manual->id_ficha = $id;
        $manual->save();
        $manuales = $manuales = Manual::where('id_ficha', $id)->get();

        $verificarmanual = count($manuales);

        return view('ficha.create', compact('paciente', 'verificarmanual'));
    }



    // Método utilizado para actualizar primer manual
    public function updateManual(Request $request, $id)
    {
        $manualUpdate = Manual::findOrFail($id);
        $manualUpdate->eje1 = $request->txt_editar_eje1;
        $manualUpdate->eje2 = $request->txt_editar_eje2;
        $manualUpdate->eje3 = $request->txt_editar_eje3;
        $manualUpdate->eje4 = $request->txt_editar_eje4;
        $manualUpdate->eje5 = $request->txt_editar_eje5;
        // alert
        if ($manualUpdate->save()) {
            return back()->with('successm1', 'Datos actualizados!');
        } elseif (!$manualUpdate->save()) {
            return back()->with('warningm1', 'Error al actualizar datos!');
        } else {
            return back();
        }
    }


    // Método para almacenar comentario en base de datos
    public function guardarComentario($id)
    {
        $paciente = User::find($id);
        $observacion = new Observacion;
        $observacion->observacion = request()->txt_nuevo_comentario;
        $observacion->id_ficha = $id;
        $observacion->save();
        $diagnostico = Diagnostico::find($id);
        $manuales = Manual::where('id_ficha', $id)->get();
        $observaciones = Observacion::where('id_ficha', $id)->get();
        // alert
        if ($observacion->save()) {
            return view('ficha.show', compact('paciente', 'diagnostico', 'observaciones', 'manuales'))->with('successgc', 'Observación guardada.');
        } else {
            return back();
        }
    }

    // Método creado para la función de egresar a un paciente
    public function verSesiones($id, Request $request)
    {
        $paciente = User::find($id);
        $sesiones = Sesion::where('id_ficha', $id)->get();
        $number = $request->get('number');
        $sesiones = Sesion::where('id_ficha', $id)->orderBy('numero_sesion', 'ASC')
            ->number($number)
            ->paginate(4);

        return view('ficha.sesiones', compact('paciente', 'sesiones'));
    }

    // Método para Descargar PDF con los datos del diagnóstico
    public function downloadPdf($id)
    {
        $paciente = User::findOrFail($id);
        $diagnostico = Diagnostico::find($id);
        $pdf = PDF::loadView('ficha.pdf', compact('paciente', 'diagnostico'));
        return $pdf->download('diagnostico.pdf');
    }

    // Método para Descargar la Ficha médica del paciente
    public function downloadFicha($id)
    {
        $paciente = User::findOrFail($id);
        $diagnostico = Diagnostico::find($id);
        $manuales = Manual::where('id_ficha', $id)->get();
        $sesiones = Sesion::where('id_ficha', $id)->get();
        $observaciones = Observacion::where('id_ficha', $id)->get();



        if (@isset($diagnostico)) {


            $pdf = PDF::loadView(
                'ficha.fichaMedica',
                compact('paciente', 'diagnostico', 'manuales', 'sesiones', 'observaciones')
            );

            return $pdf->download('ficha_paciente.pdf');
        } else {

            return view('ficha.information', compact('paciente'))->with('warningfi', 'No tiene diagnostico creado');
        }
    }


    // Método para almacenar una nueva sesión en base de datos
    public function guardarSesion($id)
    {
        $paciente = User::find($id);

        $sesion = new Sesion;
        $sesion->id_ficha = $id;
        $sesion->descripcion = request()->txt_descripcion_sesion;
        $sesion->fecha = request()->txt_fecha_sesion;
        $sesion->numero_sesion = request()->txt_numero_sesion;
        $sesion->periodo = request()->txt_periodo;
        $sesiones = Sesion::where('id_ficha', $id)->get();
        // alert
        if ($sesion->save()) {
            return back()->with('successse', 'Sesión Ingresada Correctamente.');
        } elseif (!$sesion->save()) {
            return view(
                'ficha.sesiones',
                compact('paciente', 'id', 'sesion', 'sesiones')
            )->with('warningse', 'Error al ingresar Sesión.');
        } else {
            return back();
        }
    }


    public function fichaPDF($idpa, $idpo)
    {
        //Solicitamos los datos del paciente por su id 
        $paciente = info_paciente::find($idpa);
        //Solicitamos los datos del caso del paciente
        $ficha = Ficha_caso::where('id_paciente', $idpa)->get();
        //Creamos array que contiene todos los id de los casos
        $caso_id = collect([]);
        foreach ($ficha as $fi) {
            $caso_id->add($fi->id);
        }
        //Definimos fecha nacimiento 
        $fecha_n = Carbon::parse($paciente->fecha_nac);
        //Calculamos la edad
        $edad = carbon::now()->diffInYears($fecha_n);
        //Solicitamos la informacion a la bd del profesional con su respectivo caso 
        $fichacaso = Ficha_casos_profesional::with('ficha_caso')->whereIn('id_caso', $caso_id)->orderBy('fecha', 'DESC')->get();
      
        //Solicitamos datos relacionados al caso 'servicio' 'info_profesional'
        $sesion = Ficha_sesion::with('ficha_caso', 'servicio', 'info_profesional')
            ->whereIn('id_caso', $caso_id)
            ->orderBy('fecha', 'DESC')->get();
            //Definimos un array
        $casouni = collect([]);
            //Si el caso no existe en el array lo agrega
        foreach ($fichacaso as $fi) {
            if (!$casouni->contains($fi))
                $casouni->add($fi);
        }
        $ids = collect([]);
        foreach ($sesion as $s) {
            $ids->add($s->id);
        }
        $observaciones = Ficha_observacion::wherein('id_sesion', $ids)->orderby('id', 'DESC')->get();
      
        $manual = Ficha_eje_manual::with('ficha_manual')->get();
        //Array con todos los manuales
        $manuni = collect([]);
        foreach ($manual as $ma) {
            if (!$manuni->contains($ma->ficha_manual))
                $manuni->add($ma->ficha_manual);
        }

        $diagnosticog = ficha_diagnostico_general::wherein('id_sesion', $ids)->get();

        $manualC = Ficha_diagnostico_por_eje::with('ficha_diagnostico_eje', 'ficha_diagnostico_eje.ficha_eje_manual', 
        'ficha_diagnostico_eje.ficha_eje_manual.ficha_manual')
            ->wherein('id_sesion', $ids)->get();
        //Comprobar si existe el manual

        
        if ($manualC->count() > 0) {
            foreach ($manualC as $ma) {
     
                $manuniC = $ma->ficha_diagnostico_eje->ficha_eje_manual->ficha_manual;
                $fecha = $ma->ficha_diagnostico_eje;
            }
        } else {
            $manuniC = 1;
            $fecha = 1;
        }
        $pdf= PDF::loadView('ficha.fichaPDF', compact('paciente', 'casouni', 'ficha', 'sesion', 'idpo' , 'edad',
        'ficha','manualC','diagnosticog', 'observaciones', 'manuniC' ));
      return $pdf->download('ficha-'.$paciente->nombre."-".$paciente->appat.".pdf");
    }
    








    public function casoPDF($idpa, $idpo,$idficha)
    {
        //Solicitamos los datos del paciente por su id 
        $paciente = info_paciente::find($idpa);
        //Solicitamos los datos del caso del paciente
        $ficha = Ficha_caso::where('id_paciente', $idpa)->get();
        //Creamos array que contiene todos los id de los casos
        $caso_id = collect([]);
        foreach ($ficha as $fi) {
            $caso_id->add($fi->id);
        }
  
        //Definimos fecha nacimiento 
        $fecha_n = Carbon::parse($paciente->fecha_nac);
        //Calculamos la edad
        $edad = carbon::now()->diffInYears($fecha_n);
  
        $casoSeleccionado= Ficha_casos_profesional::with('ficha_caso')->find($idficha);
        $sesionesCaso= Ficha_sesion::with('ficha_caso', 'servicio', 'info_profesional',
        'ficha_diagnostico_general','ficha_diagnostico_por_eje','ficha_observacion')
        ->where('id_caso', $casoSeleccionado->ficha_caso->id)
        ->orderBy('fecha', 'DESC')->get();
        //Diagnosticos de las sesiones
        $casosDiagnosticos = collect([]);
        foreach ($sesionesCaso as $se) {
            $casosDiagnosticos->add($se->id);
        }
          $id_s = collect([]);
          foreach ($sesionesCaso as $sesion) {
              $id_s->add($sesion->id);
          }
          //Solicitamos a la bd las observaciones de la sesion
          $observaciones = Ficha_observacion::wherein('id_sesion', $id_s)->get();
          //Solicitamos a la bd el diagnostico general correspondiente a la sesion
          $diagnosticoG = Ficha_diagnostico_general::wherein('id_sesion', $id_s)->get();
          ////Solicitamos a la bd concadenando las tablas referentes a manual
          //
          $manual = Ficha_eje_manual::with('ficha_manual')->get();
          $manuni = collect([]);
           foreach ($manual as $ma) {
               if (!$manuni->contains($ma->ficha_manual))
                   $manuni->add($ma->ficha_manual);
           }
   
           $diagnosticog = ficha_diagnostico_general::where('id_sesion', $id_s)->first();
           $manualC = Ficha_diagnostico_por_eje::with('ficha_diagnostico_eje',
            'ficha_diagnostico_eje.ficha_eje_manual', 
           'ficha_diagnostico_eje.ficha_eje_manual.ficha_manual')
               ->where('id_sesion', $id_s)->get();
           //Comprobar si existe el manual
           if ($manualC->count() > 0) {
               foreach ($manualC as $ma) {
        
                   $manuniC = $ma->ficha_diagnostico_eje->ficha_eje_manual->ficha_manual;
                   $fecha = $ma->ficha_diagnostico_eje;
               }
           } else {
               $manuniC = 1;
               $fecha = 1;
           }
          
         $manualB = Ficha_diagnostico_por_eje::with('ficha_diagnostico_eje', 'ficha_diagnostico_eje.ficha_eje_manual'
         , 'ficha_diagnostico_eje.ficha_eje_manual.ficha_manual')
              ->wherein('id_sesion', $id_s)->get();
        //Sesiones
        
          $pdf= PDF::loadView('ficha.casoPDF', compact('paciente','ficha','idpo' ,'edad','idpa','casoSeleccionado',
          'sesionesCaso','observaciones','diagnosticoG','manualB','manuniC'));
          return $pdf->download('Caso-'.$paciente->nombre."-".$paciente->appat.".pdf");
    }
    public function certificadoDiagnostico($ids)
    {
      //Consultamos todos los datos a la bd de las tablas correspondientes a manual segun la sesion 
    $manualC = Ficha_diagnostico_por_eje::with('ficha_diagnostico_eje', 'ficha_diagnostico_eje.ficha_eje_manual', 'ficha_diagnostico_eje.ficha_eje_manual.ficha_manual')
       ->where('id_sesion', $ids)->get();
     //   $diagnosticoG = ficha_diagnostico_general::where('id_sesion', $ids)->first();
     $sesion= Ficha_sesion::with('ficha_caso')->find($ids);
     $idpaciente = $sesion->ficha_caso->id_paciente;
     $paciente= info_paciente::find($idpaciente);

     $ultimaSesion= Ficha_sesion::where('id_caso', $sesion->id_caso)->orderBy('fecha', 'ASC')->first();
    

     $fecha_n = Carbon::parse($paciente->fecha_nac);
     $edad = carbon::now()->diffInYears($fecha_n);
     $diagnosticoG = ficha_diagnostico_general::where('id_sesion', $ids)->first();

     $idprofesional= $sesion->id_profesional;
     $profesional= Info_Profesional::with('user')->find($idprofesional);
     
 
     $fechaModificadaF= Carbon::parse($ultimaSesion->fecha)->isoFormat('dddd D MMMM');
     $hoy= Carbon::now()->isoFormat('dddd D MMMM YYYY');
   
     $comentarios=  request()->txt_area_cometarios;
     if ($manualC->count() > 0) {
        foreach ($manualC as $ma) {
 
            $manuniC = $ma->ficha_diagnostico_eje->ficha_eje_manual->ficha_manual;
            $fecha = $ma->ficha_diagnostico_eje;
        }
    } else {
        $manuniC = 1;
        $fecha = 1;
    }
 

     $pdf= PDF::loadView('ficha.certificadoDiagnostico',compact('ids','manualC','paciente','edad','profesional','fechaModificadaF','hoy','comentarios','manuniC','diagnosticoG'));

       // return view("ficha.certificadoDiagnostico");
       return $pdf->stream('certificadoDiagnostico.pdf');
    }
    public function certificadoAsistencia($ids)
    {

     //   $diagnosticoG = ficha_diagnostico_general::where('id_sesion', $ids)->first();
     $sesion= Ficha_sesion::with('ficha_caso')->find($ids);
     $idpaciente = $sesion->ficha_caso->id_paciente;
     $paciente= info_paciente::find($idpaciente);

     $ultimaSesion= Ficha_sesion::where('id_caso', $sesion->id_caso)->orderBy('fecha', 'ASC')->first();
    $numeroDeSesiones = Ficha_sesion::where('id_caso', $sesion->id_caso)->count();
     $fecha_n = Carbon::parse($paciente->fecha_nac);
     $edad = carbon::now()->diffInYears($fecha_n);
    
     $sesionesCaso= Ficha_sesion::where('id_caso', $sesion->id_caso)->orderBy('fecha', 'ASC')->get();
    

     $idprofesional= $sesion->id_profesional;
     $profesional= Info_Profesional::with('user')->find($idprofesional);
     
 
     $fechaModificadaF= Carbon::parse($ultimaSesion->fecha)->isoFormat('dddd D MMMM');
     $hoy= Carbon::now()->isoFormat('dddd D MMMM YYYY');
   
     $comentarios=  request()->txt_area_cometarios;
 

     $pdf= PDF::loadView('ficha.certificadoAsistencia',compact('ids','paciente','edad','profesional','fechaModificadaF','hoy','comentarios','numeroDeSesiones','sesionesCaso'));

       // return view("ficha.certificadoDiagnostico");
       return $pdf->stream('certificadoAsistencia.pdf');
    }

    
    public function vistaPreviaCpiscologico($ids)
    {
   //Consultamos todos los datos a la bd de las tablas correspondientes a manual segun la sesion 
   $manualC = Ficha_diagnostico_por_eje::with('ficha_diagnostico_eje', 'ficha_diagnostico_eje.ficha_eje_manual', 'ficha_diagnostico_eje.ficha_eje_manual.ficha_manual')
   ->where('id_sesion', $ids)->get();
    //   $diagnosticoG = ficha_diagnostico_general::where('id_sesion', $ids)->first();
    $sesion= Ficha_sesion::with('ficha_caso')->find($ids);
    $idpaciente = $sesion->ficha_caso->id_paciente;
    $paciente= info_paciente::find($idpaciente);

    $ultimaSesion= Ficha_sesion::where('id_caso', $sesion->id_caso)->orderBy('fecha', 'ASC')->first();

    $fecha_n = Carbon::parse($paciente->fecha_nac);
    $edad = carbon::now()->diffInYears($fecha_n);
    $diagnosticoG = ficha_diagnostico_general::where('id_sesion', $ids)->first();

    $idprofesional= $sesion->id_profesional;
    $profesional= Info_Profesional::with('user')->find($idprofesional);

        if ($manualC->count() > 0) {
            foreach ($manualC as $ma) {
     
                $manuniC = $ma->ficha_diagnostico_eje->ficha_eje_manual->ficha_manual;
                $fecha = $ma->ficha_diagnostico_eje;
            }
        } else {
            $manuniC = 1;
            $fecha = 1;
        }
    

    $fechaModificadaF= Carbon::parse($ultimaSesion->fecha)->isoFormat('dddd D MMMM');
    $hoy= Carbon::now()->isoFormat('dddd D MMMM YYYY');
      
        return view('ficha.vistaPreviaCpiscologico',compact('ids','manualC','paciente','edad','profesional','fechaModificadaF','hoy','manuniC','diagnosticoG'));
    }

    public function vistaPreviaCasistencia($ids)
    {
    $sesion= Ficha_sesion::with('ficha_caso')->find($ids);
    $idpaciente = $sesion->ficha_caso->id_paciente;
    $paciente= info_paciente::find($idpaciente);

    $ultimaSesion= Ficha_sesion::where('id_caso', $sesion->id_caso)->orderBy('fecha', 'ASC')->first();
    $numeroDeSesiones = Ficha_sesion::where('id_caso', $sesion->id_caso)->count();

    $sesionesCaso= Ficha_sesion::where('id_caso', $sesion->id_caso)->orderBy('fecha', 'ASC')->get();

    $fecha_n = Carbon::parse($paciente->fecha_nac);
    $edad = carbon::now()->diffInYears($fecha_n);


    $idprofesional= $sesion->id_profesional;
    $profesional= Info_Profesional::with('user')->find($idprofesional);


    $fechaModificadaF= Carbon::parse($ultimaSesion->fecha)->isoFormat('dddd D MMMM');
    $hoy= Carbon::now()->isoFormat('dddd D MMMM YYYY');
      
        return view('ficha.vistaPreviaCasistencia',compact('ids','paciente','edad','profesional','fechaModificadaF','hoy','numeroDeSesiones','sesionesCaso'));
    }

}
