@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Solicitar tutoría</h3>
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
                @if ($estado==0)
                    @php
                        $mensaje_error="";
                        $verifica_motivo=false;
                        $verifica_dia=false;
                        $verifica_modalidad=false;
                        $verifica_tipo=false;
                    @endphp
                    @if (count($errors)>0)
                        @foreach ($errors->all() as $error)
                            @php
                                $mensaje_error=$error;
                                $verifica_modalidad = str_contains($mensaje_error, 'modalidad');
                                $verifica_tipo = str_contains($mensaje_error, 'tipo');
                                $verifica_motivo = str_contains($mensaje_error, 'motivo');
                                $verifica_dia = str_contains($mensaje_error, 'dia');
                            @endphp
                        @endforeach
                    @endif
                    <h6 class="tit_general">Acción: 
                            <span class="tit_datos">Solicitar tutoría para la materia {{$materia->name}} con el docente {{$user_docente->name}} {{$user_docente->lastname}}.</span>
                        </h6><br>
                        <h6 class="tit_datos_op2">Llene los campos a continuación, para completar el proceso de solicitud de tutoría:</h6><br>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Modalidad y tipo de tutoría</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        <div class="container">
                            <div class="row"> 
                                <div class="col-6" id="contenedor_general_op2">
                                    <h6 class="negrita">Tipo de tutoría</h6>
                                    @if ($verifica_tipo==true)
                                        <div class="alert alert-danger" id="mensaje">
                                            {{$error}}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="radio" name="tipo" id="grupal" value="grupal" onclick="tipo_tutoria();" <?php 
                                                if ($seleccionado == 1){
                                                    echo 'checked';
                                                } ?>
                                            > Grupal
                                        </div>
                                        <div class="col">
                                            <input type="radio" name="tipo" id="individual" value="individual" onclick="tipo_tutoria();"> Individual
                                        </div>
                                    </div>
                                    <div class="container" style="display: none;" id="tipo_grupal">
                                        <hr>
                                        <form class="card" method="POST" action="{{url("vista_solicitar_tutoria#tipo_grupal")}}">
                                            {{ csrf_field() }}
                                            @php
                                                $accion="buscar";
                                            @endphp
                                            <div class="row no-gutters align-items-center">
                                                <!--end of col-->
                                                <div class="col">
                                                    <input class="form-control form-control-borderless form-control-sm" name="name" id="name" type="search" placeholder="Nombre" title="Escriba el nombre de la materia">
                                                </div>
                                                <div class="col">
                                                    <input class="form-control form-control-borderless form-control-sm" name="lastname" id="lastname" type="search" placeholder="Apellido" title="Escriba el ciclo en que se imparte la materia (p. ej. Primero)">
                                                </div>
                                                <input type="hidden" name="id_materia" id="id_materia" value="{{$materia->id}}">
                                                <input type="hidden" name="id_docente" id="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <!--end of col-->
                                                <div class="col-auto">
                                                    <!--a href="#" id="btn_enviar">Enviar</a-->
                                                    <button class="btn btn-success btn-sm" type="submit" title="Buscar estudiante">Buscar <span class="fas fa-search"></span></button>
                                                </div>
                                                <!--end of col-->
                                            </div>
                                        </form>
                                        <hr>
                                        @if ($accion=="buscar")
                                            @if ($lista_estudiantes_sin_arrastre->isNotEmpty())
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                        <th class="col">Nombres</th>
                                                        <th class="col">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($lista_estudiantes_sin_arrastre as $estudiante)
                                                            @php
                                                                $accion="invitar";
                                                            @endphp
                                                            <form action="{{url("vista_solicitar_tutoria#tipo_grupal")}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <tr>
                                                                    <td>{{$estudiante->name}} {{$estudiante->lastname}}</td>
                                                                    <input type="hidden" name="estudiante" value="{{$estudiante->id}}">
                                                                    <input type="hidden" name="id_materia" id="id_materia" value="{{$materia->id}}">
                                                                    <input type="hidden" name="id_docente" id="id_docente" value="{{$user_docente->id}}">
                                                                    <input type="hidden" name="accion" id="accion" value="{{$accion}}">
                                                                    <td><button type="submit" class="hint--top btn btn-block btn-success btn-sm" data-hint="Invitar"><span class="fas fa-check-circle"></span></button></td>
                                                                </tr>
                                                            </form>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                No se han encontrado resultados 
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                @else
                    {!! Alert::render() !!}
                @endif
            </div>        
        </div>
    </div>
@endsection