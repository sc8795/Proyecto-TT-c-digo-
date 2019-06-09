<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Materia;
use App\Solitutoria;
use App\Notifications\NotificacionDocente;
use App\Notidocente;
use Alert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
        return view('user_student.auth_student');    
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
            return redirect()->route('vista_general_student');
        }
    }
/* 
|--------------------------------------------------------------------------
| Funciones para solicitar tutoria
|--------------------------------------------------------------------------
*/
    public function solicitar_tutoria(){
        $materias = DB::table('materias')->get();
        $users=DB::table('users')->where('is_estudiante',true)->get();
        $users_docentes=DB::table('users')->where('is_docente',true)->get();
        return view('user_student.solicitar_tutoria',compact('materias','users','users_docentes'));
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

        $noti_docente=new Notidocente;
        $noti_docente->user_id=auth()->user()->id;
        $noti_docente->user_docente_id=$docente;
        $user=DB::table('users')->where('id',$noti_docente->user_id)->first();
        $noti_docente->title="Solicitud de tutoría ";
        $noti_docente->descripcion="$user->name $user->lastname esta pidiendo solitud de tutoria";
        $noti_docente->save();

        $user_notificado=User::where('id','=',$docente)->get();
        if(\Notification::send($user_notificado,new NotificacionDocente(Notidocente::latest('id')->first()))){
            return back();
        }

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
            }
        }
        if ($dia=='dia1_op1') {
            $dia=$horarios->dia1_op1;
            $hora_inicio=$horarios->hora_inicio_op1;
            $minutos_inicio=$horarios->minutos_inicio_op1;
            $hora_fin=$horarios->hora_fin_op1;
            $minutos_fin=$horarios->minutos_fin_op1;
            $fecha=null;
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
                'fecha_solicita'=>now(),
                'fecha_tutoria'=>now()
            ]);
            Alert::success('¡Aviso! ')
                ->details("Usted ha solicitado tutoría al docente $user_docente->name $user_docente->lastname, espere su confirmación por parte del docente.");
            return view('user_student.vista_general_cuenta');
        } else {
            if ($dia=='dia1_op2') {
                # code...
            } else {
                if ($dia=='dia1_op3') {
                    # code...
                } else {
                    if ($dia=='dia2_op1') {
                        # code...
                    } else {
                        if ($dia=='dia2_op2') {
                            # code...
                        } else {
                            if ($dia=='dia2_op3') {
                                # code...
                            } else {
                                if ($dia=='dia3_op1') {
                                    # code...
                                } else {
                                    if ($dia=='dia3_op2') {
                                        # code...
                                    } else {
                                        if ($dia=='dia3_op3') {
                                            # code...
                                        } else {
                                            if ($dia=='dia4_op1') {
                                                # code...
                                            } else {
                                                if ($dia=='dia4_op2') {
                                                    # code...
                                                } else {
                                                    if ($dia=='dia4_op3') {
                                                        # code...
                                                    } else {
                                                        if ($dia=='dia5_op1') {
                                                            # code...
                                                        } else {
                                                            if ($dia=='dia5_op2') {
                                                                # code...
                                                            } else {
                                                                if ($dia=='dia5_op3') {
                                                                    # code...
                                                                } else {
                                                                    # code...
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
                    
                }
                
            }
            
        }
    }
}
