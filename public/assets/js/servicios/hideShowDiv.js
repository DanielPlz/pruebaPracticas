//Función para mostrar el div de servicios 

function mostrarBotones(){
    var swi = document.getElementById("switch");
    var lblEliminar = document.getElementsByName("lblEliminar");
    var lblLength = lblEliminar.length;
    if(swi.value == "off"){
        for(var i=0;i<=lblLength;i++){
            /* $(lblEliminar).slideDown("slow"); */
            $("label[name ='lblEliminar']").css("display", "inline");
            $("label[name ='lblEditar']").css("display", "inline");
        } 

    }
    if(swi.value == "on"){
        for(var i=0;i<=lblLength;i++){
            /* $(lblEliminar).slideUp("slow"); */
            $("label[name ='lblEliminar']").css("display", "none");
            $("label[name ='lblEditar']").css("display", "none");
        } 
    }
    if(swi.value == "off"){
        swi.value = "on";
    }else{
        swi.value = "off";
    }
}

//Función para esconder el div de servicios 

function esconderDiv(){
    //document.getElementById("btnEditar").disabled = false;
    var divS = document.getElementById("divServicios");
    divS.style.display = 'none';
    var lblEliminar = document.getElementsByName("lblEliminar");
    var lblLength = lblEliminar.length;
    for(var i=0;i<=lblLength;i++){
        lblEliminar[i].style.display = 'none';
    } 
}

//Función para ocultar el botón de editar si no coincide el usuario logueado con el perfil  

function botonEditar(idUser,idPerfil){
    var btnEditar = document.getElementById("btnEditar");
    if(idUser==idPerfil){
        btnEditar.style.display = 'none';
    }
}
