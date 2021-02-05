 
        <div class="container col 8 ">
            <div class="card ">
                <div class="card-header text-center">
                    <p class="h3">Diagn&oacute;stico de la sesion</p>
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
                                @if(session()->has('warning'))
                                <div class="alert alert-danger" role="alert">{{session('warning')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                @endif
                                <!-- Alert -->
                 </div>
                 <!-- DiagnosticoG -->
                 <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Crear Diagn&oacute;stico General
                                </button>
                            </h5>
                        </div>

                        <div id="collapseFour" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            {{-- <form action="{{route('crearDiagnosticoG', ['ids'=> $ids ])}}" method="post" role="form"> --}}
                                @csrf
                                <div class="card">
                                    <textarea name="txt_diagnostico_g" class="form-control" id="txt_diagnostico_g" placeholder="Escribe un diagnostico general" required cols="30" rows="6"></textarea>
                                </div>

                                <div>

                                    <button type="submit" class="btn ml-3 mt-2 mb-2 indigo text-white">Crear Diagn&oacute;stico</button>
                            </form>
                        </div>
                    </div>



                 </div>
                 <div class="card">
                    <div class="card-header" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Crear Diagn&oacute;stico por Manual
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="collapseFive" data-parent="#accordion">
                        <div class="card-body">

                            <div>


                                <div id="accordion1">
                                    <div class="card">
                                        <div class="card-header" id="headingOne1">
                                            <h5 class="mb-0">

                                                <div class="dropdown">
                                                    <button class="btn indigo white-text dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Seleciona Manual
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                       {{--  @foreach($manuni as $manuales)
                                                        <button class="btn btn-link dropdown-item" data-toggle="collapse" data-target="#m{{$manuales->id}}" aria-expanded="true" aria-controls="collapseOne1">
                                                            {{$manuales->nombre}}
                                                        </button>
                                                        @endforeach --}}
                                                    </div>
                                                </div>
                        


                                            </h5>
                                        </div>
                                      {{--   <form action="{{route('crearDiagnosticoM', [ 'ids'=> $ids ])}}" method="post" role="form">
                                            @csrf --}}

                                       {{--      @foreach($manual as $eje )
                                            <div id="m{{$eje->id_manual}}" class="collapse " aria-labelledby="headingOne1" data-parent="#accordion1">
                                                <div class="card-body">
                                                    <p class="h5">{{$eje->nombre}} </h4>
                                                        <textarea name="txt_eje_{{$eje->id}}" class="form-control" id="txt_diagnostico_g" cols="30" rows="3" ></textarea>
                                                </div>
                                                <div>
                                                    <input type="hidden" name="txt_id_{{$eje->id}}" id="" value="{{$eje->id}}"></input>
                                                </div>

                                            </div>

                                            @endforeach --}}
                                            <div  class="collapseTwo " aria-labelledby="headingOne1" data-parent="#accordion">
                                                <div class="ml-3 mt-1 text-secondary">
                                                    <small>
                                                        <p><em>Copyright ©, 2000, AMERICAN PSYCHIATRIC ASSOCIATION (APA). Diagnostic and Statistical Manual of Mental Disorders (DSM-IV-TR)</p>
                                                        <p class="mt-n3"><em>Copyright ©, 2013, AMERICAN PSYCHIATRIC ASSOCIATION (APA). Diagnostic and Statistical Manual of Mental Disorders (DSM-5).</p>
                                                        <p class="mt-n3"><em>Copyright ©, 1992, International Statistical Classification of Diseases and Related Health Problems (ICD-10)</em></p>
                                                    </small>
                                                </div>
                                            </div>
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn ml-3 mt-2 mb-2 indigo text-white">Crear Diagn&oacute;stico</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>