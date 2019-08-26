<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Materia;
use App\Solitutoria;
use App\Notifications\NotificacionDocente;
use App\Notidocente;
use App\Notifications\InvitacionEstudiante;
use App\Invitacion;
use App\Notifications\NotificacionEstudiante;
use App\Notiestudiante;
use App\Evaluacion;
use App\Log;
use Alert;
use Mail;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Redirect;

class AuthStudentController extends Controller
{
/* 
|--------------------------------------------------------------------------
| Funciones para detectar y redirigir a la pagina del estudiante autenticado
|--------------------------------------------------------------------------
*/
    public function __construct(){
        $this->middleware('auth');
    }

    public function auth_student(){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $fecha=now();
                Log::create([
                    'detalle'=>"El estudiante ".$user_student->name." ".$user_student->lastname." ha iniciado sesión y accedido al sistema.",
                    'fecha'=>$fecha,
                ]);
                if($user_student->paralelo=="NA" && $user_student->ciclo=="NA"){
                    $materias=Materia::orderBy('id','DESC')
                        ->paginate(5);
                    Alert::success('¡Bienvenido(a)! ')
                        ->details("$user_student->name $user_student->lastname.");
                    $verifica_arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->exists();
                    if($verifica_arrastre==true){
                        $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->first();
                        $arreglo_materia=explode('.', $arrastre->materia);
                        $arreglo_paralelo=explode('.', $arrastre->paralelo);
                        return view('user_student.completar_registro',compact('user_student','materias','arrastre','arreglo_materia','verifica_arrastre','arreglo_paralelo'));
                    }else{
                        return view('user_student.completar_registro',compact('user_student','materias','verifica_arrastre'));
                    }
                }else{
                    return view('user_student.auth_student'); 
                } 
            }else{
                return redirect()->route('show_login_form_student');
            }
        } 
    }
/* 
|--------------------------------------------------------------------------
| Funciones para la vista general del estudiante
|--------------------------------------------------------------------------
*/
    public function vista_general_student(){
        return view('user_student.vista_general_cuenta');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para la vista general del estudiante con cuenta de google
|--------------------------------------------------------------------------
*/
    public function vista_student_google(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                if($user_student->paralelo=="NA" && $user_student->ciclo=="NA"){
                    $materias=Materia::orderBy('id','DESC')
                        ->paginate(1);
                    $verifica_arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->exists();
                    $docentes=DB::table('users')->where('is_docente',true)->get();
                    if($verifica_arrastre==true){
                        $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->first();
                        $arreglo_materia=explode('.', $arrastre->materia);
                        $arreglo_paralelo=explode('.', $arrastre->paralelo);
                        return view('user_student.completar_registro',compact('user_student','materias','arrastre','arreglo_materia','verifica_arrastre','arreglo_paralelo','docentes'));
                    }else{
                        return view('user_student.completar_registro',compact('user_student','materias','verifica_arrastre','docentes'));
                    }   
                }else{
                    return view('user_student.auth_student'); 
                } 
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para completar el registro del estudiante logueado o registrado con cuenta de google
|--------------------------------------------------------------------------
*/
    public function save_completar_registro(){
        if (Auth::check()) {
            $user = Auth::user();

            $data=request()->validate([
                'ciclo'=>'required',
                'paralelo'=>'required',
                'password'=>'required'
            ]);

            if ($data["password"]!=null) {
                $data["password"]=bcrypt($data['password']);
            }else{
                unset($data["password"]);
            }
            $user->update($data);
            return redirect()->route('auth_student');
        }
    }
    public function buscar_materia_arrastre(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $name = $request->get('name');
                if($user_student->paralelo=="NA" && $user_student->ciclo=="NA"){
                    $materias=Materia::orderBy('id','DESC')
                        ->name($name)
                        ->paginate(3);
                    $docentes=DB::table('users')->where('is_docente',true)->get();
                    $verifica_arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->exists();
                    if($verifica_arrastre==true){
                        $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->first();
                        $arreglo_materia=explode('.', $arrastre->materia);
                        $arreglo_paralelo=explode('.', $arrastre->paralelo);
                        return view('user_student.completar_registro',compact('user_student','materias','arrastre','arreglo_materia','verifica_arrastre','arreglo_paralelo','docentes'));
                    }else{
                        return view('user_student.completar_registro',compact('user_student','materias','verifica_arrastre','docentes'));
                    }
                }else{
                    return view('user_student.auth_student'); 
                } 
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function agregar_materia_arrastre(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                if($user_student->paralelo=="NA" && $user_student->ciclo=="NA"){
                    $data=request()->validate([
                        'paralelo'=>'required',
                        'docente'=>'required'
                    ]);
                    $materia_id=$request->input('materia');
                    $paralelo=$request->input('paralelo');
                    $docente_id=$request->input('docente');
                    $materia=DB::table('materias')->where('id',$materia_id)->first();
                    $verifica_arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->exists();
                    if($verifica_arrastre==true){
                        $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->first();
                        $id=$arrastre->id;
                        $materia_agregada=$arrastre->materia;
                        $paralelo_agregado=$arrastre->paralelo;
                        $docente_agregado=$arrastre->docente;
                        if($arrastre->materia==null){
                            $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id);
                            $arrastre->delete();
                            DB::table('arrastres')->insert([
                                'id'=>$id,
                                'user_estudiante_id'=>$user_student->id,
                                'materia'=>$materia_id,
                                'paralelo'=>$paralelo,
                                'docente'=>$docente_id
                            ]);
                        }else{
                            $arreglo_materia_agregada=explode('.', $materia_agregada);
                            foreach ($arreglo_materia_agregada as $recorre) {
                                if($recorre==$materia_id){
                                    flash("La materia $materia->name, ya ha sido añadida")->error();
                                    return redirect()->route('vista_student_google');
                                }                            
                            }
                            $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id);
                            $arrastre->delete();
                            DB::table('arrastres')->insert([
                                'id'=>$id,
                                'user_estudiante_id'=>$user_student->id,
                                'materia'=>$materia_agregada.".".$materia_id,
                                'paralelo'=>$paralelo_agregado.".".$paralelo,
                                'docente'=>$docente_agregado.".".$docente_id
                            ]);
                        }
                    }else{
                        DB::table('arrastres')->insert([
                            'user_estudiante_id'=>$user_student->id,
                            'materia'=>$materia_id,
                            'paralelo'=>$paralelo,
                            'docente'=>$docente_id
                        ]);
                    }
                    flash("La materia $materia->name, ha sido añadida")->success();
                    return redirect()->route('vista_student_google');
                }else{
                    return view('user_student.auth_student'); 
                } 
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function eliminar_materia_agregada(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                if($user_student->paralelo=="NA" && $user_student->ciclo=="NA"){
                    $materia_id=$request->input('materia');
                    $materia=DB::table('materias')->where('id',$materia_id)->first();
                    $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->first();
                    $arreglo_materia=explode('.', $arrastre->materia);
                    $arreglo_paralelo=explode('.', $arrastre->paralelo);
                    $arreglo_docente=explode('.', $arrastre->docente);
                    for ($i=0; $i < count($arreglo_materia); $i++) { 
                        if($arreglo_materia[$i]==$materia){
                            unset($arreglo_materia[$i]);
                            unset($arreglo_paralelo[$i]);
                            unset($arreglo_docente[$i]);

                            $id=$arrastre->id;
                            //$paralelo = implode(',', $paralelo);
                            $materia_agregada=implode('.',$arreglo_materia);
                            $paralelo_agregado=implode('.',$arreglo_paralelo);
                            $docente_agregado=implode('.',$arreglo_docente);
                            $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id);
                            $arrastre->delete();
                            DB::table('arrastres')->insert([
                                'id'=>$id,
                                'user_estudiante_id'=>$user_student->id,
                                'materia'=>$materia_agregada,
                                'paralelo'=>$paralelo_agregado,
                                'docente'=>$docente_agregado,
                            ]);
                        }
                    }
                    flash("La materia $materia->name, ha sido eliminada")->warning();
                    return redirect()->route('vista_student_google');
                }else{
                    return view('user_student.auth_student'); 
                } 
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para botón omitir cuando el estudiante está logueado o registrado con cuenta de google
|--------------------------------------------------------------------------
*/
    public function omitir_completar_registro(){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->ciclo!="NA"){
                return redirect()->route('auth_student');
            }else{
                return view('user_student.completar_registro',compact('user_student'));
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar perfil del estudiante
|--------------------------------------------------------------------------
*/
    public function editar_perfil_student(){
        return view('user_student.editar_perfil_student');
    }
    public function editar_student(){
        if (Auth::check()) {
            $user = Auth::user();
            
            $data=request()->validate([
                'name'=>'required',
                'lastname'=>'required',
                'password'=>''
            ]);

            if ($data["password"]!=null) {
                $data["password"]=bcrypt($data['password']);
                //$data["password"]=$data['password'];
            }else{
                unset($data["password"]);
            }
            $user->update($data);
            flash("Perfil editado correctamente")->success();
            return redirect()->action('AuthStudentController@vista_general_student');
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para solicitar tutoria
|--------------------------------------------------------------------------
*/
    public function solicitar_tutoria(){
        if (Auth::check()) {
            $user = Auth::user();
            if($user->is_estudiante==true){
                $materias = DB::table('materias')->get();
                $users_docentes=DB::table('users')->where('is_docente',true)->get();
                if($user->paralelo=="arrastre" && $user->ciclo=="arrastre"){
                    $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user->id)->get();
                    return view('user_student.solicitar_tutoria_arrastre',compact('arrastre','users_docentes','materias'));
                }else{
                    return view('user_student.solicitar_tutoria',compact('materias','user','users_docentes'));
                }
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function vista_solicitar_tutoria(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                if($request->isMethod('post')){
                    $id_docente=$request->input("id_docente");
                    $id_materia=$request->input("id_materia");
                    $accion=$request->input("accion");
                    $materia=DB::table('materias')->where('id',$id_materia)->first();
                    $user_docente=DB::table('users')->where('id',$id_docente)->first();

                    $verifica_horarios=DB::table('horarios')->where('usuario_id',$id_docente)->exists();
                    $verifica_horarios2=DB::table('horario2s')->where('usuario_id',$id_docente)->exists();
                    $verifica_horarios3=DB::table('horario3s')->where('usuario_id',$id_docente)->exists();
                    $verifica_horarios4=DB::table('horario4s')->where('usuario_id',$id_docente)->exists();
                    $verifica_horarios5=DB::table('horario5s')->where('usuario_id',$id_docente)->exists();
                    if($verifica_horarios==true || $verifica_horarios2==true || $verifica_horarios3==true || $verifica_horarios4==true || $verifica_horarios5==true){
                        $horarios=DB::table('horarios')->where('usuario_id',$id_docente)->first();
                        $horarios2=DB::table('horario2s')->where('usuario_id',$id_docente)->first();
                        $horarios3=DB::table('horario3s')->where('usuario_id',$id_docente)->first();
                        $horarios4=DB::table('horario4s')->where('usuario_id',$id_docente)->first();
                        $horarios5=DB::table('horario5s')->where('usuario_id',$id_docente)->first();
                    }else{
                        $estado=1;
                        return view('user_student.vista_solicitar_tutoria',compact('estado','user_docente'));
                    }
                    $invitacion=DB::table('invitacionestudiantes')->where('user_invita_id',$user_student->id)
                        ->where('solitutoria_id',null)
                        ->first();
                    if($invitacion!=null){
                        $arreglo_est_inv=explode('.', $invitacion->user_invitado_id);
                        if($invitacion->user_invitado_id==null){
                            $arreglo_est_inv=null;
                        }
                    }else{
                        $arreglo_est_inv=null;
                    }
                    $lista_estudiantes_sin_arrastre=User::orderBy('id','DESC')
                        ->where('is_estudiante',true)->where('paralelo',$user_student->paralelo)->where('ciclo',$user_student->ciclo)->where('id','!=',$user_student->id)
                        ->paginate(3);
                    if($accion=='v_p'){
                        $seleccionado=0;
                        $estado=0;
                        return view('user_student.vista_solicitar_tutoria',compact('materia','user_docente','accion','seleccionado','estado','accion','lista_estudiantes_sin_arrastre','invitacion','arreglo_est_inv','horarios','horarios2','horarios3','horarios4','horarios5'));
                    }
                    if($accion=="buscar"){
                        $seleccionado=1;
                        $estado=0;
                        $lista_estudiantes_sin_arrastre=$this->buscar_estudiante($request);
                        Alert::success('')
                            ->details('Resultados encontrados');
                        return view('user_student.vista_solicitar_tutoria',compact('materia','user_docente','accion','seleccionado','estado','accion','lista_estudiantes_sin_arrastre','invitacion','arreglo_est_inv','horarios','horarios2','horarios3','horarios4','horarios5'));
                    }
                    if($accion=="invitar"){
                        $id_estudiante_invitado=$request->input('estudiante');
                        $user_invitado_msj=DB::table('users')->where('id',$id_estudiante_invitado)->first();
                        $seleccionado=1;
                        $estado=0;
                        $invitacion=$this->invitar_estudiante($request);
                        if($invitacion=="error"){
                            $invitacion=DB::table('invitacionestudiantes')->where('user_invita_id',$user_student->id)
                                ->where('solitutoria_id',null)
                                ->first();
                            flash("El estudiante $user_invitado_msj->name $user_invitado_msj->lastname, ya ha sido invitado")->error(); 
                        }else{
                            if($invitacion=="error_dia"){
                                //dd("Hola");
                                $invitacion=DB::table('invitacionestudiantes')->where('user_invita_id',$user_student->id)
                                    ->where('solitutoria_id',null)
                                    ->first();
                                //dd($invitacion);
                                flash("Usted ya ha solicitado tutoría, este proceso puede hacerlo una vez por día")->error();
                            }else{
                                $arreglo_est_inv=explode('.', $invitacion->user_invitado_id);
                                flash("El estudiante $user_invitado_msj->name $user_invitado_msj->lastname, ha sido invitado")->success();
                            }
                        }
                        return view('user_student.vista_solicitar_tutoria',compact('materia','user_docente','accion','seleccionado','estado','accion','lista_estudiantes_sin_arrastre','invitacion','arreglo_est_inv','horarios','horarios2','horarios3','horarios4','horarios5'));
                    }
                    if($accion=="cancelar_invitacion"){
                        $id_est_cancelar_inv=$request->input("id_est_cancelar_inv");
                        $user_invitado_msj=DB::table('users')->where('id',$id_est_cancelar_inv)->first();
                        $seleccionado=1;
                        $estado=0;
                        $invitacion=$this->cancelar_invitacion($request);
                        if($invitacion!=null){
                            $arreglo_est_inv=explode('.', $invitacion->user_invitado_id);
                            if($invitacion->user_invitado_id==null){
                                $arreglo_est_inv=null;
                            }
                        }else{
                            $arreglo_est_inv=null;
                        }
                        flash("Ha cancelado la invitación a $user_invitado_msj->name $user_invitado_msj->lastname")->warning();
                        return view('user_student.vista_solicitar_tutoria',compact('materia','user_docente','accion','seleccionado','estado','accion','lista_estudiantes_sin_arrastre','invitacion','arreglo_est_inv','horarios','horarios2','horarios3','horarios4','horarios5'));
                    }
                }
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function buscar_estudiante(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $name = $request->input('name');
                $lastname = $request->input('lastname');
                if($user_student->ciclo=="arrastre" && $user_student->paralelo=="arrastre"){
                    $lista_estudiantes_sin_arrastre=User::orderBy('id','DESC')
                        ->name($name)
                        ->lastname($lastname)
                        ->where('is_estudiante',true)->where('id','!=',$user_student->id)
                        ->paginate(7);
                    return $lista_estudiantes_sin_arrastre;
                }
                $lista_estudiantes_sin_arrastre=User::orderBy('id','DESC')
                    ->name($name)
                    ->lastname($lastname)
                    ->where('is_estudiante',true)->where('paralelo',$user_student->paralelo)->where('ciclo',$user_student->ciclo)->where('id','!=',$user_student->id)
                    ->paginate(7);
                return $lista_estudiantes_sin_arrastre;
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function invitar_estudiante(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $id_estudiante_invitado=$request->input('estudiante');

                $fecha_actual=now();
                $date = date_create($fecha_actual);
                $fecha_hoy=date_format($date, 'd-m-Y');
                    
                $verifica_dia=DB::table('invitacionestudiantes')
                    ->where('user_invita_id',$user_student->id)
                    ->where('solitutoria_id','!=',null)
                    ->exists();
                //dd($verifica_dia);
                if($verifica_dia==true){
                    $invs=DB::table('invitacionestudiantes')->where('user_invita_id',$user_student->id)->where('solitutoria_id','!=',null)->get();
                    foreach ($invs as $inv) {
                        $fecha_invita=$inv->fecha_invita;
                        $arreglo_fecha_invita=explode('.',$fecha_invita);
                        for ($i=0; $i < count($arreglo_fecha_invita); $i++) { 
                            $fecha_tut=$arreglo_fecha_invita[$i];
                            $date = date_create($fecha_tut);
                            $fecha_tut=date_format($date, 'd-m-Y');
                            if($fecha_tut==$fecha_hoy){
                                $invitacion="error_dia";
                                return $invitacion;
                            }
                        }
                    }
                }
                $verifica_invitacion=DB::table('invitacionestudiantes')
                    ->where('user_invita_id',$user_student->id)
                    ->where('solitutoria_id',null)
                    ->exists();

                if($verifica_invitacion==true){
                    $invitacion=DB::table('invitacionestudiantes')->where('user_invita_id',$user_student->id)
                        ->where('solitutoria_id',null)
                        ->first();
                    $id=$invitacion->id;
                    $user_invitado=$invitacion->user_invitado_id;
                    $confirmacion=$invitacion->confirmacion;
                    $fecha_invita=$invitacion->fecha_invita;
                    if($invitacion->user_invitado_id==null){
                        $invitacion=DB::table('invitacionestudiantes')->where('id',$id);
                        $invitacion->delete();

                        DB::table('invitacionestudiantes')->insert([
                            'id'=>$id,
                            'user_invita_id'=>$user_student->id,
                            'user_invitado_id'=>$id_estudiante_invitado,
                            'confirmacion'=>"no",
                            'fecha_invita'=>$fecha_actual,
                        ]);
                    }else{
                        //dd("David")->aqui hacer el control cuando quiere invitar alumno que ya ha invitado;
                        $arreglo_est_inv=explode('.', $user_invitado);
                        foreach ($arreglo_est_inv as $recorre) {
                            if($recorre==$id_estudiante_invitado){
                                $invitacion="error";
                                return $invitacion;
                            }                            
                        }
                        $invitacion=DB::table('invitacionestudiantes')->where('id',$id);
                        $invitacion->delete();
                        DB::table('invitacionestudiantes')->insert([
                            'id'=>$id,
                            'user_invita_id'=>$user_student->id,
                            'user_invitado_id'=>$user_invitado.".".$id_estudiante_invitado,
                            'confirmacion'=>$confirmacion."."."no",
                            'fecha_invita'=>$fecha_invita.".".$fecha_actual,
                        ]);
                    }
                }else{
                    DB::table('invitacionestudiantes')->insert([
                        'user_invita_id'=>$user_student->id,
                        'user_invitado_id'=>$id_estudiante_invitado,
                        'confirmacion'=>"no",
                        'fecha_invita'=>$fecha_actual,
                    ]);
                }
                
                $invitacion=DB::table('invitacionestudiantes')->where('user_invita_id',$user_student->id)
                    ->where('solitutoria_id',null)
                    ->first();
                return $invitacion;
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function cancelar_invitacion(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $id_est_cancelar_inv=$request->input("id_est_cancelar_inv");

                $invitacion=DB::table('invitacionestudiantes')->where('user_invita_id',$user_student->id)
                    ->where('solitutoria_id')
                    ->first();
                $arreglo_est_inv=explode('.', $invitacion->user_invitado_id);
                $arreglo_fecha_inv=explode('.', $invitacion->fecha_invita);
                $arreglo_confirmacion=explode('.', $invitacion->confirmacion);
                for ($i=0; $i < count($arreglo_est_inv); $i++) { 
                    if($arreglo_est_inv[$i]==$id_est_cancelar_inv){
                        unset($arreglo_est_inv[$i]);
                        unset($arreglo_fecha_inv[$i]);
                        unset($arreglo_confirmacion[$i]);

                        $id=$invitacion->id;
                        $user_invitado=implode('.',$arreglo_est_inv);
                        $fecha_invita=implode('.',$arreglo_fecha_inv);
                        $confirmacion=implode('.',$arreglo_confirmacion);
                        $invitacion=DB::table('invitacionestudiantes')->where('id',$id);
                        $invitacion->delete();
                        DB::table('invitacionestudiantes')->insert([
                            'id'=>$id,
                            'user_invita_id'=>$user_student->id,
                            'user_invitado_id'=>$user_invitado,
                            'confirmacion'=>$confirmacion,
                            'fecha_invita'=>$fecha_invita,  
                        ]);
                    }
                }
                $invitacion=DB::table('invitacionestudiantes')->where('user_invita_id',$user_student->id)
                        ->where('solitutoria_id',null)
                        ->first();
                return $invitacion;
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function solicitar_tutoria_student(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){

                $id_materia=$request->input("id_materia");
                $id_docente=$request->input("id_docente");
                $user_docente=DB::table('users')->where('id',$id_docente)->first();
                $id_invitacion=$request->input("id_invitacion");
                $tipo=$request->input('tipo'); 
                $modalidad=$request->input('modalidad');
                $dia=$request->input('dia');
                if(($modalidad=="virtual" && $tipo=="individual") || ($modalidad=="virtual" && $tipo=="grupal")){
                    dd("Tutoría a solicitar no disponible por el momento, vuelve atrás para seguir utilizando el sistema");
                }
                if($tipo=="grupal"){
                    $motivo=$request->input('motivo_grupal');
                }else{
                    $motivo=$request->input('motivo_individual');
                }  
                if($motivo=='Otro'){
                    $motivo=$request->input('otro_motivo');
                }
                /*dd($motivo);
                exit;*/
                $horarios=DB::table('horarios')->where('usuario_id',$id_docente)->first();
                $horarios2=DB::table('horario2s')->where('usuario_id',$id_docente)->first();
                $horarios3=DB::table('horario3s')->where('usuario_id',$id_docente)->first();
                $horarios4=DB::table('horario4s')->where('usuario_id',$id_docente)->first();
                $horarios5=DB::table('horario5s')->where('usuario_id',$id_docente)->first();
                if ($dia=='dia1_op1') {
                    $dia=$horarios->dia1_op1;
                    $hora_inicio=$horarios->hora_inicio_op1;
                    $minutos_inicio=$horarios->minutos_inicio_op1;
                    $hora_fin=$horarios->hora_fin_op1;
                    $minutos_fin=$horarios->minutos_fin_op1;
                }
                if ($dia=='dia1_op2') {
                    $dia=$horarios->dia1_op2;
                    $hora_inicio=$horarios->hora_inicio_op2;
                    $minutos_inicio=$horarios->minutos_inicio_op2;
                    $hora_fin=$horarios->hora_fin_op2;
                    $minutos_fin=$horarios->minutos_fin_op2;
                }
                if ($dia=='dia1_op3') {
                    $dia=$horarios->dia1_op3;
                    $hora_inicio=$horarios->hora_inicio_op3;
                    $minutos_inicio=$horarios->minutos_inicio_op3;
                    $hora_fin=$horarios->hora_fin_op3;
                    $minutos_fin=$horarios->minutos_fin_op3;
                }
                if ($dia=='dia2_op1') {
                    $dia=$horarios2->dia2_op1;
                    $hora_inicio=$horarios2->hora_inicio_op1;
                    $minutos_inicio=$horarios2->minutos_inicio_op1;
                    $hora_fin=$horarios2->hora_fin_op1;
                    $minutos_fin=$horarios2->minutos_fin_op1;
                }
                if ($dia=='dia2_op2') {
                    $dia=$horarios2->dia2_op2;
                    $hora_inicio=$horarios2->hora_inicio_op2;
                    $minutos_inicio=$horarios2->minutos_inicio_op2;
                    $hora_fin=$horarios2->hora_fin_op2;
                    $minutos_fin=$horarios2->minutos_fin_op2;
                }
                if ($dia=='dia2_op3') {
                    $dia=$horarios2->dia2_op3;
                    $hora_inicio=$horarios2->hora_inicio_op3;
                    $minutos_inicio=$horarios2->minutos_inicio_op3;
                    $hora_fin=$horarios2->hora_fin_op3;
                    $minutos_fin=$horarios2->minutos_fin_op3;
                }
                if ($dia=='dia3_op1') {
                    $dia=$horarios3->dia3_op1;
                    $hora_inicio=$horarios3->hora_inicio_op1;
                    $minutos_inicio=$horarios3->minutos_inicio_op1;
                    $hora_fin=$horarios3->hora_fin_op1;
                    $minutos_fin=$horarios3->minutos_fin_op1;
                }
                if ($dia=='dia3_op2') {
                    $dia=$horarios3->dia3_op2;
                    $hora_inicio=$horarios3->hora_inicio_op2;
                    $minutos_inicio=$horarios3->minutos_inicio_op2;
                    $hora_fin=$horarios3->hora_fin_op2;
                    $minutos_fin=$horarios3->minutos_fin_op2;
                }
                if ($dia=='dia3_op3') {
                    $dia=$horarios3->dia3_op3;
                    $hora_inicio=$horarios3->hora_inicio_op3;
                    $minutos_inicio=$horarios3->minutos_inicio_op3;
                    $hora_fin=$horarios3->hora_fin_op3;
                    $minutos_fin=$horarios3->minutos_fin_op3;
                }
                if ($dia=='dia4_op1') {
                    $dia=$horarios4->dia4_op1;
                    $hora_inicio=$horarios4->hora_inicio_op1;
                    $minutos_inicio=$horarios4->minutos_inicio_op1;
                    $hora_fin=$horarios4->hora_fin_op1;
                    $minutos_fin=$horarios4->minutos_fin_op1;
                }
                if ($dia=='dia4_op2') {
                    $dia=$horarios4->dia4_op2;
                    $hora_inicio=$horarios4->hora_inicio_op2;
                    $minutos_inicio=$horarios4->minutos_inicio_op2;
                    $hora_fin=$horarios4->hora_fin_op2;
                    $minutos_fin=$horarios4->minutos_fin_op2;
                }
                if ($dia=='dia4_op3') {
                    $dia=$horarios4->dia4_op3;
                    $hora_inicio=$horarios4->hora_inicio_op3;
                    $minutos_inicio=$horarios4->minutos_inicio_op3;
                    $hora_fin=$horarios4->hora_fin_op3;
                    $minutos_fin=$horarios4->minutos_fin_op3;
                }
                if ($dia=='dia5_op1') {
                    $dia=$horarios5->dia5_op1;
                    $hora_inicio=$horarios5->hora_inicio_op1;
                    $minutos_inicio=$horarios5->minutos_inicio_op1;
                    $hora_fin=$horarios5->hora_fin_op1;
                    $minutos_fin=$horarios5->minutos_fin_op1;
                }
                if ($dia=='dia5_op2') {
                    $dia=$horarios5->dia5_op2;
                    $hora_inicio=$horarios5->hora_inicio_op2;
                    $minutos_inicio=$horarios5->minutos_inicio_op2;
                    $hora_fin=$horarios5->hora_fin_op2;
                    $minutos_fin=$horarios5->minutos_fin_op2;
                }
                if ($dia=='dia5_op3') {
                    $dia=$horarios5->dia5_op3;
                    $hora_inicio=$horarios5->hora_inicio_op3;
                    $minutos_inicio=$horarios5->minutos_inicio_op3;
                    $hora_fin=$horarios5->hora_fin_op3;
                    $minutos_fin=$horarios5->minutos_fin_op3;
                }
                $fecha_actual=now();
                DB::table('solitutorias')->insert([
                    'dia'=>$dia,
                    'hora_inicio'=>$hora_inicio,
                    'minutos_inicio'=>$minutos_inicio,
                    'hora_fin'=>$hora_fin,
                    'minutos_fin'=>$minutos_fin,
                    'materia_id'=>$id_materia,
                    'docente_id'=>$id_docente,
                    'estudiante_id'=>$user_student->id,
                    'modalidad'=>$modalidad,
                    'tipo'=>$tipo,
                    'motivo'=>$motivo,
                    'fecha_solicita'=>$fecha_actual,
                ]);
                /* Este código sirve para enviar notificación al docente cuando solicita tutoría */
                $solitutoria=DB::table('solitutorias')->where('fecha_solicita',$fecha_actual)->first();
                $noti_docente=new Notidocente;
                $noti_docente->user_id=auth()->user()->id;
                $noti_docente->user_docente_id=$id_docente;
                $noti_docente->solitutoria_id=$solitutoria->id;
                $noti_docente->title="Solicitud de tutoría ";
                $noti_docente->descripcion="$user_student->name $user_student->lastname solicita tutoría ".$modalidad."-".$tipo.".";
                $noti_docente->save();

                $user_notificado=User::where('id','=',$id_docente)->get();
                if(\Notification::send($user_notificado,new NotificacionDocente(Notidocente::latest('id')->first()))){
                    return back();
                }

                if($tipo=="grupal"){
                    /* Este código sirve para agregar el solitutoria_id a la tabla invitacionestudiantes */
                    $invitacion=DB::table('invitacionestudiantes')->where('id',$id_invitacion)->where('solitutoria_id',null)->first();
                    $user_invitado_id=$invitacion->user_invitado_id;
                    $fecha_invita=$invitacion->fecha_invita;
                    $confirmacion=$invitacion->confirmacion;

                    $invitacion=DB::table('invitacionestudiantes')->where('id',$id_invitacion);
                    $invitacion->delete();
                    DB::table('invitacionestudiantes')->insert([
                        'id'=>$id_invitacion,
                        'user_invita_id'=>$user_student->id,
                        'user_invitado_id'=>$user_invitado_id,
                        'solitutoria_id'=>$solitutoria->id,
                        'confirmacion'=>$confirmacion,
                        'fecha_invita'=>$fecha_invita,  
                    ]);
                    
                    /* Este código invita-notifica a los estudiantes seleccionados */
                    $invitacion=DB::table('invitacionestudiantes')->where('id',$id_invitacion)->where('solitutoria_id',$solitutoria->id)->first();
                    $arreglo_est_inv=explode('.', $invitacion->user_invitado_id);
                    $arreglo_fecha_inv=explode('.', $invitacion->fecha_invita);
                    for ($i=0; $i < count($arreglo_est_inv); $i++) {

                        $invita_estudiante=new Invitacion;
                        $invita_estudiante->user_invita_id=$user_student->id;
                        $invita_estudiante->user_invitado_id=$arreglo_est_inv[$i];
                        $invita_estudiante->solitutoria_id=$solitutoria->id;
                        $invita_estudiante->title="Invitación a tutoría";
                        $invita_estudiante->descripcion="$user_student->name $user_student->lastname te ha invitado unirte a tutoría";
                        $invita_estudiante->fecha_invita=$arreglo_fecha_inv[$i];
                        $invita_estudiante->save();

                        $user_notificado=User::where('id','=',$arreglo_est_inv[$i])->get();
                        if(\Notification::send($user_notificado,new InvitacionEstudiante(Invitacion::latest('id')->first()))){
                            return back();
                        }
                    }
                }
                /* Retorna a la vista cuando todo se haya realizado correctamente */
                flash("Ha solicitado tutoría $tipo al docente $user_docente->name $user_docente->lastname, espere la confirmación por parte del docente.")->success();
                return redirect()->route('vista_general_student');   
            }else{
                return redirect()->route('show_login_form_student');
            }
        }    
    }
/* 
|--------------------------------------------------------------------------
| Funciones para ver la invitacion de unirte a tutoria
|--------------------------------------------------------------------------
*/
    public function invitacion(User $user_invita,$id_user_invitado,Solitutoria $solitutoria,$id_notificacion){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $fecha_actual=now();
                $date = date_create($fecha_actual);
                $fecha_actual=date_format($date, 'd-m-Y');
                
                $fecha_tutoria=$solitutoria->fecha_tutoria;
                if($fecha_tutoria!=null){
                    $date = date_create($fecha_tutoria);
                    $fecha_tutoria=date_format($date, 'd-m-Y');
                }
                /*Elimino la invitación a tutoría cuando llega el día a ser impartida */
                if($fecha_actual==$fecha_tutoria){
                    $elimina_inv_tut = DB::table('notifications')->where('id',$id_notificacion);
                    $elimina_inv_tut->delete();
                    flash("La invitación ha sido eliminada")->error();
                    return redirect()->route('vista_general_student');
                }
                return view('user_student.vista_invitacion_estudiante',compact('user_invita','solitutoria','id_notificacion'));
            }else{
                return redirect()->route('show_login_form_student');
            }
        } 
    }
    public function cancela_invitacion($notificacion_id){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $elimina_inv_tut = DB::table('notifications')->where('id',$notificacion_id);
                $elimina_inv_tut->delete();
                flash("Has cancelado la invitación a tutoría.")->error();
                return redirect()->route('vista_general_student');
            }else{
                return redirect()->route('show_login_form_student');
            }
        } 
    }
    public function confirmar_invitacion($solitutoria_id,$notificacion_id){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                
                $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria_id)->first();
                $id=$invitacion->id;
                $user_invita=$invitacion->user_invita_id;
                $user_invitado=$invitacion->user_invitado_id;
                $fecha_invita=$invitacion->fecha_invita;
                $arreglo_est_inv=explode('.', $invitacion->user_invitado_id);
                $arreglo_confirmacion=explode('.', $invitacion->confirmacion);
                for ($i=0; $i < count($arreglo_est_inv); $i++) {
                    if($arreglo_est_inv[$i]==$user_student->id){                        
                        $arreglo_confirmacion[$i]="si";
                        $confirmacion=implode('.',$arreglo_confirmacion);
                        $invitacion=DB::table('invitacionestudiantes')->where('id',$id);
                        $invitacion->delete();
                        DB::table('invitacionestudiantes')->insert([
                            'id'=>$id,
                            'user_invita_id'=>$user_invita,
                            'user_invitado_id'=>$user_invitado,
                            'solitutoria_id'=>$solitutoria_id,
                            'confirmacion'=>$confirmacion,
                            'fecha_invita'=>$fecha_invita,  
                        ]);
                    }
                }
                $elimina_inv_tut = DB::table('notifications')->where('id',$notificacion_id);
                $elimina_inv_tut->delete();
                $solitutoria=DB::table('solitutorias')->where('id',$solitutoria_id)->first();
                if($solitutoria->fecha_tutoria==null){
                    flash("Has aceptado la invitación a tutoría. Espera la confirmación por parte del docente.")->success();
                }else{
                    $noti_estudiante=new Notiestudiante;
                    $noti_estudiante->user_id=$solitutoria->docente_id;
                    $noti_estudiante->user_estudiante_id=auth()->user()->id;
                    $noti_estudiante->solitutoria_id=$solitutoria->id;
                    $noti_estudiante->title="Tutoría confirmada";
                    $docente=DB::table('users')->where('id',$solitutoria->docente_id)->first();
                    $noti_estudiante->descripcion="El docente $docente->name $docente->lastname ha confirmado la tutoría a la que te uniste";
                    $noti_estudiante->save();

                    $user_notificado=User::where('id','=',auth()->user()->id)->get();
                    if(\Notification::send($user_notificado,new NotificacionEstudiante(Notiestudiante::latest('id')->first()))){
                        return back();
                    }
                    flash("Has aceptado la invitación a tutoría. Ahora podrás evaluar al docente, al hacer clic en la nueva notificación que se le ha enviado.")->success();
                }
                return redirect()->route('vista_general_student');
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function invitacion_eliminada($id_notificacion,$id_solitutoria){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $elimina_inv_tut = DB::table('notifications')->where('id',$id_notificacion);
                $elimina_inv_tut->delete();
                /* Obtengo y cargo el id de la tabla notiestudiantes referente al campo solitutoria_id a eliminar */
                $invitacion=DB::table('invitacions')->where('user_invitado_id',$user_student->id)->first();
                $id_invitacion=$invitacion->id;
                $invitacion=Invitacion::find($id_invitacion);  
                $invitacion->delete(); 
                flash("¡ERROR! La tutoría ha sido eliminada por quién la solicitó.")->error();
                return redirect()->route('vista_general_student');
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para vista de tutoria confirmada por parte del docente
|--------------------------------------------------------------------------
*/
    public function ver_tutoria_confirmada($user_docente_id,$user_student_id,$notification,$solitutoria_id){
        $estudiante=DB::table('users')->where('id',$user_student_id)->first();
        $docente=DB::table('users')->where('id',$user_docente_id)->first();
        $materia=DB::table('materias')->where('usuario_id',$docente->id)->first();
        $datos_tut=DB::table('solitutorias')->where('id',$solitutoria_id)->first();
        if($datos_tut->modalidad=="presencial"){
            return view('user_student.vista_tutoria_confirmada',compact('estudiante','docente','materia','datos_tut','notification'));
        }else{
            return view('user_student.vista_tutoria_confirmada_virtual',compact('estudiante','docente','materia','datos_tut','notification'));
        }
    }

/* 
|--------------------------------------------------------------------------
| Funciones para ver las tutorias solicitadas
|--------------------------------------------------------------------------
*/
    public function vista_tut_sol_est(){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $solitutorias=DB::table('solitutorias')->where('estudiante_id',$user_student->id)->get();
                $invitaciones=DB::table('invitacions')->where('user_invitado_id',$user_student->id)->get();
                return view('user_student.vista_tut_sol',compact('solitutorias','invitaciones'));
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function vista_tut_sol(){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $solitutorias=DB::table('solitutorias')->where('estudiante_id',$user_student->id)->get();
                return view('user_student.vista_tut_sol_est',compact('solitutorias'));
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function vista_tut_inv(){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $invitaciones=DB::table('invitacions')->where('user_invitado_id',$user_student->id)->get();
                return view('user_student.vista_tut_inv_est',compact('invitaciones'));
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function eliminar_tutoria(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $solitutoria_id=$request->input("solitutoria_id");
                /* Obtengo y cargo el id de la tabla invitacionestudiantes referente al campo solitutoria_id a eliminar */
                $invitacion_estudiante=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria_id)->first();
                $id_invitacion_estudiante=$invitacion_estudiante->id;
                $invitacion_estudiante='App\Invitacionestudiante'::find($id_invitacion_estudiante);
                $invitacion_estudiante->delete();
                /* Obtengo y cargo el id de la tabla solitutoria a eliminar */
                $solitutoria = Solitutoria::find($solitutoria_id);
                $solitutoria->delete();
                
                $solitutorias=DB::table('solitutorias')->where('estudiante_id',$user_student->id)->get();
                flash("La tutoría ha sido eliminada correctamente")->success();
                return view('user_student.vista_tut_sol_est',compact('solitutorias'));
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function invitar_est_desp($solitutoria_id){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria_id)->first();
                $lista_estudiantes_sin_arrastre=User::orderBy('name','DESC')
                    ->where('is_estudiante',true)->where('paralelo',$user_student->paralelo)->where('ciclo',$user_student->ciclo)->where('id','!=',$user_student->id)
                    ->paginate(3);
                return view('user_student.vista_est_inv',compact('invitacion','lista_estudiantes_sin_arrastre'));
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function buscar_est(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $name = $request->input('name');
                $lastname = $request->input('lastname');
                $solitutoria_id=$request->input('solitutoria_id');
                $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria_id)->first();
                $lista_estudiantes_sin_arrastre=User::orderBy('id','DESC')
                    ->name($name)
                    ->lastname($lastname)
                    ->where('is_estudiante',true)->where('paralelo',$user_student->paralelo)->where('ciclo',$user_student->ciclo)->where('id','!=',$user_student->id)
                    ->paginate(7);
                Alert::success('')
                    ->details('Resultados encontrados');
                return view('user_student.vista_est_inv',compact('invitacion','lista_estudiantes_sin_arrastre'));
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function reg_est_inv_desp(Request $request){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                $user_invitado_id=$request->input("user_invitado_id");
                $estudiante=DB::table('users')->where('id',$user_invitado_id)->first();
                $invitacion_id=$request->input("invitacion_id");       
                $solitutoria_id=$request->input('solitutoria_id');
                $invitacion=DB::table('invitacionestudiantes')->where('id',$invitacion_id)->first();
                $user_invitado=$invitacion->user_invitado_id;
                $confirmacion=$invitacion->confirmacion;
                $fecha_invita=$invitacion->fecha_invita;
                
                $lista_estudiantes_sin_arrastre=User::orderBy('name','DESC')
                    ->where('is_estudiante',true)->where('paralelo',$user_student->paralelo)->where('ciclo',$user_student->ciclo)->where('id','!=',$user_student->id)
                    ->paginate(3);
                //dd("David")->aqui hacer el control cuando quiere invitar alumno que ya ha invitado;
                $arreglo_est_inv=explode('.', $user_invitado);
                foreach ($arreglo_est_inv as $recorre) {
                    if($recorre==$user_invitado_id){
                        $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria_id)->first();
                        flash("$estudiante->name $estudiante->lastname ya ha sido invitado")->error();
                        return view('user_student.vista_est_inv',compact('invitacion','lista_estudiantes_sin_arrastre'));
                    }                            
                }
                $invitacion=DB::table('invitacionestudiantes')->where('id',$invitacion_id);
                $invitacion->delete();
                DB::table('invitacionestudiantes')->insert([
                    'id'=>$invitacion_id,
                    'user_invita_id'=>$user_student->id,
                    'user_invitado_id'=>$user_invitado.".".$user_invitado_id,
                    'solitutoria_id'=>$solitutoria_id,
                    'confirmacion'=>$confirmacion."."."no",
                    'fecha_invita'=>$fecha_invita.".".now(),
                ]);
                $invita_estudiante=new Invitacion;
                $invita_estudiante->user_invita_id=$user_student->id;
                $invita_estudiante->user_invitado_id=$user_invitado_id;
                $invita_estudiante->solitutoria_id=$solitutoria_id;
                $invita_estudiante->title="Invitación a tutoría";
                $invita_estudiante->descripcion="$user_student->name $user_student->lastname te ha invitado unirte a tutoría";
                $invita_estudiante->fecha_invita=now();
                $invita_estudiante->save();

                $user_notificado=User::where('id','=',$user_invitado_id)->get();
                if(\Notification::send($user_notificado,new InvitacionEstudiante(Invitacion::latest('id')->first()))){
                    return back();
                }
                $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria_id)->first();
                flash("Has invitado a $estudiante->name $estudiante->lastname")->success();
                return view('user_student.vista_est_inv',compact('invitacion','lista_estudiantes_sin_arrastre'));
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
    public function enviar_mail(Request $request){
        if (Auth::check()) {
            $user = Auth::user();
            if($user->is_estudiante==true){
                Mail::send('user_student.vista_tut_sol_est',$request->all(),function($msj){
                    $msj->subject("Correo enviado");
                    $msj->to("sdcartuchem@unl.edu.ec");
                });
                return view('user_student.vista_tut_sol_est');
            }else{
                return redirect()->route('show_login_form_student');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para evaluar al estudiante después de la tutoría impartida
|--------------------------------------------------------------------------
*/
    public function evaluar_docente($user_estudiante_id, $notification,$solitutoria_id,Materia $materia, User $docente){
        return view('user_student.vista_evaluar_docente',compact('user_estudiante_id','notification','solitutoria_id','materia','docente'));
    }
    public function evaluacion_docente($user_evaluado_id,$solitutoria_id,$notification, Request $request){
        $elimina_tutoria_confirmada = DB::table('notifications')->where('id',$notification);
        $elimina_tutoria_confirmada->delete();
        $pr1=$request->input('pr1');
        $pr2=$request->input('pr2');
        $pr3=$request->input('pr3');
        $pr4=$request->input('pr4');
        $pr5=$request->input('pr5');
        $suma=($pr1)+($pr2)+($pr3)+($pr4)+($pr5);
        $total=$suma/5;
        Evaluacion::create([
            'user_evaluado_id'=>$user_evaluado_id,
            'solitutoria_id'=>$solitutoria_id,
            'asistencia'=>"si",
            'evaluacion'=>$total
        ]);
        flash("Se ha registrado la evaluación al docente")->success();
        return redirect()->route('vista_general_student');
    }
}
