@extends('layouts.dashboard')
@section('contentSidebar')

<div class="container-fluid mt-3">

    <div class="card tarjeta  ">  
        <div class="card-header text-center ">

            <div class="text-center mt-1 row">
                    <div  class="text-left  mt-3 col-5">
                    <a type="button indigo white-text "   href="{{url('dashboard/pacientes')}}/{{Auth::user()->id}}" class="btn btn-primary "  >
                    <i class="fas fa-arrow-left fa-fw white-text"></i>  volver </a>
                    </div>
                    <div  class="text-center mt-2  ">
                        <p class="h1">Ficha cl&iacute;nica</p>
                    </div>
               
                
         
            </div>
        </div>
    </div>
    
    
  
    @include('ficha.includes.infopaciente')
 
    
    <!-- CASO A -->
    @foreach($sesiones as $sesion)

    @if($sesion->id_psicologo == $idpo)

    <div class="card mt-2 tarjeta" >
       <div class="card-header" id="casoA">
       <div class="row">
       <div class="col-7">
            <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#m{{$sesion->id_sesion}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                <div class="h4 link-color" >Sesion Numero: {{$sesion->n_sesion}}  <span class="text-muted"> | Fecha : {{$sesion->fecha}} </span> 
                 
                </div> 
            </a>
            <div class="ml-4"><em>Objetivo: Lorem ipsum dolor sit amet, consectetur adipiscing elit. </em></div> 
            </div>
            <div>
            
            <strong ></strong>  <p class="h5 mt-2 text-indigo"><em>  <strong></strong></em></p>
           
            </div>
            </div>
          
        </div>


 
        <div class="collapse" id="m{{$sesion->id_sesion}}">
 
            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#s{{$sesion->id_sesion}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6 link-color">{{$sesion->fecha}}  | Sesi&oacute;n {{$sesion->n_sesion}} - NombreDelServicio </div> 
                    </a>
                </div>

                <div class="collapse" id="s{{$sesion->id_sesion}}">
                    <div class="card-body">
                        <p>Atendido por Nombre Ap Psicologo</p>
                        <p>Servicio: Nombre Servicio </p> 
                        <br>
                   {{-- <a class="link-color" href="{{route('Sesion', ['idpa'=> $paciente->id  , 'idpo'=> $idpo , 'ids'=> $sesiones->id , 'ns'=>$sesiones->n_sesion , 'sr'=>  $sesiones->servicio->nombre , 'idc' => $ficha->id_caso , 'nomc' => $ficha->ficha_caso->codigo , 'caes' => $ficha->estado   ]  )}}">Ver detalles de sesi&oacute;n </a> --}}
                    </div>
                </div>

            </div>

        </div>



    </div>

    @endif
    @endforeach



</div>


@endsection


@section('scripts')

@endsection