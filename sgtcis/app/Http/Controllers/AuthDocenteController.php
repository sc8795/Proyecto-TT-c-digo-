<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NotificacionDocente;
use Illuminate\Support\Facades\DB;
use App\Notidocente;
use App\User;

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
}
