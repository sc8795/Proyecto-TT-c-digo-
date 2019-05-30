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
                    <form action="#">
                        <h6 class="tit_general">Acción: 
                            <span class="tit_datos">Solicitar tutoría para la materia {{$materia->name}} con el docente {{$user_docente->name}} {{$user_docente->lastname}}.</span>
                        </h6><br>
                        <h6 class="tit_datos_op2">Llene los campos a continuación, para completar el proceso de solicitud de tutoría:</h6><br>
                        <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                            <span class="tit_datos">Horario de tutoría</span>
                        </div>
                        <div class="container" id="contenedor_general_op2">
                            <br>
                            <h6>
                                <span class="negrita"> ¡Seleccione el día que desea la tutoría!</span>
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
                                                        <input type="radio" name="dia" value=""> Seleccionar
                                                    </h6>
                                                </div>
                                                <div class="col-3" id="fondo_solicitud">
                                                    <span class="tit_datos_op2">{{$horarios->dia1_op2}} <br>
                                                        De {{$horarios->hora_inicio_op2}}:{{$horarios->minutos_inicio_op2}} a {{$horarios->hora_fin_op2}}:{{$horarios->minutos_fin_op2}}
                                                    </span>
                                                    <h6>
                                                        <input type="radio" name="dia" value=""> Seleccionar
                                                    </h6>
                                                </div>
                                                <div class="col-3" id="fondo_solicitud">
                                                    <span class="tit_datos_op2">{{$horarios->dia1_op3}} <br>
                                                        De {{$horarios->hora_inicio_op3}}:{{$horarios->minutos_inicio_op3}} a {{$horarios->hora_fin_op3}}:{{$horarios->minutos_fin_op3}}
                                                    </span>
                                                    <h6>
                                                        <input type="radio" name="dia" value=""> Seleccionar
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
                                                            </div>
                                                            <div class="col-3" id="fondo_solicitud">
                                                                <span class="tit_datos_op2">{{$horarios->dia1_op2}} <br>
                                                                    De {{$horarios->hora_inicio_op2}}:{{$horarios->minutos_inicio_op2}} a {{$horarios->hora_fin_op2}}:{{$horarios->minutos_fin_op2}}
                                                                </span>
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
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios->dia1_op3}} <br>
                                                                        De {{$horarios->hora_inicio_op3}}:{{$horarios->minutos_inicio_op3}} a {{$horarios->hora_fin_op3}}:{{$horarios->minutos_fin_op3}}
                                                                    </span>
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
                                                    </div>
                                                    <div class="col-3" id="fondo_solicitud">
                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                            De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                        </span>
                                                    </div>
                                                    <div class="col-3" id="fondo_solicitud">
                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                            De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                        </span>
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
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                        De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                    </span>
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
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                            De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                        </span>
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
                                                        </div>
                                                        <div class="col-3" id="fondo_solicitud">
                                                            <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                            </span>
                                                        </div>
                                                    <!-- Aqui empieza el segundo contenedor creado><-->
                                                        <div class="container">
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                        De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                    </span>
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
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                            De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                        </span>
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
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                            </span>
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
                                                            </div>    
                                                        <!-- Aqui empieza el segundo contenedor creado><-->
                                                            <div class="container">
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                            De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                            De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                        </span>
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
                                                                        </div>
                                                                        <!-- Aqui empieza el segundo contenedor creado><-->
                                                                        <div class="container">
                                                                            <br>
                                                                            <div class="row">
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                                        De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                                    </span>
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
                                                                            </div>
                                                                            <!-- Aqui empieza el segundo contenedor creado><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                            De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                        </span>
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
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                        De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                    </span>
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                        De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                    </span>
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
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios2->dia2_op2}} <br>
                                                                                    De {{$horarios2->hora_inicio_op2}}:{{$horarios2->minutos_inicio_op2}} a {{$horarios2->hora_fin_op2}}:{{$horarios2->minutos_fin_op2}}
                                                                                </span>
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
                                                                                </div>
                                                                                <div class="col-3" id="fondo_solicitud">
                                                                                    <span class="tit_datos_op2">{{$horarios2->dia2_op3}} <br>
                                                                                        De {{$horarios2->hora_inicio_op3}}:{{$horarios2->minutos_inicio_op3}} a {{$horarios2->hora_fin_op3}}:{{$horarios2->minutos_fin_op3}}
                                                                                    </span>
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
                                                    </div>
                                                    <div class="col-3" id="fondo_solicitud">
                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                        </span>
                                                    </div>
                                                    <div class="col-3" id="fondo_solicitud">
                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                        </span>
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
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                        De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                    </span>
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
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                        </span>
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
                                                        </div>
                                                        <div class="col-3" id="fondo_solicitud">
                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                            </span>
                                                        </div>
                                                        <div class="col-3" id="fondo_solicitud">
                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                            </span>
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
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                        </span>
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
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                            </span>
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
                                                            </div>
                                                            <div class="col-3" id="fondo_solicitud">
                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                    De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                </span>
                                                            </div>
                                                            <!-- Creo el segundo contenedor><-->
                                                            <div class="container">
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                        </span>
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
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                            </span>
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
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                    De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                </span>
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
                                                                </div>
                                                                <!-- Creo el segundo contenedor><-->
                                                                <div class="container">
                                                                    <br>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                        </span>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                            </span>
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
                                                                            </div>
                                                                            <!-- Creo el segundo contenedor><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                        </span>
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
                                                                                </div>
                                                                                <!-- Creo el segundo contenedor><-->
                                                                                <div class="container">
                                                                                    <br>
                                                                                    <div class="row">
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                            </span>
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
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                    De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                    De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                </span>
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
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                                De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                            </span>
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
                                                                                            </div>
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                    De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                                </span>
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
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                            </span>
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
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                            De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                        </span>
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
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                            </span>
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
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                    De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                </span>
                                                                            </div>
                                                                            <!-- Creo el tercer contenedor><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                            De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                        </span>
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
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios3->dia3_op2}} <br>
                                                                                                De {{$horarios3->hora_inicio_op2}}:{{$horarios3->minutos_inicio_op2}} a {{$horarios3->hora_fin_op2}}:{{$horarios3->minutos_fin_op2}}
                                                                                            </span>
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
                                                                                            </div>
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios3->dia3_op3}} <br>
                                                                                                    De {{$horarios3->hora_inicio_op3}}:{{$horarios3->minutos_inicio_op3}} a {{$horarios3->hora_fin_op3}}:{{$horarios3->minutos_fin_op3}}
                                                                                                </span>
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
                                                    </div>
                                                    <div class="col-3" id="fondo_solicitud">
                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                        </span>
                                                    </div>
                                                    <div class="col-3" id="fondo_solicitud">
                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                        </span>
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
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                        De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                    </span>
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
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                        </span>
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
                                                        </div>
                                                        <div class="col-3" id="fondo_solicitud">
                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                            </span>
                                                        </div>
                                                        <div class="col-3" id="fondo_solicitud">
                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                            </span>
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
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                        </span>
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
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                            </span>
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
                                                            </div>
                                                            <div class="col-3" id="fondo_solicitud">
                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                    De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                </span>
                                                            </div>
                                                            <!-- Creo el segundo contenedor><-->
                                                            <div class="container">
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                        </span>
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
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                            </span>
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
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                </span>
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
                                                                </div>
                                                                <!-- Creo el segundo contenedor><-->
                                                                <div class="container">
                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                            </span>
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
                                                                            </div>
                                                                            <!-- Creo el segundo contenedor><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                        </span>
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
                                                                                </div>
                                                                                <!-- Creo el segundo contenedor><-->
                                                                                <div class="container">
                                                                                    <br>
                                                                                    <div class="row">
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                            </span>
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
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                    De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                </span>
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
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                            </span>
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
                                                                                            </div>
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                </span>
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
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-3" id="fondo_solicitud">
                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                            </span>
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
                                                                                    </div>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                        </span>
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
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                            </span>
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
                                                                            </div>
                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                    De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                </span>
                                                                            </div>
                                                                            <!-- Creo el tercer contenedor><-->
                                                                            <div class="container">
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                            De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                        </span>
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
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                            </span>
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
                                                                                            </div>
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                </span>
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
                                                                                </div>
                                                                                <!-- Creo el tercer contenedor><-->
                                                                                <div class="container">
                                                                                    <br>
                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                            </span>
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
                                                                                            </div>
                                                                                            <!-- Creo el tercer contenedor><-->
                                                                                            <div class="container">
                                                                                                <br>
                                                                                                <div class="row">
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                        </span>
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
                                                                                                </div>
                                                                                                <!--Creo el tercer contenedor><-->
                                                                                                <div class="container">
                                                                                                    <br>
                                                                                                    <div class="row">
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                            </span>
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
                                                                                            </div>
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                    De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                </span>
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
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                            </span>
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
                                                                                                            </div>
                                                                                                            <div class="col-3" id="fondo_solicitud">
                                                                                                                <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                    De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                                </span>
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
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                            </span>
                                                                                        </div>
                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                            </span>
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
                                                                                                    </div>
                                                                                                    <div class="col-3" id="fondo_solicitud">
                                                                                                        <span class="tit_datos_op2">{{$horarios4->dia4_op2}} <br>
                                                                                                            De {{$horarios4->hora_inicio_op2}}:{{$horarios4->minutos_inicio_op2}} a {{$horarios4->hora_fin_op2}}:{{$horarios4->minutos_fin_op2}}
                                                                                                        </span>
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
                                                                                                        </div>
                                                                                                        <div class="col-3" id="fondo_solicitud">
                                                                                                            <span class="tit_datos_op2">{{$horarios4->dia4_op3}} <br>
                                                                                                                De {{$horarios4->hora_inicio_op3}}:{{$horarios4->minutos_inicio_op3}} a {{$horarios4->hora_fin_op3}}:{{$horarios4->minutos_fin_op3}}
                                                                                                            </span>
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
                                                    </div>
                                                    <div class="col-3" id="fondo_solicitud">
                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                            De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                        </span>
                                                    </div>
                                                    <div class="col-3" id="fondo_solicitud">
                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                            De {{$horarios5->hora_inicio_op3}}:{{$horarios5->minutos_inicio_op3}} a {{$horarios5->hora_fin_op3}}:{{$horarios5->minutos_fin_op3}}
                                                        </span>
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
                                                                </div>
                                                                <div class="col-3" id="fondo_solicitud">
                                                                    <span class="tit_datos_op2">{{$horarios5->dia5_op2}} <br>
                                                                        De {{$horarios5->hora_inicio_op2}}:{{$horarios5->minutos_inicio_op2}} a {{$horarios5->hora_fin_op2}}:{{$horarios5->minutos_fin_op2}}
                                                                    </span>
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
                                                                    </div>
                                                                    <div class="col-3" id="fondo_solicitud">
                                                                        <span class="tit_datos_op2">{{$horarios5->dia5_op3}} <br>
                                                                            De {{$horarios->hora_inicio_op3}}:{{$horarios->minutos_inicio_op3}} a {{$horarios->hora_fin_op3}}:{{$horarios->minutos_fin_op3}}
                                                                        </span>
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
                                                    
                                                @else
                                                    @if ($cont==2)
                                                        
                                                    @else
                                                        @if ($cont==3)
                                                            
                                                        @else
                                                            @if ($cont==4)
                                                                
                                                            @else
                                                                @if ($cont==5)
                                                                    
                                                                @else
                                                                    @if ($cont==6)
                                                                        
                                                                    @else
                                                                        @if ($cont==7)
                                                                            
                                                                        @else
                                                                            @if ($cont==8)
                                                                                
                                                                            @else
                                                                                @if ($cont==9)
                                                                                    
                                                                                @else
                                                                                    @if ($cont==10)
                                                                                        
                                                                                    @else
                                                                                        @if ($cont==11)
                                                                                            
                                                                                        @else
                                                                                            @if ($cont==12)
                                                                                                
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
                            <br>
                        </div>
        
                        <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                            <span class="tit_datos">Motivo de tutoría</span>
                        </div>
                        <div class="container" id="contenedor_general_op2">
                            <br>
                            <h6>
                                <span class="negrita"> ¡Motivo!</span>
                            </h6>
                            <br>
                        </div>
                    </form>
                @else
                    {!! Alert::render() !!}
                @endif
            </div>        
        </div>
    </div>
@endsection