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
                        <form class="formulario_general" method="POST" action="{{route('crear_materia')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label><h6 class="tit_general">Nombre</h6></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nombre materia">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label><h6 class="tit_general">Ciclo</h6></label>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="radios"><input type="radio" name="gender" value="Primero"> Primero</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" value=""> Cuarto</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" value=""> Séptimo</h6> <br>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="radios"><input type="radio" name="gender" value=""> Segundo</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" value=""> Quinto</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" value=""> Octavo</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" value=""> Décimo</h6> <br>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="radios"><input type="radio" name="gender" value=""> Tercero</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" value=""> Sexto</h6> <br>
                                        <h6 class="radios"><input type="radio" name="gender" value=""> Noveno</h6> <br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-block">Registrar materia</button>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <h4>Registro por medio de documento excel</h4>
                    <form method="POST" action="{{route('registrar_docente_excel')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" name="archivo" /><br />
                        <input type="submit" value="Enviar" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection