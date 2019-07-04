@extends('layout_docente')

@section('content')
    @include('user_docente.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_docente.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Vista Tutoría solicitada</h3>
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
                @php
                    $mensaje_error="";
                    $verifica_fecha_tutoria=false;
                @endphp
                @if (count($errors)>0)
                    @foreach ($errors->all() as $error)
                        @php
                            $mensaje_error=$error;
                            $verifica_fecha_tutoria = str_contains($mensaje_error, 'fecha');
                        @endphp
                    @endforeach
                @endif
                <form action="{{url("confirmar_tutoria/{$datos_tut->id}/{$estudiante->id}/{$docente->id}/{$materia->id}")}}" method="POST">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <h6 class="tit_general">Asunto: 
                        <span class="tit_datos_op2">el Sr. {{$estudiante->name}} {{$estudiante->lastname}} alumno del {{$estudiante->ciclo}} ciclo, paralelo
                            {{$estudiante->paralelo}}
                            le ha solicitado tutoría con respecto a la materia  {{$materia->name}} impartida por Ud.
                        </span>
                    </h6>
                    <br>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Datos de tutoría</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        <h6 class="negrita">Horario: <span class="quita_negrita">{{$datos_tut->dia}} de {{$datos_tut->hora_inicio}}:{{$datos_tut->minutos_inicio}} a {{$datos_tut->hora_fin}}:{{$datos_tut->minutos_fin}}</span></h6>
                        <h6 class="negrita">Motivo: <span class="quita_negrita">{{$datos_tut->motivo}}</span></h6>
                        <br>
                    </div>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Datos de tutoría - fecha</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        @if ($verifica_fecha_tutoria==true)
                            <div class="caja_error" id="caja_error">
                                <h6 class="titulo_error">{{$error}}</h6>
                            </div>
                        @endif
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-week"></i></span>
                            <input type="text" id="fecha" placeholder="Haga clic y seleccione la fecha de tutoría." class="form-control" name="fecha_tutoria">
                        </div>
                        <br>
                    </div>
                    <button type="submit" class="btn btn-info btn-sm" title="Confirmar tutoría al estudiante {{$estudiante->name}} {{$estudiante->lastname}}." name="" value="">Confirmar tutoría <span class="fas fa-check-double"></span></button>
                    <a href="{{url("vista_editar_datos_tutoria/{$datos_tut->id}/{$estudiante->id}/{$docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar datos de tutoría">Editar tutoría<span class="oi oi-pencil"></span></a>
                </form>
            </div>
        </div>
    </div>
@endsection