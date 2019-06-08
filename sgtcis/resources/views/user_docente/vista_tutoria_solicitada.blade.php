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
                <form action="{{url("confirmar_tutoria/{$datos_tut->id}/{$estudiante->id}/{$docente->id}/{$materia->id}")}}" method="POST">
                    {{ csrf_field() }}
                    <h6 class="tit_general">Asunto: 
                        <span class="tit_datos_op2">el Sr. {{$estudiante->name}} {{$estudiante->lastname}} alumno del {{$estudiante->ciclo}} ciclo, paralelo
                            @if ($estudiante->paralelo_a!="NA")
                                "{{$estudiante->paralelo_a}}"
                            @else
                                @if ($estudiante->paralelo_b!="NA")
                                    "{{$estudiante->paralelo_b}}"
                                @else
                                    @if ($estudiante->paralelo_c!="NA")
                                        "{{$estudiante->paralelo_c}}"
                                    @else
                                        @if ($estudiante->paralelo_d!="NA")
                                            "{{$estudiante->paralelo_d}}"
                                        @endif
                                    @endif
                                @endif
                            @endif
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
                    <a href="#" class="btn btn-success btn-sm" title="Editar datos de tutoría">Editar <span class="oi oi-pencil"></span></a>
                    <button type="submit" class="btn btn-info btn-sm" title="Confirmar tutoría al estudiante {{$estudiante->name}} {{$estudiante->lastname}}, con los datos solicitados." name="" value="">Confirmar tutoría <span class="fas fa-check-double"></span></button>
                </form>
            </div>
        </div>
    </div>
@endsection