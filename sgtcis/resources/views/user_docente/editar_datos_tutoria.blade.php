@extends('layout_docente')

@section('content')
    @include('user_docente.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_docente.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Vista editar tutoría solicitada</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_docente.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="container" id="contenedor_general">
                <form action="{{url("editar_datos_tutoria/{$datos_tut->id}")}}" method="POST">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <br>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Datos de tutoría - horario</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        <h6 class="tit_general">Día: 
                            <span class="tit_datos">
                                <input type="hidden" name="dia" value="{{$datos_tut->dia}}">{{$datos_tut->dia}}
                            </span>
                        </h6>
                        <div class="row">
                            @if ($aux==1)
                            <div class="col-3">
                                <h6 class="tit_general">Hora inicio 
                                    <select name="hora_inicio">
                                        <option value="{{$datos_tut->hora_inicio}}">{{$datos_tut->hora_inicio}}</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                    </select>
                                    <span class="tit_datos">:</span>
                                    <select name="minutos_inicio">
                                        <option value="{{$datos_tut->minutos_inicio}}">{{$datos_tut->minutos_inicio}}</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="35">35</option>
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                        <option value="55">55</option>
                                    </select>
                                </h6>
                            </div>
                            <div class="col-3">
                                <h6 class="tit_general">Hora fin
                                    <select name="hora_fin">
                                        <option value="{{$datos_tut->hora_fin}}">{{$datos_tut->hora_fin}}</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                    </select>
                                    <span class="tit_datos">:</span>
                                    <select name="minutos_fin">
                                        <option value="{{$datos_tut->minutos_fin}}">{{$datos_tut->minutos_fin}}</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="35">35</option>
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                        <option value="55">55</option>
                                    </select>
                                </h6>
                            </div>
                            @else
                                @if ($aux==2)
                                    <div class="col-3">
                                        <h6 class="tit_general">Hora inicio 
                                            <select name="hora_inicio">
                                                <option value="{{$datos_tut->hora_inicio}}">{{$datos_tut->hora_inicio}}</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                            </select>
                                            <span class="minutos_inicio">:</span>
                                            <select name="{{$var7}}">
                                                <option value="{{$datos_tut->minutos_inicio}}">{{$datos_tut->minutos_inicio}}</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                            </select>
                                        </h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="tit_general">Hora fin
                                            <select name="hora_fin">
                                                <option value="{{$datos_tut->hora_fin}}">{{$datos_tut->hora_fin}}</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                            </select>
                                            <span class="minutos_fin">:</span>
                                            <select name="{{$var9}}">
                                                <option value="{{$datos_tut->minutos_fin}}">{{$datos_tut->minutos_fin}}</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                            </select>
                                        </h6>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <br>
                    </div>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Datos de tutoría - fecha</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-week"></i></span>
                            <input type="text" id="fecha" placeholder="Haga clic y seleccione la fecha de tutorìa" class="form-control" name="fecha">
                        </div>
                        <br>
                    </div>
                    <button type="submit" class="btn btn-info btn-sm" title="Editar tutoría">Editar <span class="fas fa-check-double"></span></button>
                </form>
            </div>
        </div>
    </div>
@endsection