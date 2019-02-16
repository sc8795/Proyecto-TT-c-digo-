<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Auth;

class AuthAdministradorController extends Controller
{
/* 
|--------------------------------------------------------------------------
| Funciones para detectar y redirigir a la pagina del administrador autenticado
|--------------------------------------------------------------------------
*/
    public function __construct(){
        $this->middleware('auth');
    }

    public function auth_admin(){
        return view('user_administrador.auth_admin');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para la vista general del administrador
|--------------------------------------------------------------------------
*/
    public function vista_general_admin(){
        return view('user_administrador.vista_general_cuenta');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar perfil del administrador
|--------------------------------------------------------------------------
*/
public function editar_perfil_admin(){
    return view('user_administrador.editar_perfil_admin');
}

public function editar_admin(){
    if (Auth::check()) {
        $user = Auth::user();
        
        $data=request()->validate([
            'name'=>'required',
            'lastname'=>'required',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'password'=>''
        ]);

        if ($data["password"]!=null) {
            $data["password"]=bcrypt($data['password']);
        }else{
            unset($data["password"]);
        }
        
        $user->update($data);
        return redirect()->route('vista_general_admin');
    }
}
/* 
|--------------------------------------------------------------------------
| Funciones para la registrar un docente
|--------------------------------------------------------------------------
*/
    public function registrar_docente(){
        return view('user_administrador.registrar_docente');
    }
    public function crear_docente(){
        $data=request()->validate([
            'name'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required'
        ],[
            'name.required'=>'El campo nombre es obligatorio',
            'lastname.required'=>'El campo apellido es obligatorio',
            'email.required'=>'El campo email es obligatorio',
            'password.required'=>'El campo contraseña es obligatorio',
        ]);        

        factory(User::class)->create([
            'name'=>$data['name'],
            'lastname'=>$data['lastname'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false
        ]);
        return redirect()->route('docentes_registrados');
    }    
/* 
|--------------------------------------------------------------------------
| Funciones para visualizar docentes registrados
|--------------------------------------------------------------------------
*/
    public function docentes_registrados(){
        $users = DB::table('users')->where('is_docente',true)->get();
        return view('user_administrador.docentes_registrados',compact('users'));
    }
/* 
|--------------------------------------------------------------------------
| Funciones para la editar datos de un docente
|--------------------------------------------------------------------------
*/
    public function editar_perfil_docente(User $user){
        return view('user_administrador.editar_perfil_docente',['user'=>$user]);
    }
    public function editar_docente(User $user){
        $data=request()->validate([
            'name'=>'required',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'password'=>''
        ]);

        if ($data["password"]!=null) {
            $data["password"]=bcrypt($data['password']);
        }else{
            unset($data["password"]);
        }
        
        $user->update($data);
        return redirect()->route('docentes_registrados',['user'=>$user]);
    }

/* 
|--------------------------------------------------------------------------
| Funciones para la eliminar un docente
|--------------------------------------------------------------------------
*/
    public function eliminar_docente(User $user){
        $user->delete();
        return redirect()->route('docentes_registrados');
    }
}