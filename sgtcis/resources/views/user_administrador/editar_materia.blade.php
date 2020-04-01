@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{route('materias_registradas')}}" title="Volver a materias registradas"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Editar materia</span>
                </h1>
                <hr>
                @php
                    $mensaje_error="";
                    $verifica_nombre=false;
                    $verifica_ciclo=false;
                    $verifica_paralelo=false;
                @endphp
                @if (count($errors)>0)
                    @foreach ($errors->all() as $error)
                        @php
                            $mensaje_error=$error;
                            $verifica_nombre = str_contains($mensaje_error, 'nombre');
                            $verifica_ciclo = str_contains($mensaje_error, 'ciclo');
                            $verifica_paralelo = str_contains($mensaje_error, 'paralelo');
                        @endphp
                    @endforeach
                @endif
                <!--Formulario para editar materia-->
                <form class="formulario_general" method="POST" action="{{url("editando_materia/{$materia->id}")}}">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nombres</span>
                        <input type="text" class="form-control" name="name" id="name" value="{{$materia->name}}">
                        @if ($verifica_nombre==true)
                            <h6 class="titulo_error">{{$error}}</h6>
                        @endif
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>
                            <span class="negrita">Ciclo que se imparte </span>
                            <span class="hint--top hint--info" data-hint="Ciclo en que se imparte la materia"><i class="fas fa-question-circle"></i></span>
                        </label>
                        <div class="row">
                            <div class="col-4">
                                @if ($materia->ciclo=="Primero")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}"> Primero</h6> <br>
                                @else
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Primero"> Primero</h6> <br>
                                @endif
                            
                                @if ($materia->ciclo=="Cuarto")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}"> Cuarto</h6> <br>
                                @else
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Cuarto"> Cuarto</h6> <br>
                                @endif

                                @if ($materia->ciclo=="Séptimo")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}"> Séptimo</h6> <br>
                                @else
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Séptimo"> Séptimo</h6> <br>      
                                @endif
                            </div>
                            <div class="col-4">
                                @if ($materia->ciclo=="Segundo")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}"> Segundo</h6> <br>
                                @else
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Segundo"> Segundo</h6> <br>
                                @endif

                                @if ($materia->ciclo=="Quinto")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}"> Quinto</h6> <br>
                                @else
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Quinto"> Quinto</h6> <br>
                                @endif

                                @if ($materia->ciclo=="Octavo")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}"> Octavo</h6> <br>
                                @else
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Octavo"> Octavo</h6> <br>
                                @endif

                                @if ($materia->ciclo=="Décimo")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}"> Décimo</h6>
                                @else
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Décimo"> Décimo</h6>
                                @endif
                            </div>
                            <div class="col-4">
                                @if ($materia->ciclo=="Tercero")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}"> Tercero</h6> <br>
                                @else
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Tercero"> Tercero</h6> <br>
                                @endif

                                @if ($materia->ciclo=="Sexto")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" value="{{$materia->ciclo}}"> Sexto</h6> <br>
                                @else
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Sexto"> Sexto</h6> <br>
                                @endif

                                @if ($materia->ciclo=="Noveno")
                                    <h6><input type="radio" checked="checked" name="ciclo" id="ciclo" {{$materia->ciclo}}> Noveno</h6> <br> 
                                @else     
                                    <h6><input type="radio" name="ciclo" id="ciclo" value="Noveno"> Noveno</h6> <br>
                                @endif
                            </div>
                        </div>
                        @if ($verifica_ciclo==true)
                            <h6 class="titulo_error">{{$error}}</h6>
                        @endif
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>
                            <span class="negrita">Paralelo (uno o más)</span>
                            <span class="hint--top-right hint--info" data-hint="Paralelo(s) en dónde se imparte la materia"><i class="fas fa-question-circle"></i></span>
                        </label>
                        <div class="row">
                            <div class="col-3">
                                <h6>
                                    <input type="checkbox" name="paralelo[]" id="paralelo[]" value="A" 
                                    <?php
                                        if(in_array("A",$paralelo)){
                                            echo "checked";
                                        }
                                    ?> > A
                                </h6>
                            </div>

                            <div class="col-3">
                                <h6>
                                    <input type="checkbox" name="paralelo[]" id="paralelo[]" value="B"
                                    <?php
                                        if(in_array("B",$paralelo)){
                                            echo "checked";
                                        }
                                    ?> > B
                                </h6>
                            </div>
                            <div class="col-3">
                                <h6>
                                    <input type="checkbox" name="paralelo[]" id="paralelo[]" value="C" 
                                    <?php
                                        if(in_array("C",$paralelo)){
                                            echo "checked";
                                        }
                                    ?> > C
                                </h6>
                            </div>
                            <div class="col-3">
                                <h6>
                                    <input type="checkbox" name="paralelo[]" id="paralelo[]" value="D"
                                    <?php
                                        if(in_array("D",$paralelo)){
                                            echo "checked";
                                        }
                                    ?>> D
                                </h6>
                            </div>
                        </div>
                        @if ($verifica_paralelo==true)
                            <h6 class="titulo_error">{{$error}}</h6>
                        @endif
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><span class="negrita">Docente que la imparte</span></label>
                        <select name="usuario_id" id="usuario_id">
                            @foreach ($users as $user)
                                @if ($user->id==$materia->usuario_id)
                                    <option value="{{$user->id}}">
                                        {{$user->name}} {{$user->lastname}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">
                                    {{$user->name}} {{$user->lastname}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-dark">Guardar cambios</button>
                    <hr>
                </form>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection