<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NotificacionDocente;
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
| Funciones para la vista general del estudiante
|--------------------------------------------------------------------------
*/
    public function vista_general_docente(){
        return view('user_docente.vista_general_cuenta');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para recibo de notificaciones
|--------------------------------------------------------------------------
*/
    public function notificacion_docente(){
        $noti_docente=new Notidocente;
        $noti_docente->user_id=auth()->user()->id;
        $noti_docente->title='Notificación de LILI';
        $noti_docente->descripcion='Lili esta pidiendo solitud de tutoria';
        $noti_docente->save();

        $user=User::where('id','!=',auth()->user()->id)->get();
        if(\Notification::send($user,new NotificacionDocente(Notidocente::latest('id')->first()))){
            return back();
        }
    }
}
