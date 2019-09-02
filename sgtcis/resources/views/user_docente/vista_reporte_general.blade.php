@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_docente.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Reporte general de tutorías</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Por favor seleccione haga clic en la opción para que pueda ver el reporte general de tutorías</span></h4>
                <hr>
                @if ($solitutorias->isNotEmpty())
                    @php
                        $cont=0;
                    @endphp
                    @foreach ($solitutorias as $solitutoria)
                        @php     
                            $fecha_tutoria=$solitutoria->fecha_tutoria;
                            $date = date_create($fecha_tutoria);
                            $fecha_tutoria=date_format($date, 'd-m-Y');
                            $fecha_tutoria=strtotime($fecha_tutoria);
                            
                            $fecha_actual=now();
                            $date = date_create($fecha_actual);
                            $fecha_actual=date_format($date, 'd-m-Y');
                            $fecha_actual=strtotime($fecha_actual);

                            $hora_actual=date("G");
                            $minuto_actual=date("i");
                        @endphp
                        @if ($fecha_tutoria==$fecha_actual)
                            @if ($solitutoria->hora_fin==$hora_actual)
                                @if ($solitutoria->minutos_fin > $minuto_actual)
                                    @php
                                        $cont=$cont;
                                    @endphp
                                @else
                                    @php
                                        $cont++;
                                    @endphp
                                @endif
                            @else
                                @if ($solitutoria->hora_fin > $hora_actual)
                                    @php
                                        $cont=$cont;
                                    @endphp
                                @else
                                    @php
                                        $cont++;
                                    @endphp
                                @endif
                            @endif
                        @else
                            @if ($fecha_tutoria>$fecha_actual)
                                @php
                                    $cont=$cont;
                                @endphp
                            @else
                                @php
                                    $cont++;
                                @endphp
                            @endif
                        @endif
                    @endforeach
                    @if ($cont>0)
                        <br>
                        <div class="container text-center" id="cont_carga_h">
                            <a href="{{url("op_reporte_general")}}" class="btn btn-outline-dark btn-block btn-sm" id="borde_radio">Reporte general de todo el período académico</a>
                        </div>
                        <br>
                        <div class="container text-center" id="cont_carga_h">
                            <!--a href="#" class="btn btn-outline-dark btn-block btn-sm" id="borde_radio">Reporte general por materia</a-->
                        </div>
                        <br>
                        <div class="container text-center" id="cont_carga_h">
                            <!--a href="#" class="btn btn-outline-dark btn-block btn-sm" id="borde_radio">Reporte general por paralelo</a-->
                        </div>
                        <hr>
                    @else
                        <div class="container text-center" id="cont_carga_h">
                            <button type="button" class="btn btn-dark btn-block btn-sm" disabled="disabled" id="borde_radio" title="No tiene tutorias tutorias confirmadas o solicitadas para esta materia">aaaaaaaa</button>
                        </div>
                    @endif
                @else
                    <p>Usted no tiene registro de tutorías impartidas.</p>
                    <p>Por el momento no puede generar reporte de tutorías.</p>
                    <hr>
                    <br>
                    <a href="{{route('vista_general_docente')}}" class="btn btn-outline-dark" id="borde_radio">Vista general de la cuenta</a>
                    <hr>
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