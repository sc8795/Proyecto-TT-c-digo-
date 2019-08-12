@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="container-fluid" id="espacio_menu_texto"></div>
    <div class="row" id="cont_pag_inicio">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-lg-9 col-xs-12 col-sm-9 col-md-9">
            <br>
            <h6><span class="negrita">¡Bienvenido!</span> {{auth()->user()->name}} {{auth()->user()->lastname}}</h6>
            <hr>
            <h6>Por favor completa el registro para que puedas solicitar tu tutoría.</h6>
            <hr>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row" id="cont_pag_inicio">
        <div class="col-lg-3 col-xs-12 col-sm-12 col-md-3">
            <div class="alert alert-dark" id="fondo_completar_registro">
                Menú de opciones no disponible hasta que complete el proceso de registro. 
                <br><br>
                <a href="{{ url('omitir_completar_registro') }}" id="boton_omitir" class="btn btn-dark btn-sm" title="Acceder al menú de opciones, si ya ha completado su registro.">Omitir </a>
            </div>
        </div>
        <div class="col-lg-9 col-xs-12 col-sm-12 col-md-9">            
            <div class="container" id="contenedor_general">
                <div class="d-flex p-2 bd-highlight" id="fondo_tabla_general">
                    <span class="tit_datos">Completar registro</span>
                </div>
                <div class="container" id="fondo_contenido_tabla_general">
                    <span class="negrita">
                        ¿Actualmente se encuentra arrastrando una materia?
                    </span>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-sm-2 col-md-3">
                                <input type="radio" id="si" name="arrastre" onclick="arrastre();" checked> Si
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-3">
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
                            <div class="d-flex p-2 bd-highlight" id="fondo_tabla_general">
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
                            $verifica_password=false;
                        @endphp
                        @if (count($errors)>0)
                            @foreach ($errors->all() as $error)
                                @php
                                    $mensaje_error=$error;
                                    $verifica_paralelo = str_contains($mensaje_error, 'paralelo');
                                    $verifica_password = str_contains($mensaje_error, 'contraseña');
                                @endphp
                            @endforeach
                        @endif
                        <div class="d-flex p-2 bd-highlight" id="fondo_tabla_general">
                            <span class="tit_datos">Completar registro con arrastre de materias</span>             
                        </div>
                        <div class="container" id="contenedor_general_op2">                                
                            <span class="">Añada la/las materias que recibe actualmente.</span>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
                                    <hr>
                                    <form class="card" method="GET" action="{{url("buscar_materia_arrastre")}}">
                                        <div class="row no-gutters align-items-center">
                                            <!--end of col-->
                                            <div class="col">
                                                <input class="form-control form-control-borderless form-control-sm" name="name" type="search" placeholder="Nombre de materia a añadir" title="Escriba el nombre de la materia">
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
                                        <div class="alert alert-danger" id="mensaje_uno">
                                            {{$error}}
                                            @php
                                                echo '<script language="javascript">alert("El campo paralelo es obligatorio");</script>';
                                            @endphp
                                        </div>
                                    @endif
                                    @if ($materias->isNotEmpty())
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Materia</th>
                                                <th scope="col">Paralelo</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                            @foreach ($materias as $materia) 
                                            <form action="{{url("agregar_materia_arrastre")}}" method="POST">
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
                                    @else
                                        <span class="negrita">No se han encontrado resultados</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
                                    <div class="d-flex p-2 bd-highlight" id="fondo_tabla_general">
                                        <span class="tit_datos">Materias añadidas</span>
                                    </div>
                                    <div class="container" id="fondo_contenido_tabla_original_op2">
                                        <hr>
                                        @if ($verifica_arrastre==true)
                                            @if ($arrastre->materia==null || $arrastre->paralelo==null)
                                                <h6 class="negrita">No ha añadido ninguna materia</h6>
                                            @else
                                            <table class="table table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Materia</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <div id="mensaje_cuatro">
                                                        @include('flash::message')
                                                    </div>
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
                                            <hr>
                                            <form action="{{url("save_completar_registro")}}" method="POST">
                                                {{ csrf_field() }}
                                                {{method_field('PUT')}}
                                                <input type="hidden" name="paralelo" value="arrastre">
                                                <input type="hidden" name="ciclo" value="arrastre">
                                                @if ($verifica_password==true)
                                                    <div class="alert alert-danger" id="mensaje_siete">
                                                        {{$error}}
                                                    </div>
                                                @endif
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                                <hr>
                                                <button type="submit" class="btn btn-primary btn-block btn-sm">Finalizar Registro</button>
                                            </form>
                                            @endif
                                        @else
                                            <h6 class="negrita">No ha añadido ninguna materia</h6>
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
    <div class="container-fluid" id="espacio_menu_texto"></div>
@endsection


@section('content4')
    @include('user_student.vistas_iguales.footer')
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection