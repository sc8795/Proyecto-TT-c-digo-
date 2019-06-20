@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Registrar materia</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_administrador.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-6">
                    <div class="container" id="contenedor_general">
                        <form class="formulario_general" method="POST" action="{{route('crear_materia')}}" onsubmit="return validar()">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label><h6 class="tit_general">Nombre materia</h6></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nombre materia" onblur="revisar(this)" onkeyup="revisar(this)" autocomplete="off">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label><h6 class="tit_general">Ciclo que se imparte</h6></label>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Primero"> Primero</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Cuarto"> Cuarto</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Séptimo"> Séptimo</h6> <br>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Segundo"> Segundo</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Quinto"> Quinto</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Octavo"> Octavo</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Décimo"> Décimo</h6> <br>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Tercero"> Tercero</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Sexto"> Sexto</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" id="gender" value="Noveno"> Noveno</h6> <br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label><h6 class="tit_general">Docente que la imparte</h6></label>
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
                                <label><h6 class="tit_general">Paralelo (uno o más)</h6></label>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                        <h6 class="radios"><input type="checkbox" name="paralelo_a" id="paralelo" value="A"> A</h6>
                                    </div> 
                                    <div class="col-3">
                                        <h6 class="radios"><input type="checkbox" name="paralelo_b" id="paralelo" value="B"> B</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="radios"><input type="checkbox" name="paralelo_c" id="paralelo" value="C"> C</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="radios"><input type="checkbox" name="paralelo_d" id="paralelo" value="D"> D</h6>
                                    </div>
                                    <input type="hidden" id="paralelo" value="">
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-block">Registrar materia</button>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    @php
                        $aux=1;
                    @endphp
                    <h4>Registro de materia por medio de documento excel</h4>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Descargar plantilla excel</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        <!-- >Ventana modal<-->
                        <main class="container">
                            <div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">  
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
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        <!-- >Hasta aquí ventana modal<-->
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ventanaModal">Detalles</button>
                        <a href="{{url("descargar_plantilla/{$aux}")}}" class="btn btn-secondary btn-sm" title="Descargar plantilla para registro de materias por medio de documento excel">Descargar <span class="fas fa-file-export"></span></a>
                        <br>
                        <br>
                    </div>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Cargar documento excel</span>
                    </div>
                    <div class="container" id="contenedor_general_op2"> 
                        <br>
                        <form method="POST" action="{{route('registrar_materia_excel')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h6 class="excel"><input type="file" name="archivo" /></h6><br />
                            <input type="submit" class="btn btn-primary btn-block" value="Registrar materia">
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection