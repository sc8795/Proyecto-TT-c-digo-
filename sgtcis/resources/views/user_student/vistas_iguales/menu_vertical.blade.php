<div class="vertical-menu">
    <ul class="menu_vertical">
        <li>
            <a href="{{url("vista_general_student")}}"><i class="icono izquierda far fa-eye"></i>Vista general de la cuenta</a>
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
                                    @php
                                        $arreglo=$notifications->data;
                                        $title1 = data_get($arreglo, 'invita_estudiante.title');
                                        $valida_invita_estudiante=starts_with($title1, 'Invitación');
                                        
                                        $title2 = data_get($arreglo, 'noti_estudiante.title');
                                        $valida_noti_estudiante=str_contains($title2, 'Tutoría');
                                    @endphp
                                    @if ($valida_noti_estudiante==true)
                                        <a href="{{url("ver_tutoria_confirmada/{$notifications->data['noti_estudiante']['user_id']}/{$notifications->data['noti_estudiante']['user_estudiante_id']}/{$notifications->id}")}}" class="droptdown-item">
                                            <span class="fas fa-check-circle"></span>
                                            {{$notifications->data['noti_estudiante']['descripcion']}} <br>
                                            <span class="titulo_fecha_tutoria">{{$notifications->data['noti_estudiante']['created_at']}}</span>
                                        </a>    
                                    @endif
                                    @if ($valida_invita_estudiante==true)
                                        <a href="{{url("invitacion/{$notifications->data['invita_estudiante']['user_invita_id']}/{$notifications->data['invita_estudiante']['user_invitado_id']}/{$notifications->data['invita_estudiante']['solitutoria_id']}/{$notifications->id}")}}" class="droptdown-item">
                                            <span class="fas fa-envelope"></span>
                                            {{$notifications->data['invita_estudiante']['descripcion']}} <br>
                                            <span class="titulo_fecha_tutoria">{{$notifications->data['invita_estudiante']['created_at']}}</span>
                                        </a>    
                                    @endif
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
