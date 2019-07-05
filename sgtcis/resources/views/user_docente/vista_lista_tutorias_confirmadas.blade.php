@extends('layout_docente')

@section('content')
    @include('user_docente.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_docente.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Evaluación al estudiante</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_docente.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="container" id="contenedor_general">
                <div class="row">
                    <div class="col-6">
                        <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                            <span class="tit_datos">Registro de tutorías por evaluar</span>
                        </div>
                        <div class="container" id="contenedor_general_op2"> 
                            <br>
                            @php
                                $cont=0;
                            @endphp
                            @foreach ($solitutorias as $solitutoria)
                                @php
                                    //$notiestudiante=DB::table('notiestudiantes')->where('created_at',$solitutoria->fecha_confirma)->first();
                                    //$tutoria=DB::table('solitutorias')->where('created_at',$solitutoria->fecha_confirma)->first();
                                @endphp
                                @if ($solitutoria->fecha_solicita != $solitutoria->fecha_confirma)
                                    @php
                                        $cont++;
                                    @endphp
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-3" style="background-color: #f7dc6f; text-align:center;">
                                                <a href="{{url("evalua_estudiante/{$solitutoria->id}/{$solitutoria->estudiante_id}/".auth()->user()->id."/{$solitutoria->materia_id}")}}" class="btn btn-sm" style="margin-top:50%">
                                                    <h1>{{$cont}}</h1>
                                                    Evaluar
                                                </a>
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
                                                <span class="negrita">Solicitada: </span>{{$fecha_solicita}} <br>
                                                <span class="negrita">Confirmada: </span>{{$fecha_confirma}} <br>
                                                <span class="negrita">Horario: </span> {{$solitutoria->hora_inicio}}:{{$solitutoria->minutos_inicio}} a {{$solitutoria->hora_fin}}:{{$solitutoria->minutos_fin}}
                                                <hr>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endif
                            @endforeach
                            <br>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                            <span class="tit_datos">Registro de tutorías evaluadas</span>
                        </div>
                        <div class="container" id="contenedor_general_op2"> 
                            <br>
                                
                                        
                                        
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection