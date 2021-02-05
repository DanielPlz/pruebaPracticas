@extends('layouts.dashboard')
{{-- @section('contentSidebar')
<link rel="stylesheet" href="{{asset('css/styles.css')}}"> --}}

<div class="container">
    <div class="card tarjeta bg-light mt-3 ">
        <div class="card-body bg-light text-center">
            <h1 class="text-primary">Mi lista de casos</h1>
        </div>
    </div>
<div class="container">


    <!-- CASO A -->
    @foreach($casouni as $ficha)

    

    <div class="card mt-2 tarjeta" >
       <div class="card-header" id="casoA">
       <div class="row">
       <div class="col-6">
            <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#m{{$ficha->id_caso}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                <div class="h4">Caso {{$ficha->ficha_caso->codigo}}</div> 
            </a> 
            </div>
            <div>
            
            <p class="h5 mt-2 text-indigo"><em><strong>Estado: {{$ficha->estado}}</strong></em></p>

           
                @if($ficha->estado == 'En espera - aporbacion del Paciente')
            <a class="btn btn-success" href="{{route('aceptarDerivacion', ['idc'=> $ficha->id_caso])}}">Aceptar </a>
            <a class="btn btn-danger ml-3" href= >Rechazar </a>
          @endif
        
        
            </div>
            </div>
            <div class="ml-4"><em>Descripcion: {{$ficha->ficha_caso->descripcion}}</em></div>
        </div>


 
        <div class="collapse" id="m{{$ficha->id_caso}}">
        @foreach( $sesion as $sesiones )
            @if ($sesiones->id_caso == $ficha->ficha_caso->id )
            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#s{{$sesiones->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">{{$sesiones->fecha}}  | Sesion {{$sesiones->n_sesion}} - {{$sesiones->servicio->nombre}} </div> 
                    </a>
                </div>

                <div class="collapse" id="s{{$sesiones->id}}">
                    <div class="card-body">
                        <p>Atendido por {{$sesiones->info_profesional->user->name}} {{$sesiones->info_profesional->user->apellido}}</p>
                        <p>Servicio: {{$sesiones->servicio->nombre}} </p> 
                        <br>
                    </div>
                </div>

            </div>
            @endif
            @endforeach
        </div>



    </div>

  
    @endforeach



</div>





@section('scripts')

@endsection
