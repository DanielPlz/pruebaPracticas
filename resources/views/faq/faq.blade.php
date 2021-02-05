@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    @section('hero-title', 'Preguntas frecuentes')
    @section('hero-text')
    En esta sección podrá encontrar las respuestas a las preguntas más frecuentes entre nuestros clientes. Si por algun motivo su pregunta no se encuentra en esta sección dirigirse
    al apartado de contacto.
    @endsection
    @section('hero-image')
    <img src="{{asset('assets/img/inscripcion.svg')}}" class="img-fluid">
    @endsection
    @include('templates.hero.hero')

    <div class="container">

    
    <div id="accordion" class="text-center">

  <div class="card text-center">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color: black; font-weight: bold; ">
          ¿Como puedo agendar una hora?
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      En la lista de profesionales hay un botón al costado de cada profesional que dice "Reservar cita" una vez 
                    que se haga clic en este apartado se abrirá una ventana en la cual usted debe ingresar su correo, telefono y RUT, luego
                    al oprimir siguiente, aparecerán los servicios que ud requiere, la modalidad y si tiene ud previción, en la pagina siguiente
                    aparecerá un detalle de sus datos, los cuales deberá aceptar junto a los términos y condiciones de uso, una vez realizada esta acción
                    ud debe pagar la cita y para concluir agendar la hora
                    </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color: black; font-weight: bold;">
          ¿Puedo cambiar la fecha o cancelar la reserva?
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      La reservación se puede cancelar con 12 horas de antelación a la hora de la reserva, y solo se le devolverá el 85% del costo de la reserva. 
                  Se puede cambiar la hora de la reserva 24 horas previo a la hora de reserva.</div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="color: black;font-weight: bold;">
          ¿Puedo hacer una reserva para otra persona?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      Sí, usted puede reservar por un tercero aceptando los términos y condiciones de uso.
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="color: black;font-weight: bold;">
          ¿Qué tarjeta se puede utilizar para el pago de un servicio?
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
      Acepta todo tipo de tarjeta de crédito, débito y prepago que esten ligadas a Transbank.</div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingFive">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="color: black;font-weight: bold;">
          ¿Se puede pagar en efectivo?
        </button>
      </h5>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
      <div class="card-body">
      Actualmente no se puede realizar pagos en efectivo.
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingSix">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" style="color: black;font-weight: bold;">
          ¿Puedo dar uso a plan isapre o fonasa?
        </button>
      </h5>
    </div>
    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
      <div class="card-body">
      Sí, se puede dar uso del plan isapre o fonasa dependiendo de cada profesional. El descuento se aplica previo al cobro que se hace por Transferencia.
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingSeven">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" style="color: black;font-weight: bold;">
          ¿Recibiré un recordatorio?
        </button>
      </h5>
    </div>
    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
      <div class="card-body">
      Usted recibirá el recordatorio en formato SMS, WhatsApp, correo electronico y recibirá el mensaje 48, 24 y 12 horas antes de la cita.
      
      </div>
    </div>
  </div>

</div>

</div>

<div class="container pl-3 pr-3">
    <div class="row pt-5 pb-5 d-flex justify-content-center">
        <div class="col-md-12 text-center mb-4">
            <h1 class="title-4 darkblue-text mb-3">Atención inmediata garantizada</h1>
            <p class="text-4 bluegray-text">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            </p>
        </div>
        <div class="col-md-4 mb-3">
            <div class="icon d-flex justify-content-center mb-3">
                <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                    <i class="far fa-user fa-fw align-self-center"></i>
                </div>
            </div>
            <div class="text-center">
                <h1 class="title-4 darkblue-text mb-3">Ingresa a tu cuenta</h1>
                <p class="text-4 bluegray-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet accusamus mollitia quibusdam hic placeat quasi.
                </p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="icon d-flex justify-content-center mb-3">
                <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                    <i class="far fa-calendar-check fa-fw align-self-center"></i>
                </div>
            </div>
            <div class="text-center">
                <h1 class="title-4 darkblue-text mb-3">Reserva tu atencion</h1>
                <p class="text-4 bluegray-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet accusamus mollitia quibusdam hic placeat quasi.
                </p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="icon d-flex justify-content-center mb-3">
                <div class="circle lightgray-overlay yellow-text d-flex justify-content-center">
                    <i class="fas fa-stethoscope fa-fw align-self-center"></i>
                </div>
            </div>
            <div class="text-center">
                <h1 class="title-4 darkblue-text mb-3">Comienza tu terapia</h1>
                <p class="text-4 bluegray-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet accusamus mollitia quibusdam hic placeat quasi.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

