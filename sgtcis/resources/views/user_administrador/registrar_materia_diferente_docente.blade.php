@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{route('materias_registradas')}}" title="Volver a materias registradas"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Registrar materia</span>
                </h1>
                <!--Para presentar mensajes cuando la materia ya está registrada con el docente enviado-->
                @if (session()->has('mensaje'))
                <div id="mensaje_siete">
                    <div class="alert alert-danger" role="alert">
                        {{session('mensaje')}}
                    </div>
                </div>
                @endif
                <hr>
                <h4><span class="negrita">Nombre de materia a registrar: </span>{{$materia->name}} - {{$materia->ciclo}} ciclo</h4>
                <hr>
                @php
                    $mensaje_error="";
                    $verifica_paralelo=false;
                @endphp
                @if (count($errors)>0)
                    @foreach ($errors->all() as $error)
                        @php
                            $mensaje_error=$error;
                            $verifica_paralelo = str_contains($mensaje_error, 'paralelo');
                        @endphp
                    @endforeach
                @endif
                <!--Formulario para registrar materia-->
                <form method="POST" action="{{route('crear_materia_diferente_docente')}}" onsubmit="return validarDiferenteDocente();">
                    {{ csrf_field() }}
                    <input type="hidden" name="name" id="name" value="{{$materia->name}}">
                    <input type="hidden" name="ciclo" id="ciclo" value="{{$materia->ciclo}}">
                    <div class="row">
                        <div class="col-6">
                            <!--Campo que permite ingresar el nombre de la materia-->
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="txt_opcion_menu_vertical">Nombre</span>
                                <input type="text" class="form-control" name="name" id="name" value="{{$materia->name}}" disabled="true">
                            </div>
                            <hr>
                            <!--Campo que permite seleccionar el paralelo en que se imparte la materia-->
                            <div class="form-group">
                                <label>
                                    <span class="negrita">Paralelo (uno o más)</span>
                                    <span class="hint--top-right hint--info" data-hint="Seleccione él o los paralelos en dónde se imparte la materia"><i class="fas fa-question-circle"></i></span>
                                </label>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                        <h6><input type="checkbox" name="paralelo[]" id="paralelo[]" value="A"> A</h6>
                                    </div> 
                                    <div class="col-3">
                                        <h6><input type="checkbox" name="paralelo[]" id="paralelo[]" value="B"> B</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6><input type="checkbox" name="paralelo[]" id="paralelo[]" value="C"> C</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6><input type="checkbox" name="paralelo[]" id="paralelo[]" value="D"> D</h6>
                                    </div>
                                </div>
                            </div>
                            @if ($verifica_paralelo==true)
                                <h6 class="titulo_error_rojo">{{$error}}</h6>
                            @endif
                            <hr>
                            <!--Campo que permite seleccionar el docente que imparte la materia-->
                            <div class="form-group">
                                <label>
                                    <span class="negrita">Docente que la imparte</span>
                                    <span class="hint--top-right hint--info" data-hint='En el caso de que la materia no tenga docente asignado, escoja la opción "-- Seleccione docente --"'>
                                        <i class="fas fa-question-circle"></i>
                                    </span>
                                </label>
                                <br>
                                <select name="docente" id="docente">
                                    <option value=1>Seleccione docente</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">
                                            {{$user->name}} {{$user->lastname}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <!--Campo que permite seleccionar ciclo en que se imparte la materia-->
                            <div class="form-group">
                                <label>
                                    <span class="negrita">Ciclo que se imparte </span>
                                    <span class="hint--top hint--info" data-hint="Seleccione el ciclo en que se imparte la materia"><i class="fas fa-question-circle"></i></span>
                                </label>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        @if ($materia->ciclo=="Primero")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Primero</h6> <br>
                                        @else
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Primero"> Primero</h6> <br>
                                        @endif
                                    
                                        @if ($materia->ciclo=="Cuarto")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Cuarto</h6> <br>
                                        @else
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Cuarto"> Cuarto</h6> <br>
                                        @endif

                                        @if ($materia->ciclo=="Séptimo")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Séptimo</h6> <br>
                                        @else
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Séptimo"> Séptimo</h6> <br>      
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        @if ($materia->ciclo=="Segundo")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Segundo</h6> <br>
                                        @else
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Segundo"> Segundo</h6> <br>
                                        @endif

                                        @if ($materia->ciclo=="Quinto")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Quinto</h6> <br>
                                        @else
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Quinto"> Quinto</h6> <br>
                                        @endif

                                        @if ($materia->ciclo=="Octavo")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Octavo</h6> <br>
                                        @else
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Octavo"> Octavo</h6> <br>
                                        @endif

                                        @if ($materia->ciclo=="Décimo")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Décimo</h6>
                                        @else
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Décimo"> Décimo</h6>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        @if ($materia->ciclo=="Tercero")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Tercero</h6> <br>
                                        @else
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Tercero"> Tercero</h6> <br>
                                        @endif

                                        @if ($materia->ciclo=="Sexto")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Sexto</h6> <br>
                                        @else
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Sexto"> Sexto</h6> <br>
                                        @endif

                                        @if ($materia->ciclo=="Noveno")
                                            <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}" disabled="true"> Noveno</h6> <br> 
                                        @else     
                                            <h6><input type="radio" name="ciclo" id="ciclo" value="Noveno"> Noveno</h6> <br>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-dark">Registrar materia</button><br><br>
                </form>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection