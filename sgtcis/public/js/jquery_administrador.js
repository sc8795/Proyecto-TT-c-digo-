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
function revisar(elemento){
    if(elemento.value==''){
        elemento.className='form-control error';
    }else{
        elemento.className='form-control';
    }
}
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
    var c1 = document.getElementById('paralelo_a').checked;
    var c2 = document.getElementById('paralelo_b').checked;
    var c3 = document.getElementById('paralelo_c').checked;
    var c4 = document.getElementById('paralelo_d').checked;
    if(c1==false && c2==false && c3==false && c4==false){
        datosCorrectos=false;
        error=" El campo paralelo es obligatorio.";
    }
    if(!datosCorrectos){
        alert('¡AVISO!'+error);
    }
    return datosCorrectos;
}