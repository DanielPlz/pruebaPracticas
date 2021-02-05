<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;
use App\Paciente;
use App\Persona;
use App\UsuarioRol;
use Illuminate\Support\Facades\Hash;


class SocialLoginController extends Controller
{

    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider) {
        $getInfo = Socialite::driver($provider)->user();
        $user = User::where('provider_id', $getInfo['id'])->first();
       
        if($provider == 'google'){

        if (!$user) {
                //'avatar' => $getInfo['picture'],
                $user = new User();
                $paciente = new Paciente();
                $persona = new Persona();
                $usuario_rol = new UsuarioRol();

                $user->email=$getInfo['email'];
                //$user->password=('');
                $user->provider=$provider;
                $user->provider_id=$getInfo['id'];
                $user->save();
                $user->id; // Recuperamos el ID tras el insert.

                $paciente->id_user = $user->id; //relacionamos el id de usuario a paciente desde la tabla user.
                $persona->rut='';
                $persona->nombre=$getInfo['given_name'];
                $persona->apellido_paterno=$getInfo['family_name'];
                $persona->save();

                $paciente->id_persona = $persona->id_persona;
                $paciente->save();

                $usuario_rol->id_user = $user->id;
                $usuario_rol->id_roles = 1;
                $usuario_rol->save();
        }
        

        }
        else{

            //var_dump($getInfo->user);

            if (!$user) {
                //'avatar' => $getInfo['picture'],
                $arrayUsuarioFB = $getInfo->user;

                $user = new User();
                $paciente = new Paciente();
                $persona = new Persona();
                $usuario_rol = new UsuarioRol();

                $user->email=$arrayUsuarioFB['email'];
                //$user->password=('');
                $user->provider=$provider;
                $user->provider_id=$arrayUsuarioFB['id'];
                $user->save();
                $user->id; // Recuperamos el ID tras el insert.

                $paciente->id_user = $user->id; //relacionamos el id de usuario a paciente desde la tabla user.
                $persona->rut='';

                $name=$arrayUsuarioFB['name'];
                $separador = explode(" ", $name);

                $persona->nombre=$separador[0];
                $persona->apellido_paterno=$separador[1];
                $persona->save();

                $paciente->id_persona = $persona->id_persona;
                $paciente->save();

                $usuario_rol->id_user = $user->id;
                $usuario_rol->id_roles = 1;
                $usuario_rol->save();
               /*
                var_dump($name);
               var_dump($user);
               var_dump($paciente);
               var_dump($persona);
               */
        }
        }

        auth()->login($user);
        return redirect()->to('/');  

    }
    
    

}
