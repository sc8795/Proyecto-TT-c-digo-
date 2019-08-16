@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_docente.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Registro de tutorías</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Lista de tutorías impartidas - por impartir</span></h4>
                <br>
                @if($solitutorias->isNotEmpty())
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Solicitada por</th>
                                        <th>Materia</th>
                                        <th>Fecha a impartir</th>
                                        <th>Hora</th>
                                        <th>Estado</th>
                                    </tr>
                                    @foreach ($solitutorias as $solitutoria)
                                        @php
                                            $estudiante=DB::table('users')->where('id',$solitutoria->estudiante_id)->first();
                                            $materia=DB::table('materias')->where('id',$solitutoria->materia_id)->first();
                                            
                                            $fecha_tutoria=$solitutoria->fecha_tutoria;
                                            $date = date_create($fecha_tutoria);
                                            $fecha_tutoria=date_format($date, 'd-m-Y');
                                            
                                            $fecha_actual=now();
                                            $date = date_create($fecha_actual);
                                            $fecha_actual=date_format($date, 'd-m-Y');

                                            $hora_actual=date("G");
                                            $minuto_actual=date("i"); 

                                        @endphp
                                        <tr>
                                            <td>{{$estudiante->name}} {{$estudiante->lastname}}</td>
                                            <td>{{$materia->name}}</td>
                                            <td>{{$fecha_tutoria}}</td>
                                            <td>
                                                {{$solitutoria->hora_inicio}}:{{$solitutoria->minutos_inicio}} -
                                                {{$solitutoria->hora_fin}}:{{$solitutoria->minutos_fin}}
                                            </td>
                                            <td>
                                                @if ($fecha_tutoria>=$fecha_actual)
                                                    Por impartir
                                                @else
                                                    Impartida
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </thead>
                            </table>
                            <br>
                            @if ($solitutorias->count()==1)
                                <br>
                                <br>
                                <br>
                            @endif
                        </div>
                    </div>
                @else
                    <h6 id="txt_opcion_menu_vertical"><span class="negrita">No tiene tutorías solicitadas o no ha confirmado tutorías</span></h6>
                    <br>
                    <br>
                    <hr>
                    <a href="{{url("vista_general_docente")}}" class="btn btn-dark" id="borde_radio">Vista general de la cuenta</a>
                    <br>
                    <br>
                @endif
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_docente.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection 