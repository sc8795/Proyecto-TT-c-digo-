<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect;
use Laracasts\Flash\Flash;

use Socialite;

class LoginController extends Controller
{
    public function registro_manual(Request $request){
        $email=$request->input("email");
        $name=$request->input("name");
        $lastname=$request->input("lastname");
        $valida_email = User::where('email', '=', $email)->exists(); 
        if($valida_email==true){
            flash('El correo ingresado ya existe. Intente nuevamente')->error();
            return view('welcome');
        }else{
            User::create([
                'name'=>$name,
                'lastname'=>$lastname,
                'password'=>bcrypt("12345"),
                'is_admin'=>false,
                'is_docente'=>false,
                'is_estudiante'=>true,
                'paralelo'=>'NA',
                'ciclo'=>'NA',
                'email'=>$email,
            ]);
            $authUser = User::where('email', '=', $email)->first(); 
            Auth::login($authUser,true);
            return redirect()->action('AuthStudentController@vista_student_google');
        }
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $authUser=$this->findOrCreateUser($user,$provider);
        Auth::login($authUser,true);
        //return redirect()->action('AuthStudentController@vista_student_google', [$user->id]);
        return redirect()->action('AuthStudentController@vista_student_google');
    }

    public function findOrCreateUser($user,$provider){
        $authUser=User::where('provider_id',$user->id)->first();
        if($authUser){
            return $authUser;
        }
        return User::create([
            'name'=>$user->name,
            'lastname'=>'',
            'password'=>'',
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

    /*se utiliza un middleware para que verifique si el usuario esta autenticado y lo redireccione a donde queramos, al usar el middleware guest a esta ruta solo van a pasar los invitados no autenticados*/
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
    /*Metodo para devolver el formulario de inicio de sesion del administrador*/
    public function show_login_form(){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_admin==true){
                return redirect()->route('auth_admin');
            }else{
                return view('user_administrador.login_administrador');
            }
        }else{
            return view('user_administrador.login_administrador');
        }
    }
    public function login_administrador(Request $request){
        /*Establecemos las reglas de validacion para el formulario de login admistrador, en donde los campos email y password seran requeridos y de tipo string, estas reglas las guardamos en la variable $credenciales*/
        $credenciales=$this->validate(request(),[
            $this->username()=>'required|string',
            'password'=>'required|string'
        ]);
        /*Codigo en donde se inicia la sesion del usuario administrador, para lo cual hacemos uso del fasat Auth y accedemos al metodo attempt y le pasamos las credenciales directamente. Esto devuelve un boolean (V o F) dependiendo si los datos de acceso coinciden con los datos que se encuentran en la BD*/
        if($request->isMethod('post')){
            /*si es V, se redirecciona a una url privada "auth_admin" y la creamos en web.php*/
            if(Auth::attempt($credenciales)){
                $emailform = $request->input("email");
                $users = DB::table('users')->where('email',$emailform)->first();
                if($users->is_admin==true){
                    //dd("Hola lili");
                    if (Auth::check()){
                        return redirect()->route('auth_admin');
                    }
                }else{
                    //dd("Hola guisella");
                    return redirect()->route('show_login_form')->withErrors([$this->username()=>'Usted no es administrador'])->withInput(request([$this->username()]));
                }
            }
            /*si es F retornamos hacia atras con los errores, y en el campo email nos aparecera el mensaje enviado estas...*/
            return back()->withErrors([$this->username()=>'estas credenciales son incorrectas'])->withInput(request([$this->username()]));
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
    /*Metodo para devolver el formulario de inicio de sesion del administrador*/
    public function show_login_form_student(){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_estudiante==true){
                return redirect()->route('auth_student');
            }else{
                return view('user_student.login_student');
            }
        }else{
            return view('user_student.login_student');
        }
    }
    public function login_student(Request $request){
        /*Establecemos las reglas de validacion para el formulario de login admistrador, en donde los campos email y password seran requeridos y de tipo string, estas reglas las guardamos en la variable $credenciales*/
        $credenciales=$this->validate(request(),[
            $this->username()=>'required|string',
            'password'=>'required|string'
        ]);

        /*Codigo en donde se inicia la sesion del usuario administrador, para lo cual hacemos uso del fasat Auth y accedemos al metodo attempt y le pasamos las credenciales directamente. Esto devuelve un boolean (V o F) dependiendo si los datos de acceso coinciden con los datos que se encuentran en la BD*/
        if($request->isMethod('post')){
            /*si es V, se redirecciona a una url privada "auth_student" y la creamos en web.php*/
            if(Auth::attempt($credenciales)){
                $emailform = $request->input("email");
                $users = DB::table('users')->where('email',$emailform)->first();
                if($users->is_estudiante==true){
                    return redirect()->route("auth_student");
                }else{
                    return redirect()->route('show_login_form_student')->withErrors([$this->username()=>'Usted no es estudiante'])->withInput(request([$this->username()]));
                }
            }
            /*si es F retornamos hacia atras con los errores, y en el campo email nos aparecera el mensaje enviado estas...*/
            return back()->withErrors([$this->username()=>'estas credenciales son incorrectas'])->withInput(request([$this->username()]));
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
    /*Metodo para devolver el formulario de inicio de sesion del administrador*/
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
        /*Establecemos las reglas de validacion para el formulario de login admistrador, en donde los campos email y password seran requeridos y de tipo string, estas reglas las guardamos en la variable $credenciales*/

        $credenciales=$this->validate(request(),[
            $this->username()=>'required|string',
            'password'=>'required|string'
        ]);

        /*Codigo en donde se inicia la sesion del usuario administrador, para lo cual hacemos uso del fasat Auth y accedemos al metodo attempt y le pasamos las credenciales directamente. Esto devuelve un boolean (V o F) dependiendo si los datos de acceso coinciden con los datos que se encuentran en la BD*/
        if($request->isMethod('post')){
            /*si es V, se redirecciona a una url privada "auth_admin" y la creamos en web.php*/
            if(Auth::attempt($credenciales)){
                $emailform = $request->input("email");
                $users = DB::table('users')->where('email',$emailform)->first();
                if($users->is_docente==true){
                    return redirect()->route('auth_docente');
                }else{
                    return redirect()->route('show_login_form_docente')->withErrors([$this->username()=>'Usted no es docente'])->withInput(request([$this->username()]));
                }
            }
            /*si es F retornamos hacia atras con los errores, y en el campo email nos aparecera el mensaje enviado estas...*/
            return back()->withErrors([$this->username()=>'estas credenciales son incorrectas'])->withInput(request([$this->username()]));
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
