<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Testimonio;

class ProfileController extends Controller
{
    /**
     * Obtiene la vista del perfil publico del profesional de la salud.
     *
     * @param  int  $id
     * @return view
     */
    public function getProfile($id){
        $user = User::find($id);
        $testimonios = Testimonio::where('profesional_id', '=', $id)->orderBy('created_at', 'desc')->paginate(3);
        return view('perfil.profile', compact('user', 'testimonios'));
    }
}
