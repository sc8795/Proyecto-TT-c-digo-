@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <form method="POST" action="{{url("asignar_horario_docente/{$user->id}")}}">
                        {{csrf_field()}}
                        <button type="submit" title="Regresar a asignar horario de tutoría" class="btn btn-primary"><span class="fas fa-arrow-circle-left"></span></button>
                        <span class="negrita">Horario de tutoría asignado</span>
                    </form>
                </h1>
                <hr>
                <!--Para presentar mensajes-->
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                @if ($horarios!=null || $horario2s!=null || $horario3s!=null || $horario4s!=null || $horario5s!=null)
                    <h4 id="txt_opcion_menu_vertical">
                        <span class="negrita">Docente: </span><span>{{$user->name}} {{$user->lastname}}</span>
                    </h4>
                    <div class="row" id="txt_opcion_menu_vertical">
                        <div class="container" id="contenedor_general">
                            <table class="table">
                                <thead class="thead">
                                    <tr>
                                        <th rowspan="3" style="text-align: center">DÍA</th>
                                        <th colspan="3" style="text-align: center">SECCIÓN</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="text-align: center">MAÑANA</th>
                                        <th colspan="1" style="text-align: center">TARDE</th>
                                    </tr>
                                    <tr>
                                        <th class="tit_datos_op2" style="text-align: center">Horario 1</th>
                                        <th class="tit_datos_op2" style="text-align: center">Horario 2</th>
                                        <th class="tit_datos_op2" style="text-align: center">Horario 1</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($horarios==null)
                                        <tr>
                                            <th class="tit_datos_op2" style="text-align: center">Lunes</th>
                                            <th>
                                                <h6 class="tit_general" style="text-align: center">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST" style="text-align: center">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la mañana" name="dia" value="Lunes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                            <th style="text-align: center">
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                            </th>
                                            <th>
                                                <h6 class="tit_general" style="text-align: center">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST" style="text-align: center">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la tarde" name="tarde" value="Lunes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                        </tr>
                                    @else
                                        @if ($horarios->cont_dia==0 && $horarios->cont_tarde==1)
                                            <tr>
                                                <th class="tit_datos_op2" style="text-align: center">Lunes</th>
                                                <th>
                                                    <h6 class="tit_general" style="text-align: center">Ningún horario asignado</h6>
                                                    <form action="{{url("asignar_horario/{$user->id}")}}" method="POST" style="text-align: center">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la mañana" name="dia" value="Lunes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                    </form>
                                                </th>
                                                <th style="text-align: center">
                                                    <h6 class="tit_general">Ningún horario asignado</h6>
                                                </th>
                                                <th>
                                                    <h6 style="text-align: center">
                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horarios->hora_inicio_op3}}:{{$horarios->minutos_inicio_op3}} | </span>
                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horarios->hora_fin_op3}}:{{$horarios->minutos_fin_op3}}</span>
                                                    </h6>
                                                    <h6 style="text-align: center">
                                                        @php
                                                            $hora_inicio=$horarios->hora_inicio_op3;
                                                            $hora_fin=$horarios->hora_fin_op3;
                                                            $minutos_inicio=$horarios->minutos_inicio_op3;
                                                            $minutos_fin=$horarios->minutos_fin_op3;
                                                            if($hora_inicio == $hora_fin){
                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                $rango_minutos=$rango_minutos." minutos";
                                                            }
                                                            if($hora_inicio < $hora_fin){
                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                if($rango_hora == 1){
                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                                if($rango_hora > 1){
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <span class="negrita">Duración:</span>
                                                        <span class="tit_datos_op2">
                                                            @if ($hora_inicio == $hora_fin)
                                                                {{$rango_minutos}}
                                                            @endif
                                                            @if ($hora_inicio<$hora_fin)
                                                                {{$duracion}}
                                                            @endif
                                                        </span>
                                                    </h6>
                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}" style="text-align: center">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        @php
                                                            $aux=3;
                                                        @endphp
                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op1/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                    </form>
                                                </th>
                                            </tr>
                                        @else
                                            @if ($horarios->cont_dia==1 && $horarios->cont_tarde==0)
                                                <tr>
                                                    <th class="tit_datos_op2" style="text-align: center">Lunes</th>
                                                    <th>
                                                        <h6 style="text-align: center">
                                                            <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horarios->hora_inicio_op1}}:{{$horarios->minutos_inicio_op1}} | </span>
                                                            <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horarios->hora_fin_op1}}:{{$horarios->minutos_fin_op1}}</span>
                                                        </h6>
                                                        <h6 style="text-align: center">
                                                            @php
                                                                $hora_inicio=$horarios->hora_inicio_op1;
                                                                $hora_fin=$horarios->hora_fin_op1;
                                                                $minutos_inicio=$horarios->minutos_inicio_op1;
                                                                $minutos_fin=$horarios->minutos_fin_op1;
                                                                if($hora_inicio == $hora_fin){
                                                                    $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                    $rango_minutos=$rango_minutos." minutos";
                                                                }
                                                                if($hora_inicio < $hora_fin){
                                                                    $rango_hora=$hora_fin-$hora_inicio;
                                                                    if($rango_hora == 1){
                                                                        //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                    if($rango_hora > 1){
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <span class="negrita">Duración:</span>
                                                            <span class="tit_datos_op2">
                                                                @if ($hora_inicio == $hora_fin)
                                                                    {{$rango_minutos}}
                                                                @endif
                                                                @if ($hora_inicio<$hora_fin)
                                                                    {{$duracion}}
                                                                @endif
                                                            </span>
                                                        </h6>
                                                        <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}" style="text-align: center">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            @php
                                                                $aux=1;
                                                            @endphp
                                                            <a href="{{url("vista_editar_horario_tutoria_asignada_op1/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general" style="text-align: center">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST" style="text-align: center">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la mañana" name="dia" value="Lunes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general" style="text-align: center">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST" style="text-align: center">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la tarde" name="tarde" value="Lunes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                </tr>
                                            @else
                                                @if ($horarios->cont_dia==2 && $horarios->cont_tarde==0)
                                                    <tr>
                                                        <th class="tit_datos_op2" style="text-align: center">Lunes</th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horarios->hora_inicio_op1}}:{{$horarios->minutos_inicio_op1}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horarios->hora_fin_op1}}:{{$horarios->minutos_fin_op1}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horarios->hora_inicio_op1;
                                                                    $hora_fin=$horarios->hora_fin_op1;
                                                                    $minutos_inicio=$horarios->minutos_inicio_op1;
                                                                    $minutos_fin=$horarios->minutos_fin_op1;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}" style="text-align: center">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=1;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op1/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia1" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horarios->hora_inicio_op2}}:{{$horarios->minutos_inicio_op2}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horarios->hora_fin_op2}}:{{$horarios->minutos_fin_op2}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horarios->hora_inicio_op2;
                                                                    $hora_fin=$horarios->hora_fin_op2;
                                                                    $minutos_inicio=$horarios->minutos_inicio_op2;
                                                                    $minutos_fin=$horarios->minutos_fin_op2;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}" style="text-align: center"> 
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=2;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op1/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia1" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 class="tit_general" style="text-align: center">Ningún horario asignado</h6>
                                                            <form action="{{url("asignar_horario/{$user->id}")}}" method="POST" style="text-align: center">
                                                                {{ csrf_field() }}
                                                                <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la tarde" name="tarde" value="Lunes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                            </form>
                                                        </th>
                                                    </tr>
                                                @else
                                                    @if ($horarios->cont_dia==1 && $horarios->cont_tarde==1)
                                                    <tr>
                                                        <th class="tit_datos_op2" style="text-align: center">Lunes</th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horarios->hora_inicio_op1}}:{{$horarios->minutos_inicio_op1}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horarios->hora_fin_op1}}:{{$horarios->minutos_fin_op1}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horarios->hora_inicio_op1;
                                                                        $hora_fin=$horarios->hora_fin_op1;
                                                                        $minutos_inicio=$horarios->minutos_inicio_op1;
                                                                        $minutos_fin=$horarios->minutos_fin_op1;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}" style="text-align: center">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=1;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op1/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia1" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 class="tit_general" style="text-align: center">Ningún horario asignado</h6>
                                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST" style="text-align: center">
                                                                    {{ csrf_field() }}
                                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la mañana" name="dia" value="Lunes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horarios->hora_inicio_op3}}:{{$horarios->minutos_inicio_op3}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horarios->hora_fin_op3}}:{{$horarios->minutos_fin_op3}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horarios->hora_inicio_op3;
                                                                        $hora_fin=$horarios->hora_fin_op3;
                                                                        $minutos_inicio=$horarios->minutos_inicio_op3;
                                                                        $minutos_fin=$horarios->minutos_fin_op3;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}" style="text-align: center">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=3;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op1/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia1" value="3">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                        </tr>
                                                    @else
                                                        @if ($horarios->cont_dia==2 && $horarios->cont_tarde==1)
                                                            <tr>
                                                                <th class="tit_datos_op2" style="text-align: center">Lunes</th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horarios->hora_inicio_op1}}:{{$horarios->minutos_inicio_op1}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horarios->hora_fin_op1}}:{{$horarios->minutos_fin_op1}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horarios->hora_inicio_op1;
                                                                            $hora_fin=$horarios->hora_fin_op1;
                                                                            $minutos_inicio=$horarios->minutos_inicio_op1;
                                                                            $minutos_fin=$horarios->minutos_fin_op1;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}" style="text-align: center">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=1;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op1/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia1" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horarios->hora_inicio_op2}}:{{$horarios->minutos_inicio_op2}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horarios->hora_fin_op2}}:{{$horarios->minutos_fin_op2}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horarios->hora_inicio_op2;
                                                                            $hora_fin=$horarios->hora_fin_op2;
                                                                            $minutos_inicio=$horarios->minutos_inicio_op2;
                                                                            $minutos_fin=$horarios->minutos_fin_op2;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}" style="text-align: center">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=2;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op1/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia1" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horarios->hora_inicio_op3}}:{{$horarios->minutos_inicio_op3}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horarios->hora_fin_op3}}:{{$horarios->minutos_fin_op3}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horarios->hora_inicio_op3;
                                                                            $hora_fin=$horarios->hora_fin_op3;
                                                                            $minutos_inicio=$horarios->minutos_inicio_op3;
                                                                            $minutos_fin=$horarios->minutos_fin_op3;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}" style="text-align: center">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=3;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op1/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia1" value="3">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                    
                                    @if ($horario2s==null)
                                        <tr>
                                            <th class="tit_datos_op2" style="text-align: center">Martes</th>
                                            <th>
                                                <h6 class="tit_general" style="text-align: center">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST" style="text-align: center">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Martes en la mañana" name="dia" value="Martes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                            <th style="text-align: center">
                                                <h6 class="tit_general">Ningún horario asignado</h6>           
                                            </th>
                                            <th style="text-align: center">
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Martes en la tarde" name="tarde" value="Martes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                        </tr>
                                    @else
                                        @if ($horario2s->cont_dia==0 && $horario2s->cont_tarde==1)
                                            <tr>
                                                <th class="tit_datos_op2" style="text-align: center">Martes</th>
                                                <th style="text-align: center">
                                                    <h6 class="tit_general">Ningún horario asignado</h6>
                                                    <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Martes en la mañana" name="dia" value="Martes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                    </form>
                                                </th>
                                                <th style="text-align: center">
                                                    <h6 class="tit_general">Ningún horario asignado</h6>
                                                </th>
                                                <th style="text-align: center">
                                                    <h6 style="text-align: center">
                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario2s->hora_inicio_op3}}:{{$horario2s->minutos_inicio_op3}} | </span>
                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario2s->hora_fin_op3}}:{{$horario2s->minutos_fin_op3}}</span>
                                                    </h6>
                                                    <h6 style="text-align: center">
                                                        @php
                                                            $hora_inicio=$horario2s->hora_inicio_op3;
                                                            $hora_fin=$horario2s->hora_fin_op3;
                                                            $minutos_inicio=$horario2s->minutos_inicio_op3;
                                                            $minutos_fin=$horario2s->minutos_fin_op3;
                                                            if($hora_inicio == $hora_fin){
                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                $rango_minutos=$rango_minutos." minutos";
                                                            }
                                                            if($hora_inicio < $hora_fin){
                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                if($rango_hora == 1){
                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                                if($rango_hora > 1){
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <span class="negrita">Duración:</span>
                                                        <span class="tit_datos_op2">
                                                            @if ($hora_inicio == $hora_fin)
                                                                {{$rango_minutos}}
                                                            @endif
                                                            @if ($hora_inicio<$hora_fin)
                                                                {{$duracion}}
                                                            @endif
                                                        </span>
                                                    </h6>
                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op2/{$user->id}")}}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        @php
                                                            $aux=3;
                                                        @endphp
                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op2/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                    </form>
                                                </th>
                                            </tr>
                                        @else
                                            @if ($horario2s->cont_dia==1 && $horario2s->cont_tarde==0)
                                                <tr style="text-align: center">
                                                    <th class="tit_datos_op2">Martes</th>
                                                    <th>
                                                        <h6 style="text-align: center">
                                                            <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario2s->hora_inicio_op1}}:{{$horario2s->minutos_inicio_op1}} | </span>
                                                            <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario2s->hora_fin_op1}}:{{$horario2s->minutos_fin_op1}}</span>
                                                        </h6>
                                                        <h6 style="text-align: center">
                                                            @php
                                                                $hora_inicio=$horario2s->hora_inicio_op1;
                                                                $hora_fin=$horario2s->hora_fin_op1;
                                                                $minutos_inicio=$horario2s->minutos_inicio_op1;
                                                                $minutos_fin=$horario2s->minutos_fin_op1;
                                                                if($hora_inicio == $hora_fin){
                                                                    $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                    $rango_minutos=$rango_minutos." minutos";
                                                                }
                                                                if($hora_inicio < $hora_fin){
                                                                    $rango_hora=$hora_fin-$hora_inicio;
                                                                    if($rango_hora == 1){
                                                                        //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                    if($rango_hora > 1){
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <span class="negrita">Duración:</span>
                                                            <span class="tit_datos_op2">
                                                                @if ($hora_inicio == $hora_fin)
                                                                    {{$rango_minutos}}
                                                                @endif
                                                                @if ($hora_inicio<$hora_fin)
                                                                    {{$duracion}}
                                                                @endif
                                                            </span>
                                                        </h6>
                                                        <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op2/{$user->id}")}}">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            @php
                                                                $aux=1;
                                                            @endphp
                                                            <a href="{{url("vista_editar_horario_tutoria_asignada_op2/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Martes en la mañana" name="dia" value="Martes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Martes en la tarde" name="tarde" value="Martes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                </tr>
                                            @else
                                                @if ($horario2s->cont_dia==2 && $horario2s->cont_tarde==0)
                                                    <tr style="text-align: center">
                                                        <th class="tit_datos_op2">Martes</th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario2s->hora_inicio_op1}}:{{$horario2s->minutos_inicio_op1}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario2s->hora_fin_op1}}:{{$horario2s->minutos_fin_op1}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horario2s->hora_inicio_op1;
                                                                    $hora_fin=$horario2s->hora_fin_op1;
                                                                    $minutos_inicio=$horario2s->minutos_inicio_op1;
                                                                    $minutos_fin=$horario2s->minutos_fin_op1;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op2/{$user->id}")}}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=1;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op2/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario2s->hora_inicio_op2}}:{{$horario2s->minutos_inicio_op2}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario2s->hora_fin_op2}}:{{$horario2s->minutos_fin_op2}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horario2s->hora_inicio_op2;
                                                                    $hora_fin=$horario2s->hora_fin_op2;
                                                                    $minutos_inicio=$horario2s->minutos_inicio_op2;
                                                                    $minutos_fin=$horario2s->minutos_fin_op2;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op2/{$user->id}")}}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=2;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op2/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 class="tit_general">Ningún horario asignado</h6>
                                                            <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Martes en la tarde" name="tarde" value="Martes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                            </form>
                                                        </th>
                                                    </tr>
                                                @else
                                                    @if ($horario2s->cont_dia==1 && $horario2s->cont_tarde==1)
                                                    <tr style="text-align: center">
                                                        <th class="tit_datos_op2">Martes</th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario2s->hora_inicio_op1}}:{{$horario2s->minutos_inicio_op1}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario2s->hora_fin_op1}}:{{$horario2s->minutos_fin_op1}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horario2s->hora_inicio_op1;
                                                                        $hora_fin=$horario2s->hora_fin_op1;
                                                                        $minutos_inicio=$horario2s->minutos_inicio_op1;
                                                                        $minutos_fin=$horario2s->minutos_fin_op1;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op2/{$user->id}")}}">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=1;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op2/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Martes en la mañana" name="dia" value="Martes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario2s->hora_inicio_op3}}:{{$horario2s->minutos_inicio_op3}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario2s->hora_fin_op3}}:{{$horario2s->minutos_fin_op3}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horario2s->hora_inicio_op3;
                                                                        $hora_fin=$horario2s->hora_fin_op3;
                                                                        $minutos_inicio=$horario2s->minutos_inicio_op3;
                                                                        $minutos_fin=$horario2s->minutos_fin_op3;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op2/{$user->id}")}}">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=3;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op2/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="3">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                        </tr>
                                                    @else
                                                        @if ($horario2s->cont_dia==2 && $horario2s->cont_tarde==1)
                                                            <tr style="text-align: center">
                                                                <th class="tit_datos_op2">Martes</th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario2s->hora_inicio_op1}}:{{$horario2s->minutos_inicio_op1}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario2s->hora_fin_op1}}:{{$horario2s->minutos_fin_op1}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario2s->hora_inicio_op1;
                                                                            $hora_fin=$horario2s->hora_fin_op1;
                                                                            $minutos_inicio=$horario2s->minutos_inicio_op1;
                                                                            $minutos_fin=$horario2s->minutos_fin_op1;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op2/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=1;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op2/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario2s->hora_inicio_op2}}:{{$horario2s->minutos_inicio_op2}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario2s->hora_fin_op2}}:{{$horario2s->minutos_fin_op2}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario2s->hora_inicio_op2;
                                                                            $hora_fin=$horario2s->hora_fin_op2;
                                                                            $minutos_inicio=$horario2s->minutos_inicio_op2;
                                                                            $minutos_fin=$horario2s->minutos_fin_op2;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op2/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=2;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op2/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario2s->hora_inicio_op3}}:{{$horario2s->minutos_inicio_op3}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario2s->hora_fin_op3}}:{{$horario2s->minutos_fin_op3}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario2s->hora_inicio_op3;
                                                                            $hora_fin=$horario2s->hora_fin_op3;
                                                                            $minutos_inicio=$horario2s->minutos_inicio_op3;
                                                                            $minutos_fin=$horario2s->minutos_fin_op3;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op2/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=3;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op2/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="3">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
        
                                    @if ($horario3s==null)
                                        <tr style="text-align: center">
                                            <th class="tit_datos_op2">Miércoles</th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Miércoles en la mañana" name="dia" value="Miércoles en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                            </th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Miércoles en la tarde" name="tarde" value="Miércoles en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                        </tr>
                                    @else
                                        @if ($horario3s->cont_dia==0 && $horario3s->cont_tarde==1)
                                            <tr style="text-align: center">
                                                <th class="tit_datos_op2">Miércoles</th>
                                                <th>
                                                    <h6 class="tit_general">Ningún horario asignado</h6>
                                                    <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Miércoles en la mañana" name="dia" value="Miércoles en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                    </form>
                                                </th>
                                                <th>
                                                    <h6 class="tit_general">Ningún horario asignado</h6>                                
                                                </th>
                                                <th>
                                                    <h6 style="text-align: center">
                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario3s->hora_inicio_op3}}:{{$horario3s->minutos_inicio_op3}} | </span>
                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario3s->hora_fin_op3}}:{{$horario3s->minutos_fin_op3}}</span>
                                                    </h6>
                                                    <h6 style="text-align: center">
                                                        @php
                                                            $hora_inicio=$horario3s->hora_inicio_op3;
                                                            $hora_fin=$horario3s->hora_fin_op3;
                                                            $minutos_inicio=$horario3s->minutos_inicio_op3;
                                                            $minutos_fin=$horario3s->minutos_fin_op3;
                                                            if($hora_inicio == $hora_fin){
                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                $rango_minutos=$rango_minutos." minutos";
                                                            }
                                                            if($hora_inicio < $hora_fin){
                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                if($rango_hora == 1){
                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                                if($rango_hora > 1){
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <span class="negrita">Duración:</span>
                                                        <span class="tit_datos_op2">
                                                            @if ($hora_inicio == $hora_fin)
                                                                {{$rango_minutos}}
                                                            @endif
                                                            @if ($hora_inicio<$hora_fin)
                                                                {{$duracion}}
                                                            @endif
                                                        </span>
                                                    </h6>
                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op3/{$user->id}")}}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        @php
                                                            $aux=3;
                                                        @endphp
                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op3/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                    </form>
                                                </th>
                                            </tr>
                                        @else
                                            @if ($horario3s->cont_dia==1 && $horario3s->cont_tarde==0)
                                                <tr style="text-align: center">
                                                    <th class="tit_datos_op2">Miércoles</th>
                                                    <th>
                                                        <h6 style="text-align: center">
                                                            <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario3s->hora_inicio_op1}}:{{$horario3s->minutos_inicio_op1}} | </span>
                                                            <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario3s->hora_fin_op1}}:{{$horario3s->minutos_fin_op1}}</span>
                                                        </h6>
                                                        <h6 style="text-align: center">
                                                            @php
                                                                $hora_inicio=$horario3s->hora_inicio_op1;
                                                                $hora_fin=$horario3s->hora_fin_op1;
                                                                $minutos_inicio=$horario3s->minutos_inicio_op1;
                                                                $minutos_fin=$horario3s->minutos_fin_op1;
                                                                if($hora_inicio == $hora_fin){
                                                                    $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                    $rango_minutos=$rango_minutos." minutos";
                                                                }
                                                                if($hora_inicio < $hora_fin){
                                                                    $rango_hora=$hora_fin-$hora_inicio;
                                                                    if($rango_hora == 1){
                                                                        //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                    if($rango_hora > 1){
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <span class="negrita">Duración:</span>
                                                            <span class="tit_datos_op2">
                                                                @if ($hora_inicio == $hora_fin)
                                                                    {{$rango_minutos}}
                                                                @endif
                                                                @if ($hora_inicio<$hora_fin)
                                                                    {{$duracion}}
                                                                @endif
                                                            </span>
                                                        </h6>
                                                        <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op3/{$user->id}")}}">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            @php
                                                                $aux=1;
                                                            @endphp
                                                            <a href="{{url("vista_editar_horario_tutoria_asignada_op3/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Miércoles en la mañana" name="dia" value="Miércoles en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Miércoles en la tarde" name="tarde" value="Miércoles en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                </tr>
                                            @else
                                                @if ($horario3s->cont_dia==2 && $horario3s->cont_tarde==0)
                                                    <tr style="text-align: center">
                                                        <th class="tit_datos_op2">Miércoles</th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario3s->hora_inicio_op1}}:{{$horario3s->minutos_inicio_op1}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario3s->hora_fin_op1}}:{{$horario3s->minutos_fin_op1}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horario3s->hora_inicio_op1;
                                                                    $hora_fin=$horario3s->hora_fin_op1;
                                                                    $minutos_inicio=$horario3s->minutos_inicio_op1;
                                                                    $minutos_fin=$horario3s->minutos_fin_op1;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op3/{$user->id}")}}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=1;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op3/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario3s->hora_inicio_op2}}:{{$horario3s->minutos_inicio_op2}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario3s->hora_fin_op2}}:{{$horario3s->minutos_fin_op2}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horario3s->hora_inicio_op2;
                                                                    $hora_fin=$horario3s->hora_fin_op2;
                                                                    $minutos_inicio=$horario3s->minutos_inicio_op2;
                                                                    $minutos_fin=$horario3s->minutos_fin_op2;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op3/{$user->id}")}}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=2;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op3/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 class="tit_general">Ningún horario asignado</h6>
                                                            <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Miércoles en la tarde" name="tarde" value="Miércoles en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                            </form>
                                                        </th>
                                                    </tr>
                                                @else
                                                    @if ($horario3s->cont_dia==1 && $horario3s->cont_tarde==1)
                                                    <tr style="text-align: center">
                                                        <th class="tit_datos_op2">Miércoles</th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario3s->hora_inicio_op1}}:{{$horario3s->minutos_inicio_op1}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario3s->hora_fin_op1}}:{{$horario3s->minutos_fin_op1}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horario3s->hora_inicio_op1;
                                                                        $hora_fin=$horario3s->hora_fin_op1;
                                                                        $minutos_inicio=$horario3s->minutos_inicio_op1;
                                                                        $minutos_fin=$horario3s->minutos_fin_op1;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op3/{$user->id}")}}">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=1;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op3/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Miércoles en la mañana" name="dia" value="Miércoles en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario3s->hora_inicio_op3}}:{{$horario3s->minutos_inicio_op3}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario3s->hora_fin_op3}}:{{$horario3s->minutos_fin_op3}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horario3s->hora_inicio_op3;
                                                                        $hora_fin=$horario3s->hora_fin_op3;
                                                                        $minutos_inicio=$horario3s->minutos_inicio_op3;
                                                                        $minutos_fin=$horario3s->minutos_fin_op3;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op3/{$user->id}")}}">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=3;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op3/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="3">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                        </tr>
                                                    @else
                                                        @if ($horario3s->cont_dia==2 && $horario3s->cont_tarde==1)
                                                            <tr style="text-align: center">
                                                                <th class="tit_datos_op2">Miércoles</th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario3s->hora_inicio_op1}}:{{$horario3s->minutos_inicio_op1}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario3s->hora_fin_op1}}:{{$horario3s->minutos_fin_op1}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario3s->hora_inicio_op1;
                                                                            $hora_fin=$horario3s->hora_fin_op1;
                                                                            $minutos_inicio=$horario3s->minutos_inicio_op1;
                                                                            $minutos_fin=$horario3s->minutos_fin_op1;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op3/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=1;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op3/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario3s->hora_inicio_op2}}:{{$horario3s->minutos_inicio_op2}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario3s->hora_fin_op2}}:{{$horario3s->minutos_fin_op2}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario3s->hora_inicio_op2;
                                                                            $hora_fin=$horario3s->hora_fin_op2;
                                                                            $minutos_inicio=$horario3s->minutos_inicio_op2;
                                                                            $minutos_fin=$horario3s->minutos_fin_op2;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op3/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=2;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op3/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario3s->hora_inicio_op3}}:{{$horario3s->minutos_inicio_op3}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario3s->hora_fin_op3}}:{{$horario3s->minutos_fin_op3}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario3s->hora_inicio_op3;
                                                                            $hora_fin=$horario3s->hora_fin_op3;
                                                                            $minutos_inicio=$horario3s->minutos_inicio_op3;
                                                                            $minutos_fin=$horario3s->minutos_fin_op3;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op3/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=3;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op3/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="3">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
        
                                    @if ($horario4s==null)
                                        <tr style="text-align: center">
                                            <th class="tit_datos_op2">Jueves</th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Jueves en la mañana" name="dia" value="Jueves en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                            </th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Jueves en la tarde" name="tarde" value="Jueves en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                        </tr>
                                    @else
                                        @if ($horario4s->cont_dia==0 && $horario4s->cont_tarde==1)
                                            <tr style="text-align: center">
                                                <th class="tit_datos_op2">Jueves</th>
                                                <th>
                                                    <h6 class="tit_general">Ningún horario asignado</h6>
                                                    <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Jueves en la mañana" name="dia" value="Jueves en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                    </form>
                                                </th>
                                                <th>
                                                    <h6 class="tit_general">Ningún horario asignado</h6>
                                                </th>
                                                <th>
                                                    <h6 style="text-align: center">
                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario4s->hora_inicio_op3}}:{{$horario4s->minutos_inicio_op3}} | </span>
                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario4s->hora_fin_op3}}:{{$horario4s->minutos_fin_op3}}</span>
                                                    </h6>
                                                    <h6 style="text-align: center">
                                                        @php
                                                            $hora_inicio=$horario4s->hora_inicio_op3;
                                                            $hora_fin=$horario4s->hora_fin_op3;
                                                            $minutos_inicio=$horario4s->minutos_inicio_op3;
                                                            $minutos_fin=$horario4s->minutos_fin_op3;
                                                            if($hora_inicio == $hora_fin){
                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                $rango_minutos=$rango_minutos." minutos";
                                                            }
                                                            if($hora_inicio < $hora_fin){
                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                if($rango_hora == 1){
                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                                if($rango_hora > 1){
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <span class="negrita">Duración:</span>
                                                        <span class="tit_datos_op2">
                                                            @if ($hora_inicio == $hora_fin)
                                                                {{$rango_minutos}}
                                                            @endif
                                                            @if ($hora_inicio<$hora_fin)
                                                                {{$duracion}}
                                                            @endif
                                                        </span>
                                                    </h6>
                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op4/{$user->id}")}}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        @php
                                                            $aux=3;
                                                        @endphp
                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op4/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                    </form>
                                                </th>
                                            </tr>
                                        @else
                                            @if ($horario4s->cont_dia==1 && $horario4s->cont_tarde==0)
                                                <tr style="text-align: center">
                                                    <th class="tit_datos_op2">Jueves</th>
                                                    <th>
                                                        <h6 style="text-align: center">
                                                            <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario4s->hora_inicio_op1}}:{{$horario4s->minutos_inicio_op1}} | </span>
                                                            <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario4s->hora_fin_op1}}:{{$horario4s->minutos_fin_op1}}</span>
                                                        </h6>
                                                        <h6 style="text-align: center">
                                                            @php
                                                                $hora_inicio=$horario4s->hora_inicio_op1;
                                                                $hora_fin=$horario4s->hora_fin_op1;
                                                                $minutos_inicio=$horario4s->minutos_inicio_op1;
                                                                $minutos_fin=$horario4s->minutos_fin_op1;
                                                                if($hora_inicio == $hora_fin){
                                                                    $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                    $rango_minutos=$rango_minutos." minutos";
                                                                }
                                                                if($hora_inicio < $hora_fin){
                                                                    $rango_hora=$hora_fin-$hora_inicio;
                                                                    if($rango_hora == 1){
                                                                        //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                    if($rango_hora > 1){
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <span class="negrita">Duración:</span>
                                                            <span class="tit_datos_op2">
                                                                @if ($hora_inicio == $hora_fin)
                                                                    {{$rango_minutos}}
                                                                @endif
                                                                @if ($hora_inicio<$hora_fin)
                                                                    {{$duracion}}
                                                                @endif
                                                            </span>
                                                        </h6>
                                                        <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op4/{$user->id}")}}">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            @php
                                                                $aux=1;
                                                            @endphp
                                                            <a href="{{url("vista_editar_horario_tutoria_asignada_op4/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Jueves en la mañana" name="dia" value="Jueves en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Jueves en la tarde" name="tarde" value="Jueves en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                </tr>
                                            @else
                                                @if ($horario4s->cont_dia==2 && $horario4s->cont_tarde==0)
                                                    <tr style="text-align: center">
                                                        <th class="tit_datos_op2">Jueves</th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario4s->hora_inicio_op1}}:{{$horario4s->minutos_inicio_op1}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario4s->hora_fin_op1}}:{{$horario4s->minutos_fin_op1}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horario4s->hora_inicio_op1;
                                                                    $hora_fin=$horario4s->hora_fin_op1;
                                                                    $minutos_inicio=$horario4s->minutos_inicio_op1;
                                                                    $minutos_fin=$horario4s->minutos_fin_op1;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op4/{$user->id}")}}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=1;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op4/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario4s->hora_inicio_op2}}:{{$horario4s->minutos_inicio_op2}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario4s->hora_fin_op2}}:{{$horario4s->minutos_fin_op2}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horario4s->hora_inicio_op2;
                                                                    $hora_fin=$horario4s->hora_fin_op2;
                                                                    $minutos_inicio=$horario4s->minutos_inicio_op2;
                                                                    $minutos_fin=$horario4s->minutos_fin_op2;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op4/{$user->id}")}}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=2;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op4/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 class="tit_general">Ningún horario asignado</h6>
                                                            <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Jueves en la tarde" name="tarde" value="Jueves en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                            </form>
                                                        </th>
                                                    </tr>
                                                @else
                                                    @if ($horario4s->cont_dia==1 && $horario4s->cont_tarde==1)
                                                    <tr style="text-align: center">
                                                        <th class="tit_datos_op2">Jueves</th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario4s->hora_inicio_op1}}:{{$horario4s->minutos_inicio_op1}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario4s->hora_fin_op1}}:{{$horario4s->minutos_fin_op1}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horario4s->hora_inicio_op1;
                                                                        $hora_fin=$horario4s->hora_fin_op1;
                                                                        $minutos_inicio=$horario4s->minutos_inicio_op1;
                                                                        $minutos_fin=$horario4s->minutos_fin_op1;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op4/{$user->id}")}}">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=1;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op4/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Jueves en la mañana" name="dia" value="Jueves en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario4s->hora_inicio_op3}}:{{$horario4s->minutos_inicio_op3}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario4s->hora_fin_op3}}:{{$horario4s->minutos_fin_op3}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horario4s->hora_inicio_op3;
                                                                        $hora_fin=$horario4s->hora_fin_op3;
                                                                        $minutos_inicio=$horario4s->minutos_inicio_op3;
                                                                        $minutos_fin=$horario4s->minutos_fin_op3;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op4/{$user->id}")}}">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=3;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op4/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="3">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                        </tr>
                                                    @else
                                                        @if ($horario4s->cont_dia==2 && $horario4s->cont_tarde==1)
                                                            <tr style="text-align: center">
                                                                <th class="tit_datos_op2">Jueves</th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario4s->hora_inicio_op1}}:{{$horario4s->minutos_inicio_op1}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario4s->hora_fin_op1}}:{{$horario4s->minutos_fin_op1}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario4s->hora_inicio_op1;
                                                                            $hora_fin=$horario4s->hora_fin_op1;
                                                                            $minutos_inicio=$horario4s->minutos_inicio_op1;
                                                                            $minutos_fin=$horario4s->minutos_fin_op1;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op4/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=1;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op4/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario4s->hora_inicio_op2}}:{{$horario4s->minutos_inicio_op2}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario4s->hora_fin_op2}}:{{$horario4s->minutos_fin_op2}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario4s->hora_inicio_op2;
                                                                            $hora_fin=$horario4s->hora_fin_op2;
                                                                            $minutos_inicio=$horario4s->minutos_inicio_op2;
                                                                            $minutos_fin=$horario4s->minutos_fin_op2;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op4/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=2;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op4/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario4s->hora_inicio_op3}}:{{$horario4s->minutos_inicio_op3}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario4s->hora_fin_op3}}:{{$horario4s->minutos_fin_op3}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario4s->hora_inicio_op3;
                                                                            $hora_fin=$horario4s->hora_fin_op3;
                                                                            $minutos_inicio=$horario4s->minutos_inicio_op3;
                                                                            $minutos_fin=$horario4s->minutos_fin_op3;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op4/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=3;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op4/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
        
                                    @if ($horario5s==null)
                                        <tr style="text-align: center">
                                            <th class="tit_datos_op2">Viernes</th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Viernes en la mañana" name="dia" value="Viernes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                            </th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Viernes en la tarde" name="tarde" value="Viernes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                        </tr>
                                    @else
                                        @if ($horario5s->cont_dia==0 && $horario5s->cont_tarde==1)
                                            <tr style="text-align: center">
                                                <th class="tit_datos_op2">Viernes</th>
                                                <th>
                                                    <h6 class="tit_general">Ningún horario asignado</h6>
                                                    <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Viernes en la mañana" name="dia" value="Viernes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                    </form>
                                                </th>
                                                <th>
                                                    <h6 class="tit_general">Ningún horario asignado</h6>
                                                </th>
                                                <th>
                                                    <h6 style="text-align: center">
                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario5s->hora_inicio_op3}}:{{$horario5s->minutos_inicio_op3}} | </span>
                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario5s->hora_fin_op3}}:{{$horario5s->minutos_fin_op3}}</span>
                                                    </h6>
                                                    <h6 style="text-align: center">
                                                        @php
                                                            $hora_inicio=$horario5s->hora_inicio_op3;
                                                            $hora_fin=$horario5s->hora_fin_op3;
                                                            $minutos_inicio=$horario5s->minutos_inicio_op3;
                                                            $minutos_fin=$horario5s->minutos_fin_op3;
                                                            if($hora_inicio == $hora_fin){
                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                $rango_minutos=$rango_minutos." minutos";
                                                            }
                                                            if($hora_inicio < $hora_fin){
                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                if($rango_hora == 1){
                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                                if($rango_hora > 1){
                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                    if($rango_minutos<60){
                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                    }else{
                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <span class="negrita">Duración:</span>
                                                        <span class="tit_datos_op2">
                                                            @if ($hora_inicio == $hora_fin)
                                                                {{$rango_minutos}}
                                                            @endif
                                                            @if ($hora_inicio<$hora_fin)
                                                                {{$duracion}}
                                                            @endif
                                                        </span>
                                                    </h6>
                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op5/{$user->id}")}}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        @php
                                                            $aux=3;
                                                        @endphp
                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op5/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                    </form>
                                                </th>
                                            </tr>
                                        @else
                                            @if ($horario5s->cont_dia==1 && $horario5s->cont_tarde==0)
                                                <tr style="text-align: center">
                                                    <th class="tit_datos_op2">Viernes</th>
                                                    <th>
                                                        <h6 style="text-align: center">
                                                            <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario5s->hora_inicio_op1}}:{{$horario5s->minutos_inicio_op1}} | </span>
                                                            <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario5s->hora_fin_op1}}:{{$horario5s->minutos_fin_op1}}</span>
                                                        </h6>
                                                        <h6 style="text-align: center">
                                                            @php
                                                                $hora_inicio=$horario5s->hora_inicio_op1;
                                                                $hora_fin=$horario5s->hora_fin_op1;
                                                                $minutos_inicio=$horario5s->minutos_inicio_op1;
                                                                $minutos_fin=$horario5s->minutos_fin_op1;
                                                                if($hora_inicio == $hora_fin){
                                                                    $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                    $rango_minutos=$rango_minutos." minutos";
                                                                }
                                                                if($hora_inicio < $hora_fin){
                                                                    $rango_hora=$hora_fin-$hora_inicio;
                                                                    if($rango_hora == 1){
                                                                        //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                    if($rango_hora > 1){
                                                                        $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                        if($rango_minutos<60){
                                                                            $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                        }else{
                                                                            $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <span class="negrita">Duración:</span>
                                                            <span class="tit_datos_op2">
                                                                @if ($hora_inicio == $hora_fin)
                                                                    {{$rango_minutos}}
                                                                @endif
                                                                @if ($hora_inicio<$hora_fin)
                                                                    {{$duracion}}
                                                                @endif
                                                            </span>
                                                        </h6>
                                                        <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op5/{$user->id}")}}">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            @php
                                                                $aux=1;
                                                            @endphp
                                                            <a href="{{url("vista_editar_horario_tutoria_asignada_op5/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado">Eliminar <span class="oi oi-trash"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Viernes en la mañana" name="dia" value="Viernes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Viernes en la tarde" name="tarde" value="Viernes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                </tr>
                                            @else
                                                @if ($horario5s->cont_dia==2 && $horario5s->cont_tarde==0)
                                                    <tr style="text-align: center">
                                                        <th class="tit_datos_op2">Viernes</th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario5s->hora_inicio_op1}}:{{$horario5s->minutos_inicio_op1}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario5s->hora_fin_op1}}:{{$horario5s->minutos_fin_op1}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horario5s->hora_inicio_op1;
                                                                    $hora_fin=$horario5s->hora_fin_op1;
                                                                    $minutos_inicio=$horario5s->minutos_inicio_op1;
                                                                    $minutos_fin=$horario5s->minutos_fin_op1;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op5/{$user->id}")}}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=1;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op5/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 style="text-align: center">
                                                                <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario5s->hora_inicio_op2}}:{{$horario5s->minutos_inicio_op2}} | </span>
                                                                <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario5s->hora_fin_op2}}:{{$horario5s->minutos_fin_op2}}</span>
                                                            </h6>
                                                            <h6 style="text-align: center">
                                                                @php
                                                                    $hora_inicio=$horario5s->hora_inicio_op2;
                                                                    $hora_fin=$horario5s->hora_fin_op2;
                                                                    $minutos_inicio=$horario5s->minutos_inicio_op2;
                                                                    $minutos_fin=$horario5s->minutos_fin_op2;
                                                                    if($hora_inicio == $hora_fin){
                                                                        $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                        $rango_minutos=$rango_minutos." minutos";
                                                                    }
                                                                    if($hora_inicio < $hora_fin){
                                                                        $rango_hora=$hora_fin-$hora_inicio;
                                                                        if($rango_hora == 1){
                                                                            //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                        if($rango_hora > 1){
                                                                            $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                            if($rango_minutos<60){
                                                                                $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                            }else{
                                                                                $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="negrita">Duración:</span>
                                                                <span class="tit_datos_op2">
                                                                    @if ($hora_inicio == $hora_fin)
                                                                        {{$rango_minutos}}
                                                                    @endif
                                                                    @if ($hora_inicio<$hora_fin)
                                                                        {{$duracion}}
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op5/{$user->id}")}}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                @php
                                                                    $aux=2;
                                                                @endphp
                                                                <a href="{{url("vista_editar_horario_tutoria_asignada_op5/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                            </form>
                                                        </th>
                                                        <th>
                                                            <h6 class="tit_general">Ningún horario asignado</h6>
                                                            <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Viernes en la tarde" name="tarde" value="Viernes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                            </form>
                                                        </th>
                                                    </tr>
                                                @else
                                                    @if ($horario5s->cont_dia==1 && $horario5s->cont_tarde==1)
                                                    <tr style="text-align: center">
                                                        <th class="tit_datos_op2">Viernes</th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario5s->hora_inicio_op1}}:{{$horario5s->minutos_inicio_op1}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario5s->hora_fin_op1}}:{{$horario5s->minutos_fin_op1}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horario5s->hora_inicio_op1;
                                                                        $hora_fin=$horario5s->hora_fin_op1;
                                                                        $minutos_inicio=$horario5s->minutos_inicio_op1;
                                                                        $minutos_fin=$horario5s->minutos_fin_op1;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op5/{$user->id}")}}">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=1;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op5/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Viernes en la mañana" name="dia" value="Viernes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                                </form>
                                                            </th>
                                                            <th>
                                                                <h6 style="text-align: center">
                                                                    <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario5s->hora_inicio_op3}}:{{$horario5s->minutos_inicio_op3}} | </span>
                                                                    <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario5s->hora_fin_op3}}:{{$horario5s->minutos_fin_op3}}</span>
                                                                </h6>
                                                                <h6 style="text-align: center">
                                                                    @php
                                                                        $hora_inicio=$horario5s->hora_inicio_op3;
                                                                        $hora_fin=$horario5s->hora_fin_op3;
                                                                        $minutos_inicio=$horario5s->minutos_inicio_op3;
                                                                        $minutos_fin=$horario5s->minutos_fin_op3;
                                                                        if($hora_inicio == $hora_fin){
                                                                            $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                            $rango_minutos=$rango_minutos." minutos";
                                                                        }
                                                                        if($hora_inicio < $hora_fin){
                                                                            $rango_hora=$hora_fin-$hora_inicio;
                                                                            if($rango_hora == 1){
                                                                                //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                            if($rango_hora > 1){
                                                                                $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                if($rango_minutos<60){
                                                                                    $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                }else{
                                                                                    $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="negrita">Duración:</span>
                                                                    <span class="tit_datos_op2">
                                                                        @if ($hora_inicio == $hora_fin)
                                                                            {{$rango_minutos}}
                                                                        @endif
                                                                        @if ($hora_inicio<$hora_fin)
                                                                            {{$duracion}}
                                                                        @endif
                                                                    </span>
                                                                </h6>
                                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op5/{$user->id}")}}">
                                                                    {{csrf_field()}}
                                                                    {{method_field('DELETE')}}
                                                                    @php
                                                                        $aux=3;
                                                                    @endphp
                                                                    <a href="{{url("vista_editar_horario_tutoria_asignada_op5/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="3">Eliminar <span class="oi oi-trash"></span></button>
                                                                </form>
                                                            </th>
                                                        </tr>
                                                    @else
                                                        @if ($horario5s->cont_dia==2 && $horario5s->cont_tarde==1)
                                                            <tr style="text-align: center">
                                                                <th class="tit_datos_op2">Viernes</th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario5s->hora_inicio_op1}}:{{$horario5s->minutos_inicio_op1}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario5s->hora_fin_op1}}:{{$horario5s->minutos_fin_op1}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario5s->hora_inicio_op1;
                                                                            $hora_fin=$horario5s->hora_fin_op1;
                                                                            $minutos_inicio=$horario5s->minutos_inicio_op1;
                                                                            $minutos_fin=$horario5s->minutos_fin_op1;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op5/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=1;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op5/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="1">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario5s->hora_inicio_op2}}:{{$horario5s->minutos_inicio_op2}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario5s->hora_fin_op2}}:{{$horario5s->minutos_fin_op2}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario5s->hora_inicio_op2;
                                                                            $hora_fin=$horario5s->hora_fin_op2;
                                                                            $minutos_inicio=$horario5s->minutos_inicio_op2;
                                                                            $minutos_fin=$horario5s->minutos_fin_op2;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op5/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=2;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op5/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="2">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                                <th>
                                                                    <h6 style="text-align: center">
                                                                        <span class="negrita">Hora inicio: </span><span class="tit_datos_op2">{{$horario5s->hora_inicio_op3}}:{{$horario5s->minutos_inicio_op3}} | </span>
                                                                        <span class="negrita">Hora fin: </span><span class="tit_datos_op2">{{$horario5s->hora_fin_op3}}:{{$horario5s->minutos_fin_op3}}</span>
                                                                    </h6>
                                                                    <h6 style="text-align: center">
                                                                        @php
                                                                            $hora_inicio=$horario5s->hora_inicio_op3;
                                                                            $hora_fin=$horario5s->hora_fin_op3;
                                                                            $minutos_inicio=$horario5s->minutos_inicio_op3;
                                                                            $minutos_fin=$horario5s->minutos_fin_op3;
                                                                            if($hora_inicio == $hora_fin){
                                                                                $rango_minutos=$minutos_fin-$minutos_inicio;
                                                                                $rango_minutos=$rango_minutos." minutos";
                                                                            }
                                                                            if($hora_inicio < $hora_fin){
                                                                                $rango_hora=$hora_fin-$hora_inicio;
                                                                                if($rango_hora == 1){
                                                                                    //$duracion=$rango_hora." hora ".$rango_minutos." minutos";
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora, ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                                if($rango_hora > 1){
                                                                                    $rango_minutos=(60-$minutos_inicio)+$minutos_fin;
                                                                                    if($rango_minutos<60){
                                                                                        $duracion=($rango_hora-1)." hora(s), ".$rango_minutos." minutos";
                                                                                    }else{
                                                                                        $duracion=$rango_hora." hora(s), ".($rango_minutos-60)." minutos";
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <span class="negrita">Duración:</span>
                                                                        <span class="tit_datos_op2">
                                                                            @if ($hora_inicio == $hora_fin)
                                                                                {{$rango_minutos}}
                                                                            @endif
                                                                            @if ($hora_inicio<$hora_fin)
                                                                                {{$duracion}}
                                                                            @endif
                                                                        </span>
                                                                    </h6>
                                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op5/{$user->id}")}}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        @php
                                                                            $aux=3;
                                                                        @endphp
                                                                        <a href="{{url("vista_editar_horario_tutoria_asignada_op5/{$user->id}/{$aux}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Editar <span class="oi oi-pencil"></span></a>
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar horario de tutoría asignado" name="dia" value="3">Eliminar <span class="oi oi-trash"></span></button>
                                                                    </form>
                                                                </th>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <h6 id="txt_opcion_menu_vertical">El docente 
                        <span class="negrita">{{$user->name}} {{$user->lastname}}</span> 
                        aún no tiene horario de tutoría asignado.
                    </h6>
                    <br><br><br><br><hr>
                    <form method="POST" action="{{url("asignar_horario_docente/{$user->id}")}}">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-info btn-sm" title="Asignar horario de tutoría para el docente '{{$user->name}} {{$user->lastname}}'"><span class="fas fa-plus-circle"></span> Asignar</button>
                    </form>
                    <hr>
                @endif
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection