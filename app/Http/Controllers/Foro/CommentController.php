<?php
namespace App\Http\Controllers\Foro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //referencia a la clase maestra controller, necesaria, porque ya no esta en la misma carpeta
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Modelos\Foro\Comment;
use App\Modelos\Foro\LikeCmt;
use DB;
use URL;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        //TODO: arreglar validacion de rol/privilegio
        if (!(Auth::user()))
            return response()->json(['success'=>'trucho']);

        //validacion de entrada
        request()->validate([
            'comment' => 'required|min:1',
        ]);

        $crearCmt = Comment::Create([
            'comment'=>$request->get('comment'),
            'users_id'=>auth()->user()->id,
            'post_id'=>$request->get('post_id'),
            'estado'=>1
        ]);
        
        return response()->json(['success'=>'true']);
    }

    public function delete($id)
    {
        $cmt = Comment::findOrFail($id);
        
        //TODO: arreglar validacion de rol/privilegio
        if (!Auth::user() || !(Auth::user()->tipo == "Administrador"))
        {
            if (Auth::user() != $cmt->user)
                return response()->json(['success'=>'trucho']);
        }

        $cmt->estado = 0;
        $cmt->save();

        return response()->json(['success'=>'true']);
    }

    public function edit(Request $request)
    {
        $cmt = Comment::findOrFail($request->input('cmtEditId'));
        
        if ($cmt->estado == 0)
            return response()->json(['customError' => 'El comentario ya no existe'], 410);
        
        //validacion de input
        request()->validate([
            'comment' => 'required|min:1',
        ]);
        
        //TODO: arreglar validacion de rol/privilegio
        if (!Auth::user() || !(Auth::user()->tipo == "Administrador"))
        {
            if (Auth::user() != $cmt->user)
                return response()->json(['success'=>'trucho']);
        }
        
        $cmt->comment = $request->get('comment');
        $cmt->save();
        
        return response()->json($cmt);
    }
    public function details(Request $request)
    {
        $id = $request->input('id');
        $cmt = Comment::findOrFail($id);
        
        if ($cmt->estado == 0)
            return response()->json(['customError' => 'El post ya no existe'], 410);
        
        return $cmt;
    }

    public function toggleCmtLike()
    {
        if (!(auth()->user()))
            return response()->json(["msg" => "Debe estar registrado"]);

        $idCmt = request('idCmt');
        $idUser = auth()->user()->id;
        $is_like = request('isLike');
        $cmt = Comment::findOrFail($idCmt);

        $like = LikeCmt::where('users_id',$idUser)
        ->where('comment_id',$idCmt)
        ->where('like',1)
        ->first();
        $disLike = LikeCmt::where('users_id',$idUser)
        ->where('comment_id',$idCmt)
        ->where('like',0)
        ->first();

        $addIsLike = new LikeCmt();
        $addIsLike->like = $is_like;
        $addIsLike->users_id = $idUser;
        $addIsLike->comment_id = $idCmt;

        if($is_like==1)
        {
            if($disLike)
            {
                $disLike->delete();
                $cmt->dislikes = $cmt->dislikes-1;
                $addIsLike->save();
                $cmt->likes = $cmt->likes+1;
            }
            else
            {
                if($like)
                {
                    $like->delete();
                    $cmt->likes = $cmt->likes-1;
                }
                else
                {
                    $addIsLike->save();
                    $cmt->likes = $cmt->likes+1;
                }
                $cmt->save();
            }
            $cmt->save();
        }
        else
        {
            if($like)
            {
                $like->delete();
                $cmt->likes = $cmt->likes-1;
                $addIsLike->save();
                $cmt->dislikes = $cmt->dislikes + 1;
            }
            else
            {
                if($disLike)
                {
                    $disLike->delete();
                    $cmt->dislikes = $cmt->dislikes - 1;
                }
                else
                {
                    $addIsLike->save();
                    $cmt->dislikes = $cmt->dislikes + 1;
                }
                $cmt->save();
            }
            $cmt->save();
        }
        return response()->json(["cmt" => $cmt]);
    }
}
?>