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
   $('div#mensaje').delay(10000).slideUp(1500);

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
        /*var dia = date.getDate();
        var mes = date.getMonth()+1;
        var yyy = date.getFullYear();*/
        //alert("hola");
        var fecha_format=formato(fecha);
        if (valida_fecha(fecha_format)==true){
            $('#ventana').modal('show');
            document.getElementById("fecha_modal").innerHTML=fecha_format;
        }else
            return alert("La fecha seleccionada es pasada.");
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