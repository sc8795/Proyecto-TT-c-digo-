@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Asignar horario de tutoría al docente</h3>
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
                <div class="row">
                    <div class="col-8">
                        <h6 class="tit_general">Docente a asignar horario de tutoría: <span class="tit_datos">{{$user->name}} {{$user->lastname}}</span></h6>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-3">
                        <a href="{{url("horario_tutoria_asignada_op2/{$user->id}")}}" class="btn btn-block btn-primary">Horario asignado</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="container" id="contenedor_general">
                        {!! Alert::render() !!}
                        <form action="{{url("asignar_horario/{$user->id}")}}" method="POST">
                            {{ csrf_field() }}
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th rowspan="2" class="col-2">SECCIÓN</th>
                                        <th colspan="5">DÍA</th>
                                    </tr>
                                    <tr>
                                    <td class="tit_general">Lunes</td>
                                        <td class="tit_general">Martes</td>
                                        <td class="tit_general">Miércoles</td>
                                        <td class="tit_general">Jueves</td>
                                        <td class="tit_general">Viernes</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>
                                            <h6 class="tit_datos">MAÑANA</h6>
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="dia" value="Lunes en la mañana">Asignar</button>    
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="dia" value="Martes en la mañana">Asignar</button>
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="dia" value="Miércoles en la mañana">Asignar</button>
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="dia" value="Jueves en la mañana">Asignar</button>
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="dia" value="Viernes en la mañana">Asignar</button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <h6 class="tit_datos">TARDE</h6>
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="tarde" value="Lunes en la tarde">Asignar</button>
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="tarde" value="Martes en la tarde">Asignar</button>    
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="tarde" value="Miércoles en la tarde">Asignar</button>    
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="tarde" value="Jueves en la tarde">Asignar</button>    
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-block btn-success" name="tarde" value="Viernes en la tarde">Asignar</button>    
                                        </th>
                                    </tr>                                                  
                                </tbody>
                            </table>
                        </form>    
                    </div>
                </div>
            </div>    
        </div>
    </div>
@endsection