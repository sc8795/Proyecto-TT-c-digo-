@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1><span class="negrita">Registro de actividades realizadas en el sistema</span></h1>
                <div class="row">
                    @php
                        $docentes=DB::table('users')->where('is_docente',true)->get();
                        $num_docentes=$docentes->count();
                        $estudiantes=DB::table('users')->where('is_estudiante',true)->get();
                        $num_est=$estudiantes->count();
                        $tutorias=DB::table('solitutorias')->get();
                        $num_tut=$tutorias->count();
                    @endphp
                    <div class="col-5" style="margin-right: 75px;"></div>
                    <div class="col-2">
                        <div class="row bg-info">
                            <div class="col-2">
                                <span class="fas fa-user-tie text-white" style="margin-top: 20px;"></span>
                            </div>
                            <div class="col-10 text-right">
                                <span class="text-white" style="font-size: 35px;">{{$num_docentes}}</span>
                            </div>
                        </div>
                        <div class="row border border-info">
                            <div class="col-12 text-right">Docentes registrados</div>
                        </div>
                    </div>
                    <div class="col-2" style="margin-left: 5px;">
                        <div class="row bg-success">
                            <div class="col-2">
                                <span class="fas fa-user text-white" style="margin-top: 20px;"></span>
                            </div>
                            <div class="col-10 text-right">
                                <span class="text-white" style="font-size: 35px;">{{$num_est}}</span>
                            </div>
                        </div>
                        <div class="row border border-success">
                            <div class="col-12 text-right">Alumnos registrados</div>
                        </div>
                    </div>
                    <div class="col-2" style="margin-left: 5px;">
                        <div class="row bg-warning">
                            <div class="col-2">
                                <span class="fas fa-chalkboard-teacher text-white" style="margin-top: 20px;"></span>
                            </div>
                            <div class="col-10 text-right">
                                <span class="text-white" style="font-size: 35px;">{{$num_tut}}</span>
                            </div>
                        </div>
                        <div class="row border border-warning">
                            <div class="col-12 text-right">Tutorías solicitadas</div>
                        </div>
                    </div>
                </div> 
                <hr>
                <h4><span class="negrita">Perfil</span></h4>
                <br>
                <!--Para presentar mensajes-->
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                @if($logs->isNotEmpty())
                    <div class="row">
                        <div class="col-11"></div>
                        @if ($aux==1)
                        @foreach ($logs as $log)
                            @php
                                $ar=fopen("archivo.txt","a") or die ("Error al crear");
                                fwrite($ar,$log->detalle);
                                fwrite($ar," ");
                                fwrite($ar,$log->fecha);
                                fwrite($ar,"\n");
                            @endphp
                        @endforeach
                        @endif
                        <div class="col-1 hint--top" data-hint="Descargar log">
                            <a href="{{url("descargar_log/1")}}" class="btn btn-outline-success btn-sm"><span class="fas fa-cloud-download-alt"></span></a>
                        </div>
                    </div>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Actividades del sistema</span>
                    </div>
                    <div class="container" id="contenedor_general_op2"> 
                        <br>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Detalle</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    @php
                                        $fecha=$log->fecha;
                                        $date = date_create($fecha);
                                        $fecha=date_format($date, 'd-m-Y');
                                        $hora=date_format($date, 'G:ia');
                                    @endphp
                                    <tr>
                                        <td>{{$log->detalle}}</td>
                                        <td>{{$fecha}}</td>
                                        <td>{{$hora}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$logs->render()}}
                        <hr>
                    </div>
                @else
                    <h6 class="tit_general">No hay registros de actividad en el sistema</h6>
                @endif
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection