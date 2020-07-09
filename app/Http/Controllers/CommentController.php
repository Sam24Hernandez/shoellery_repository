<?php

namespace App\Http\Controllers;
use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function save(Request $request){
        // Validación
        $validate = $this->validate($request, [
           'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);
        
        // Recoger datos
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        // Asigno los valores a mi nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        // Guardar en la bd
        $comment->save();
		
        // Redirección
        return redirect()->route('image.detail', ['id' => $image_id])
                        ->with([
                               'message' => 'Comentario publicado.'
                        ]);
    }
    
    public function delete($id){
        // Conseguir los datos del usuario logeado
        $user = \Auth::user();
        
        // Conseguir el objeto del comentario
        $comment = Comment::find($id);
        
        // Comprobamos si yo soy el dueño del comentario de  la foto
        if($user && ($comment->user_id === $user->id || $comment
                ->image->user_id === $user->id)){
            $comment->delete();
            
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                             ->with(['message' => 'Tú comentario ha sido borrado.']);
        }else{
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                             ->with(['message' => 'Tú comentario no ha sido borrado.']);
        }
    }
}
