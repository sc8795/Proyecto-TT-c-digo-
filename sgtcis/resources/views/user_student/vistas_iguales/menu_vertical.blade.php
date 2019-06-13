<div class="vertical-menu">
    <ul class="menu_vertical">
        <li>
            <a href="{{route('vista_general_student')}}"><i class="icono izquierda far fa-eye"></i>Vista general de la cuenta</a>
        </li>
        <li>
            <a href="{{route('solicitar_tutoria')}}"><i class="icono izquierda fas fa-chalkboard-teacher"></i>Solicitar tutoría</a>
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
                                    <a href="{{url("ver_tutoria_confirmada/{$notifications->data['noti_estudiante']['user_id']}/{$notifications->data['noti_estudiante']['user_estudiante_id']}")}}" class="droptdown-item">
                                        {{$notifications->data['noti_estudiante']['descripcion']}}
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
        <li>
            <a href="#"><i class="icono izquierda fas fa-star"></i>Evaluación al docente</a>
        </li>
    </ul>
</div>
