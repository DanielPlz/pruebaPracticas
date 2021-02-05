$(document).ready(function() {
    listCat();
});

function listCat() {
    $.ajax({
        type: 'get',
        url: routeForoCatList,
        success: function(data) {
            $('#catList').empty().html(data);
        }
    });
}

//SETUP MODAL ADD
$('#btnModalCatAdd').click(function(event) {
    $('#modalCatAdd').modal('show');
    $('#btnCatAdd').prop('disabled', false);
    $('#modalCatAdd').find(".errorMsg").html("");
});

//SEND DATA ADD
$('#btnCatAdd').click(function(event) {
    event.preventDefault();
    $('#btnCatAdd').prop('disabled', true);
    $('#modalCatAdd').find(".errorMsg").html('');

    var token = $("input[name=_token]").val();
    var form = $('#formCatAdd');
    var route = routeForoCatAdd;
    $.ajax({
        type: "post",
        headers: {
            "X-CSRF-TOKEN": token
        },
        url: route,
        data: form.serialize(),
        dataType: "json",
        success: function(data) {
            $('#modalCatAdd').modal('hide');
            $("#boxCatTitulo").val("");
            $("#boxCatDescripcion").val("");

            listCat();
        }
    }).catch(err => {
        $('#modalCatAdd').find(".errorMsg").html(listErrors(err));
    }).always(function(){
        $('#btnCatAdd').prop('disabled', false);   
    });
});

//SETUP MODAL EDIT
$('#catList').on('click', '.btnModalCatEdit', function (){
    let id = $(this).data("id");
    $('#catEditId').val(id);
    
    $('#boxCatEditTitulo').val("");
    $('#boxCatEditDescripcion').val("");
    $('#modalCatEdit').find(".errorMsg").html("");

    $.ajax({
        type:"get",
        url: routeForoCatDetails,
        data:{catId:id},
        success: function (cat){
            $('#boxCatEditTitulo').val(cat.titulo);
            $('#boxCatEditDescripcion').val(cat.descripcion);
        }
    }).catch(err => {
        $('#modalCatEdit').find(".errorMsg").html(listErrors(err));
    });
});

//SETUP MODAL DELETE
$('#catList').on('click', '.btnModalCatDelete', function (){
    let id = $(this).data("id"); //gets the id from the button
    $('#catDeleteId').val(id);
});
      
//send request EDIT
$('#btnCatEdit').click(function(event) {
    event.preventDefault();
    const token = $("input[name=_token]").val();
    let form = $('#formCatEdit');
    const route = routeForoCatEdit;

    $.ajax({
        type: "PUT",
        headers: {"X-CSRF-TOKEN": token},
        url: route,
        data: form.serialize(),
        dataType: "json",
        success: function(data) {
            listCat();
            $('#modalCatEdit').modal('hide');
        }
    }).catch(err => {
        $('#modalCatEdit').find(".errorMsg").html(listErrors(err));
    });
});

//send request DELETE
$("#btnCatDelete").click(function(){
    let id = $("#catDeleteId").val();
    const token = $("input[name=_token]").val();
    const route = routeForoCatDelete;
    $.ajax({
        url: route,
        type: 'DELETE',
        dataType: "JSON",
        data: {"catDeleteId": id, "_method": 'DELETE', "_token": token,},
        success: function (data){
            listCat();
            $('.modalCatDelete').modal('hide');
        }
    });
});