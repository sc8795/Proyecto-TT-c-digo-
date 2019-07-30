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
                        <span class="tit_datos">Formulario de solicitud de tutoría</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        <div class="container">
                            <h6 class="negrita">Tipo de tutoría</h6>
                            @if ($verifica_tipo==true)
                                <div class="alert alert-danger" id="mensaje">
                                    {{$error}}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-2">
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
                                <div class="row">
                                    <div class="col-6">
                                        <!--FORMULARIO PARA BUSCAR ESTUDIANTE-->
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
                                        <!--CONDICIÓN QUE MUESTRA LOS RESULTADOS OBTENIDOS DE LA BÚSQUEDA, DENTRO DE ELLA SE ENCUENTRA EL FORMULARIO 
                                        DE INVITACIÓN AL ESTUDIANTE-->
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
                                                                <td><button type="submit" class="hint--top btn btn-block btn-success btn-sm" data-hint="Invitar" name="modalidad" id="modalidad" value="modalidad" onclick="btn_invita_est();"><span class="fas fa-check-circle"></span></button></td>
                                                            </tr>
                                                        </form>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            No se han encontrado resultados 
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <!--CONDICIÓN QUE MUESTRA LA LISTA DE LOS ESTUDIANTES INVITADOS, DENTRO DE ELLA SE ENCUENTRA EL FORMULARIO 
                                        DE CANCELAR INVITACIÓN AL ESTUDIANTE-->
                                        @if ($invitacion!=null)
                                            <div class="d-flex p-1 bd-highlight" id="contenedor_2">
                                                <span class="tit_datos">Estudiantes invitados</span>
                                            </div>
                                            <div class="container" id="contenedor_general_op2">
                                                @if ($arreglo_est_inv!=null)
                                                    <table class="table table-bordered table-sm">
                                                        <hr>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Estudiante</th>
                                                                <th scope="col">Acción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($arreglo_est_inv as $e_invitado)
                                                                @php
                                                                    $est_invitado=DB::table('users')->where('id',$e_invitado)->first();
                                                                    $accion="cancelar_invitacion";
                                                                @endphp
                                                                <form action="{{url("vista_solicitar_tutoria#tipo_grupal")}}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <tr>
                                                                        <td><input type="hidden" name="id_est_cancelar_inv" value="{{$est_invitado->id}}">{{$est_invitado->name}} {{$est_invitado->lastname}}</td>
                                                                        <input type="hidden" name="id_materia" id="id_materia" value="{{$materia->id}}">
                                                                        <input type="hidden" name="id_docente" id="id_docente" value="{{$user_docente->id}}">
                                                                        <input type="hidden" name="accion" id="accion" value="{{$accion}}">
                                                                        <td>
                                                                            <button type="submit" class="hint--top btn btn-block btn-danger btn-sm" data-hint="Cancelar invitación"><span class="fas fa-trash"></span></button>
                                                                        </td>
                                                                    </tr>
                                                                </form>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                <hr>
                                                    No ha invitado estudiantes
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <!--FORMULARIO GENERAL PARA SOLICITAR TUTORÍA AL DOCENTE - CUANTO SE SOLICITA TUTORÍA GRUPAL-->
                                <form action="#" method="POST">
                                    <input type="hidden" name="tipo" value="grupal">
                                    <h6 class="negrita">Modalidad de tutoría:</h6>
                                    @if ($verifica_modalidad==true)
                                        <div class="alert alert-danger" id="mensaje">
                                            {{$error}}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="radio" name="modalidad" id="modalidad" value="presencial"> Presencial
                                        </div>
                                        <div class="col">
                                            <input type="radio" name="modalidad" id="modalidad" value="virtual"> Virtual
                                        </div>
                                    </div>
                                    <hr>
                                    <h6 class="negrita">Horario de tutoría:</h6>
                                    <!--Presenta los horarios de tutoría del docente seleccionado-->
                                    <div class="container" id="contenedor_general_op2">
                                        @if ($verifica_dia==true)
                                            <div class="alert alert-danger" id="mensaje">
                                                {{$error}}
                                            </div>
                                        @endif
                                        <h6>
                                            El docente {{$user_docente->name}} {{$user_docente->lastname}} tiene asignado los siguientes horarios de tutoría:
                                        </h6>
                                        <div class="form-group">
                                            <!--Creo el primer contenedor cuando cont=0><-->
                                            <div class="container">
                                                <div class="row">
                                                    @php
                                                        $cont=0;
                                                    @endphp
                                                    <!-- *****************************************************************************************************************************><-->
                                                    @if ($horarios!=null )
                                                        @if ($horarios->cont_dia==2 && $horarios->cont_tarde==1)
                                                            <div class="col-3" id="fondo_solicitud">
                                                                <span class="tit_datos_op2">{{$horarios->dia1_op1}} <br>
                                                                    De {{$horarios->hora_inicio_op1}}:{{$horarios->minutos_inicio_op1}} a {{$horarios->hora_fin_op1}}:{{$horarios->minutos_fin_op1}}
                                                                </span>
                                                                <h6>
                                                                    <input type="radio" name="dia" value="dia1_op1"> Seleccionar
                                                                </h6>
                                                            </div>
                                                            <div class="col-3" id="fondo_solicitud">
                                                                <span class="tit_datos_op2">{{$horarios->dia1_op2}} <br>
                                                                    De {{$horarios->hora_inicio_op2}}:{{$horarios->minutos_inicio_op2}} a {{$horarios->hora_fin_op2}}:{{$horarios->minutos_fin_op2}}
                                                                </span>
                                                                <h6>
                                                                    <input type="radio" name="dia" value="dia1_op2"> Seleccionar
                                                                </h6>
                                                            </div>
                                                            <div class="col-3" id="fondo_solicitud">
                                                                <span class="tit_datos_op2">{{$horarios->dia1_op3}} <br>
                                                                    De {{$horarios->hora_inicio_op3}}:{{$horarios->minutos_inicio_op3}} a {{$horarios->hora_fin_op3}}:{{$horarios->minutos_fin_op3}}
                                                                </span>
                                                                <h6>
                                                                    <input type="radio" name="dia" value="dia1_op3"> Seleccionar
                                                                </h6>
                                                            </div>
                                                            @php
                                                                $cont=3;
                                                            @endphp
                                                        @else
                                                            @if ($horarios->cont_dia==0 && $horarios->cont_tarde==1)
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios->dia1_op3}} <br>
                                                                        De {{$horarios->hora_inicio_op3}}:{{$horarios->minutos_inicio_op3}} a {{$horarios->hora_fin_op3}}:{{$horarios->minutos_fin_op3}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia1_op3"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                @php
                                                                    $cont=1;
                                                                @endphp
                                                            @else
                                                                @if ($horarios->cont_dia==1 && $horarios->cont_tarde==0)
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios->dia1_op1}} <br>
                                                                            De {{$horarios->hora_inicio_op1}}:{{$horarios->minutos_inicio_op1}} a {{$horarios->hora_fin_op1}}:{{$horarios->minutos_fin_op1}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia1_op1"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    @php
                                                                        $cont=1;
                                                                    @endphp
                                                                @else
                                                                    @if ($horarios->cont_dia==2 && $horarios->cont_tarde==0)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios->dia1_op1}} <br>
                                                                                De {{$horarios->hora_inicio_op1}}:{{$horarios->minutos_inicio_op1}} a {{$horarios->hora_fin_op1}}:{{$horarios->minutos_fin_op1}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia1_op1"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios->dia1_op2}} <br>
                                                                                De {{$horarios->hora_inicio_op2}}:{{$horarios->minutos_inicio_op2}} a {{$horarios->hora_fin_op2}}:{{$horarios->minutos_fin_op2}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia1_op2"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        @php
                                                                            $cont=2;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios->cont_dia==1 && $horarios->cont_tarde==1)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios->dia1_op1}} <br>
                                                                                    De {{$horarios->hora_inicio_op1}}:{{$horarios->minutos_inicio_op1}} a {{$horarios->hora_fin_op1}}:{{$horarios->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia1_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios->dia1_op3}} <br>
                                                                                    De {{$horarios->hora_inicio_op3}}:{{$horarios->minutos_inicio_op3}} a {{$horarios->hora_fin_op3}}:{{$horarios->minutos_fin_op3}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia1_op3"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=2;
                                                                            @endphp
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                    <!-- *****************************************************************************************************************************><-->
                                                    @if ($horarios2!=null)
                                                        @if ($cont==1)
                                                            @if ($horarios2->cont_dia==2 && $horarios2->cont_tarde==1)
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                        De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                        De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia2_op2"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                        De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                @php
                                                                    $cont=4;
                                                                @endphp
                                                            @else
                                                                @if ($horarios2->cont_dia==0 && $horarios2->cont_tarde==1)
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                            De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    @php
                                                                        $cont=2;
                                                                    @endphp
                                                                @else
                                                                    @if ($horarios2->cont_dia==1 && $horarios2->cont_tarde==0)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        @php
                                                                            $cont=2;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios2->cont_dia==2 && $horarios2->cont_tarde==0)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                    De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                                    De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia2_op2"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=3;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios2->cont_dia==1 && $horarios2->cont_tarde==1)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                        De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                        De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=3;
                                                                                @endphp
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if ($cont==2)
                                                                @if ($horarios2->cont_dia==2 && $horarios2->cont_tarde==1)
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                            De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                            De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia2_op2"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                <!-- Aqui empieza el segundo contenedor creado><-->
                                                                    <div class="container">
                                                                        <br>
                                                                        <div class="row">
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                    De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                        <!-- Aqui finaliza la segunda fila creada><-->
                                                                            @php
                                                                                $cont=5;
                                                                            @endphp
                                                                        <!--/div>
                                                                    </div-->
                                                                @else
                                                                    @if ($horarios2->cont_dia==0 && $horarios2->cont_tarde==1)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        @php
                                                                            $cont=3;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios2->cont_dia==1 && $horarios2->cont_tarde==0)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                    De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=3;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios2->cont_dia==2 && $horarios2->cont_tarde==0)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                        De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                                        De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia2_op2"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=4;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios2->cont_dia==1 && $horarios2->cont_tarde==1)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                            De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                            De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=4;
                                                                                    @endphp
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if ($cont==3)
                                                                    @if ($horarios2->cont_dia==2 && $horarios2->cont_tarde==1)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                            </h6>
                                                                        </div>    
                                                                    <!-- Aqui empieza el segundo contenedor creado><-->
                                                                        <div class="container">
                                                                            <br>
                                                                            <div class="row">
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                                        De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia2_op2"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                        De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=6;
                                                                                @endphp
                                                                            <!--/div>
                                                                        </div-->
                                                                    @else
                                                                        @if ($horarios2->cont_dia==0 && $horarios2->cont_tarde==1)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                    De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=4;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios2->cont_dia==1 && $horarios2->cont_tarde==0)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                        De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=4;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios2->cont_dia==2 && $horarios2->cont_tarde==0)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                            De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <!-- Aqui empieza el segundo contenedor creado><-->
                                                                                    <div class="container">
                                                                                        <br>
                                                                                        <div class="row">
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                                                    De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia2_op2"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=5;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios2->cont_dia==1 && $horarios2->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                                De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <!-- Aqui empieza el segundo contenedor creado><-->
                                                                                        <div class="container">
                                                                                            <br>
                                                                                            <div class="row">
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                                        De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                            <!--/div>
                                                                                        </div-->
                                                                                        @php
                                                                                            $cont=5;
                                                                                        @endphp
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if ($cont==0)
                                                                        @if ($horarios2->cont_dia==2 && $horarios2->cont_tarde==1)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                    De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                                    De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia2_op2"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                    De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=3;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios2->cont_dia==0 && $horarios2->cont_tarde==1)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                        De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=1;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios2->cont_dia==1 && $horarios2->cont_tarde==0)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                            De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=1;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios2->cont_dia==2 && $horarios2->cont_tarde==0)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                                De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                                                De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia2_op2"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=2;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios2->cont_dia==1 && $horarios2->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op1}} <br>
                                                                                                    De {{$horarios2->hora_inicio_op1}}:{{$horarios2->minutos_inicio_op1}} a {{$horarios2->hora_fin_op1}}:{{$horarios2->minutos_fin_op1}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia2_op1"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                                    De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia2_op3"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=2;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                    <!-- *****************************************************************************************************************************><-->
                                                    @if ($horarios3!=null)
                                                        @if ($cont==0)
                                                            @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==1)
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                        De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                        De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                        De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                @php
                                                                    $cont=3;
                                                                @endphp
                                                            @else
                                                                @if ($horarios3->cont_dia==0 && $horarios3->cont_tarde==1)
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    @php
                                                                        $cont=1;
                                                                    @endphp
                                                                @else
                                                                    @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==0)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        @php
                                                                            $cont=1;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==0)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                    De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                    De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=2;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==1)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                        De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                        De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=2;
                                                                                @endphp
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if ($cont==1)
                                                                @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==1)
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                            De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    @php
                                                                        $cont=4;
                                                                    @endphp
                                                                @else
                                                                    @if ($horarios3->cont_dia==0 && $horarios3->cont_tarde==1)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        @php
                                                                            $cont=2;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==0)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                    De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=2;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==0)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                        De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                        De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=3;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==1)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                            De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=3;
                                                                                    @endphp
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if ($cont==2)
                                                                    @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==1)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        <!-- Creo el segundo contenedor><-->
                                                                        <div class="container">
                                                                            <br>
                                                                            <div class="row">
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                        De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                            $cont=5;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios3->cont_dia==0 && $horarios3->cont_tarde==1)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                    De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=3;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==0)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                        De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=3;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==0)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                            De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=4;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=4;
                                                                                        @endphp
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if ($cont==3)
                                                                        @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==1)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                    De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <!-- Creo el segundo contenedor><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                        De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $cont=6;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios3->cont_dia==0 && $horarios3->cont_tarde==1)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                        De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=4;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==0)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                            De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=4;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==0)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <!-- Creo el segundo contenedor><-->
                                                                                        <div class="container">
                                                                                            <br>
                                                                                            <div class="row">
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                                        De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=5;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                    De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            <!-- Creo el segundo contenedor><-->
                                                                                            <div class="container">
                                                                                                <br>
                                                                                                <div class="row">
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=5;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($cont==4)
                                                                            <!-- Creo el segundo contenedor><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="row">
                                                                                    @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                                De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=7;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios3->cont_dia==0 && $horarios3->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                    De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=5;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==0)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                        De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=5;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==0)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                            De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=6;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                                De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=6;
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            @if ($cont==5)
                                                                                @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==1)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                            De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=8;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios3->cont_dia==0 && $horarios3->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=6;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==0)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                    De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=6;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==0)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                        De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                                        De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=7;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==1)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                            De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=7;
                                                                                                    @endphp
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            <!-- Cierro el segundo contenedor creado cuando cont=5><-->
                                                                                </div>
                                                                            </div>
                                                                            @else
                                                                                @if ($cont==6)
                                                                                    @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                                De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <!-- Creo el tercer contenedor><-->
                                                                                        <div class="container">
                                                                                            <br>
                                                                                            <div class="row">
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                        De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> 
                                                                                        @php
                                                                                            $cont=9;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios3->cont_dia==0 && $horarios3->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                    De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=7;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==0)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                        De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=7;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios3->cont_dia==2 && $horarios3->cont_tarde==0)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                            De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia3_op2"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=8;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios3->cont_dia==1 && $horarios3->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op1}} <br>
                                                                                                                De {{$horarios3->hora_inicio_op1}}:{{$horarios3->minutos_inicio_op1}} a {{$horarios3->hora_fin_op1}}:{{$horarios3->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia3_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia3_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=8;
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            <!-- Cierro el segundo contenedor creado cuando cont=6><-->
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                    <!-- *****************************************************************************************************************************><-->        
                                                    @if ($horarios4!=null)
                                                        @if ($cont==0)
                                                            @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                        De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                        De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                        De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                @php
                                                                    $cont=3;
                                                                @endphp
                                                            @else
                                                                @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    @php
                                                                        $cont=1;
                                                                    @endphp
                                                                @else
                                                                    @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        @php
                                                                            $cont=1;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                    De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                    De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=2;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                        De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                        De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=2;
                                                                                @endphp
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if ($cont==1)
                                                                @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    @php
                                                                        $cont=4;
                                                                    @endphp
                                                                @else
                                                                    @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        @php
                                                                            $cont=2;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                    De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=2;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                        De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                        De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=3;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=3;
                                                                                    @endphp
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if ($cont==2)
                                                                    @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        <!-- Creo el segundo contenedor><-->
                                                                        <div class="container">
                                                                            <br>
                                                                            <div class="row">
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                        De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                            $cont=5;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=3;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                        De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=3;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=4;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=4;
                                                                                        @endphp
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if ($cont==3)
                                                                        @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                    De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <!-- Creo el segundo contenedor><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $cont=6;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                        De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=4;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=4;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <!-- Creo el segundo contenedor><-->
                                                                                        <div class="container">
                                                                                            <br>
                                                                                            <div class="row">
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                        De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=5;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                    De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            <!-- Creo el segundo contenedor><-->
                                                                                            <div class="container">
                                                                                                <br>
                                                                                                <div class="row">
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=5;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($cont==4)
                                                                            <!-- Creo el segundo contenedor><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="row">
                                                                                    @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=7;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=5;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                        De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=5;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=6;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=6;
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            @if ($cont==5)
                                                                                @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=8;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=6;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                    De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=6;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                        De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                        De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=7;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=7;
                                                                                                    @endphp
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @else
                                                                                @if ($cont==6)
                                                                                    @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <!-- Creo el tercer contenedor><-->
                                                                                        <div class="container">
                                                                                            <br>
                                                                                            <div class="row">
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                        De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=9;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=7;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                        De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=7;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=8;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=8;
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @else
                                                                                    @if ($cont==7)
                                                                                        @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                    De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            <!-- Creo el tercer contenedor><-->
                                                                                            <div class="container">
                                                                                                <br>
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                        De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=10;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                        De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=8;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=8;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <!-- Creo el tercer contenedor><-->
                                                                                                        <div class="container">
                                                                                                            <br>
                                                                                                            <div class="row">
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                                        De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=9;
                                                                                                        @endphp
                                                                                                    @else
                                                                                                        @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                    De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                                </span>
                                                                                                                <h6>
                                                                                                                    <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                                </h6>
                                                                                                            </div>
                                                                                                            <!--Creo el tercer contenedor><-->
                                                                                                            <div class="container">
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            @php
                                                                                                                $cont=9;
                                                                                                            @endphp
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @else
                                                                                        @if ($cont==8)
                                                                                            <!--Creo el tercer contenedor><-->
                                                                                            <div class="container">
                                                                                                <br>
                                                                                                <div class="row">
                                                                                                    @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=11;
                                                                                                        @endphp
                                                                                                    @else
                                                                                                        @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                                </span>
                                                                                                                <h6>
                                                                                                                    <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                                </h6>
                                                                                                            </div>
                                                                                                            @php
                                                                                                                $cont=9;
                                                                                                            @endphp
                                                                                                        @else
                                                                                                            @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                        De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                                @php
                                                                                                                    $cont=9;
                                                                                                                @endphp
                                                                                                            @else
                                                                                                                @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    @php
                                                                                                                        $cont=10;
                                                                                                                    @endphp
                                                                                                                @else
                                                                                                                    @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                                De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        @php
                                                                                                                            $cont=10;
                                                                                                                        @endphp
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($cont==9)
                                                                                                @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==1)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=12;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios4->cont_dia==0 && $horarios4->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=10;
                                                                                                        @endphp
                                                                                                    @else
                                                                                                        @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==0)
                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                    De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                                </span>
                                                                                                                <h6>
                                                                                                                    <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                                </h6>
                                                                                                            </div>
                                                                                                            @php
                                                                                                                $cont=10;
                                                                                                            @endphp
                                                                                                        @else
                                                                                                            @if ($horarios4->cont_dia==2 && $horarios4->cont_tarde==0)
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                        De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                                        De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia4_op2"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                                @php
                                                                                                                    $cont=11;
                                                                                                                @endphp
                                                                                                            @else
                                                                                                                @if ($horarios4->cont_dia==1 && $horarios4->cont_tarde==1)
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op1}} <br>
                                                                                                                            De {{$horarios4->hora_inicio_op1}}:{{$horarios4->minutos_inicio_op1}} a {{$horarios4->hora_fin_op1}}:{{$horarios4->minutos_fin_op1}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia4_op1"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia4_op3"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    @php
                                                                                                                        $cont=11;
                                                                                                                    @endphp
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif          
                                                    <!-- *****************************************************************************************************************************><-->
                                                    @if ($horarios5!=null)
                                                        @if ($cont==0)
                                                            @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                        De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                        De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                    </span>
                                                                    <h6>
                                                                        <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                    </h6>
                                                                </div>
                                                                @php
                                                                    $cont=3;
                                                                @endphp
                                                            @else
                                                                @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    @php
                                                                        $cont=1;
                                                                    @endphp
                                                                @else
                                                                    @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        @php
                                                                            $cont=1;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                    De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=2;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                        De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=2;
                                                                                @endphp
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if ($cont==1)
                                                                @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                        </span>
                                                                        <h6>
                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                        </h6>
                                                                    </div>
                                                                    @php
                                                                        $cont=4;
                                                                    @endphp
                                                                @else
                                                                    @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        @php
                                                                            $cont=2;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=2;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                        De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=3;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=3;
                                                                                    @endphp
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if ($cont==2)
                                                                    @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                            </span>
                                                                            <h6>
                                                                                <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                            </h6>
                                                                        </div>
                                                                        <!-- Creo el segundo contenedor><-->
                                                                        <div class="container">
                                                                            <br>
                                                                            <div class="row">
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                        De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                            $cont=5;
                                                                        @endphp
                                                                    @else
                                                                        @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                    De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            @php
                                                                                $cont=3;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=3;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=4;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=4;
                                                                                        @endphp
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if ($cont==3)
                                                                        @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                </span>
                                                                                <h6>
                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                </h6>
                                                                            </div>
                                                                            <!-- Creo el segundo contenedor><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $cont=6;
                                                                            @endphp
                                                                        @else
                                                                            @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                        De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                    </span>
                                                                                    <h6>
                                                                                        <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                    </h6>
                                                                                </div>
                                                                                @php
                                                                                    $cont=4;
                                                                                @endphp
                                                                            @else
                                                                                @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=4;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <!--Creo el segundo contenedor><-->
                                                                                        <div class="container">
                                                                                            <br>
                                                                                            <div class="row">
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                        De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=5;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            <!--Creo el segundo contenedor><-->
                                                                                            <div class="container">
                                                                                                <br>
                                                                                                <div class="row">
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=5;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($cont==4)
                                                                            <!--Creo el segundo contenedor><-->
                                                                            <div class="container">
                                                                                <div class="row">
                                                                                    @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=7;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                    De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=5;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=5;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=6;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=6;
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            @if ($cont==5)
                                                                                @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                        </span>
                                                                                        <h6>
                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                        </h6>
                                                                                    </div>
                                                                                    @php
                                                                                        $cont=8;
                                                                                    @endphp
                                                                                @else
                                                                                    @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=6;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=6;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                        De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=7;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=7;
                                                                                                    @endphp
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @else
                                                                                @if ($cont==6)
                                                                                    @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                            </span>
                                                                                            <h6>
                                                                                                <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                            </h6>
                                                                                        </div>
                                                                                        <!--Creo el tercer contenedor><-->
                                                                                        <div class="container">
                                                                                            <br>
                                                                                            <div class="row">
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                        De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @php
                                                                                            $cont=9;
                                                                                        @endphp
                                                                                    @else
                                                                                        @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                    De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=7;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=7;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=8;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=8;
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @else
                                                                                    @if ($cont==7)
                                                                                        @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                </span>
                                                                                                <h6>
                                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                </h6>
                                                                                            </div>
                                                                                            <!--Creo el tercer contenedor><-->
                                                                                            <div class="container">
                                                                                                <br>
                                                                                                <div class="row">
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @php
                                                                                                $cont=10;
                                                                                            @endphp
                                                                                        @else
                                                                                            @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                        De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                    </span>
                                                                                                    <h6>
                                                                                                        <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                    </h6>
                                                                                                </div>
                                                                                                @php
                                                                                                    $cont=8;
                                                                                                @endphp
                                                                                            @else
                                                                                                @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=8;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <!--Creo el tercer contenedor><-->
                                                                                                        <div class="container">
                                                                                                            <br>
                                                                                                            <div class="row">
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                        De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=9;
                                                                                                        @endphp
                                                                                                    @else
                                                                                                        @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                </span>
                                                                                                                <h6>
                                                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                </h6>
                                                                                                            </div>
                                                                                                            <!--Creo el tercer contenedor><-->
                                                                                                            <div class="container">
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            @php
                                                                                                                $cont=9;
                                                                                                            @endphp
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @else
                                                                                        @if ($cont==8)
                                                                                            <!--Creo el tercer contenedor><-->
                                                                                            <div class="container">
                                                                                                <br>
                                                                                                <div class="row">
                                                                                                    @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=11;
                                                                                                        @endphp
                                                                                                    @else
                                                                                                        @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                    De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                </span>
                                                                                                                <h6>
                                                                                                                    <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                </h6>
                                                                                                            </div>
                                                                                                            @php
                                                                                                                $cont=9;
                                                                                                            @endphp
                                                                                                        @else
                                                                                                            @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                                @php
                                                                                                                    $cont=9;
                                                                                                                @endphp
                                                                                                            @else
                                                                                                                @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    @php
                                                                                                                        $cont=10;
                                                                                                                    @endphp
                                                                                                                @else
                                                                                                                    @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        @php
                                                                                                                            $cont=10;
                                                                                                                        @endphp
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($cont==9)
                                                                                                @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                        </span>
                                                                                                        <h6>
                                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $cont=12;
                                                                                                    @endphp
                                                                                                @else
                                                                                                    @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=10;
                                                                                                        @endphp
                                                                                                    @else
                                                                                                        @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                </span>
                                                                                                                <h6>
                                                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                </h6>
                                                                                                            </div>
                                                                                                            @php
                                                                                                                $cont=10;
                                                                                                            @endphp
                                                                                                        @else
                                                                                                            @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                        De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                                @php
                                                                                                                    $cont=11;
                                                                                                                @endphp
                                                                                                            @else
                                                                                                                @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    @php
                                                                                                                        $cont=11;
                                                                                                                    @endphp
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endif
                                                                                            @else
                                                                                                @if ($cont==10)
                                                                                                    @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                            </span>
                                                                                                            <h6>
                                                                                                                <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <!-- Creo el cuarto contenedor><-->
                                                                                                        <div class="container">
                                                                                                            <br>
                                                                                                            <div class="row">
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                        De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        @php
                                                                                                            $cont=13;
                                                                                                        @endphp
                                                                                                    @else
                                                                                                        @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                    De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                </span>
                                                                                                                <h6>
                                                                                                                    <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                </h6>
                                                                                                            </div>
                                                                                                            @php
                                                                                                                $cont=11;
                                                                                                            @endphp
                                                                                                        @else
                                                                                                            @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                                @php
                                                                                                                    $cont=11;
                                                                                                                @endphp
                                                                                                            @else
                                                                                                                @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    @php
                                                                                                                        $cont=12;
                                                                                                                    @endphp
                                                                                                                @else
                                                                                                                    @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        @php
                                                                                                                            $cont=12;
                                                                                                                        @endphp
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @else
                                                                                                    @if ($cont==11)
                                                                                                        @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                </span>
                                                                                                                <h6>
                                                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                </h6>
                                                                                                            </div>
                                                                                                            <!-- Creo el cuarto contenedor><-->
                                                                                                            <div class="container">
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            @php
                                                                                                                $cont=14;
                                                                                                            @endphp
                                                                                                        @else
                                                                                                            @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                        De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                    </span>
                                                                                                                    <h6>
                                                                                                                        <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                                @php
                                                                                                                    $cont=12;
                                                                                                                @endphp
                                                                                                            @else
                                                                                                                @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                        </span>
                                                                                                                        <h6>
                                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                        </h6>
                                                                                                                    </div>
                                                                                                                    @php
                                                                                                                        $cont=12;
                                                                                                                    @endphp
                                                                                                                @else
                                                                                                                    @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        <!--Creo el cuarto contenedor><-->
                                                                                                                        <div class="container">
                                                                                                                            <br>
                                                                                                                            <div class="row">
                                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                                        De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                                                    </span>
                                                                                                                                    <h6>
                                                                                                                                        <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                                                    </h6>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        @php
                                                                                                                            $cont=13;
                                                                                                                        @endphp
                                                                                                                    @else
                                                                                                                        @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                                    De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                                </span>
                                                                                                                                <h6>
                                                                                                                                    <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                                </h6>
                                                                                                                            </div>
                                                                                                                            <!--Creo el segundo contenedor><-->
                                                                                                                            <div class="container">
                                                                                                                                <br>
                                                                                                                                <div class="row">
                                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                                        </span>
                                                                                                                                        <h6>
                                                                                                                                            <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                                        </h6>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            @php
                                                                                                                                $cont=13;
                                                                                                                            @endphp
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    @else
                                                                                                        @if ($cont==12)
                                                                                                            <!--Creo el cuarto contenedor><-->
                                                                                                            <div class="container">
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==1)
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                                De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                            </span>
                                                                                                                            <h6>
                                                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                            </h6>
                                                                                                                        </div>
                                                                                                                        @php
                                                                                                                            $cont=15;
                                                                                                                        @endphp
                                                                                                                    @else
                                                                                                                        @if ($horarios5->cont_dia==0 && $horarios5->cont_tarde==1)
                                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                                <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                                    De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                                </span>
                                                                                                                                <h6>
                                                                                                                                    <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                                </h6>
                                                                                                                            </div>
                                                                                                                            @php
                                                                                                                                $cont=13;
                                                                                                                            @endphp
                                                                                                                        @else
                                                                                                                            @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==0)
                                                                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                                        De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                                    </span>
                                                                                                                                    <h6>
                                                                                                                                        <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                                    </h6>
                                                                                                                                </div>
                                                                                                                                @php
                                                                                                                                    $cont=13;
                                                                                                                                @endphp
                                                                                                                            @else
                                                                                                                                @if ($horarios5->cont_dia==2 && $horarios5->cont_tarde==0)
                                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                                            De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                                        </span>
                                                                                                                                        <h6>
                                                                                                                                            <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                                        </h6>
                                                                                                                                    </div>
                                                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                                                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                                                                                        </span>
                                                                                                                                        <h6>
                                                                                                                                            <input type="radio" name="dia" value="dia5_op2"> Seleccionar
                                                                                                                                        </h6>
                                                                                                                                    </div>
                                                                                                                                    @php
                                                                                                                                        $cont=14;
                                                                                                                                    @endphp
                                                                                                                                @else
                                                                                                                                    @if ($horarios5->cont_dia==1 && $horarios5->cont_tarde==1)
                                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op1}} <br>
                                                                                                                                                De {{$horarios5->hora_inicio_op1}}:{{$horarios5->minutos_inicio_op1}} a {{$horarios5->hora_fin_op1}}:{{$horarios5->minutos_fin_op1}}
                                                                                                                                            </span>
                                                                                                                                            <h6>
                                                                                                                                                <input type="radio" name="dia" value="dia5_op1"> Seleccionar
                                                                                                                                            </h6>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                                                            <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                                                                                                De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                                                                                                            </span>
                                                                                                                                            <h6>
                                                                                                                                                <input type="radio" name="dia" value="dia5_op3"> Seleccionar
                                                                                                                                            </h6>
                                                                                                                                        </div>
                                                                                                                                        @php
                                                                                                                                            $cont=14;
                                                                                                                                        @endphp
                                                                                                                                    @endif
                                                                                                                                @endif
                                                                                                                            @endif
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif       
                                                </div>
                                            <!-- Cierro el primer contenedor creado cuando cont=0><-->
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6 class="negrita">Motivo de tutoría:</h6>
                                    <div class="container" id="contenedor_general_op2">
                                        <br>
                                        @if ($verifica_motivo==true)
                                            <div class="alert alert-danger" id="mensaje">
                                                {{$error}}
                                            </div>
                                        @endif
                                        <h6>
                                            <input type="radio" name="motivo" value="Dudas sobre algún (deber, investigación, consulta, ensayo) enviado" onclick="mostrar_otro_motivo();"> Dudas sobre algún (deber, investigación, consulta, ensayo) enviado
                                        </h6>
                                        <h6>
                                            <input type="radio" name="motivo" value="Dudas sobre la clase recibida" onclick="mostrar_otro_motivo();"> Dudas sobre la clase recibida 
                                        </h6>
                                        <h6>
                                            <input type="radio" name="motivo" value="Otro" onclick="mostrar_otro_motivo();"> Otro
                                        </h6>
                                        <div class="input-group mb-3" id="otro" style="display:none;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                <input type="text" name="otro_motivo" placeholder="Escriba el motivo de tutoría" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </form>
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