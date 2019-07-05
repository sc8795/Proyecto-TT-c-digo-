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
        alert('¡AVISO!'+error);
    }
    return datosCorrectos;
}

$('div#mensaje').delay(4000).slideUp(1500);
