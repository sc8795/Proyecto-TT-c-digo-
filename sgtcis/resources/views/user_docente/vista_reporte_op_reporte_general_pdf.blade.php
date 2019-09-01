<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte general de tutorías</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    {!! Html::style('css/estilos_pdf.css') !!}
</head>
<body>
    <div class="w3-container-fluid">
        <div class="w3-row">
            <div class="posicion_logo_unl">
                <img src="{{asset('images/logo_unl.png')}}" class="logo_unl">
            </div>
            <div class="posicion_titulo_unl">
                <p class="titulo_unl_facultad_carrera">
                    <span class="titulo_unl">UNIVERSIDAD NACIONAL DE LOJA</span> <br>
                    <span class="titulo_facultad">FACULTAD DE LA ENERGÍA, LAS INDUSTRIAS Y RECURSOS NATURALES NO RENOVABLES <br>
                    CARRERA DE INGENIERÍA EN SISTEMAS
                    </span><br>
                    <span class="titulo_registro">REGISTRO DE TUTORÍAS ACADÉMICAS</span><br>
                    <span class="titulo_reporte">PERÍODO ACADÉMICO: ABRIL - AGOSTO 2019</span>
                </p>
            </div>
            <div class="posicion_logo_cis">
                <img src="{{asset('images/logo_cis.jpg')}}" class="logo_cis">
            </div>    
        </div>
        <br>
        <div class="w3-row">
            <div class="col-9" id="borde">
                <span class="titulo_registro">DOCENTE: </span>
                <span>Ing. {{$docente->name}} {{$docente->lastname}}</span>    
            </div>   
        </div> 
        <div class="row">
            <div class="w3-container w3-right-align">
                <h6 class="titulo_reporte"> <hr> Reporte de tutoría {{$date}}</h6>
            </div> 
        </div>
        <hr>
        <div class="row-3">
            <table border="1" style=”width: 100%”>
                <thead id="titulos_tabla">
                    <tr>
                        <th rowspan="2">Fecha tutoría</th>
                        <th colspan="2">Hora</th>
                        <th rowspan="2">Nombre del estudiante</th>
                        <th rowspan="2">Asignatura objeto de la tutoría</th>
                        <th rowspan="2">Temática abordada</th>
                        <th rowspan="2">Tareas realizadas</th>
                        <th rowspan="2">Modalidad - Tipo</th>
                        <th colspan="2">Calificación</th>
                    </tr>
                    <tr>
                        <th>Inicio</th>
                        <th>Final</th>
                        <th>Docente</th>
                        <th>Estudiante</th>
                    </tr>
                </thead>
                <tbody id="subtitulos_tabla">
                    @foreach ($solitutorias as $solitutoria)
                        @php     
                            $estudiante=DB::table('users')->where('id',$solitutoria->estudiante_id)->first();
                            $materia=DB::table('materias')->where('id',$solitutoria->materia_id)->first();
                            $fecha_tutoria=$solitutoria->fecha_tutoria;
                            $date = date_create($fecha_tutoria);
                            $fecha_tutoria_aux=date_format($date, 'd-m-Y');
                            $fecha_tutoria=strtotime($fecha_tutoria_aux);
                            
                            $fecha_actual=now();
                            $date = date_create($fecha_actual);
                            $fecha_actual=date_format($date, 'd-m-Y');
                            $fecha_actual=strtotime($fecha_actual);

                            $hora_actual=date("G");
                            $minuto_actual=date("i");
                        @endphp
                        @if ($fecha_tutoria==$fecha_actual)
                            @if ($solitutoria->hora_fin==$hora_actual)
                                @if ($solitutoria->minutos_fin > $minuto_actual)
                                
                                @else
                                    @php
                                        $v_evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$solitutoria->estudiante_id)->exists();
                                        $v_evaluacion_docente=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$docente->id)->exists();
                                    @endphp
                                    <tr>
                                        <td>{{$fecha_tutoria_aux}}</td>
                                        <td>{{$solitutoria->hora_inicio}} : {{$solitutoria->minutos_inicio}}</td>
                                        <td>{{$solitutoria->hora_fin}} : {{$solitutoria->minutos_fin}}</td>
                                        @if ($solitutoria->tipo=="grupal")
                                            @php
                                                $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria->id)->first();
                                                $user_invitados=$invitacion->user_invitado_id;
                                                $confirmacion=$invitacion->confirmacion;
                                                $arreglo_user_invitados=explode('.',$user_invitados);
                                                $arreglo_confirmacion=explode('.',$confirmacion);
                                            @endphp
                                            <td>
                                                - {{$estudiante->name}} {{$estudiante->lastname}}
                                                @for ($i = 0; $i < count($arreglo_user_invitados); $i++)
                                                    @if ($arreglo_confirmacion[$i]=="si")
                                                        @php
                                                            $estudiante=DB::table('users')->where('id',$arreglo_user_invitados[$i])->first();
                                                        @endphp
                                                        <br>
                                                        - {{$estudiante->name}} {{$estudiante->lastname}}
                                                    @endif
                                                @endfor
                                            </td>
                                        @else
                                            <td>{{$estudiante->name}} {{$estudiante->lastname}}</td>
                                        @endif
                                        <td>{{$materia->name}}</td>
                                        @if ($v_evaluacion==true)
                                            @php
                                                $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$solitutoria->estudiante_id)->first();
                                            @endphp
                                            <td>{{$evaluacion->tema}}</td>
                                            <td>{{$evaluacion->descripcion}}</td>
                                        @else
                                            <td>Doc. aún no evalúa</td>
                                            <td>Doc. aún no evalúa</td>
                                        @endif
                                        <td>{{$solitutoria->modalidad}} - {{$solitutoria->tipo}}</td>
                                        @if ($solitutoria->tipo=="grupal")
                                            @if ($v_evaluacion_docente==true)
                                                @php
                                                    $evaluaciones=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$docente->id)->get();
                                                    $total=0;
                                                    $cont=$evaluaciones->count();
                                                    foreach ($evaluaciones as $evaluacion) {
                                                        $total=$total+$evaluacion->evaluacion;
                                                    }
                                                    $total=$total/$cont;
                                                @endphp
                                                <td>{{$total}}%</td>
                                            @else
                                                <td>Est. aún no evalúa</td>
                                            @endif
                                        @else
                                            @if ($v_evaluacion_docente==true)
                                            @php
                                                $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$docente->id)->first();
                                            @endphp
                                                <td>{{$evaluacion->evaluacion}}%</td>
                                            @else
                                                <td>Est. aún no evalúa</td>
                                            @endif
                                        @endif
                                        @if ($v_evaluacion==true)
                                            @php
                                                $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$solitutoria->estudiante_id)->first();
                                            @endphp
                                            <td>{{$evaluacion->evaluacion}}%</td>
                                        @else
                                            <td>Doc. aún no evalúa</td>
                                        @endif
                                    </tr>
                                @endif
                            @else
                                @if ($solitutoria->hora_fin > $hora_actual)
                                
                                @else
                                    @php
                                        $v_evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$solitutoria->estudiante_id)->exists();
                                        $v_evaluacion_docente=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$docente->id)->exists();
                                    @endphp
                                    <tr>
                                        <td>{{$fecha_tutoria_aux}}</td>
                                        <td>{{$solitutoria->hora_inicio}} : {{$solitutoria->minutos_inicio}}</td>
                                        <td>{{$solitutoria->hora_fin}} : {{$solitutoria->minutos_fin}}</td>
                                        @if ($solitutoria->tipo=="grupal")
                                            @php
                                                $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria->id)->first();
                                                $user_invitados=$invitacion->user_invitado_id;
                                                $confirmacion=$invitacion->confirmacion;
                                                $arreglo_user_invitados=explode('.',$user_invitados);
                                                $arreglo_confirmacion=explode('.',$confirmacion);
                                            @endphp
                                            <td>
                                                - {{$estudiante->name}} {{$estudiante->lastname}}
                                                @for ($i = 0; $i < count($arreglo_user_invitados); $i++)
                                                    @if ($arreglo_confirmacion[$i]=="si")
                                                        @php
                                                            $estudiante=DB::table('users')->where('id',$arreglo_user_invitados[$i])->first();
                                                        @endphp
                                                        <br>
                                                        - {{$estudiante->name}} {{$estudiante->lastname}}
                                                    @endif
                                                @endfor
                                            </td>
                                        @else
                                            <td>{{$estudiante->name}} {{$estudiante->lastname}}</td>
                                        @endif
                                        <td>{{$materia->name}}</td>
                                        @if ($v_evaluacion==true)
                                            @php
                                                $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$solitutoria->estudiante_id)->first();
                                            @endphp
                                            <td>{{$evaluacion->tema}}</td>
                                            <td>{{$evaluacion->descripcion}}</td>
                                        @else
                                            <td>Doc. aún no evalúa</td>
                                            <td>Doc. aún no evalúa</td>
                                        @endif
                                        <td>{{$solitutoria->modalidad}} - {{$solitutoria->tipo}}</td>
                                        @if ($solitutoria->tipo=="grupal")
                                            @if ($v_evaluacion_docente==true)
                                                @php
                                                    $evaluaciones=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$docente->id)->get();
                                                    $total=0;
                                                    $cont=$evaluaciones->count();
                                                    foreach ($evaluaciones as $evaluacion) {
                                                        $total=$total+$evaluacion->evaluacion;
                                                    }
                                                    $total=$total/$cont;
                                                @endphp
                                                <td>{{$total}}%</td>
                                            @else
                                                <td>Est. aún no evalúa</td>
                                            @endif
                                        @else
                                            @if ($v_evaluacion_docente==true)
                                            @php
                                                $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$docente->id)->first();
                                            @endphp
                                                <td>{{$evaluacion->evaluacion}}%</td>
                                            @else
                                                <td>Est. aún no evalúa</td>
                                            @endif
                                        @endif
                                        @if ($v_evaluacion==true)
                                            @php
                                                $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$solitutoria->estudiante_id)->first();
                                            @endphp
                                            <td>{{$evaluacion->evaluacion}}%</td>
                                        @else
                                            <td>Doc. aún no evalúa</td>
                                        @endif
                                    </tr>
                                @endif
                            @endif
                        @else
                            @if ($fecha_tutoria>$fecha_actual)
                                
                            @else
                                @php
                                    $v_evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$solitutoria->estudiante_id)->exists();
                                    $v_evaluacion_docente=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$docente->id)->exists();
                                @endphp
                                <tr>
                                    <td>{{$fecha_tutoria_aux}}</td>
                                    <td>{{$solitutoria->hora_inicio}} : {{$solitutoria->minutos_inicio}}</td>
                                    <td>{{$solitutoria->hora_fin}} : {{$solitutoria->minutos_fin}}</td>
                                    @if ($solitutoria->tipo=="grupal")
                                        @php
                                            $invitacion=DB::table('invitacionestudiantes')->where('solitutoria_id',$solitutoria->id)->first();
                                            $user_invitados=$invitacion->user_invitado_id;
                                            $confirmacion=$invitacion->confirmacion;
                                            $arreglo_user_invitados=explode('.',$user_invitados);
                                            $arreglo_confirmacion=explode('.',$confirmacion);
                                        @endphp
                                        <td>
                                            - {{$estudiante->name}} {{$estudiante->lastname}}
                                            @for ($i = 0; $i < count($arreglo_user_invitados); $i++)
                                                @if ($arreglo_confirmacion[$i]=="si")
                                                    @php
                                                        $estudiante=DB::table('users')->where('id',$arreglo_user_invitados[$i])->first();
                                                    @endphp
                                                    <br>
                                                    - {{$estudiante->name}} {{$estudiante->lastname}}
                                                @endif
                                            @endfor
                                        </td>
                                    @else
                                        <td>{{$estudiante->name}} {{$estudiante->lastname}}</td>
                                    @endif
                                    <td>{{$materia->name}}</td>
                                    @if ($v_evaluacion==true)
                                        @php
                                            $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$solitutoria->estudiante_id)->first();
                                        @endphp
                                        <td>{{$evaluacion->tema}}</td>
                                        <td>{{$evaluacion->descripcion}}</td>
                                    @else
                                        <td>Doc. aún no evalúa</td>
                                        <td>Doc. aún no evalúa</td>
                                    @endif
                                    <td>{{$solitutoria->modalidad}} - {{$solitutoria->tipo}}</td>
                                    @if ($solitutoria->tipo=="grupal")
                                        @if ($v_evaluacion_docente==true)
                                            @php
                                                $evaluaciones=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$docente->id)->get();
                                                $total=0;
                                                $cont=$evaluaciones->count();
                                                foreach ($evaluaciones as $evaluacion) {
                                                    $total=$total+$evaluacion->evaluacion;
                                                }
                                                $total=$total/$cont;
                                            @endphp
                                            <td>{{$total}}%</td>
                                        @else
                                            <td>Doc. aún no evalúa</td>
                                        @endif
                                    @else
                                        @if ($v_evaluacion_docente==true)
                                        @php
                                            $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$docente->id)->first();
                                        @endphp
                                            <td>{{$evaluacion->evaluacion}}%</td>
                                        @else
                                            <td>Est. aún no evalúa</td>
                                        @endif
                                    @endif
                                    @if ($v_evaluacion==true)
                                        @php
                                            $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$solitutoria->estudiante_id)->first();
                                        @endphp
                                        <td>{{$evaluacion->evaluacion}}%</td>
                                    @else
                                        <td>Doc. aún no evalúa</td>
                                    @endif
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>