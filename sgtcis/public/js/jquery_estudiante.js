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
    var cont=document.form_grupal.motivo_grupal.length;
    for (i=0;i<cont;i++){ 
        if (document.form_grupal.motivo_grupal[2].checked){
            document.getElementById('otro_grupal').style.display='block';
        }else{
            document.getElementById('otro_grupal').style.display='none';
        }
    }
}

function mostrar_otro_motivo_individual(){
    var cont=document.form_individual.motivo_individual.length;
    for (i=0;i<cont;i++){ 
        if (document.form_individual.motivo_individual[2].checked){
            document.getElementById('otro_individual').style.display='block';
        }else{
            document.getElementById('otro_individual').style.display='none';
        }
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
$(document).on('click', '#boton_cancelar_inv', function(){
    $('#ventana').modal('show');
});

$('div#mensaje_uno').delay(1000).slideUp(1500);
$('div#mensaje_cuatro').delay(4000).slideUp(1500);
$('div#mensaje_siete').delay(7000).slideUp(1500);
$('div#mensaje_veinte').delay(20000).slideUp(1500);

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
    if(!document.querySelector('input[name="motivo_grupal"]:checked')) {
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
    
    if(!document.querySelector('input[name="motivo_individual"]:checked')) {
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

function ayuda_tut_sin_confirmar(){
    alertify.alert(
        'Ayuda', 
        'La tutoría que solicitó aún no ha sido confirmada por parte del docente. Por ahora podrá invitar a más de sus compañeros a participar de la tutoría o eliminar la tutoría.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}
function ayuda_tut_sin_confirmar_individual(){
    alertify.alert(
        'Ayuda', 
        'La tutoría que solicitó aún no ha sido confirmada por parte del docente.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}
function ayuda_tut_confirmada(){
    alertify.alert(
        'Ayuda', 
        'La tutoría ya ha sido confirmada por parte del docente. Por ahora podrá invitar a más estudiantes a participar de la tutoría. Lo podrá hacer antes del día en que será impartida (fecha de tutoría). Si la fecha actual es mayor o igual a la fecha de tutoría, SGT - CIS eliminará la acción para invitar a más estudiantes.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function ayuda_tut_confirmada_fecha_igual(){
    alertify.alert(
        'Ayuda', 
        'Ha llegado el día de la tutoría solicitada. Por ahora deberá acercarse al lugar establecido para que reciba la tutoría por parte del docente.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function ayuda_tut_confirmada_fecha_menor(){
    alertify.alert(
        'Ayuda', 
        'Usted ya ha recibido la tutoría solicitada. Por ahora no dispone de ninguna acción para realizar.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function confirmar_invitacion(){
    alertify.alert(
        'Confirmar invitación', 
        'Si desea confirmar la invitación diríjase al menú de notificaciones, seleccione la invitación recibida y haga clic en confirmar invitación.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function cancelar_invitacion(){
    alertify.alert(
        'Cancelar invitación', 
        'Si desea cancelar la invitación diríjase al menú de notificaciones, seleccione la invitación recibida y haga clic en cancelar invitación.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function ayuda_tut_sin_confirmar_inv(){
    alertify.alert(
        'Ayuda', 
        'La tutoría a la que ha sido invitado, aún no ha sido confirmada por parte del docente. Si usted aún no ha confirmado o cancelado la invitación a tutoría, por favor seleccione y confirme alguna de estas acciones.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function ayuda_tut_confirmada_inv(){
    alertify.alert(
        'Ayuda', 
        'La tutoría a la que ha sido invitado, ha sido confirmada por parte del docente. Si usted aún no ha confirmado o cancelado la invitación a tutoría, por favor seleccione y confirme alguna de estas acciones.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function ayuda_tut_sin_confirmar_inv_conf(){
    alertify.alert(
        'Ayuda', 
        'La tutoría a la que ha sido invitado, aún no ha sido confirmada por parte del docente. Por ahora no dispone de ninguna acción debido a que usted ya aceptó la invitación a tutoría. Por favor espere la confirmación por parte del docente.', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function ayuda_tut_confirmada_inv_conf(){
    alertify.alert(
        'Ayuda', 
        'La tutoría a la que ha sido invitado, ha sido confirmada por parte del docente. Por ahora no dispone de ninguna acción debido a que usted ya aceptó la invitación a tutoría. Por favor espere la confirmación por parte del docente', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function ayuda_asignar_materia(){
    alertify.alert(
        'SGTCIS - Ayuda', 
        '<div id="justificar">Por favor añada cada una de las materias que se encuentra recibiendo en el período académico. <br/><span class="negrita">Pasos:</span><br/><span class="negrita">1. </span> Obtenga la materia que desea añadir por medio del buscador. <br/><span class="negrita">2. </span>Asigne el paralelo y docente a la materia.<br/><span class="negrita">3. </span>Haga clic en el botón Añadir. </div>', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}

function boton_omitir(){
    alertify.alert(
        'SGTCIS - Aviso', 
        '<div id="justificar">Por favor complete su registro para que pueda acceder al menú de opciones.</div>', 
        function(){ 
            //alertify.success('Ok'); 
        }
    );
}