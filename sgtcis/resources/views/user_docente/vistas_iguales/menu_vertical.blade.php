<div class="col-3">
    <div class="vertical-menu">
        <ul class="menu_vertical">
            <li>
                <a href="{{route('vista_general_admin')}}">Vista general de la cuenta</a>
                <ul class="submenu_vertical">
                    <li>
                        <a href="{{route('editar_perfil_admin')}}">Editar perfil</a>
                    </li>
                </ul>
            </li>
            <li>
                @if (Auth::check())
                    <!--li class="nav-item dropdown"-->
                        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i> Notificaciones
                            <span class="badge badge-danger" id="count-notification">{{auth()->user()->unreadNotifications->count()}}</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="submenu_vertical">
                            <li>
                            <!--div class="droptdown-menu" aria-labelledby="navbarDropdown"-->
                                @if (auth()->user()->unreadNotifications->count())
                                    @foreach (auth()->user()->unreadNotifications as $notifications)
                                        <a href="{{url("ver_tutoria_solitada")}}" class="droptdown-item">
                                            {{$notifications->data['noti_docente']['descripcion']}}
                                        </a>
                                    @endforeach    
                                @else 
                                    <a href="#" class="droptdown-item"> No tiene notificaciones </a>
                                @endif
                            <!--/div-->
                            </li>
                        </ul>
                    <!--/li-->
                @endif
            </li>
        </ul>
    </div>
</div>