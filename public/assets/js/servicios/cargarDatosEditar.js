$('button[id=btnEd]').on('click',function () {
    //Dejar el formulario en el primer paso al apretar editar
    $("#formEditS")[0].reset();
    showTabEd(0);
    var tabsEd = document.getElementsByClassName("tabEd");
    tabsEd[1].style.display = "none";
    tabsEd[2].style.display = "none";
    currentTabEd = 0;
    $("#precioFonasaEd").css("display", "none");
    $("#precioIsapreEd").css("display", "none");
    $("#checkboxesLeftEd").css("display", "none");
    $("#checkboxesRightEd").css("display", "none");
    $("#precioParticularEd").css("display", "none");
    //Cargar datos dependiendo del id que se envíe
    var id = $(this).data("id");
    $('#servicio_id_edit').val(id);
    var ajax = $.ajax({
        type:"get",
        url:"/datosModi",
        data:{
            id:id
        }
    });
    //Reemplazar todos los input con los datos traídos con ajax
    ajax.done(function(dato){
        var datos = JSON.parse(dato);
        $('#nombreEd').val(datos.aa[0]);
        $('#descripcionEd').val(datos.aa[1]);
        $('#duracionEd').val(datos.aa[2]);
        if(datos.aa[3] == 1){
            $('#presencialEd').prop('checked', true); 
        }
        if(datos.aa[4] == 1){
            $('#onlineEd').prop('checked', true); 
        }
        if(datos.aa[5] == 1){
            $('#visitaEd').prop('checked', true); 
        }
        if(datos.aa[6] >0){
            $('#checkFonasaEd').prop('checked', true);
            $("#precioFonasaEd").css("display", "inline"); 
            $("#precioFonasaEd").addClass("validarPrecioEd");
            $("#precioFonasaEd").val(datos.aa[6]);
        }
        if(datos.aa[7] >0){
            $('#checkIsapreEd').prop('checked', true); 
            $("#precioIsapreEd").css("display", "inline");
            $("#precioIsapreEd").addClass("validarPrecioEd");
            $("#checkboxesLeftEd").css("display", "block");
            $("#checkboxesRightEd").css("display", "block");
            $("#precioIsapreEd").val(datos.aa[7]);
            if(datos.aa[9] == 1){
                $('#banmedicaEd').prop('checked', true); 
            }
            if(datos.aa[10] == 1){
                $('#consaludEd').prop('checked', true); 
            }
            if(datos.aa[11] == 1){
                $('#colmenaEd').prop('checked', true); 
            }
            if(datos.aa[12] == 1){
                $('#cruzBlancaEd').prop('checked', true); 
            }
            if(datos.aa[13] == 1){
                $('#masVidaEd').prop('checked', true); 
            }
            if(datos.aa[14] == 1){
                $('#vidaTresEd').prop('checked', true); 
            }
        }
        if(datos.aa[8] >0){
            $('#checkParticularEd').prop('checked', true); 
            $("#precioParticularEd").css("display", "inline"); 
            $("#precioParticularEd").addClass("validarPrecioEd");
            $("#precioParticularEd").val(datos.aa[8]);
        }
    });
});

//hideShowPrecios para editar

//Mostar/ocultar precio fonasa
$( "#checkFonasaEd" ).click(function() {
    if ( $(this).is(':checked') ){
         $("#precioFonasaEd").css("display", "inline"); 
         $("#precioFonasaEd").addClass("validarPrecio");
         $("#precioFonasaEd").addClass("validarPrecioEd");
    }else{
        $("#precioFonasaEd").css("display", "none");
        $("#precioFonasaEd").removeClass("validarPrecioEd");
        $("#precioFonasaEd").removeClass("invalid");
        $("#precioFonasaEd").val(null);
    }
});
//Mostar/ocultar precio isapre
$( "#checkIsapreEd" ).click(function() {
    if ( $(this).is(':checked') ){
         $("#precioIsapreEd").css("display", "inline");
         $("#precioIsapreEd").addClass("validarPrecioEd");
         //Mostrar isapres
         $("#checkboxesLeftEd").css("display", "block");
         $("#checkboxesRightEd").css("display", "block");
    }else{
        $("#precioIsapreEd").css("display", "none");
        $("#precioIsapreEd").removeClass("validarPrecioEd");
        $("#precioIsapreEd").removeClass("invalid");
        $("#precioIsapreEd").val(null);
        //Ocultar isapres
        $("#checkboxesLeftEd").css("display", "none");
        $("#checkboxesRightEd").css("display", "none");
        $('#banmedicaEd').prop('checked', false); 
        $('#consaludEd').prop('checked', false); 
        $('#colmenaEd').prop('checked', false);
        $('#cruzBlancaEd').prop('checked', false); 
        $('#masVidaEd').prop('checked', false); 
        $('#vidaTresEd').prop('checked', false); 

    }
});
//Mostar/ocultar precio particular
$( "#checkParticularEd" ).click(function() {
    if ( $(this).is(':checked') ){
         $("#precioParticularEd").css("display", "inline"); 
         $("#precioParticularEd").addClass("validarPrecioEd");
    }else{
        $("#precioParticularEd").css("display", "none");
        $("#precioParticularEd").removeClass("validarPrecioEd");
        $("#precioParticularEd").removeClass("invalid");
        $("#precioParticularEd").val(null);
    }
});