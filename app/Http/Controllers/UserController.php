<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;

class UserController extends Controller {

    // Seguridad en las rutas, para usuarios no autenticados
    public function __construct() {
        $this->middleware('auth');
    }        

    // Búsqueda de usuarios
    public function index($search = null){
        if(!empty($search)){
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                            ->orWhere('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('surname', 'LIKE', '%'.$search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
        }else{
            $users = User::orderBy('id', 'desc')->paginate(10);
        }
        
        return view('user.index',[
            'users' => $users
        ]);
    }

    // Vista de la página para editar datos del usuario
    public function config() {
        return view('user.config');
    }

    // Actualizar datos de un usuario
    public function update(Request $request) {

        // Conseguimos al usuario identificado
        $user = \Auth::user();
        $id = $user->id;

        // Validando los datos del formulario
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id
        ]);

        // Recogemos los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        $bio = $request->input('bio');

        // Asignamos nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        $user->bio = $bio;

        // Subir imagen
        $image_path = $request->file('image_path');
        if ($image_path) {
            // Poner un nombre único
            $image_path_name = time() . $image_path->getClientOriginalName();

            // Guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            // Set del nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }

        // Ejecutamos la consulta y los cambios en la base de datos
        $user->update();

        alert()->success('Perfil Actualizado.');

        return redirect()->route('config');                        
    }

    public function getImage($filename) {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }    

    public function profile($id) { 
        $user = User::find($id);        

        return view('user.profile', [
            'user' => $user
        ]);
    }

    public function changePassword(Request $request) {
    if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
        alert()->error('Error','Tú contraseña actual no coincide con la contraseña que proporcionó. Inténtalo de nuevo.');
        return redirect()->back();        
    }

    if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
        //Current password and new password are same
        alert()->warning('¡Hey!','La nueva contraseña no puede ser la misma que su contraseña actual. Por favor, elija una contraseña diferente.');
        return redirect()->back();        
    }

    $validatedData = $request->validate([
        'current-password' => 'required',
        'new-password' => 'required|string|min:8|confirmed',
    ]);

    //Change Password
    $user = Auth::user();
    $user->password = bcrypt($request->get('new-password'));
    $user->save();

    alert()->success('Contraseña Actualizada.');

    return redirect()->back();    
    }   

}
