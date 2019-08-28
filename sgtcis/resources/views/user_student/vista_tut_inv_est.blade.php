@extends('layout_estudiante')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_student")}}" title="Regresar a vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Registro de tutorías</span>
                </h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Lista de tutorías que ha sido invitado</span></h4>
                <hr>
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                @if($invitaciones->isNotEmpty())
                    <div class="col-lg-12" id="txt_opcion_menu_vertical">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Invitado por</th>
                                        <th>Docente</th>
                                        <th>Materia</th>
                                        <th>Fecha de tutoría</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                    @foreach ($invitaciones as $invitacion)
                                        @php
                                            $estudiante=DB::table('users')->where('id',$invitacion->user_invita_id)->first();
                                            $solitutoria=DB::table('solitutorias')->where('id',$invitacion->solitutoria_id)->first();
                                            $docente=DB::table('users')->where('id',$solitutoria->docente_id)->first();
                                            $materia=DB::table('materias')->where('id',$solitutoria->materia_id)->first();

                                            $fecha_tutoria_aux=$solitutoria->fecha_tutoria;
                                            $date = date_create($fecha_tutoria_aux);
                                            $fecha_tutoria_aux=date_format($date, 'd-m-Y');
                                            $fecha_tutoria=strtotime($fecha_tutoria_aux);
                                            
                                            
                                            $fecha_actual=now();
                                            $date = date_create($fecha_actual);
                                            $fecha_actual=date_format($date, 'd-m-Y');
                                            $fecha_actual=strtotime($fecha_actual);
                                        @endphp
                                        <tr>                                        
                                            <td>{{$estudiante->name}} {{$estudiante->lastname}}</td>
                                            <td>{{$docente->name}} {{$docente->lastname}}</td>
                                            <td>{{$materia->name}}</td>
                                            @if ($solitutoria->fecha_tutoria==null)
                                                <td><p>NA</p></td>
                                            @else
                                                <td>{{$fecha_tutoria_aux}}</td>
                                            @endif
                                            @if ($solitutoria->fecha_tutoria==null)
                                                <td><h6 style="background-color: #f78181" id="borde_radio" class="text-center">Por confirmar</h6></td>
                                            @else
                                                <td><h6 style="background-color: #81c784" id="borde_radio" class="text-center">Confirmada</h6></td>
                                            @endif
                                            <td> 
                                                <!--Cuando el docente aún no confirma tutoría-->
                                                @if ($solitutoria->fecha_tutoria==null)
                                                    <button type="button" class="hint--top-left btn btn-outline-dark btn-sm" data-hint="Ayuda" id="borde_radio" onclick="ayuda_tut_sin_confirmar_inv();"><span class="fas fa-question"></span></button>
                                                    <button type="button" class="hint--top-left btn btn-outline-success btn-sm" data-hint="Confirmar invitación" id="borde_radio" onclick="confirmar_invitacion();"><span class="fas fa-check-circle"></span></button>
                                                    <button type="button" class="hint--top-left btn btn-outline-danger btn-sm" data-hint="Cancelar invitación" id="borde_radio" onclick="cancelar_invitacion();"><span class="fas fa-times-circle"></span></button>
                                                @else
                                                    @if ($fecha_tutoria > $fecha_actual)
                                                    <button type="button" class="hint--top-left btn btn-outline-dark btn-sm" data-hint="Ayuda" id="borde_radio" onclick="ayuda_tut_confirmada_inv();"><span class="fas fa-question"></span></button>
                                                    <button type="button" class="hint--top-left btn btn-outline-success btn-sm" data-hint="Confirmar invitación" id="borde_radio" onclick="confirmar_invitacion();"><span class="fas fa-check-circle"></span></button>
                                                    <button type="button" class="hint--top-left btn btn-outline-danger btn-sm" data-hint="Cancelar invitación" id="borde_radio" onclick="cancelar_invitacion();"><span class="fas fa-times-circle"></span></button>
                                                    @else
                                                        @if ($fecha_tutoria == $fecha_actual)
                                                            <button type="button" class="hint--top-left btn btn-outline-dark btn-sm" data-hint="Ayuda" id="borde_radio" onclick="ayuda_tut_confirmada_fecha_igual();"><span class="fas fa-question"></span></button>
                                                        @else
                                                            @if ($fecha_tutoria < $fecha_actual)
                                                                <button type="button" class="hint--top-left btn btn-outline-dark btn-sm" data-hint="Ayuda" id="borde_radio" onclick="ayuda_tut_confirmada_fecha_menor();"><span class="fas fa-question"></span></button>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </thead>
                            </table>
                            <hr>
                            <a href="{{route('solicitar_tutoria')}}" class="btn btn-dark" id="borde_radio">Solicitar nueva tutoría</a>
                            <hr>
                        </div>
                    </div>
                @else
                    <h5 id="txt_opcion_menu_vertical"><span class="negrita">No ha sido invitado a tutorías</span></h5>
                    <br>
                    <br>
                    <hr>
                    <a href="{{route('solicitar_tutoria')}}" class="btn btn-dark" id="borde_radio">Solicitar tutoría</a>
                    <br>
                    <br>
                @endif
                <!--form action="{{url("enviar_mail")}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit">Prueba de enviar email</button>
                </form-->
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