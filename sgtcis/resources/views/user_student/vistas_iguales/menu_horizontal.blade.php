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
              <a class="nav-link" href="{{url('/')}}" id="txt_opcion_menu_horizontal">INICIO <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url("acerca_de")}}" id="txt_opcion_menu_horizontal">ACERCA DE</a>
            </li>
            <!--li class="nav-item">
              <a class="nav-link" href="#" id="txt_opcion_menu_horizontal">AYUDA</a>
            </li-->
          </ul>
          @if (Auth::check())
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown" id="txt_opcion_menu_horizontal">
                    <a class="nav-link dropdown-toggle btn btn-outline-success btn-sm m-1" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                        {{auth()->user()->name}} {{auth()->user()->lastname}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="opcion_logueo">
                        <a class="dropdown-item" href="{{route('vista_student_google')}}">Ver cuenta <span class="fas fa-user"></span></a>
                    </div>
                </li>
            </ul>
          @else
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-outline-primary btn-sm m-1" href="{{url('/#cont_pag_inicio')}}" id="txt_opcion_menu_horizontal">Registrarse</a>
            </li>
            <li class="nav-item dropdown" id="txt_opcion_menu_horizontal">
                <a class="nav-link dropdown-toggle btn btn-outline-warning btn-sm m-1" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                Iniciar Sesión
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="opciones_inicio_sesion">
                    <a class="dropdown-item" href="{{route('show_login_form_student')}}">Estudiante</a>
                    <a class="dropdown-item" href="{{route('show_login_form_docente')}}">Docente</a>
                </div>
            </li>
          </ul>
          @endif
        </div>
      </nav>
</header>