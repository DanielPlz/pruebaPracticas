@extends('layouts.dashboard')
@section('contentSidebar')
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<div class="container-fluid mt-3" >
     <div class="card tarjeta "> 
    
         <div class="card-body text-center row"> 
    
            <div class="mt-4 ">

                <a type="button" mb-2 href="{{route('information', ['idpa'=> $paciente->id , 'idpo'=> $idpo ])}}" class="btn btn-primary">
                    <i class="fas fa-arrow-left fa-fw white-text"></i> volver
                </a>
            </div>
             <div class="col-10"> 
            
                <p class="h1">DETALLES DE LA SESI&Oacute;N N° {{$ns}}</p>
                <p class="h3">{{$sr}}</p>
            </div>
        </div>
    </div>

    @include('ficha.includes.infopaciente')


    <!--  -->
    <div class="container-fluid  mt-3  card tarjeta">

        <div class=" card-body row">
            <div class="card mt-3 col-4 ">
                <div class="card-header text-center">
                    <p class="h3">Observaciones</p>


                    <!-- MODAL -->
                    <!-- Button trigger modal -->
                    @if($caes == 'Activo')
                    <button type="button" class="btn mb-3  btn-primaryB" data-toggle="modal" data-target="#exampleModalCenter">
                        Agregar observaci&oacute;n
                    </button>
                    @endif

                    <table class="table ">
                        <tbody class="text-left">
                            @foreach($observaciones as $obs)
                            <tr>
                                <th class="h5"> {{$obs->observacion}}</th>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva Observación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                </div>
                                <form action="{{route('crearObservacion', [ 'ids'=> $ids ])}}" method="post" role="form">
                                    @csrf
                                    <div class="modal-body">
                                        <textarea name="txt_observacion" id="txt_observacion" class="form-control" cols="5" required rows="5"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primaryA">Agregar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- MODAL -->




        @if (@isset($diagnosticog))
        @include('ficha.includes.diagnosticoGcreado')
        @elseif($manuniC !== 1 )
        @include('ficha.includes.diagnosticoMcreado')
        @else
        @include('ficha.includes.diagnostico')
        @endif


    </div>
</div>
<!--  -->


@endsection
@section('script')
<script src="{{asset('assets/js/ficha/mockup/jquery.steps.js')}}"></script>
<script src="{{asset('assets/js/ficha/mockup/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/ficha/mockup/main.js')}}"></script>
@endsection