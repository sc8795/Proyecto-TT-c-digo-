@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Vista tutoría confirmada</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_student.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="container" id="contenedor_general">
                <h6 class="tit_general">Asunto: 
                    <span class="tit_datos_op2">el Ing. {{$docente->name}} {{$docente->lastname}}
                        le ha confirmado la tutoría solicitada por Ud. con respecto a la materia {{$materia->name}}.
                    </span>
                </h6>
                <br>
                <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                    <span class="tit_datos">Horario y Fecha de tutoría</span>
                </div>
                <div class="container" id="contenedor_general_op2">
                    <br>
                    <h6>
                        Los datos que se muestran a continuación corresponden al día, fecha y hora que deberá acercarse a la oficina del Ing. {{$docente->name}} {{$docente->lastname}} para recibir la tutoría solicitada.
                    </h6>
                    <h6 class="negrita">Día: <span class="quita_negrita">{{$datos_tut->dia}}</span></h6>
                    <h6 class="negrita">Hora: <span class="quita_negrita">{{$datos_tut->hora_inicio}}:{{$datos_tut->minutos_inicio}} a {{$datos_tut->hora_fin}}:{{$datos_tut->minutos_fin}}</span></h6>
                    @php
                        $fecha_tutoria=$datos_tut->fecha_tutoria;
                        $date = date_create($fecha_tutoria);
                        $fecha=date_format($date, 'd-m-Y');
                    @endphp
                    <h6 class="negrita">Fecha: <span class="quita_negrita">{{$fecha}}</span></h6>
                    <br>
                    <div class="alert alert-primary" role="alert">
                        <h6>
                            <span class="negrita">¡Aviso!</span>
                            Una vez recibida la tutoría en el día acordado, el proceso finalizará cuando evalúe al docente sobre la tutoría recibida. Este proceso lo podrá realizar en la opción "Evaluación al docente" que se encuentra en el menú.
                        </h6>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection