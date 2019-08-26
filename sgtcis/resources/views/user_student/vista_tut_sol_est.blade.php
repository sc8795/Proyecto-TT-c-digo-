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
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Lista de tutorías que ha solicitado</span></h4>
                <hr>
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                @if($solitutorias->isNotEmpty())
                    <div class="col-lg-12" id="txt_opcion_menu_vertical">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Docente</th>
                                        <th>Materia</th>
                                        <th>Fecha solicitada</th>
                                        <th>Estado</th>
                                        
                                    </tr>
                                    @foreach ($solitutorias as $solitutoria)
                                        @php
                                            $docente=DB::table('users')->where('id',$solitutoria->docente_id)->first();
                                            $materia=DB::table('materias')->where('id',$solitutoria->materia_id)->first();
                                            
                                            $fecha_solicita=$solitutoria->fecha_solicita;
                                            $date = date_create($fecha_solicita);
                                            $fecha_solicita=date_format($date, 'd-m-Y');

                                            $fecha_tutoria=$solitutoria->fecha_tutoria;
                                            $date = date_create($fecha_tutoria);
                                            $fecha_tutoria=date_format($date, 'd-m-Y');
                                            
                                            $fecha_actual=now();
                                            $date = date_create($fecha_actual);
                                            $fecha_actual=date_format($date, 'd-m-Y');
                                        @endphp
                                        <tr>                                        
                                            @if ($solitutoria->tipo=="grupal" && $solitutoria->modalidad=="presencial")
                                                <td>{{$docente->name}} {{$docente->lastname}}</td>
                                                <td>{{$materia->name}}</td>
                                                <td>{{$fecha_solicita}}</td>
                                                @if ($solitutoria->fecha_tutoria==null)
                                                    <td><h6 style="background-color: #f78181" id="borde_radio" class="text-center">Por confirmar</h6></td>
                                                @else
                                                    <td><h6 style="background-color: #81c784" id="borde_radio" class="text-center">Confirmada</h6></td>
                                                @endif
                                                <td> 
                                                    @if ($solitutoria->fecha_tutoria==null)  
                                                        <form action="{{url("eliminar_tutoria")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{method_field('DELETE')}}
                                                            <input type="hidden" name="solitutoria_id" value="{{$solitutoria->id}}">
                                                            <a href="{{url("invitar_est_desp/{$solitutoria->id}")}}" class="hint--top btn btn-outline-warning btn-sm" data-hint="Invitar" id="borde_radio"><span class="fas fa-check-circle"></span></a>
                                                            <button type="submit" class="hint--top-left btn btn-outline-dark btn-sm" data-hint="Borrar tutoría" id="borde_radio"><span class="fas fa-trash"></span></button>
                                                        </form>
                                                    @else
                                                        @if ($fecha_tutoria > $fecha_actual)
                                                            <a href="{{url("invitar_est_desp/{$solitutoria->id}")}}" class="hint--top btn btn-outline-warning btn-sm" data-hint="Invitar" id="borde_radio"><span class="fas fa-check-circle"></span></a>
                                                        @endif
                                                    @endif
                                                </td>
                                            @endif
                                            @if ($solitutoria->tipo=="grupal" && $solitutoria->modalidad=="virtual")
                                                virtual grupal
                                            @endif
                                            @if ($solitutoria->tipo=="individual" && $solitutoria->modalidad=="presencial")
                                                <td>{{$docente->name}} {{$docente->lastname}}</td>
                                                <td>{{$materia->name}}</td>
                                                <td>{{$fecha_solicita}}</td>
                                                @if ($solitutoria->fecha_tutoria==null)
                                                    <td><h6 style="background-color: #f78181" id="borde_radio" class="text-center">Por confirmar</h6></td>
                                                @else
                                                    <td><h6 style="background-color: #81c784" id="borde_radio" class="text-center">Confirmada</h6></td>
                                                @endif
                                                
                                            @endif
                                            @if ($solitutoria->tipo=="individual" && $solitutoria->modalidad=="virtual")
                                                virtual individual
                                            @endif
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
                    <h5 id="txt_opcion_menu_vertical"><span class="negrita">No ha solicitado tutorías</span></h5>
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