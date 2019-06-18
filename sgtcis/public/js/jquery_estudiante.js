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
        /* .show() */
       $('#contenedor_general').toggle('slow');
    });
});
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