@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Editar Materia</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_administrador.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="container" id="contenedor_general">
                <form class="formulario_general" method="POST" action="{{url("editando_materia/{$materia->id}")}}">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label><h6 class="tit_general">Nombre</h6></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name',$materia->name)}}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><h6 class="tit_general">Ciclo</h6></label>
                        <input type="text" class="form-control" name="ciclo" id="ciclo" value="{{old('ciclo',$materia->ciclo)}}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><h6 class="tit_general">Paralelo (uno o más)</h6></label>
                        <br>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="radios">
                                    @if ($materia->paralelo_a=="NA")
                                        <input type="checkbox" name="paralelo_a" value="A"> A
                                    @else
                                        <input checked="checked" type="checkbox" name="paralelo_a" value="A"> A
                                    @endif
                                </h6>
                            </div>
                            <div class="col-3">
                                <h6 class="radios">
                                    @if ($materia->paralelo_b=="NA")
                                        <input type="checkbox" name="paralelo_b" value="B"> B
                                    @else
                                        <input checked="checked" type="checkbox" name="paralelo_b" value="B"> B
                                    @endif
                                </h6>
                            </div>
                            <div class="col-3">
                                <h6 class="radios">
                                    @if ($materia->paralelo_c=="NA")
                                        <input type="checkbox" name="paralelo_c" value="{{old('paralelo_c',$materia->paralelo_c)}}"> C
                                    @else
                                        <input checked="checked" type="checkbox" name="paralelo_c" value="{{old('paralelo_c',$materia->paralelo_c)}}"> C
                                    @endif
                                </h6>
                            </div>
                            <div class="col-3">
                                <h6 class="radios">
                                    @if ($materia->paralelo_d=="NA")
                                        <input type="checkbox" name="paralelo_d" value="{{old('paralelo_d',$materia->paralelo_d)}}"> D
                                    @else
                                        <input checked="checked" type="checkbox" name="paralelo_d" value="{{old('paralelo_d',$materia->paralelo_d)}}"> D
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><h6 class="tit_general">Docente que la imparte</h6></label>
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
                    <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
@endsection
