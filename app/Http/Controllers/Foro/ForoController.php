<?php

namespace App\Http\Controllers\Foro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //referencia a la clase maestra controller, necesaria, porque ya no esta en la misma carpeta

use App\Modelos\Foro\Post;
use App\Comentario;
use App\Modelos\Foro\Categoria;
use App\User;
use App\Modelos\Foro\Like;
use Auth;

class ForoController extends Controller
{
    public function index()//lista todas las categorias
    {
        $categorias = Categoria::where('estado', 1)->get();

        return view('foro.index', compact('categorias'));
    }
}
