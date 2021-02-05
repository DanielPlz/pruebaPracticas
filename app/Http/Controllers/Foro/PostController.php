<?php
namespace App\Http\Controllers\Foro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //referencia a la clase maestra controller, necesaria, porque ya no esta en la misma carpeta
use Illuminate\Support\Facades\Auth;

use App\Modelos\Foro\Categoria;
use App\Modelos\Foro\Post;
use App\Modelos\Foro\Comment;
use App\Modelos\Foro\Like;
use App\User;
use DB;
use URL;

class PostController extends Controller
{
    public function index($id)
    {
        $post=Post::findOrFail($id);
        if ($post->estado == 0)
            abort(404);
        
        return view('foro.post.index', compact('post'));
    }

    public function viewDetail($id)
    {
        $post=Post::findOrFail($id);
        if ($post->estado == 0)
            abort(410);

        return view('foro.post.viewDetail', compact('post'));      
    }

    public function cmtList($id)
    {
        $comentarios = Comment::where('post_id', $id)->where('estado', 1)->get();
    
        return view('foro.post.cmtList')->with('comentarios', $comentarios);
    }

    public function postsUser()
    {
        $userId=auth()->user()->id;  
        $posts = Post::where('user_id',$userId)->where("estado", 1)->get();
        return view('foro.biblioteca.user-posts')->with('posts',$posts);
    }

    public function add(Request $request)
    {
        //TODO: arreglar validacion de rol/privilegio
        if (!(Auth::user()))
            return response()->json(['success'=>'trucho']);

        //validacion de entrada
        request()->validate([
            'titulo' => 'required|min:3',
            'imagen'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:12000',
            'contenido' => 'required|min:3'
        ]);

        $imagen_dir = null;

        if ($request->hasFile('imagen'))
        {
            $imagen_dir = $request->file('imagen')->store('/public/foro');
            $imagen_dir = str_replace("public/foro/", "", $imagen_dir);
        }

        Post::Create([
            'titulo'=>$request->get('titulo'),
            'contenido'=>$request->get('contenido'),
            'imagen'=> $imagen_dir,
            'categoria_id'=>$request->get('categoria_id'),
            'user_id'=>auth()->user()->id,
            'likes'=>0,
            'dislikes'=>0,
            'estado'=>1
        ]);

        return response()->json(['success'=>'true']);
    }
    
    public function edit(Request $request)
    {
        $post = Post::findOrFail($request->get('postEditId'));

        //validacion de input
        request()->validate([
            'titulo' => 'required|min:3',
            'imagen'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:12000',
            'contenido' => 'required|min:3'
        ]);

        //TODO: arreglar validacion de rol/privilegio
        if (!Auth::user() || !(Auth::user()->tipo == "Administrador"))
        {
            if (Auth::user() != $post->user)
                return response()->json(['success'=>'trucho']);
        }

        if ($post->estado == 0)
            return response()->json(['customError' => 'El post ya no existe'], 410);
        
        $imagen_dir = $post->imagen;

        if ($request->hasFile('imagen'))
        {
            $imagen_dir = $request->file('imagen')->store('/public/foro');
            $imagen_dir = str_replace("public/foro/", "", $imagen_dir);
        }
        
        $post->titulo = $request->get('titulo');
        $post->contenido = $request->get('contenido');
        $post->imagen = $imagen_dir;
        $post->save();
        
        return response()->json($post);
    }

    public function delete(Request $request)
    {   
        $post = Post::findOrFail($request->get('id'));

        $post->estado = 0;
        $post->save();

        return response()->json(['success'=>'true']);
    }

    public function details(Request $request)
    {
        $idPost = $request->input('postId');
        $post = Post::findOrFail($idPost); 

        if ($post->estado == 0)
            return response()->json(['customError' => 'El post ya no existe'], 410);
            
        return $post;
    }

    //TODO: optimize/rewrite
    public function togglePostLike()
    {
        if (auth()->user())
        {
            $idPost = request('idPost');
            $idUser = auth()->user()->id;
            $is_like = request('isLike');
            $post = Post::findOrFail($idPost);
            
            $like = Like::where('users_id',$idUser)
            ->where('post_id',$idPost)
            ->where('like',1)
            ->first();
            $disLike = Like::where('users_id',$idUser)
            ->where('post_id',$idPost)
            ->where('like',0)
            ->first();
    
            $addIsLike = new Like();
            $addIsLike->like = $is_like;
            $addIsLike->users_id = $idUser;
            $addIsLike->post_id = $idPost;
    
            if($is_like==1)
            {
                if($disLike)
                {
                    $disLike->delete();
                    $post->dislikes = $post->dislikes-1;
                    $addIsLike->save();
                    $post->likes = $post->likes+1;
                }
                else
                {
                    if($like)
                    {
                        $like->delete();
                        $post->likes = $post->likes-1;
                    }
                    else
                    {
                        $addIsLike->save();
                        $post->likes = $post->likes+1;
                    }
                    $post->save();
                }
                $post->save();
            }
            else
            {
                if($like)
                {
                    $like->delete();
                    $post->likes = $post->likes-1;
                    $addIsLike->save();
                    $post->dislikes = $post->dislikes + 1;
                }
                else
                {
                    if($disLike)
                    {
                        $disLike->delete();
                        $post->dislikes = $post->dislikes - 1;
                    }
                    else
                    {
                        $addIsLike->save();
                        $post->dislikes = $post->dislikes + 1;
                    }
                    $post->save();
                }
                $post->save();
            }
            return response()->json(["post" => $post]); //TODO: return only likes/dislikes instead of the whole post, its wasteful
        }
        else
        {
            return response()->json(["msg" => "Debe estar registrado"]);
        }
    }
}
?>