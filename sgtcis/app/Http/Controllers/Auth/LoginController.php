<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\User;
use App\Materia;
use App\Encryption;
use App\Log;
use Auth;
use Redirect;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Crypt;

use Socialite;

class LoginController extends Controller
{
    /*
    |Request  => clase que Laravel utiliza para obtener datos de un formulario
    |$request => variable utilizada para obtener los datos del formulario
    */
    /* 
    |--------------------------------------------------------------------------
    | Registro manual del estudiante
    |--------------------------------------------------------------------------
    */
    public function registro_manual(Request $request){
        /*
        |$email    => guarda el valor que el usuario ha digitado en el campo email
        |$name     => guarda el valor que el usuario ha digitado en el campo name
        |$lastname => guarda el valor que el usuario ha digitado en el campo lastname
        */
        $email=$request->input("email");
        $name=$request->input("name");
        $lastname=$request->input("lastname");
        /*
        |$valida_email => guarda un valor (true o false); luego de consultar en la base de datos si en la tabla users,
        |                 en el campo email existe un registro igual al $email ingresado
        */
        $valida_email = User::where('email', '=', $email)->exists(); 
        /*
        |Si $valida_email es verdadero, significa que el usuario en el formulario a digitado un correo que ya existe 
        |registrado en la base de datos. Por medio de flash se envía un mensaje de error a la vista welcome.
        */
        if($valida_email==true){
            flash('El correo ingresado ya existe. Intente nuevamente')->error();
            return view('welcome');
        }else{
            /*
            |Registra el usuario en la base de datos
            */
            User::create([
                'name'=>$name,
                'lastname'=>$lastname,
                'password'=>bcrypt("sgtcis12345"),
                'is_admin'=>false,
                'is_docente'=>false,
                'is_estudiante'=>true,
                'paralelo'=>'NA',
                'ciclo'=>'NA',
                'email'=>$email,
            ]);
            $authUser = User::where('email', '=', $email)->first(); 
            Auth::login($authUser,true);
            return redirect()->route('vista_completar_registro');
        }
    }
    /* 
    |--------------------------------------------------------------------------
    | Registro del estudiante mediante google
    |--------------------------------------------------------------------------
    */
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider){
        $user = Socialite::driver($provider)->stateless()->user();
        $authUser=$this->findOrCreateUser($user,$provider);
        Auth::login($authUser,true);
        return redirect()->route('vista_completar_registro');
    }
    public function findOrCreateUser($user,$provider){
        $authUser=User::where('provider_id',$user->id)->first();
        if($authUser){
            return $authUser;
        }
        return User::create([
            'name'=>$user->name,
            'lastname'=>'',
            'password'=>bcrypt('sgtcis12345'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'NA',
            'ciclo'=>'NA',
            'email'=>$user->email,
            'provider'=>strtoupper($provider),
            'provider_id'=>$user->id,
        ]);   
    }

    /*se utiliza un middleware para que verifique si el usuario esta autenticado y lo redireccione a donde queramos, 
    al usar el middleware guest a esta ruta solo van a pasar los invitados no autenticados*/
    public function __construct(){
        $this->middleware('guest',['only'=>'show_login_form']);
        //$this->middleware('guest',['only'=>'show_login_form_student'],['except' => ['logout']]);
        //$this->middleware('guest',['only'=>'show_login_form_docente'],['except' => ['logout']]);
    }
    
    /* 
    |--------------------------------------------------------------------------
    | Login y Logout del Administrador
    |--------------------------------------------------------------------------
    */
    /*Metodo que devuelve el formulario de inicio de sesion del administrador*/
    public function show_login_form(){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_admin==true){
                return redirect()->route('vista_general_admin');
            }else{
                return view('user_administrador.login_administrador');
            }
        }else{
            return view('user_administrador.login_administrador');
        }
    }
    public function login_administrador(Request $request){
        if($request->isMethod('post')){
            $credenciales=$this->validate(request(),[
                $this->username()=>'required|string',
                'password'=>'required|string'
            ]);
            if(Auth::attempt($credenciales)){
                $emailform = $request->input("email");
                $users = DB::table('users')->where('email',$emailform)->first();
                if($users->is_admin==true){
                    if (Auth::check()){
                        return redirect()->route('vista_general_admin');
                    }
                }else{
                    return redirect()->route('show_login_form');
                }
            }
            flash("La contraseña o el correo ingresado es incorrecto. Por favor intente nuevamente.")->error();
            return redirect()->route('show_login_form');
        }
    }
    public function logout_administrador(){
        Auth::logout();
        return redirect('/administrator');
    }

    /* 
    |--------------------------------------------------------------------------
    | Login y Logout del Estudiante
    |--------------------------------------------------------------------------
    */
    /*Metodo que devuelve el formulario de inicio de sesion del estudiante*/
    public function show_login_form_student(){
        if (Auth::check()){
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                if($user_student->paralelo=="NA" && $user_student->ciclo=="NA"){
                    $materias=Materia::orderBy('id','DESC')
                        ->paginate(1);
                    $verifica_arrastre=DB::table('arrastres')
                        ->where('user_estudiante_id',$user_student->id)->exists();
                    $docentes=DB::table('users')->where('is_docente',true)->get();
                    if($verifica_arrastre==true){
                        $arrastre=DB::table('arrastres')
                            ->where('user_estudiante_id',$user_student->id)->first();
                        $arreglo_materia=explode('.', $arrastre->materia);
                        $arreglo_paralelo=explode('.', $arrastre->paralelo);
                        return view('user_student.completar_registro',
                            compact('user_student','materias','arrastre','arreglo_materia',
                            'verifica_arrastre','arreglo_paralelo','docentes'));
                    }else{
                        return view('user_student.completar_registro',compact('user_student',
                        'materias','verifica_arrastre','docentes'));
                    }   
                }else{
                    return view('user_student.auth_student'); 
                }
            }else{
                return view('user_student.login_student');
            }
        }else{
            return view('user_student.login_student');
        }
    }
    public function login_student(Request $request){
        if($request->isMethod('post')){
            $credenciales=$this->validate(request(),[
                $this->username()=>'required|string',
                'password'=>'required|string'
            ]);
            if(Auth::attempt($credenciales)){
                $emailform = $request->input("email");
                $user_student = DB::table('users')->where('email',$emailform)->first();
                if($user_student->is_estudiante==true){
                    if($user_student->paralelo=="NA" && $user_student->ciclo=="NA"){
                        return redirect()->route('auth_student');   
                    }else{
                        $fecha=now();
                        Log::create([
                            'detalle'=>"El estudiante ".$user_student->name." ".$user_student->lastname." ha iniciado sesión y accedido al sistema.",
                            'fecha'=>$fecha,
                            'tipo'=>1,
                            'tipo_usuario'=>2
                        ]);
                        return redirect()->route('vista_general_student');
                    }
                }else{
                    return redirect()->route('show_login_form_student');
                }
            }
            flash("La contraseña o el correo ingresado es incorrecto. Por favor intente nuevamente.")->error();
            return redirect()->route('show_login_form_student')->withInput();
        }
    }
    public function logout_student(){
        Auth::logout();
        return redirect('/student');
    }

    /* 
    |--------------------------------------------------------------------------
    | Login y Logout del Docente
    |--------------------------------------------------------------------------
    */
    /*Metodo que devuelve el formulario de inicio de sesion del docente*/
    public function show_login_form_docente(){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_docente==true){
                return redirect()->route('auth_docente');
            }else{
                return view('user_docente.login_docente');
            }   
        }else{
            return view('user_docente.login_docente');
        }
    }
    public function login_docente(Request $request){
        if($request->isMethod('post')){
            $credenciales=$this->validate(request(),[
                $this->username()=>'required|string',
                'password'=>'required|string'
            ]);
            if(Auth::attempt($credenciales)){
                $emailform = $request->input("email");
                $users = DB::table('users')->where('email',$emailform)->first();
                if($users->is_docente==true){
                    return redirect()->route('auth_docente');
                }else{
                    return redirect()->route('show_login_form_docente');
                }
            }
            flash("La contraseña o el correo ingresado es incorrecto. Por favor intente nuevamente.")
                ->error();
            return redirect()->route('show_login_form_docente')->withInput();
        }
    }

    public function logout_docente(){
        Auth::logout();
        return redirect('/docente');
    }

    public function username(){
        return 'email';
    }
}
