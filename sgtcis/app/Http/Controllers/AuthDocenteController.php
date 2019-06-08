<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\NotificacionEstudiante;
use App\Solitutoria;
use App\Materia;
use App\Notiestudiante;
use App\User;
use Alert;

class AuthDocenteController extends Controller
{
/* 
|--------------------------------------------------------------------------
| Funciones para detectar y redirigir a la pagina del docente autenticado
|--------------------------------------------------------------------------
*/
    public function __construct(){
        $this->middleware('auth');
    }

    public function auth_docente(){
        return view('user_docente.auth_docente');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para la vista general del docente
|--------------------------------------------------------------------------
*/
    public function vista_general_docente(){
        return view('user_docente.vista_general_cuenta');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar perfil del docente
|--------------------------------------------------------------------------
*/
    public function editar_perfil_docente(){
        return view('user_docente.editar_perfil_docente');
    }
    public function editar_docente(){
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
            return redirect()->route('vista_general_docente');
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para vista de tutoria solicitada por parte del estudiante
|--------------------------------------------------------------------------
*/
    public function ver_tutoria_solitada($user_student_id,$user_docente_id){
        $estudiante=DB::table('users')->where('id',$user_student_id)->first();
        $docente=DB::table('users')->where('id',$user_docente_id)->first();
        $materia=DB::table('materias')->where('usuario_id',$docente->id)->first();
        $datos_tut=DB::table('solitutorias')->where('estudiante_id',$estudiante->id)->where('docente_id',$docente->id)->where('materia_id',$materia->id)->first();
        return view('user_docente.vista_tutoria_solicitada',compact('estudiante','docente','materia','datos_tut'));
    }
/* 
|--------------------------------------------------------------------------
| Funciones para confirmar tutoria solicitada
|--------------------------------------------------------------------------
*/
    public function confirmar_tutoria(Solitutoria $datos_tut,User $estudiante,User $docente,Materia $materia){
        $noti_estudiante=new Notiestudiante;
        $noti_estudiante->user_id=auth()->user()->id;
        $noti_estudiante->user_estudiante_id=$estudiante->id;
        $user=DB::table('users')->where('id',$noti_estudiante->user_id)->first();
        $noti_estudiante->title="Tutoría confirmada";
        $noti_estudiante->descripcion="El docente $user->name $user->lastname le ha confirmado la tutoría solicitada";
        $noti_estudiante->save();

        $user_notificado=User::where('id','=',$estudiante->id)->get();
        if(\Notification::send($user_notificado,new NotificacionEstudiante(Notiestudiante::latest('id')->first()))){
            return back();
        }

        Alert::info('¡Aviso! ')
             ->details("Ha confirmado la tutoría solicitada por el estudiante $estudiante->name $estudiante->lastname, para el día $datos_tut->dia en el horario de $datos_tut->hora_inicio:$datos_tut->minutos_inicio a $datos_tut->hora_fin:$datos_tut->minutos_fin. Ahora podrá evaluar la actuación del estudiante sobre la tutoría impartida, en la opción disponible en el menú EVALUACIÓN AL ESTUDIANTE.");
        return view('user_docente.vista_general_cuenta');
    }
}
