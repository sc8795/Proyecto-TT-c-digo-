@extends('layout_pagina_inicio')

@section('header')
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" id="fondo_header_footer">
            <a class="navbar-brand" href="#">
                <!--img src="{{asset('images/logo_sgtcis.png')}}" id="logo_menu"-->
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#" id="txt_opcion_menu_horizontal">INICIO <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" id="txt_opcion_menu_horizontal">ACERCA DE</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" id="txt_opcion_menu_horizontal">AYUDA</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary btn-sm m-1" href="{{url('/#cont_pag_inicio')}}" id="txt_opcion_menu_horizontal">Registrarse</a>
                </li>
                <li class="nav-item dropdown" id="txt_opcion_menu_horizontal">
                    <a class="nav-link dropdown-toggle btn btn-outline-warning btn-sm m-1" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                    Iniciar Sesión
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route('show_login_form_student')}}">Estudiante</a>
                        <a class="dropdown-item" href="{{route('show_login_form_docente')}}">Docente</a>
                    </div>
                </li>
              </ul>
            </div>
          </nav>
    </header>
    <div class="container-fluid" id="espacio_menu_texto"></div>
    <div class="container-fluid" id="cont_pag_inicio">
        <div class="row">
            <div class="col-lg-7 col-xs-12 col-sm-12 col-md-12">
                <img src="{{asset('images/img_inicio.jpg')}}" style="width: 100%;" class="img-fluid">
            </div>
            <div class="col-lg-5 col-xs-12 col-sm-12 col-md-12" id="formulario_registro">
                <h1 class="texto_formulario">Registro estudiante</h1>
                <hr>
                <div>
                    <form method="POST" action="{{url("registro_manual")}}" onsubmit="return validar_registro_manual();">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombres completos">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Apellidos completos">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div id="mensaje_correo_existe">
                                @include('flash::message')
                            </div>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Correo institucional">
                        </div>
                        <hr>
                        <input type="submit" name="registrarse" class="btn btn-primary btn-block" value="Registrarse">
                        <br>
                        <div class="form-group">
                            <a href="{{ url('student/auth/google') }}" class="btn btn-google btn-danger btn-block"><i class="fab fa-google"></i> Registrarse con Google</a>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="espacio_menu_texto"></div>
@endsection

@section('footer')
    <footer class="page-footer font-small blue pt-4" id="fondo_header_footer">
        <div class="container-fluid text-center text-md-left">
          <div class="row">
            <div class="col-md-1 mt-md-0 mt-1"></div>
            <div class="col-md-3 mt-md-0 mt-3">
              <h6 class="text-uppercase" id="txt_opcion_menu_horizontal"><span class="negrita">SGT - CIS</span></h6>
              <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background:#fba707;">
              <p class="text-justify" id="txt_footer">Aplicación web para tutorías académicas dentro de la Carrera de Ingeniería en Sistemas de la Universidad Nacional de Loja.</p>      
            </div>
            <div class="col-md-2 mb-md-0 mb-2">
      
              <!-- Links -->
              <h6 class="text-uppercase" id="txt_opcion_menu_horizontal"><span class="negrita">NAVEGAR</span></h6>
              <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background:#fba707;">
              <ul class="list-unstyled">
                <li>
                  <a href="#!" id="txt_opcion_menu_horizontal">INICIO</a>
                </li>
                <li>
                  <a href="#!" id="txt_opcion_menu_horizontal">ACERCA DE</a>
                </li>
                <li>
                  <a href="#!" id="txt_opcion_menu_horizontal">AYUDA</a>
                </li>
              </ul>
            </div>
            <div class="col-md-2 mb-md-0 mb-2">
    
                <!-- Links -->
                <h6 class="text-uppercase" id="txt_opcion_menu_horizontal"><span class="negrita">INICIAR SESIÓN</span></h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background:#fba707;">
                <ul class="list-unstyled">
                    <li>
                    <a href="#!" id="txt_opcion_menu_horizontal">ESTUDIANTE</a>
                    </li>
                    <li>
                    <a href="#!" id="txt_opcion_menu_horizontal">DOCENTE</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 mt-md-0 mt-3">
                <h6 class="text-uppercase" id="txt_opcion_menu_horizontal"><span class="negrita">CONTACTOS</span></h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background:#fba707;">
                <p id="txt_footer"><span class="fas fa-home"></span> <span>Loja - Ecuador</span></p>
                <hr>
                <p id="txt_footer"><span class="fas fa-envelope-square"></span> <span>sdcartuchem@unl.edu.ec</span></p>   
            </div>
            <div class="col-md-1 mt-md-0 mt-1"></div>
          </div>
        </div>
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" id="fondo_copyright">© 2019 Copyright:
          <a href="https://mdbootstrap.com/education/bootstrap/" id="txt_footer"> sgtcis.com</a>
        </div>
      </footer>
@endsection
@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection