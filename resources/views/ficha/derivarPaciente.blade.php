@extends('layouts.dashboard')
@section('contentSidebar')
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<div class="container mt-4">
    <div class="card">

        <div class="card-header text-center ">


            <div class="card card-body">
                <p class="h1">CASO - {{$nomc}} </p>
                <p class="h3">{{$sr}} </p>
            </div>

        </div>
        <div class="card-header">

            <div class="card card-body  ">
                <div class="row ">
                    <div class="col-6 text-left">
                        <p><em><strong>Paciente: </strong> {{$paciente->nombre}} {{$paciente->appat}} {{$paciente->apmat}}</em></p>
                        <p><em><strong>Rut: </strong> {{$paciente->rut}}</em></p>
                        <p><em><strong>Telefono: </strong> {{$paciente->telefono}}</em></p>
                        <p><em><strong>Direccion: </strong> {{$paciente->direccion}}</em></p>

                    </div>
                    <div>
                        <p><em><strong>Fecha de Nacimiento: </strong> {{$paciente->fecha_nac}}</em></p>
                        <p><em><strong>Tipo egreso: </strong> {{$altad->descripcion}}</em></p>
                        <p><em><strong>fecha de ingreso: </strong> {{$fechaC->fecha}} </em></p>
                        <p><em><strong>fecha de egreso: </strong> {{$fechah}}</em></p>
                    </div>
                </div>
            </div>


        </div>

        <div class="card-header text-left ">

            <div class="card card-body ">
                <p>Detalles del caso</p>
                <div id="accordion">
                    <div class="card">
                        @foreach($sesiones as $sesion )
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link link-color" data-toggle="collapse" data-target="#s{{$sesion->id}}" aria-expanded="true" aria-controls="collapseOne">
                                 <strong>   Sesion N° {{$sesion->n_sesion}} - Servicio {{$sesion->servicio->nombre}}</strong>
                                </button>
                            </h5>
                        </div>

                        <div id="s{{$sesion->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">

                                <div class="card ">
                                    <div class="row ">
                                        <div class="ml-3 col-6 text-left">
                                            <h4>Diagnostico</h4>
                                            @foreach($diagnosticoG as $diag)
                                            @if($sesion->id == $diag->id_sesion)
                                            <p> {{$diag->diag_gral}}</p>
                                            @endif
                                            @endforeach
                                            @foreach($manualC as $manual)
                                            @if($sesion->id == $manual->id_sesion)
                                            <div class="row">
                                                <p class="ml-3"><strong>{{$manual->ficha_diagnostico_eje->ficha_eje_manual->nombre}}</strong></p>
                                            </div>
                                            <p> {{$manual->ficha_diagnostico_eje->descripcion}} </p>
                                            @endif
                                            @endforeach


                                        </div>
                                        <div>
                                            <h4>Observaciones</h4>
                                            @foreach($observaciones as $obs)

                                            @if($sesion->id == $obs->id_sesion)
                                            <p> - {{$obs->observacion}}</p>
                                            @endif
                                            @endforeach


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
        <div class="card-header">

            <div class="card card-body  text-center ">

                <p class="h1">Lista de Profesionales</p>
            </div>
            <!-- Buscar Profesional -->
            <div class="card-body bg-light text-center ">

                <div class="form">
                    <div class="form row ">
                        <div class="">
                            <form action="{{route('egresarPaciente', ['idpa'=> $idpa , 'idpo'=> $idpo , 'idc' => $idc , 'sr' => $sr , 'nomc' => $nomc , 'alta' => $alta  ]  )}}" method="get" role="form">
                                <input name="name" title="Nombre Paciente" class="form-control" type="search" placeholder="Buscar Profesional">
                        </div>
                        <div class="ml-2 ">
                            <button class="btn btn-primaryA text-white" type="submit">Buscar Profesional</button>
                        </div>
                        </form>
                        <!--    dropdown -->
                        <div class="dropdown ml-5">
                            <button class="btn btn-primaryA dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tipo de Profesional
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <form action="{{route('egresarPaciente', ['idpa'=> $idpa , 'idpo'=> $idpo , 'idc' => $idc , 'sr' => $sr , 'nomc' => $nomc , 'alta' => $alta  ]  )}}" method="get" role="form">
                                    <button class="dropdown-item" type="submit"><input type="hidden" name="name" value="Psicologo"> Psicologo</button>
                                </form>
                                <form action="{{route('egresarPaciente', ['idpa'=> $idpa , 'idpo'=> $idpo , 'idc' => $idc , 'sr' => $sr , 'nomc' => $nomc , 'alta' => $alta  ]  )}}" method="get" role="form">
                                    <button class="dropdown-item" type="submit"><input type="hidden" name="name" value="Psiquiatra"> Psiquiatra</button>
                                </form>
                                <form action="{{route('egresarPaciente', ['idpa'=> $idpa , 'idpo'=> $idpo , 'idc' => $idc , 'sr' => $sr , 'nomc' => $nomc , 'alta' => $alta  ]  )}}" method="get" role="form">
                                    <button class="dropdown-item" type="submit"><input type="hidden" name="name" value="Neurólogo"> Neurólogo</button>
                                </form>
                                <form action="{{route('egresarPaciente', ['idpa'=> $idpa , 'idpo'=> $idpo , 'idc' => $idc , 'sr' => $sr , 'nomc' => $nomc , 'alta' => $alta  ]  )}}" method="get" role="form">
                                    <button class="dropdown-item" type="submit"><input type="hidden" name="name" value="Medico-General"> Medico General</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Buscar Profesional -->
            </div>
            </div>



            <div class="card-header text-left ">

                <div class="card card-body ">


                    @foreach($profesionales as $profesional)

                    <div class="row ml-2">
                        <div class="card" style="width: 15rem;">
                            <img class="card-img-top" style="height:12rem;" src="{{$profesional->avatar }}" alt="Card image cap">

                            <div class="card-body">
                                <h5 class="card-title"><strong>{{$profesional->name}} {{$profesional->apellido}}</strong> </h5>
                                <p class="card-text mt-n3">*<em>{{$profesional->titulo}}</em></p>
                                <p class="card-text h6  "><strong>Email <i class="fas fa-at"></i></strong></p>
                                <p class="card-text mt-n3">{{$profesional->email}}</p>
                                <p class="card-text h6   "><strong>Telefono <i class="fas fa-phone-alt"></i></strong></p>
                                <p class="card-text mt-n3">{{$profesional->telefono}}</p>
                                <div class="row">   
                                <button type="button"  class="btn btn-info ml-2" data-toggle="modal" data-target="#p{{$profesional->id}}">Detalles </button>
                                <button type="button" class="btn btn-success ml-5" data-toggle="modal" data-target="#p{{$profesional->id}}">Derivar</button>

                                
                            </div>
                            </div>
                        </div>

                        @endforeach

                    </div>

                </div>
                <div class="ml-3 mt-2">
                {!!$profesionales->render()!!}
                </div>
            </div>
            </div>

     
            </div>
    </div>
    </div>
    <!--  -->
 
    <div class="container" >
            <a href="{{route('information', ['idpa'=> $idpa , 'idpo'=> $idpo  ] )}}" class="btn indigo text-white mt-3 mb-5 "> <i class="fas fa-arrow-left fa-fw white-text"></i> volver</a>

        </div>


<!-- Modal -->
@foreach($profesionales as $profesional) 
<div class="modal fade" id="p{{$profesional->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles del Profesional</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <h4>{{$profesional->name}}</h4>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn indigo text-white" data-dismiss="modal">Cerrar <i class="fas fa-times"></i></button>
        <a type="button" href="{{route('confirmarDerivacion', ['idpo'=> $idpo , 'idc'=> $idc , 'idpa'=>$idpa , 'idpod'=>$profesional->id ] )}}" class="btn btn-success">Confirmar Derivacion  <i class="fas fa-check"></i></a>
      </div>
    </div>
  </div>
</div>
@endforeach
        
    

    @endsection
    @section('script')
    <script src="{{asset('assets/js/ficha/mockup/jquery.steps.js')}}"></script>
    <script src="{{asset('assets/js/ficha/mockup/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/ficha/mockup/main.js')}}"></script>
    @endsection