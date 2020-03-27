@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <form method="POST" action="{{url("asignar_horario_docente/{$user->id}")}}">
                        {{csrf_field()}}
                        <button type="submit" title="Regresar a seleccionar día" class="btn btn-primary"><span class="fas fa-arrow-circle-left"></span></button>
                        <span class="negrita">Asignar horario de tutoría</span>
                        <img src="{{asset('images/reloj.png')}}" style="width:7%">
                    </form>
                </h1>
                <hr>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita"></span></h4>
                <br>
                <!--Para presentar mensajes-->
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                <h6 id="txt_opcion_menu_vertical">
                    <span class="negrita">Docente:</span> 
                    <span> {{$user->name}} {{$user->lastname}}</span>
                </h6>

                <form action="{{url("asignar_horario_btn_docente/{$user->id}")}}" method="POST" id="txt_opcion_menu_vertical" onsubmit="return verifica_horario();">
                    {{ csrf_field() }}
                    <h6>
                        <span class="negrita">Día:</span> 
                        <span><input type="hidden" name="dia" value="{{$dia}}">{{$dia}}</span>
                    </h6>
                    <div class="row">
                        <div class="col-3">
                            <h6><span class="negrita">Hora de inicio</span>
                                @php
                                    $valor = ends_with($dia, 'mañana');
                                @endphp
                                @if ($valor==false)
                                    <select name="hora_inicio1" id="hora_inicio1">
                                        <option value="NA">-</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                    </select>
                                    <span class="tit_datos">:</span>    
                                @endif
                                @if ($valor==true)
                                    <select name="hora_inicio1" id="hora_inicio1">
                                        <option value="NA">-</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                    </select>
                                @endif
                                <select name="minutos_inicio1" id="minutos_inicio1">
                                    <option value="NA">-</option>
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
                            <h6><span class="negrita">Hora de fin</span>
                                @if ($valor==false)
                                    <select name="hora_fin1" id="hora_fin1">
                                        <option value="NA">-</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                    </select>
                                    <span class="tit_datos">:</span>    
                                @endif
                                @if ($valor==true)
                                    <select name="hora_fin1" id="hora_fin1">
                                        <option value="NA">-</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                    </select>
                                @endif
                                <select name="minutos_fin1" id="minutos_fin1">
                                    <option value="NA">-</option>
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
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-dark" id="borde_radio">Registrar</button>
                </form>
                <br>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection