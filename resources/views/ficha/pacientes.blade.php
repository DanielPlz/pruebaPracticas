@extends('layouts.dashboard')
@section('contentSidebar')
<link rel="stylesheet" href="{{asset('css/styles.css')}}">


<!-- Inicio nueva vista -->
<div class="container">
    <div class="card tarjeta bg-light mt-3 ">
        <div class="card-body bg-light text-center">
            <h1 >Lista de pacientes</h1>
        </div>
    </div>

    <!-- INICIO BUSCADOR-->


    <div class="card bg-light tarjeta mt-4" id="buscador">
        <div class="card-header bg-light text-center">
            <h4 class="">Busqueda de pacientes</h4>
       
        </div>
        <div class="card-body bg-light text-center mt-3">
                   
                <div class="form">
                <form action=" {{url('dashboard/pacientes')}}/{{Auth::user()->id}}" method="get" role="form">
                    <div class="form-row mt-4">
                     
                        <div class="col-12 col-md-4 mb-4">
                          <!--<input name="name" title="Nombre Paciente" class="form-control" type="search" placeholder="Buscar Paciente">-->
                        <input name="name" title="Nombre Paciente" class="form-control" type="search" placeholder="Buscar Paciente"> 
                        </div>
                        <div class="col-12 col-md-4 ">
                            <button class="btn  text-white btn-primaryA"  type="submit">Buscar paciente</button>
                           
                        </div>
                        </form>
                   
                    
                    </div>
                </div>
          
        </div>
    </div>
    <!-- TÉRMINO BUSCADOR-->

    <!-- CASO A -->
    <div class="card tarjeta mt-4 ">
        <div class="table-responsive">

            <table class="table">
                <thead class="thead-light">
                  
                        <th >Rut</th>
                        <th >Nombre</th>
                        <th >Opciones</th>
                        <th >PDF</th>
                </thead>
               
                <tbody>
                @foreach ($buscarPacientes as $paciente)
                <tr>
                    <th>{{$paciente->rut}}</th>
                    <th >{{$paciente->nombre}} {{$paciente->apellido_paterno}}</th>
                    <th><a class="btn btn-info btn-sm " href="{{route('information', ['idpa'=> $paciente->id_persona , 'idpo'=> $info_profesional->id_psicologo])}}">Ver Detalles</a></th>
                    <th><a class="btn btn-success btn-sm " href="{{route('fichaPDF', ['idpa'=> $paciente->id_persona , 'idpo'=> $info_profesional->id_psicologo])}}">Descargar Ficha</a></th>
                </tr> 
                @endforeach
                  
                  
                </tbody>
            </table>
      
        </div>
    </div>
    <!-- TÉRMINO TABLA RESULTADOS -->

</div>
<!-- Fin nueva vista -->
@endsection
