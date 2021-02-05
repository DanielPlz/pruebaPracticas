var currentTabEd = 0; // Current tab is set to be the first tab (0)

function showTabEd(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tabEd");
    document.getElementById("nextBtnEd").disabled = false;
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtnEd").style.display = "none";
    } else {
        document.getElementById("prevBtnEd").style.display = "inline-block";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtnEd").style.display = "none";
        document.getElementById("editS").style.display = "inline-block";
    } else {
        document.getElementById("editS").style.display = "none";
        document.getElementById("nextBtnEd").style.display = "inline-block";
    }
    // ... and run a function that displays the correct step indicator:
    /* fixStepIndicatorEd(n) */
}

function nextPrevEd(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tabEd");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateFormEd()) return false;
    // Hide the current tab:
    x[currentTabEd].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTabEd = currentTabEd + n;
    // if you have reached the end of the form... :
    if (currentTabEd >= x.length) {
        //...the form gets submitted:
        document.getElementById("formEditS").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTabEd(currentTabEd);
}

function validateFormEd() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true, contador = 0;
    x = document.getElementsByClassName("tabEd");
    y = x[currentTabEd].getElementsByClassName("validar");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;
        }
    }
    for(i=0;i<y.length;i++){
        if(!(y[i].checked)){
            contador++;
        }
    }
    if(contador == 3){
        valid = false;
        errorModalidadEd();
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        /* document.getElementsByClassName("stepEd")[currentTab].className += " finish";
        document.getElementsByClassName("line")[currentTab].className += " green"; */
        $("#nombreEd").removeClass("invalid");
        $("#duracionEd").removeClass("invalid");
    }
    return valid; // return the valid status
}

/* function fixStepIndicatorEd(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("stepEd"),
        z = document.getElementsByClassName("line");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";

} */

function errorModalidadEd(){
    var divMsg = document.getElementById("msgErrorEditar");

    $(divMsg).slideDown('slow').html("<div class='alert alert-danger formMsg' role='alert'>° Debe seleccionar al menos una <b>modalidad</b>!</div>");
    window.setTimeout(function(){
        $(divMsg).slideUp('slow').html("");
    },2300)
        
}

function errorPrevisionEd(){
    var divMsg = document.getElementById("msgErrorEditar");

    $(divMsg).slideDown('slow').html("<div class='alert alert-danger formMsg' role='alert'>° Debe seleccionar al menos una <b>previsión</b>!</div>");
    window.setTimeout(function(){
        $(divMsg).slideUp('slow').html("");
    },2300)
        
}

function errorIsapreEd(){
    var divMsg = document.getElementById("msgErrorEditar");

    $(divMsg).slideDown('slow').html("<div class='alert alert-danger formMsg' role='alert'>° Debe seleccionar al menos una <b>isapre</b>!</div>");
    window.setTimeout(function(){
        $(divMsg).slideUp('slow').html("");
    },2300)
        
}