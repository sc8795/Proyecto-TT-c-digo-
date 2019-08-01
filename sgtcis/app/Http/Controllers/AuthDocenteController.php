<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\NotificacionEstudiante;
use App\Solitutoria;
use App\Materia;
use App\Notiestudiante;
use App\Evaluacion;
use App\User;
use App\Log;
use Alert;
use Auth;
use Illuminate\Support\Str;

class AuthDocenteController extends Controller
{
/* 
|--------------------------------------------------------------------------
| Funciones para detectar y redirigir a la pagina del docente autenticado
|--------------------------------------------------------------------------
*/
    public function __construct(){
        $this->middleware('auth');
    }

    public function auth_docente(){
        if (Auth::check()) {
            $user = Auth::user();
            if($user->is_docente==true){
                $fecha=now();
                Log::create([
                    'detalle'=>"El docente ".$user->name." ".$user->lastname." ha iniciado sesión y accedido al sistema.",
                    'fecha'=>$fecha,
                ]);
                return view('user_docente.auth_docente');  
            }else{
                return redirect()->route('show_login_form_docente');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para la vista general del docente
|--------------------------------------------------------------------------
*/
    public function vista_general_docente(){
        return view('user_docente.vista_general_cuenta');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar perfil del docente
|--------------------------------------------------------------------------
*/
    public function editar_perfil_docente(){
        return view('user_docente.editar_perfil_docente');
    }
    public function editar_docente(){
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
            return redirect()->route('vista_general_docente');
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para vista de tutoria solicitada por parte del estudiante
|--------------------------------------------------------------------------
*/
    public function ver_tutoria_solitada($user_student_id,$user_docente_id,$solitutoria_id,$notificacion_id){
        if (Auth::check()) {
            $docente = Auth::user();
            if($docente->is_docente==true){
                $datos_tut=DB::table('solitutorias')->where('id',$solitutoria_id)->first();
                $estudiante=DB::table('users')->where('id',$user_student_id)->first();
                $materia=DB::table('materias')->where('usuario_id',$docente->id)->first();
                $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria_id)->first();
                if($datos_tut->tipo=="grupal"&&$datos_tut->modalidad="presencial"){
                    return view('user_docente.vista_grupal_presencial',compact('datos_tut','estudiante','docente','materia','notificacion_id','invitacion'));
                }
                if($datos_tut->tipo=="grupal"&&$datos_tut->modalidad="virtual"){
                    return view('user_docente.vista_grupal_virtual');
                }
                if($datos_tut->tipo=="individual"&&$datos_tut->modalidad="presencial"){
                    return view('user_docente.vista_individual_presencial');
                }
                if($datos_tut->tipo=="individual"&&$datos_tut->modalidad="virtual"){
                    return view('user_docente.vista_individual_virtual');
                }
            }else{
                return redirect()->route('show_login_form_docente');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para confirmar tutoria solicitada
|--------------------------------------------------------------------------
*/
    public function confirmar_tutoria(Request $request){
        if (Auth::check()) {
            $docente = Auth::user();
            if($docente->is_docente==true){
                $solitutoria_id=$request->input("solitutoria_id");
                $hora_inicio=$request->input("hora_inicio");
                $minutos_inicio=$request->input("minutos_inicio");
                $hora_fin=$request->input("hora_fin");
                $minutos_fin=$request->input("minutos_fin");
                $modalidad=$request->input("modalidad");
                $notificacion_id=$request->input("notificacion_id");
                $fecha_tutoria=$request->input("fecha_tutoria");
                $datos_tut=Solitutoria::find($solitutoria_id);
                $estudiante=DB::table('users')->where('id',$datos_tut->estudiante_id)->first();
                if($datos_tut->tipo=="grupal" && $datos_tut->modalidad=="presencial"){
                    //if($datos_tut->hora_inicio!=$hora_inicio || $datos_tut->minutos_inicio!=$minutos_inicio || $datos_tut->hora_fin!=$hora_fin || $datos_tut->minutos_fin!=$minutos_fin || $datos_tut->modalidad!=$modalidad){
                        $datos_tut->hora_inicio=$hora_inicio;
                        $datos_tut->minutos_inicio=$minutos_inicio;
                        $datos_tut->hora_fin=$hora_fin;
                        $datos_tut->minutos_fin=$minutos_fin;
                        $datos_tut->modalidad=$modalidad;
                        $datos_tut->fecha_tutoria=$fecha_tutoria;
                        $datos_tut->fecha_confirma=now();
                        $datos_tut->save();
                    /*}else{
                        $datos_tut->fecha_tutoria=$fecha_tutoria;
                        $datos_tut->fecha_confirma=now();
                        $datos_tut->save();
                    }*/
                }
                /* Codigo para eliminar la tutoria solicitada al docente por parte del estudiante */
                $elimina_tutoria_solicitada = DB::table('notifications')->where('id',$notificacion_id);
                $elimina_tutoria_solicitada->delete();
                
                /* Codigo para notificar al estudiante que solicitó la tutoría*/
                $noti_estudiante=new Notiestudiante;
                $noti_estudiante->user_id=auth()->user()->id;
                $noti_estudiante->user_estudiante_id=$datos_tut->estudiante_id;
                $noti_estudiante->solitutoria_id=$datos_tut->id;
                $noti_estudiante->title="Tutoría confirmada";
                $noti_estudiante->descripcion="El docente $docente->name $docente->lastname ha confirmado la tutoría solicitada";
                $noti_estudiante->save();

                $user_notificado=User::where('id','=',$datos_tut->estudiante_id)->get();
                if(\Notification::send($user_notificado,new NotificacionEstudiante(Notiestudiante::latest('id')->first()))){
                    return back();
                }
                if($datos_tut->tipo=="grupal"){
                    $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$datos_tut->id)->first();
                    $arreglo_est_inv=explode('.', $invitacion->user_invitado_id);
                    $arreglo_confirmacion=explode('.', $invitacion->confirmacion);
                    for ($i=0; $i < count($arreglo_confirmacion); $i++) {
                        if($arreglo_confirmacion[$i]=="si"){
                            $id_estudiante_inv=$arreglo_est_inv[$i];
                            $noti_estudiante=new Notiestudiante;
                            $noti_estudiante->user_id=auth()->user()->id;
                            $noti_estudiante->user_estudiante_id=$id_estudiante_inv;
                            $noti_estudiante->solitutoria_id=$datos_tut->id;
                            $noti_estudiante->title="Tutoría confirmada";
                            $noti_estudiante->descripcion="El docente $docente->name $docente->lastname ha confirmado la tutoría a la que te uniste";
                            $noti_estudiante->save();

                            $user_notificado=User::where('id','=',$id_estudiante_inv)->get();
                            if(\Notification::send($user_notificado,new NotificacionEstudiante(Notiestudiante::latest('id')->first()))){
                                return back();
                            }
                        }
                    }
                }
                flash("Ha confirmado la tutoría solicitada por el estudiante $estudiante->name $estudiante->lastname. Ahora podrá evaluar la actuación del estudiante sobre la tutoría impartida, en la opción disponible en el menú EVALUACIÓN AL ESTUDIANTE.")->success();
                return redirect()->route('vista_general_docente');
            }else{
                return redirect()->route('show_login_form_docente');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar datos de tutoria solicitada
|--------------------------------------------------------------------------
*/
    public function vista_editar_datos_tutoria(Solitutoria $datos_tut,User $estudiante,Materia $materia, $notificacion_id){
        if (Auth::check()) {
            $docente = Auth::user();
            if($docente->is_docente==true){
                $valor=Str::endsWith($datos_tut->dia,'mañana');
                if($valor==true){
                    $aux=1;
                    if($datos_tut->tipo=="grupal" && $datos_tut->modalidad=="presencial"){
                        return view('user_docente.vista_editar_presencial_grupal',compact('datos_tut','estudiante','docente','materia','notificacion_id','aux'));
                    }
                }else{
                    $aux=2;
                    if($datos_tut->tipo=="grupal" && $datos_tut->modalidad=="presencial"){
                        return view('user_docente.editar_datos_tutoria',compact('datos_tut','estudiante','docente','materia','aux'));
                    }
                }
            }else{
                return redirect()->route('show_login_form_docente');
            }
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para evaluar al estudiante después de la tutoría impartida
|--------------------------------------------------------------------------
*/
    public function evaluar_estudiante($user_docente_id){
        $verifica=DB::table('notiestudiantes')->where('user_id',$user_docente_id)->exists();
        $noti_estudiantes=DB::table('notiestudiantes')->where('user_id',$user_docente_id)->get();
        $unique_noti_estudiantes=$noti_estudiantes->unique('user_estudiante_id');
        return view('user_docente.vista_evaluar_estudiante',compact('verifica','unique_noti_estudiantes'));
    }
    public function lista_tutorias_confirmadas($user_estudiante_id,$user_docente_id,$materia_id){
        $solitutorias=DB::table('solitutorias')->where('materia_id',$materia_id)->where('docente_id',$user_docente_id)->where('estudiante_id',$user_estudiante_id)->get();
        return view('user_docente.vista_lista_tutorias_confirmadas',compact('solitutorias'));
    }
    public function evalua_estudiante($solitutoria_id,$user_estudiante_id,$user_docente_id,$materia_id){
        $user_estudiante=DB::table('users')->where('id',$user_estudiante_id)->first();
        return view('user_docente.vista_evalua_estudiante',compact('user_estudiante','solitutoria_id'));
    }
    public function evaluacion_estudiante($user_evaluado_id, $solitutoria_id, Request $request){
        $asistencia=$request->input('asistencia');
        if($asistencia=="no"){
            Evaluacion::create([
                'user_evaluado_id'=>$user_evaluado_id,
                'solitutoria_id'=>$solitutoria_id,
                'asistencia'=>$asistencia,
                'evaluacion'=>0
            ]);
            flash("Evaluación de tutoria correcta")->success();
            return redirect()->route('vista_general_docente');
        }
        if($asistencia=="si"){
            $tema_tutoria=$request->input('tema_de_tutoria');
            $descripcion_tutoria=$request->input('descripcion_de_tutoria');
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
                'asistencia'=>$asistencia,
                'evaluacion'=>$total,
                'tema'=>$tema_tutoria,
                'descripcion'=>$descripcion_tutoria
            ]);
            flash("Evaluación de tutoria correcta")->success();
            return redirect()->route('vista_general_docente');
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para generar reportes pdf - cuando se ha evaluado al estudiante
|--------------------------------------------------------------------------
*/
    public function reporte_pfp_evaluacion_estudiante($tipo, Evaluacion $evaluacion, User $estudiante, User $docente, Solitutoria $solitutoria){
        $vista_url=("user_docente.reporte_evalaucion_estudiante");
        return $this->crear_pdf($tipo, $evaluacion, $estudiante, $docente, $solitutoria, $vista_url);
    }
    public function crear_pdf($tipo, $evaluacion, $estudiante, $docente, $solitutoria, $vista_url){
        $date=date('Y-m-d');
        $view=\View::make($vista_url,compact('estudiante','docente','evaluacion','solitutoria','date'))->render();
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        if($tipo==1){
            return $pdf->stream();
        }
        if($tipo==2){
            return $pdf->download("reporte_de_evaluacion_del_estudiante_".$estudiante->name."_".$estudiante->lastname.".pdf");
        }
    }
}
