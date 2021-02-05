$(document).ready(function(){
    console.log('JQuey cargado en chat.js');
    
    // Variables de uso general
    const pdf = `<p><span><i class="fas fa-file-pdf fa-2x m-1 fontIco" style="color: #FF0303;""></i></span></p>`;
    const word = `<p><span><i class="fas fa-file-word fa-2x m-1 fontIco" style="color: #0329FF;"></i></span></p>`;

    $('#messages-content').hide();
    // Spinner de carga de prueba
    $('#spinner').hide();  

    loadCountMessages();

    Pusher.logToConsole = false;
    var pusher = new Pusher('34a4ab045d5bc968123a', {
        cluster: 'us2',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // se actualiza el chatform.blade
        if(mi_idForm == data.from){
            userClick = 0;
            $('#' + data.to).click();
        }else if(mi_idForm == data.to){
            if(receiver_idForm == data.from){
                userClick = 0;
                $('#' + data.from).click();
            }else{
                var pending = parseInt($('#' + data.from).find('.pending').html());
                if(pending){
                    $('#' + data.from).find('.pending').html(pending + 1);
                }else{
                    $('#' + data.from).append('<span class="pending">1</span>');
                }
            }
        }

        // se actualiza el message.blade
        if ($('#modalMensaje').is(':visible')) {
            $(".msg").remove();
            getMessages(receiver_idModal);
        } else {
            if (my_idModal == data.from) {
                $('#alertMsg').remove();
                $(".msg").remove();
                getMessages(receiver_idModal);
            }else if (my_idModal == data.to) {
                if(receiver_idModal == data.from){
                    $('#alertMsg').remove();
                    loadCountMessages();
                }
            }
        }
    });

    // ----------------------------------------- Fuciones para vista message.blade -----------------------------------------

    /*
        Evento del modal de mensajes que al mostrarse envia una peticion ajax al servidor para obtener el listado
        de mensajes entre el profesional seleccionado y el usuario que a hecho loggin.
    */ 
    var my_idModal = $('#formChatModal').attr('myPersonalId');
    var receiver_idModal = $('#formChatModal').attr('recerveId');
    $('#modalMensaje').on('show.bs.modal', function (e) {
        $('#alertMsg').remove();
        getMessages(receiver_idModal);
    });

    function getMessages(receiver_id){
        let base_url = $('#formChatModal').attr('action');
        if (my_idModal != "") { 
            $('#spinner').show();  
            $.ajax({
                type: "get",
                url: "/message/" + receiver_id,
                data: "",
                cache: false,
                success: function (data){ 
                    /*  
                        si el servidor responde con estado 200 y nos envia el listado de mensajes,
                        lo recorremos en una foreach para que estos se "impriman" en el modal de chat.
                    */
                    setTimeout(() => {
                        data.forEach((message, index) => { 
                            // type_content : text / pdf / docx / image
                            let { from, type_content, created_at } = message;
                            let enlace = `<a href="${base_url+'/download/'+message.message}">Descargar</a>`;
                            let mensaje = `<p>${message.message}</p>`;
                            let imagen = `<img src="${base_url+'/showfile/'+message.message}" alt="" class="img-thumbnail">`;
                            $(".messages").append(`
                                <li class='msg message clearfix'>
                                    <div class=${from == my_idModal ? 'sent' : 'received'} id="msg-${index}">
                                        ${type_content == 'image' ? imagen : ''}
                                        ${type_content == 'pdf' ? pdf : ''}
                                        ${type_content == 'docx' ? word : ''}
                                        ${type_content == 'text' ? mensaje : ''}
                                        ${type_content == 'image' || type_content == 'docx' || type_content == 'pdf' ? enlace : ''}
                                        <p class='date'>${moment( created_at ).format('lll')}</p>
                                    </div>
                                </li>
                            `); 
                        }); 
                        $('#spinner').hide();
                        scrollToBottomFunc();
                    }, 1000); 
                },
                complete: function(){
                    scrollToBottomFunc();
                }
            });
        } else {
            $('#element').removeAttr('hidden');
            $('#element').toast('show')
        }
    }

    /*
        Evento "submit" del formulario en donde se puede enviar un mensaje o bien un archivo
    */
    $('#formChatModal').on('submit', function(e) {
        e.preventDefault();
        // agrego la data del form a formData
        var formData = new FormData(this);
        let messageSend = $('#formChatModal #txtChat').val().trim();
        let contendFile = $('#formChatModal #fileUser').val(); 
        if (messageSend != "" || contendFile != "") {
            let [ msgLength, msgScript, isValid ] = validateMessage( messageSend );
            if( isValid ){
                formData.append('_token', $('input[name=_token]').val());
                formData.append('receiver_id', receiver_idModal);
                formData.append('message', messageSend);
                formData.append('origin', 'modal');
                $("#formChatModal #txtChat").prop('disabled', true);
                $("#formChatModal #fileUser").prop('disabled', true);
                
                if (my_idModal != "") {
                    $.ajax({
                        type:'POST',
                        url: "/message",
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(!data[0].messageSend){
                                let completeError = '';
                                if(data[0].messageError || data[1].messageError){
                                    let messageError = data[0].messageError ? data[0].messageError : data[1].messageError;
                                    completeError = messageError + '. ';
                                }
                                if(data[0].extend || data[1].extend){
                                    let messageFile = infoError = data[0].extend ? data[0].extend : data[1].extend; 
                                    completeError = completeError +' '+ messageFile;
                                }

                                // solo si el mensaje de error tiene contenido se mostrara la alerta
                                completeError && showCustomAlert('formChatModal', 'customAlert', 10000, completeError, 'Error');
                            }
                            $('#formChatModal #fileUser').val('');
                            $('#formChatModal #txtChat').val('');
                            $("#formChatModal #addFile").addClass("btn indigo btn-outline-secondary");
                        },
                        error: function(jqXHR, text, error){
                            showCustomAlert('formChatModal', 'customAlert', 10000, 'Error inesperado detectado', 'Error');
                        },
                        complete: function(){
                            scrollToBottomFunc();
                            $("#formChatModal #txtChat").prop('disabled', false);
                            $("#formChatModal #fileUser").prop('disabled', false);
                        }
                    });
                }
            }else{
                showCustomAlert('formChatModal', 'customAlert', 10000, msgLength + ' ' + msgScript);
            }
        }
    });

    /*
        Evento del modal de mensajes que se activa al cerrar el modal. esto con la finalidad de limpiar el contenido del mismo
        y evitar que los mensajes que se muestran en el se dupliquen.
    */ 
    $('#modalMensaje').on('hidden.bs.modal', function (e) {
        $(".msg").remove();
    });
    
    // ----------------------------------------- Fuciones para vista chatform.blade -----------------------------------------

    /*
        Evento clic sobre el un elemento del listado de usuarios que hará una peticón AJAX al servidor en busca del
        listado de mensajes entre el usuario logeado y el usuario seleccionado. Dicho listado de mensajes será 
        imprimido en la vista aplicando diferentes clases CSS para mejorar su presentación.
    */
    var userClick = 0;
    var receiver_idForm = '';
    var mi_idForm = $('#formChat').attr('myPersonalId');

    //Evento que cierra la caja de chat y vuelve a mostrar la caja de contactos.
    $("#btn-showUser").click(function() {
        userClick = 0;
        $('#messages-content').hide();
        $('#container-users').show();
    });

    // Aplicando responsive en chatform.blade
    const adaptChatForm = (media) => {
        $('#btn-showUser').show();
        if (media.matches) { 
            $('#container-messages').addClass('container-fluid');
            if (userClick == undefined || userClick == 0) {
                $('#container-users').show();
            }else{
                $('#btn-showUser').show();
                $('#container-users').hide();
            }
        } else {
            $('#container-users').show();
            $('#btn-back').remove();
        }
    }

    const mediaQueri = window.matchMedia("(max-width: 767px)");
    adaptChatForm(mediaQueri); 
    mediaQueri.addListener(adaptChatForm);    

    $(document).on('click', '.users .user', function () {
        if(window.outerWidth <= 767) {
            $('#container-users').hide();
            $('#container-messages').addClass('container-fluid');
        }else{
        }
        let nameUser = $(this).find('.media .media-body .name').html();
        $('#title-Name').remove();
        $('#messages-content .card-header').append(`<h6 id="title-Name" class="text-white">${ nameUser }</h6>`);
    });

    $('.user').click(function (){
        $('.msg').remove();
        $('#messages-content').show();
        
        $('.user').removeClass('active');
        $(this).addClass('active');
        $(this).find('.pending').remove();

        // verificar si mostrar u ocultar el chat
        receiver_idForm = $(this).attr('id');
        if(userClick == receiver_idForm){
            $('#messages-content').hide();
            userClick = 0;
        }else{
            $('#messages-content').show();
            userClick = $(this).attr('id');
        }
        
        let base_url = $('#formChat').attr('action');

        $.ajax({
            type: "get",
            url: "/message/" + receiver_idForm,
            data: "",
            cache: false,
            success: function (data){
                data.forEach(message => {
                    let { from, type_content, created_at } = message;
                    let enlace = `<a href="${base_url+'/download/'+message.message}">Descargar</a>`;
                    let mensaje = `<p>${message.message}</p>`;
                    let imagen = `<img src="${base_url+'/showfile/'+message.message}" alt="" class="img-thumbnail">`;
                    $(".messages").append(`
                        <li class='msg message clearfix'>
                            <div class=${from == $('#formChat').attr('myPersonalId') ? 'sent' : 'received'}>
                                ${type_content == 'image' ? imagen : ''}
                                ${type_content == 'pdf' ? pdf : ''}
                                ${type_content == 'docx' ? word : ''}
                                ${type_content == 'text' ? mensaje : ''}
                                ${type_content == 'image' || type_content == 'docx' || type_content == 'pdf' ? enlace : ''}
                                <p class='date'>${moment( created_at ).format('lll')}</p>
                            </div>
                        </li>
                    `); 
                });
            },
            complete: function(){
                scrollToBottomFunc();
            }
        });
    });

    $('#close-message-content').click(() => {
        $('#messages-content').hide();
    });

/*
    Evento submit del formulario que mediante una peticion AJAX hacía el servidor enviara un posible archivo junto con el mensaje 
    para su guardado.  
*/ 
    $('#formChat').on('submit', function(e) {
        e.preventDefault();
        // agrego la data del form a formData
        var formData = new FormData(this);
        let messageSend = $('#formChat #txtChat').val().trim();
        let contendFile = $('#formChat #fileUser').val(); 
        if (messageSend != "" || contendFile != "") {
            let [ msgLength, msgScript, isValid ] = validateMessage( messageSend );
            if(isValid){
                formData.append('_token', $('input[name=_token]').val());
                formData.append('receiver_id', receiver_idForm);
                formData.append('message', messageSend);
                formData.append('origin', 'form');
                $("#formChat #txtChat").prop('disabled', true);
                $("#formChat #fileUser").prop('disabled', true);
                if (mi_idForm != "") {
                    $.ajax({
                        type:'POST',
                        url: "/message",
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                            if(!data[0].messageSend){
                                let completeError = '';
                                if(data[0].messageError || data[1].messageError){
                                    let messageError = data[0].messageError ? data[0].messageError : data[1].messageError;
                                    completeError = messageError + '. ';
                                }
                                if(data[0].extend || data[1].extend){
                                    let messageFile = infoError = data[0].extend ? data[0].extend : data[1].extend; 
                                    completeError = completeError +' '+ messageFile;
                                }

                                // solo si el mensaje de error tiene contenido se mostrara la alerta
                                completeError && showCustomAlert('container-chat', 'customAlert', 10000, completeError, 'Error');
                            }
                            $('#formChat #fileUser').val('');
                            $('#formChat #txtChat').val('');
                            $("#formChat #addFile").addClass("btn indigo btn-outline-secondary");
                        },
                        error: function(jqXHR, text, error){
                            showCustomAlert('container-chat', 'customAlert', 10000, 'Ocurrio un error durante el envio del mensaje');
                        },
                        complete: function(){
                            scrollToBottomFunc();
                            $("#formChat #txtChat").prop('disabled', false);
                            $("#formChat #fileUser").prop('disabled', false);
                        }
                    });
                } else {
                    const toastLogin = `<div class="info-err-send"><strong><p class="text-danger">Para enviar su mensaje debe iniciar sesión.<a href="{{ url('/login') }}">Inicio de sesión</a></p></strong></div>`;
                    $(".messages").append( toastLogin );
                }
            }else{
                showCustomAlert('container-chat', 'customAlert', 10000, msgLength +' '+msgScript);
            }
        }
    });

    // ----------------------------------------- Fuciones de uso general -----------------------------------------

    /*
        Evento que detecta si un input file tiene contenido y dependiendo si el tipo de archivo esta permitido
        se aplican deferentes clases de bootstrap
    */
    $("#fileUser").on('change', function() { 
        if (cortarCadena($('#fileUser').val())) { 
            $("#addFile").removeClass();
            $("#addFile").addClass("btn btn-outline-success");
        }else{
            $("#addFile").removeClass();
            $("#addFile").addClass("btn btn-outline-danger");
        }
    });

    /*
        Function que permite cortar una cardena para obtener una posible extención del mensaje para determinar 
        el tipo de archivo que se esta mostrando
    */ 
    function cortarCadena(cadena){
        let extension = cadena.split(".", 2);
        if(extension[1] == "jpeg" || extension[1] == "png" || extension[1] == "jpg"){
            return 'image';
        }else if(extension[1] == "pdf" || extension[1] == "docx"){
            return extension[1];
        }else{
            return '';
        }
    }

    /*
        Evento click sobre el buton con icono de clip que llama al input file declarado como hidden del 
        formulario en el modal chat
    */
    $("#addFile").click(function () {
        $("input[type='file']").trigger('click');
    });

    /*
        Function que muestra el alerta reutilizable
    */
    const showCustomAlert = ( idWhere = "formChatModal", idCustomAlert = "customAlert", timeout = 2000, msg, type ) => {
        const customAlert = makeAlert(msg, type);
        $("#"+idWhere).append(customAlert);
        $("#"+idCustomAlert).toast('show');
        setTimeout(() => { 
            $("#"+idCustomAlert).toast('dispose'); 
            $("#"+idCustomAlert).remove(); 
        },timeout);	
    }

    /* 
        Function que crear una alerta reutilizable
    */
    const makeAlert = ( messageAlert = "Ocurrio un error inesperado", typeAlert = "error" ) => {
        let toast = `
            <div style="position: absolute; top: 6rem; right: 2rem;">
                <div id="customAlert" role="alert" aria-live="assertive" aria-atomic="true" class="toast m-auto" data-autohide="false">
                    <div class="toast-header" style="font-size:20px">
                            <strong class="mr-auto">
                                <i class="fa fa-exclamation-triangle fa-fw" style="color:#FF4057"></i> Aviso
                                </strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="toast-body" style="font-size: 18px">
                        ${ messageAlert }
                    </div>
                </div>
            </div>
        `;
        return toast;
    }

    function scrollToBottomFunc(){
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight 
        }, 50);
    }

});


/*
    Valida que el mensaje a enviar cumpla con algunas reglas antes de ser enviado al servidor
*/ 
const validateMessage = ( message ) => {
    let msg = [ '', '', true ];
    if(message.length >= 300){
        msg[0] = "Su mensaje es demasiado largo.";
        msg[2] = false;
    }

    if(message.includes('<script>') || message.includes('</script>') || message.includes('$(')){
        msg[1] = 'Su mensaje tiene contenido invalido'; 
        msg[2] = false;
    }

    return msg;
}

/*
    Cargar un contador con la cantidad de mensajes que no han sido leidos por el paciente y las muestra en la vista del mismo
*/ 
const loadCountMessages = () => {
    $.ajax({
        type:'get',
        url: "/chat/read/"+$('#formChatModal').attr('recerveId'),
        data: "",
        cache: false,
        success: function (response){
            if (response != 0) {
                $('#btnModal').append(`
                    <span id="alertMsg" class="badge badge-primary">${ response }</span>
                `);
            }
        }
    });
}