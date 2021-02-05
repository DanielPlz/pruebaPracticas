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
                                <button class="btn btn-link link-color" style="color: #398eb2; "  data-toggle="collapse" data-target="#s{{$sesion->id}}" aria-expanded="true" aria-controls="collapseOne">
                                <strong>    Sesion N° {{$sesion->n_sesion}} - Servicio {{$sesion->servicio->nombre}}</strong>
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


    </div>
    <div class="container row">

        <div class="col-9">
            <a href="{{ url()->previous() }}" class="btn indigo text-white mt-3 mb-5 "> <i class="fas fa-arrow-left fa-fw white-text"></i> volver</a>

        </div>
        
        <div class="">
            <a href="{{route('confirmarEgreso', ['idc'=> $idc , 'idpo'=> $idpo , 'alta' => $alta  , 'idpa' => $idpa  ])}}" class="btn-success btn text-white mt-3 mb-5  ">Confirmar Alta Paciente <i class="fas fa-check"></i></a>
        </div>
    </div>
</div>
</div>
<!--  -->


@endsection
@section('script')
<script src="{{asset('assets/js/ficha/mockup/jquery.steps.js')}}"></script>
<script src="{{asset('assets/js/ficha/mockup/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/ficha/mockup/main.js')}}"></script>
@endsection