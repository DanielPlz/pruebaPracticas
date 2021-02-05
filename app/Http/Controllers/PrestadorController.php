<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\API;
use App\User;
use App\InfoProfesional;

class PrestadorController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Get work for us form.
     *
     * @return view
     */
    protected function index() {
        if(auth()->user())
        {
            return view('prestador.register');
        }

        return view('prestador.work');          
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return $validator = $request->validate([
            'rut' => ['max:10', 'unique:users'],
            'telefono' => ['max:8'],
            'direccion' => ['string', 'max:255'],
            'comuna' => ['string', 'max:255'],
        ]);
    }

    public function updateProfesionalData(Request $request) {
        $profesional = auth()->user();
        $profesional->telefono = "569".$request->input('telefono');
        $profesional->direccion = $request->input('direccion');
        $profesional->comuna = $request->input('comuna');
        $profesional->rut = $request->input('rut');
        $profesional->tipo = 'Profesional';
        $profesional->save();
    }

    public function saveProfesionalData(array $data, Request $request) {
        InfoProfesional::create([
            'titulo' => $data['titulo'],
            'fecha_egreso' => $data['egreso'],
            'fecha_nacimiento' => $data['nacimiento'],
            'institucion' => $data['institucion'],
            'modalidad_atencion' => $request->input('atencion'),
            'descripcion' => $request->input('descripcion'),
            'edad' => $request->input('edad'),
            'experiencia' => $request->input('experiencia'),
            'user_id' => auth()->user()->id,
        ]);
    }

    public function saveDataIfApiFails(Reequest $request){
        // if($request->hasFile('imagen')){
        //     $file = $request->file('imagen');
        //     $file_name = time().$file->getClientOriginalName();
        //     $file->move(public_path().'/uploads/images/', $file_name);

        //     InfoProfesional::create([
        //         'titulo' => $request->input('titulo'),
        //         'user_id' => auth()->user()->id,
        //         'modalidad_atencion' => $request->input('atencion'),
        //         'fecha_egreso' => $request->input('egreso'),
        //         'imagen_titulo' => $file_name
        //     ]);
        // }
    }


    public function getProfesionalList(){
        $profesionales = User::where('tipo', 'Profesional')->get();
        return view('prestador.list', compact('profesionales'));
        
    }

    /**
     * Consumir datos de una API externa (https://apis.superdesalud.gob.cl/api/prestadores/rut) en base 
     * al rut del prestador de salud indicado.
     *
     * @param string $rut
     * @return array $data
     */
    protected function consume_api($rut) {
        $api = new API();
        $rut_sin_digito = substr($rut, 0, strlen($rut)-1);
        $data = $api->get_api_data($rut_sin_digito);
        return $data;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {   
        $this->validator($request);
        $this->updateProfesionalData($request);
        $data = $this->consume_api($request->get('rut'));
        if($data){
            $this->saveProfesionalData($data, $request);
            return view('prestador.select-price');          
        }
    }

    public function registeruser()
    {
        if(auth()->user()){
            return view('layouts.dashboard');
        }else{
            return view('auth.register');
        }
    }

    public function registeruserpsi()
    {
        if(auth()->user()){
            $redirectTo = '/work';
        }else{
            return view('prestador.registerpsi');
        }
    }

    public function filtroProf(Request $req){
        $profesionales = User::select('users.id', 'users.name', 'users.apellido', 'info_profesional.titulo')
            ->from('users', 'info_profesional')
            ->join('info_profesional', function ($join) {
                $join->on('info_profesional.user_id', '=', 'users.id');
            })
            ->where('users.name', '=', $req->input('datoFiltro'))
            ->orWhere('users.apellido', '=', $req->input('datoFiltro'))
            ->orWhere('info_profesional.titulo', '=', $req->input('datoFiltro'))
            ->get();

        return view('prestador.list', compact('profesionales'));
    }

    protected function viewRegistroPsicologo(){
        return view('auth.register_psicologo');
    }

}
