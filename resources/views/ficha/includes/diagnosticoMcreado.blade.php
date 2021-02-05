<div class="container col 8 ">
    <div class="card ">
        <div class="card-header text-center">
            <div class="row justify-content-center">

            @include('ficha.includes.btnEgresarPaciente')
            @include('ficha.includes.btnCertificado')
            </div>
        </div>


        <div id="accordion1">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn link-color"  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <strong>     Manual {{$manuniC->nombre}}</strong>
                        </button>
                        <!-- Alert -->
                        @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">{{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- Alert -->
                        <!-- Alert -->
                        @if(session()->has('successem'))
                        <div class="alert alert-success" role="alert">{{session('successem')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @endif
                        <!-- Alert -->
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion1">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <p>Fecha Creaci&oacute;n {{date('d-m-Y', strtotime($fecha->created_at))}}</p>
                            <p class="ml-3">Fecha de Modificaci&oacute;n {{date('d-m-Y', strtotime($fecha->updated_at))}}</p>
                        </div>
                        @foreach($manualC as $manual)
                        <div class="row">
                            <p class="ml-3"><strong>{{$manual->ficha_diagnostico_eje->ficha_eje_manual->nombre}}</strong></p>
                        </div>
                        <p> - {{$manual->ficha_diagnostico_eje->descripcion}} </p>


                        @endforeach
                    </div>
                    <div class="ml-3 mt-1 text-secondary">
                        <small>
                            <em class="mt-n3">{{$manuniC->copyright}}</em>
                         
                        </small>
                    
                </div>
                <div class="">

                    <h5 class="mb-0">
                    @if($caes == 'Activo')
                        <button class="btn ml-2 mb-2 mt-2 btn-primaryB collapsed"   data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Editar Diagn&oacute;stico  
                        </button>
                    @endif
                    </h5>

                    <form action="{{route('editarDiagnosticoM', [ 'ids'=> $ids ])}}" method="post" role="form">
                        @method('PUT')
                        @csrf
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" >
                            @foreach($manualC as $eje)
                            <div class="card-body">
                                <p class="h5">{{$eje->ficha_diagnostico_eje->ficha_eje_manual->nombre}} </h4>
                                    <textarea name="txt_{{$eje->ficha_diagnostico_eje->id}}" class="form-control" id="txt_diagnostico_g" cols="30" rows="3">{{$eje->ficha_diagnostico_eje->descripcion}}</textarea>
                                    
                            </div>

                            
                            @endforeach
                            
                            <button type="submit" class="btn ml-3 mt-2 mb-2 btn-primaryA" onclick="return confirmation()">Guardar Cambios</button>
                        </div>
                 
                    </form>
                </div>
            </div>


        </div>



    </div>




</div>

</div>