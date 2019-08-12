@extends('layout_estudiante')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Vista general de la cuenta</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Perfil</span></h4>
                <br>
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>

                <form action="{{route('editar_perfil_student')}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-4">
                                <h5 id="txt_opcion_menu_vertical">Nombres - apellidos:</h5>
                            </div>
                            <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6">
                                <h5 id="txt_opcion_menu_vertical">{{auth()->user()->name}} {{auth()->user()->lastname}}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h5 id="txt_opcion_menu_vertical">Email:</h5>
                            </div>
                            <div class="col-6">
                                <h5 id="txt_opcion_menu_vertical">{{auth()->user()->email}}</h5>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-dark">Editar perfil</button>
                    </div>
                    <br>
                </form>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_student.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection