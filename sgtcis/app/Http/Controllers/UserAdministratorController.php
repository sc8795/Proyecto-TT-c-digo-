<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAdministratorController extends Controller
{
    /* Controlador para la vista de formulario de login del administrador */
    public function login_administrador(){
        return view('user_administrador.login_administrador');
    }
}
