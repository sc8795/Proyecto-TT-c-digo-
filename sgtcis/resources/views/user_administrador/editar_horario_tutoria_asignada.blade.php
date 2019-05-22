@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Editar horario de tutoría asignado</h3>
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
                <h6 class="tit_general">Docente: 
                    <span class="tit_datos"> {{$user->name}} {{$user->lastname}}</span>
                </h6>
                <form action="{{url("editando_horario/{$user->id}")}}" method="POST">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <h6 class="tit_general">Día: 
                        <span class="tit_datos">
                            <input type="hidden" name="dia" value="{{$var1}}">{{$var1}}
                        </span>
                    </h6>
                    <div class="row">
                        @if ($aux==1 || $aux==2)
                        <div class="col-3">
                            <h6 class="tit_general">Hora inicio 
                                <select name="{{$var6}}">
                                    <option value="{{$var2}}">{{$var2}}</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                </select>
                                <span class="tit_datos">:</span>
                                <select name="{{$var7}}">
                                    <option value="{{$var3}}">{{$var3}}</option>
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
                                <select name="{{$var8}}">
                                    <option value="{{$var4}}">{{$var4}}</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                </select>
                                <span class="tit_datos">:</span>
                                <select name="{{$var9}}">
                                    <option value="{{$var5}}">{{$var5}}</option>
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
                            @if ($aux==3)
                                <div class="col-3">
                                    <h6 class="tit_general">Hora inicio 
                                        <select name="{{$var6}}">
                                            <option value="{{$var2}}">{{$var2}}</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                        </select>
                                        <span class="tit_datos">:</span>
                                        <select name="{{$var7}}">
                                            <option value="{{$var3}}">{{$var3}}</option>
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
                                        <select name="{{$var8}}">
                                            <option value="{{$var4}}">{{$var4}}</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                        </select>
                                        <span class="tit_datos">:</span>
                                        <select name="{{$var9}}">
                                            <option value="{{$var5}}">{{$var5}}</option>
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
                    <button type="submit" class="btn btn-success btn-sm" title="Editar horario de tutoría">Editar <span class="oi oi-pencil"></span></button>
                </form>
            </div>
        </div>
    </div>
@endsection