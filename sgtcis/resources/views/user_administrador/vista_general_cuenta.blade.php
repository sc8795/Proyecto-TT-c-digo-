@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1><span class="negrita">Vista general de la cuenta</span></h1>
                <div class="row">
                    @php
                        $docentes=DB::table('users')->where('is_docente',true)->get();
                        $num_docentes=$docentes->count();
                        $estudiantes=DB::table('users')->where('is_estudiante',true)->get();
                        $num_est=$estudiantes->count();
                        $tutorias=DB::table('solitutorias')->get();
                        $num_tut=$tutorias->count();
                    @endphp
                    <div class="col-5" style="margin-right: 75px;"></div>
                    <div class="col-2">
                        <div class="row bg-info">
                            <div class="col-2">
                                <span class="fas fa-user-tie text-white" style="margin-top: 20px;"></span>
                            </div>
                            <div class="col-10 text-right">
                                <span class="text-white" style="font-size: 35px;">{{$num_docentes}}</span>
                            </div>
                        </div>
                        <div class="row border border-info">
                            <div class="col-12 text-right">Docentes registrados</div>
                        </div>
                    </div>
                    <div class="col-2" style="margin-left: 5px;">
                        <div class="row bg-success">
                            <div class="col-2">
                                <span class="fas fa-user text-white" style="margin-top: 20px;"></span>
                            </div>
                            <div class="col-10 text-right">
                                <span class="text-white" style="font-size: 35px;">{{$num_est}}</span>
                            </div>
                        </div>
                        <div class="row border border-success">
                            <div class="col-12 text-right">Alumnos registrados</div>
                        </div>
                    </div>
                    <div class="col-2" style="margin-left: 5px;">
                        <div class="row bg-warning">
                            <div class="col-2">
                                <span class="fas fa-chalkboard-teacher text-white" style="margin-top: 20px;"></span>
                            </div>
                            <div class="col-10 text-right">
                                <span class="text-white" style="font-size: 35px;">{{$num_tut}}</span>
                            </div>
                        </div>
                        <div class="row border border-warning">
                            <div class="col-12 text-right">Tutorías solicitadas</div>
                        </div>
                    </div>
                </div> 
                <hr>
                <h4><span class="negrita">Perfil</span></h4>
                <br>
                <!--Para presentar mensajes-->
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                <form action="{{route('editar_perfil_admin')}}">
                    <div class="container">
                        <!--Presenta cargo del usuario y nombre del software-->
                        <div class="row">
                            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-4">
                                <h5 id="txt_opcion_menu_vertical">Tipo de usuario</h5>
                            </div>
                            <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6">
                                <h5 id="txt_opcion_menu_vertical">{{auth()->user()->name}}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-4">
                                <h5 id="txt_opcion_menu_vertical">Nombre de software</h5>
                            </div>
                            <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6">
                                <h5 id="txt_opcion_menu_vertical">{{auth()->user()->lastname}}</h5>
                            </div>
                        </div>
                        <hr>
                        <!--Presenta email del usuario-->
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
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

 