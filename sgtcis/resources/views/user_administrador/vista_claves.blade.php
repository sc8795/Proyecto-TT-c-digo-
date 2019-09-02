@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Claves de usuarios registrados</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Por favor seleccione una opción para ver la clave de los usuarios registrados</span></h4>
                <hr><br>
                <div class="container text-center" id="cont_carga_h">
                    <a href="{{url("ver_op_pass/1")}}" class="btn btn-outline-dark btn-block btn-sm" target="_blank" id="borde_radio"><span class="far fa-eye"></span> DOCENTES <span class="far fa-eye"></span></a>
                </div>
                <br>
                <div class="container text-center" id="cont_carga_h">
                    <a href="{{url("ver_op_pass/2")}}" class="btn btn-outline-dark btn-block btn-sm" id="borde_radio"><span class="fas fa-eye"></span> ESTUDIANTES <span class="fas fa-eye"></span></a>
                </div>
                <br><br>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

 