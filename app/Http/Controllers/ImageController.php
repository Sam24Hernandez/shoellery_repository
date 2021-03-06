<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller {

    // Auth de usuario
    public function __construct() {
        $this->middleware('auth');
    }

    // Crear un post de tu imagen
    public function create() {
        return view('image.create');
    }

    // Guardar tu foto en tu perfil de usuario
    public function save(Request $request) {

        // Validación de imágenes
        $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);                       

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Asingamos valores al nuevo objeto
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;                

        // Subir fichero
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();            
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            $image->image_path = $image_path_name;            
        }                

        $image->save();

        alert()->success('¡Genial!','Tu foto ha sido compartida a la galería.');

        return redirect()->route('home');                          
    }       

    public function getImage($filename) {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id) {
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image            
        ]);
    }    

    public function view($id){
        $image = Image::find($id);

        return view('image.view', [
            'image' => $image
        ]);
    } 

    public function delete($id) {
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();      

        if ($user && $image && $image->user->id == $user->id) {

            // Eliminar comentarios
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            // Eliminar los likes
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // Eliminar ficheros de imagen del Storage
            Storage::disk('images')->delete($image->image_path);

            // Eliminar registro imagen
            $image->delete();
       
            alert()->success('Tú foto ha sido borrada.');
        } else {
            alert()->error('¿Algo salió mal?','La foto no se pudo borrar.');
        }

        return redirect()->route('home');
    }

    // Editar imagen o descripcion de la imagen publicada
    public function edit($id) {
        $user = \Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', [
                'image' => $image
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    // Actualizar imagen
    public function update(Request $request) {
        //Validación
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'image'
        ]);

        // Recoger datos
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Conseguir objeto image
        $image = Image::find($image_id);
        $image->description = $description;

        // Subir fichero
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            
            $image->image_path = $image_path_name;
        }

        // Actualizar registro
        $image->update();

        alert()->success('¡Listo!','Tu foto ha sido actualizada.');

        return redirect()->route('image.detail', ['id' => $image_id]);
                        
    }      

}
