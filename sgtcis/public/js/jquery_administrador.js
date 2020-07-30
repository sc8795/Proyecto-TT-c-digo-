/* Funciones para validar formulario de registro de materia */
function validar(){
    var datosCorrectos=true;
    var error="";
    if(document.getElementById("name").value==""){
        datosCorrectos=false;
        error=" El campo nombre es obligatorio.";
    }
    if(!document.querySelector('input[name="gender"]:checked')) {
        datosCorrectos=false;
        error=" El campo ciclo es obligatorio.";
    }
    if(document.getElementById("docente").value==""){
        datosCorrectos=false;
        error=" El campo docente es obligatorio.";
    }
    var c1 = document.getElementById('paralelo[]').checked;
    
    if(c1==false){
        datosCorrectos=false;
        error=" El campo paralelo es obligatorio.";
    }
    if(!datosCorrectos){
        alertify.error(error);
    }
    return datosCorrectos;
}
/* Funciones para validar formulario de registro de materia con diferente docente*/
function validarDiferenteDocente(){
    var datosCorrectos=true;
    var error="";
    if(document.getElementById("docente").value==""){
        datosCorrectos=false;
        error=" El campo docente es obligatorio.";
    }
    if(!datosCorrectos){
        alertify.error(error);
    }
    return datosCorrectos;
}
$('#dataTable').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
});
$('#dataTable2').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "lengthMenu":[[1,5, 10, 20, 25, 50, -1], [1,5, 10, 20, 25, 50, "Todos"]],
});
$('#dataTableTutorias').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "lengthMenu":[[1,5, 10, 20, 25, 50, -1], [1,5, 10, 20, 25, 50, "Todos"]],
});
$('#dataTableNotificaciones').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "lengthMenu":[[1,5, 10, 20, 25, 50, -1], [1,5, 10, 20, 25, 50, "Todos"]],
});
$('#dataTable3').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "lengthMenu":[[3,5, 10, 20, 25, 50, -1], [3,5, 10, 20, 25, 50, "Todos"]],
});
$('div#mensaje').delay(4000).slideUp(1500);
$('div#mensaje_siete').delay(7000).slideUp(1500);

function valida_form_registro_docente(){
    var datosCorrectos=true;
    var mensaje_error="";
    if(document.getElementById('password').value =="") {
        datosCorrectos=false;
        mensaje_error="El campo contrasseña es obligatorio";
    }
    if(document.getElementById('email').value =="") {
        datosCorrectos=false;
        mensaje_error="El campo correo es obligatorio";
    }
    if(document.getElementById('lastname').value =="") {
        datosCorrectos=false;
        mensaje_error="El campo apellido es obligatorio";
    }
    if(document.getElementById('name').value =="") {
        datosCorrectos=false;
        mensaje_error="El campo nombre es obligatorio";
    }
    if(!datosCorrectos){
        alertify.error(mensaje_error);
    }
    return datosCorrectos;
}

function verifica_horario(){
    var datosCorrectos=true;
    if(document.getElementById('hora_inicio1').value !="NA"){
        if(document.getElementById('minutos_inicio1').value !="NA"){
            if(document.getElementById('hora_fin1').value !="NA"){
                if(document.getElementById('minutos_fin1').value !="NA"){
                    if(document.getElementById('hora_inicio1').value === document.getElementById('hora_fin1').value){
                        if(document.getElementById('minutos_inicio1').value*1 > document.getElementById('minutos_fin1').value*1){
                            alertify.error("El horario de tutoría que intenta asignar es incorrecto. Por favor revise el formulario e intente nuevamente.");
                            datosCorrectos = false;
                        }
                    }
                    if(document.getElementById('hora_inicio1').value*1 > document.getElementById('hora_fin1').value*1){
                        alertify.error("El horario de tutoría que intenta asignar es incorrecto. Por favor revise el formulario e intente nuevamente.");
                        datosCorrectos = false;
                    }
                }
            }
        }
    }
    return datosCorrectos;
}