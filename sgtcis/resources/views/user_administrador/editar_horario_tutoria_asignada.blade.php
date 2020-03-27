@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("horario_tutoria_asignada_op2/{$user->id}")}}" title="Regresar a horario de tutoría asignado"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Editar horario de tutoría</span>
                </h1>
                <hr>
                <h4 id="txt_opcion_menu_vertical">
                    <span class="negrita">Docente: </span><span>{{$user->name}} {{$user->lastname}}</span>
                </h4>
                <form action="{{url("editando_horario/{$user->id}")}}" method="POST" id="txt_opcion_menu_vertical">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <h5><span class="negrita">Día:</span> 
                        <span>
                            <input type="hidden" name="dia" value="{{$var1}}">{{$var1}}
                        </span>
                    </h5>
                    <hr>
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
                    <hr>
                    <br>
                    <button type="submit" class="btn btn-dark btn-sm" title="Editar horario de tutoría">Editar <span class="oi oi-pencil"></span></button>
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

 