<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\PrecioServicio;
use Session;
use App\User;
use App\ModalidadServicio;
use App\IsapreServicio;

class ServicioController extends Controller
{
    public function index()
    {
        
    }


    public function servicioall(Request $request){
        $id = $request->input('id');
        $servicios = Servicio::
                    select('id','nombre','descripcion','duracion','user_id')
                    ->where('user_id','=',$id)
                    ->get();
        return View('servicios.serviciosall')->with('servicios',$servicios);

    }

    public function agregarServicio(Request $request){
        // Crea objeto de servicio
        $servicio = new Servicio(); 

        //Asignar datos de los input al objeto
        $servicio->nombre = $request->input('nombre');
        $servicio->descripcion = $request->get('descripcion');
        $servicio->duracion = $request->get('duracion');
        $servicio->user_id = $request->input('user_id');

        //Guardar el servicio en la bd
        $servicio->save();
    }

    public function agregarModalidad(Request $request,$servicio_id){
        //Crear objeto de la modalidad
        $modalidad_servicio = new ModalidadServicio();

        //Asignar datos de los input al objeto
        $modalidad_servicio->presencial = $request->input('presencial');
        $modalidad_servicio->online = $request->input('online');
        $modalidad_servicio->visita = $request->input('visita');
        $modalidad_servicio->servicio_id = $servicio_id;

        //Guardar la modalidad en la bd
        $modalidad_servicio->save();
    }

    public function agregarPrecio(Request $request,$servicio_id){
        //Crear objeto de precios segun previsión
        $precioServicio = new PrecioServicio();

        //Asignar datos de los input al objeto
        $precioServicio->precioFonasa = $request->input('precioFonasa');
        $precioServicio->precioIsapre = $request->input('precioIsapre');
        $precioServicio->precioParticular = $request->input('precioParticular');
        $precioServicio->servicio_id = $servicio_id;

        //Guardar los precios en la bd
        $precioServicio->save();
    }

    public function agregarIsapre(Request $request,$servicio_id){
        //Crear objeto de las isapres
        $isapre = new IsapreServicio();

        //Asignar datos de las isapres disponibles (checkbox)

        $isapre->banmedica = $request->input('banmedica');
        $isapre->consalud = $request->input('consalud');
        $isapre->colmena = $request->input('colmena');
        $isapre->cruzBlanca = $request->input('cruzBlanca');
        $isapre->masVida = $request->input('masVida');
        $isapre->vidaTres = $request->input('vidaTres');
        $isapre->servicio_id = $servicio_id;

        //Guardar los precios en la bd
        $isapre->save(); 
    }

    public function store(Request $request)
    {
        // se verifica el ajax
        if ($request->ajax()) {

            $this->agregarServicio($request);
            $data = Servicio::latest('id')->first();
            $this->agregarModalidad($request,$data->id);
            $this->agregarPrecio($request,$data->id);
            $this->agregarIsapre($request,$data->id);

            // retorno de datos via json
            if ($data){
                Session::flash('save','Se ha creado correctamente');
                return response()->json(['success'=>'true']);
            } 
            else
            {
              return response()->json(['success'=>'false']);  
            }

        }
        // fin ajax
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Servicio::where('id', $request->input('servicio_id'))
                ->update(['nombre' => $request->input('nombreEd'),
                         'descripcion'=>$request->get('descripcionEd'),
                         'duracion'=>$request->input('duracionEd')]
                        );
        ModalidadServicio::where('servicio_id', $request->input('servicio_id'))
                ->update(['presencial' => $request->input('presencialEd'),
                            'online'=>$request->input('onlineEd'),
                            'visita'=>$request->input('visitaEd')]
                        );
        PrecioServicio::where('servicio_id', $request->input('servicio_id'))
                ->update(['precioFonasa' => $request->input('precioFonasaEd'),
                            'precioIsapre'=>$request->input('precioIsapreEd'),
                            'precioParticular'=>$request->input('precioParticularEd')]
                        );
        IsapreServicio::where('servicio_id', $request->input('servicio_id'))
                ->update(['banmedica' => $request->input('banmedicaEd'),
                            'consalud'=>$request->input('consaludEd'),
                            'colmena'=>$request->input('colmenaEd'),
                            'cruzblanca'=>$request->input('cruzBlancaEd'),
                            'masvida'=>$request->input('masVidaEd'),
                            'vidatres'=>$request->input('vidaTresEd')]
                        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarServicio(Request $request)
    {
        $Servicio_id = $request->input('servicio_id');
        $Servicio = Servicio::find($Servicio_id);
        $Servicio->delete();
        return redirect()->back();
    }

    public function destroy($id)
    {   
        $Servicio = Servicio::find($id);
        $result = $Servicio->delete();

        $ModalidadServicio = ModalidadServicio::where('servicio_id', $id)->first();
        $result2 = $ModalidadServicio->delete();

        $PrecioServicio = PrecioServicio::where('servicio_id', $id)->first();
        $result3 = $PrecioServicio->delete();

        $IsapreServicio = IsapreServicio::where('servicio_id', $id)->first();
        $result4 = $IsapreServicio->delete();

        if ($result && $result2 && $result3 && $result4){
            Session::flash('save','Se ha creado correctamente');
            return response()->json(['success'=>'true']);
        } 
        else
        {
          return response()->json(['success'=>'false']);  
        }
    }

    public function datosModi(Request $request){
        $id = $request->id;
        $datos = Servicio::
        select('nombre','descripcion','duracion')
                ->where('id','=',$id)
                ->get();
        $datosModalidad = ModalidadServicio::
        select('presencial','online','visita')
                ->where('servicio_id','=',$id)
                ->get();
        $datosPrecio = PrecioServicio::
        select('precioFonasa','precioIsapre','precioParticular')
                ->where('servicio_id','=',$id)
                ->get();
        $datosIsapre = IsapreServicio::
        select('banmedica','consalud','colmena','cruzblanca','masvida','vidatres')
                ->where('servicio_id','=',$id)
                ->get();
        $array["aa"] = [$datos[0]->nombre,$datos[0]->descripcion,$datos[0]->duracion,
                        $datosModalidad[0]->presencial,$datosModalidad[0]->online,$datosModalidad[0]->visita,
                        $datosPrecio[0]->precioFonasa,$datosPrecio[0]->precioIsapre,$datosPrecio[0]->precioParticular,
                        $datosIsapre[0]->banmedica,$datosIsapre[0]->consalud,$datosIsapre[0]->colmena,
                        $datosIsapre[0]->cruzblanca,$datosIsapre[0]->masvida,$datosIsapre[0]->vidatres];
        return json_encode($array);
    }

    public function datosServicio(Request $request){
        $id = $request->id;
        $servicios = Servicio::
            select('descripcion','duracion')
            ->where('id','=',$id)
            ->get();
        $array["datosS"] = [$servicios[0]->descripcion,$servicios[0]->duracion];
        return json_encode($array);
    }
}   
