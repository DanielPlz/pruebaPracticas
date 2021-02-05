/**
 * Script para realizar diferentes validaciones a los datos ingresados
 * en los formularios; como formatos de correo, letras, numeros y
 * campos vacios.
 */

//Obtener formulario
var form = document.getElementById("formulario");

/**
 * Metodo ajax para verificar que no se repita el rut ingresado
 * Se utiliza el selector del input rut para realizar la 
 * verificacion con el metodo blur y llamar al controlador de
 * registro
 */
$('#rut').blur(function(){
    $.ajax({
        url: '/register/rut',
        method: 'POST',
        data:{
            rut:$('input[name="rut"]').val(),
            _token:$('input[name="_token"]').val(),
        },
        error:function(data)
        {
            $('#rut').attr('style','border: 1px solid #ff0000');
            $('#msgRun').text("El rut esta en uso");
            $('#msgRun').show().html(data.responseJSON.error).css({
                'color': 'red',
                'text-align': 'center'
            })},
        success:function(data)
        {
            //
        }
    })
});
/**
 * Metodo para verificar que ninguno de los campos del formulario no esten vacios.
 * Se le asigna una funcion al boton "submit" del formulario, se capturan todos los
 * campos del formulario y se analiza que no esten vacios y si lo estan se devolvera
 * un valor false. Luego se valida que el rut y correo tengan la estructura correcta, de
 * lo contrario se devuelve un valor false.
 */
form.addEventListener(
    "submit",
    function (event) {
        event.preventDefault();
        var form_correcto = true,
            elementos = this.elements,
            total = elementos.length,
            run=document.getElementById('rut').value,
            email=document.getElementById('email').value;

        /**
         * Ciclo que verifica cada elemento del formulario para validar si no esta vacio y si lo esta
         *coloca su borde de color rojo y cambia la variable form_correcto a false.
         */
        for (var i = 0; i < total; i++) {
            elementos[i].setAttribute("style", "border: 1px solid #ced4da");
            if (!elementos[i].value.trim().length) {
                if (
                    elementos[i].type != "checkbox" &&
                    elementos[i].type != "submit"
                ) {
                    elementos[i].setAttribute(
                        "style",
                        "border: 1px solid #ff0000"
                    );
                    form_correcto = false;
                }
            }
        }

        if (form_correcto) {
            //alert("Usuario registrado exitosamente");
            if(valRun((run))===false){
                document
                .getElementById("rut")
                .setAttribute("style", "border: 1px solid #ff0000");
                alert('El rut no es valido');
            }else{
                if(valCorreo(email)===false){
                    document
                    .getElementById("email")
                    .setAttribute("style", "border: 1px solid #ff0000");
                    alert('El email no es valido');
                }else{
                    this.submit();
                }
            }
        } else {
            alert("Complete todos los campos");
        }
    },
    false
);

/**
 * Metodo para validar que rut ingresado sea validado segun el algoritmo 
 * para de verificacionm (SOLO SE VERIFICA QUE SEA VALIDO, NO QUE SI EXISTA).
 * Cuano el rut no es valido se devuelve un valor false y se remarca el borde
 * del campo rut con color rojo (#ff0000).
 * @param {rut del input a validar} run
 */
function valRun(run) {
    var msgRun = "";
    var runText="";
    var runText = run.split("-");
    var confirm =false;
    document
        .getElementById("rut")
        .setAttribute("style", "border: 1px solid #ced4da");
    //Codicional para que verifica que se ingreso el -
    if (runText.length < 2) {
        document
            .getElementById("rut")
            .setAttribute("style", "border: 1px solid #ff0000");
    } else {
        //Algoritmo de verificacion de rut
        var runDiv = runText[0].split("");
        var serie = 2;
        var suma = 0;
        var resultParcial;
        var resultado;
        for (var i = runDiv.length - 1; i >= 0; i--) {
            if (serie == 8) {
                serie = 2;
            }
            var prod = runDiv[i] * serie;
            suma = suma + prod;
            serie++;
        }
        var resultParcial = suma % 11;
        var resultado = 11 - resultParcial;
        if (resultado == runText[1] || resultado == 10) {
            //Rut valido
            confirm=true;
        } else {
            //Rut incorrecto
            document
                .getElementById("rut")
                .setAttribute("style", "border: 1px solid #ff0000");
        }
        //Validacion aparte de rut 11111111-1 y demas
        var runInva = 0;
        for(var x = 1; x<9; x++){
            for (var i = runDiv.length - 1; i >= 0; i--) {
                if(runDiv[i]==x){
                    runInva++;
                }
            }
            if(runText[1]==x){
                runInva++;
            }
        }
        if(runInva==9){
            document
                .getElementById("rut")
                .setAttribute("style", "border: 1px solid #ff0000");  
        }
        
    }
    document.getElementById("msgRun").innerHTML = msgRun;
    return confirm;
}

/**
 * Metodo para validar numero del rut
 * @param {tecla del input} e
 */
function soloNumerosRut(e) {
    var rut = document.getElementById("rut").value;
    if (rut.length < 8) {
        var key = window.Event ? e.which : e.keyCode;
        return key >= 48 && key <= 57;
    } else {
        var key = e.keyCode || e.which;
        var teclado = String.fromCharCode(key).toLowerCase();
        var letra = "-";
        if (rut.length < 9) {
            if (letra.indexOf(teclado) == -1) {
                return false;
            }
        } else {
            letra = "12345678k";
            if (letra.indexOf(teclado) == -1) {
                return false;
            }
        }
    }
}

/**
 * Metodo para validar el correo, se retorna un valor false si esta incorrecto,
 * y de lo contrario se envia un valor true. Se realiza mediante las condiciones
 * de que el correo ingresado tenga una estructura de correo 
 * con @ y . separador de dominio
 * @param {Valor del email en el input} email
 */
function valCorreo(email) {
    var valido=false,
    arroba = email.split("@");
    document
        .getElementById("email")
        .setAttribute("style", "border: 1px solid #ff0000");
    if (arroba.length == 2) {
        var punto = arroba[1].split(".");
        if (punto.length >= 2) {
            if (punto[1].length >= 2) {
                valido=true;
                document
                    .getElementById("email")
                    .setAttribute("style", "border: 1px solid #ced4da");
            }
        }
    }
    return valido;
}

/**
 * Metodo para permitir solo letras con o sin espacios
 * @param {Evento de una tecla} e
 * @param {True para no permitir espacios o false de lo contrario} espace
 */
function sololetras(e, espace) {
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase();
    letras = "qwertyuiopasdfghjklñzxcvbnm ";
    especiales = "8-37-38-46-164";
    teclado_especial = false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            teclado_especial = true;
            break;
        }
    }

    if (espace == true) {
        if (e.keyCode == 32) {
            return false;
        }
    }

    if (letras.indexOf(teclado) == -1 && !teclado_especial) {
        return false;
    }
}

/**
 * Metodo para validar que solo se ingresen numeros, se recibe la tecla
 * oprimida para verificar si la key corresponde a un numero y es que no
 * se devuelve un valor false, lo que no permite que se ingrese el caracter
 * @param {Tecla oprimida} e
 */
function soloNumeros(e) {
    var key = window.Event ? e.which : e.keyCode;
    return key >= 48 && key <= 57;
}
