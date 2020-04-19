<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Materia;
use App\Horario;
use App\Horario2;
use App\Horario3;
use App\Horario4;
use App\Horario5;
use App\Log;
use App\Encryption;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Alert;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Crypt;

/**
* @OA\Info(title="Documentación software SGT - CIS", version="1.0")
*
*/
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
/* 
|--------------------------------------------------------------------------
| Funciones para la vista general del administrador
|--------------------------------------------------------------------------
*/
    public function vista_general_admin(){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_admin==true){
                return view('user_administrador.vista_general_cuenta');
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar perfil del administrador
|--------------------------------------------------------------------------
*/
public function editar_perfil_admin(){
    if (Auth::check()){
        $user = Auth::user();
        if($user->is_admin==true){
            return view('user_administrador.editar_perfil_admin');
        }else{
            return view('user_administrador.login_administrador');
        }
    }
}

public function editar_admin(){
    if (Auth::check()) {
        $user = Auth::user();
        if($user->is_admin==true){
            $data=request()->validate([
                'name'=>'required',
                'lastname'=>'required',
                'password'=>''
            ]);
            if ($data["password"]!=null) {
                $data["password"]=bcrypt($data['password']);
            }else{
                unset($data["password"]);
            }
            $user->update($data);
            flash('Perfil editado correctamente.')
                ->success();
            return redirect()->route('vista_general_admin');
        }else{
            return view('user_administrador.login_administrador');
        }
    }
}
/* 
|--------------------------------------------------------------------------
| Funciones para la registrar un docente
|--------------------------------------------------------------------------
*/
    public function registrar_docente(){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_admin==true){
                return view('user_administrador.registrar_docente');
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
    public function crear_docente(){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_admin==true){
                $data=request()->validate([
                    'name'=>'required',
                    'lastname'=>'required',
                    'email'=>'required|email|unique:users,email',
                    'password'=>'required'
                ],[
                    'name.required'=>'El campo nombre es obligatorio',
                    'lastname.required'=>'El campo apellido es obligatorio',
                    'email.required'=>'El campo email es obligatorio',
                    'email.unique'=>'El correo con el que intenta registrar docente, ya se encuentra registrado. Por favor intente nuevamente.',
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
                flash('Docente registrado correctamente')
                    ->success();
                return redirect()->route('docentes_registrados');
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
    public function registrar_docente_excel(Request $request){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_admin==true){
                $users = DB::table('users')->where('is_docente',true)->get();
                $materias = DB::table('materias')->get();
                $horarios=DB::table('horarios')->get();
                $horario2s=DB::table('horario2s')->get();
                $horario3s=DB::table('horario3s')->get();
                $horario4s=DB::table('horario4s')->get();
                $horario5s=DB::table('horario5s')->get();
                $archivo=$request->file('archivo');
                if($archivo==null){
                    flash('No ha seleccionado ningún documento. Por favor seleccione un documento e intente nuevamente.')
                        ->error()->important();
                    return redirect()->route('registrar_docente');
                }else{
                    $nombre_original=$archivo->getClientOriginalName();
                    $extension=$archivo->getClientOriginalExtension();
                    if($extension!='csv'){
                        flash('Solamente se acepta documentos con extensión csv. Por favor descargue la plantilla proporcionada e intente nuevamente.')
                            ->error()->important();
                        return redirect()->route('registrar_docente');
                    }
                    $r1=Storage::disk('archivos')->put($nombre_original,\File::get($archivo));
                    $ruta=storage_path('archivos')."/".$nombre_original;
                    if($r1){
                        foreach ($materias as $materia){
                            Materia::destroy($materia->id);
                        }
                        foreach ($horarios as $horario){
                            Horario::destroy($horario->id);
                        }
                        foreach ($horario2s as $horario){
                            Horario2::destroy($horario->id);
                        }
                        foreach ($horario3s as $horario){
                            Horario3::destroy($horario->id);
                        }
                        foreach ($horario4s as $horario){
                            Horario4::destroy($horario->id);
                        }
                        foreach ($horario5s as $horario){
                            Horario5::destroy($horario->id);
                        }
                        foreach ($users as $user){
                            User::destroy($user->id);
                        }
                        Excel::load($ruta,function($reader){
                            foreach ($reader->get() as $archivo) {
                                User::create([
                                    'name'=>$archivo->nombres,
                                    'lastname'=>$archivo->apellidos,
                                    'email'=>$archivo->correo,
                                    'password'=>bcrypt($archivo->clave),
                                    'is_admin'=>false,
                                    'is_docente'=>true,
                                    'is_estudiante'=>false,
                                    'paralelo'=>'NA',
                                    'ciclo'=>'NA'
                                ]);
                            }
                        });
                        flash('Docentes registrados correctamente desde documento excel.')
                            ->success()->important();
                        return redirect()->route('docentes_registrados');
                    }
                }
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para visualizar docentes registrados
|--------------------------------------------------------------------------
*/
    public function docentes_registrados(){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_admin==true){
                $users = DB::table('users')->where('is_docente',true)->get();
                return view('user_administrador.docentes_registrados',compact('users'));
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar datos de un docente
|--------------------------------------------------------------------------
*/
    public function editar_perfil_docente($id_docente){
        if (Auth::check()){
            $user = Auth::user();
            if($user->is_admin==true){
                $user_docente= DB::table('users')->where('id',$id_docente)->first();
                return view('user_administrador.editar_perfil_docente',['user_docente'=>$user_docente]);
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
    public function editar_docente(User $user){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                $data=request()->validate([
                    'name'=>'required',
                    'lastname'=>'required',
                    'password'=>''
                ]);
        
                if ($data["password"]!=null) {
                    $data["password"]=bcrypt($data['password']); 
                }else{
                    unset($data["password"]);
                }
                
                $user->update($data);
                flash("Perfil editado correctamente")->success();
                return redirect()->route('docentes_registrados');
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }

/* 
|--------------------------------------------------------------------------
| Funciones para la eliminar un docente
|--------------------------------------------------------------------------
*/
    public function eliminar_docente(User $user){
        if (Auth::check()){
            $user_auth = Auth::user();
            if($user_auth->is_admin==true){
                $verifica_materias = DB::table('materias')
                    ->where('usuario_id',$user->id)->exists();
                //Actualiza las materias que el docente a eliminar tiene asignadas
                if($verifica_materias){
                    $materias=Materia::where('usuario_id',$user->id)
                        ->orderBy('id','DESC')
                        ->get();
                    foreach ($materias as $materia) {
                        $materia["usuario_id"]=1;
                        $materia->update();
                    }
                }
                //Elimina horarios de tutoría que el docente a eliminar tiene asignados
                $verifica_horarios = DB::table('horarios')->where('usuario_id',$user->id)->exists();
                if($verifica_horarios){
                    $horarios=DB::table('horarios')->where('usuario_id',$user->id)->get();
                    foreach ($horarios as $horario){
                        Horario::destroy($horario->id);
                    }
                }
                $verifica_horarios2 = DB::table('horario2s')->where('usuario_id',$user->id)->exists();
                if($verifica_horarios2){
                    $horarios=DB::table('horario2s')->where('usuario_id',$user->id)->get();
                    foreach ($horarios as $horario){
                        Horario2::destroy($horario->id);
                    }
                }
                $verifica_horarios3 = DB::table('horario3s')->where('usuario_id',$user->id)->exists();
                if($verifica_horarios3){
                    $horarios=DB::table('horario3s')->where('usuario_id',$user->id)->get();
                    foreach ($horarios as $horario){
                        Horario3::destroy($horario->id);
                    }
                }
                $verifica_horarios4 = DB::table('horario4s')->where('usuario_id',$user->id)->exists();
                if($verifica_horarios4){
                    $horarios=DB::table('horario4s')->where('usuario_id',$user->id)->get();
                    foreach ($horarios as $horario){
                        Horario4::destroy($horario->id);
                    }
                }
                $verifica_horarios5 = DB::table('horario5s')->where('usuario_id',$user->id)->exists();
                if($verifica_horarios5){
                    $horarios=DB::table('horario5s')->where('usuario_id',$user->id)->get();
                    foreach ($horarios as $horario){
                        Horario5::destroy($horario->id);
                    }
                }
                $user->delete();
                flash("Docente eliminado correctamente")->success();
                return redirect()->route('docentes_registrados');
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para registrar materia
|--------------------------------------------------------------------------
*/
    public function registrar_materia(){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                $users = DB::table('users')->where('is_docente',true)->get();
                return view('user_administrador.registrar_materia',compact('users'));
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }    

    public function crear_materia(Request $request){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                $name=$request->input('name');
                $ciclo=$request->input('gender');
                $docente=$request->input('docente');
                $paralelo=$request->input('paralelo');
                $paralelo = implode(',', $paralelo);
                DB::table('materias')->insert([
                    'usuario_id'=>$docente,
                    'name'=>$name,
                    'ciclo'=>$ciclo,
                    'paralelo'=>$paralelo,            
                ]);
                flash('Materia registrada correctamente')
                    ->success();
                return redirect()->route('materias_registradas');
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }

    public function registrar_materia_excel(Request $request){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                $users = DB::table('materias')->get();
                foreach ($users as $user)
                {
                    Materia::destroy($user->id);
                }
                $archivo=$request->file('archivo');
                if($archivo==null){
                    flash('Error al cargar el documento excel. Intente nuevamente.')->error()->important();
                    return redirect()->route('materias_registradas');
                }else{
                    $nombre_original=$archivo->getClientOriginalName();
                    $extension=$archivo->getClientOriginalExtension();
                    $r1=Storage::disk('archivos')->put($nombre_original,\File::get($archivo));
                    $ruta=storage_path('archivos')."/".$nombre_original;

                    if($r1){
                        Excel::load($ruta,function($reader){
                            foreach ($reader->get() as $archivo) {
                                if($archivo->nombre != null && $archivo->ciclo != null && $archivo->id_docente != null && $archivo->paralelo != null){
                                    DB::table('materias')->insert([
                                        'name'=>$archivo->nombre,
                                        'ciclo'=>$archivo->ciclo,
                                        'usuario_id'=>$archivo->id_docente,
                                        'paralelo'=>$archivo->paralelo,
                                    ]);
                                }
                            }
                        });
                        flash('Materias registradas desde documento excel correctamente')->success()->important();
                        return redirect()->route('materias_registradas');
                    }
                }
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para visualizar materias registradas
|--------------------------------------------------------------------------
*/
    public function materias_registradas(){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                $aux=0;
                $materias=Materia::orderBy('id','DESC')->get();
                $users=DB::table('users')->where('is_docente',true)->get();
                return view('user_administrador.materias_registradas',compact('materias','users','aux'));
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para buscar una materia registrada por nombre, ciclo o paralelo
|--------------------------------------------------------------------------
*/
    public function buscar_materia(Request $request){
        $aux=1;
        $name = $request->get('name');
        $ciclo = $request->get('ciclo');
        $materias=Materia::orderBy('id','DESC')
            ->name($name)
            ->ciclo($ciclo)
            ->paginate(10);
        $users=DB::table('users')->where('is_docente',true)->get();
        return view('user_administrador.materias_registradas',compact('users','materias','aux'));
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar una materia registrada
|--------------------------------------------------------------------------
*/
    public function editar_materia(Materia $materia){
        $users=DB::table('users')->where('is_docente',true)->get();
        $paralelo=explode(',', $materia->paralelo);
        return view('user_administrador.editar_materia',compact('users','materia','paralelo'));
    }
    public function editando_materia(Materia $materia, Request $request){
        $data=request()->validate([
            'name'=>'required',
            'ciclo'=>'required',
            'usuario_id'=>'required',
            'paralelo'=>'required',
        ]);
        $paralelo = implode(',', $data["paralelo"]);
        $data["paralelo"]=$paralelo;
        $materia->update($data);
        flash('Materia editada correctamente')->success()->important();
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
/* 
|--------------------------------------------------------------------------
| Funciones para descargar plantillas excel (para registrar materia y docentes)
|--------------------------------------------------------------------------
*/
    public function descargar_plantilla($aux){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                if($aux==1){
                    if(!$this->downloadFile(app_path()."/Files/plantilla_materias.xlsx")){
                        return redirect()->back();
                    }
                }
                if($aux==2){
                    if(!$this->downloadFile(app_path()."/Files/docentes.csv")){
                        return redirect()->back();
                    }
                }
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }   
    public function downloadFile($archivo){
        if(is_file($archivo)){
            $finfo=finfo_open(FILEINFO_MIME_TYPE);
            $content_type=finfo_file($finfo,$archivo);
            finfo_close($finfo);
            $file_name=basename($archivo).PHP_EOL;
            $size=filesize($archivo);
            header("Content-Type:$content_type");
            header("Content-Disposition:attachment;filename=$file_name");
            header("Content-Transfer-Encoding:binary");
            header("Content-Length:$size");
            readfile($archivo);
            return true;
        }else{
            return false;
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para asignar horario de tutoría del docente
|--------------------------------------------------------------------------
*/
    public function asignar_horario_tutoria(){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                $users = DB::table('users')->where('is_docente',true)->get();
                return view('user_administrador.asignar_horario_tutoria',compact('users'));
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
    public function asignar_horario(User $user,Request $request){
        $dia=$request->input('dia');
        // ----------------------------- TARDE ----------------------------------// 
        if($dia==null){
            $dia=$request->input('tarde');
            // ----------------------------- TARDE DEL LUNES----------------------------------//
            $dia1=Str::startsWith($dia,'Lunes');
            if($dia1==true){
                $verifica_horarios=DB::table('horarios')->where('usuario_id',$user->id)->exists();
                if($verifica_horarios==true){
                    $horarios=DB::table('horarios')->where('usuario_id',$user->id)->first();
                    if($horarios->cont_tarde==1){
                        Alert::danger('Aviso: ')
                            ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                            ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                        return view('user_administrador.asignar_horario_docente',compact('user'));
                    }else{
                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                    }
                }else{
                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                }
            }else{
                // ----------------------------- TARDE DEL MARTES----------------------------------//
                $dia2=Str::startsWith($dia,'Martes');
                if($dia2==true){
                    $verifica_horarios=DB::table('horario2s')->where('usuario_id',$user->id)->exists();
                    if($verifica_horarios==true){
                        $horarios=DB::table('horario2s')->where('usuario_id',$user->id)->first();
                        if($horarios->cont_tarde==1){
                            Alert::danger('Aviso: ')
                                ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                                ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                            return view('user_administrador.asignar_horario_docente',compact('user'));
                        }else{
                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                        }
                    }else{
                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                    }
                }else{
                    // ----------------------------- TARDE DEL MIÉRCOLES----------------------------------//
                    $dia3=Str::startsWith($dia,'Miércoles');
                    if($dia3==true){
                        $verifica_horarios=DB::table('horario3s')->where('usuario_id',$user->id)->exists();
                        if($verifica_horarios==true){
                            $horarios=DB::table('horario3s')->where('usuario_id',$user->id)->first();
                            if($horarios->cont_tarde==1){
                                Alert::danger('Aviso: ')
                                    ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                                    ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                                return view('user_administrador.asignar_horario_docente',compact('user'));
                            }else{
                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                            }
                        }else{
                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                        }
                    }else{
                        // ----------------------------- TARDE DEL JUEVES----------------------------------//
                        $dia4=Str::startsWith($dia,'Jueves');
                        if($dia4==true){
                            $verifica_horarios=DB::table('horario4s')->where('usuario_id',$user->id)->exists();
                            if($verifica_horarios==true){
                                $horarios=DB::table('horario4s')->where('usuario_id',$user->id)->first();
                                if($horarios->cont_tarde==1){
                                    Alert::danger('Aviso: ')
                                        ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                                        ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                                    return view('user_administrador.asignar_horario_docente',compact('user'));
                                }else{
                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                }
                            }else{
                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                            }
                        }else{
                            // ----------------------------- TARDE DEL VIERNES----------------------------------//
                            $dia5=Str::startsWith($dia,'Viernes');
                            if($dia5==true){
                                $verifica_horarios=DB::table('horario5s')->where('usuario_id',$user->id)->exists();
                                if($verifica_horarios==true){
                                    $horarios=DB::table('horario5s')->where('usuario_id',$user->id)->first();
                                    if($horarios->cont_tarde==1){
                                        Alert::danger('Aviso: ')
                                            ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                                            ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                                        return view('user_administrador.asignar_horario_docente',compact('user'));
                                    }else{
                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                    }
                                }else{
                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                }
                            }
                        }
                    }
                }
            }
        // ----------------------------- MAÑANA ----------------------------------//
        }else{
            // ----------------------------- MAÑANA DEL LUNES----------------------------------//
            $dia1=Str::startsWith($dia,'Lunes');
            if($dia1==true){
                $verifica_horarios=DB::table('horarios')->where('usuario_id',$user->id)->exists();
                if($verifica_horarios==true){
                    $horarios=DB::table('horarios')->where('usuario_id',$user->id)->first();
                    if($horarios->cont_dia==2){
                        Alert::danger('Aviso: ')
                            ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                            ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                            return view('user_administrador.asignar_horario_docente',compact('user'));
                    }else{
                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                    }
                }else{
                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                }
            }else{
                // ----------------------------- MAÑANA DEL MARTES----------------------------------//
                $dia2=Str::startsWith($dia,'Martes');
                if($dia2==true){
                    $verifica_horarios=DB::table('horario2s')->where('usuario_id',$user->id)->exists();
                    if($verifica_horarios==true){
                        $horarios=DB::table('horario2s')->where('usuario_id',$user->id)->first();
                        if($horarios->cont_dia==2){
                            Alert::danger('Aviso: ')
                                ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                                ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                            return view('user_administrador.asignar_horario_docente',compact('user'));
                        }else{
                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                        }
                    }else{
                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                    }
                }else{
                    // ----------------------------- MAÑANA DEL MIÉRCOLES----------------------------------//
                    $dia3=Str::startsWith($dia,'Miércoles');
                    if($dia3==true){
                        $verifica_horarios=DB::table('horario3s')->where('usuario_id',$user->id)->exists();
                        if($verifica_horarios==true){
                            $horarios=DB::table('horario3s')->where('usuario_id',$user->id)->first();
                            if($horarios->cont_dia==2){
                                Alert::danger('Aviso: ')
                                    ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                                    ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                                return view('user_administrador.asignar_horario_docente',compact('user'));
                            }else{
                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                            }
                        }else{
                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                        }
                    }else{
                        // ----------------------------- MAÑANA DEL JUEVES----------------------------------//
                        $dia4=Str::startsWith($dia,'Jueves');
                        if($dia4==true){
                            $verifica_horarios=DB::table('horario4s')->where('usuario_id',$user->id)->exists();
                            if($verifica_horarios==true){
                                $horarios=DB::table('horario4s')->where('usuario_id',$user->id)->first();
                                if($horarios->cont_dia==2){
                                    Alert::danger('Aviso: ')
                                        ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                                        ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                                    return view('user_administrador.asignar_horario_docente',compact('user'));
                                }else{
                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                }
                            }else{
                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                            }
                        }else{
                            // ----------------------------- MAÑANA DEL VIERNES----------------------------------//
                            $dia5=Str::startsWith($dia,'Viernes');
                            if($dia5==true){
                                $verifica_horarios=DB::table('horario5s')->where('usuario_id',$user->id)->exists();
                                if($verifica_horarios==true){
                                    $horarios=DB::table('horario5s')->where('usuario_id',$user->id)->first();
                                    if($horarios->cont_dia==2){
                                        Alert::danger('Aviso: ')
                                            ->details("El docente '{$user->name} {$user->lastname}' ya tiene asignados horarios de tutoría para el día '{$dia}'.")
                                            ->html("<a href='../horario_tutoria_asignada_op2/{$user->id}' id='borde_radio' class='btn btn-sm btn-outline-danger'>Ver Horario</a>");
                                        return view('user_administrador.asignar_horario_docente',compact('user'));
                                    }else{
                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                    }
                                }else{
                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function asignar_horario_docente(User $user){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                return view('user_administrador.asignar_horario_docente',compact('user'));
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }

    public function asignar_horario_btn_docente(User $user, Request $request){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                $dia=$request->input('dia');
                $docente=$user->id;
                $hora_inicio=$request->input('hora_inicio1');
                $hora_fin=$request->input('hora_fin1');
                $minutos_inicio=$request->input('minutos_inicio1');
                $minutos_fin=$request->input('minutos_fin1');
                $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
                $horario2s=DB::table('horario2s')->where('usuario_id',$docente)->first();
                $horario3s=DB::table('horario3s')->where('usuario_id',$docente)->first();
                $horario4s=DB::table('horario4s')->where('usuario_id',$docente)->first();
                $horario5s=DB::table('horario5s')->where('usuario_id',$docente)->first();
                $dia1=Str::startsWith($dia,'Lunes');
                if($dia1==true){
                    $verifica_horarios=DB::table('horarios')->where('usuario_id',$user->id)->exists();
                    //------------------------------------------------------------------------------------- 1
                    if($verifica_horarios==true){
                        $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
                        if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                            $id=$horarios->id;
                            $var1=$horarios->dia1_op3;
                            $var2=$horarios->hora_inicio_op3;
                            $var3=$horarios->minutos_inicio_op3;
                            $var4=$horarios->hora_fin_op3;
                            $var5=$horarios->minutos_fin_op3;
                            Horario::destroy($horarios->id);
                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                            }else{
                                DB::table('horarios')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia1_op1'=>$dia,
                                    'hora_inicio_op1'=>$hora_inicio,
                                    'minutos_inicio_op1'=>$minutos_inicio,
                                    'hora_fin_op1'=>$hora_fin,
                                    'minutos_fin_op1'=>$minutos_fin,
                                    
                                    'dia1_op3'=>$var1,
                                    'hora_inicio_op3'=>$var2,
                                    'minutos_inicio_op3'=>$var3,
                                    'hora_fin_op3'=>$var4,
                                    'minutos_fin_op3'=>$var5,
                                    'cont_dia'=>1,
                                    'cont_tarde'=>1,
                                ]);
                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                            }
                        }else{
                            if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                                $id=$horarios->id;
                                $var1=$horarios->dia1_op1;
                                $var2=$horarios->hora_inicio_op1;
                                $var3=$horarios->minutos_inicio_op1;
                                $var4=$horarios->hora_fin_op1;
                                $var5=$horarios->minutos_fin_op1;
                                Horario::destroy($horarios->id);
                                $tarde=Str::endsWith($dia,'tarde');
                                if($tarde==true){
                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                    }else{
                                        DB::table('horarios')->insert([
                                            'id'=>$id,
                                            'usuario_id'=>$docente,
                                            'dia1_op1'=>$var1,
                                            'hora_inicio_op1'=>$var2,
                                            'minutos_inicio_op1'=>$var3,
                                            'hora_fin_op1'=>$var4,
                                            'minutos_fin_op1'=>$var5,
                
                                            'dia1_op3'=>$dia,
                                            'hora_inicio_op3'=>$hora_inicio,
                                            'minutos_inicio_op3'=>$minutos_inicio,
                                            'hora_fin_op3'=>$hora_fin,
                                            'minutos_fin_op3'=>$minutos_fin,
                                            'cont_dia'=>1,
                                            'cont_tarde'=>1
                                        ]);
                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);   
                                    }
                                }else{
                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                    }else{
                                        DB::table('horarios')->insert([
                                            'id'=>$id,
                                            'usuario_id'=>$docente,
                                            'dia1_op1'=>$var1,
                                            'hora_inicio_op1'=>$var2,
                                            'minutos_inicio_op1'=>$var3,
                                            'hora_fin_op1'=>$var4,
                                            'minutos_fin_op1'=>$var5,
                
                                            'dia1_op2'=>$dia,
                                            'hora_inicio_op2'=>$hora_inicio,
                                            'minutos_inicio_op2'=>$minutos_inicio,
                                            'hora_fin_op2'=>$hora_fin,
                                            'minutos_fin_op2'=>$minutos_fin,
                                            'cont_dia'=>2,
                                            'cont_tarde'=>0
                                        ]);
                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);    
                                    }
                                }
                            }else{
                                if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                                    $id=$horarios->id;
                                    $var1=$horarios->dia1_op1;
                                    $var2=$horarios->hora_inicio_op1;
                                    $var3=$horarios->minutos_inicio_op1;
                                    $var4=$horarios->hora_fin_op1;
                                    $var5=$horarios->minutos_fin_op1;
                                    $var6=$horarios->dia1_op2;
                                    $var7=$horarios->hora_inicio_op2;
                                    $var8=$horarios->minutos_inicio_op2;
                                    $var9=$horarios->hora_fin_op2;
                                    $var10=$horarios->minutos_fin_op2;
                                    Horario::destroy($horarios->id);
                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                    }else{
                                        DB::table('horarios')->insert([
                                            'id'=>$id,
                                            'usuario_id'=>$docente,
                                            'dia1_op1'=>$var1,
                                            'hora_inicio_op1'=>$var2,
                                            'minutos_inicio_op1'=>$var3,
                                            'hora_fin_op1'=>$var4,
                                            'minutos_fin_op1'=>$var5,

                                            'dia1_op2'=>$var6,
                                            'hora_inicio_op2'=>$var7,
                                            'minutos_inicio_op2'=>$var8,
                                            'hora_fin_op2'=>$var9,
                                            'minutos_fin_op2'=>$var10,

                                            'dia1_op3'=>$dia,
                                            'hora_inicio_op3'=>$hora_inicio,
                                            'minutos_inicio_op3'=>$minutos_inicio,
                                            'hora_fin_op3'=>$hora_fin,
                                            'minutos_fin_op3'=>$minutos_fin,
                                            'cont_dia'=>2,
                                            'cont_tarde'=>1
                                        ]);
                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);  
                                    }
                                }else{
                                    if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                                        $id=$horarios->id;
                                        $var1=$horarios->dia1_op1;
                                        $var2=$horarios->hora_inicio_op1;
                                        $var3=$horarios->minutos_inicio_op1;
                                        $var4=$horarios->hora_fin_op1;
                                        $var5=$horarios->minutos_fin_op1;
                                        $var6=$horarios->dia1_op3;
                                        $var7=$horarios->hora_inicio_op3;
                                        $var8=$horarios->minutos_inicio_op3;
                                        $var9=$horarios->hora_fin_op3;
                                        $var10=$horarios->minutos_fin_op3;
                                        Horario::destroy($horarios->id);
                                        if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                            flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                        }else{
                                            DB::table('horarios')->insert([
                                                'id'=>$id,
                                                'usuario_id'=>$docente,
                                                'dia1_op1'=>$var1,
                                                'hora_inicio_op1'=>$var2,
                                                'minutos_inicio_op1'=>$var3,
                                                'hora_fin_op1'=>$var4,
                                                'minutos_fin_op1'=>$var5,

                                                'dia1_op2'=>$dia,
                                                'hora_inicio_op2'=>$hora_inicio,
                                                'minutos_inicio_op2'=>$minutos_inicio,
                                                'hora_fin_op2'=>$hora_fin,
                                                'minutos_fin_op2'=>$minutos_fin,
                                                
                                                'dia1_op3'=>$var6,
                                                'hora_inicio_op3'=>$var7,
                                                'minutos_inicio_op3'=>$var8,
                                                'hora_fin_op3'=>$var9,
                                                'minutos_fin_op3'=>$var10,

                                                'cont_dia'=>2,
                                                'cont_tarde'=>1
                                            ]);
                                            return redirect()->route('horario_tutoria_asignada',['user'=>$user]);   
                                        }
                                    }
                                }
                            }
                        }
                    // registra horario de tutoria el primero que haga ya sea lunes o tarde, cuando no existe ningun registro en la BD    
                    }else{
                        $tarde=Str::endsWith($dia,'tarde');
                        if($tarde==true){
                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                            }else{
                                DB::table('horarios')->insert([
                                    'usuario_id'=>$docente,
                                    'dia1_op3'=>$dia,
                                    'hora_inicio_op3'=>$hora_inicio,
                                    'minutos_inicio_op3'=>$minutos_inicio,
                                    'hora_fin_op3'=>$hora_fin,
                                    'minutos_fin_op3'=>$minutos_fin,
                                    'cont_dia'=>0,
                                    'cont_tarde'=>1,
                                ]);
                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                            }
                        }else{
                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                            }else{
                                DB::table('horarios')->insert([
                                    'usuario_id'=>$docente,
                                    'dia1_op1'=>$dia,
                                    'hora_inicio_op1'=>$hora_inicio,
                                    'minutos_inicio_op1'=>$minutos_inicio,
                                    'hora_fin_op1'=>$hora_fin,
                                    'minutos_fin_op1'=>$minutos_fin,
                                    'cont_dia'=>1,
                                    'cont_tarde'=>0
                                ]); 
                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);   
                            }
                        }
                    }
                }else{
                    $dia2=Str::startsWith($dia,'Martes');
                    if($dia2==true){
                        $verifica_horarios=DB::table('horario2s')->where('usuario_id',$user->id)->exists();
                        //------------------------------------------------------------------------------------- 2
                        if($verifica_horarios==true){
                            $horarios=DB::table('horario2s')->where('usuario_id',$docente)->first();
                            if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                                $id=$horarios->id;
                                $var1=$horarios->dia2_op3;
                                $var2=$horarios->hora_inicio_op3;
                                $var3=$horarios->minutos_inicio_op3;
                                $var4=$horarios->hora_fin_op3;
                                $var5=$horarios->minutos_fin_op3;
                                Horario2::destroy($horarios->id);
                                if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                    flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                }else{
                                    DB::table('horario2s')->insert([
                                        'id'=>$id,
                                        'usuario_id'=>$docente,
                                        'dia2_op1'=>$dia,
                                        'hora_inicio_op1'=>$hora_inicio,
                                        'minutos_inicio_op1'=>$minutos_inicio,
                                        'hora_fin_op1'=>$hora_fin,
                                        'minutos_fin_op1'=>$minutos_fin,
                                        
                                        'dia2_op3'=>$var1,
                                        'hora_inicio_op3'=>$var2,
                                        'minutos_inicio_op3'=>$var3,
                                        'hora_fin_op3'=>$var4,
                                        'minutos_fin_op3'=>$var5,
                                        'cont_dia'=>1,
                                        'cont_tarde'=>1,
                                    ]);
                                    flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                    return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                                }
                            }else{
                                if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                                    $id=$horarios->id;
                                    $var1=$horarios->dia2_op1;
                                    $var2=$horarios->hora_inicio_op1;
                                    $var3=$horarios->minutos_inicio_op1;
                                    $var4=$horarios->hora_fin_op1;
                                    $var5=$horarios->minutos_fin_op1;
                                    Horario2::destroy($horarios->id);
                                    $tarde=Str::endsWith($dia,'tarde');
                                    if($tarde==true){
                                        if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                            flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                        }else{
                                            DB::table('horario2s')->insert([
                                                'id'=>$id,
                                                'usuario_id'=>$docente,
                                                'dia2_op1'=>$var1,
                                                'hora_inicio_op1'=>$var2,
                                                'minutos_inicio_op1'=>$var3,
                                                'hora_fin_op1'=>$var4,
                                                'minutos_fin_op1'=>$var5,
                    
                                                'dia2_op3'=>$dia,
                                                'hora_inicio_op3'=>$hora_inicio,
                                                'minutos_inicio_op3'=>$minutos_inicio,
                                                'hora_fin_op3'=>$hora_fin,
                                                'minutos_fin_op3'=>$minutos_fin,
                                                'cont_dia'=>1,
                                                'cont_tarde'=>1
                                            ]);
                                            flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                            return redirect()->route('horario_tutoria_asignada',['user'=>$user]);     
                                        }
                                    }else{
                                        if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                            flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                        }else{
                                            DB::table('horario2s')->insert([
                                                'id'=>$id,
                                                'usuario_id'=>$docente,
                                                'dia2_op1'=>$var1,
                                                'hora_inicio_op1'=>$var2,
                                                'minutos_inicio_op1'=>$var3,
                                                'hora_fin_op1'=>$var4,
                                                'minutos_fin_op1'=>$var5,
                    
                                                'dia2_op2'=>$dia,
                                                'hora_inicio_op2'=>$hora_inicio,
                                                'minutos_inicio_op2'=>$minutos_inicio,
                                                'hora_fin_op2'=>$hora_fin,
                                                'minutos_fin_op2'=>$minutos_fin,
                                                'cont_dia'=>2,
                                                'cont_tarde'=>0
                                            ]);
                                            flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                            return redirect()->route('horario_tutoria_asignada',['user'=>$user]);  
                                        }
                                    }
                                }else{
                                    if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                                        $id=$horarios->id;
                                        $var1=$horarios->dia2_op1;
                                        $var2=$horarios->hora_inicio_op1;
                                        $var3=$horarios->minutos_inicio_op1;
                                        $var4=$horarios->hora_fin_op1;
                                        $var5=$horarios->minutos_fin_op1;
                                        $var6=$horarios->dia2_op2;
                                        $var7=$horarios->hora_inicio_op2;
                                        $var8=$horarios->minutos_inicio_op2;
                                        $var9=$horarios->hora_fin_op2;
                                        $var10=$horarios->minutos_fin_op2;
                                        Horario2::destroy($horarios->id);
                                        if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                            flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                        }else{
                                            DB::table('horario2s')->insert([
                                                'id'=>$id,
                                                'usuario_id'=>$docente,
                                                'dia2_op1'=>$var1,
                                                'hora_inicio_op1'=>$var2,
                                                'minutos_inicio_op1'=>$var3,
                                                'hora_fin_op1'=>$var4,
                                                'minutos_fin_op1'=>$var5,

                                                'dia2_op2'=>$var6,
                                                'hora_inicio_op2'=>$var7,
                                                'minutos_inicio_op2'=>$var8,
                                                'hora_fin_op2'=>$var9,
                                                'minutos_fin_op2'=>$var10,

                                                'dia2_op3'=>$dia,
                                                'hora_inicio_op3'=>$hora_inicio,
                                                'minutos_inicio_op3'=>$minutos_inicio,
                                                'hora_fin_op3'=>$hora_fin,
                                                'minutos_fin_op3'=>$minutos_fin,
                                                'cont_dia'=>2,
                                                'cont_tarde'=>1
                                            ]);
                                            flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                            return redirect()->route('horario_tutoria_asignada',['user'=>$user]);   
                                        }
                                    }else{
                                        if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                                            $id=$horarios->id;
                                            $var1=$horarios->dia2_op1;
                                            $var2=$horarios->hora_inicio_op1;
                                            $var3=$horarios->minutos_inicio_op1;
                                            $var4=$horarios->hora_fin_op1;
                                            $var5=$horarios->minutos_fin_op1;
                                            $var6=$horarios->dia2_op3;
                                            $var7=$horarios->hora_inicio_op3;
                                            $var8=$horarios->minutos_inicio_op3;
                                            $var9=$horarios->hora_fin_op3;
                                            $var10=$horarios->minutos_fin_op3;
                                            Horario2::destroy($horarios->id);
                                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                            }else{
                                                DB::table('horario2s')->insert([
                                                    'id'=>$id,
                                                    'usuario_id'=>$docente,
                                                    'dia2_op1'=>$var1,
                                                    'hora_inicio_op1'=>$var2,
                                                    'minutos_inicio_op1'=>$var3,
                                                    'hora_fin_op1'=>$var4,
                                                    'minutos_fin_op1'=>$var5,

                                                    'dia2_op2'=>$dia,
                                                    'hora_inicio_op2'=>$hora_inicio,
                                                    'minutos_inicio_op2'=>$minutos_inicio,
                                                    'hora_fin_op2'=>$hora_fin,
                                                    'minutos_fin_op2'=>$minutos_fin,
                                                    
                                                    'dia2_op3'=>$var6,
                                                    'hora_inicio_op3'=>$var7,
                                                    'minutos_inicio_op3'=>$var8,
                                                    'hora_fin_op3'=>$var9,
                                                    'minutos_fin_op3'=>$var10,

                                                    'cont_dia'=>2,
                                                    'cont_tarde'=>1
                                                ]);
                                                flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);     
                                            }
                                        }
                                    }
                                }
                            }
                        // registra horario de tutoria el primero que haga ya sea lunes o tarde, cuando no existe ningun registro en la BD    
                        }else{
                            $tarde=Str::endsWith($dia,'tarde');
                            if($tarde==true){
                                if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                    flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                }else{
                                    DB::table('horario2s')->insert([
                                        'usuario_id'=>$docente,
                                        'dia2_op3'=>$dia,
                                        'hora_inicio_op3'=>$hora_inicio,
                                        'minutos_inicio_op3'=>$minutos_inicio,
                                        'hora_fin_op3'=>$hora_fin,
                                        'minutos_fin_op3'=>$minutos_fin,
                                        'cont_dia'=>0,
                                        'cont_tarde'=>1,
                                    ]);
                                    flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                    return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                                }
                            }else{
                                if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                    flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                }else{
                                    DB::table('horario2s')->insert([
                                        'usuario_id'=>$docente,
                                        'dia2_op1'=>$dia,
                                        'hora_inicio_op1'=>$hora_inicio,
                                        'minutos_inicio_op1'=>$minutos_inicio,
                                        'hora_fin_op1'=>$hora_fin,
                                        'minutos_fin_op1'=>$minutos_fin,
                                        'cont_dia'=>1,
                                        'cont_tarde'=>0
                                    ]);
                                    flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                    return redirect()->route('horario_tutoria_asignada',['user'=>$user]);    
                                }
                            }
                        }
                    }else{
                        $dia3=Str::startsWith($dia,'Miércoles');
                        if($dia3==true){
                            $verifica_horarios=DB::table('horario3s')->where('usuario_id',$user->id)->exists();
                            //------------------------------------------------------------------------------------- 3
                            if($verifica_horarios==true){
                                $horarios=DB::table('horario3s')->where('usuario_id',$docente)->first();
                                if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                                    $id=$horarios->id;
                                    $var1=$horarios->dia3_op3;
                                    $var2=$horarios->hora_inicio_op3;
                                    $var3=$horarios->minutos_inicio_op3;
                                    $var4=$horarios->hora_fin_op3;
                                    $var5=$horarios->minutos_fin_op3;
                                    Horario3::destroy($horarios->id);
                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                    }else{
                                        DB::table('horario3s')->insert([
                                            'id'=>$id,
                                            'usuario_id'=>$docente,
                                            'dia3_op1'=>$dia,
                                            'hora_inicio_op1'=>$hora_inicio,
                                            'minutos_inicio_op1'=>$minutos_inicio,
                                            'hora_fin_op1'=>$hora_fin,
                                            'minutos_fin_op1'=>$minutos_fin,
                                            
                                            'dia3_op3'=>$var1,
                                            'hora_inicio_op3'=>$var2,
                                            'minutos_inicio_op3'=>$var3,
                                            'hora_fin_op3'=>$var4,
                                            'minutos_fin_op3'=>$var5,
                                            'cont_dia'=>1,
                                            'cont_tarde'=>1,
                                        ]);
                                        flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                                    }
                                }else{
                                    if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                                        $id=$horarios->id;
                                        $var1=$horarios->dia3_op1;
                                        $var2=$horarios->hora_inicio_op1;
                                        $var3=$horarios->minutos_inicio_op1;
                                        $var4=$horarios->hora_fin_op1;
                                        $var5=$horarios->minutos_fin_op1;
                                        Horario3::destroy($horarios->id);
                                        $tarde=Str::endsWith($dia,'tarde');
                                        if($tarde==true){
                                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                            }else{
                                                DB::table('horario3s')->insert([
                                                    'id'=>$id,
                                                    'usuario_id'=>$docente,
                                                    'dia3_op1'=>$var1,
                                                    'hora_inicio_op1'=>$var2,
                                                    'minutos_inicio_op1'=>$var3,
                                                    'hora_fin_op1'=>$var4,
                                                    'minutos_fin_op1'=>$var5,
                        
                                                    'dia3_op3'=>$dia,
                                                    'hora_inicio_op3'=>$hora_inicio,
                                                    'minutos_inicio_op3'=>$minutos_inicio,
                                                    'hora_fin_op3'=>$hora_fin,
                                                    'minutos_fin_op3'=>$minutos_fin,
                                                    'cont_dia'=>1,
                                                    'cont_tarde'=>1
                                                ]);
                                                flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);    
                                            }
                                        }else{
                                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                            }else{
                                                DB::table('horario3s')->insert([
                                                    'id'=>$id,
                                                    'usuario_id'=>$docente,
                                                    'dia3_op1'=>$var1,
                                                    'hora_inicio_op1'=>$var2,
                                                    'minutos_inicio_op1'=>$var3,
                                                    'hora_fin_op1'=>$var4,
                                                    'minutos_fin_op1'=>$var5,
                        
                                                    'dia3_op2'=>$dia,
                                                    'hora_inicio_op2'=>$hora_inicio,
                                                    'minutos_inicio_op2'=>$minutos_inicio,
                                                    'hora_fin_op2'=>$hora_fin,
                                                    'minutos_fin_op2'=>$minutos_fin,
                                                    'cont_dia'=>2,
                                                    'cont_tarde'=>0
                                                ]);
                                                Alert::success('¡Bien hecho! ')
                                                    ->details('Se ha asignado correctamente el horario de tutoría al docente ')
                                                    ->html("{$user->name} {$user->lastname}");
                                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);     
                                            }
                                        }
                                    }else{
                                        if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                                            $id=$horarios->id;
                                            $var1=$horarios->dia3_op1;
                                            $var2=$horarios->hora_inicio_op1;
                                            $var3=$horarios->minutos_inicio_op1;
                                            $var4=$horarios->hora_fin_op1;
                                            $var5=$horarios->minutos_fin_op1;
                                            $var6=$horarios->dia3_op2;
                                            $var7=$horarios->hora_inicio_op2;
                                            $var8=$horarios->minutos_inicio_op2;
                                            $var9=$horarios->hora_fin_op2;
                                            $var10=$horarios->minutos_fin_op2;
                                            Horario3::destroy($horarios->id);
                                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                            }else{
                                                DB::table('horario3s')->insert([
                                                    'id'=>$id,
                                                    'usuario_id'=>$docente,
                                                    'dia3_op1'=>$var1,
                                                    'hora_inicio_op1'=>$var2,
                                                    'minutos_inicio_op1'=>$var3,
                                                    'hora_fin_op1'=>$var4,
                                                    'minutos_fin_op1'=>$var5,

                                                    'dia3_op2'=>$var6,
                                                    'hora_inicio_op2'=>$var7,
                                                    'minutos_inicio_op2'=>$var8,
                                                    'hora_fin_op2'=>$var9,
                                                    'minutos_fin_op2'=>$var10,

                                                    'dia3_op3'=>$dia,
                                                    'hora_inicio_op3'=>$hora_inicio,
                                                    'minutos_inicio_op3'=>$minutos_inicio,
                                                    'hora_fin_op3'=>$hora_fin,
                                                    'minutos_fin_op3'=>$minutos_fin,
                                                    'cont_dia'=>2,
                                                    'cont_tarde'=>1
                                                ]);
                                                flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);     
                                            }
                                        }else{
                                            if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                                                $id=$horarios->id;
                                                $var1=$horarios->dia3_op1;
                                                $var2=$horarios->hora_inicio_op1;
                                                $var3=$horarios->minutos_inicio_op1;
                                                $var4=$horarios->hora_fin_op1;
                                                $var5=$horarios->minutos_fin_op1;
                                                $var6=$horarios->dia3_op3;
                                                $var7=$horarios->hora_inicio_op3;
                                                $var8=$horarios->minutos_inicio_op3;
                                                $var9=$horarios->hora_fin_op3;
                                                $var10=$horarios->minutos_fin_op3;
                                                Horario3::destroy($horarios->id);
                                                if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                    flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                                }else{
                                                    DB::table('horario3s')->insert([
                                                        'id'=>$id,
                                                        'usuario_id'=>$docente,
                                                        'dia3_op1'=>$var1,
                                                        'hora_inicio_op1'=>$var2,
                                                        'minutos_inicio_op1'=>$var3,
                                                        'hora_fin_op1'=>$var4,
                                                        'minutos_fin_op1'=>$var5,

                                                        'dia3_op2'=>$dia,
                                                        'hora_inicio_op2'=>$hora_inicio,
                                                        'minutos_inicio_op2'=>$minutos_inicio,
                                                        'hora_fin_op2'=>$hora_fin,
                                                        'minutos_fin_op2'=>$minutos_fin,
                                                        
                                                        'dia3_op3'=>$var6,
                                                        'hora_inicio_op3'=>$var7,
                                                        'minutos_inicio_op3'=>$var8,
                                                        'hora_fin_op3'=>$var9,
                                                        'minutos_fin_op3'=>$var10,

                                                        'cont_dia'=>2,
                                                        'cont_tarde'=>1
                                                    ]);
                                                    flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                    return redirect()->route('horario_tutoria_asignada',['user'=>$user]);     
                                                }
                                            }
                                        }
                                    }
                                }
                            // registra horario de tutoria el primero que haga ya sea lunes o tarde, cuando no existe ningun registro en la BD    
                            }else{
                                $tarde=Str::endsWith($dia,'tarde');
                                if($tarde==true){
                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                    }else{
                                        DB::table('horario3s')->insert([
                                            'usuario_id'=>$docente,
                                            'dia3_op3'=>$dia,
                                            'hora_inicio_op3'=>$hora_inicio,
                                            'minutos_inicio_op3'=>$minutos_inicio,
                                            'hora_fin_op3'=>$hora_fin,
                                            'minutos_fin_op3'=>$minutos_fin,
                                            'cont_dia'=>0,
                                            'cont_tarde'=>1,
                                        ]);
                                        flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                                    }
                                }else{
                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                    }else{
                                        DB::table('horario3s')->insert([
                                            'usuario_id'=>$docente,
                                            'dia3_op1'=>$dia,
                                            'hora_inicio_op1'=>$hora_inicio,
                                            'minutos_inicio_op1'=>$minutos_inicio,
                                            'hora_fin_op1'=>$hora_fin,
                                            'minutos_fin_op1'=>$minutos_fin,
                                            'cont_dia'=>1,
                                            'cont_tarde'=>0
                                        ]);
                                        flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);   
                                    }
                                }
                            }
                        }else{
                            $dia4=Str::startsWith($dia,'Jueves');
                            if($dia4==true){
                                $verifica_horarios=DB::table('horario4s')->where('usuario_id',$user->id)->exists();
                                //------------------------------------------------------------------------------------- 4
                                if($verifica_horarios==true){
                                    $horarios=DB::table('horario4s')->where('usuario_id',$docente)->first();
                                    if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                                        $id=$horarios->id;
                                        $var1=$horarios->dia4_op3;
                                        $var2=$horarios->hora_inicio_op3;
                                        $var3=$horarios->minutos_inicio_op3;
                                        $var4=$horarios->hora_fin_op3;
                                        $var5=$horarios->minutos_fin_op3;
                                        Horario4::destroy($horarios->id);
                                        if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                            flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                        }else{
                                            DB::table('horario4s')->insert([
                                                'id'=>$id,
                                                'usuario_id'=>$docente,
                                                'dia4_op1'=>$dia,
                                                'hora_inicio_op1'=>$hora_inicio,
                                                'minutos_inicio_op1'=>$minutos_inicio,
                                                'hora_fin_op1'=>$hora_fin,
                                                'minutos_fin_op1'=>$minutos_fin,
                                                
                                                'dia4_op3'=>$var1,
                                                'hora_inicio_op3'=>$var2,
                                                'minutos_inicio_op3'=>$var3,
                                                'hora_fin_op3'=>$var4,
                                                'minutos_fin_op3'=>$var5,
                                                'cont_dia'=>1,
                                                'cont_tarde'=>1,
                                            ]);
                                            flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                            return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                                        }
                                    }else{
                                        if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                                            $id=$horarios->id;
                                            $var1=$horarios->dia4_op1;
                                            $var2=$horarios->hora_inicio_op1;
                                            $var3=$horarios->minutos_inicio_op1;
                                            $var4=$horarios->hora_fin_op1;
                                            $var5=$horarios->minutos_fin_op1;
                                            Horario4::destroy($horarios->id);
                                            $tarde=Str::endsWith($dia,'tarde');
                                            if($tarde==true){
                                                if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                    flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                                }else{
                                                    DB::table('horario4s')->insert([
                                                        'id'=>$id,
                                                        'usuario_id'=>$docente,
                                                        'dia4_op1'=>$var1,
                                                        'hora_inicio_op1'=>$var2,
                                                        'minutos_inicio_op1'=>$var3,
                                                        'hora_fin_op1'=>$var4,
                                                        'minutos_fin_op1'=>$var5,
                            
                                                        'dia4_op3'=>$dia,
                                                        'hora_inicio_op3'=>$hora_inicio,
                                                        'minutos_inicio_op3'=>$minutos_inicio,
                                                        'hora_fin_op3'=>$hora_fin,
                                                        'minutos_fin_op3'=>$minutos_fin,
                                                        'cont_dia'=>1,
                                                        'cont_tarde'=>1
                                                    ]);
                                                    flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                    return redirect()->route('horario_tutoria_asignada',['user'=>$user]);    
                                                }
                                            }else{
                                                if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                    flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                                }else{
                                                    DB::table('horario4s')->insert([
                                                        'id'=>$id,
                                                        'usuario_id'=>$docente,
                                                        'dia4_op1'=>$var1,
                                                        'hora_inicio_op1'=>$var2,
                                                        'minutos_inicio_op1'=>$var3,
                                                        'hora_fin_op1'=>$var4,
                                                        'minutos_fin_op1'=>$var5,
                            
                                                        'dia4_op2'=>$dia,
                                                        'hora_inicio_op2'=>$hora_inicio,
                                                        'minutos_inicio_op2'=>$minutos_inicio,
                                                        'hora_fin_op2'=>$hora_fin,
                                                        'minutos_fin_op2'=>$minutos_fin,
                                                        'cont_dia'=>2,
                                                        'cont_tarde'=>0
                                                    ]);
                                                    flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                    return redirect()->route('horario_tutoria_asignada',['user'=>$user]);    
                                                }
                                            }
                                        }else{
                                            if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                                                $id=$horarios->id;
                                                $var1=$horarios->dia4_op1;
                                                $var2=$horarios->hora_inicio_op1;
                                                $var3=$horarios->minutos_inicio_op1;
                                                $var4=$horarios->hora_fin_op1;
                                                $var5=$horarios->minutos_fin_op1;
                                                $var6=$horarios->dia4_op2;
                                                $var7=$horarios->hora_inicio_op2;
                                                $var8=$horarios->minutos_inicio_op2;
                                                $var9=$horarios->hora_fin_op2;
                                                $var10=$horarios->minutos_fin_op2;
                                                Horario4::destroy($horarios->id);
                                                if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                    flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                    return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                                }else{
                                                    DB::table('horario4s')->insert([
                                                        'id'=>$id,
                                                        'usuario_id'=>$docente,
                                                        'dia4_op1'=>$var1,
                                                        'hora_inicio_op1'=>$var2,
                                                        'minutos_inicio_op1'=>$var3,
                                                        'hora_fin_op1'=>$var4,
                                                        'minutos_fin_op1'=>$var5,

                                                        'dia4_op2'=>$var6,
                                                        'hora_inicio_op2'=>$var7,
                                                        'minutos_inicio_op2'=>$var8,
                                                        'hora_fin_op2'=>$var9,
                                                        'minutos_fin_op2'=>$var10,

                                                        'dia4_op3'=>$dia,
                                                        'hora_inicio_op3'=>$hora_inicio,
                                                        'minutos_inicio_op3'=>$minutos_inicio,
                                                        'hora_fin_op3'=>$hora_fin,
                                                        'minutos_fin_op3'=>$minutos_fin,
                                                        'cont_dia'=>2,
                                                        'cont_tarde'=>1
                                                    ]);
                                                    flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                    return redirect()->route('horario_tutoria_asignada',['user'=>$user]);    
                                                }
                                            }else{
                                                if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                                                    $id=$horarios->id;
                                                    $var1=$horarios->dia4_op1;
                                                    $var2=$horarios->hora_inicio_op1;
                                                    $var3=$horarios->minutos_inicio_op1;
                                                    $var4=$horarios->hora_fin_op1;
                                                    $var5=$horarios->minutos_fin_op1;
                                                    $var6=$horarios->dia4_op3;
                                                    $var7=$horarios->hora_inicio_op3;
                                                    $var8=$horarios->minutos_inicio_op3;
                                                    $var9=$horarios->hora_fin_op3;
                                                    $var10=$horarios->minutos_fin_op3;
                                                    Horario4::destroy($horarios->id);
                                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                                    }else{
                                                        DB::table('horario4s')->insert([
                                                            'id'=>$id,
                                                            'usuario_id'=>$docente,
                                                            'dia4_op1'=>$var1,
                                                            'hora_inicio_op1'=>$var2,
                                                            'minutos_inicio_op1'=>$var3,
                                                            'hora_fin_op1'=>$var4,
                                                            'minutos_fin_op1'=>$var5,

                                                            'dia4_op2'=>$dia,
                                                            'hora_inicio_op2'=>$hora_inicio,
                                                            'minutos_inicio_op2'=>$minutos_inicio,
                                                            'hora_fin_op2'=>$hora_fin,
                                                            'minutos_fin_op2'=>$minutos_fin,
                                                            
                                                            'dia4_op3'=>$var6,
                                                            'hora_inicio_op3'=>$var7,
                                                            'minutos_inicio_op3'=>$var8,
                                                            'hora_fin_op3'=>$var9,
                                                            'minutos_fin_op3'=>$var10,

                                                            'cont_dia'=>2,
                                                            'cont_tarde'=>1
                                                        ]);
                                                        flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);    
                                                    }
                                                }
                                            }
                                        }
                                    }
                                // registra horario de tutoria el primero que haga ya sea lunes o tarde, cuando no existe ningun registro en la BD    
                                }else{
                                    $tarde=Str::endsWith($dia,'tarde');
                                    if($tarde==true){
                                        if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                            flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                        }else{
                                            DB::table('horario4s')->insert([
                                                'usuario_id'=>$docente,
                                                'dia4_op3'=>$dia,
                                                'hora_inicio_op3'=>$hora_inicio,
                                                'minutos_inicio_op3'=>$minutos_inicio,
                                                'hora_fin_op3'=>$hora_fin,
                                                'minutos_fin_op3'=>$minutos_fin,
                                                'cont_dia'=>0,
                                                'cont_tarde'=>1,
                                            ]);
                                            flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                            return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                                        }
                                    }else{
                                        if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                            flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                        }else{
                                            DB::table('horario4s')->insert([
                                                'usuario_id'=>$docente,
                                                'dia4_op1'=>$dia,
                                                'hora_inicio_op1'=>$hora_inicio,
                                                'minutos_inicio_op1'=>$minutos_inicio,
                                                'hora_fin_op1'=>$hora_fin,
                                                'minutos_fin_op1'=>$minutos_fin,
                                                'cont_dia'=>1,
                                                'cont_tarde'=>0
                                            ]);
                                            flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                            return redirect()->route('horario_tutoria_asignada',['user'=>$user]);    
                                        }
                                    }
                                }
                            }else{
                                $dia5=Str::startsWith($dia,'Viernes');
                                if($dia5==true){
                                    $verifica_horarios=DB::table('horario5s')->where('usuario_id',$user->id)->exists();
                                    //------------------------------------------------------------------------------------- 5
                                    if($verifica_horarios==true){
                                        $horarios=DB::table('horario5s')->where('usuario_id',$docente)->first();
                                        if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                                            $id=$horarios->id;
                                            $var1=$horarios->dia5_op3;
                                            $var2=$horarios->hora_inicio_op3;
                                            $var3=$horarios->minutos_inicio_op3;
                                            $var4=$horarios->hora_fin_op3;
                                            $var5=$horarios->minutos_fin_op3;
                                            Horario5::destroy($horarios->id);
                                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                            }else{
                                                DB::table('horario5s')->insert([
                                                    'id'=>$id,
                                                    'usuario_id'=>$docente,
                                                    'dia5_op1'=>$dia,
                                                    'hora_inicio_op1'=>$hora_inicio,
                                                    'minutos_inicio_op1'=>$minutos_inicio,
                                                    'hora_fin_op1'=>$hora_fin,
                                                    'minutos_fin_op1'=>$minutos_fin,
                                                    
                                                    'dia5_op3'=>$var1,
                                                    'hora_inicio_op3'=>$var2,
                                                    'minutos_inicio_op3'=>$var3,
                                                    'hora_fin_op3'=>$var4,
                                                    'minutos_fin_op3'=>$var5,
                                                    'cont_dia'=>1,
                                                    'cont_tarde'=>1,
                                                ]);
                                                flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                                            }
                                        }else{
                                            if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                                                $id=$horarios->id;
                                                $var1=$horarios->dia5_op1;
                                                $var2=$horarios->hora_inicio_op1;
                                                $var3=$horarios->minutos_inicio_op1;
                                                $var4=$horarios->hora_fin_op1;
                                                $var5=$horarios->minutos_fin_op1;
                                                Horario5::destroy($horarios->id);
                                                $tarde=Str::endsWith($dia,'tarde');
                                                if($tarde==true){
                                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                                    }else{
                                                        DB::table('horario5s')->insert([
                                                            'id'=>$id,
                                                            'usuario_id'=>$docente,
                                                            'dia5_op1'=>$var1,
                                                            'hora_inicio_op1'=>$var2,
                                                            'minutos_inicio_op1'=>$var3,
                                                            'hora_fin_op1'=>$var4,
                                                            'minutos_fin_op1'=>$var5,
                                
                                                            'dia5_op3'=>$dia,
                                                            'hora_inicio_op3'=>$hora_inicio,
                                                            'minutos_inicio_op3'=>$minutos_inicio,
                                                            'hora_fin_op3'=>$hora_fin,
                                                            'minutos_fin_op3'=>$minutos_fin,
                                                            'cont_dia'=>1,
                                                            'cont_tarde'=>1
                                                        ]);
                                                        flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);    
                                                    }
                                                }else{
                                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                                    }else{
                                                        DB::table('horario5s')->insert([
                                                            'id'=>$id,
                                                            'usuario_id'=>$docente,
                                                            'dia5_op1'=>$var1,
                                                            'hora_inicio_op1'=>$var2,
                                                            'minutos_inicio_op1'=>$var3,
                                                            'hora_fin_op1'=>$var4,
                                                            'minutos_fin_op1'=>$var5,
                                
                                                            'dia5_op2'=>$dia,
                                                            'hora_inicio_op2'=>$hora_inicio,
                                                            'minutos_inicio_op2'=>$minutos_inicio,
                                                            'hora_fin_op2'=>$hora_fin,
                                                            'minutos_fin_op2'=>$minutos_fin,
                                                            'cont_dia'=>2,
                                                            'cont_tarde'=>0
                                                        ]);
                                                        flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);     
                                                    }
                                                }
                                            }else{
                                                if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                                                    $id=$horarios->id;
                                                    $var1=$horarios->dia5_op1;
                                                    $var2=$horarios->hora_inicio_op1;
                                                    $var3=$horarios->minutos_inicio_op1;
                                                    $var4=$horarios->hora_fin_op1;
                                                    $var5=$horarios->minutos_fin_op1;
                                                    $var6=$horarios->dia5_op2;
                                                    $var7=$horarios->hora_inicio_op2;
                                                    $var8=$horarios->minutos_inicio_op2;
                                                    $var9=$horarios->hora_fin_op2;
                                                    $var10=$horarios->minutos_fin_op2;
                                                    Horario5::destroy($horarios->id);
                                                    if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                        flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                        return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                                    }else{
                                                        DB::table('horario5s')->insert([
                                                            'id'=>$id,
                                                            'usuario_id'=>$docente,
                                                            'dia5_op1'=>$var1,
                                                            'hora_inicio_op1'=>$var2,
                                                            'minutos_inicio_op1'=>$var3,
                                                            'hora_fin_op1'=>$var4,
                                                            'minutos_fin_op1'=>$var5,

                                                            'dia5_op2'=>$var6,
                                                            'hora_inicio_op2'=>$var7,
                                                            'minutos_inicio_op2'=>$var8,
                                                            'hora_fin_op2'=>$var9,
                                                            'minutos_fin_op2'=>$var10,

                                                            'dia5_op3'=>$dia,
                                                            'hora_inicio_op3'=>$hora_inicio,
                                                            'minutos_inicio_op3'=>$minutos_inicio,
                                                            'hora_fin_op3'=>$hora_fin,
                                                            'minutos_fin_op3'=>$minutos_fin,
                                                            'cont_dia'=>2,
                                                            'cont_tarde'=>1
                                                        ]);
                                                        flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                        return redirect()->route('horario_tutoria_asignada',['user'=>$user]);     
                                                    }
                                                }else{
                                                    if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                                                        $id=$horarios->id;
                                                        $var1=$horarios->dia5_op1;
                                                        $var2=$horarios->hora_inicio_op1;
                                                        $var3=$horarios->minutos_inicio_op1;
                                                        $var4=$horarios->hora_fin_op1;
                                                        $var5=$horarios->minutos_fin_op1;
                                                        $var6=$horarios->dia5_op3;
                                                        $var7=$horarios->hora_inicio_op3;
                                                        $var8=$horarios->minutos_inicio_op3;
                                                        $var9=$horarios->hora_fin_op3;
                                                        $var10=$horarios->minutos_fin_op3;
                                                        Horario5::destroy($horarios->id);
                                                        if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                            flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                            return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                                        }else{
                                                            DB::table('horario5s')->insert([
                                                                'id'=>$id,
                                                                'usuario_id'=>$docente,
                                                                'dia5_op1'=>$var1,
                                                                'hora_inicio_op1'=>$var2,
                                                                'minutos_inicio_op1'=>$var3,
                                                                'hora_fin_op1'=>$var4,
                                                                'minutos_fin_op1'=>$var5,

                                                                'dia5_op2'=>$dia,
                                                                'hora_inicio_op2'=>$hora_inicio,
                                                                'minutos_inicio_op2'=>$minutos_inicio,
                                                                'hora_fin_op2'=>$hora_fin,
                                                                'minutos_fin_op2'=>$minutos_fin,
                                                                
                                                                'dia5_op3'=>$var6,
                                                                'hora_inicio_op3'=>$var7,
                                                                'minutos_inicio_op3'=>$var8,
                                                                'hora_fin_op3'=>$var9,
                                                                'minutos_fin_op3'=>$var10,

                                                                'cont_dia'=>2,
                                                                'cont_tarde'=>1
                                                            ]);
                                                            flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                            return redirect()->route('horario_tutoria_asignada',['user'=>$user]);   
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    // registra horario de tutoria el primero que haga ya sea lunes o tarde, cuando no existe ningun registro en la BD    
                                    }else{
                                        $tarde=Str::endsWith($dia,'tarde');
                                        if($tarde==true){
                                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                            }else{
                                                DB::table('horario5s')->insert([
                                                    'usuario_id'=>$docente,
                                                    'dia5_op3'=>$dia,
                                                    'hora_inicio_op3'=>$hora_inicio,
                                                    'minutos_inicio_op3'=>$minutos_inicio,
                                                    'hora_fin_op3'=>$hora_fin,
                                                    'minutos_fin_op3'=>$minutos_fin,
                                                    'cont_dia'=>0,
                                                    'cont_tarde'=>1,
                                                ]);
                                                flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);
                                            }
                                        }else{
                                            if($hora_inicio=="NA" || $minutos_inicio=="NA" || $hora_fin=="NA" || $minutos_fin=="NA"){
                                                flash("Datos de hora y minutos incorrectos. Llene los campos para hora de inicio y fin correctamente.")->error();
                                                return view('user_administrador.boton_asignar_tutoria',compact('user','dia'));
                                            }else{
                                                DB::table('horario5s')->insert([
                                                    'usuario_id'=>$docente,
                                                    'dia5_op1'=>$dia,
                                                    'hora_inicio_op1'=>$hora_inicio,
                                                    'minutos_inicio_op1'=>$minutos_inicio,
                                                    'hora_fin_op1'=>$hora_fin,
                                                    'minutos_fin_op1'=>$minutos_fin,
                                                    'cont_dia'=>1,
                                                    'cont_tarde'=>0
                                                ]);
                                                flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                                                return redirect()->route('horario_tutoria_asignada',['user'=>$user]);     
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                return view('user_administrador.login_administrador');
            }
        }        
    }

    public function horario_tutoria_asignada(User $user){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                $docente=$user->id;
                $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
                $horario2s=DB::table('horario2s')->where('usuario_id',$docente)->first();
                $horario3s=DB::table('horario3s')->where('usuario_id',$docente)->first();
                $horario4s=DB::table('horario4s')->where('usuario_id',$docente)->first();
                $horario5s=DB::table('horario5s')->where('usuario_id',$docente)->first();
                
                flash("Horario de tutoría asignado correctamente al docente {$user->name} {$user->lastname}.")->success();
                return view('user_administrador.horario_tutoria_asignada',compact('user','horarios','horario2s','horario3s','horario4s','horario5s'));
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }

    public function horario_tutoria_asignada_op2(User $user){
        if (Auth::check()){
            $user_admin = Auth::user();
            if($user_admin->is_admin==true){
                $docente=$user->id;
                $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
                $horario2s=DB::table('horario2s')->where('usuario_id',$docente)->first();
                $horario3s=DB::table('horario3s')->where('usuario_id',$docente)->first();
                $horario4s=DB::table('horario4s')->where('usuario_id',$docente)->first();
                $horario5s=DB::table('horario5s')->where('usuario_id',$docente)->first();
                return view('user_administrador.horario_tutoria_asignada',compact('user','horarios','horario2s','horario3s','horario4s','horario5s'));
            }else{
                return view('user_administrador.login_administrador');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar horario de tutoria asignada
|--------------------------------------------------------------------------
*/
    /* LUNES */
    public function vista_editar_horario_tutoria_asignada_op1(User $user, $aux){
        $docente=$user->id;
        $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
        if($aux==1){
            $var1=$horarios->dia1_op1;
            $var2=$horarios->hora_inicio_op1;
            $var3=$horarios->minutos_inicio_op1;
            $var4=$horarios->hora_fin_op1;
            $var5=$horarios->minutos_fin_op1;

            $var6="hora_inicio_op1";
            $var7="minutos_inicio_op1";
            $var8="hora_fin_op1";
            $var9="minutos_fin_op1";
            return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
        }else{
            if($aux==2){
                $var1=$horarios->dia1_op2;
                $var2=$horarios->hora_inicio_op2;
                $var3=$horarios->minutos_inicio_op2;
                $var4=$horarios->hora_fin_op2;
                $var5=$horarios->minutos_fin_op2;

                $var6="hora_inicio_op2";
                $var7="minutos_inicio_op2";
                $var8="hora_fin_op2";
                $var9="minutos_fin_op2";
                return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
            }else{
                if($aux==3){
                    $var1=$horarios->dia1_op3;
                    $var2=$horarios->hora_inicio_op3;
                    $var3=$horarios->minutos_inicio_op3;
                    $var4=$horarios->hora_fin_op3;
                    $var5=$horarios->minutos_fin_op3;

                    $var6="hora_inicio_op3";
                    $var7="minutos_inicio_op3";
                    $var8="hora_fin_op3";
                    $var9="minutos_fin_op3";
                    return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
                }
            }
        }
    }
    /* MARTES */
    public function vista_editar_horario_tutoria_asignada_op2(User $user, $aux){
        $docente=$user->id;
        $horarios=DB::table('horario2s')->where('usuario_id',$docente)->first();
        if($aux==1){
            $var1=$horarios->dia2_op1;
            $var2=$horarios->hora_inicio_op1;
            $var3=$horarios->minutos_inicio_op1;
            $var4=$horarios->hora_fin_op1;
            $var5=$horarios->minutos_fin_op1;

            $var6="hora_inicio_op1";
            $var7="minutos_inicio_op1";
            $var8="hora_fin_op1";
            $var9="minutos_fin_op1";
            return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
        }else{
            if($aux==2){
                $var1=$horarios->dia2_op2;
                $var2=$horarios->hora_inicio_op2;
                $var3=$horarios->minutos_inicio_op2;
                $var4=$horarios->hora_fin_op2;
                $var5=$horarios->minutos_fin_op2;

                $var6="hora_inicio_op2";
                $var7="minutos_inicio_op2";
                $var8="hora_fin_op2";
                $var9="minutos_fin_op2";
                return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
            }else{
                if($aux==3){
                    $var1=$horarios->dia2_op3;
                    $var2=$horarios->hora_inicio_op3;
                    $var3=$horarios->minutos_inicio_op3;
                    $var4=$horarios->hora_fin_op3;
                    $var5=$horarios->minutos_fin_op3;

                    $var6="hora_inicio_op3";
                    $var7="minutos_inicio_op3";
                    $var8="hora_fin_op3";
                    $var9="minutos_fin_op3";
                    return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
                }
            }
        }
    }
    /* MIERCOLES */
    public function vista_editar_horario_tutoria_asignada_op3(User $user, $aux){
        $docente=$user->id;
        $horarios=DB::table('horario3s')->where('usuario_id',$docente)->first();
        if($aux==1){
            $var1=$horarios->dia3_op1;
            $var2=$horarios->hora_inicio_op1;
            $var3=$horarios->minutos_inicio_op1;
            $var4=$horarios->hora_fin_op1;
            $var5=$horarios->minutos_fin_op1;

            $var6="hora_inicio_op1";
            $var7="minutos_inicio_op1";
            $var8="hora_fin_op1";
            $var9="minutos_fin_op1";
            return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
        }else{
            if($aux==2){
                $var1=$horarios->dia3_op2;
                $var2=$horarios->hora_inicio_op2;
                $var3=$horarios->minutos_inicio_op2;
                $var4=$horarios->hora_fin_op2;
                $var5=$horarios->minutos_fin_op2;

                $var6="hora_inicio_op2";
                $var7="minutos_inicio_op2";
                $var8="hora_fin_op2";
                $var9="minutos_fin_op2";
                return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
            }else{
                if($aux==3){
                    $var1=$horarios->dia3_op3;
                    $var2=$horarios->hora_inicio_op3;
                    $var3=$horarios->minutos_inicio_op3;
                    $var4=$horarios->hora_fin_op3;
                    $var5=$horarios->minutos_fin_op3;

                    $var6="hora_inicio_op3";
                    $var7="minutos_inicio_op3";
                    $var8="hora_fin_op3";
                    $var9="minutos_fin_op3";
                    return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
                }
            }
        }
    }
    /* JUEVES */
    public function vista_editar_horario_tutoria_asignada_op4(User $user, $aux){
        $docente=$user->id;
        $horarios=DB::table('horario4s')->where('usuario_id',$docente)->first();
        if($aux==1){
            $var1=$horarios->dia4_op1;
            $var2=$horarios->hora_inicio_op1;
            $var3=$horarios->minutos_inicio_op1;
            $var4=$horarios->hora_fin_op1;
            $var5=$horarios->minutos_fin_op1;

            $var6="hora_inicio_op1";
            $var7="minutos_inicio_op1";
            $var8="hora_fin_op1";
            $var9="minutos_fin_op1";
            return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
        }else{
            if($aux==2){
                $var1=$horarios->dia4_op2;
                $var2=$horarios->hora_inicio_op2;
                $var3=$horarios->minutos_inicio_op2;
                $var4=$horarios->hora_fin_op2;
                $var5=$horarios->minutos_fin_op2;

                $var6="hora_inicio_op2";
                $var7="minutos_inicio_op2";
                $var8="hora_fin_op2";
                $var9="minutos_fin_op2";
                return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
            }else{
                if($aux==3){
                    $var1=$horarios->dia4_op3;
                    $var2=$horarios->hora_inicio_op3;
                    $var3=$horarios->minutos_inicio_op3;
                    $var4=$horarios->hora_fin_op3;
                    $var5=$horarios->minutos_fin_op3;

                    $var6="hora_inicio_op3";
                    $var7="minutos_inicio_op3";
                    $var8="hora_fin_op3";
                    $var9="minutos_fin_op3";
                    return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
                }
            }
        }
    }
    /* VIERNES */
    public function vista_editar_horario_tutoria_asignada_op5(User $user, $aux){
        $docente=$user->id;
        $horarios=DB::table('horario5s')->where('usuario_id',$docente)->first();
        if($aux==1){
            $var1=$horarios->dia5_op1;
            $var2=$horarios->hora_inicio_op1;
            $var3=$horarios->minutos_inicio_op1;
            $var4=$horarios->hora_fin_op1;
            $var5=$horarios->minutos_fin_op1;

            $var6="hora_inicio_op1";
            $var7="minutos_inicio_op1";
            $var8="hora_fin_op1";
            $var9="minutos_fin_op1";
            return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
        }else{
            if($aux==2){
                $var1=$horarios->dia5_op2;
                $var2=$horarios->hora_inicio_op2;
                $var3=$horarios->minutos_inicio_op2;
                $var4=$horarios->hora_fin_op2;
                $var5=$horarios->minutos_fin_op2;

                $var6="hora_inicio_op2";
                $var7="minutos_inicio_op2";
                $var8="hora_fin_op2";
                $var9="minutos_fin_op2";
                return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
            }else{
                if($aux==3){
                    $var1=$horarios->dia5_op3;
                    $var2=$horarios->hora_inicio_op3;
                    $var3=$horarios->minutos_inicio_op3;
                    $var4=$horarios->hora_fin_op3;
                    $var5=$horarios->minutos_fin_op3;

                    $var6="hora_inicio_op3";
                    $var7="minutos_inicio_op3";
                    $var8="hora_fin_op3";
                    $var9="minutos_fin_op3";
                    return view('user_administrador.editar_horario_tutoria_asignada',compact('user','var1','var2','var3','var4','var5','var6','var7','var8','var9','aux'));
                }
            }
        }
    }
    public function editando_horario(User $user,Request $request){
        $docente=$user->id;
        $aux_dia=$request->input('dia');
        $valor=Str::startsWith($aux_dia,'Lunes');
        if($valor==true){
            $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
            if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                $horario = Horario::find($horarios->id);
                $data=request()->validate([
                    'hora_inicio_op3'=>'required',
                    'minutos_inicio_op3'=>'required',
                    'hora_fin_op3'=>'required',
                    'minutos_fin_op3'=>'required'
                ]);
                $horario->update($data);
                flash("El horario de tutoría se ha editado correctamente")->success();
                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
            }else{
                if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                    $horario = Horario::find($horarios->id);
                    $data=request()->validate([
                        'hora_inicio_op1'=>'required',
                        'minutos_inicio_op1'=>'required',
                        'hora_fin_op1'=>'required',
                        'minutos_fin_op1'=>'required'
                    ]);
                    $horario->update($data);
                    flash("El horario de tutoría se ha editado correctamente")->success();
                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                }else{
                    if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                        $dia=$request->input('hora_inicio_op1');
                        if($dia==null){/* significa que el administrador va a editar el horario de tutoria numero 2 */
                            $horario = Horario::find($horarios->id);
                            $data=request()->validate([
                                'hora_inicio_op2'=>'required',
                                'minutos_inicio_op2'=>'required',
                                'hora_fin_op2'=>'required',
                                'minutos_fin_op2'=>'required'
                            ]);
                            $horario->update($data);
                            flash("El horario de tutoría se ha editado correctamente")->success();
                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                        }else{/* el administrador va a editar el horario de tutoria numero 1 */
                            $horario = Horario::find($horarios->id);
                            $data=request()->validate([
                                'hora_inicio_op1'=>'required',
                                'minutos_inicio_op1'=>'required',
                                'hora_fin_op1'=>'required',
                                'minutos_fin_op1'=>'required'
                            ]);
                            $horario->update($data);
                            flash("El horario de tutoría se ha editado correctamente")->success();
                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                        }
                    }else{
                        if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                            $dia=$request->input('dia');
                            $valor=Str::endsWith($dia,'mañana');
                            if($valor==true){/* el administrador va a editar el horario 1 */
                                $horario = Horario::find($horarios->id);
                                $data=request()->validate([
                                    'hora_inicio_op1'=>'required',
                                    'minutos_inicio_op1'=>'required',
                                    'hora_fin_op1'=>'required',
                                    'minutos_fin_op1'=>'required'
                                ]);
                                $horario->update($data);
                                flash("El horario de tutoría se ha editado correctamente")->success();
                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                            }else{/* el administrador va a editar el horario 3 */
                                $horario = Horario::find($horarios->id);
                                $data=request()->validate([
                                    'hora_inicio_op3'=>'required',
                                    'minutos_inicio_op3'=>'required',
                                    'hora_fin_op3'=>'required',
                                    'minutos_fin_op3'=>'required'
                                ]);
                                $horario->update($data);
                                flash("El horario de tutoría se ha editado correctamente")->success();
                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                            }
                        }else{
                            if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                                $dia=$request->input('dia');
                                $valor=Str::endsWith($dia,'mañana');
                                if($valor==true){/* el administrador va a editar el horario 1 o el horario 2*/
                                    $aux=$request->input('hora_inicio_op1');
                                    if($aux==null){/* el administrador va a editar el horario de tutoria numero 2 */
                                        $horario = Horario::find($horarios->id);
                                        $data=request()->validate([
                                            'hora_inicio_op2'=>'required',
                                            'minutos_inicio_op2'=>'required',
                                            'hora_fin_op2'=>'required',
                                            'minutos_fin_op2'=>'required'
                                        ]);
                                        $horario->update($data);
                                        flash("El horario de tutoría se ha editado correctamente")->success();
                                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                    }else{/* el administrador va a editar el horario de tutoria numero 1 */
                                        $horario = Horario::find($horarios->id);
                                        $data=request()->validate([
                                            'hora_inicio_op1'=>'required',
                                            'minutos_inicio_op1'=>'required',
                                            'hora_fin_op1'=>'required',
                                            'minutos_fin_op1'=>'required'
                                        ]);
                                        $horario->update($data);
                                        flash("El horario de tutoría se ha editado correctamente")->success();
                                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                    }
                                }else{/* el administrador va a editar el horario 3 */
                                    $horario = Horario::find($horarios->id);
                                    $data=request()->validate([
                                        'hora_inicio_op3'=>'required',
                                        'minutos_inicio_op3'=>'required',
                                        'hora_fin_op3'=>'required',
                                        'minutos_fin_op3'=>'required'
                                    ]);
                                    $horario->update($data);
                                    flash("El horario de tutoría se ha editado correctamente")->success();
                                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                }
                            }
                        }
                    }
                }
            }
        }else{
            $valor=Str::startsWith($aux_dia,'Martes');
            if($valor==true){
                $horarios=DB::table('horario2s')->where('usuario_id',$docente)->first();
                if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                    $horario = Horario2::find($horarios->id);
                    $data=request()->validate([
                        'hora_inicio_op3'=>'required',
                        'minutos_inicio_op3'=>'required',
                        'hora_fin_op3'=>'required',
                        'minutos_fin_op3'=>'required'
                    ]);
                    $horario->update($data);
                    flash("El horario de tutoría se ha editado correctamente")->success();
                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                }else{
                    if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                        $horario = Horario2::find($horarios->id);
                        $data=request()->validate([
                            'hora_inicio_op1'=>'required',
                            'minutos_inicio_op1'=>'required',
                            'hora_fin_op1'=>'required',
                            'minutos_fin_op1'=>'required'
                        ]);
                        $horario->update($data);
                        flash("El horario de tutoría se ha editado correctamente")->success();
                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                    }else{
                        if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                            $dia=$request->input('hora_inicio_op1');
                            if($dia==null){/* significa que el administrador va a editar el horario de tutoria numero 2 */
                                $horario = Horario2::find($horarios->id);
                                $data=request()->validate([
                                    'hora_inicio_op2'=>'required',
                                    'minutos_inicio_op2'=>'required',
                                    'hora_fin_op2'=>'required',
                                    'minutos_fin_op2'=>'required'
                                ]);
                                $horario->update($data);
                                flash("El horario de tutoría se ha editado correctamente")->success();
                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                            }else{/* el administrador va a editar el horario de tutoria numero 1 */
                                $horario = Horario2::find($horarios->id);
                                $data=request()->validate([
                                    'hora_inicio_op1'=>'required',
                                    'minutos_inicio_op1'=>'required',
                                    'hora_fin_op1'=>'required',
                                    'minutos_fin_op1'=>'required'
                                ]);
                                $horario->update($data);
                                flash("El horario de tutoría se ha editado correctamente")->success();
                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                            }
                        }else{
                            if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                                $dia=$request->input('dia');
                                $valor=Str::endsWith($dia,'mañana');
                                if($valor==true){/* el administrador va a editar el horario 1 */
                                    $horario = Horario2::find($horarios->id);
                                    $data=request()->validate([
                                        'hora_inicio_op1'=>'required',
                                        'minutos_inicio_op1'=>'required',
                                        'hora_fin_op1'=>'required',
                                        'minutos_fin_op1'=>'required'
                                    ]);
                                    $horario->update($data);
                                    flash("El horario de tutoría se ha editado correctamente")->success();
                                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                }else{/* el administrador va a editar el horario 3 */
                                    $horario = Horario2::find($horarios->id);
                                    $data=request()->validate([
                                        'hora_inicio_op3'=>'required',
                                        'minutos_inicio_op3'=>'required',
                                        'hora_fin_op3'=>'required',
                                        'minutos_fin_op3'=>'required'
                                    ]);
                                    $horario->update($data);
                                    flash("El horario de tutoría se ha editado correctamente")->success();
                                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                }
                            }else{
                                if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                                    $dia=$request->input('dia');
                                    $valor=Str::endsWith($dia,'mañana');
                                    if($valor==true){/* el administrador va a editar el horario 1 o el horario 2*/
                                        $aux=$request->input('hora_inicio_op1');
                                        if($aux==null){/* el administrador va a editar el horario de tutoria numero 2 */
                                            $horario = Horario2::find($horarios->id);
                                            $data=request()->validate([
                                                'hora_inicio_op2'=>'required',
                                                'minutos_inicio_op2'=>'required',
                                                'hora_fin_op2'=>'required',
                                                'minutos_fin_op2'=>'required'
                                            ]);
                                            $horario->update($data);
                                            flash("El horario de tutoría se ha editado correctamente")->success();
                                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                        }else{/* el administrador va a editar el horario de tutoria numero 1 */
                                            $horario = Horario2::find($horarios->id);
                                            $data=request()->validate([
                                                'hora_inicio_op1'=>'required',
                                                'minutos_inicio_op1'=>'required',
                                                'hora_fin_op1'=>'required',
                                                'minutos_fin_op1'=>'required'
                                            ]);
                                            $horario->update($data);
                                            flash("El horario de tutoría se ha editado correctamente")->success();
                                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                        }
                                    }else{/* el administrador va a editar el horario 3 */
                                        $horario = Horario2::find($horarios->id);
                                        $data=request()->validate([
                                            'hora_inicio_op3'=>'required',
                                            'minutos_inicio_op3'=>'required',
                                            'hora_fin_op3'=>'required',
                                            'minutos_fin_op3'=>'required'
                                        ]);
                                        $horario->update($data);
                                        flash("El horario de tutoría se ha editado correctamente")->success();
                                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                $valor=Str::startsWith($aux_dia,'Miércoles');
                if($valor==true){
                    $horarios=DB::table('horario3s')->where('usuario_id',$docente)->first();
                    if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                        $horario = Horario3::find($horarios->id);
                        $data=request()->validate([
                            'hora_inicio_op3'=>'required',
                            'minutos_inicio_op3'=>'required',
                            'hora_fin_op3'=>'required',
                            'minutos_fin_op3'=>'required'
                        ]);
                        $horario->update($data);
                        flash("El horario de tutoría se ha editado correctamente")->success();
                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                    }else{
                        if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                            $horario = Horario3::find($horarios->id);
                            $data=request()->validate([
                                'hora_inicio_op1'=>'required',
                                'minutos_inicio_op1'=>'required',
                                'hora_fin_op1'=>'required',
                                'minutos_fin_op1'=>'required'
                            ]);
                            $horario->update($data);
                            flash("El horario de tutoría se ha editado correctamente")->success();
                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                        }else{
                            if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                                $dia=$request->input('hora_inicio_op1');
                                if($dia==null){/* significa que el administrador va a editar el horario de tutoria numero 2 */
                                    $horario = Horario3::find($horarios->id);
                                    $data=request()->validate([
                                        'hora_inicio_op2'=>'required',
                                        'minutos_inicio_op2'=>'required',
                                        'hora_fin_op2'=>'required',
                                        'minutos_fin_op2'=>'required'
                                    ]);
                                    $horario->update($data);
                                    flash("El horario de tutoría se ha editado correctamente")->success();
                                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                }else{/* el administrador va a editar el horario de tutoria numero 1 */
                                    $horario = Horario3::find($horarios->id);
                                    $data=request()->validate([
                                        'hora_inicio_op1'=>'required',
                                        'minutos_inicio_op1'=>'required',
                                        'hora_fin_op1'=>'required',
                                        'minutos_fin_op1'=>'required'
                                    ]);
                                    $horario->update($data);
                                    flash("El horario de tutoría se ha editado correctamente")->success();
                                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                }
                            }else{
                                if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                                    $dia=$request->input('dia');
                                    $valor=Str::endsWith($dia,'mañana');
                                    if($valor==true){/* el administrador va a editar el horario 1 */
                                        $horario = Horario3::find($horarios->id);
                                        $data=request()->validate([
                                            'hora_inicio_op1'=>'required',
                                            'minutos_inicio_op1'=>'required',
                                            'hora_fin_op1'=>'required',
                                            'minutos_fin_op1'=>'required'
                                        ]);
                                        $horario->update($data);
                                        flash("El horario de tutoría se ha editado correctamente")->success();
                                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                    }else{/* el administrador va a editar el horario 3 */
                                        $horario = Horario3::find($horarios->id);
                                        $data=request()->validate([
                                            'hora_inicio_op3'=>'required',
                                            'minutos_inicio_op3'=>'required',
                                            'hora_fin_op3'=>'required',
                                            'minutos_fin_op3'=>'required'
                                        ]);
                                        $horario->update($data);
                                        flash("El horario de tutoría se ha editado correctamente")->success();
                                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                    }
                                }else{
                                    if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                                        $dia=$request->input('dia');
                                        $valor=Str::endsWith($dia,'mañana');
                                        if($valor==true){/* el administrador va a editar el horario 1 o el horario 2*/
                                            $aux=$request->input('hora_inicio_op1');
                                            if($aux==null){/* el administrador va a editar el horario de tutoria numero 2 */
                                                $horario = Horario3::find($horarios->id);
                                                $data=request()->validate([
                                                    'hora_inicio_op2'=>'required',
                                                    'minutos_inicio_op2'=>'required',
                                                    'hora_fin_op2'=>'required',
                                                    'minutos_fin_op2'=>'required'
                                                ]);
                                                $horario->update($data);
                                                flash("El horario de tutoría se ha editado correctamente")->success();
                                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                            }else{/* el administrador va a editar el horario de tutoria numero 1 */
                                                $horario = Horario3::find($horarios->id);
                                                $data=request()->validate([
                                                    'hora_inicio_op1'=>'required',
                                                    'minutos_inicio_op1'=>'required',
                                                    'hora_fin_op1'=>'required',
                                                    'minutos_fin_op1'=>'required'
                                                ]);
                                                $horario->update($data);
                                                flash("El horario de tutoría se ha editado correctamente")->success();
                                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                            }
                                        }else{/* el administrador va a editar el horario 3 */
                                            $horario = Horario3::find($horarios->id);
                                            $data=request()->validate([
                                                'hora_inicio_op3'=>'required',
                                                'minutos_inicio_op3'=>'required',
                                                'hora_fin_op3'=>'required',
                                                'minutos_fin_op3'=>'required'
                                            ]);
                                            $horario->update($data);
                                            flash("El horario de tutoría se ha editado correctamente")->success();
                                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $valor=Str::startsWith($aux_dia,'Jueves');
                    if($valor==true){
                        $horarios=DB::table('horario4s')->where('usuario_id',$docente)->first();
                        if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                            $horario = Horario4::find($horarios->id);
                            $data=request()->validate([
                                'hora_inicio_op3'=>'required',
                                'minutos_inicio_op3'=>'required',
                                'hora_fin_op3'=>'required',
                                'minutos_fin_op3'=>'required'
                            ]);
                            $horario->update($data);
                            flash("El horario de tutoría se ha editado correctamente")->success();
                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                        }else{
                            if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                                $horario = Horario4::find($horarios->id);
                                $data=request()->validate([
                                    'hora_inicio_op1'=>'required',
                                    'minutos_inicio_op1'=>'required',
                                    'hora_fin_op1'=>'required',
                                    'minutos_fin_op1'=>'required'
                                ]);
                                $horario->update($data);
                                flash("El horario de tutoría se ha editado correctamente")->success();
                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                            }else{
                                if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                                    $dia=$request->input('hora_inicio_op1');
                                    if($dia==null){/* significa que el administrador va a editar el horario de tutoria numero 2 */
                                        $horario = Horario4::find($horarios->id);
                                        $data=request()->validate([
                                            'hora_inicio_op2'=>'required',
                                            'minutos_inicio_op2'=>'required',
                                            'hora_fin_op2'=>'required',
                                            'minutos_fin_op2'=>'required'
                                        ]);
                                        $horario->update($data);
                                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                    }else{/* el administrador va a editar el horario de tutoria numero 1 */
                                        $horario = Horario4::find($horarios->id);
                                        $data=request()->validate([
                                            'hora_inicio_op1'=>'required',
                                            'minutos_inicio_op1'=>'required',
                                            'hora_fin_op1'=>'required',
                                            'minutos_fin_op1'=>'required'
                                        ]);
                                        $horario->update($data);
                                        flash("El horario de tutoría se ha editado correctamente")->success();
                                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                    }
                                }else{
                                    if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                                        $dia=$request->input('dia');
                                        $valor=Str::endsWith($dia,'mañana');
                                        if($valor==true){/* el administrador va a editar el horario 1 */
                                            $horario = Horario4::find($horarios->id);
                                            $data=request()->validate([
                                                'hora_inicio_op1'=>'required',
                                                'minutos_inicio_op1'=>'required',
                                                'hora_fin_op1'=>'required',
                                                'minutos_fin_op1'=>'required'
                                            ]);
                                            $horario->update($data);
                                            flash("El horario de tutoría se ha editado correctamente")->success();
                                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                        }else{/* el administrador va a editar el horario 3 */
                                            $horario = Horario4::find($horarios->id);
                                            $data=request()->validate([
                                                'hora_inicio_op3'=>'required',
                                                'minutos_inicio_op3'=>'required',
                                                'hora_fin_op3'=>'required',
                                                'minutos_fin_op3'=>'required'
                                            ]);
                                            $horario->update($data);
                                            flash("El horario de tutoría se ha editado correctamente")->success();
                                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                        }
                                    }else{
                                        if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                                            $dia=$request->input('dia');
                                            $valor=Str::endsWith($dia,'mañana');
                                            if($valor==true){/* el administrador va a editar el horario 1 o el horario 2*/
                                                $aux=$request->input('hora_inicio_op1');
                                                if($aux==null){/* el administrador va a editar el horario de tutoria numero 2 */
                                                    $horario = Horario4::find($horarios->id);
                                                    $data=request()->validate([
                                                        'hora_inicio_op2'=>'required',
                                                        'minutos_inicio_op2'=>'required',
                                                        'hora_fin_op2'=>'required',
                                                        'minutos_fin_op2'=>'required'
                                                    ]);
                                                    $horario->update($data);
                                                    flash("El horario de tutoría se ha editado correctamente")->success();
                                                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                                }else{/* el administrador va a editar el horario de tutoria numero 1 */
                                                    $horario = Horario4::find($horarios->id);
                                                    $data=request()->validate([
                                                        'hora_inicio_op1'=>'required',
                                                        'minutos_inicio_op1'=>'required',
                                                        'hora_fin_op1'=>'required',
                                                        'minutos_fin_op1'=>'required'
                                                    ]);
                                                    $horario->update($data);
                                                    flash("El horario de tutoría se ha editado correctamente")->success();
                                                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                                }
                                            }else{/* el administrador va a editar el horario 3 */
                                                $horario = Horario4::find($horarios->id);
                                                $data=request()->validate([
                                                    'hora_inicio_op3'=>'required',
                                                    'minutos_inicio_op3'=>'required',
                                                    'hora_fin_op3'=>'required',
                                                    'minutos_fin_op3'=>'required'
                                                ]);
                                                $horario->update($data);
                                                flash("El horario de tutoría se ha editado correctamente")->success();
                                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }else{
                        $valor=Str::startsWith($aux_dia,'Viernes');
                        if($valor==true){
                            $horarios=DB::table('horario5s')->where('usuario_id',$docente)->first();
                            if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
                                $horario = Horario5::find($horarios->id);
                                $data=request()->validate([
                                    'hora_inicio_op3'=>'required',
                                    'minutos_inicio_op3'=>'required',
                                    'hora_fin_op3'=>'required',
                                    'minutos_fin_op3'=>'required'
                                ]);
                                $horario->update($data);
                                flash("El horario de tutoría se ha editado correctamente")->success();
                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                            }else{
                                if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                                    $horario = Horario5::find($horarios->id);
                                    $data=request()->validate([
                                        'hora_inicio_op1'=>'required',
                                        'minutos_inicio_op1'=>'required',
                                        'hora_fin_op1'=>'required',
                                        'minutos_fin_op1'=>'required'
                                    ]);
                                    $horario->update($data);
                                    flash("El horario de tutoría se ha editado correctamente")->success();
                                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                }else{
                                    if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                                        $dia=$request->input('hora_inicio_op1');
                                        if($dia==null){/* significa que el administrador va a editar el horario de tutoria numero 2 */
                                            $horario = Horario5::find($horarios->id);
                                            $data=request()->validate([
                                                'hora_inicio_op2'=>'required',
                                                'minutos_inicio_op2'=>'required',
                                                'hora_fin_op2'=>'required',
                                                'minutos_fin_op2'=>'required'
                                            ]);
                                            $horario->update($data);
                                            flash("El horario de tutoría se ha editado correctamente")->success();
                                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                        }else{/* el administrador va a editar el horario de tutoria numero 1 */
                                            $horario = Horario5::find($horarios->id);
                                            $data=request()->validate([
                                                'hora_inicio_op1'=>'required',
                                                'minutos_inicio_op1'=>'required',
                                                'hora_fin_op1'=>'required',
                                                'minutos_fin_op1'=>'required'
                                            ]);
                                            $horario->update($data);
                                            flash("El horario de tutoría se ha editado correctamente")->success();
                                            return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                        }
                                    }else{
                                        if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                                            $dia=$request->input('dia');
                                            $valor=Str::endsWith($dia,'mañana');
                                            if($valor==true){/* el administrador va a editar el horario 1 */
                                                $horario = Horario5::find($horarios->id);
                                                $data=request()->validate([
                                                    'hora_inicio_op1'=>'required',
                                                    'minutos_inicio_op1'=>'required',
                                                    'hora_fin_op1'=>'required',
                                                    'minutos_fin_op1'=>'required'
                                                ]);
                                                $horario->update($data);
                                                flash("El horario de tutoría se ha editado correctamente")->success();
                                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                            }else{/* el administrador va a editar el horario 3 */
                                                $horario = Horario5::find($horarios->id);
                                                $data=request()->validate([
                                                    'hora_inicio_op3'=>'required',
                                                    'minutos_inicio_op3'=>'required',
                                                    'hora_fin_op3'=>'required',
                                                    'minutos_fin_op3'=>'required'
                                                ]);
                                                $horario->update($data);
                                                flash("El horario de tutoría se ha editado correctamente")->success();
                                                return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                            }
                                        }else{
                                            if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                                                $dia=$request->input('dia');
                                                $valor=Str::endsWith($dia,'mañana');
                                                if($valor==true){/* el administrador va a editar el horario 1 o el horario 2*/
                                                    $aux=$request->input('hora_inicio_op1');
                                                    if($aux==null){/* el administrador va a editar el horario de tutoria numero 2 */
                                                        $horario = Horario5::find($horarios->id);
                                                        $data=request()->validate([
                                                            'hora_inicio_op2'=>'required',
                                                            'minutos_inicio_op2'=>'required',
                                                            'hora_fin_op2'=>'required',
                                                            'minutos_fin_op2'=>'required'
                                                        ]);
                                                        $horario->update($data);
                                                        flash("El horario de tutoría se ha editado correctamente")->success();
                                                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                                    }else{/* el administrador va a editar el horario de tutoria numero 1 */
                                                        $horario = Horario5::find($horarios->id);
                                                        $data=request()->validate([
                                                            'hora_inicio_op1'=>'required',
                                                            'minutos_inicio_op1'=>'required',
                                                            'hora_fin_op1'=>'required',
                                                            'minutos_fin_op1'=>'required'
                                                        ]);
                                                        $horario->update($data);
                                                        flash("El horario de tutoría se ha editado correctamente")->success();
                                                        return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                                    }
                                                }else{/* el administrador va a editar el horario 3 */
                                                    $horario = Horario5::find($horarios->id);
                                                    $data=request()->validate([
                                                        'hora_inicio_op3'=>'required',
                                                        'minutos_inicio_op3'=>'required',
                                                        'hora_fin_op3'=>'required',
                                                        'minutos_fin_op3'=>'required'
                                                    ]);
                                                    $horario->update($data);
                                                    flash("El horario de tutoría se ha editado correctamente")->success();
                                                    return redirect()->route('mensaje_editar_horario',['user'=>$user]);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
    }
    /* MENSAJE */
    public function mensaje_editar_horario(User $user){
        $docente=$user->id;
        $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
        $horario2s=DB::table('horario2s')->where('usuario_id',$docente)->first();
        $horario3s=DB::table('horario3s')->where('usuario_id',$docente)->first();
        $horario4s=DB::table('horario4s')->where('usuario_id',$docente)->first();
        $horario5s=DB::table('horario5s')->where('usuario_id',$docente)->first();
        flash("El horario de tutoría se ha editado correctamente")->success();
        return view('user_administrador.horario_tutoria_asignada',compact('user','horarios','horario2s','horario3s','horario4s','horario5s'));
    }
/* 
|--------------------------------------------------------------------------
| Funciones para eliminar horario de tutoria asignada
|--------------------------------------------------------------------------
*/
    public function eliminar_horario_tutoria_asignada_op1(User $user, Request $request){
        $docente=$user->id;
        $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
        if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
            Horario::destroy($horarios->id); 
            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
        }else{
            if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                Horario::destroy($horarios->id); 
                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
            }else{
                if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                    $dia=$request->input('dia1');
                    if($dia==1){
                        $id=$horarios->id;
                        $var1=$horarios->dia1_op2;
                        $var2=$horarios->hora_inicio_op2;
                        $var3=$horarios->minutos_inicio_op2;
                        $var4=$horarios->hora_fin_op2;
                        $var5=$horarios->minutos_fin_op2;
                        Horario::destroy($horarios->id);
                        DB::table('horarios')->insert([
                            'id'=>$id,
                            'usuario_id'=>$docente,
                            'dia1_op1'=>$var1,
                            'hora_inicio_op1'=>$var2,
                            'minutos_inicio_op1'=>$var3,
                            'hora_fin_op1'=>$var4,
                            'minutos_fin_op1'=>$var5,
                            'cont_dia'=>1,
                            'cont_tarde'=>0
                        ]);
                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                    }else{
                        if($dia==2){
                            $id=$horarios->id;
                            $var1=$horarios->dia1_op1;
                            $var2=$horarios->hora_inicio_op1;
                            $var3=$horarios->minutos_inicio_op1;
                            $var4=$horarios->hora_fin_op1;
                            $var5=$horarios->minutos_fin_op1;
                            Horario::destroy($horarios->id);
                            DB::table('horarios')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia1_op1'=>$var1,
                                'hora_inicio_op1'=>$var2,
                                'minutos_inicio_op1'=>$var3,
                                'hora_fin_op1'=>$var4,
                                'minutos_fin_op1'=>$var5,
                                'cont_dia'=>1,
                                'cont_tarde'=>0
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }
                    }
                }else{
                    if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                        $dia=$request->input('dia1');
                        if($dia==1){
                            $id=$horarios->id;
                            $var1=$horarios->dia1_op3;
                            $var2=$horarios->hora_inicio_op3;
                            $var3=$horarios->minutos_inicio_op3;
                            $var4=$horarios->hora_fin_op3;
                            $var5=$horarios->minutos_fin_op3;
                            Horario::destroy($horarios->id);
                            DB::table('horarios')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia1_op3'=>$var1,
                                'hora_inicio_op3'=>$var2,
                                'minutos_inicio_op3'=>$var3,
                                'hora_fin_op3'=>$var4,
                                'minutos_fin_op3'=>$var5,
                                'cont_dia'=>0,
                                'cont_tarde'=>1
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }else{
                            if($dia==3){
                                $id=$horarios->id;
                                $var1=$horarios->dia1_op1;
                                $var2=$horarios->hora_inicio_op1;
                                $var3=$horarios->minutos_inicio_op1;
                                $var4=$horarios->hora_fin_op1;
                                $var5=$horarios->minutos_fin_op1;
                                Horario::destroy($horarios->id);
                                DB::table('horarios')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia1_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,
                                    'cont_dia'=>1,
                                    'cont_tarde'=>0
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }
                        }
                    }else{
                        if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                            $dia=$request->input('dia1');
                            if($dia==1){
                                $id=$horarios->id;
                                $var1=$horarios->dia1_op2;
                                $var2=$horarios->hora_inicio_op2;
                                $var3=$horarios->minutos_inicio_op2;
                                $var4=$horarios->hora_fin_op2;
                                $var5=$horarios->minutos_fin_op2;

                                $var6=$horarios->dia1_op3;
                                $var7=$horarios->hora_inicio_op3;
                                $var8=$horarios->minutos_inicio_op3;
                                $var9=$horarios->hora_fin_op3;
                                $var10=$horarios->minutos_fin_op3;
                                Horario::destroy($horarios->id);
                                DB::table('horarios')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia1_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,

                                    'dia1_op3'=>$var6,
                                    'hora_inicio_op3'=>$var7,
                                    'minutos_inicio_op3'=>$var8,
                                    'hora_fin_op3'=>$var9,
                                    'minutos_fin_op3'=>$var10,

                                    'cont_dia'=>1,
                                    'cont_tarde'=>1
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }else{
                                if($dia==2){
                                    $id=$horarios->id;
                                    $var1=$horarios->dia1_op1;
                                    $var2=$horarios->hora_inicio_op1;
                                    $var3=$horarios->minutos_inicio_op1;
                                    $var4=$horarios->hora_fin_op1;
                                    $var5=$horarios->minutos_fin_op1;

                                    $var6=$horarios->dia1_op3;
                                    $var7=$horarios->hora_inicio_op3;
                                    $var8=$horarios->minutos_inicio_op3;
                                    $var9=$horarios->hora_fin_op3;
                                    $var10=$horarios->minutos_fin_op3;
                                    Horario::destroy($horarios->id);
                                    DB::table('horarios')->insert([
                                        'id'=>$id,
                                        'usuario_id'=>$docente,
                                        'dia1_op1'=>$var1,
                                        'hora_inicio_op1'=>$var2,
                                        'minutos_inicio_op1'=>$var3,
                                        'hora_fin_op1'=>$var4,
                                        'minutos_fin_op1'=>$var5,

                                        'dia1_op3'=>$var6,
                                        'hora_inicio_op3'=>$var7,
                                        'minutos_inicio_op3'=>$var8,
                                        'hora_fin_op3'=>$var9,
                                        'minutos_fin_op3'=>$var10,

                                        'cont_dia'=>1,
                                        'cont_tarde'=>1
                                    ]);
                                    return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                }else{
                                    if($dia==3){
                                        $id=$horarios->id;
                                        $var1=$horarios->dia1_op1;
                                        $var2=$horarios->hora_inicio_op1;
                                        $var3=$horarios->minutos_inicio_op1;
                                        $var4=$horarios->hora_fin_op1;
                                        $var5=$horarios->minutos_fin_op1;

                                        $var6=$horarios->dia1_op2;
                                        $var7=$horarios->hora_inicio_op2;
                                        $var8=$horarios->minutos_inicio_op2;
                                        $var9=$horarios->hora_fin_op2;
                                        $var10=$horarios->minutos_fin_op2;
                                        Horario::destroy($horarios->id);
                                        DB::table('horarios')->insert([
                                            'id'=>$id,
                                            'usuario_id'=>$docente,
                                            'dia1_op1'=>$var1,
                                            'hora_inicio_op1'=>$var2,
                                            'minutos_inicio_op1'=>$var3,
                                            'hora_fin_op1'=>$var4,
                                            'minutos_fin_op1'=>$var5,

                                            'dia1_op2'=>$var6,
                                            'hora_inicio_op2'=>$var7,
                                            'minutos_inicio_op2'=>$var8,
                                            'hora_fin_op2'=>$var9,
                                            'minutos_fin_op2'=>$var10,

                                            'cont_dia'=>2,
                                            'cont_tarde'=>0
                                        ]);
                                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function eliminar_horario_tutoria_asignada_op2(User $user, Request $request){
        $docente=$user->id;
        $horarios=DB::table('horario2s')->where('usuario_id',$docente)->first();
        if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
            Horario2::destroy($horarios->id); 
            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
        }else{
            if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                Horario2::destroy($horarios->id); 
                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
            }else{
                if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                    $dia=$request->input('dia');
                    if($dia==1){
                        $id=$horarios->id;
                        $var1=$horarios->dia2_op2;
                        $var2=$horarios->hora_inicio_op2;
                        $var3=$horarios->minutos_inicio_op2;
                        $var4=$horarios->hora_fin_op2;
                        $var5=$horarios->minutos_fin_op2;
                        Horario2::destroy($horarios->id);
                        DB::table('horario2s')->insert([
                            'id'=>$id,
                            'usuario_id'=>$docente,
                            'dia2_op1'=>$var1,
                            'hora_inicio_op1'=>$var2,
                            'minutos_inicio_op1'=>$var3,
                            'hora_fin_op1'=>$var4,
                            'minutos_fin_op1'=>$var5,
                            'cont_dia'=>1,
                            'cont_tarde'=>0
                        ]);
                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                    }else{
                        if($dia==2){
                            $id=$horarios->id;
                            $var1=$horarios->dia2_op1;
                            $var2=$horarios->hora_inicio_op1;
                            $var3=$horarios->minutos_inicio_op1;
                            $var4=$horarios->hora_fin_op1;
                            $var5=$horarios->minutos_fin_op1;
                            Horario2::destroy($horarios->id);
                            DB::table('horario2s')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia2_op1'=>$var1,
                                'hora_inicio_op1'=>$var2,
                                'minutos_inicio_op1'=>$var3,
                                'hora_fin_op1'=>$var4,
                                'minutos_fin_op1'=>$var5,
                                'cont_dia'=>1,
                                'cont_tarde'=>0
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }
                    }
                }else{
                    if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                        $dia=$request->input('dia');
                        if($dia==1){
                            $id=$horarios->id;
                            $var1=$horarios->dia2_op3;
                            $var2=$horarios->hora_inicio_op3;
                            $var3=$horarios->minutos_inicio_op3;
                            $var4=$horarios->hora_fin_op3;
                            $var5=$horarios->minutos_fin_op3;
                            Horario2::destroy($horarios->id);
                            DB::table('horario2s')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia2_op3'=>$var1,
                                'hora_inicio_op3'=>$var2,
                                'minutos_inicio_op3'=>$var3,
                                'hora_fin_op3'=>$var4,
                                'minutos_fin_op3'=>$var5,
                                'cont_dia'=>0,
                                'cont_tarde'=>1
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }else{
                            if($dia==3){
                                $id=$horarios->id;
                                $var1=$horarios->dia2_op1;
                                $var2=$horarios->hora_inicio_op1;
                                $var3=$horarios->minutos_inicio_op1;
                                $var4=$horarios->hora_fin_op1;
                                $var5=$horarios->minutos_fin_op1;
                                Horario2::destroy($horarios->id);
                                DB::table('horario2s')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia2_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,
                                    'cont_dia'=>1,
                                    'cont_tarde'=>0
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }
                        }
                    }else{
                        if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                            $dia=$request->input('dia');
                            if($dia==1){
                                $id=$horarios->id;
                                $var1=$horarios->dia2_op2;
                                $var2=$horarios->hora_inicio_op2;
                                $var3=$horarios->minutos_inicio_op2;
                                $var4=$horarios->hora_fin_op2;
                                $var5=$horarios->minutos_fin_op2;

                                $var6=$horarios->dia2_op3;
                                $var7=$horarios->hora_inicio_op3;
                                $var8=$horarios->minutos_inicio_op3;
                                $var9=$horarios->hora_fin_op3;
                                $var10=$horarios->minutos_fin_op3;
                                Horario2::destroy($horarios->id);
                                DB::table('horario2s')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia2_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,

                                    'dia2_op3'=>$var6,
                                    'hora_inicio_op3'=>$var7,
                                    'minutos_inicio_op3'=>$var8,
                                    'hora_fin_op3'=>$var9,
                                    'minutos_fin_op3'=>$var10,

                                    'cont_dia'=>1,
                                    'cont_tarde'=>1
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }else{
                                if($dia==2){
                                    $id=$horarios->id;
                                    $var1=$horarios->dia2_op1;
                                    $var2=$horarios->hora_inicio_op1;
                                    $var3=$horarios->minutos_inicio_op1;
                                    $var4=$horarios->hora_fin_op1;
                                    $var5=$horarios->minutos_fin_op1;

                                    $var6=$horarios->dia2_op3;
                                    $var7=$horarios->hora_inicio_op3;
                                    $var8=$horarios->minutos_inicio_op3;
                                    $var9=$horarios->hora_fin_op3;
                                    $var10=$horarios->minutos_fin_op3;
                                    Horario2::destroy($horarios->id);
                                    DB::table('horario2s')->insert([
                                        'id'=>$id,
                                        'usuario_id'=>$docente,
                                        'dia2_op1'=>$var1,
                                        'hora_inicio_op1'=>$var2,
                                        'minutos_inicio_op1'=>$var3,
                                        'hora_fin_op1'=>$var4,
                                        'minutos_fin_op1'=>$var5,

                                        'dia2_op3'=>$var6,
                                        'hora_inicio_op3'=>$var7,
                                        'minutos_inicio_op3'=>$var8,
                                        'hora_fin_op3'=>$var9,
                                        'minutos_fin_op3'=>$var10,

                                        'cont_dia'=>1,
                                        'cont_tarde'=>1
                                    ]);
                                    return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                }else{
                                    if($dia==3){
                                        $id=$horarios->id;
                                        $var1=$horarios->dia2_op1;
                                        $var2=$horarios->hora_inicio_op1;
                                        $var3=$horarios->minutos_inicio_op1;
                                        $var4=$horarios->hora_fin_op1;
                                        $var5=$horarios->minutos_fin_op1;

                                        $var6=$horarios->dia2_op2;
                                        $var7=$horarios->hora_inicio_op2;
                                        $var8=$horarios->minutos_inicio_op2;
                                        $var9=$horarios->hora_fin_op2;
                                        $var10=$horarios->minutos_fin_op2;
                                        Horario2::destroy($horarios->id);
                                        DB::table('horario2s')->insert([
                                            'id'=>$id,
                                            'usuario_id'=>$docente,
                                            'dia2_op1'=>$var1,
                                            'hora_inicio_op1'=>$var2,
                                            'minutos_inicio_op1'=>$var3,
                                            'hora_fin_op1'=>$var4,
                                            'minutos_fin_op1'=>$var5,

                                            'dia2_op2'=>$var6,
                                            'hora_inicio_op2'=>$var7,
                                            'minutos_inicio_op2'=>$var8,
                                            'hora_fin_op2'=>$var9,
                                            'minutos_fin_op2'=>$var10,

                                            'cont_dia'=>2,
                                            'cont_tarde'=>0
                                        ]);
                                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function eliminar_horario_tutoria_asignada_op3(User $user, Request $request){
        $docente=$user->id;
        $horarios=DB::table('horario3s')->where('usuario_id',$docente)->first();
        if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
            Horario3::destroy($horarios->id); 
            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
        }else{
            if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                Horario3::destroy($horarios->id); 
                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
            }else{
                if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                    $dia=$request->input('dia');
                    if($dia==1){
                        $id=$horarios->id;
                        $var1=$horarios->dia3_op2;
                        $var2=$horarios->hora_inicio_op2;
                        $var3=$horarios->minutos_inicio_op2;
                        $var4=$horarios->hora_fin_op2;
                        $var5=$horarios->minutos_fin_op2;
                        Horario3::destroy($horarios->id);
                        DB::table('horario3s')->insert([
                            'id'=>$id,
                            'usuario_id'=>$docente,
                            'dia3_op1'=>$var1,
                            'hora_inicio_op1'=>$var2,
                            'minutos_inicio_op1'=>$var3,
                            'hora_fin_op1'=>$var4,
                            'minutos_fin_op1'=>$var5,
                            'cont_dia'=>1,
                            'cont_tarde'=>0
                        ]);
                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                    }else{
                        if($dia==2){
                            $id=$horarios->id;
                            $var1=$horarios->dia3_op1;
                            $var2=$horarios->hora_inicio_op1;
                            $var3=$horarios->minutos_inicio_op1;
                            $var4=$horarios->hora_fin_op1;
                            $var5=$horarios->minutos_fin_op1;
                            Horario3::destroy($horarios->id);
                            DB::table('horario3s')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia3_op1'=>$var1,
                                'hora_inicio_op1'=>$var2,
                                'minutos_inicio_op1'=>$var3,
                                'hora_fin_op1'=>$var4,
                                'minutos_fin_op1'=>$var5,
                                'cont_dia'=>1,
                                'cont_tarde'=>0
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }
                    }
                }else{
                    if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                        $dia=$request->input('dia');
                        if($dia==1){
                            $id=$horarios->id;
                            $var1=$horarios->dia3_op3;
                            $var2=$horarios->hora_inicio_op3;
                            $var3=$horarios->minutos_inicio_op3;
                            $var4=$horarios->hora_fin_op3;
                            $var5=$horarios->minutos_fin_op3;
                            Horario3::destroy($horarios->id);
                            DB::table('horario3s')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia3_op3'=>$var1,
                                'hora_inicio_op3'=>$var2,
                                'minutos_inicio_op3'=>$var3,
                                'hora_fin_op3'=>$var4,
                                'minutos_fin_op3'=>$var5,
                                'cont_dia'=>0,
                                'cont_tarde'=>1
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }else{
                            if($dia==3){
                                $id=$horarios->id;
                                $var1=$horarios->dia3_op1;
                                $var2=$horarios->hora_inicio_op1;
                                $var3=$horarios->minutos_inicio_op1;
                                $var4=$horarios->hora_fin_op1;
                                $var5=$horarios->minutos_fin_op1;
                                Horario3::destroy($horarios->id);
                                DB::table('horario3s')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia3_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,
                                    'cont_dia'=>1,
                                    'cont_tarde'=>0
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }
                        }
                    }else{
                        if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                            $dia=$request->input('dia');
                            if($dia==1){
                                $id=$horarios->id;
                                $var1=$horarios->dia3_op2;
                                $var2=$horarios->hora_inicio_op2;
                                $var3=$horarios->minutos_inicio_op2;
                                $var4=$horarios->hora_fin_op2;
                                $var5=$horarios->minutos_fin_op2;

                                $var6=$horarios->dia3_op3;
                                $var7=$horarios->hora_inicio_op3;
                                $var8=$horarios->minutos_inicio_op3;
                                $var9=$horarios->hora_fin_op3;
                                $var10=$horarios->minutos_fin_op3;
                                Horario3::destroy($horarios->id);
                                DB::table('horario3s')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia3_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,

                                    'dia3_op3'=>$var6,
                                    'hora_inicio_op3'=>$var7,
                                    'minutos_inicio_op3'=>$var8,
                                    'hora_fin_op3'=>$var9,
                                    'minutos_fin_op3'=>$var10,

                                    'cont_dia'=>1,
                                    'cont_tarde'=>1
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }else{
                                if($dia==2){
                                    $id=$horarios->id;
                                    $var1=$horarios->dia3_op1;
                                    $var2=$horarios->hora_inicio_op1;
                                    $var3=$horarios->minutos_inicio_op1;
                                    $var4=$horarios->hora_fin_op1;
                                    $var5=$horarios->minutos_fin_op1;

                                    $var6=$horarios->dia3_op3;
                                    $var7=$horarios->hora_inicio_op3;
                                    $var8=$horarios->minutos_inicio_op3;
                                    $var9=$horarios->hora_fin_op3;
                                    $var10=$horarios->minutos_fin_op3;
                                    Horario3::destroy($horarios->id);
                                    DB::table('horario3s')->insert([
                                        'id'=>$id,
                                        'usuario_id'=>$docente,
                                        'dia3_op1'=>$var1,
                                        'hora_inicio_op1'=>$var2,
                                        'minutos_inicio_op1'=>$var3,
                                        'hora_fin_op1'=>$var4,
                                        'minutos_fin_op1'=>$var5,

                                        'dia3_op3'=>$var6,
                                        'hora_inicio_op3'=>$var7,
                                        'minutos_inicio_op3'=>$var8,
                                        'hora_fin_op3'=>$var9,
                                        'minutos_fin_op3'=>$var10,

                                        'cont_dia'=>1,
                                        'cont_tarde'=>1
                                    ]);
                                    return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                }else{
                                    if($dia==3){
                                        $id=$horarios->id;
                                        $var1=$horarios->dia3_op1;
                                        $var2=$horarios->hora_inicio_op1;
                                        $var3=$horarios->minutos_inicio_op1;
                                        $var4=$horarios->hora_fin_op1;
                                        $var5=$horarios->minutos_fin_op1;

                                        $var6=$horarios->dia3_op2;
                                        $var7=$horarios->hora_inicio_op2;
                                        $var8=$horarios->minutos_inicio_op2;
                                        $var9=$horarios->hora_fin_op2;
                                        $var10=$horarios->minutos_fin_op2;
                                        Horario3::destroy($horarios->id);
                                        DB::table('horario3s')->insert([
                                            'id'=>$id,
                                            'usuario_id'=>$docente,
                                            'dia3_op1'=>$var1,
                                            'hora_inicio_op1'=>$var2,
                                            'minutos_inicio_op1'=>$var3,
                                            'hora_fin_op1'=>$var4,
                                            'minutos_fin_op1'=>$var5,

                                            'dia3_op2'=>$var6,
                                            'hora_inicio_op2'=>$var7,
                                            'minutos_inicio_op2'=>$var8,
                                            'hora_fin_op2'=>$var9,
                                            'minutos_fin_op2'=>$var10,

                                            'cont_dia'=>2,
                                            'cont_tarde'=>0
                                        ]);
                                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function eliminar_horario_tutoria_asignada_op4(User $user, Request $request){
        $docente=$user->id;
        $horarios=DB::table('horario4s')->where('usuario_id',$docente)->first();
        if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
            Horario4::destroy($horarios->id); 
            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
        }else{
            if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                Horario4::destroy($horarios->id); 
                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
            }else{
                if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                    $dia=$request->input('dia');
                    if($dia==1){
                        $id=$horarios->id;
                        $var1=$horarios->dia4_op2;
                        $var2=$horarios->hora_inicio_op2;
                        $var3=$horarios->minutos_inicio_op2;
                        $var4=$horarios->hora_fin_op2;
                        $var5=$horarios->minutos_fin_op2;
                        Horario4::destroy($horarios->id);
                        DB::table('horario4s')->insert([
                            'id'=>$id,
                            'usuario_id'=>$docente,
                            'dia4_op1'=>$var1,
                            'hora_inicio_op1'=>$var2,
                            'minutos_inicio_op1'=>$var3,
                            'hora_fin_op1'=>$var4,
                            'minutos_fin_op1'=>$var5,
                            'cont_dia'=>1,
                            'cont_tarde'=>0
                        ]);
                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                    }else{
                        if($dia==2){
                            $id=$horarios->id;
                            $var1=$horarios->dia4_op1;
                            $var2=$horarios->hora_inicio_op1;
                            $var3=$horarios->minutos_inicio_op1;
                            $var4=$horarios->hora_fin_op1;
                            $var5=$horarios->minutos_fin_op1;
                            Horario4::destroy($horarios->id);
                            DB::table('horario4s')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia4_op1'=>$var1,
                                'hora_inicio_op1'=>$var2,
                                'minutos_inicio_op1'=>$var3,
                                'hora_fin_op1'=>$var4,
                                'minutos_fin_op1'=>$var5,
                                'cont_dia'=>1,
                                'cont_tarde'=>0
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }
                    }
                }else{
                    if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                        $dia=$request->input('dia');
                        if($dia==1){
                            $id=$horarios->id;
                            $var1=$horarios->dia4_op3;
                            $var2=$horarios->hora_inicio_op3;
                            $var3=$horarios->minutos_inicio_op3;
                            $var4=$horarios->hora_fin_op3;
                            $var5=$horarios->minutos_fin_op3;
                            Horario4::destroy($horarios->id);
                            DB::table('horario4s')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia4_op3'=>$var1,
                                'hora_inicio_op3'=>$var2,
                                'minutos_inicio_op3'=>$var3,
                                'hora_fin_op3'=>$var4,
                                'minutos_fin_op3'=>$var5,
                                'cont_dia'=>0,
                                'cont_tarde'=>1
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }else{
                            if($dia==3){
                                $id=$horarios->id;
                                $var1=$horarios->dia4_op1;
                                $var2=$horarios->hora_inicio_op1;
                                $var3=$horarios->minutos_inicio_op1;
                                $var4=$horarios->hora_fin_op1;
                                $var5=$horarios->minutos_fin_op1;
                                Horario4::destroy($horarios->id);
                                DB::table('horario4s')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia4_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,
                                    'cont_dia'=>1,
                                    'cont_tarde'=>0
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }
                        }
                    }else{
                        if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                            $dia=$request->input('dia');
                            if($dia==1){
                                $id=$horarios->id;
                                $var1=$horarios->dia4_op2;
                                $var2=$horarios->hora_inicio_op2;
                                $var3=$horarios->minutos_inicio_op2;
                                $var4=$horarios->hora_fin_op2;
                                $var5=$horarios->minutos_fin_op2;

                                $var6=$horarios->dia4_op3;
                                $var7=$horarios->hora_inicio_op3;
                                $var8=$horarios->minutos_inicio_op3;
                                $var9=$horarios->hora_fin_op3;
                                $var10=$horarios->minutos_fin_op3;
                                Horario4::destroy($horarios->id);
                                DB::table('horario4s')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia4_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,

                                    'dia4_op3'=>$var6,
                                    'hora_inicio_op3'=>$var7,
                                    'minutos_inicio_op3'=>$var8,
                                    'hora_fin_op3'=>$var9,
                                    'minutos_fin_op3'=>$var10,

                                    'cont_dia'=>1,
                                    'cont_tarde'=>1
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }else{
                                if($dia==2){
                                    $id=$horarios->id;
                                    $var1=$horarios->dia4_op1;
                                    $var2=$horarios->hora_inicio_op1;
                                    $var3=$horarios->minutos_inicio_op1;
                                    $var4=$horarios->hora_fin_op1;
                                    $var5=$horarios->minutos_fin_op1;

                                    $var6=$horarios->dia4_op3;
                                    $var7=$horarios->hora_inicio_op3;
                                    $var8=$horarios->minutos_inicio_op3;
                                    $var9=$horarios->hora_fin_op3;
                                    $var10=$horarios->minutos_fin_op3;
                                    Horario4::destroy($horarios->id);
                                    DB::table('horario4s')->insert([
                                        'id'=>$id,
                                        'usuario_id'=>$docente,
                                        'dia4_op1'=>$var1,
                                        'hora_inicio_op1'=>$var2,
                                        'minutos_inicio_op1'=>$var3,
                                        'hora_fin_op1'=>$var4,
                                        'minutos_fin_op1'=>$var5,

                                        'dia4_op3'=>$var6,
                                        'hora_inicio_op3'=>$var7,
                                        'minutos_inicio_op3'=>$var8,
                                        'hora_fin_op3'=>$var9,
                                        'minutos_fin_op3'=>$var10,

                                        'cont_dia'=>1,
                                        'cont_tarde'=>1
                                    ]);
                                    return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                }else{
                                    if($dia==3){
                                        $id=$horarios->id;
                                        $var1=$horarios->dia4_op1;
                                        $var2=$horarios->hora_inicio_op1;
                                        $var3=$horarios->minutos_inicio_op1;
                                        $var4=$horarios->hora_fin_op1;
                                        $var5=$horarios->minutos_fin_op1;

                                        $var6=$horarios->dia4_op2;
                                        $var7=$horarios->hora_inicio_op2;
                                        $var8=$horarios->minutos_inicio_op2;
                                        $var9=$horarios->hora_fin_op2;
                                        $var10=$horarios->minutos_fin_op2;
                                        Horario4::destroy($horarios->id);
                                        DB::table('horario4s')->insert([
                                            'id'=>$id,
                                            'usuario_id'=>$docente,
                                            'dia4_op1'=>$var1,
                                            'hora_inicio_op1'=>$var2,
                                            'minutos_inicio_op1'=>$var3,
                                            'hora_fin_op1'=>$var4,
                                            'minutos_fin_op1'=>$var5,

                                            'dia4_op2'=>$var6,
                                            'hora_inicio_op2'=>$var7,
                                            'minutos_inicio_op2'=>$var8,
                                            'hora_fin_op2'=>$var9,
                                            'minutos_fin_op2'=>$var10,

                                            'cont_dia'=>2,
                                            'cont_tarde'=>0
                                        ]);
                                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function eliminar_horario_tutoria_asignada_op5(User $user, Request $request){
        $docente=$user->id;
        $horarios=DB::table('horario5s')->where('usuario_id',$docente)->first();
        if($horarios->cont_dia==0 && $horarios->cont_tarde==1){
            Horario5::destroy($horarios->id); 
            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
        }else{
            if($horarios->cont_dia==1 && $horarios->cont_tarde==0){
                Horario5::destroy($horarios->id); 
                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
            }else{
                if($horarios->cont_dia==2 && $horarios->cont_tarde==0){
                    $dia=$request->input('dia');
                    if($dia==1){
                        $id=$horarios->id;
                        $var1=$horarios->dia5_op2;
                        $var2=$horarios->hora_inicio_op2;
                        $var3=$horarios->minutos_inicio_op2;
                        $var4=$horarios->hora_fin_op2;
                        $var5=$horarios->minutos_fin_op2;
                        Horario5::destroy($horarios->id);
                        DB::table('horario5s')->insert([
                            'id'=>$id,
                            'usuario_id'=>$docente,
                            'dia5_op1'=>$var1,
                            'hora_inicio_op1'=>$var2,
                            'minutos_inicio_op1'=>$var3,
                            'hora_fin_op1'=>$var4,
                            'minutos_fin_op1'=>$var5,
                            'cont_dia'=>1,
                            'cont_tarde'=>0
                        ]);
                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                    }else{
                        if($dia==2){
                            $id=$horarios->id;
                            $var1=$horarios->dia5_op1;
                            $var2=$horarios->hora_inicio_op1;
                            $var3=$horarios->minutos_inicio_op1;
                            $var4=$horarios->hora_fin_op1;
                            $var5=$horarios->minutos_fin_op1;
                            Horario5::destroy($horarios->id);
                            DB::table('horario5s')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia5_op1'=>$var1,
                                'hora_inicio_op1'=>$var2,
                                'minutos_inicio_op1'=>$var3,
                                'hora_fin_op1'=>$var4,
                                'minutos_fin_op1'=>$var5,
                                'cont_dia'=>1,
                                'cont_tarde'=>0
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }
                    }
                }else{
                    if($horarios->cont_dia==1 && $horarios->cont_tarde==1){
                        $dia=$request->input('dia');
                        if($dia==1){
                            $id=$horarios->id;
                            $var1=$horarios->dia5_op3;
                            $var2=$horarios->hora_inicio_op3;
                            $var3=$horarios->minutos_inicio_op3;
                            $var4=$horarios->hora_fin_op3;
                            $var5=$horarios->minutos_fin_op3;
                            Horario5::destroy($horarios->id);
                            DB::table('horario5s')->insert([
                                'id'=>$id,
                                'usuario_id'=>$docente,
                                'dia5_op3'=>$var1,
                                'hora_inicio_op3'=>$var2,
                                'minutos_inicio_op3'=>$var3,
                                'hora_fin_op3'=>$var4,
                                'minutos_fin_op3'=>$var5,
                                'cont_dia'=>0,
                                'cont_tarde'=>1
                            ]);
                            return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                        }else{
                            if($dia==3){
                                $id=$horarios->id;
                                $var1=$horarios->dia5_op1;
                                $var2=$horarios->hora_inicio_op1;
                                $var3=$horarios->minutos_inicio_op1;
                                $var4=$horarios->hora_fin_op1;
                                $var5=$horarios->minutos_fin_op1;
                                Horario5::destroy($horarios->id);
                                DB::table('horario5s')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia5_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,
                                    'cont_dia'=>1,
                                    'cont_tarde'=>0
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }
                        }
                    }else{
                        if($horarios->cont_dia==2 && $horarios->cont_tarde==1){
                            $dia=$request->input('dia');
                            if($dia==1){
                                $id=$horarios->id;
                                $var1=$horarios->dia5_op2;
                                $var2=$horarios->hora_inicio_op2;
                                $var3=$horarios->minutos_inicio_op2;
                                $var4=$horarios->hora_fin_op2;
                                $var5=$horarios->minutos_fin_op2;

                                $var6=$horarios->dia5_op3;
                                $var7=$horarios->hora_inicio_op3;
                                $var8=$horarios->minutos_inicio_op3;
                                $var9=$horarios->hora_fin_op3;
                                $var10=$horarios->minutos_fin_op3;
                                Horario5::destroy($horarios->id);
                                DB::table('horario5s')->insert([
                                    'id'=>$id,
                                    'usuario_id'=>$docente,
                                    'dia5_op1'=>$var1,
                                    'hora_inicio_op1'=>$var2,
                                    'minutos_inicio_op1'=>$var3,
                                    'hora_fin_op1'=>$var4,
                                    'minutos_fin_op1'=>$var5,

                                    'dia5_op3'=>$var6,
                                    'hora_inicio_op3'=>$var7,
                                    'minutos_inicio_op3'=>$var8,
                                    'hora_fin_op3'=>$var9,
                                    'minutos_fin_op3'=>$var10,

                                    'cont_dia'=>1,
                                    'cont_tarde'=>1
                                ]);
                                return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                            }else{
                                if($dia==2){
                                    $id=$horarios->id;
                                    $var1=$horarios->dia5_op1;
                                    $var2=$horarios->hora_inicio_op1;
                                    $var3=$horarios->minutos_inicio_op1;
                                    $var4=$horarios->hora_fin_op1;
                                    $var5=$horarios->minutos_fin_op1;

                                    $var6=$horarios->dia5_op3;
                                    $var7=$horarios->hora_inicio_op3;
                                    $var8=$horarios->minutos_inicio_op3;
                                    $var9=$horarios->hora_fin_op3;
                                    $var10=$horarios->minutos_fin_op3;
                                    Horario5::destroy($horarios->id);
                                    DB::table('horario5s')->insert([
                                        'id'=>$id,
                                        'usuario_id'=>$docente,
                                        'dia5_op1'=>$var1,
                                        'hora_inicio_op1'=>$var2,
                                        'minutos_inicio_op1'=>$var3,
                                        'hora_fin_op1'=>$var4,
                                        'minutos_fin_op1'=>$var5,

                                        'dia5_op3'=>$var6,
                                        'hora_inicio_op3'=>$var7,
                                        'minutos_inicio_op3'=>$var8,
                                        'hora_fin_op3'=>$var9,
                                        'minutos_fin_op3'=>$var10,

                                        'cont_dia'=>1,
                                        'cont_tarde'=>1
                                    ]);
                                    return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                }else{
                                    if($dia==3){
                                        $id=$horarios->id;
                                        $var1=$horarios->dia5_op1;
                                        $var2=$horarios->hora_inicio_op1;
                                        $var3=$horarios->minutos_inicio_op1;
                                        $var4=$horarios->hora_fin_op1;
                                        $var5=$horarios->minutos_fin_op1;

                                        $var6=$horarios->dia5_op2;
                                        $var7=$horarios->hora_inicio_op2;
                                        $var8=$horarios->minutos_inicio_op2;
                                        $var9=$horarios->hora_fin_op2;
                                        $var10=$horarios->minutos_fin_op2;
                                        Horario5::destroy($horarios->id);
                                        DB::table('horario5s')->insert([
                                            'id'=>$id,
                                            'usuario_id'=>$docente,
                                            'dia5_op1'=>$var1,
                                            'hora_inicio_op1'=>$var2,
                                            'minutos_inicio_op1'=>$var3,
                                            'hora_fin_op1'=>$var4,
                                            'minutos_fin_op1'=>$var5,

                                            'dia5_op2'=>$var6,
                                            'hora_inicio_op2'=>$var7,
                                            'minutos_inicio_op2'=>$var8,
                                            'hora_fin_op2'=>$var9,
                                            'minutos_fin_op2'=>$var10,

                                            'cont_dia'=>2,
                                            'cont_tarde'=>0
                                        ]);
                                        return redirect()->route('eliminar_horario_tutoria_asignada_op1_1',['user'=>$user]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function eliminar_horario_tutoria_asignada_op1_1(User $user){
        $docente=$user->id;
        $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
        $horario2s=DB::table('horario2s')->where('usuario_id',$docente)->first();
        $horario3s=DB::table('horario3s')->where('usuario_id',$docente)->first();
        $horario4s=DB::table('horario4s')->where('usuario_id',$docente)->first();
        $horario5s=DB::table('horario5s')->where('usuario_id',$docente)->first();
        flash("El horario de tutoría ha sido eliminado")->error();
        return view('user_administrador.horario_tutoria_asignada',compact('user','horarios','horario2s','horario3s','horario4s','horario5s'));
    }
/* 
|--------------------------------------------------------------------------
| Funciones para sistema de log
|--------------------------------------------------------------------------
*/
    public function log(){
        if (Auth::check()) {
            $admin = Auth::user();
            if($admin->is_admin==true){
                $aux=0;
                $login_estudiantes=DB::table('logs')->where('tipo',1)->where('tipo_usuario',2)->get();
                $login_docentes=DB::table('logs')->where('tipo',1)->where('tipo_usuario',3)->get();
                $tutorias_solicitadas=DB::table('logs')->where('tipo',2)->where('tipo_usuario',3)->get();
                $notificaciones_docentes=DB::table('logs')->where('tipo',3)->where('tipo_usuario',2)->get();
                $notificaciones_estudiantes=DB::table('logs')->where('tipo',3)->where('tipo_usuario',3)->get();
                $invitaciones_estudiantes=DB::table('logs')->where('tipo',4)->where('tipo_usuario',2)->get();
                return view('user_administrador.vista_sistema_log',compact('aux','login_estudiantes','login_docentes','tutorias_solicitadas','notificaciones_docentes',
                    'invitaciones_estudiantes','notificaciones_estudiantes'));
            }else{
                return redirect()->route('show_login_form');
            }
        }
    }
    public function descargar_log($aux){
        $logs=Log::orderBy('id','ASC')
            ->paginate(10);
        return view('user_administrador.vista_sistema_log',compact('logs','aux'));
    }
/* 
|--------------------------------------------------------------------------
| Funciones para ver las claves de los usarios registrados
|--------------------------------------------------------------------------
*/
    public function claves(){
        if (Auth::check()) {
            $admin = Auth::user();
            if($admin->is_admin==true){
                return view('user_administrador.vista_claves');
            }else{
                return redirect()->route('show_login_form');
            }
        }
    }
}