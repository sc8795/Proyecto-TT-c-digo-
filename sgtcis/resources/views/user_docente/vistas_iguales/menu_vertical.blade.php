<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div id="fondo_img_menu_vertical">
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="centrar_img_menu_vertical" id="fondo_img_menu_vertical">
            <img src="{{asset('images/usuario_logueo.png')}}" class="img_usuario_logueo">
        </div>
        <div class="list-group list-group-flush">
            <div class="vertical-menu">
                <ul class="menu_vertical">
                    <li>
                        <a href="{{route('vista_general_docente')}}"><i class="icono izquierda far fa-eye"></i>Vista general de la cuenta</a>
                    </li>
                    <li>
                        @if (Auth::check())
                            <!--li class="nav-item dropdown"-->
                                <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i> Notificaciones
                                    @if (auth()->user()->unreadNotifications->count()!=0)
                                        <span class="badge badge-danger" id="count-notification">{{auth()->user()->unreadNotifications->count()}}</span>
                                    @endif
                                    <span class="caret"></span>
                                </a>
                                <ul class="submenu_vertical">
                                    <li>
                                    <!--div class="droptdown-menu" aria-labelledby="navbarDropdown"-->
                                        @if (auth()->user()->unreadNotifications->count())
                                            @foreach (auth()->user()->unreadNotifications as $notifications)
                                                <a href="{{url("ver_tutoria_solitada/{$notifications->data['noti_docente']['user_id']}/{$notifications->data['noti_docente']['user_docente_id']}/{$notifications->data['noti_docente']['solitutoria_id']}/{$notifications->id}")}}" class="droptdown-item">
                                                    <span class="fas fa-chalkboard-teacher"></span>
                                                    {{$notifications->data['noti_docente']['descripcion']}} <br>
                                                    <span class="titulo_fecha_tutoria">{{$notifications->data['noti_docente']['created_at']}}</span>
                                                </a>
                                            @endforeach    
                                        @else 
                                            <a href="{{route('vista_general_docente')}}" class="droptdown-item"> No tiene notificaciones </a>
                                        @endif
                                    <!--/div-->
                                    </li>
                                </ul>
                            <!--/li-->
                        @endif
                    </li>
                    <li>
                        <!--a href="{{url("evaluar_estudiante")}}"><i class="icono izquierda fas fa-star"></i>Evaluación al estudiante</a-->
                        <a href="{{url("#")}}"><i class="icono izquierda fas fa-star"></i>Evaluación al estudiante</a>
                    </li>
                    <li style="margin-top: 20px;">
                        <form method="POST" action="{{route('logout_docente')}}" id="logout">
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
    
        <button class="btn btn-outline-primary btn-sm" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-user"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (Auth::check())
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown" id="txt_opcion_menu_vertical">
                    <a class="nav-link dropdown-toggle btn btn-outline-success btn-sm m-1" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black">
                        {{auth()->user()->name}} {{auth()->user()->lastname}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="opcion_logueo">
                        <form method="POST" action="{{route('logout_student')}}" class="boton_logout" id="logout">
                            {{ csrf_field() }}
                            <button class="btn btn-outline-danger btn-sm">Cerrar sesion <span class="fas fa-sign-out-alt"></span></button>
                        </form>
                    </div>
                </li>
            </ul>
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
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection