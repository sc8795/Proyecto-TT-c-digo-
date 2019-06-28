@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Seleccione la materia a solicitar tutoría</h3>
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
                @if($materias->isNotEmpty())
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="col-6">Nombre materia</th>
                            <th scope="col" class="col-3">Docente que la imparte</th>
                            <th scope="col" class="col-3">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cont=0;
                        @endphp
                        
                        @foreach ($materias as $materia)
                        <tr>
                            @php
                                $paralelo_materia=explode(',', $materia->paralelo);
                            @endphp

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE PRIMER CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Primero" && $user->paralelo=="A" && $user->ciclo=="Primero")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Primero" && $user->paralelo=="B" && $user->ciclo=="Primero")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Primero" && $user->paralelo=="C" && $user->ciclo=="Primero")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Primero" && $user->paralelo=="D" && $user->ciclo=="Primero")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE SEGUNDO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Segundo" && $user->paralelo=="A" && $user->ciclo=="Segundo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Segundo" && $user->paralelo=="B" && $user->ciclo=="Segundo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Segundo" && $user->paralelo=="C" && $user->ciclo=="Segundo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Segundo" && $user->paralelo=="D" && $user->ciclo=="Segundo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE TERCER CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Tercero" && $user->paralelo=="A" && $user->ciclo=="Tercero")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Tercero" && $user->paralelo=="B" && $user->ciclo=="Tercero")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Tercero" && $user->paralelo=="C" && $user->ciclo=="Tercero")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Tercero" && $user->paralelo=="D" && $user->ciclo=="Tercero")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE CUARTO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Cuarto" && $user->paralelo=="A" && $user->ciclo=="Cuarto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Cuarto" && $user->paralelo=="B" && $user->ciclo=="Cuarto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Cuarto" && $user->paralelo=="C" && $user->ciclo=="Cuarto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Cuarto" && $user->paralelo=="D" && $user->ciclo=="Cuarto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE QUINTO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Quinto" && $user->paralelo=="A" && $user->ciclo=="Quinto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Quinto" && $user->paralelo=="B" && $user->ciclo=="Quinto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Quinto" && $user->paralelo=="C" && $user->ciclo=="Quinto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Quinto" && $user->paralelo=="D" && $user->ciclo=="Quinto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE Sexto CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Sexto" && $user->paralelo=="A" && $user->ciclo=="Sexto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Sexto" && $user->paralelo=="B" && $user->ciclo=="Sexto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Sexto" && $user->paralelo=="C" && $user->ciclo=="Sexto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Sexto" && $user->paralelo=="D" && $user->ciclo=="Sexto")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE SEPTIMO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Séptimo" && $user->paralelo=="A" && $user->ciclo=="Séptimo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Séptimo" && $user->paralelo=="B" && $user->ciclo=="Séptimo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Séptimo" && $user->paralelo=="C" && $user->ciclo=="Séptimo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Séptimo" && $user->paralelo=="D" && $user->ciclo=="Séptimo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE OCTAVO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Octavo" && $user->paralelo=="A" && $user->ciclo=="Octavo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Octavo" && $user->paralelo=="B" && $user->ciclo=="Octavo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Octavo" && $user->paralelo=="C" && $user->ciclo=="Octavo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Octavo" && $user->paralelo=="D" && $user->ciclo=="Octavo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE NOVENO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Noveno" && $user->paralelo=="A" && $user->ciclo=="Noveno")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Noveno" && $user->paralelo=="B" && $user->ciclo=="Noveno")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Noveno" && $user->paralelo=="C" && $user->ciclo=="Noveno")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Noveno" && $user->paralelo=="D" && $user->ciclo=="Noveno")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE DECIMO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Décimo" && $user->paralelo=="A" && $user->ciclo=="Décimo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("A",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Décimo" && $user->paralelo=="B" && $user->ciclo=="Décimo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("B",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Décimo" && $user->paralelo=="C" && $user->ciclo=="Décimo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("C",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Décimo" && $user->paralelo=="D" && $user->ciclo=="Décimo")
                                <td><h6 class="tit_general">{{$materia->name}}</h6>
                                </td>
                                <td>
                                    <h6 class="tit_general">
                                        @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                            @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    </h6>
                                </td>
                                <td>
                                    @foreach ($users_docentes as $user_docente)
                                        @php
                                            $paralelo_docente=explode(',', $user_docente->paralelo);    
                                        @endphp
                                        @if ($materia->usuario_id==$user_docente->id && in_array("D",$paralelo_docente))
                                            <a href="{{url("vista_solicitar_tutoria/{$user->id}/{$user_docente->id}/{$materia->id}")}}" class="btn btn-success btn-sm" title="Editar horario de tutoría asignado">Solicitar tutoría <span class="fas fa-file"></span></a>    
                                        @endif
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                        @endforeach   
                    </tbody>
                </table>
                @else
                    <h6 class="tit_general">No hay datos registradas</h6>
                @endif
            </div>
        </div>
    </div>
@endsection