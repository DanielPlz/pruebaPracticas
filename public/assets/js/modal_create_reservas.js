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
        if ($("#estado_boton").length) {

            document.getElementById("prev").style.display = "block";
        }


    } else {
        document.getElementById("prevBtn").style.display = "block";
        document.getElementById("prevBtn").innerHTML = '<i class="fas fa-arrow-left"></i> Atras';
        document.getElementById("prev").style.display = "none";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
        $("#nextBtn").before('<button type="submit" id="submit" class="btn btn-block green white-text text-4"><i class="far fa-calendar-check fa-fw"></i> Enviar</button>');
    } else {
        $("#submit").remove();

        if ($("#estado_boton").length) {
            document.getElementById("button").style.display = "none";
            document.getElementById("nextBtn").style.display = "block";
        } else {
            document.getElementById("nextBtn").style.display = "none";
        }

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
            var servicio = $("#servicio_id").val();
            var modalidad = $("#modalidad").val();
            var prevision = $("#prevision").val();
            var isapre = $("#isapre").val();
            var radio = $('input[name=radio1]:checked').val();
            var validar = window.errorServicio(servicio, errores, modalidad, prevision, isapre, radio);

            if (validar != true) {
                window.mostrarErrores(errores, $ulError);
                valid = false;
            } else {
                $("#mensaje").empty();
                var servicio_id = $("#servicio_id").val();
                var fecha = window.fecha();
                $("#fecha").val(fecha);
                hora_disponible(servicio_id, fecha);
            }
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

$('#rut').focusout(function () {
    var rut = $(this).val();
    if (rut != "") {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
});

/*-----------------------------------------Creacion de datos dinamicos junto con ajax y html-------------------------------------*/
$(document).ready(function () {
    $("#rut").on('change', function () {
        /* validarEmail($("#correo").val()); */
        validar = validarRut($(this).val());
        if (validar != true) {
            document.getElementById("rut").style.borderColor = "red";

        } else {
            document.getElementById("rut").style.borderColor = "";

        }
    })
    var ajax = $.ajax({
        type: "get",
        url: "/llamarUsuario"
    })
    ajax.done(function (respuesta) {
        var dato = JSON.parse(respuesta);

        if (dato != 0) {
            $("#correo").val(dato[1]);
            $("#rut").val(dato[3]);
            numero = dato[2].replace('569', '');
            $("#telefono").val(numero);
        }

    });
    $("#button").on('click', function () {

        document.getElementById("rut").style.borderColor = "red";
        var rut = $("#rut").val();
        var email = $("#correo").val();
        var telefono = $("#telefono").val();
        var codigo = $("#codigo").val();
        validar = validarRut(rut);
        validar = validarEmail(email, validar);
        validar = validarTelefono(telefono, validar);
        if (validar == true) {
            $("#correoD").text(email);
            $("#telefonoD").text(codigo + telefono);
            $("#h1").text("Seleccione su servicio");

            document.getElementById("servicios").style.display = "block";
            $("#nextBtn").before('<input type="hidden" id="estado_boton">');

            document.getElementById("button").style.display = "none";
            document.getElementById("datos_rut").style.display = "none";
            document.getElementById("nextBtn").style.display = "block";
            document.getElementById("prev").style.display = "block";
        }
    })
    $("#prev").on('click', function () {
        document.getElementById("prev").style.display = "none";
        $("#estado_boton").remove();
        $("#h1").text("Identificación del paciente");
        document.getElementById("servicios").style.display = "none";
        document.getElementById("button").style.display = "block";
        document.getElementById("datos_rut").style.display = "block";
        document.getElementById("nextBtn").style.display = "none";
    })
    $("#servicio_id").on('change', function () {
        $("#modalidad_id").remove();
        $("#prevision_id").remove();
        $("#isapre_id").remove();
        $("#radio_b").remove();

        var servicio_id = $(this).val();

        if ($.trim(servicio_id) != '') {

            var $modalidad = $('<div id="modalidad_id" class="mt-1" ><label for="modalidad" class="text-5 darkgray-text text-bold">Modalidad</label>' +
                "<select class='custom-select pl-3 pr-3 mt-1 text-4 bluegray-text' name='modalidad' id='modalidad'></select></div>");
            var $prevision = $('<div id="prevision_id" class="mt-1"><label for="prevision" class="text-5 darkgray-text text-bold">Prevision</label>' +
                "<select class='custom-select pl-3 mt-1 pr-3 text-4 bluegray-text' name='prevision' id='prevision'></select></div>");


            $("#servicios").append($modalidad);
            $("#servicios").append($prevision);
            $("#modalidad").append($("<option value=''>Indica tu modalidad de atencion</option>"));
            $("#prevision").append($("<option value=''>Indica tu Prevision</option>"));
            var ajax = $.ajax({
                type: "get",
                url: "/llamarmodalidad",
                data: {
                    servicio_id: servicio_id
                }
            });


            ajax.done(function (respuesta) {
                var lista = JSON.parse(respuesta);
                var modalidad = lista[0];
                var precio = lista[1];
                var prevision = lista[2];
                for (let i = 0; i < modalidad.length; i++) {
                    $("#modalidad").append($("<option value='" + modalidad[i] + "' class='text-4 bluegray-text'>" + modalidad[i] + "</option>"));

                }
                for (let i = 0; i < prevision.length; i++) {
                    $("#prevision").append($("<option value='" + prevision[i] + "' class='text-4 bluegray-text'>" + prevision[i] + "  Costo:$" + precio[i] + "</option>"));

                }
            });
        }
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
                    
                    if (dato == 0 || dato[0] == "") {
                        var $radio = $("<div class='form-check mt-3'><input class='form-check-input mt-3' type='radio' name='radio1' value='2' checked>" +
                            "<input type='text' id='secundario' placeholder='Ingrese dirección' class='form-control text-4 bluegray-text' required checked></div>");
                        var $div = $('<div class="pl-3 pr-3 mt-3 text-4 bluegray-text" id=radio_b ></div>');
                        $div.append($radio);
                        $("#prevision_id").before($div);
                    } else {
                        var $radio = $("<div class='form-check'><input class='form-check-input mt-3' type='radio' name='radio1' value='1' checked>" +
                            "<input disabled type='text' class='form-control text-4 bluegray-text' value='' id='original' required></div>" +
                            "<div class='form-check mt-3'><input class='form-check-input mt-3' type='radio' name='radio1' value='2'>" +
                            "<input type='text' id='secundario' placeholder='Direccion opcional' class='form-control text-4 bluegray-text' required></div>");


                        var $div = $('<div class="pl-3 pr-3 mt-3 text-4 bluegray-text" id=radio_b ></div>');
                        $div.append($radio);
                        $("#prevision_id").before($div);
                        $("#original").val(dato[0]);

                    }

                });



            }
        });

        $("#prevision").on('change', function () {
            $("#isapre_id").remove();

            //var prevision = $("#prevision option:selected").html();
            var prevision = $(this).val();

            if (prevision == "Isapre") {
                var $isapre = $('<div id="isapre_id" class="mt-1"><label for="isapre" class="text-5 darkgray-text text-bold">Isapre</label>' +
                    "<select class='custom-select pl-3 pr-3 mt-1 text-4 bluegray-text' name='isapre' id='isapre'></select></div>");
                $("#servicios").append($isapre);
                $("#isapre").append($("<option value=''>Indique su Isapre</option>"));
                var ajax = $.ajax({
                    type: "get",
                    url: "/llamarIsapre",
                    data: {
                        servicio_id: servicio_id
                    }
                });

                ajax.done(function (respuesta) {
                    var lista = JSON.parse(respuesta);
                    for (let i = 0; i < lista.length; i++) {
                        $("#isapre").append($("<option value='" + lista[i] + "' class='text-4 bluegray-text'>" + lista[i] + "</option>"));
                    }
                });
            };
        });
    });

    $("#fecha").on('change', function () {
        errores = [];
        var servicio_id = $("#servicio_id").val();
        var fecha = $(this).val();
        errores = [];
        validar = window.validarFecha(fecha, errores);
        if (validar == true) {
            $("#mensaje").empty();
            hora_disponible(servicio_id, fecha);
        } else {
            window.mostrarErrores(errores, $ulError);
            $("#radio_b").remove();
            $("#div_icono").remove();
            var $div = $('<div id="div_icono"><div class="d-flex justify-content-center div-funcion" ><h1><i class="fas fa-user-md"></i></h1></div>' +
                '<div class="d-flex justify-content-center"<label class="col-md-12 text-5 darkgray-text text-bold">No hay citas disponible</label></div></div>');
            $("#contenedor_fecha").append($div);
        }

    });
});
