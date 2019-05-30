<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Materia;
use Alert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
/* 
|--------------------------------------------------------------------------
| Funciones para solicitar tutoria
|--------------------------------------------------------------------------
*/
    public function solicitar_tutoria(){
        $materias = DB::table('materias')->get();
        $users=DB::table('users')->where('is_estudiante',true)->get();
        $users_docentes=DB::table('users')->where('is_docente',true)->get();
        return view('user_student.solicitar_tutoria',compact('materias','users','users_docentes'));
    }
    public function vista_solicitar_tutoria(User $user, User $user_docente, Materia $materia){
        $docente=$user_docente->id;
        $verifica_horarios=DB::table('horarios')->where('usuario_id',$docente)->exists();
        $verifica_horarios2=DB::table('horario2s')->where('usuario_id',$docente)->exists();
        $verifica_horarios3=DB::table('horario3s')->where('usuario_id',$docente)->exists();
        $verifica_horarios4=DB::table('horario4s')->where('usuario_id',$docente)->exists();
        $verifica_horarios5=DB::table('horario5s')->where('usuario_id',$docente)->exists();
        if($verifica_horarios==true || $verifica_horarios2==true || $verifica_horarios3==true || $verifica_horarios4==true || $verifica_horarios5==true){
            $estado=0;
            $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
            $horarios2=DB::table('horario2s')->where('usuario_id',$docente)->first();
            $horarios3=DB::table('horario3s')->where('usuario_id',$docente)->first();
            $horarios4=DB::table('horario4s')->where('usuario_id',$docente)->first();
            $horarios5=DB::table('horario5s')->where('usuario_id',$docente)->first();
            return view('user_student.vista_solicitar_tutoria',compact('user','user_docente','materia','estado','horarios','horarios2','horarios3','horarios4','horarios5'));
        }else{
            $estado=1;
            Alert::info('¡Aviso! ')
                ->details("El docente $user_docente->name $user_docente->lastname no tiene asignado horario de tutoría.");
            return view('user_student.vista_solicitar_tutoria',compact('estado'));
        }
    }
}
