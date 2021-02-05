<?php
namespace App\Http\Controllers\Foro; //namespace correspondiente a la carpeta en la que se encuentra

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //referencia a la clase maestra controller, necesaria, porque ya no esta en la misma carpeta
use Illuminate\Support\Facades\Auth;

use App\Modelos\Foro\Post;
use App\Modelos\Foro\Categoria;
use DB;
use URL;

class CategoriaController extends Controller
{
    public function index($id)
    {
        $categoria=Categoria::findOrFail($id);
        
        return view('foro.categoria.index', compact('categoria'));
    }

    public function catPosts($id, $page_id = 1)
    {
        $posts = Post::where('categoria_id', $id)->where("estado", 1)->orderBy('created_at', 'desc')->paginate(5, ['*'], 'page', $page_id);
        
        return view('foro.categoria.postList', compact('posts'));
    }

    public function catList()
    {
        $categorias = Categoria::where('estado', 1)->get();
    
        return view('foro.categoria.catList')->with('categorias', $categorias);
    }

    public function delete(Request $request)
    {   
        //TODO: arreglar validacion de rol/privilegio
        if (!(Auth::user()->tipo == "Administrador"))
            return response()->json(['success'=>'trucho']);
    
        $cat = Categoria::findOrFail($request->get('catDeleteId'));

        $cat->estado = 0;
        $cat->save();

        return response()->json(['success'=>'true']);
    }

    public function add(Request $request)
    {
        //TODO: arreglar validacion de rol/privilegio
        if (!(Auth::user()->tipo == "Administrador"))
            return response()->json(['success'=>'trucho']);
        
        //validacion de entrada
        request()->validate([
            'titulo' => 'required|min:3',
            'descripcion' => 'required|min:2'
        ]);

        Categoria::Create([
            'titulo'=>$request->get('titulo'),
            'descripcion'=>$request->get('descripcion'),
            'estado'=>1
        ]);

        return response()->json(['success'=>'true']);
    }

    public function details(Request $request)
    {
        $cat = Categoria::findOrFail($request->input('catId'));
        
        if ($cat->estado == 0)
            return response()->json(['customError' => 'La categoria ya no existe'], 410);

        return $cat;
    }

    public function edit(Request $request)
    {
        //TODO: arreglar validacion de rol/privilegio
        if (!(Auth::user()->tipo == "Administrador"))
            return response()->json(['success'=>'trucho']);

        //validacion input 
        request()->validate([
            'titulo' => 'required|min:3',
            'descripcion' => 'required|min:3'
        ]);

        $cat = Categoria::findOrFail($request->input('catEditId'));

        //check modificacion concurrente
        if ($cat->estado == 0)
            return response()->json(['customError' => 'La categoria ya no existe'], 410);

        $cat->titulo=$request->get('titulo');
        $cat->descripcion=$request->get('descripcion');
        $cat->save();
        
        return response()->json($cat);
    }
}
?>