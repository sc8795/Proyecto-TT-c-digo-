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
| Funciones para la vista general del docente
|--------------------------------------------------------------------------
*/
    public function vista_general_docente(){
        return view('user_docente.vista_general_cuenta');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para la vista general del docente
|--------------------------------------------------------------------------
*/
    public function ver_tutoria_solitada(){
        return view('user_docente.vista_tutoria_solicitada');
    }
}
