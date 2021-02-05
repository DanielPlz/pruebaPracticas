 
 <div class="container col 8  ">
     <div class="card ">
         <div class="card-header text-center">
             <div class="row justify-content-center">

          @include('ficha.includes.btnEgresarPaciente')
         
          @include('ficha.includes.btnCertificado')
         </div>
         </div>
         
     </div>
   
     <div id="accordion">
         <div class="card">
             <div class="card-header" id="headingOne">
                 <h5 class="mb-0">
                     @if(session()->has('successem'))
                     <div class="alert alert-danger" role="alert">{{session('successem')}}
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     @endif
                     <button class="btn btn-link link-color" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <strong> Diagn&oacute;stico General</strong>  
                     </button>

                     <div class="dropdown">

                         <!-- Alert -->
                         @if(session()->has('success'))
                         <div class="alert alert-success" role="alert">{{session('success')}}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>

                         @endif
                         <!-- Alert -->

                 </h5>
             </div>

             <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">

                 <!-- listamos los datos de diagnostico que obtenemos desde la base de datos -->
                 <div class="text-center mt-2">
                     <p class="h4 mt-3"> <em>{{$diagnosticog->diag_gral}}</em></p>
                     <div class="row justify-content-center">
                         <p>Fecha Creación {{date('d-m-Y', strtotime($diagnosticog->created_at))}}</p>
                         <p class="ml-4">Fecha de Modificaci&oacute;n {{date('d-m-Y', strtotime($diagnosticog->updated_at))}}</p>
                     </div>
                 </div>


                 <div>
                 @if($caes == 'Activo')
                     <button class="btn btn-primaryB mb-2 ml-3"  type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                         Editar Diagn&oacute;stico
                     </button>
                     @endif
                     <div class="collapse" id="collapseExample">
                         <form action="{{route('editarDiagnosticoG', ['ids'=> $ids ])}}" method="post" role="form">
                             @method('PUT')
                             @csrf
                             <div class="card">
                                 <textarea name="txt_diagnostico_g" class="form-control" id="txt_diagnostico_g" placeholder="Escribe un diagnostico general" required cols="30" rows="6">{{$diagnosticog->diag_gral}}</textarea>
                             </div>
                             <button class="btn btn-primaryA mb-2 ml-3 mt-2" type="submit" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="return confirmation()">
                                 Guardar Cambios
                             </button>

                     </div>


                     </form>


                 </div>
             </div>



         </div>

     </div>
 </div>