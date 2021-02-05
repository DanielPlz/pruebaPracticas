var $avatarInput, $avatarform, $avatarImage, $avatarProfile;
var avatarUrl;
$(function () {

    $avatarInput = $('#file');
    $avatarform = $('#update');
    $avatarImage = $("#imagen_id");
    $avatarProfile = $("#profile_id");
    avatarUrl = $avatarform.attr('action');
    $avatarInput.on('change', function () {
        var formData = new FormData();
        formData.append('file', $avatarInput[0].files[0]);
        console.log(formData);
        $.ajax({
                url: avatarUrl + '?' + $avatarform.serialize(),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false
            })
            .done(function (data) {
                if (data.success) {
                    $avatarImage.attr('src', data.file_name + '?' + new Date().getTime());
                    $avatarProfile.attr('src', data.file_name + '?' + new Date().getTime());
                }
            })
            .fail(function () {
                alert('la imagen subida no tiene formato correcto');
            });
    });
});
window.alert = function (dato) {
    for (let i = 0; i < dato.length; i++) {
        if ("#" + dato[i].nombre + "_valid") {
            $("#" + dato[i].nombre + "_valid").remove();
            $("#" + dato[i].nombre + "_div").append($('<span class="invalid-feedback" role="alert" style="display:block;" id="' + dato[i].nombre + '_valid"><strong>' + dato[i].mensaje + '</strong></span>'));
        } else {
            $("#" + dato[i].nombre + "_div").append($('<span class="invalid-feedback" role="alert" style="display:block;" id="' + dato[i].nombre + '_valid"><strong>' + dato[i].mensaje + '</strong></span>'));
        }
        setTimeout(function () {
            $("#" + dato[i].nombre + "_valid").fadeOut(1500);
        }, 1500);
        setTimeout(function () {
            $("#" + dato[i].nombre + "_valid").remove();
        }, 4000);
        
    }
    if(dato.length == 0){
        return true;
    }else{
        return false;
    }
}
window.validar = function () {
    mensaje = [];
    if ($("#nombre").val() == "") {
        mensaje.push({
            "nombre": "nombre",
            "mensaje": "Ingrese nombre"
        });
    }
    if ($("#apellido").val() == "") {
        mensaje.push({
            "nombre": "apellido",
            "mensaje": "Ingrese apellido"
        });
    }
    if ($("#telefono").val() == "") {
        mensaje.push({
            "nombre": "telefono",
            "mensaje": "Ingrese telefono"
        });
    }
    switch (true) {
        case ($("#correo").val() == ""):
            mensaje.push({
                "nombre": "correo",
                "mensaje": "Ingrese correo"
            });
            break;


        case (!/^\w+([\.-]?\w+)*@(?:|hotmail|outlook|yahoo|live|gmail|services)\.(?:|com|es|cl|lef)+$/.test($("#correo").val())):
            mensaje.push({
                "nombre": "correo",
                "mensaje": "Ingrese correo valido"
            });
            break;

    }
    if($("#select").val() ==""){
        mensaje.push({
            "nombre": "region",
            "mensaje": "Seleccione Region"
        });
    }else{
        if($("#comuna").val() ==""){
            mensaje.push({
                "nombre": "comuna",
                "mensaje": "Seleccione comuna"
            });
        }
        if($("#direccion").val() ==""){
            mensaje.push({
                "nombre": "direccion",
                "mensaje": "Ingrese dirección"
            });
        }
    }
    var flag =window.alert(mensaje);
    return flag;
};
$(document).ready(function () {
    $("#form_datos").submit(function () {
        var flag = window.validar();
        if (flag == true) {
            return true;
        } else {
            return false;
        }
    });
    $("#editar_password").on("click", function () {
        document.getElementById("password").style.display = "flex";
        /* document.getElementById("editar_password").style.display = "none"; */
    });
    $("#new_show").mousedown(function () {
        $("#contraseña").removeAttr("type");
        $("#new_show").addClass("fa-eye-slash").removeClass("fa-eye");
    });
    $("#new_show").mouseup(function () {
        $("#contraseña").attr("type", "password");
        $("#new_show").addClass("fa-eye").removeClass("fa-eye-slash");
    });
    $("#actual_show").mousedown(function () {
        $("#actualContraseña").removeAttr("type");
        $("#actual_show").addClass("fa-eye-slash").removeClass("fa-eye");
    });
    $("#actual_show").mouseup(function () {
        $("#actualContraseña").attr("type", "password");
        $("#actual_show").addClass("fa-eye").removeClass("fa-eye-slash");
    });
    $("#val_show").mousedown(function () {
        $("#val_contraseña").removeAttr("type");
        $("#val_show").addClass("fa-eye-slash").removeClass("fa-eye");
    });
    $("#val_show").mouseup(function () {
        $("#val_contraseña").attr("type", "password");
        $("#val_show").addClass("fa-eye").removeClass("fa-eye-slash");
    });
    var text = document.getElementById('val_contraseña');
    var text2 = document.getElementById('contraseña');
    text.addEventListener('keyup', (event) => {
        if (event.path[0].value == $("#contraseña").val()) {

            document.getElementById("valid_valid").style.display = "none";
        } else {
            document.getElementById("valid_valid").style.display = "block";
        }
    });
    text2.addEventListener('keyup', (event) => {
        if (event.path[0].value == $("#val_contraseña").val()) {

            document.getElementById("valid_valid").style.display = "none";
        } else {
            document.getElementById("valid_valid").style.display = "block";
        }
    });
    $("#editar_datos").on("click", function () {
        document.getElementById("ul_datos").style.display = "block";
        document.getElementById("div_datos").style.display = "none";
    });
    $("#cancelar_datos").on("click", function () {
        document.getElementById("ul_datos").style.display = "none";
        document.getElementById("div_datos").style.display = "block";
    });

    $("#update_password").on("click", function () {
        var actualContraseña = $("#actualContraseña").val();
        var contraseña = $("#contraseña").val();
        var val_contraseña = $("#val_contraseña").val();
        var _token = $('input[name=_token]').val();
        var flag = true;
        if (contraseña != val_contraseña) {
            flag = false;
        }
        switch (flag) {
            case (true):
                document.getElementById("valid_valid").style.display = "none";
                $.ajax({

                        type: "post",
                        url: "/updatePassword",
                        data: {
                            _token: _token,
                            actualContraseña: actualContraseña,
                            contraseña: contraseña,
                            val_contraseña: val_contraseña
                        }
                    })
                    .done(function (data) {
                        switch (data.success) {
                            case (true):
                                document.getElementById("valid_actual").style.display = "none";
                                document.getElementById("password").style.display = "none";
                                $("#val_contraseña").val("");
                                $("#contraseña").val("");
                                $("#actualContraseña").val("");
                                $("#div_password").append($('<div class="col-md-12 alert alert-secondary alert-success" id="alert" role="alert">Se actualizo su contraseña</div>'));
                                setTimeout(function () {
                                    $("#alert").fadeOut(1500);
                                }, 1500);
                                setTimeout(function () {
                                    $("#alert").remove();
                                }, 4000);
                                break;
                            case (false):
                                document.getElementById("valid_actual").style.display = "block";
                                break;
                        }
                    })
                    .fail(function () {

                    });
                break;
        }
    });
    $("#cancelar_update").on("click", function () {
        document.getElementById("password").style.display = "none";
        document.getElementById("valid_actual").style.display = "none";
        document.getElementById("valid_valid").style.display = "none";
        $("#val_contraseña").val("");
        $("#contraseña").val("");
        $("#actualContraseña").val("");
    });
    var lista = window.regiones();
    var regiones = lista["regiones"];
    for (let i = 0; i < regiones.length; i++) {
        var region = regiones[i];

        $("#select").append('<option value = "' + region.NombreRegion + '" >' + region.NombreRegion + '</option>');

    }
    $("#select").on('change', function () {
        $("#comuna").remove();
        $("#labelComuna").remove();
        $("#direccion").remove();
        $("#labelDireccion").remove();
        var valor = $(this).val();

        for (let i = 0; i < regiones.length; i++) {
            var region = regiones[i];

            if (region.NombreRegion == valor) {
                var comunas = region.comunas;
                $("#comuna_div").append($('<label for="comuna" id="labelComuna" class="text-5 darkgray-text text-bold">Comuna</label>' +
                    '<select class="custom-select text-4 bluegray-text" name="comuna" id="comuna">' +
                    '<option class="text-4 bluegray-text" value="">----Seleccione comuna----</option></select>'));
                $("#direccion_div").append($('<label for="direccion" id="labelDireccion" class="text-5 darkgray-text text-bold">Direccion</label>' +
                    '<input type="text" placeholder="Direccion" class="form-control text-4 bluegray-text" id="direccion" name="direccion" value="" autocomplete="direccion">'));
                for (let f = 0; f < comunas.length; f++) {
                    var comuna = comunas[f];
                    $("#comuna").append($('<option value="' + comuna + '">' + comuna + '</option>'));
                }
            }
        }
        $("#comuna").append($('<option value="otro">Otro</option>'));
    });
});
