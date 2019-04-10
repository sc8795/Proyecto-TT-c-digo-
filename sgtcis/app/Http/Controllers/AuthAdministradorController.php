<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Materia;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class AuthAdministradorController extends Controller
{
/* 
|--------------------------------------------------------------------------
| Funciones para detectar y redirigir a la pagina del administrador autenticado
|--------------------------------------------------------------------------
*/
    public function __construct(){
        $this->middleware('auth');
    }

    public function auth_admin(){
        return view('user_administrador.auth_admin');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para la vista general del administrador
|--------------------------------------------------------------------------
*/
    public function vista_general_admin(){
        return view('user_administrador.vista_general_cuenta');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar perfil del administrador
|--------------------------------------------------------------------------
*/
public function editar_perfil_admin(){
    return view('user_administrador.editar_perfil_admin');
}

public function editar_admin(){
    if (Auth::check()) {
        $user = Auth::user();
        
        $data=request()->validate([
            'name'=>'required',
            'lastname'=>'required',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'password'=>''
        ]);

        if ($data["password"]!=null) {
            $data["password"]=bcrypt($data['password']);
        }else{
            unset($data["password"]);
        }
        
        $user->update($data);
        return redirect()->route('vista_general_admin');
    }
}
/* 
|--------------------------------------------------------------------------
| Funciones para la registrar un docente
|--------------------------------------------------------------------------
*/
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
            'email.unique'=>'Usuario ocupado',
            'password.required'=>'El campo contraseña es obligatorio',
        ]);        

        factory(User::class)->create([
            'name'=>$data['name'],
            'lastname'=>$data['lastname'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false,
            'paralelo'=>'NA',
            'ciclo'=>'NA'
        ]);
        return redirect()->route('docentes_registrados');
    }
    
    public function registrar_docente_excel(Request $request){
        $users = DB::table('users')->where('is_docente',true)->get();
        foreach ($users as $user)
        {
            User::destroy($user->id);
        }
        $archivo=$request->file('archivo');
        $nombre_original=$archivo->getClientOriginalName();
        $extension=$archivo->getClientOriginalExtension();
        $r1=Storage::disk('archivos')->put($nombre_original,\File::get($archivo));
        $ruta=storage_path('archivos')."/".$nombre_original;

        if($r1){
            Excel::load($ruta,function($reader){

                foreach ($reader->get() as $archivo) {
                    User::create([
                        'name'=>$archivo->nombres,
                        'lastname'=>$archivo->apellidos,
                        'email'=>$archivo->correo,
                        'password'=>bcrypt($archivo->password),
                        'is_admin'=>$archivo->is_admin,
                        'is_docente'=>$archivo->is_docente,
                        'is_estudiante'=>$archivo->is_estudiante,
                        'paralelo_a'=>$archivo->paralelo_a,
                        'paralelo_b'=>$archivo->paralelo_b,
                        'paralelo_c'=>$archivo->paralelo_c,
                        'paralelo_d'=>$archivo->paralelo_d,
                        'ciclo'=>$archivo->ciclo
                    ]);
                }
            });
            return redirect()->route('docentes_registrados');
        }
        
    }
/* 
|--------------------------------------------------------------------------
| Funciones para visualizar docentes registrados
|--------------------------------------------------------------------------
*/
    public function docentes_registrados(){
        $users = DB::table('users')->where('is_docente',true)->get();
        return view('user_administrador.docentes_registrados',compact('users'));
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar datos de un docente
|--------------------------------------------------------------------------
*/
    public function editar_perfil_docente(User $user){
        return view('user_administrador.editar_perfil_docente',['user'=>$user]);
    }
    public function editar_docente(User $user){
        $data=request()->validate([
            'name'=>'required',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'password'=>''
        ]);

        if ($data["password"]!=null) {
            $data["password"]=bcrypt($data['password']);
        }else{
            unset($data["password"]);
        }
        
        $user->update($data);
        return redirect()->route('docentes_registrados',['user'=>$user]);
    }

/* 
|--------------------------------------------------------------------------
| Funciones para la eliminar un docente
|--------------------------------------------------------------------------
*/
    public function eliminar_docente(User $user){
        $user->delete();
        return redirect()->route('docentes_registrados');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para registrar materia
|--------------------------------------------------------------------------
*/
    public function registrar_materia(){
        $users = DB::table('users')->where('is_docente',true)->get();
        //dd($users);
        return view('user_administrador.registrar_materia',compact('users'));
    }    

    public function crear_materia(Request $request){
        $name=$request->input('name');
        $ciclo=$request->input('gender');
        $docente=$request->input('docente');
        $paralelo_a=$request->input('paralelo_a');
        $paralelo_b=$request->input('paralelo_b');
        $paralelo_c=$request->input('paralelo_c');
        $paralelo_d=$request->input('paralelo_d');
        
        if($paralelo_a==null){
            $paralelo_a="NA";
        }
        if($paralelo_b==null){
            $paralelo_b="NA";
        }
        if($paralelo_c==null){
            $paralelo_c="NA";
        }
        if($paralelo_d==null){
            $paralelo_d="NA";
        }
        DB::table('materias')->insert([
            'name'=>$name,
            'ciclo'=>$ciclo,
            'usuario_id'=>$docente,
            'paralelo_a'=>$paralelo_a,            
            'paralelo_b'=>$paralelo_b,
            'paralelo_c'=>$paralelo_c,
            'paralelo_d'=>$paralelo_d,
        ]);
       
        return redirect()->route('materias_registradas');
    }

    public function registrar_materia_excel(Request $request){
        $users = DB::table('materias')->get();
        foreach ($users as $user)
        {
            Materia::destroy($user->id);
        }
        $archivo=$request->file('archivo');
        $nombre_original=$archivo->getClientOriginalName();
        $extension=$archivo->getClientOriginalExtension();
        $r1=Storage::disk('archivos')->put($nombre_original,\File::get($archivo));
        $ruta=storage_path('archivos')."/".$nombre_original;

        if($r1){
            Excel::load($ruta,function($reader){

                foreach ($reader->get() as $archivo) {
                    DB::table('materias')->insert([
                        'name'=>$archivo->nombre,
                        'ciclo'=>$archivo->ciclo,
                        'usuario_id'=>$archivo->id_docente,
                        'paralelo_a'=>$archivo->paralelo_a,
                        'paralelo_b'=>$archivo->paralelo_b,
                        'paralelo_c'=>$archivo->paralelo_c,
                        'paralelo_d'=>$archivo->paralelo_d,
                    ]);
                }
            });
            return redirect()->route('materias_registradas');
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para visualizar materias registradas
|--------------------------------------------------------------------------
*/
    public function materias_registradas(){
        $materias = DB::table('materias')->get();
        $users=DB::table('users')->where('is_docente',true)->get();
        return view('user_administrador.materias_registradas',compact('materias','users'));
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar una materia registrada
|--------------------------------------------------------------------------
*/
    public function editar_materia(Materia $materia){
        $users=DB::table('users')->where('is_docente',true)->get();
        return view('user_administrador.editar_materia',['materia'=>$materia],compact('users'));
    }
    public function editando_materia(Materia $materia, Request $request){
        /*$name = $request->input('name');
        $ciclo = $request->input('ciclo');
        $paralelo_a = $request->input('paralelo_a');
        $paralelo_b = $request->input('paralelo_b');
        $paralelo_c = $request->input('paralelo_c');
        $paralelo_d = $request->input('paralelo_d');
        if($paralelo_a==null){
            $paralelo_a="NA";
        }
        if($paralelo_b==null){
            $paralelo_b="NA";
        }
        if($paralelo_c==null){
            $paralelo_c="NA";
        }
        if($paralelo_d==null){
            $paralelo_d="NA";
        }
        $docente = $request->input('docente');
        //dd($docente);
        
        DB::table('materias')->update([
            'name'=>$name,
            'ciclo'=>$ciclo,
            'usuario_id'=>$docente,
            'paralelo_a'=>$paralelo_a,            
            'paralelo_b'=>$paralelo_b,
            'paralelo_c'=>$paralelo_c,
            'paralelo_d'=>$paralelo_d,
        ]);*/
        $data=request()->validate([
            'name'=>'required',
            'ciclo'=>'required',
            'usuario_id'=>'required',
            'paralelo_a'=>'required',
            'paralelo_b'=>'',
            'paralelo_c'=>'',
            'paralelo_d'=>'',
        ]);
        
        //dd($data["paralelo_b"]);
        $materia->update($data);
        return redirect()->route('materias_registradas',['materia'=>$materia]);
    }
/* 
|--------------------------------------------------------------------------
| Funciones para eliminar una materia registrada
|--------------------------------------------------------------------------
*/
    public function eliminar_materia(Materia $materia){
        $materia->delete();
        return redirect()->route('materias_registradas');
    }
}