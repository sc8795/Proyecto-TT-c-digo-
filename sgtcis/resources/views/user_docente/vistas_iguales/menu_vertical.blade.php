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
                        <span class="badge badge-danger" id="count-notification">{{auth()->user()->unreadNotifications->count()}}</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="submenu_vertical">
                        <li>
                        <!--div class="droptdown-menu" aria-labelledby="navbarDropdown"-->
                            @if (auth()->user()->unreadNotifications->count())
                                @foreach (auth()->user()->unreadNotifications as $notifications)
                                    <a href="{{url("ver_tutoria_solitada/{$notifications->data['noti_docente']['user_id']}/{$notifications->data['noti_docente']['user_docente_id']}/{$notifications->data['noti_docente']['solitutoria_id']}")}}" class="droptdown-item">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        {{$notifications->data['noti_docente']['descripcion']}} <br>
                                        <span class="titulo_fecha_tutoria">{{$notifications->data['noti_docente']['created_at']}}</span>
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
            <a href="{{url("evaluar_estudiante/".auth()->user()->id)}}"><i class="icono izquierda fas fa-star"></i>Evaluación al estudiante</a>
        </li>
    </ul>
</div>