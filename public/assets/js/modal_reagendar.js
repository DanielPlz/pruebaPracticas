/*------------------------------Funcionalidades del modal paso a paso relacionadas con tabs-----------------------------------*/
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
var $ulError = $("<ul class='alert alert-warning alert_ul'></ul>");

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
        document.getElementById("prevBtn").innerHTML = '<i class="fas fa-arrow-left"></i> Atras';
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
        $("#nextBtn").before('<button type="submit" id="submit" class="btn btn-block green white-text text-4"><i class="far fa-calendar-check fa-fw"></i> Enviar</button>');
    } else {
        $("#submit").remove();
        document.getElementById("nextBtn").style.display = "inline-block";
        document.getElementById("nextBtn").innerHTML = 'Siguiente <i class="fas fa-arrow-right"></i>';
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
        document.getElementById("modalForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByClassName("form-group");
    switch (currentTab) {
        case 0:
            errores = [];
            console.log($("#modalidad").val(), $("#radio_b").val());
            validar = window.validarVisita($("#modalidad").val(), $('input[name=radio1]:checked').val(), errores);
            if (validar == true) {
                $("#mensaje").empty();
                $("#mensaje").empty();
                var servicio_id = $("#servicio_id").val();
                var fecha = window.fecha();
                $("#fecha").val(fecha);
                hora_disponible(servicio_id, fecha);
            } else {
                window.mostrarErrores(errores, $ulError);
                valid = false;
            };
            break;
        case 1:
            errores = [];
            var input_fecha = $("#fecha").val();
            var fecha = window.fecha();
            var input_hora = $('input[name=radio_horas]:checked').val();


            var validar = window.errorFecha(input_hora, input_fecha);
            if (validar == true) {
                $("#mensaje").empty();
                window.llamarHora(input_hora, servicio_id);
                var ajax = $.ajax({
                    type: "get",
                    url: "/llamarPrecio",
                    data: {
                        servicio_id: $("#servicio_id").val(),
                        prevision: $("#prevision").val()
                    }
                });
                ajax.done(function (respuesta) {
                    var precio = JSON.parse(respuesta);
                    for (let i = 0; i < precio.length; i++) {
                        $("#precio").val(precio[i]);
                        $("#precioD").text("$" + precio[i]);

                    }

                    if ($("#modalidad").val() == "Presencial") {
                        $("#direccion").val("Presencial");
                        $("#direccionD").text("Presencial");

                    }
                    if ($("#modalidad").val() == "Online") {
                        $("#direccion").val("Online");
                        $("#direccionD").text("Online");

                    }

                });

                $("#servicioD").text($("#servicio_id option:selected").html());
                $("#modalidadD").text($("#modalidad").val());
                $("#fechaD").text($("#fecha").val());
                $("#hora_inicioD").text(input_hora);

                if ($("#prevision").val() == "Isapre") {
                    $("#previsionD").text($("#prevision").val() + "(" + $("#isapre").val() + ")");
                } else {
                    $("#previsionD").text($("#prevision").val());
                }


            } else {
                window.mostrarErrores(errores, $ulError);
                valid = false;
                break;
            }

    };
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
        document.getElementsByClassName("line")[currentTab].className += " green";
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

/*-----------------------------------------Creacion de datos dinamicos junto con ajax y html-------------------------------------*/
$(document).ready(function () {
    $("#modalidad").on('change', function () {
        $("#radio_b").remove();
        var locacion = $(this).val();
        if (locacion == "Visita") {
            var ajax = $.ajax({
                type: "get",
                url: "/llamarUsuario"
            })
            ajax.done(function (respuesta) {
                var dato = JSON.parse(respuesta);
                var $radio = $("<div class='form-check'><input class='form-check-input mt-3' type='radio' name='radio1' value='1' checked>" +
                    "<input disabled type='text' class='form-control text-4 bluegray-text' value='' id='original' required></div>" +
                    "<div class='form-check mt-3'><input class='form-check-input mt-3' type='radio' name='radio1' value='2'>" +
                    "<input type='text' id='secundario' placeholder='Direccion opcional' class='form-control text-4 bluegray-text' required></div>");

                var $div = $('<div class="pl-3 pr-3 mt-3 text-4 bluegray-text" id=radio_b ></div>');
                $div.append($radio);
                $("#prevision_id").before($div);
                $("#original").val(dato);
            });
        }
    });
    $("#fecha").on('change', function () {
        var servicio_id = $("#servicio_id").val();
        var fecha = $(this).val();
        hora_disponible(servicio_id, fecha);
    });
});