//función para hacer aparecer caja de texto al escojer otro motivo con el radiobutton
function mostrar_otro_motivo(){
    var motivo=document.getElementsByName("motivo");
    if(motivo[2].checked==true){
        document.getElementById('otro').style.display='block';
    }else{
        document.getElementById('otro').style.display='none';
    }
}