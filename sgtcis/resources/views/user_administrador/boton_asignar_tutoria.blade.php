@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Vista general de la cuenta</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Perfil</span></h4>
                <br>
                <h6 class="tit_general">Docente: 
                        <span class="tit_datos"> {{$user->name}} {{$user->lastname}}</span>
                    </h6>
                    <form action="{{url("asignar_horario_btn_docente/{$user->id}")}}" method="POST">
                        {{ csrf_field() }}
                        <h6 class="tit_general">Día: 
                            <span class="tit_datos">
                                <input type="hidden" name="dia" value="{{$dia}}">{{$dia}}
                            </span>
                        </h6>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="tit_general">Hora de inicio
                                    @php
                                        $valor = ends_with($dia, 'mañana');
                                    @endphp
                                    @if ($valor==false)
                                        <select name="hora_inicio1">
                                            <option value="NA">-</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                        </select>
                                        <span class="tit_datos">:</span>    
                                    @endif
                                    @if ($valor==true)
                                        <select name="hora_inicio1">
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
                                    <select name="minutos_inicio1">
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
                                <h6 class="tit_general">Hora de fin
                                    @if ($valor==false)
                                        <select name="hora_fin1">
                                            <option value="NA">-</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                        </select>
                                        <span class="tit_datos">:</span>    
                                    @endif
                                    @if ($valor==true)
                                        <select name="hora_fin1">
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
                                    <select name="minutos_fin1">
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
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                    <br>
                    {!! Alert::render() !!}
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection