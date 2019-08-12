//funcion para menu vertical
$(document).ready(function(){
    $('.menu_vertical li:has(ul)').click(function(e){
        e.preventDefault();
        if($(this).hasClass('activado')){
            $(this).removeClass('activado');
            $(this).children('ul').slideUp();        
        }else{
            $('.menu_vertical li ul').slideUp();
            $('.menbu_vertical li').removeClass('activado');
            $(this).addClass('activado');
            $(this).children('ul').slideDown();
        }
    });
    $('.menu_vertical li ul li a').click(function(){
        window.location.href=$(this).attr("href");
    });

});
//función para hacer aparecer caja de texto al escojer otro motivo con el radiobutton
function mostrar_otro_motivo(){
    var motivo=document.getElementsByName("motivo");
    if(motivo[2].checked==true){
        document.getElementById('otro').style.display='block';
    }else{
        document.getElementById('otro').style.display='none';
    }
}
/*funcion para presentar mensaje de alerta en el caso de que no se complete con todos los campos pedidos en el formulario
completar registro*/

$(document).on('click', '#boton_completar', function(){
    var password, ciclo, paralelo;
    password=document.getElementById('password').value;
    ciclo=document.getElementById('ciclo').value;
    paralelo=document.getElementById('paralelo').value;
    if(password==="" || ciclo==="" || paralelo===""){
        alert("Todos los campos son requeridos");
        return false;
    }else{
        return true;
    }
});

/* Función para presentar mensaje de alerta en el caso de que el usuario logueado no haya completado su registro */
$(document).on('click', '#boton_omitir', function(){
    var verifica_ciclo;
    verifica_ciclo=document.getElementById('verifica_ciclo').value;
    if(verifica_ciclo==="NA"){
        alert("Por favor complete su registro para que pueda acceder al menú de opciones.");
        return false;
    }
});

$('div#mensaje_uno').delay(1000).slideUp(1500);
$('div#mensaje_cuatro').delay(4000).slideUp(1500);
$('div#mensaje_siete').delay(7000).slideUp(1500);

//evaluar estudiante - validar preguntas de asistencia
function validar_evaluacion_docente(){
    var datosCorrectos=true;
    var error="";
    if(!document.querySelector('input[name="pr5"]:checked')) {
        datosCorrectos=false;
        error=" Conteste la pregunta N° 5.";
    }
    if(!document.querySelector('input[name="pr4"]:checked')) {
        datosCorrectos=false;
        error=" Conteste la pregunta N° 4.";
    }
    if(!document.querySelector('input[name="pr3"]:checked')) {
        datosCorrectos=false;
        error=" Conteste la pregunta N° 3.";
    }
    if(!document.querySelector('input[name="pr2"]:checked')) {
        datosCorrectos=false;
        error=" Conteste la pregunta N° 2.";
    }   
    if(!document.querySelector('input[name="pr1"]:checked')) {
        datosCorrectos=false;
        error=" Conteste la pregunta N° 1.";
    }
    if(!datosCorrectos){
        alert('¡AVISO!'+error);
    }
    return datosCorrectos;
}

//función para hacer aparecer caja de texto al escojer completar registro mediante la etiqueta a
$(document).ready(function(){ 
   arrastre();
});
//Completar registro - arrastre del estudiante
function arrastre(){
    var motivo=document.getElementsByName("arrastre");
    if(motivo[1].checked==true){
        document.getElementById('arrastre_no').style.display='block';
        document.getElementById('arrastre_si').style.display='none';
    }else{
        document.getElementById('arrastre_no').style.display='none';
        document.getElementById('arrastre_si').style.display='block';
        document.getElementById('si').checked=true;
    }
}
//$('#grupal').trigger('click');
tipo_tutoria();
function tipo_tutoria(){
    var tipo=document.getElementsByName("tipo");
    if(tipo[1].checked==true){
        document.getElementById('tipo_grupal').style.display='block';
        document.getElementById('tipo_individual').style.display='none';
        document.getElementById('grupal').checked=true;
        document.getElementById('individual').checked=false;
    }else{
        document.getElementById('tipo_grupal').style.display='none';
        document.getElementById('tipo_individual').style.display='block';
        document.getElementById('individual').checked=true;
        document.getElementById('grupal').checked=false;
    }
}

function valida_form_solicita_tutoria(){
    var datosCorrectos=true;
    var error="";
    var verifica_invitacion=document.getElementById('verifica_invitacion').value;
    if(!document.querySelector('input[name="motivo"]:checked')) {
        datosCorrectos=false;
        error="El campo motivo de tutoría es obligatorio";
    }
    if(!document.querySelector('input[name="dia"]:checked')) {
        datosCorrectos=false;
        error="El campo horario de tutoría es obligatorio";
    }
    if(!document.querySelector('input[name="modalidad"]:checked')) {
        datosCorrectos=false;
        error="El campo modalidad de tutoría es obligatorio";
    }
    if(verifica_invitacion==0) {
        datosCorrectos=false;
        error="Debe invitar por lo menos a un estudiante";
    }
    if(!datosCorrectos){
        alert('¡AVISO! '+error);
    }
    return datosCorrectos;
}
function valida_form_solicita_tutoria_2(){
    var datosCorrectos=true;
    var error="";
    
    if(!document.querySelector('input[name="motivo"]:checked')) {
        datosCorrectos=false;
        error="El campo motivo de tutoría es obligatorio";
    }
    if(!document.querySelector('input[name="dia"]:checked')) {
        datosCorrectos=false;
        error="El campo horario de tutoría es obligatorio";
    }
    if(!document.querySelector('input[name="modalidad"]:checked')) {
        datosCorrectos=false;
        error="El campo modalidad de tutoría es obligatorio";
    }
    if(!datosCorrectos){
        alert('¡AVISO! '+error);
    }
    return datosCorrectos;
}
function valida_confirmacion_docente(){
    var fecha_solicita=document.getElementById("fecha_solicita").value;
    var fecha_tutoria=document.getElementById("fecha_tutoria").value;
    if(fecha_solicita!=fecha_tutoria && fecha_tutoria!=""){
        alert("El docente ha confirmado la tutoría a la que has sido invitado. Acepta la invitación antes del día que será impartida la tutoría.");
    }
}