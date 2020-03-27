@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_admin")}}" title="Ir a vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Registrar materia</span>
                </h1>
                <!--Para presentar mensajes-->
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                <hr>
                <div class="row" id="txt_opcion_menu_vertical">
                    <div class="col-6">
                        <h4><span class="negrita">Registro manual</span></h4>
                        <hr>
                        <form method="POST" action="{{route('crear_materia')}}" onsubmit="return validar();">
                            {{ csrf_field() }}
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="txt_opcion_menu_vertical">Nombre</span>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nombre de materia">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>
                                    <span class="negrita">Ciclo que se imparte </span>
                                    <span class="hint--top hint--info" data-hint="Seleccione el ciclo en que se imparte la materia"><i class="fas fa-question-circle"></i></span>
                                </label>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <h6><input type="radio" name="gender" id="gender" value="Primero"> Primero</h6> <br>
                                        <h6><input type="radio" name="gender" id="gender" value="Cuarto"> Cuarto</h6> <br>
                                        <h6><input type="radio" name="gender" id="gender" value="Séptimo"> Séptimo</h6> <br>
                                    </div>
                                    <div class="col-4">
                                        <h6><input type="radio" name="gender" id="gender" value="Segundo"> Segundo</h6> <br>
                                        <h6><input type="radio" name="gender" id="gender" value="Quinto"> Quinto</h6> <br>
                                        <h6><input type="radio" name="gender" id="gender" value="Octavo"> Octavo</h6> <br>
                                        <h6><input type="radio" name="gender" id="gender" value="Décimo"> Décimo</h6> <br>
                                    </div>
                                    <div class="col-4">
                                        <h6><input type="radio" name="gender" id="gender" value="Tercero"> Tercero</h6> <br>
                                        <h6><input type="radio" name="gender" id="gender" value="Sexto"> Sexto</h6> <br>
                                        <h6><input type="radio" name="gender" id="gender" value="Noveno"> Noveno</h6> <br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>
                                    <span class="negrita">Docente que la imparte</span>
                                </label>
                                <br>
                                <select name="docente" id="docente">
                                    <option value="">Seleccione docente</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">
                                            {{$user->name}} {{$user->lastname}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
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
                            <hr>
                            <button type="submit" class="btn btn-dark">Registrar materia</button><br><br>
                        </form>
                    </div>
                    <div class="col-6">
                        @php
                            $aux=1;
                        @endphp
                        <h4><span class="negrita">Registro por medio de documento excel</span></h4>
                        <hr>
                        <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                            <span class="tit_datos">Descargar plantilla excel</span>
                        </div>
                        <div class="container" style="border: 1px solid #000000;">
                            <br>
                            <!-- >Ventana modal<-->
                            <main class="container">
                                <div class="modal fade" id="ventana" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">  
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 id="tituloVentana">¡Detalles sobre la plantilla!</h5>
                                                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Al descargar la plantilla, el documento excel tendrá los siguientes campos:</h6>
                                                <h6 class="negrita">nombre:
                                                    <span class="quita_negrita">Nombre de la materia que desea registrar.</span>
                                                </h6>
                                                <h6 class="negrita">ciclo:
                                                    <span class="quita_negrita">Ciclo en que se imparte la materia.</span>
                                                </h6>
                                                <h6 class="negrita">id_docente:
                                                    <span class="quita_negrita">Id del docente que imparte la materia (lo puede consultar en el menú configuración docente, submenú docentes registrados).</span>
                                                </h6>
                                                <h6 class="negrita">paralelo_a (b,c,d):
                                                    <span class="quita_negrita">Corresponden al paralelo en el cual el docente imparte la materia. Por ejemplo si el docente imparte la materia en los paralelos A y C, deberá poner en el campo paralelo_a "A" y en paralelo_c "C"; en el caso de los paralelos que no imparte (B y D en el ejemplo), en los campos correspondientes deberá escribir "NA" lo que significa No Asignado.</span>
                                                </h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                            <!-- >Hasta aquí ventana modal<-->
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ventana">Detalles</button>
                            <a href="{{url("descargar_plantilla/{$aux}")}}" class="btn btn-secondary btn-sm" title="Descargar plantilla para registro de materias por medio de documento excel">Descargar <span class="fas fa-file-export"></span></a>
                            <br>
                            <br>
                        <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                            <span class="tit_datos">Cargar documento excel</span>
                        </div>
                        <div class="container"> 
                            <br>
                            <form method="POST" action="{{route('registrar_materia_excel')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <h6 class="excel"><input type="file" name="archivo" /></h6><br />
                                <input type="submit" class="btn btn-dark" value="Registrar materia">
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_student.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection