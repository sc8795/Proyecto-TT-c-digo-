function mostrar_otro_motivo(){
    var motivo=document.getElementsByName("motivo");
    if(motivo[2].checked==true){
        document.getElementById('otro').style.display='block';
    }else{
        document.getElementById('otro').style.display='none';
    }
}