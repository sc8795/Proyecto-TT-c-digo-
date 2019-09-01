@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_docente.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Reporte general de tutorías</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical">
                    <span class="negrita">Por favor seleccione una de las opciones para generar el reporte general de tutorías de todo el período académico.</span>
                </h4>
                <hr><br>
                <div class="container text-center" id="cont_carga_h">
                    <a href="{{url("ver_op_reporte_general/1")}}" class="btn btn-outline-dark btn-block btn-sm" target="_blank" id="borde_radio"><span class="far fa-eye"></span> Ver reporte general de todo el período académico <span class="far fa-eye"></span></a>
                </div>
                <br>
                <div class="container text-center" id="cont_carga_h">
                    <a href="{{url("ver_op_reporte_general/2")}}" class="btn btn-outline-dark btn-block btn-sm" id="borde_radio"><span class="fas fa-cloud-download-alt"></span> Descargar reporte general de todo el período académico <span class="fas fa-cloud-download-alt"></span></a>
                </div>
                <br><br>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_docente.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection 