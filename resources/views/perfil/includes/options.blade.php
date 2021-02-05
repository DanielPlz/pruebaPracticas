<div class="card mb-3">
    <div class="card-body">
        <h4 class="title-4 darblue-text"> Servicios</h4>
        @if(count($user->servicios)>0)
            @foreach($user->servicios as $servicio)
                <label class="text-4"><b>{{$servicio->nombre}}</b></label>
                @include('perfil.includes.detallesServicio') <br>
            @endforeach
        @else
            <div class="alert alert-warning text-4">No hay servicios registrados</div>
        @endif             
    </div>
</div>
<div class="card mb-3">
    <div class="card-body p-4 text-center">
        <h4 class="title-4 darblue-text">¿Necesitas ayuda?</h4>
        <p class="text-4 bluegray-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
        <button class="btn btn-block indigo white-text text-4 mb-3" data-toggle="modal" data-target="#create">
            <i class="far fa-calendar-check fa-fw"></i> Reservar cita 
        </button>
        <button id="btnModal" class="btn btn-block white indigo-text indigo-border text-4 " data-toggle="modal" data-target="#modalMensaje">
            <i class="far fa-paper-plane fa-fw"></i> Enviar mensaje
        </button>   
        @include('chat.message')
    </div>
</div>
@include('reservas.terminos')
@include('reservas.create')

</div>
