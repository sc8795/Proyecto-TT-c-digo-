@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{route('asignar_horario_tutoria')}}" title="Regresar a seleccionar docente"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Asignar horario de tutoría</span>
                </h1>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h4 id="txt_opcion_menu_vertical">
                            <span class="negrita">Docente: </span><span>{{$user->name}} {{$user->lastname}}</span>
                            <a href="{{url("horario_tutoria_asignada_op2/{$user->id}")}}" id="borde_radio" class="btn btn-sm btn-dark">Horario asignado</a>
                        </h4>
                    </div>
                </div>
                <hr>
                <div class="row" id="txt_opcion_menu_vertical">
                    <div class="container" id="contenedor_general">
                        {!! Alert::render() !!}
                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                            {{ csrf_field() }}
                            <table class="table">
                                <thead class="thead">
                                    <tr>
                                        <th rowspan="2" style="text-align: center">SECCIÓN</th>
                                        <th colspan="5" style="text-align: center">DÍA</th>
                                    </tr>
                                    <tr>
                                        <td class="tit_general" style="text-align: center">Lunes</td>
                                        <td class="tit_general" style="text-align: center">Martes</td>
                                        <td class="tit_general" style="text-align: center">Miércoles</td>
                                        <td class="tit_general" style="text-align: center">Jueves</td>
                                        <td class="tit_general" style="text-align: center">Viernes</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>
                                            <h6 style="text-align: center">Matutina</h6>
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="dia" value="Lunes en la mañana">Asignar</button>    
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="dia" value="Martes en la mañana">Asignar</button>
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="dia" value="Miércoles en la mañana">Asignar</button>
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="dia" value="Jueves en la mañana">Asignar</button>
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="dia" value="Viernes en la mañana">Asignar</button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <h6 style="text-align: center">Vespertina</h6>
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="tarde" value="Lunes en la tarde">Asignar</button>
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="tarde" value="Martes en la tarde">Asignar</button>    
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="tarde" value="Miércoles en la tarde">Asignar</button>    
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="tarde" value="Jueves en la tarde">Asignar</button>    
                                        </th>
                                        <th style="text-align: center">
                                            <button type="submit" id="borde_radio" class="btn btn-sm btn-outline-info" name="tarde" value="Viernes en la tarde">Asignar</button>    
                                        </th>
                                    </tr>                                                  
                                </tbody>
                            </table>
                        </form>    
                    </div>
                </div>
                <hr>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection