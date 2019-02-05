@extends('layout_inicio_sesion')
    
<div class="col-4" id="form_admin">
    <form>
        <div class="centrar_img_usuario_logueo">
                <img src="{{asset('images/usuario_logueo.png')}}" class="img_usuario_logueo">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usuario">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
</div>                
    
