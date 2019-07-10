@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Registros del sistema</h3>
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
        </div>
    </div>
@endsection