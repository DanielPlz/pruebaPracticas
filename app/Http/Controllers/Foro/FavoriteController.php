<?php
namespace App\Http\Controllers\Foro; //namespace correspondiente a la carpeta en la que se encuentra

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //referencia a la clase maestra controller, necesaria, porque ya no esta en la misma carpeta
use Illuminate\Support\Facades\Auth;

use App\Modelos\Foro\Favorite;
use App\Modelos\Foro\Post;
use App\User;
use DB;
use URL;

class FavoriteController extends Controller
{
    public function index()
    {
        return view('foro.biblioteca.index');
    }
    //TODO: many to many relationship
    public function userFavorites()
    {
        $idUser = auth()->user()->id;
        $user = User::findOrFail($idUser);

        //if ($user->estado == 0) 
        //return abort(404);

        $favs = Favorite::where('users_id',$idUser)->get();
        $posts = array();

        foreach($favs as $fav)
        {
            $p = Post::where("id", $fav->post_id)->where('estado', 1)->get()->first();

            if ($p != null)
                array_push($posts, $p);
        }

        return view('foro/biblioteca/user-favorites')->with('posts',$posts);
    }

    public function postAddFav()
    {
        if(!auth()->user())
            return response()->json(["msgfail" => "Debes registrarte para activar esta funcionalidad"]);

        $idPost = request('idPost');
        $idUser = auth()->user()->id;

        $registro = Favorite::where('users_id',$idUser)->where('post_id',$idPost)->first();
        
        if($registro)
        {
            $registro->delete();
            return response()->json(["msgdelete" => "Se borro el post de favoritos"]);
        }
        else
        {
            $addFavorite = new Favorite();
            $addFavorite->users_id = $idUser;
            $addFavorite->post_id = $idPost;
            $addFavorite->save();
            return response()->json(["msgsuccess" => "Se guardo el post en favoritos"]);
        }
    }
}
?>