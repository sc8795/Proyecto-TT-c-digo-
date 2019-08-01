@extends('layout_docente')

@section('content')
    @include('user_docente.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_docente.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Vista editar tutoría solicitada (presencial - grupal)</h3>
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
                <form action="{{url("confirmar_tutoria")}}" method="POST">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <input type="hidden" name="solitutoria_id" value="{{$datos_tut->id}}">
                    <input type="hidden" name="modalidad" value="{{$datos_tut->modalidad}}">
                    <input type="hidden" name="notificacion_id" value="{{$notificacion_id}}">

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
                                    @if ($datos_tut->hora_inicio=="7")
                                        <select name="hora_inicio" id="hora_inicio">
                                            <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->hora_inicio=="8")
                                        <select name="hora_inicio" id="hora_inicio">
                                            <option value="7">7</option>
                                            <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->hora_inicio=="9")
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                    @endif
                                    @if ($datos_tut->hora_inicio=="10")
                                        <select name="hora_inicio" id="hora_inicio">
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->hora_inicio=="11")
                                        <select name="hora_inicio" id="hora_inicio">
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->hora_inicio=="12")
                                        <select name="hora_inicio" id="hora_inicio">
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                            <option value="13">13</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->hora_inicio=="13")
                                        <select name="hora_inicio" id="hora_inicio">
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                        </select>
                                    @endif
                                    <span class="tit_datos">:</span>
                                    @if ($datos_tut->minutos_inicio=="0")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}0</option>
                                            <option value="0">05</option>
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
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="5")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>0{{$datos_tut->minutos_inicio}}</option>
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
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="10")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
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
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="15")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="20")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="25")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="30")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="35")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="40")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="45")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="50")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                            <option value="55">55</option>
                                        </select>
                                    @endif
                                    @if ($datos_tut->minutos_inicio=="55")
                                        <select name="minutos_inicio" id="minutos_inicio">
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                        </select>
                                    @endif
                                </h6>
                            </div>
                            <div class="col-3">
                                <h6 class="tit_general">Hora fin
                                    <select name="hora_fin" id="hora_fin">
                                        @if ($datos_tut->hora_fin=="7")
                                            <option value="{{$datos_tut->hora_fin}}" selected>{{$datos_tut->hora_fin}}</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        @endif
                                        @if ($datos_tut->hora_fin=="8")
                                            <option value="7">7</option>
                                            <option value="{{$datos_tut->hora_fin}}" selected>{{$datos_tut->hora_fin}}</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        @endif
                                        @if ($datos_tut->hora_fin=="9")
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="{{$datos_tut->hora_fin}}" selected>{{$datos_tut->hora_fin}}</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        @endif
                                        @if ($datos_tut->hora_fin=="10")
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="{{$datos_tut->hora_fin}}" selected>{{$datos_tut->hora_fin}}</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        @endif
                                        @if ($datos_tut->hora_fin=="11")
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="{{$datos_tut->hora_fin}}" selected>{{$datos_tut->hora_fin}}</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        @endif
                                        @if ($datos_tut->hora_fin=="12")
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="{{$datos_tut->hora_fin}}" selected>{{$datos_tut->hora_fin}}</option>
                                            <option value="13">13</option>
                                        @endif
                                        @if ($datos_tut->hora_fin=="13")
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="{{$datos_tut->hora_fin}}" selected>{{$datos_tut->hora_fin}}</option>
                                        @endif
                                    </select>
                                    <span class="tit_datos">:</span>
                                    <select name="minutos_fin" id="minutos_fin">
                                        @if ($datos_tut->minutos_fin==0)
                                            <option value="{{$datos_tut->minutos_fin}}" selected>0{{$datos_tut->minutos_fin}}</option>
                                            <option value="5">05</option>
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
                                        @endif
                                        @if ($datos_tut->minutos_fin==5)
                                            <option value="0">00</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>0{{$datos_tut->minutos_fin}}</option>
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
                                        @endif
                                        @if ($datos_tut->minutos_fin==10)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        @endif
                                        @if ($datos_tut->minutos_fin==15)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        @endif
                                        @if ($datos_tut->minutos_fin==20)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        @endif
                                        @if ($datos_tut->minutos_fin==25)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        @endif
                                        @if ($datos_tut->minutos_fin==30)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        @endif
                                        @if ($datos_tut->minutos_fin==35)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        @endif
                                        @if ($datos_tut->minutos_fin==40)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        @endif
                                        @if ($datos_tut->minutos_fin==45)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                            <option value="50">50</option>
                                            <option value="55">55</option>
                                        @endif
                                        @if ($datos_tut->minutos_fin==50)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                            <option value="55">55</option>
                                        @endif
                                        @if ($datos_tut->minutos_fin==55)
                                            <option value="0">00</option>
                                            <option value="5">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                            <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                        @endif
                                    </select>
                                </h6>
                            </div>
                            @else
                                @if ($aux==2)
                                    <div class="col-3">
                                        <h6 class="tit_general">Hora inicio 
                                            <select name="hora_inicio" id="hora_inicio">
                                                @if ($datos_tut->hora_inicio==15)
                                                    <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                @endif
                                                @if ($datos_tut->hora_inicio==16)
                                                    <option value="15">15</option>
                                                    <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                                    <option value="17">17</option>
                                                @endif
                                                @if ($datos_tut->hora_inicio==17)
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_inicio}}</option>
                                                @endif
                                            </select>
                                            <span class="tit_datos">:</span>
                                            @if ($datos_tut->minutos_inicio=="0")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}0</option>
                                                    <option value="5">05</option>
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
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="5")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>0{{$datos_tut->minutos_inicio}}</option>
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
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="10")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
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
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="15")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                </select>
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="20")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                </select>
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="25")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                </select>
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="30")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                </select>
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="35")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                </select>
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="40")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                </select>
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="45")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                </select>
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="50")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                                    <option value="55">55</option>
                                                </select>
                                            @endif
                                            @if ($datos_tut->minutos_inicio=="55")
                                                <select name="minutos_inicio" id="minutos_inicio">
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="{{$datos_tut->minutos_inicio}}" selected>{{$datos_tut->minutos_inicio}}</option>
                                                </select>
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="tit_general">Hora fin
                                            <select name="hora_fin" id="hora_fin">
                                                @if ($datos_tut->hora_fin==15)
                                                    <option value="{{$datos_tut->hora_fin}}" selected>{{$datos_tut->hora_fin}}</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                @endif
                                                @if ($datos_tut->hora_fin==16)
                                                    <option value="15">15</option>
                                                    <option value="{{$datos_tut->hora_fin}}" selected>{{$datos_tut->hora_fin}}</option>
                                                    <option value="17">17</option>
                                                @endif
                                                @if ($datos_tut->hora_fin==17)
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="{{$datos_tut->hora_inicio}}" selected>{{$datos_tut->hora_fin}}</option>
                                                @endif
                                            </select>
                                            <span class="tit_datos">:</span>
                                            <select name="minutos_fin" id="minutos_fin">
                                                @if ($datos_tut->minutos_fin==0)
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>0{{$datos_tut->minutos_fin}}</option>
                                                    <option value="5">05</option>
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
                                                @endif
                                                @if ($datos_tut->minutos_fin==5)
                                                    <option value="0">00</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>0{{$datos_tut->minutos_fin}}</option>
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
                                                @endif
                                                @if ($datos_tut->minutos_fin==10)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                @endif
                                                @if ($datos_tut->minutos_fin==15)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                @endif
                                                @if ($datos_tut->minutos_fin==20)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                @endif
                                                @if ($datos_tut->minutos_fin==25)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                @endif
                                                @if ($datos_tut->minutos_fin==30)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                @endif
                                                @if ($datos_tut->minutos_fin==35)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                @endif
                                                @if ($datos_tut->minutos_fin==40)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                @endif
                                                @if ($datos_tut->minutos_fin==45)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                @endif
                                                @if ($datos_tut->minutos_fin==50)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                    <option value="55">55</option>
                                                @endif
                                                @if ($datos_tut->minutos_fin==55)
                                                    <option value="0">00</option>
                                                    <option value="5">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="{{$datos_tut->minutos_fin}}" selected>{{$datos_tut->minutos_fin}}</option>
                                                @endif
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
                            <input type="text" id="fecha" placeholder="Haga clic y seleccione la fecha de tutoría." class="form-control" name="fecha_tutoria">
                        </div>
                        <br>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" onclick="capturar_fecha_horario();">Confirmar <i class="fas fa-check-circle"></i></button> 
                    <!-- >Ventana modal<-->
                    <main class="container">
                        <div class="modal fade" id="ventana" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">  
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 id="tituloVentana">¡Aviso!</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Al confirmar, aceptará impartir la tutoría solicitada en el siguiente horario:</h6>
                                        <h6 class="negrita">Día: <span class="quita_negrita">{{$datos_tut->dia}}</h6>
                                        <h6 class="negrita">Fecha: <span class="quita_negrita" id="fecha_modal"></span><span class="quita_negrita"> de <span id="hora_inicio_modal"></span>:<span id="minutos_inicio_modal"></span> a <span id="hora_fin_modal"></span>:<span id="minutos_fin_modal"></span></span></h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="cerrar">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- >Hasta aquí ventana modal<-->
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection