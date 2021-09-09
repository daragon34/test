<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectUser;

class UserController extends Controller
{
    //
    public function index(){
        //$users = User::all(); //Para todos los usuarios, no desactivados.

        //$users = User::where('rol',1)->get(); //Para un tipo de usuario, no se listan los desactivados.

        //$users = User::withTrashed()->get(); // Para todos usuarios.
        $users = User::where('rol',1)->withTrashed()->get(); // Para usuarios con rol 1.

        return view('admin.users.index')->with(compact('users'));
    }
    
    public function store(Request $request){
        
        $validar = [
            'email' => 'required|email|max:64|unique:users',
            'nombre' => 'required|max:80',
            'password' => 'required|min:8',
        ];
        $mensaje=[
            'email.required'=>'El email es obligatorio.',
            'email.email'=>'El formato de email no es válido',
            'email.max'=>'El email es demasiado largo. No debe tener más de 64 caracteres.',
            'email.unique'=>'El email ya se encuentra registrado.',
            'nombre.required'=>'Ingrese el nombre del usuario.',
            'nombre.max'=>'El nombre de usuario es demasiado largo, debe tener 80 caracteres máximo.',
            'password.required'=>'Debe escribir un título para la incidencia.',
            'password.min'=>'La contraseña debe tener al menos 10 caracteres.',
        ];

        $this->validate($request, $validar, $mensaje);
        
        //return $request->all();
        //dd($request->all());
        $user = new User();
        $user->email = $request->input('email');
        $user->name = $request->input('nombre');
        $user->password = bcrypt($request->input('password'));
        $user->rol = 1;
        $user->save();
        
        return back()->with('aviso', 'El usuario ha sido registrado.');
    }
    public function edit($id){
        $user = User::find($id);

        $projects = Project::all();

        $projects_user = ProjectUser::where('user_id', $user->id)->get();
        return view('admin.users.edit')->with(compact('user', 'projects', 'projects_user'));
    }

    public function update($id, Request $request){
        
        $validar = [
            'nombre' => 'required|max:80',
            'password' => 'min:10',
        ];
        $mensaje=[
            'nombre.required'=>'Ingrese el nombre del usuario.',
            'nombre.max'=>'El nombre de usuario es demasiado largo, debe tener 80 caracteres máximo.',
            'password.min'=>'La contraseña debe tener al menos 10 caracteres.',
        ];

        $this->validate($request, $validar, $mensaje);
        
        //return $request->all();
        
        $user = User::find($id);
        $user->name = $request->input('nombre');

        $password = $request->input('password');
        if ($password)
            $user->password = bcrypt($password);
            
           // dd($request->all());
        $user->save();
        
        return back()->with('aviso', 'El usuario ha sido actualizado.');
    }
    
    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return back()->with('aviso', 'El usuario ha sido eliminado.');
    }

    public function activate($id){
        User::withTrashed()->find($id)->restore();
        return back()->with('aviso', 'El usuario ha sido habilitado');
    }
}
