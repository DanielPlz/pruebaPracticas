var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    document.getElementById("nextBtn").disabled = false;
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline-block";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("addS").style.display = "inline-block";
    } else {
        document.getElementById("addS").style.display = "none";
        document.getElementById("nextBtn").style.display = "inline-block";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("formAddS").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true, contador = 0;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByClassName("validar");
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
        errorModalidad();
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
        document.getElementsByClassName("line")[currentTab].className += " green";
        $("#nombre").removeClass("invalid");
        $("#duracion").removeClass("invalid");
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step"),
        z = document.getElementsByClassName("line");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";

}

function errorModalidad(){
    var divMsg = document.getElementById("msgError");

    $(divMsg).slideDown('slow').html("<div class='alert alert-danger formMsg' role='alert'>° Debe seleccionar al menos una <b>modalidad</b>!</div>");
    window.setTimeout(function(){
        $(divMsg).slideUp('slow').html("");
    },2300)
        
}

function errorPrevision(){
    var divMsg = document.getElementById("msgError");

    $(divMsg).slideDown('slow').html("<div class='alert alert-danger formMsg' role='alert'>° Debe seleccionar al menos una <b>previsión</b>!</div>");
    window.setTimeout(function(){
        $(divMsg).slideUp('slow').html("");
    },2300)
        
}

function errorIsapre(){
    var divMsg = document.getElementById("msgError");

    $(divMsg).slideDown('slow').html("<div class='alert alert-danger formMsg' role='alert'>° Debe seleccionar al menos una <b>isapre</b>!</div>");
    window.setTimeout(function(){
        $(divMsg).slideUp('slow').html("");
    },2300)
        
}