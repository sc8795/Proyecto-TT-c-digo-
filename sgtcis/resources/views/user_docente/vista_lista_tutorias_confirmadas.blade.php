@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_docente.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Tutorías evaluadas</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Registro de tutorías por evaluar - evaluadas a {{$estudiante->name}} {{$estudiante->lastname}}</span></h4>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="d-flex p-2 bd-highlight" id="fondo_tabla_general">
                            <span class="tit_datos">Tutorías por evaluar</span>
                        </div>
                        <div class="container" id="contenedor_general_op2"> 
                            <br>
                            @php
                                $cont=0;
                            @endphp
                            @foreach ($solitutorias as $solitutoria)
                                @php
                                    $verifica_evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->exists();
                                @endphp
                                @if ($solitutoria->fecha_solicita != $solitutoria->fecha_confirma && $verifica_evaluacion==false)
                                    @php
                                        $cont++;
                                    @endphp
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-3" style="background-color: #f7dc6f; text-align:center;">
                                                @if ($solitutoria->modalidad =="presencial" && $solitutoria->tipo == "individual")
                                                    <a href="{{url("evalua_estudiante_pre_ind/{$solitutoria->id}/{$solitutoria->estudiante_id}/".auth()->user()->id."/{$solitutoria->materia_id}")}}" class="btn btn-sm" style="margin-top:50%">
                                                        <h1>{{$cont}}</h1>
                                                        Evaluar
                                                    </a>
                                                @endif
                                                @if ($solitutoria->modalidad =="presencial" && $solitutoria->tipo == "grupal")
                                                    Hola
                                                @endif
                                            </div>
                                            <div class="col-9" style="background-color: #f9e79f;">
                                                @php
                                                    $fecha_solicita=$solitutoria->fecha_solicita;
                                                    $date = date_create($fecha_solicita);
                                                    $fecha_solicita=date_format($date, 'd-m-Y');

                                                    $fecha_confirma=$solitutoria->fecha_confirma;
                                                    $date = date_create($fecha_confirma);
                                                    $fecha_confirma=date_format($date, 'd-m-Y');
                                                @endphp
                                                <span class="negrita tit_general">Datos tutoría <hr></span>
                                                <span class="negrita">Modalidad - Tipo: </span>{{$solitutoria->modalidad}} - {{$solitutoria->tipo}} <br>
                                                <span class="negrita">Solicitada: </span>{{$fecha_solicita}} <br>
                                                <span class="negrita">Horario: </span> {{$solitutoria->hora_inicio}}:{{$solitutoria->minutos_inicio}} a {{$solitutoria->hora_fin}}:{{$solitutoria->minutos_fin}}
                                                <hr>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>                                    
                                @endif
                            @endforeach
                            @if ($cont==0)
                                <h6>No tiene tutorías por evaluar</h6>
                            @endif
                            <br>
                        </div>
                    </div>
                        <div class="col-6">
                            <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                                <span class="tit_datos">Registro de tutorías evaluadas</span>
                            </div>
                            <div class="container" id="contenedor_general_op2"> 
                                <br>
                                @php
                                    $cont2=0;
                                @endphp
                                @foreach ($solitutorias as $solitutoria)
                                    @php
                                        $verifica_evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->exists();
                                    @endphp
                                    @if ($verifica_evaluacion==true)
                                        @php
                                            $cont2++;
                                            $evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->first();
                                            $estudiante=DB::table('users')->where('id',$evaluacion->user_evaluado_id)->first();
                                            $datos_tut=DB::table('solitutorias')->where('id',$evaluacion->solitutoria_id)->first();
    
                                            $fecha_tutoria=$solitutoria->fecha_tutoria;
                                            $date = date_create($fecha_tutoria);
                                            $fecha_tutoria=date_format($date, 'd-m-Y');
                                        
                                        @endphp
                                        <!-- >Ventana modal<-->
                                        <main class="container">
                                            <div class="modal fade" id="ventana{{$cont2}}" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">  
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 id="tituloVentana">¡Detalles evaluación de tutoría!</h5>
                                                            <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6 class="negrita">Tutoría solicitada por: <span class="quita_negrita">{{$estudiante->name}} {{$estudiante->lastname}}</span></h6>
                                                            <h6 class="negrita">Fecha solicitada: <span class="quita_negrita">{{$datos_tut->fecha_solicita}}</span></h6>
                                                            <h6 class="negrita">Fecha confirmada: <span class="quita_negrita">{{$datos_tut->fecha_confirma}}</span></h6>
                                                            @if ($evaluacion->asistencia=="si")
                                                                <h6 class="negrita">Fecha impartida: <span class="quita_negrita">{{$fecha_tutoria}}</span></h6>
                                                            @endif
                                                            <h6 class="negrita">Asistencia: <span class="quita_negrita">{{$evaluacion->asistencia}}</span></h6>
                                                            <hr>
                                                            <h6 class="negrita">Calificación: </h6>
                                                            @if ($evaluacion->asistencia=="no")
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                                </div>
                                                            @endif
                                                            @if ($evaluacion->asistencia=="si")
                                                                @if ($evaluacion->evaluacion>=70)
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$evaluacion->evaluacion}}%;" aria-valuenow="{{$evaluacion->evaluacion}}" aria-valuemin="{{$evaluacion->evaluacion}}" aria-valuemax="100">{{$evaluacion->evaluacion}}%</div>
                                                                    </div>
                                                                @endif
                                                                @if ($evaluacion->evaluacion<70)
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$evaluacion->evaluacion}}%;" aria-valuenow="{{$evaluacion->evaluacion}}" aria-valuemin="{{$evaluacion->evaluacion}}" aria-valuemax="100">{{$evaluacion->evaluacion}}%</div>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                        <!-- >Hasta aquí ventana modal<-->
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-3" style="background-color:  #1f618d; text-align:center;">
                                                    <h1>{{$cont2}}</h1>
                                                </div>
                                                <div class="col-9" style="background-color: #85c1e9; text-align: center;">
                                                    @php
                                                        $fecha_solicita=$solitutoria->fecha_solicita;
                                                        $date = date_create($fecha_solicita);
                                                        $fecha_solicita=date_format($date, 'd-m-Y');
                                                    @endphp
                                                    <hr>
                                                    @if ($evaluacion->asistencia=="si")
                                                        <div>
                                                            <div class="hint--top hint--medium" data-hint="Detalles evaluación">
                                                                <button class="btn btn-outline btn-sm" data-toggle="modal" data-target="#ventana{{$cont2}}"><span class="fas fa-tasks"></span></button>
                                                            </div>
                                                            <div class="hint--top hint--medium" data-hint="Ver evaluación">
                                                                <a href="{{url("reporte_pfp_evaluacion_estudiante/1/{$evaluacion->id}/{$estudiante->id}/".auth()->user()->id."/{$solitutoria->id}")}}" target="_blank" class="btn btn-outline btn-sm"><span class="fas fa-file-pdf"></span></a>
                                                            </div>
                                                            <div class="hint--top hint--medium" data-hint="Descargar reporte de evaluación">
                                                                <a href="{{url("reporte_pfp_evaluacion_estudiante/2/{$evaluacion->id}/{$estudiante->id}/".auth()->user()->id."/{$solitutoria->id}")}}" target="_blank" class="btn btn-outline btn-sm"><span class="fas fa-cloud-download-alt"></span></a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="hint--top hint--medium" data-hint="Detalles evaluación">
                                                            <button class="btn btn-outline btn-sm" data-toggle="modal" data-target="#ventana{{$cont2}}"><span class="fas fa-tasks"></span></button>
                                                        </div>
                                                    @endif
                                                    <hr>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endif
                                @endforeach    
                                @if ($cont2==0)
                                    <h6>No existe registro de tutorías evaluadas</h6>
                                @endif
                                <br>
                            </div>
                        </div>
                    </div>


            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_docente.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection 