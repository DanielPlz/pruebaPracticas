/*------------------------------Funciones del modal---------------------------------*/

//funcion para mostrar los errores de los modals
window.mostrarErrores = function (error, $ulError) {
    $ulError.empty();
    for (var i = 0; i < errores.length; i++) {

        $ulError.append("<li>" + error[i] + "</li>");
    };
    $("#mensaje").append($ulError);
};
//Valida cuando al seleccionar la modalidad de visita, los input no esten vacios
window.validarVisita = function (modalidad, radio, errores) {
    flag = true;
    if (modalidad == "Visita" && radio == 1) {
        $("#direccion").val($("#original").val());
        $("#direccionD").text($("#original").val());

    }
    if (modalidad == "Visita" && radio == 2) {
        if ($("#secundario").val() != "") {
            $("#direccion").val($("#secundario").val());
            $("#direccionD").text($("#secundario").val());


        } else {
            flag = false;
            errores.push("Ingrese direccion");
        }
    }
    return flag;
}
//validar checkbox
$(document).ready(function () {
    $("#modalForm").submit(function () {

        var condiciones = $("#condicionesid").is(":checked");
        errores = [];
        if (!condiciones) {
            errores.push("Debe aceptar las condiciones");
            window.mostrarErrores(errores, $ulError);
            return false;
        } else {
            return true;
        }
    });
});
//funcion para validar el campo de los servicios
window.errorServicio = function (servicio, errores, modalidad, prevision, isapre, radio) {
    flag = true;

    if (servicio == "") {
        flag = false;

        errores.push("Ingrese servicio");

    } else {
        if (modalidad == "") {
            flag = false;
            console.log("modalidad");
            errores.push("Ingrese la modalidad");
        } else {
            if (modalidad == "Visita" && radio == 1) {
                $("#direccion").val($("#original").val());
                $("#direccionD").text($("#original").val());

            }
            if (modalidad == "Visita" && radio == 2) {
                if ($("#secundario").val() != "") {
                    $("#direccion").val($("#secundario").val());
                    $("#direccionD").text($("#secundario").val());


                } else {
                    flag = false;
                    errores.push("Ingrese direccion");
                }
            }


        }
        if (prevision == "") {
            flag = false;
            errores.push("Ingrese su prevision");
        } else {
            if (prevision == 'Isapre' && isapre == "") {
                flag = false;
                errores.push("Ingrese su Isapre");
            }
        }
    };
    return flag;
};

//funcion para validar los campos de fecha y hora
window.errorFecha = function (input_hora, input_fecha) {
    flag = true;

    if (input_fecha == "") {
        flag = false;
        errores.push("Ingrese fecha.");
    } else {
        if (input_hora == null) {
            flag = false;
            errores.push("Seleccione hora de su cita.");
        }
    }


    return flag;
};

//se calculan las horas para sumar la hora ingresada con la hora de duracion del servicio
window.calcularHora = function (input_hora, horaTermino) {

    //se separan las partes de las horas
    var input_hora_partes = input_hora.split(':');
    var horaCompleta = horaTermino.split(':');

    //se parsea a float las horas, minutos y segundos
    var horas = parseFloat(horaCompleta[0]);
    var minutos = parseFloat(horaCompleta[1]);
    var segundos = parseFloat(horaCompleta[2]);

    //se convierten los horas y minutos en segundos
    var horas_Segundos = (horas * 3600);
    var minutos_Segundos = (minutos * 60);
    var segundoss = segundos + minutos_Segundos + horas_Segundos;

    //se convierten las horas y minutos en segundos del segundo valor
    var horas_segundo_s = (parseFloat(input_hora_partes[0]) * 3600);
    var minutos_segundo_s = (parseFloat(input_hora_partes[1]) * 60);
    var segundo_s = minutos_segundo_s + horas_segundo_s;

    //se suman la hora ingresada de inicio y la hora de duracion del servicio
    var hours = (Math.floor(segundoss / 3600)) + (Math.floor(segundo_s / 3600));
    var minutes = (Math.floor((segundoss % 3600) / 60)) + (Math.floor((segundo_s % 3600) / 60));
    var seconds = "00";
    if (minutes >= 60) {
        hours = hours + 1;
        minutes = minutes - 60;
    }
    hours = hours < 10 ? '0' + hours : hours;
    //Anteponiendo un 0 a los minutos si son menos de 10 
    minutes = minutes < 10 ? '0' + minutes : minutes;

    var result = hours + ":" + minutes + ":" + seconds;
    return result;
};

// funcion para obtener fecha actual
window.fecha = function () {
    var fecha = new Date();
    var dd = fecha.getDate();
    var mm = fecha.getMonth() + 1;
    var yyyy = fecha.getFullYear();

    fecha = yyyy + "-" + mm + "-" + (dd < 10 ? '0' + dd : dd);
    return fecha;
}

//Funcion para validar el input fecha
window.validarFecha = function (fecha, errores) {
    var fechaActual = window.fecha();
    flag = true;
    if (fecha < fechaActual) {
        errores.push("ingrese fecha igual o mayor a la actual");
        flag = false;
    }
    return flag;
}

// Funcion para obtener y mostrar la hora termino de las citas seleccionadas
window.llamarHora = function (input_hora) {

    var ajax = $.ajax({
        type: "get",
        url: '/llamarServicios',
        data: {
            servicio_id: $("#servicio_id").val()
        }
    });

    ajax.done(function (respuesta) {
        var lista = JSON.parse(respuesta);
        var duracion = lista[0].duracion;

        
        var resultadoHora = window.calcularHora(input_hora, duracion);
        $("#termino").val(resultadoHora);
        $("#hora_terminoD").text(resultadoHora);



    });
}

//Funcion para obtener las horas disponibles de la fecha seleccionada
function hora_disponible(servicio_id, fecha) {
    $("#radio_b").remove();
    $("#div_icono").remove();
    var ajax = $.ajax({
        type: "GET",
        url: "/llamarHora",
        data: {
            servicio_id: servicio_id,
            fecha: fecha,
        }
    })
    ajax.done(function (respuesta){
        var lista = JSON.parse(respuesta);
        if (lista.length == 0) {
            var $div = $('<div id="div_icono"><div class="d-flex justify-content-center div-funcion" ><h1><i class="fas fa-user-md"></i></h1></div>' +
                '<div class="d-flex justify-content-center"<label class="col-md-12 text-5 darkgray-text text-bold">No hay citas disponible</label></div></div>');
        } else {
            var $div = $('<div class="wrap" id=radio_b ></div>');
            var $div_radio = $('<div class="radio_button"></div>');
            for (var i = 0; i < lista.length; i++) {
                var dato = lista[i];
                var $radio = $("<input  type='radio' name='radio_horas' id='" + dato + "' value='" + dato + "'>" +
                    "<label for ='" + dato + "'>" + dato + "</label>");
                $div_radio.append($radio);
            }
            $div.append($div_radio);
        }
        $("#contenedor_fecha").append($div);
    });
}
//Valida y solo acepta el formato que se especifica en esta función
function validarEmail(valor,flag) {
    if (/^\w+([\.-]?\w+)*@(?:|hotmail|outlook|yahoo|live|gmail)\.(?:|com|es|cl)+$/.test(valor)) {
        document.getElementById("correo").style.borderColor = "";
    } else {
        flag = false;
        document.getElementById("correo").style.borderColor = "red";
    }
    return flag;
}
//Valida que el campo de telefono no esté vacio
window.validarTelefono = function(telefono,flag){
    if(telefono == ""){
        flag=false;
        document.getElementById("telefono").style.borderColor = "red";
    }else{
        document.getElementById("telefono").style.borderColor = "";
    }
    return flag;
}
//valida si el campo rut no esta vacio y que el rut sea valido y real
window.validarRut = function (rut) {

    var flag = true;
    var valor = rut.replace('.', '');
    valor = valor.replace('.', '');
    valor = valor.replace('-', '');
    cuerpo = valor.slice(0, -1);
    dv = valor.slice(-1).toUpperCase();
    rut = cuerpo + '-' + dv
    if (cuerpo.length < 7) {
        flag = false;
        document.getElementById("rut").style.borderColor = "red";
    }

    suma = 0;
    multiplo = 2;
    for (i = 1; i <= cuerpo.length; i++) {
        index = multiplo * valor.charAt(cuerpo.length - i);
        suma = suma + index;
        if (multiplo < 7) {
            multiplo = multiplo + 1;
        } else {
            multiplo = 2;
        }
    }
    dvEsperado = 11 - (suma % 11);
    dv = (dv == 'K') ? 10 : dv;
    dv = (dv == 0) ? 11 : dv;
    if (dvEsperado != dv) {
        flag = false;
        
    }

    if(flag == true){
        document.getElementById("rut").style.borderColor = "";
        $("#rutD").text(cuerpo+dv);
        $("#rutDa").val(cuerpo+dv);
    }else{
        document.getElementById("rut").style.borderColor = "red";
    }
    
    return flag;
};
