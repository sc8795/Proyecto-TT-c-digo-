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
                    <li class="nav-item dropdown">
                        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-globe"></i> Notificación
                            <span class="badge badge-danger" id="count-notification">{{auth()->user()->unreadNotifications->count()}}</span>
                            <span class="caret"></span>
                        </a>
                        <div class="droptdown-menu" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->unreadNotifications->count())
                                @foreach (auth()->user()->unreadNotifications as $notifications)
                                    <a href="#" class="droptdown-item">
                                        {{$notifications->data['noti_docente']['title']}}
                                    </a>
                                @endforeach    
                            @else 
                                <a href="#" class="droptdown-item"> No notificación</a>
                            @endif
                        </div>
                    </li>
                @endif
            </li>
        </ul>
    </div>
</div>