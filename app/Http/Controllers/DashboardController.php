<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Psicologo;
use App\UsuarioRol;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {

        $rol = UsuarioRol::select('id_roles')->where('id_user', auth()->user()->id)->first();
        $rol = $rol->id_roles;

        switch ($rol) {
            case 1:
                $user = Paciente::datosPersonales(auth()->user()->id);
                // $user = Paciente::
                // select(
                //     'persona.nombre',
                //     'persona.apellido_paterno',
                //     'persona.apellido_materno')
                //     ->join('users', function ($join) {
                //         $join->on('users.id', '=', 'paciente.id_user');
                //     })
                //     ->join('persona', function ($join) {
                //         $join->on('paciente.id_persona', '=', 'persona.id_persona');
                //     })
                //     ->where('id_user', auth()->user()->id)
                //     ->first();
                /* AQUI HAY QUE MOVER EL SESSION PARA SER ASIGNADO TRAS INICIO SESIÓN*/
                // dd($user);
                session()->put(['user' => $user, 'rol' => $rol]);
                return view('dashboard.profile', ['user' => $user, 'rol' => $rol]);
                break;
            case 2:
                $user = Psicologo::select(
                    'persona.nombre',
                    'persona.apellido_paterno',
                    'persona.apellido_materno'
                )
                    ->join('users', function ($join) {
                        $join->on('users.id', '=', 'psicologo.id_user');
                    })
                    ->join('persona', function ($join) {
                        $join->on('psicologo.id_persona', '=', 'persona.id_persona');
                    })
                    ->where('id_user', auth()->user()->id)
                    ->first();
                /* AQUI HAY QUE MOVER EL SESSION PARA SER ASIGNADO TRAS INICIO SESIÓN*/
                session()->put(['user' => $user, 'rol' => $rol]);
                return view('dashboard.profile', ['user' => $user, 'rol' => $rol]);
                break;
        }
        return view('layouts.dashboard');
    }


    public function getProfile($id)
    {
        $rol = UsuarioRol::select('id_roles')->where('id_user', auth()->user()->id)->first();
        $rol = $rol->id_roles;

        switch ($rol) {
            case 1:
                $user = Paciente::select(
                    'persona.nombre',
                    'persona.apellido_paterno',
                    'persona.apellido_materno',
                    'persona.telefono'
                )
                    ->join('users', function ($join) {
                        $join->on('users.id', '=', 'paciente.id_user');
                    })
                    ->join('persona', function ($join) {
                        $join->on('paciente.id_persona', '=', 'persona.id_persona');
                    })
                    ->where('id_user', auth()->user()->id)
                    ->first();
                    session()->put(['user' => $user, 'rol' => $rol]);

                return view('dashboard.profile', ['user' => $user, 'rol' => $rol]);
                break;
            case 2:
                $user = Psicologo::select(
                    'persona.nombre',
                    'persona.apellido_paterno',
                    'persona.apellido_materno',
                    'persona.telefono',
                    'psicologo.descripcion'
                )
                    ->join('users', function ($join) {
                        $join->on('users.id', '=', 'psicologo.id_user');
                    })
                    ->join('persona', function ($join) {
                        $join->on('psicologo.id_persona', '=', 'persona.id_persona');
                    })
                    ->where('id_user', auth()->user()->id)
                    ->first();
                    session()->put(['user' => $user, 'rol' => $rol]);

                return view('dashboard.profile', ['user' => $user, 'rol' => $rol]);
                break;
        }
    }

    public function back()
    {
        return back();
    }

    public function update(Request $request)
    {
        user::where('id', auth()->user()->id)
            ->update([
                'name' => $request->input('name'),
                'apellido' => $request->input('apellido'),
                'direccion' => $request->input('direccion'),
                'comuna' => $request->input('comuna'),
                'telefono' => "569" . $request->input('telefono'),
                'nickname' => $request->input('nickname'),
                'email' => $request->input('correo'),
                //'region' => $request->input('region')
            ]);
        return back();
    }


    public function postProfileImage(Request $request)
    {
        $user = auth::user();
        $extension = $request->file('file')->getClientOriginalExtension();
        $file_name = $user->id . '.' . $extension;

        $path = public_path('assets/img/user/' . $file_name);

        Image::make($request->file('file'))
            ->fit(144, 144)
            ->save($path);

        $user->avatar = $request->root() . "/assets/img/user/" . $file_name;
        //$user->save();

        $data['success'] = true;
        $data['file_name'] = $request->root() . "/assets/img/user/" . $file_name;
        return $data;
    }


    public function updatePassword(Request $request)
    {
        $user = User::where('id', auth()->user()->id)
            ->get();
        $clave = $request->actualContraseña;

        if (Hash::check($clave, $user[0]->password)) {
            $data['success'] = true;
            User::where('id', auth()->user()->id)
                ->update([
                    'password' => Hash::make($request->contraseña)
                ]);
        } else {
            $data['success'] = false;
        }
        return $data;
    }
}
