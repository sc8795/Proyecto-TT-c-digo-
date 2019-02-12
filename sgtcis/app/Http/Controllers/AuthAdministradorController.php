<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class AuthAdministradorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('user_administrador.auth_admin');
    }

    public function vista_general_admin(){
        //return view('user_administrador.vista_general_cuenta');
        return view('user_administrador.vista_general_cuenta');
    }
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
        return redirect()->route('vista_general_admin');
    }
}