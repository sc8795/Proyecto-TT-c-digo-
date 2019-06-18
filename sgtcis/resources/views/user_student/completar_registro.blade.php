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
                <a href="#" class="btn btn-success btn-sm" title="Completar registro" id="completar">Completar registro <span class="fas fa-tasks"></span></a>
                <a href="{{ url('omitir_completar_registro') }}" id="boton_omitir" class="btn btn-dark btn-sm" title="Acceder al menú de opciones, si ya ha completado su registro.">Omitir </a>
            </div>
        </div>
        <div class="col-9">            
            <div class="container" id="contenedor_general" style="display:none">
                <form action="{{url("save_completar_registro")}}" method="POST">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <input type="hidden" id="verifica_ciclo" value="{{$user_student->ciclo}}">
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Completar registro</span>
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
        </div>
    </div>
@endsection
