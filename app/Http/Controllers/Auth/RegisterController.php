<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Auth\PacienteController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\API;
use App\Paciente;
use App\Psicologo;
use App\Persona;
use App\UsuarioRol;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Metodo para devolver la vista de seleccion de tipo de registro
     */
    protected function viewRegistroRol(){
        return view('Auth.rol_register');
    }

    /**
     * Metodo para devolver la vista de confirmacion de registro psicologo
     */
    protected function viewRegistroConfirmacion(){
        return view('Auth.register_confirmacion');
    }

    /**
     * Get a validator for an incoming registration request.
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        //Reglas de validacion
        $rules =[
            'rut' => ['required', 'string', 'max:10','unique:persona'],
            'nombres' => ['required', 'string', 'max:45'],
            'apellido_pa' => ['required', 'string', 'max:45'],
            'apellido_ma' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:191'],
            'contraseña' => ['required', 'string', 'max:191','min:8'],
            'contraseña_conf' => ['required','string', 'max:191','min:8','same:contraseña'],
        ];

        //Mensajes personalizados segun validacion
        $customMessages = [
            'unique' => 'El :attribute ya se encuentra registrado',
            'required' => 'El :attribute es obligatorio.',
            'same' => 'Las contraseñas no coinciden',
            'max' => 'Demasiados caracteres',
            'min' => 'La contraseña debe contener minimo 8 caracteres'
        ];

        return $request->validate($rules,$customMessages);
    }

    /**
     * Metodo para utilizar con ajax para verificar rut
     */
    protected function verificarRut(Request $request){
        $this->validate($request, [
            'rut' => ['unique:persona'],
        ]);
    }

    /**
     * Metodo para registrar un usuario
     */
    protected function createUser(Request $data,int $tipo){
        $this->validator($data);    //Validacion de datos
        $user=$this->verificarUsuario('email',$data['email']); //Verifiacion de usuario unico segun email
        if(count($user)==0){
            if($data['contraseña']==$data['contraseña_conf']){
                try{
                    $this->createPersona($data);
                    $persona=Persona::latest()->first();
                    $user = new User();
                    $user->email=$data['email'];
                    $user->password=Hash::make($data['contraseña']);
                    $user->save();
                    if($tipo==1){
                        $this->createPaciente($user->id,$persona['id_persona']);
                        $this->asignarUsuarioRol($user->id,1);
                        auth()->login($user);
                        return redirect()->to('/');
                    }else{
                        $this->createPsicologo($user->id,$persona['id_persona']);
                        $this->asignarUsuarioRol($user->id,2);
                        return view('Auth.register_confirmacion');
                    }
                }catch(Exception $e){
                    $email = $data['email'];
                    return redirect('/login')->with('email',$email);

                }
            }else{
                $status = 'Las contraseñas no coinciden.';
                return back()->with(compact('status'));
            }
        }else{
            $email = $data['email'];
            return redirect('/login')->with('email',$email);
        }
    }

    /**
     * Metodo para registrar una persona
     */
    private function createPersona($data){
        $persona = new Persona();
        $persona->rut=$data['rut'];
        $persona->nombre=$data['nombres'];
        $persona->apellido_paterno=$data['apellido_pa'];
        $persona->apellido_materno=$data['apellido_ma'];
        $persona->telefono='';
        $persona->direccion='';
        $persona->comuna='';
        $persona->region='';
        $persona->save();
        return $persona;
    }

    /**
     * Metodo para registrar un paciente
     */
    private function createPaciente($id_user,$id_persona){
        $paciente = new Paciente();
        $paciente->id_user= $id_user;
        $paciente->id_persona=$id_persona;
        $paciente->escolaridad='';
        $paciente->ocupacion='';
        $paciente->estado_civil='';
        $paciente->estado_clinico='';
        $paciente->tipo_alta='';
        $paciente->tipo_paciente='Titular';
        $paciente->grupo_familiar='';
        $paciente->save();
    }

    /**
     * Metodo para registrar un psicologo
     */

    private function createPsicologo($id_user,$id_persona){
        Psicologo::create([
            'id_user' => $id_user,
            'id_persona' => $id_persona,
            'titulo' => '',
            'especialidad' => '',
            'descripcion' => '',
            'casa_academica' => '',
            'verificacion' => 'EN ESPERA',
            'grado_academico' => '',
            'fecha_egreso' => '2021-01-19 18:58:25',
            'experiencia' => 0,
            'imagen_titulo' => '',
        ]);
    }

    private function asignarUsuarioRol($id_user,$tipo){
        UsuarioRol::create([
            'id_user' => $id_user,
            'id_roles' =>$tipo
        ]);
    }

    /**
     * Metodo para verificar que el usuario no existe
     */
    private function verificarUsuario($campo,$dato){
        $user = User::where($campo,$dato)->get();
        return $user;
    }
}
