<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthDocenteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('user_docente.auth_docente');
    }
}
