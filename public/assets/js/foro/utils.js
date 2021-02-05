function isFunction(func) {
    return typeof(func) === typeof(Function);
}

function listErrors(err)
{
    let html = '';
    let errors = {};

    if (err.status == "413")
        html += "<li>" + "El tamaño del archivo es demasiado grande" + "</li>";
    
    if (err.responseJSON != null)
    {    
        errors = err.responseJSON.errors;

        if (err.responseJSON.customError)
            html += "<li>" + err.responseJSON.customError + "</li>";
    }
    
    $.each(errors, function(k,v){ 
        $.each( v, function( i, e ){
            html += "<li>" + e + "</li>";
        });
    });

    return html;
}