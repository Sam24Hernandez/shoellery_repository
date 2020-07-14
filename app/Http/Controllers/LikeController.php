<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    // Auth del usuario
    public function __construct(){
        $this->middleware('auth');
    }
	
    // Búsqueda de los likes de un usuario
    public function index(){
        $user = \Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return view('like.index',[
                'likes' => $likes
        ]);
    }
    
    // Dar Like a una imagen
    public function like($image_id){
        // Recoger datos del usuario y la imagen
        $user = \Auth::user();

        // Condicion para ver si ya existe el like y no duplicarlo
        $isset_like = Like::where('user_id', $user->id)
                                    ->where('image_id', $image_id)
                                    ->count();                
        
        if($isset_like == 0){
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;          

            // Guardar
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        }else{
            return response()->json([
                'message' => 'Ya has dado like.'
            ]);
        }

    }
    
    // Dar dislike a una imagen
    public function dislike($image_id){
        // Recoger datos del usuario y la imagen
        $user = \Auth::user();

        // Condicion para ver si ya existe el like y no duplicarlo
        $like = Like::where('user_id', $user->id)
                                    ->where('image_id', $image_id)
                                    ->first();

        if($like){
        // Eliminar like
        $like->delete();

        return response()->json([
                'like' => $like                        
        ]);
        }else{
            return response()->json([
                    'message' => 'No hay likes'
            ]);
        }
    }
}
