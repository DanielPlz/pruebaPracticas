@extends('layouts.dashboard')
@section('contentSidebar')
<!-- INICIO MENÚ 'VER DIAGNÓSTICO PSICOLÓGICO'-->



<div class="container_information">
    <div class="row_diagnostico_manual">
        <div class="col">
            <a class="btn btn-danger stretched-link">Volver</a>
        </div>
        <div class="col">
            <h3 class="card-title">Menú Ver Diagnósticos</h3>
        </div>
        <div class="col">
            <h5>Paciente : </h5>
            <h5>N° Ficha : </h5>
        </div>
    </div>
</div>
<!-- TÉRMINO MENÚ 'VER DIAGNÓSTICO PSICOLÓGICO' -->



<!-- INICIO SECCIÓN MOSTRAR DIAGNÓSTICOS -->
<!-- INICIO SECCIÓN MOSTRAR DIAGNÓSTICOS -->
<div class="card text-center container_information">
    <div class="card-body col-12">
        <h3 class="card-title">Diagnósticos realizados</h3>
        <div class="evaluacion">

            <!-- Permite la edición de diagnóstico si existe en base de datos -->
          
            <div class="form-row">

                <div class=" mr" style="margin-left: 30%;">
                    <label  for="">Fecha Creación </label>
                </div>
                <div class="mr ml-5">
                    <label for="">Última actualización </label>
                </div>
            </div>
            <!-- <textarea class="form-control" readonly id="txt_descripcion_diagnostico" name="txt_descripcion_diagnostico" rows="4"></textarea> -->
            <p></p>
            <div class="col">
                <!-- <a href="#" class="btn btn-info" id="editar_diagnostico" name="editar_diagnostico">Editar Diagnóstico</a> -->
              
                <a class="btn btn-success btn_editar_diagnostico" data-toggle="collapse" href="#ctn_editar_diagnostico" role="button" aria-expanded="false" aria-controls="ctn_evaluacion1">Editar Diagnóstico</a>
                <div class="collapse multi-collapse ctn_comentario" id="ctn_editar_diagnostico">
                  
                        @method('PUT')
                        @csrf
                        <div class="form-group mt-4" >
                            <textarea class="form-control" id="txt_editar_diagnostico" name="txt_editar_diagnostico" rows="8" required></textarea>
                        </div>
                        <div class="evaluacion__1">
                            <button type="submit" class="btn btn-primary" id="manual3" name="btn_manual3" onclick="return confirmation()">Guardar Cambios</button>
                            <!-- Alerta de confirmación -->
                        </div>
                   
                </div>
            </div>
        </div>
       

 
   
        <!-- Si no existe diagnóstico en base de datos -->
        <div class="card text-center container_information">
            <div class="card-body">
                <h3 class="card-title">No existe diagnóstico</h3>
                <a class="btn btn-primary stretched-link">Crear Diagnóstico</a>
            </div>
        </div>
    


        
        <!-- Alert -->
       
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
       
        <!-- Alert -->
    </div>

    

    <!-- TÉRMINO SECCIÓN MOSTRAR DIAGNÓSTICOS -->
    <!-- INICIO MOSTRAR MANUALES -->

    

   
    
   <div class="col-12">        
    

   
    </div>

    <!-- TÉRMINO MOSTRAR MANUALES -->
    <!-- INICIO SECCIÓN COMENTARIOS -->
        <!-- Sección comentarios -->
    <div class="table-responsive">  
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Observaciones</th>
                <th>Fecha Creación</th>
            </tr>
        </thead>
        <tbody>
          
                <div>
                    <td class="text-left"></td>
                </div>
                <div>
                    <td></td>
                </div>
            </tr>
        
        </tbody>
    </table>
    </div>
        <!-- Fin sección comentarios -->


    <a class="btn btn-primary btn_comentario" data-toggle="collapse" href="#ctn_comentario" role="button" aria-expanded="false" aria-controls="ctn_evaluacion1">Crear nuevo comentario</a>
    <div class="collapse multi-collapse ctn_comentario" id="ctn_comentario">
      
            @csrf
            <div class="form-group">
                <textarea class="form-control" id="txt_nuevo_comentario" name="txt_nuevo_comentario" rows="2" required></textarea>
            </div>
            <div class="evaluacion__1">
                <button type="submit" class="btn btn-primary" id="comentario" name="btn_comentario" onclick="return confirmation()">Guardar Comentario</button> </div>
    </div>
    
    <!-- Alert -->
  
    <div class="alert alert-success" role="alert">{{session('successgc')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
   
    <!-- Alert -->
</div>
<!-- TÉRMINO SECCIÓN COMENTARIOS -->
@endsection