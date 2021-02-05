$(document).ready(function() {
    if($("#hidden").val() ==1){
        $("#titulo").text("Confirmar Rechazo");
        $("#descripcion").text("El reembolso de su pago de la cita fue aceptado ¿Desea confirmar su rechazo?.");
    }
    if($("#hidden").val()==2){
        $("#titulo").text("Confirmar Rechazo");
        $("#descripcion").text("El tiempo para rechazar y obtener un reembolso del pago de su cita (12 horas) ha expirado ¿Desea confirmar su rechazo sin el reembolso?.");
    }
    if($("#hidden").val()==3){
            $("#div").append('<div class="col-lg-5" >'
                 +'<button class="btn btn-block indigo white-text text-4 mb-3" data-toggle="modal" data-target="#update">'
            +'Reagendar cita <i class="far fa-calendar-check fa-fw pink-text "></i>'
        +'</button>'
            +'</div>');
        $("#titulo").text("Confirmar Rechazo");
        $("#descripcion").text("El reembolso de su pago y la reagendación de la cita fueron aceptados ¿Desea reagendar su cita o prefiere la devolución de su dinero?.");
    }
    if($("#hidden").val()==4){
        $("#titulo").text("Cita incorrecta");
        $("#descripcion").text("La cita que intenta ingresar no coincide con tus datos.");
    } 
});