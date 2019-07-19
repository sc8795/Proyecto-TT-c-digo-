@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            {!! Alert::render() !!}
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            <div class="alert alert-dark">Menú de opciones no disponible hasta que complete el proceso de registro. 
                <br><br>
                <a href="{{ url('omitir_completar_registro') }}" id="boton_omitir" class="btn btn-dark btn-sm" title="Acceder al menú de opciones, si ya ha completado su registro.">Omitir </a>
            </div>
        </div>
        <div class="col-9">            
            <div class="container" id="contenedor_general">
                <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                    <span class="tit_datos">Completar registro</span>
                </div>
                <div class="container" id="contenedor_general_op2">
                    <span class="negrita">
                        ¿Actualmente se encuentra arrastrando una materia?
                    </span>
                    <div class="container">
                        <div class="row">
                            <div class="col-1">
                                <input type="radio" id="si" name="arrastre" onclick="arrastre();"> Si
                            </div>
                            <div class="col-1">
                                <input type="radio" id="no" name="arrastre" onclick="arrastre();"> No
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!--Arrastre No-->
                    <div class="input-group mb-3" id="arrastre_no" style="display:none;">
                        <form action="{{url("save_completar_registro")}}" method="POST">
                            {{method_field("PUT")}}
                            {{ csrf_field() }}
                            <input type="hidden" id="verifica_ciclo" value="{{$user_student->ciclo}}">
                            <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                                <span class="tit_datos">Completar registro sin arrastre de materias</span>
                            </div>
                            <div class="container" id="contenedor_general_op2">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <br>
                                            <label><h6 class="tit_ciclo_form">Ciclo</h6></label>
                                            <br>
                                            <div class="row">
                                                <div class="col-4" for="gender">
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Primero"> Primero</h6> <br>
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Cuarto"> Cuarto</h6> <br>
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Séptimo"> Séptimo</h6> <br>
                                                </div>
                                                <div class="col-4">
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Segundo"> Segundo</h6> <br>
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Quinto"> Quinto</h6> <br>
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Octavo"> Octavo</h6> <br>
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Décimo"> Décimo</h6> <br>
                                                </div>
                                                <div class="col-4">
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Tercero"> Tercero</h6> <br>
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Sexto"> Sexto</h6> <br>
                                                    <h6 class="radios"><input type="radio" name="ciclo" id="ciclo" value="Noveno"> Noveno</h6> <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <br>
                                        <div class="form-group">
                                            <label><h6 class="tit_ciclo_form">Paralelo</h6></label>
                                            <br>
                                            <select name="paralelo" id="paralelo">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-block btn-primary" id="boton_completar">Completar registro</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="input-group mb-3" id="arrastre_si" style="display:none;">
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
                        <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                            <span class="tit_datos">Completar registro con arrastre de materias</span>             
                        </div>
                        <div class="container" id="contenedor_general_op2">                                
                            <span class="">Añada la/las materias que recibe actualmente.</span>
                            <div class="row">
                                <div class="col-6">
                                    <hr>
                                    <form class="card" method="GET" action="{{url("buscar_materia_arrastre")}}">
                                        <div class="row no-gutters align-items-center">
                                            <!--end of col-->
                                            <div class="col">
                                                <input class="form-control form-control-borderless form-control-sm" name="name" type="search" placeholder="Nombre de materia" title="Escriba el nombre de la materia">
                                            </div>                                                
                                            <!--end of col-->
                                            <div class="col-auto">
                                                <button class="btn btn-success btn-sm" type="submit" title="Buscar materia por nombre">Buscar <span class="fas fa-search"></span></button>
                                            </div>
                                            <!--end of col-->
                                        </div>
                                    </form>
                                    <hr>
                                    @if ($verifica_paralelo==true)
                                        <div class="alert alert-danger" id="mensaje">
                                            {{$error}}
                                        </div>
                                    @endif
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Materia</th>
                                                <th scope="col">Paralelo</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        
                                            @foreach ($materias as $materia) 
                                            <form action="{{url("agregar_materia_arrastre")}}" method="POST" onsubmit="return validar_arrastre()">
                                                {{ csrf_field() }}
                                                <tbody>
                                                    <tr>
                                                        <td><input type="hidden" id="materia" name="materia" value="{{$materia->name}}">{{$materia->name}}</td>
                                                        <td>
                                                            <select name="paralelo" id="paralelo">
                                                                <option value="">-</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="hint--top btn btn-block btn-success btn-sm" data-hint="Añadir"><span class="fas fa-check-circle"></span></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </form>
                                            @endforeach
                                        
                                    </table>
                                    {{$materias->render()}}
                                </div>
                                <div class="col-6">
                                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                                        <span class="tit_datos">Materias añadidas</span>
                                    </div>
                                    <div class="container" id="contenedor_general_op2">
                                        @if ($verifica_arrastre==true)
                                            @if ($arrastre->materia==null || $arrastre->paralelo==null)
                                            No ha añadido ninguna materia
                                            @else
                                                
                                            
                                            <table class="table table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Materia</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    @foreach ($arreglo_materia as $a_materia)
                                                        <form action="{{url("eliminar_materia_agregada")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <tr>
                                                                <td><input type="hidden" name="materia" value="{{$a_materia}}">{{$a_materia}}</td>
                                                                <td>
                                                                    <button type="submit" class="hint--top btn btn-block btn-danger btn-sm" data-hint="Borrar"><span class="fas fa-trash"></span></button>
                                                                </td>
                                                            </tr>
                                                        </form>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{url("completar_registro_arrastre")}}" class="btn btn-primary btn-block btn-sm">Finalizar Registro</a>
                                            @endif
                                        @else
                                            No ha añadido ninguna materia
                                        @endif                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
