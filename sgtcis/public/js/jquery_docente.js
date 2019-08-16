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

/* para el calendario */
    
   $(function () {
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
   $("#fecha").datepicker();
   });

//mensajes
   $('div#caja_error').delay(4000).slideUp(1500);
   $('div#mensaje_uno').delay(1000).slideUp(1500);
$('div#mensaje_cuatro').delay(4000).slideUp(1500);
$('div#mensaje_siete').delay(7000).slideUp(1500);

//evaluar estudiante - asistencia aparece boton de inasistencia y preguntas de asistencia
function asistencia(){
    var motivo=document.getElementsByName("asistencia");
    if(motivo[1].checked==true){
        document.getElementById('asistencia_no').style.display='block';
        document.getElementById('asistencia_si').style.display='none';
    }else{
        document.getElementById('asistencia_no').style.display='none';
        
        document.getElementById('asistencia_si').style.display='block';
    }
}

//evaluar estudiante - validar preguntas de asistencia
function validar_evaluacion_estudiante(){
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
    if(document.getElementById("descripcion_de_tutoria").value==""){
        datosCorrectos=false;
        error=" El campo descripción de tutoría es obligatorio.";
    }
    if(document.getElementById("tema_de_tutoria").value==""){
        datosCorrectos=false;
        error=" El campo tema de tutoría es obligatorio.";
    }
    if(!datosCorrectos){
        alert('¡AVISO!'+error);
    }
    return datosCorrectos;
}

function capturar_fecha(){
    var fecha=document.getElementById("fecha").value;
    if(fecha==""){
        alert("El campo fecha es obligatorio");
    }else{
        var fecha_format=formato(fecha);
        if (valida_fecha(fecha_format)==true){
            $('#ventana').modal('show');
            document.getElementById("fecha_modal").innerHTML=fecha_format;
        }else
            return alert("La fecha seleccionada no es válida");
    }
}

function valida_fecha(fecha_format){
    var x=new Date();
      var fecha1 = fecha_format.split("/");
      x.setFullYear(fecha1[2],fecha1[1]-1,fecha1[0]);
      var today = new Date();
      if (x <= today)
        return false;
      else
        return true;
}

function formato(fecha){
  return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
}

function capturar_fecha_horario(){
    var fecha=document.getElementById("fecha").value;
    var hora_inicio=document.getElementById("hora_inicio").value;
    var minutos_inicio=document.getElementById("minutos_inicio").value;
    var hora_fin=document.getElementById("hora_fin").value;
    var minutos_fin=document.getElementById("minutos_fin").value;
    if(fecha==""){
        alert("El campo fecha es obligatorio");
    }else{
        var fecha_format=formato(fecha);
        if (valida_fecha(fecha_format)==true && valida_horario(hora_inicio,minutos_inicio,hora_fin,minutos_fin)==true){
            $('#ventana').modal('show');
            if(minutos_inicio==0){
                minutos_inicio="00";
            }
            if(minutos_inicio==5){
                minutos_inicio="05";
            }
            if(minutos_fin==0){
                minutos_fin="00";
            }
            if(minutos_fin==5){
                minutos_fin="05";
            }
            document.getElementById("fecha_modal").innerHTML=fecha_format;
            document.getElementById("hora_inicio_modal").innerHTML=hora_inicio;
            document.getElementById("minutos_inicio_modal").innerHTML=minutos_inicio;
            document.getElementById("hora_fin_modal").innerHTML=hora_fin;
            document.getElementById("minutos_fin_modal").innerHTML=minutos_fin;
        }else{
            if(valida_fecha(fecha_format)==false){
                return alert("La fecha seleccionada no es válida");
            }
            if(valida_horario(hora_inicio,minutos_inicio,hora_fin,minutos_fin)==false){
                return alert("La hora de inicio debe ser menor a la hora de fin");
            }
        }
    }
}
function valida_horario(hora_inicio,minutos_inicio,hora_fin,minutos_fin){
    if(Number(hora_inicio)<=Number(hora_fin)){
        if(Number(hora_inicio)==Number(hora_fin) && Number(minutos_inicio)>=Number(minutos_fin)){
            return false;
        }
        return true;
    }else{
        alert("mal");
        return false;
    }
}

function capturar_virtual(){
    var fecha=document.getElementById("fecha").value;
    var medio_virtual=document.getElementById("medio_virtual").value;
    var cuenta_virtual=document.getElementById("cuenta_virtual").value;
    if(fecha==""){
        alert("El campo fecha es obligatorio");
    }else{
        if(medio_virtual==""){
            alert("El campo medio virtual es obligatorio");
        }else{
            if(cuenta_virtual==""){
                alert("El campo cuenta virtual es obligatorio");
            }else{
                var fecha_format=formato(fecha);
                if (valida_fecha(fecha_format)==true){
                    $('#ventana').modal('show');
                    document.getElementById("fecha_modal").innerHTML=fecha_format;
                }else
                    return alert("La fecha seleccionada es pasada.");
            }
        }
    }
}