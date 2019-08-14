@extends('layout_estudiante')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_student")}}" title="Regresar a vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Solicitar tutoría</span>
                </h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Materias que recibes actualmente</span></h4>
                <br>
                @if($materias->isNotEmpty())
                <table class="table table-responsive table-sm">
                    <thead>
                        <tr>
                            <th class="col-lg-6">Nombre materia</th>
                            <th class="col-lg-3">Docente que la imparte</th>
                            <th class="col-lg-3">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cont=0;
                            $accion="v_p";  
                        @endphp
                        
                        @foreach ($materias as $materia)
                        <tr>
                            @php
                                $paralelo_materia=explode(',', $materia->paralelo);
                            @endphp

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE PRIMER CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Primero" && $user->paralelo=="A" && $user->ciclo=="Primero")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Ir a formulario - solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Primero" && $user->paralelo=="B" && $user->ciclo=="Primero")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Primero" && $user->paralelo=="C" && $user->ciclo=="Primero")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Primero" && $user->paralelo=="D" && $user->ciclo=="Primero")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE SEGUNDO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Segundo" && $user->paralelo=="A" && $user->ciclo=="Segundo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Segundo" && $user->paralelo=="B" && $user->ciclo=="Segundo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Segundo" && $user->paralelo=="C" && $user->ciclo=="Segundo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Segundo" && $user->paralelo=="D" && $user->ciclo=="Segundo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE TERCER CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Tercero" && $user->paralelo=="A" && $user->ciclo=="Tercero")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Tercero" && $user->paralelo=="B" && $user->ciclo=="Tercero")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Tercero" && $user->paralelo=="C" && $user->ciclo=="Tercero")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Tercero" && $user->paralelo=="D" && $user->ciclo=="Tercero")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE CUARTO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Cuarto" && $user->paralelo=="A" && $user->ciclo=="Cuarto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Cuarto" && $user->paralelo=="B" && $user->ciclo=="Cuarto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Cuarto" && $user->paralelo=="C" && $user->ciclo=="Cuarto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Cuarto" && $user->paralelo=="D" && $user->ciclo=="Cuarto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE QUINTO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Quinto" && $user->paralelo=="A" && $user->ciclo=="Quinto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Quinto" && $user->paralelo=="B" && $user->ciclo=="Quinto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Quinto" && $user->paralelo=="C" && $user->ciclo=="Quinto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Quinto" && $user->paralelo=="D" && $user->ciclo=="Quinto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE Sexto CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Sexto" && $user->paralelo=="A" && $user->ciclo=="Sexto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Sexto" && $user->paralelo=="B" && $user->ciclo=="Sexto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Sexto" && $user->paralelo=="C" && $user->ciclo=="Sexto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Sexto" && $user->paralelo=="D" && $user->ciclo=="Sexto")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE SEPTIMO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Séptimo" && $user->paralelo=="A" && $user->ciclo=="Séptimo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Séptimo" && $user->paralelo=="B" && $user->ciclo=="Séptimo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Séptimo" && $user->paralelo=="C" && $user->ciclo=="Séptimo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Séptimo" && $user->paralelo=="D" && $user->ciclo=="Séptimo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE OCTAVO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Octavo" && $user->paralelo=="A" && $user->ciclo=="Octavo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Octavo" && $user->paralelo=="B" && $user->ciclo=="Octavo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Octavo" && $user->paralelo=="C" && $user->ciclo=="Octavo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Octavo" && $user->paralelo=="D" && $user->ciclo=="Octavo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE NOVENO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Noveno" && $user->paralelo=="A" && $user->ciclo=="Noveno")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Noveno" && $user->paralelo=="B" && $user->ciclo=="Noveno")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Noveno" && $user->paralelo=="C" && $user->ciclo=="Noveno")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Noveno" && $user->paralelo=="D" && $user->ciclo=="Noveno")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            <!-- CONFIGURACIÓN PARA ALUMNOS DE DECIMO CICLO ><-->
                            @if(in_array("A",$paralelo_materia) && $materia->ciclo=="Décimo" && $user->paralelo=="A" && $user->ciclo=="Décimo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("B",$paralelo_materia) && $materia->ciclo=="Décimo" && $user->paralelo=="B" && $user->ciclo=="Décimo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("C",$paralelo_materia) && $materia->ciclo=="Décimo" && $user->paralelo=="C" && $user->ciclo=="Décimo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif

                            @if(in_array("D",$paralelo_materia) && $materia->ciclo=="Décimo" && $user->paralelo=="D" && $user->ciclo=="Décimo")
                                <td>{{$materia->name}}
                                </td>
                                <td>
                                    
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                {{$user_docente->name}} {{$user_docente->lastname}}
                                            @endif
                                        @endforeach
                                    
                                </td>
                                <td>
                                    <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($users_docentes as $user_docente)
                                            @if ($materia->usuario_id==$user_docente->id)
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            @endif
                                        @endforeach
                                    </form>
                                </td>
                            @endif
                        </tr>
                        @endforeach   
                    </tbody>
                </table>
                <br>
                @else
                <h6 id="txt_opcion_menu_vertical"><span class="negrita">No hay materias registradas</span></h6>
                <br>
                    <br>
                    <hr>
                    <a href="{{url("vista_general_student")}}" class="btn btn-dark" id="borde_radio">Vista general de la cuenta</a>
                    <br>
                    <br>
                @endif
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_student.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection
