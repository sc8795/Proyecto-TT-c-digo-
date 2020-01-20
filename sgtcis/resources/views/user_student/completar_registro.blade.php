@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection
<!--Muestra mensaje de bienvenida-->
@section('content2')
    <div class="container-fluid" id="espacio_menu_texto"></div>
    <div class="row" id="cont_pag_inicio">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-lg-9 col-xs-12 col-sm-9 col-md-9">
            <br>
            <h6><span class="negrita">¡Bienvenido!</span> {{auth()->user()->name}} {{auth()->user()->lastname}}</h6>
            <hr>
            <h6>Por favor complete el registro para que pueda acceder al menú de opciones y solicitar tutoría.</h6>
            <hr>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row" id="cont_pag_inicio">
        <!--Botón omitir-->
        <div class="col-lg-3 col-xs-12 col-sm-12 col-md-3">
            <div class="alert alert-dark text-justify" id="fondo_completar_registro">
                Menú de opciones no disponible hasta que complete el proceso de registro. 
                <br><br>
                <button type="button" class="btn btn-dark btn-sm" onclick="boton_omitir()">Omitir</button>
            </div>
        </div>
        <!--Formulario para completar registro-->
        <div class="col-lg-9 col-xs-12 col-sm-12 col-md-9">  
            <!--Contenedor general del formulario-->          
            <div class="container" id="contenedor_general">
                <!--Título general-->
                <div class="d-flex p-2 bd-highlight" id="fondo_tabla_general">
                    <span class="tit_datos">Completar registro</span>
                </div>
                <!--Opciones para completar registro-->
                <div class="container" id="fondo_contenido_tabla_general">
                    <!--Pregunta-->
                    <span class="negrita">
                        ¿Actualmente se encuentra arrastrando una materia?
                    </span>
                    <!--Opciones de la pregunta-->
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
                                    <!--Solicita ciclo-->
                                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
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
                                    <!--Solicita paralelo y contraseña-->
                                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
                                        <br>
                                        <!--Solicita paralelo-->
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
                                        <!--Solicita contraseña-->
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-block btn-primary" id="boton_completar">Completar registro</button>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--Arrastre Si-->
                    <div class="input-group mb-3" id="arrastre_si" style="display:none;">
                        <!--Variables para validaciones-->
                        @php
                            $mensaje_error="";
                            $verifica_paralelo=false;
                            $verifica_docente=false;
                            $verifica_password=false;
                        @endphp
                        @if (count($errors)>0)
                            @foreach ($errors->all() as $error)
                                @php
                                    $mensaje_error=$error;
                                    $verifica_paralelo = str_contains($mensaje_error, 'paralelo');
                                    $verifica_password = str_contains($mensaje_error, 'contraseña');
                                    $verifica_docente = str_contains($mensaje_error, 'docente');
                                @endphp
                            @endforeach
                        @endif
                        <div class="d-flex p-2 bd-highlight" id="fondo_tabla_general">
                            <span class="tit_datos">Completar registro con arrastre de materias</span>             
                        </div>
                        <div class="container" id="contenedor_general_op2">                                
                            <span class="">Añada la/las materias que recibe actualmente.
                                <button type="button" class="hint--top btn" id="borde_radio" data-hint="Ayuda" onclick="ayuda_asignar_materia()">
                                    <span class="fas fa-question-circle"></span>
                                </button>
                            </span>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
                                    <hr>
                                    <!--Formulario para buscar materia-->
                                    <form class="card" method="GET" action="{{url("buscar_materia_arrastre")}}">
                                        <div class="row no-gutters align-items-center">
                                            <!--solicita nombre de materia a buscar-->
                                            <div class="col">
                                                <input class="form-control form-control-borderless form-control-sm" name="name" type="search" placeholder="Nombre de materia a añadir" title="Escriba el nombre de la materia" value="{{old('name')}}">
                                            </div>                                                
                                            <!--botón buscar-->
                                            <div class="col-auto">
                                                <button class="btn btn-success btn-sm" type="submit" title="Buscar materia por nombre">
                                                    Buscar <span class="fas fa-search"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <!--Muestra mensajes de alerta sobre campos requeridos-->
                                    @if ($verifica_paralelo==true)
                                        <div class="alert alert-danger" id="mensaje_uno">
                                            {{$error}}
                                            @php
                                                echo '<script language="javascript">alert("El campo paralelo es obligatorio");</script>';
                                            @endphp
                                        </div>
                                    @endif
                                    @if ($verifica_docente==true)
                                        <div class="alert alert-danger" id="mensaje_uno">
                                            {{$error}}
                                            @php
                                                echo '<script language="javascript">alert("El campo docente es obligatorio");</script>';
                                            @endphp
                                        </div>
                                    @endif
                                    <!--Si existen materias-->
                                    @if ($materias->isNotEmpty())
                                        <!--Mensajes luego de buscar, añadir o eliminar-->
                                        <div id="mensaje_veinte" class="negrita">
                                            <span id="justificar">@include('flash::message')</span>
                                        </div>
                                        <hr>
                                        <!--Muestra materias y dentro se encuentra el formulario para añadir materias-->
                                        <table class="table table-bordered table-sm table-responsive table-striped">
                                            <!--Muestra columnas (materia, paralelo, docente y acción)-->
                                            <thead>
                                                <tr>
                                                    <th class="col-lg-4">Materia</th>
                                                    <th class="col-lg-2">Paralelo</th>
                                                    <th class="col-lg-4">Docente</th>
                                                    <th class="col-lg-2">Acción</th>
                                                </tr>
                                            </thead>
                                            @foreach ($materias as $materia) 
                                            <form action="{{url("agregar_materia_arrastre")}}" method="POST">
                                                {{ csrf_field() }}
                                                <tbody>
                                                    <tr>
                                                        <!--Presenta nombre de la materia-->
                                                        <td>
                                                            <input type="hidden" id="materia" name="materia" value="{{$materia->id}}">{{$materia->name}}
                                                        </td>
                                                        <!--Presenta opciones paralelo (solicita uno)-->
                                                        <td>
                                                            <select name="paralelo" id="paralelo">
                                                                <option value="">-</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                            </select>
                                                        
                                                        
                                                        
                                                        </td>
                                                        <!--Presenta docentes registrados (solicita uno)-->
                                                        <td>
                                                            <select name="docente" id="docente">
                                                                <option value="">-</option>
                                                                @foreach ($docentes as $user)
                                                                    <option value="{{$user->id}}">
                                                                        {{$user->name}} {{$user->lastname}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>                    
                                                            <button type="submit" class="hint--top btn btn-block btn-success btn-sm" data-hint="Añadir">
                                                                <span class="fas fa-check-circle"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </form>
                                            @endforeach
                                        </table>
                                        {{$materias->render()}}
                                    @else
                                        <div class="alert alert-danger">
                                            No se han encontrado resultados
                                        </div>
                                    @endif
                                </div>
                                <!--Muestra las materias añadidas y dentro se encuentra el formulario para completar registro-->
                                <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
                                    <div class="d-flex p-2 bd-highlight" id="fondo_tabla_general">
                                        <span class="tit_datos">Materias añadidas</span>
                                    </div>
                                    <div class="container" id="fondo_contenido_tabla_original_op2">
                                        <hr>
                                        @if ($verifica_arrastre==true)
                                            @if ($arrastre->materia==null || $arrastre->paralelo==null)
                                                <h6 class="negrita">No hay registros de materias añadidas.</h6>
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
                                                        @php
                                                            $materia_n=DB::table('materias')->where('id',$a_materia)->first();
                                                        @endphp
                                                        <form action="{{url("eliminar_materia_agregada")}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <tr>
                                                                <td><input type="hidden" name="materia" value="{{$a_materia}}">{{$materia_n->name}}</td>
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
                                                <!--Valor para campo paralelo-->
                                                <input type="hidden" name="paralelo" value="arrastre">
                                                <!--Valor para campo ciclo-->
                                                <input type="hidden" name="ciclo" value="arrastre">
                                                <!--Error si deja el campo contraseña vacío-->
                                                @if ($verifica_password==true)
                                                    <div class="alert alert-danger" id="mensaje_uno">
                                                        {{$error}}
                                                        @php
                                                            echo '<script language="javascript">alert("El campo contraseña es obligatorio");</script>';
                                                        @endphp
                                                    </div>
                                                @endif
                                                <!--Solicita contraseña-->
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                                <hr>
                                                <button type="submit" class="btn btn-primary btn-block btn-sm">Finalizar Registro</button>
                                                <hr>
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

@section('footer')
    <footer class="page-footer font-small blue pt-4" id="fondo_header_footer">
        <div class="container-fluid text-center text-md-left">
          <div class="row">
            <div class="col-md-1 mt-md-0 mt-1"></div>
            <div class="col-md-3 mt-md-0 mt-3">
              <h6 class="text-uppercase" id="txt_opcion_menu_horizontal"><span class="negrita">SGT - CIS</span></h6>
              <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background:#fba707;">
              <p class="text-justify" id="txt_footer">Software web para tutorías académicas dentro de la Carrera de Ingeniería en Sistemas de la Universidad Nacional de Loja.</p>      
            </div>
            <div class="col-md-2 mb-md-0 mb-2">
      
              <!-- Links -->
              <h6 class="text-uppercase" id="txt_opcion_menu_horizontal"><span class="negrita">NAVEGAR</span></h6>
              <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background:#fba707;">
              <ul class="list-unstyled">
                <li>
                  <a href="{{url('/')}}" id="txt_opcion_menu_horizontal">INICIO</a>
                </li>
                <li>
                  <a href="{{url("acerca_de")}}" id="txt_opcion_menu_horizontal">ACERCA DE</a>
                </li>
                <!--li>
                  <a href="#!" id="txt_opcion_menu_horizontal">AYUDA</a>
                </li-->
              </ul>
            </div>
            <div class="col-md-2 mb-md-0 mb-2">
    
                <!-- Links -->
                <h6 class="text-uppercase" id="txt_opcion_menu_horizontal"><span class="negrita">CERRAR SESIÓN</span></h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background:#fba707;">
                <ul class="list-unstyled">
                    <li>
                    <form method="POST" action="{{route('logout_student')}}" id="logout">
                        {{ csrf_field() }}
                        <button class="btn btn-outline-light btn-sm">Cerrar <span class="fas fa-sign-out-alt"></span></button>
                    </form>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 mt-md-0 mt-3">
                <h6 class="text-uppercase" id="txt_opcion_menu_horizontal"><span class="negrita">CONTACTOS</span></h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background:#fba707;">
                <p id="txt_footer"><span class="fas fa-home"></span> <span>Loja - Ecuador</span></p>
                <hr>
                <p id="txt_footer"><span class="fas fa-envelope-square"></span> <span>sdcartuchem@unl.edu.ec</span></p>   
            </div>
            <div class="col-md-1 mt-md-0 mt-1"></div>
          </div>
        </div>
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" id="fondo_copyright">© 2019 Copyright:
          <a href="http://sgtcis.azurewebsites.net/public/" id="txt_footer"> sgtcis.azurewebsites.net</a>
        </div>
      </footer>
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection