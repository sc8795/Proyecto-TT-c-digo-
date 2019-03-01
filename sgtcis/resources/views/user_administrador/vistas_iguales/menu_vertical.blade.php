<div class="vertical-menu">
    <ul class="menu_vertical">
        <li>
            <a href="{{route('vista_general_admin')}}"><i class="icono izquierda far fa-eye"></i>Vista general de la cuenta<i class="icono derecha fas fa-chevron-down"></i></a>
            <ul class="submenu_vertical">
                <li>
                    <a href="{{route('editar_perfil_admin')}}"><i class="icono izquierda far fa-edit"></i>Editar perfil</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="icono izquierda fas fa-cog"></i>Configuración docente<i class="icono derecha fas fa-chevron-down"></i></a>
            <ul class="submenu_vertical">
                <li>
                    <a href="{{route('registrar_docente')}}"><i class="icono izquierda fas fa-user-check"></i>Registrar docente</a>
                </li>
                <li>
                    <a href="{{route('docentes_registrados')}}"><i class="icono izquierda fas fa-user-check"></i>Docentes registrados</a>
                </li>
            </ul>
        </li>
    </ul>
</div>