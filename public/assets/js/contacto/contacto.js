$(document).ready(function () {

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
    
    
            case (!/^\w+([\.-]?\w+)*@(?:|hotmail|outlook|yahoo|live|gmail)\.(?:|com|es|cl)+$/.test($("#correo").val())):
                mensaje.push({
                    "nombre": "correo",
                    "mensaje": "Ingrese correo valido"
                });
                break;
    
        }
        if($("#region").val() ==""){
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
            if($("#calle").val() ==""){
                mensaje.push({
                    "nombre": "calle",
                    "mensaje": "Ingrese calle"
                });
            }
            if($("#numcasa").val() ==""){
                mensaje.push({
                    "nombre": "numcasa",
                    "mensaje": "Ingrese numero de casa"
                });
            }
            if($("#numdepto").val() ==""){
                mensaje.push({
                    "nombre": "numdepto",
                    "mensaje": "Ingrese numero de depto"
                });
            }
        }
        var flag = window.alert(mensaje);
        return flag;
    };

    $("#form_contacto").submit(function () {
        var flag = window.validar();
      
        if (flag == true) {
          
            flag = window.validarRut($("#rut2").val); 
            if(flag == true){
                return true;
            }else{
                
                return false;
            }
           
        } else {
            
            return false;
          
            
        }
    });

  

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
        return flag;
    };

    var lista = window.regiones();
    var regiones = lista["regiones"];
    for (let i = 0; i < regiones.length; i++) {
        console.log("ayuda");
        var region = regiones[i];

        $("#select_regiones").append('<option value = "' + region.NombreRegion + '" >' + region.NombreRegion + '</option>');

    }

    console.log("distinto");


    $("#select_regiones").on('change', function () {
        $("#comuna").remove();
        $("#labelComuna").remove();
        $("#direccion").remove();
        $("#labelDireccion").remove();
        var valor = $(this).val();

        for (let i = 0; i < regiones.length; i++) {
            var region = regiones[i];

            if (region.NombreRegion == valor) {
                var comunas = region.comunas;
                $("#select_comunas").append($('<label for="comuna" id="labelComuna" class="text-5 darkgray-text text-bold">Comuna</label>' +
                    '<select class="custom-select text-4 bluegray-text" name="comuna" id="comuna">' +
                    '<option class="text-4 bluegray-text" value="">----Seleccione comuna----</option></select>'));
               
                for (let f = 0; f < comunas.length; f++) {
                    var comuna = comunas[f];
                    $("#comuna").append($('<option value="' + comuna + '">' + comuna + '</option>'));
                }
            }
        }
        $("#comuna").append($('<option value="otro">Otro</option>'));
    });

    var lista = window.regiones();
    console.log(lista);

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');
    
    allWells.hide();
    
    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);
    
        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });
    
    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;
    
        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
               
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }
    
        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });
    
    $('div.setup-panel div a.btn-primary').trigger('click');
    });