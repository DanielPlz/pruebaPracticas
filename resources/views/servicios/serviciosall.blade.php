<div class="row">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h4 class="text-1 darkblue-text mb-4"><b> Servicios </b> 
                <button class="btn btn-sm btn-right indigo white-text text-4 " data-toggle="modal" data-target="#create">
                    <i class="far fa-plus-square fa-fw"></i> Agregar servicio
                </button>
            </h4>
            @if(count($servicios)>0)
                @foreach($servicios as $servicio)
                <label class="text-4"><b>{{$servicio->nombre}}</b></label>
                <label name="lblEditar" class="btnEditDelete btn-right">
                    <button class="btn btn-sm white-text lightblue text-5 borde" id="btnEd" data-toggle="modal" data-target="#edit" data-id="{{$servicio->id}}">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                </label>
                <label name="lblEliminar" class="btnEditDelete btn-right" style="padding-right: 0.5%;">
                    <button class="btn btn-sm white-text red text-5 deleteProduct borde" data-id="{{$servicio->id}}" data-token="{{ csrf_token() }}" >
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                </label>
                <br>
                <label class="text-5" style="text-align: justify;">{{$servicio->descripcion}}</label><br>
                <button class="accordion borde" id="detalles" data-id="{{$servicio->id}}" data-duracion="{{$servicio->duracion}}"><i class="fas fa-tasks"></i> Detalles</button>
                <div class="panel">
                    <label><i class="far fa-clock"></i> <i><b> Duración: </i></b><label id="duracionX{{$servicio->id}}"></label> </label><br>
                    <label><i class="far fa-check-circle"></i> <i><b> Disponibilidad:</i></b>   
                    <ul>
                        @if($servicio->modalidad[0]->presencial != null)
                            <li>
                                Presencial: <i class="fas fa-check indigo-text"></i>
                            </li>
                        @endif
                        @if($servicio->modalidad[0]->online != null)
                            <li>
                                Atención remota: <i class="fas fa-check indigo-text"></i>
                            </li>
                        @endif
                        @if($servicio->modalidad[0]->visita != null)
                            <li>
                                Visita domiciliaria: <i class="fas fa-check indigo-text"></i>
                            </li>
                        @endif
                    </ul>
                    </label>
                    <label style="width:100%;"><i class="fas fa-search-dollar"></i> <i><b>Precios según previsión:</i></b></label>
                    <ul>
                        @if($servicio->precio[0]->precioFonasa != null)
                            <li>
                                Fonasa: <label>${{$servicio->precio[0]->precioFonasa}}</label>
                            </li>
                        @endif
                        @if($servicio->precio[0]->precioIsapre != null)
                            <li>
                                Isapre: <label>${{$servicio->precio[0]->precioIsapre}}</label>
                            </li>
                        @endif
                        @if($servicio->precio[0]->precioParticular != null)
                            <li>
                                Particular: <label>${{$servicio->precio[0]->precioParticular}}</label>
                            </li>
                        @endif
                    </ul>
                    @if($servicio->precio[0]->precioIsapre != null)
                    <label><i class="fas fa-user-shield"></i> <i> <b>Isapres disponibles:</b> </i> </label>
                        <ul>
                            @if($servicio->isapre[0]->banmedica != null)
                                <li>Banmédica</li>
                            @endif
                            @if($servicio->isapre[0]->consalud != null)
                                <li>Consalud</li>
                            @endif
                            @if($servicio->isapre[0]->colmena != null)
                                <li>Colmena</li>
                            @endif
                            @if($servicio->isapre[0]->cruzblanca != null)
                                <li>CruzBlanca</li>
                            @endif
                            @if($servicio->isapre[0]->masvida != null)
                                <li>Nueva Masvida</li>
                            @endif
                            @if($servicio->isapre[0]->vidatres != null)
                                <li>Vida Tres</li>
                            @endif
                        </ul>
                    @endif
                    </label>
                </div><hr>
                @endforeach
            @else
                <div class="alert alert-warning text-4">No hay servicios registrados</div>
            @endif  

        </div>
    </div>
    @include('servicios.agregarServicio')
    @include('servicios.editarServicio')
</div>

<!-- Script para agregar servicios con ajax -->

<script>

    $('#addS').click(function(event){

        event.preventDefault();

        var nombre = $("#nombre").val();
        var token = $("input[name=_token]").val();
        var form = $('#formAddS');
        var route = "{{route('servicio.store')}}";
        
        var ret = validar();
        
        //Ajax para insertar los servicios
        if (ret){
            $.ajax({
                type: "post",
                headers: {"X-CSRF-TOKEN":token},
                url: route,
                data: form.serialize(),
                dataType: "json",
                success: function (data) {
                    if(data.success == 'true' ){
                        //Ajax para mostrar los servicios en el div
                        listServicio();
                        //solucion al error del modal
                        $('.modal-backdrop').remove();
                    }
                }
            });
        }
    });
</script>

<!-- Script para eliminar servicios con ajax -->

<script>

$(".deleteProduct").click(function(){

    var id = $(this).data("id");
    var token = $(this).data("token");
    var route = "{{route('servicio.store')}}";

    //Ajax para eliminar servicios

    $.ajax(
    {
        url: route+"/"+id,
        type: 'DELETE',
        dataType: "JSON",
        data: {
            "id": id,
            "_method": 'DELETE',
            "_token": token,
        },
        success: function (data)
        {
            //Ajax para mostrar los servicios en el div
            listServicio();
            //botonesActivos();
        }
    });

});

</script>

<!-- Script para editar registros con ajax -->

<script>
    $('#editS').click(function(event){

        event.preventDefault();
        var token = $("input[name=_token]").val();
        var form = $('#formEditS');
        var route = "{{route('up')}}";

        var retEd = validarEd();
        
        //Ajax para insertar los servicios
        if (retEd){

            $.ajax({
                type: "PUT",
                headers: {"X-CSRF-TOKEN":token},
                url: route,
                data: form.serialize(),
                dataType: "json",
                success: function (data) {
                    /* if(data.success == 'true' ){
                        //Ajax para mostrar los servicios en el div
                        listServicio();
                        //solucion al error del modal
                        $('.modal-backdrop').remove();
                    } */
                }
            });
            listServicio();
            $('.modal-backdrop').remove();
        }
    });
</script>

<!-- Script para mostrar y ocultar los detalles -->

<script>

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        } 
    });
}

</script> 