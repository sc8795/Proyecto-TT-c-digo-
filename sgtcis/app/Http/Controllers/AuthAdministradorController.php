<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthAdministradorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('user_administrador.auth_admin');
    }

    public function vista_general_admin(){
        return view('user_administrador.vista_general_cuenta');
    }
}