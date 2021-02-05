<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    protected function index_login(){
        $ruta_nombre =Route::currentRouteName();
        $tipo;        
        if ($ruta_nombre == "login_paciente" ){
            $tipo=1;

        }elseif($ruta_nombre == "login_psicologo"){
            $tipo=2;            
        }

        if(isset($tipo)){
            return view ('Auth/login')->with('tipo',$tipo);
        }else{
            return view ('/');
        }      
    }

    protected function logear(Request $request,$tipo){
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            // Authentication passed...
            $user=User::select(
                'users.id'
            )
                ->join('usuario_rol', function ($join) {
                    $join->on('users.id', '=', 'usuario_rol.id_user');
                })
                ->where('users.email',$request['email'])
                ->where('usuario_rol.id_roles',$tipo)
                ->first();
            if(count($user)==0){
                Auth::logout();
                $status = 'No tienes acceso para ingresar al sitio.';
                return back()->with(compact('status'));
            }else{
                Auth::login($user);
                return redirect()->to('/');
            }
        }else{
            $status = 'Credenciales incorrectas.';
            return back()->with(compact('status'));
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
}
