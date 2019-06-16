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

//función para hacer aparecer caja de texto al escojer completar registro mediante la etiqueta a
$(document).ready(function(){ 
    $('#completar').on('click',function(){
       $('#contenedor_general').toggle('slow');
    });
 });