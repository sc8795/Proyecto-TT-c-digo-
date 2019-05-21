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
                                <label><h6 class="tit_general">Nombre materia</h6></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nombre materia">
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
                                        <h6 class="radios"><input type="checkbox" name="paralelo_a" value="A"> A</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="radios"><input type="checkbox" name="paralelo_b" value="B"> B</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="radios"><input type="checkbox" name="paralelo_c" value="C"> C</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="radios"><input type="checkbox" name="paralelo_d" value="D"> D</h6>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-block">Registrar materia</button>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <h4>Registro de materia por medio de documento excel</h4>
                    <form method="POST" action="{{route('registrar_materia_excel')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h6 class="excel"><input type="file" name="archivo" /></h6><br />
                        <input type="submit" value="Enviar" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection