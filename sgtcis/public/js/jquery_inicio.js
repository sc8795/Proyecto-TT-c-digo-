function validar_registro_manual(){
    var datosCorrectos=true;
    var error="";
    if(document.getElementById("email").value==""){
        datosCorrectos=false;
        error=" El campo apellido es obligatorio";
    } 
    if(document.getElementById("lastname").value==""){
        datosCorrectos=false;
        error=" El campo apellido es obligatorio";
    }
    if(document.getElementById("name").value==""){
        datosCorrectos=false;
        error=" El campo nombre es obligatorio";
    }
    if(!datosCorrectos){
        alert('¡AVISO!'+error);
    }
    return datosCorrectos;
}
$('div#mensaje_correo_existe').delay(8000).slideUp(1500);