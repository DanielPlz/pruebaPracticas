
function validar(f){
    var cont = 0, sw = true, contIs = 0, sw2 = true;
    var checkPrevision = document.getElementsByClassName("validarPrevision");
    var vp = document.getElementsByClassName("validarPrecio");
    var checkIsapre = document.getElementById("checkIsapre");
    var checkIsapres = document.getElementsByClassName("isapres");

    for(x=0;x<checkPrevision.length;x++){
        if(!(checkPrevision[x].checked)){
            cont++;
        }
    }

    if(cont == 3){
        sw = false;
        errorPrevision();
    }

    for (i = 0; i < vp.length; i++) {
        // If a field is empty...
        if (vp[i].value == "") {
            // add an "invalid" class to the field:
            vp[i].className += " invalid";
            // and set the current valid status to false:
            sw = false;
        }
    }

    if (checkIsapre.checked){
        for(x=0;x<checkIsapres.length;x++){
            if(checkIsapres[x].checked){
                contIs++;
            }
        }
        if(contIs == 0){
            sw2 = false;
            errorIsapre();
        }
    }
    
    if(sw && sw2){
        return true;
    }
    return false;
}
                   