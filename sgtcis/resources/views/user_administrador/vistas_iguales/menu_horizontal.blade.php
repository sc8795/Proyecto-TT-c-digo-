<header>
    <!--nav class="navegacion"-->
        <div class="container-fluid" id="contenedor_header">
            <div class="row">
                <div class="col-2">
                    <div class="logo">
                        <img src="{{asset('images/logo_sgtcis.png')}}" class="logo_imagen">
                    </div>
                </div>
                <div class="col-8">
    
                </div>
                <div class="col-2">
                    <form method="POST" action="{{route('logout_administrador')}}" class="boton_logout">
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-block">Cerrar Sesion</button>
                    </form>
                </div>
            </div>
        </div>
    <!--/nav-->
</header>