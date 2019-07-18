<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Materia;
use App\Solitutoria;
use App\Notifications\NotificacionDocente;
use App\Notidocente;
use App\Evaluacion;
use App\Log;
use Alert;
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
                    $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->first();
                    $arreglo_materia=explode('.', $arrastre->materia);
                    return view('user_student.completar_registro',compact('user_student','materias','arrastre','arreglo_materia'));
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
    public function vista_student_google(){
        if (Auth::check()) {
            $user_student = Auth::user();
            if($user_student->is_estudiante==true){
                if($user_student->paralelo=="NA" && $user_student->ciclo=="NA"){
                    $materias=Materia::orderBy('id','DESC')
                        ->paginate(5);
                    Alert::success('¡Bienvenido(a)! ')
                        ->details("$user_student->name $user_student->lastname.");
                    $verifica_arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->exists();
                    $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->first();
                    $arreglo_materia=explode('.', $arrastre->materia);
                    $arreglo_paralelo=explode('.', $arrastre->paralelo);
                    return view('user_student.completar_registro',compact('user_student','materias','arrastre','arreglo_materia','verifica_arrastre','arreglo_paralelo'));
                    
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
                        ->paginate(5);
                    Alert::success('¡Bienvenido(a)! ')
                        ->details("$user_student->name $user_student->lastname.");
                    return view('user_student.completar_registro',compact('user_student','materias'));
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
                    ]);
                    $materia=$request->input('materia');
                    $paralelo=$request->input('paralelo');
                    $verifica_arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->exists();
                    if($verifica_arrastre==true){
                        $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id)->first();
                        $id=$arrastre->id;
                        $materia_agregada=$arrastre->materia;
                        $paralelo_agregado=$arrastre->paralelo;
                        $arrastre=DB::table('arrastres')->where('user_estudiante_id',$user_student->id);
                        $arrastre->delete();
                        DB::table('arrastres')->insert([
                            'id'=>$id,
                            'user_estudiante_id'=>$user_student->id,
                            'materia'=>$materia_agregada.".".$materia,
                            'paralelo'=>$paralelo_agregado.".".$paralelo
                        ]);
                    }else{
                        DB::table('arrastres')->insert([
                            'user_estudiante_id'=>$user_student->id,
                            'materia'=>$materia,
                            'paralelo'=>$paralelo
                        ]);
                    }
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
        $materia=$request->input('materia');
        dd($materia);
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
            return redirect()->action('AuthStudentController@vista_general_student', [1]);
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para solicitar tutoria
|--------------------------------------------------------------------------
*/
    public function solicitar_tutoria(){
        $materias = DB::table('materias')->get();
        if (Auth::check()) {
            $user = Auth::user();
        }
        $users_docentes=DB::table('users')->where('is_docente',true)->get();
        return view('user_student.solicitar_tutoria',compact('materias','user','users_docentes'));
    }
    public function vista_solicitar_tutoria(User $user, User $user_docente, Materia $materia){
        $docente=$user_docente->id;
        $verifica_horarios=DB::table('horarios')->where('usuario_id',$docente)->exists();
        $verifica_horarios2=DB::table('horario2s')->where('usuario_id',$docente)->exists();
        $verifica_horarios3=DB::table('horario3s')->where('usuario_id',$docente)->exists();
        $verifica_horarios4=DB::table('horario4s')->where('usuario_id',$docente)->exists();
        $verifica_horarios5=DB::table('horario5s')->where('usuario_id',$docente)->exists();
        if($verifica_horarios==true || $verifica_horarios2==true || $verifica_horarios3==true || $verifica_horarios4==true || $verifica_horarios5==true){
            $estado=0;
            $mensaje=0;
            $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
            $horarios2=DB::table('horario2s')->where('usuario_id',$docente)->first();
            $horarios3=DB::table('horario3s')->where('usuario_id',$docente)->first();
            $horarios4=DB::table('horario4s')->where('usuario_id',$docente)->first();
            $horarios5=DB::table('horario5s')->where('usuario_id',$docente)->first();
            return view('user_student.vista_solicitar_tutoria',compact('user','user_docente','materia','estado','mensaje','horarios','horarios2','horarios3','horarios4','horarios5'));
        }else{
            $estado=1;
            Alert::info('¡Aviso! ')
                ->details("El docente $user_docente->name $user_docente->lastname no tiene asignado horario de tutoría.");
            return view('user_student.vista_solicitar_tutoria',compact('estado'));
        }
    }
    public function solicitar_tutoria_student(Request $request,User $user, User $user_docente, Materia $materia,$estado){
        $motivo=$request->input('motivo');
        if($motivo=='Otro'){
            $motivo=$request->input('otro_motivo');
        }
        $dia=$request->input('dia');

        $docente=$user_docente->id;
        $horarios=DB::table('horarios')->where('usuario_id',$docente)->first();
        $horarios2=DB::table('horario2s')->where('usuario_id',$docente)->first();
        $horarios3=DB::table('horario3s')->where('usuario_id',$docente)->first();
        $horarios4=DB::table('horario4s')->where('usuario_id',$docente)->first();
        $horarios5=DB::table('horario5s')->where('usuario_id',$docente)->first();

        if($dia==null){
            $mensaje=1;
            Alert::danger('¡Advertencia! ')
                ->details("El campo seleccionar horario de tutoría es requerido.");
            return view('user_student.vista_solicitar_tutoria',compact('user','user_docente','materia','estado','mensaje','horarios','horarios2','horarios3','horarios4','horarios5'));
        }else{
            if($motivo==null){
                $mensaje=2;
                Alert::danger('¡Advertencia! ')
                ->details("El campo motivo de tutoría es requerido.");
                return view('user_student.vista_solicitar_tutoria',compact('user','user_docente','materia','estado','mensaje','horarios','horarios2','horarios3','horarios4','horarios5'));
            }else{                
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
                    'materia_id'=>$materia->id,
                    'docente_id'=>$user_docente->id,
                    'estudiante_id'=>$user->id,
                    'motivo'=>$motivo,
                    'fecha_solicita'=>$fecha_actual,
                    'fecha_confirma'=>$fecha_actual,
                    'fecha_tutoria'=>$fecha_actual,
                    'fecha_evalua'=>$fecha_actual
                ]);
                $solitutoria=DB::table('solitutorias')->where('fecha_solicita',$fecha_actual)->first();
                $noti_docente=new Notidocente;
                $noti_docente->user_id=auth()->user()->id;
                $noti_docente->user_docente_id=$docente;
                $noti_docente->solitutoria_id=$solitutoria->id;
                $user=DB::table('users')->where('id',$noti_docente->user_id)->first();
                $noti_docente->title="Solicitud de tutoría ";
                $noti_docente->descripcion="$user->name $user->lastname solicita tutoría.";
                $noti_docente->save();

                $user_notificado=User::where('id','=',$docente)->get();
                if(\Notification::send($user_notificado,new NotificacionDocente(Notidocente::latest('id')->first()))){
                    return back();
                }

                flash("Usted ha solicitado tutoría al docente $user_docente->name $user_docente->lastname, espere su confirmación por parte del docente.")->success();
                return redirect()->route('vista_general_student');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para vista de tutoria confirmada por parte del docente
|--------------------------------------------------------------------------
*/
    public function ver_tutoria_confirmada($user_docente_id,$user_student_id,$notification){
        $estudiante=DB::table('users')->where('id',$user_student_id)->first();
        $docente=DB::table('users')->where('id',$user_docente_id)->first();
        $materia=DB::table('materias')->where('usuario_id',$docente->id)->first();
        $datos_tut=DB::table('solitutorias')->where('estudiante_id',$estudiante->id)->where('docente_id',$docente->id)->where('materia_id',$materia->id)->first();
        return view('user_student.vista_tutoria_confirmada',compact('estudiante','docente','materia','datos_tut','notification'));
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
        flash("Evaluación de tutoria correcta")->success();
        return redirect()->route('vista_general_student');
    }
}
