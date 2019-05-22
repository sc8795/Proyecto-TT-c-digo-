@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Horario de tutoría asignado</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_administrador.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="container" id="contenedor_general">
                {!! Alert::render() !!}
                @if ($horarios!=null || $horario2s!=null || $horario3s!=null || $horario4s!=null || $horario5s!=null)
                    <h6 class="tit_general">Docente: 
                        <span class="tit_datos"> {{$user->name}} {{$user->lastname}}</span>
                    </h6><hr>

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th rowspan="3" class="col-2">DÍA</th>
                                <th colspan="3">SECCIÓN</th>
                            </tr>
                            <tr>
                                <th colspan="2">MAÑANA</th>
                                <th colspan="1">TARDE</th>
                            </tr>
                            <tr>
                                <th class="tit_general">Horario 1</th>
                                <th class="tit_general">Horario 2</th>
                                <th class="tit_general">Horario 1</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($horarios==null)
                                <tr>
                                    <th class="tit_datos_op2">Lunes</th>
                                    <th>
                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                            {{ csrf_field() }}
                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la mañana" name="dia" value="Lunes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                        </form>
                                    </th>
                                    <th>
                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                    </th>
                                    <th>
                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                            {{ csrf_field() }}
                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la tarde" name="tarde" value="Lunes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                        </form>
                                    </th>
                                </tr>
                            @else
                                @if ($horarios->cont_dia==0 && $horarios->cont_tarde==1)
                                    <tr>
                                        <th class="tit_datos_op2">Lunes</th>
                                        <th>
                                            <h6 class="tit_general">Ningún horario asignado</h6>
                                            <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                {{ csrf_field() }}
                                                <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la mañana" name="dia" value="Lunes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                            </form>
                                        </th>
                                        <th>
                                            <h6 class="tit_general">Ningún horario asignado</h6>
                                        </th>
                                        <th>
                                            <h6 class="tit_datos">Hora inicio:
                                                <span class="tit_datos_op2">{{$horarios->hora_inicio_op3}} : {{$horarios->minutos_inicio_op3}}</span>
                                            </h6>
                                            <h6 class="tit_datos">Hora fin:
                                                <span class="tit_datos_op2">{{$horarios->hora_fin_op3}} : {{$horarios->minutos_fin_op3}}</span>
                                            </h6>
                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}">
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
                                            <th class="tit_datos_op2">Lunes</th>
                                            <th>
                                                <h6 class="tit_datos">Hora inicio:
                                                    <span class="tit_datos_op2">{{$horarios->hora_inicio_op1}} : {{$horarios->minutos_inicio_op1}}</span>
                                                </h6>
                                                <h6 class="tit_datos">Hora fin:
                                                    <span class="tit_datos_op2">{{$horarios->hora_fin_op1}} : {{$horarios->minutos_fin_op1}}</span>
                                                </h6>
                                                <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}">
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
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la mañana" name="dia" value="Lunes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                            <th>
                                                <h6 class="tit_general">Ningún horario asignado</h6>
                                                <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la tarde" name="tarde" value="Lunes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                </form>
                                            </th>
                                        </tr>
                                    @else
                                        @if ($horarios->cont_dia==2 && $horarios->cont_tarde==0)
                                            <tr>
                                                <th class="tit_datos_op2">Lunes</th>
                                                <th>
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horarios->hora_inicio_op1}} : {{$horarios->minutos_inicio_op1}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horarios->hora_fin_op1}} : {{$horarios->minutos_fin_op1}}</span>
                                                    </h6>
                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}">
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
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horarios->hora_inicio_op2}} : {{$horarios->minutos_inicio_op2}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horarios->hora_fin_op2}} : {{$horarios->minutos_fin_op2}}</span>
                                                    </h6>
                                                    <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}">
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
                                                    <h6 class="tit_general">Ningún horario asignado</h6>
                                                    <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la tarde" name="tarde" value="Lunes en la tarde" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                    </form>
                                                </th>
                                            </tr>
                                        @else
                                            @if ($horarios->cont_dia==1 && $horarios->cont_tarde==1)
                                            <tr>
                                                <th class="tit_datos_op2">Lunes</th>
                                                    <th>
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horarios->hora_inicio_op1}} : {{$horarios->minutos_inicio_op1}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horarios->hora_fin_op1}} : {{$horarios->minutos_fin_op1}}</span>
                                                        </h6>
                                                        <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}">
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
                                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Lunes en la mañana" name="dia" value="Lunes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horarios->hora_inicio_op3}} : {{$horarios->minutos_inicio_op3}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horarios->hora_fin_op3}} : {{$horarios->minutos_fin_op3}}</span>
                                                        </h6>
                                                        <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}">
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
                                                        <th class="tit_datos_op2">Lunes</th>
                                                        <th>
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horarios->hora_inicio_op1}} : {{$horarios->minutos_inicio_op1}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horarios->hora_fin_op1}} : {{$horarios->minutos_fin_op1}}</span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}">
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horarios->hora_inicio_op2}} : {{$horarios->minutos_inicio_op2}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horarios->hora_fin_op2}} : {{$horarios->minutos_fin_op2}}</span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}">
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horarios->hora_inicio_op3}} : {{$horarios->minutos_inicio_op3}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horarios->hora_fin_op3}} : {{$horarios->minutos_fin_op3}}</span>
                                                            </h6>
                                                            <form method="POST" action="{{url("eliminar_horario_tutoria_asignada_op1/{$user->id}")}}">
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
                                    <th class="tit_datos_op2">Martes</th>
                                    <th>
                                        <h6 class="tit_general">Ningún horario asignado</h6>
                                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                            {{ csrf_field() }}
                                            <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Martes en la mañana" name="dia" value="Martes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                        </form>
                                    </th>
                                    <th>
                                        <h6 class="tit_general">Ningún horario asignado</h6>           
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
                                @if ($horario2s->cont_dia==0 && $horario2s->cont_tarde==1)
                                    <tr>
                                        <th class="tit_datos_op2">Martes</th>
                                        <th>
                                            <h6 class="tit_general">Ningún horario asignado</h6>
                                            <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                                                {{ csrf_field() }}
                                                <button class="btn btn-info btn-sm" title="Asignar horario de tutoría para el día Martes en la mañana" name="dia" value="Martes en la mañana" type="submit">Asignar <span class="fas fa-plus-circle"></span></button>
                                            </form>
                                        </th>
                                        <th>
                                            <h6 class="tit_general">Ningún horario asignado</h6>
                                        </th>
                                        <th>
                                            <h6 class="tit_datos">Hora inicio:
                                                <span class="tit_datos_op2">{{$horario2s->hora_inicio_op3}} : {{$horario2s->minutos_inicio_op3}}</span>
                                            </h6>
                                            <h6 class="tit_datos">Hora fin:
                                                <span class="tit_datos_op2">{{$horario2s->hora_fin_op3}} : {{$horario2s->minutos_fin_op3}}</span>
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
                                        <tr>
                                            <th class="tit_datos_op2">Martes</th>
                                            <th>
                                                <h6 class="tit_datos">Hora inicio:
                                                    <span class="tit_datos_op2">{{$horario2s->hora_inicio_op1}} : {{$horario2s->minutos_inicio_op1}}</span>
                                                </h6>
                                                <h6 class="tit_datos">Hora fin:
                                                    <span class="tit_datos_op2">{{$horario2s->hora_fin_op1}} : {{$horario2s->minutos_fin_op1}}</span>
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
                                            <tr>
                                                <th class="tit_datos_op2">Martes</th>
                                                <th>
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horario2s->hora_inicio_op1}} : {{$horario2s->minutos_inicio_op1}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horario2s->hora_fin_op1}} : {{$horario2s->minutos_fin_op1}}</span>
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
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horario2s->hora_inicio_op2}} : {{$horario2s->minutos_inicio_op2}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horario2s->hora_fin_op2}} : {{$horario2s->minutos_fin_op2}}</span>
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
                                            <tr>
                                                <th class="tit_datos_op2">Martes</th>
                                                    <th>
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horario2s->hora_inicio_op1}} : {{$horario2s->minutos_inicio_op1}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horario2s->hora_fin_op1}} : {{$horario2s->minutos_fin_op1}}</span>
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
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horario2s->hora_inicio_op3}} : {{$horario2s->minutos_inicio_op3}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horario2s->hora_fin_op3}} : {{$horario2s->minutos_fin_op3}}</span>
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
                                                    <tr>
                                                        <th class="tit_datos_op2">Martes</th>
                                                        <th>
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario2s->hora_inicio_op1}} : {{$horario2s->minutos_inicio_op1}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario2s->hora_fin_op1}} : {{$horario2s->minutos_fin_op1}}</span>
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                    <span class="tit_datos_op2">{{$horario2s->hora_inicio_op2}} : {{$horario2s->minutos_inicio_op2}}</span>
                                                                </h6>
                                                                <h6 class="tit_datos">Hora fin:
                                                                    <span class="tit_datos_op2">{{$horario2s->hora_fin_op2}} : {{$horario2s->minutos_fin_op2}}</span>
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario2s->hora_inicio_op3}} : {{$horario2s->minutos_inicio_op3}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario2s->hora_fin_op3}} : {{$horario2s->minutos_fin_op3}}</span>
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
                                <tr>
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
                                    <tr>
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
                                            <h6 class="tit_datos">Hora inicio:
                                                <span class="tit_datos_op2">{{$horario3s->hora_inicio_op3}} : {{$horario3s->minutos_inicio_op3}}</span>
                                            </h6>
                                            <h6 class="tit_datos">Hora fin:
                                                <span class="tit_datos_op2">{{$horario3s->hora_fin_op3}} : {{$horario3s->minutos_fin_op3}}</span>
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
                                        <tr>
                                            <th class="tit_datos_op2">Miércoles</th>
                                            <th>
                                                <h6 class="tit_datos">Hora inicio:
                                                    <span class="tit_datos_op2">{{$horario3s->hora_inicio_op1}} : {{$horario3s->minutos_inicio_op1}}</span>
                                                </h6>
                                                <h6 class="tit_datos">Hora fin:
                                                    <span class="tit_datos_op2">{{$horario3s->hora_fin_op1}} : {{$horario3s->minutos_fin_op1}}</span>
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
                                            <tr>
                                                <th class="tit_datos_op2">Miércoles</th>
                                                <th>
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horario3s->hora_inicio_op1}} : {{$horario3s->minutos_inicio_op1}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horario3s->hora_fin_op1}} : {{$horario3s->minutos_fin_op1}}</span>
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
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horario3s->hora_inicio_op2}} : {{$horario3s->minutos_inicio_op2}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horario3s->hora_fin_op2}} : {{$horario3s->minutos_fin_op2}}</span>
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
                                            <tr>
                                                <th class="tit_datos_op2">Miércoles</th>
                                                    <th>
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horario3s->hora_inicio_op1}} : {{$horario3s->minutos_inicio_op1}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horario3s->hora_fin_op1}} : {{$horario3s->minutos_fin_op1}}</span>
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
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horario3s->hora_inicio_op3}} : {{$horario3s->minutos_inicio_op3}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horario3s->hora_fin_op3}} : {{$horario3s->minutos_fin_op3}}</span>
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
                                                    <tr>
                                                        <th class="tit_datos_op2">Miércoles</th>
                                                        <th>
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario3s->hora_inicio_op1}} : {{$horario3s->minutos_inicio_op1}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario3s->hora_fin_op1}} : {{$horario3s->minutos_fin_op1}}</span>
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario3s->hora_inicio_op2}} : {{$horario3s->minutos_inicio_op2}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario3s->hora_fin_op2}} : {{$horario3s->minutos_fin_op2}}</span>
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario3s->hora_inicio_op3}} : {{$horario3s->minutos_inicio_op3}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario3s->hora_fin_op3}} : {{$horario3s->minutos_fin_op3}}</span>
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
                                <tr>
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
                                    <tr>
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
                                            <h6 class="tit_datos">Hora inicio:
                                                <span class="tit_datos_op2">{{$horario4s->hora_inicio_op3}} : {{$horario4s->minutos_inicio_op3}}</span>
                                            </h6>
                                            <h6 class="tit_datos">Hora fin:
                                                <span class="tit_datos_op2">{{$horario4s->hora_fin_op3}} : {{$horario4s->minutos_fin_op3}}</span>
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
                                        <tr>
                                            <th class="tit_datos_op2">Jueves</th>
                                            <th>
                                                <h6 class="tit_datos">Hora inicio:
                                                    <span class="tit_datos_op2">{{$horario4s->hora_inicio_op1}} : {{$horario4s->minutos_inicio_op1}}</span>
                                                </h6>
                                                <h6 class="tit_datos">Hora fin:
                                                    <span class="tit_datos_op2">{{$horario4s->hora_fin_op1}} : {{$horario4s->minutos_fin_op1}}</span>
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
                                            <tr>
                                                <th class="tit_datos_op2">Jueves</th>
                                                <th>
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horario4s->hora_inicio_op1}} : {{$horario4s->minutos_inicio_op1}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horario4s->hora_fin_op1}} : {{$horario4s->minutos_fin_op1}}</span>
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
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horario4s->hora_inicio_op2}} : {{$horario4s->minutos_inicio_op2}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horario4s->hora_fin_op2}} : {{$horario4s->minutos_fin_op2}}</span>
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
                                            <tr>
                                                <th class="tit_datos_op2">Jueves</th>
                                                    <th>
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horario4s->hora_inicio_op1}} : {{$horario4s->minutos_inicio_op1}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horario4s->hora_fin_op1}} : {{$horario4s->minutos_fin_op1}}</span>
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
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horario4s->hora_inicio_op3}} : {{$horario4s->minutos_inicio_op3}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horario4s->hora_fin_op3}} : {{$horario4s->minutos_fin_op3}}</span>
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
                                                    <tr>
                                                        <th class="tit_datos_op2">Jueves</th>
                                                        <th>
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario4s->hora_inicio_op1}} : {{$horario4s->minutos_inicio_op1}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario4s->hora_fin_op1}} : {{$horario4s->minutos_fin_op1}}</span>
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario4s->hora_inicio_op2}} : {{$horario4s->minutos_inicio_op2}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario4s->hora_fin_op2}} : {{$horario4s->minutos_fin_op2}}</span>
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario4s->hora_inicio_op3}} : {{$horario4s->minutos_inicio_op3}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario4s->hora_fin_op3}} : {{$horario4s->minutos_fin_op3}}</span>
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
                                <tr>
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
                                    <tr>
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
                                            <h6 class="tit_datos">Hora inicio:
                                                <span class="tit_datos_op2">{{$horario5s->hora_inicio_op3}} : {{$horario5s->minutos_inicio_op3}}</span>
                                            </h6>
                                            <h6 class="tit_datos">Hora fin:
                                                <span class="tit_datos_op2">{{$horario5s->hora_fin_op3}} : {{$horario5s->minutos_fin_op3}}</span>
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
                                        <tr>
                                            <th class="tit_datos_op2">Viernes</th>
                                            <th>
                                                <h6 class="tit_datos">Hora inicio:
                                                    <span class="tit_datos_op2">{{$horario5s->hora_inicio_op1}} : {{$horario5s->minutos_inicio_op1}}</span>
                                                </h6>
                                                <h6 class="tit_datos">Hora fin:
                                                    <span class="tit_datos_op2">{{$horario5s->hora_fin_op1}} : {{$horario5s->minutos_fin_op1}}</span>
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
                                            <tr>
                                                <th class="tit_datos_op2">Viernes</th>
                                                <th>
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horario5s->hora_inicio_op1}} : {{$horario5s->minutos_inicio_op1}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horario5s->hora_fin_op1}} : {{$horario5s->minutos_fin_op1}}</span>
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
                                                    <h6 class="tit_datos">Hora inicio:
                                                        <span class="tit_datos_op2">{{$horario5s->hora_inicio_op2}} : {{$horario5s->minutos_inicio_op2}}</span>
                                                    </h6>
                                                    <h6 class="tit_datos">Hora fin:
                                                        <span class="tit_datos_op2">{{$horario5s->hora_fin_op2}} : {{$horario5s->minutos_fin_op2}}</span>
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
                                            <tr>
                                                <th class="tit_datos_op2">Viernes</th>
                                                    <th>
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horario5s->hora_inicio_op1}} : {{$horario5s->minutos_inicio_op1}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horario5s->hora_fin_op1}} : {{$horario5s->minutos_fin_op1}}</span>
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
                                                        <h6 class="tit_datos">Hora inicio:
                                                            <span class="tit_datos_op2">{{$horario5s->hora_inicio_op3}} : {{$horario5s->minutos_inicio_op3}}</span>
                                                        </h6>
                                                        <h6 class="tit_datos">Hora fin:
                                                            <span class="tit_datos_op2">{{$horario5s->hora_fin_op3}} : {{$horario5s->minutos_fin_op3}}</span>
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
                                                    <tr>
                                                        <th class="tit_datos_op2">Viernes</th>
                                                        <th>
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario5s->hora_inicio_op1}} : {{$horario5s->minutos_inicio_op1}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario5s->hora_fin_op1}} : {{$horario5s->minutos_fin_op1}}</span>
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                    <span class="tit_datos_op2">{{$horario5s->hora_inicio_op2}} : {{$horario5s->minutos_inicio_op2}}</span>
                                                                </h6>
                                                                <h6 class="tit_datos">Hora fin:
                                                                    <span class="tit_datos_op2">{{$horario5s->hora_fin_op2}} : {{$horario5s->minutos_fin_op2}}</span>
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
                                                            <h6 class="tit_datos">Hora inicio:
                                                                <span class="tit_datos_op2">{{$horario5s->hora_inicio_op3}} : {{$horario5s->minutos_inicio_op3}}</span>
                                                            </h6>
                                                            <h6 class="tit_datos">Hora fin:
                                                                <span class="tit_datos_op2">{{$horario5s->hora_fin_op3}} : {{$horario5s->minutos_fin_op3}}</span>
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
                @else
                    <h6 class="tit_general">No se le ha asignado horario de tutoría al docente {{$user->name}} {{$user->lastname}}</h6>
                    <form method="POST" action="{{url("asignar_horario_docente/{$user->id}")}}">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-info btn-sm" title="Asignar horario de tutoría para el docente '{{$user->name}} {{$user->lastname}}'"><span class="fas fa-plus-circle"></span> Asignar</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection