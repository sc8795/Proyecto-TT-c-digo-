<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="fondo_img_menu_vertical">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="centrar_img_menu_vertical" id="fondo_img_menu_vertical">
                <img src="{{asset('images/usuario_logueo.png')}}" class="img_usuario_logueo">
            </div>
            <div class="list-group list-group-flush">
                <div class="vertical-menu">
                    <!--Menú de opciones del administrador-->
                    <ul class="menu_vertical">
                        <!--Vista general de la cuenta-->
                        <li>
                            <a href="{{route('vista_general_admin')}}">
                                <i class="icono izquierda far fa-eye"></i>Vista general de la cuenta
                            </a>
                        </li>
                        <li>
                            <a href="#"><i class="icono izquierda fas fa-cog"></i>Configuración docente<i class="icono derecha fas fa-chevron-down"></i></a>
                            <ul class="submenu_vertical">
                                <li>
                                    <a href="{{route('registrar_docente')}}"><i class="icono izquierda fas fa-user-plus"></i>Registrar docente</a>
                                </li>
                                <li>
                                    <a href="{{route('docentes_registrados')}}"><i class="icono izquierda fas fa-user-check"></i>Docentes registrados</a>
                                </li>
                                <li>
                                    <a href="{{route('asignar_horario_tutoria')}}"><i class="icono izquierda fas fa-clock"></i>Asignar horario de tutoría</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="icono izquierda fas fa-tasks"></i>Configuración materia<i class="icono derecha fas fa-chevron-down"></i></a>
                            <ul class="submenu_vertical">
                                <li>
                                    <a href="{{route('registrar_materia')}}">Registrar materia</a>
                                    <a href="{{route('materias_registradas')}}">Materias registradas</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{url('log')}}"><i class="icono izquierda far fa-circle"></i>LOG</a>
                        </li>
                        <!--li>
                            <a href="{{url("claves")}}"><i class="icono izquierda fas fa-key"></i>Claves</a-->
                        </li>
                        <li style="margin-top: 20px;">
                            <form method="POST" action="{{route('logout_administrador')}}" id="logout">
                                {{ csrf_field() }}
                                <button class="btn btn-outline-light btn-block btn-sm">Cerrar sesión <span class="fas fa-sign-out-alt"></span></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->
    
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="menu">
                <button class="btn btn-outline-primary btn-sm" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
            </div>
            <div class="nombre_menu">
                @if (Auth::check())
                    {{auth()->user()->name}} {{auth()->user()->lastname}}
                @endif
            </div>            
      </nav>
        
    @section('scripts')
        <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        </script>
    @endsection