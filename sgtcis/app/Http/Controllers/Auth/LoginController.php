<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    /*se utiliza un middleware para que verifique si el usuario esta autenticado y lo redireccione a donde queramos, al usar el middleware guest a esta ruta solo van a pasar los invitados no autenticados*/
    public function __construct(){
        $this->middleware('guest',['only'=>'show_login_form']);
    }
    /*Metodo para devolver el formulario de inicio de sesion del administrador*/
    public function show_login_form(){
        return view('user_administrador.login_administrador');
    }

    public function login_administrador(){
        /*Establecemos las reglas de validacion para el formulario de login admistrador, en donde los campos email y password seran requeridos y de tipo string, estas reglas las guardamos en la variable $credenciales*/
        $credenciales=$this->validate(request(),[
            $this->username()=>'required|string',
            'password'=>'required|string'
        ]);

        /*Codigo en donde se inicia la sesion del usuario administrador, para lo cual hacemos uso del fasat Auth y accedemos al metodo attempt y le pasamos las credenciales directamente. Esto devuelve un boolean (V o F) dependiendo si los datos de acceso coinciden con los datos que se encuentran en la BD*/
        
        /*si es V, se redirecciona a una url privada "auth_admin" y la creamos en web.php*/
        if(Auth::attempt($credenciales)){
            return redirect()->route('auth_admin');
        }
        /*si es F retornamos hacia atras con los errores, y en el campo email nos aparecera el mensaje enviado estas...*/
        return back()->withErrors([$this->username()=>'estas credenciales son incorrectas'])->withInput(request([$this->username()]));
    }


    public function logout_administrador(){
        Auth::logout();
        return redirect('/administrator');
    }

    public function username(){
        return 'email';
    }
}
