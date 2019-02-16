<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Validation\Rule;

class AuthStudentController extends Controller
{
/* 
|--------------------------------------------------------------------------
| Funciones para detectar y redirigir a la pagina del estudiante autenticado
|--------------------------------------------------------------------------
*/
    public function __construct(){
        $this->middleware('auth');
    }

    public function auth_student(){
        return view('user_student.auth_student');    
    }
/* 
|--------------------------------------------------------------------------
| Funciones para la vista general del estudiante
|--------------------------------------------------------------------------
*/
    public function vista_general_student(){
        return view('user_student.vista_general_cuenta');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar perfil del estudiante
|--------------------------------------------------------------------------
*/
    public function editar_perfil_student(){
        return view('user_student.editar_perfil_student');
    }

    public function editar_student(){
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
            return redirect()->route('vista_general_student');
        }
    }
}
