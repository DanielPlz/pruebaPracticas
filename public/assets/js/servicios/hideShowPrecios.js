//Mostar/ocultar precio fonasa
$( "#checkFonasa" ).click(function() {
    if ( $(this).is(':checked') ){
         $("#precioFonasa").css("display", "inline"); 
         $("#precioFonasa").addClass("validarPrecio");
    }else{
        $("#precioFonasa").css("display", "none");
        $("#precioFonasa").removeClass("validarPrecio");
        $("#precioFonasa").removeClass("invalid");
    }
});
//Mostar/ocultar precio isapre
$( "#checkIsapre" ).click(function() {
    if ( $(this).is(':checked') ){
         $("#precioIsapre").css("display", "inline");
         $("#precioIsapre").addClass("validarPrecio");
         //Mostrar isapres
         $("#checkboxesLeft").css("display", "block");
         $("#checkboxesRight").css("display", "block");
    }else{
        $("#precioIsapre").css("display", "none");
        $("#precioIsapre").removeClass("validarPrecio");
        $("#precioIsapre").removeClass("invalid");
        //Ocultar isapres
        $("#checkboxesLeft").css("display", "none");
        $("#checkboxesRight").css("display", "none");
    }
});
//Mostar/ocultar precio particular
$( "#checkParticular" ).click(function() {
    if ( $(this).is(':checked') ){
         $("#precioParticular").css("display", "inline"); 
         $("#precioParticular").addClass("validarPrecio");
    }else{
        $("#precioParticular").css("display", "none");
        $("#precioParticular").removeClass("validarPrecio");
        $("#precioParticular").removeClass("invalid");
    }
});

//Mostrar duración con formato.

$('button[id=detalles]').on('click',function () {
    var id = $(this).data("id");
    var duracion = $(this).data("duracion");
    var duracion_partes = duracion.split(':');
    var hora = duracion_partes[0];
    var minuto = duracion_partes[1];
    var boton = "#duracionX"+id;
    if(hora>0){
        if(minuto>0){
            $(boton).text('1 hora y 30 minutos.');
        }else{
            $(boton).text('1 hora.');
        }
    }
    if(hora == 0){
        $(boton).text(minuto+' minutos.');
    }
});