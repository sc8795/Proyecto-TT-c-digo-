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
            $user_docente = Auth::user();
            if($user_docente->is_docente==true){
                $datos_tut=DB::table('solitutorias')->where('id',$solitutoria_id)->first();
                if($datos_tut->tipo=="grupal"&&$datos_tut->modalidad="presencial"){
                    return view('user_docente.vista_grupal_presencial');
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
        /*
        $estudiante=DB::table('users')->where('id',$user_student_id)->first();
        $docente=DB::table('users')->where('id',$user_docente_id)->first();
        $materia=DB::table('materias')->where('usuario_id',$docente->id)->first();
        */
    }
/* 
|--------------------------------------------------------------------------
| Funciones para confirmar tutoria solicitada
|--------------------------------------------------------------------------
*/
    public function confirmar_tutoria(Solitutoria $datos_tut,User $estudiante,User $docente,Materia $materia,$notificacion_id){
        $data=request()->validate([
            'fecha_tutoria'=>'required',
        ]);
        $data['fecha_confirma']=now();
        $datos_tut->update($data);

        $elimina_tutoria_solicitada = DB::table('notifications')->where('id',$notificacion_id);
        $elimina_tutoria_solicitada->delete();
        
        $noti_estudiante=new Notiestudiante;
        $noti_estudiante->user_id=auth()->user()->id;
        $noti_estudiante->user_estudiante_id=$estudiante->id;
        $noti_estudiante->solitutoria_id=$datos_tut->id;
        $user=DB::table('users')->where('id',$noti_estudiante->user_id)->first();
        $noti_estudiante->title="Tutoría confirmada";
        $noti_estudiante->descripcion="El docente $user->name $user->lastname le ha confirmado la tutoría solicitada";
        $noti_estudiante->save();

        $user_notificado=User::where('id','=',$estudiante->id)->get();
        if(\Notification::send($user_notificado,new NotificacionEstudiante(Notiestudiante::latest('id')->first()))){
            return back();
        }
        flash("Ha confirmado la tutoría solicitada por el estudiante $estudiante->name $estudiante->lastname, para el día $datos_tut->dia en el horario de $datos_tut->hora_inicio:$datos_tut->minutos_inicio a $datos_tut->hora_fin:$datos_tut->minutos_fin. Ahora podrá evaluar la actuación del estudiante sobre la tutoría impartida, en la opción disponible en el menú EVALUACIÓN AL ESTUDIANTE.")->success();
        return redirect()->route('vista_general_docente');
    }
/* 
|--------------------------------------------------------------------------
| Funciones para editar datos de tutoria solicitada
|--------------------------------------------------------------------------
*/
    public function vista_editar_datos_tutoria(Solitutoria $datos_tut,User $estudiante,User $docente,Materia $materia){
        $valor=Str::endsWith($datos_tut->dia,'mañana');
        if($valor==true){
            $aux=1;
            return view('user_docente.editar_datos_tutoria',compact('datos_tut','estudiante','docente','materia','aux'));
        }else{
            $aux=2;
            return view('user_docente.editar_datos_tutoria',compact('datos_tut','estudiante','docente','materia','aux'));
        }
    }
    public function editar_datos_tutoria(Request $request, Solitutoria $datos_tut,User $estudiante,User $docente,Materia $materia,$notificacion_id){
        $data=request()->validate([
            'hora_inicio'=>'required',
            'minutos_inicio'=>'required',
            'hora_fin'=>'required',
            'minutos_fin'=>'required',
            'fecha_tutoria'=>'required',
        ]);
        $data['fecha_confirma']=now();
        $datos_tut->update($data);

        $elimina_tutoria_solicitada = DB::table('notifications')->where('id',$notificacion_id);
        $elimina_tutoria_solicitada->delete();

        $noti_estudiante=new Notiestudiante;
        $noti_estudiante->user_id=auth()->user()->id;
        $noti_estudiante->user_estudiante_id=$estudiante->id;
        $noti_estudiante->solitutoria_id=$datos_tut->id;
        $user=DB::table('users')->where('id',$noti_estudiante->user_id)->first();
        $noti_estudiante->title="Tutoría confirmada";
        $noti_estudiante->descripcion="El docente $user->name $user->lastname le ha confirmado la tutoría solicitada";
        $noti_estudiante->save();

        $user_notificado=User::where('id','=',$estudiante->id)->get();
        if(\Notification::send($user_notificado,new NotificacionEstudiante(Notiestudiante::latest('id')->first()))){
            return back();
        }
        
        Alert::info('¡Aviso! ')
             ->details("Se ha editado los datos de tutoría y se ha confirmado la tutoría solicitada por el estudiante $estudiante->name $estudiante->lastname, para el día $datos_tut->dia en el horario de $datos_tut->hora_inicio:$datos_tut->minutos_inicio a $datos_tut->hora_fin:$datos_tut->minutos_fin. Ahora podrá evaluar la actuación del estudiante sobre la tutoría impartida, en la opción disponible en el menú EVALUACIÓN AL ESTUDIANTE.");
        return view('user_docente.vista_general_cuenta');
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
