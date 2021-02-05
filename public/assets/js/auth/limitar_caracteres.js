/**
 * Script que obtiene los datos de los campos del formulario
 * para luego poder limitar la cantidad de caracteres, por
 * medio de la funcion limitarCaracter().
 */

//Array para obtener los campos del formulario
var inputs = [
    (rut = document.getElementById("rut")),
    (nombre = document.getElementById("nombre")),
    (apellido_pa = document.getElementById("apellido_pa")),
    (apellido_ma = document.getElementById("apellido_ma")),
    (email = document.getElementById("email")),
    (contraseña = document.getElementById("contraseña")),
    (contraseña = document.getElementById("contraseña_conf")),
];

/*Ciclo para limitar los caracteres de los campos,
segun corresponda y mientras existan en el formulario*/
inputs.forEach((campo) => {
    if (campo != null) {
        switch (campo.id) {
            case "rut":
                limitarCaracter(campo, 10);
                break;
            case "nombre":
                limitarCaracter(campo, 45);
                break;
            case "apellido_pa":
                limitarCaracter(campo, 45);
                break;
            case "apellido_ma":
                limitarCaracter(campo, 45);
                break;
            case "email":
                limitarCaracter(campo, 100);
                break;
            case "contraseña":
                limitarCaracter(campo, 16);
                break;
            case "contraseña_conf":
                limitarCaracter(campo, 16);
                break;
        }
    }
});

/**
 * Metodo para limitar la cantidad de caracteres del campo
 * @param {Campo para limitar} input
 * @param {Limite maximo del campo} limite
 */
function limitarCaracter(input, limite) {
    input.addEventListener("input", function () {
        if (this.value.length > limite)
            this.value = this.value.slice(0, limite);
    });
}
