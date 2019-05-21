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
                    <a href="{{route('registrar_docente')}}"><i class="icono izquierda fas fa-user-plus"></i>Registrar docente</a>
                </li>
                <li>
                    <a href="{{route('docentes_registrados')}}"><i class="icono izquierda fas fa-user-check"></i>Docentes registrados</a>
                </li>
                <li>
                    <a href="{{route('asignar_horario_tutoria')}}"><i class="icono izquierda fas fa-clock"></i>Asignar horario tutoría</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="icono izquierda fas fa-tasks"></i>Configuración materia<i class="icono derecha fas fa-chevron-down"></i></a>
            <ul class="submenu_vertical">
                <li>
                    <a href="{{route('registrar_materia')}}">Registrar materia</a>
                    <a href="{{route('materias_registradas')}}">Visualizar materia</a>
                </li>
            </ul>
        </li>
    </ul>
</div>