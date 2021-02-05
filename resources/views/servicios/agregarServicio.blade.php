<script src="{{asset('assets/js/steperServicio.js')}}"></script>
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-3">Agregar un servicio</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>x</span>
                </button>
            </div>
            <div class="model-body " id="modal_body">
            <!-- Formulario para agregar servicios -->
                <div class="card-body">
                    <form id="formAddS" >
                        @csrf
                        @include('servicios.pasos')
                        <div id="msgError"></div>
                        @include('servicios.formPasos')
                        <input type="hidden" id="user_id" name="user_id" value="{{auth()->id()}}"> 
                    </form>
                    <div class="mt-5 pb-5">
                        <div class="col-lg-4 col-6 float-left">
                                <button type="button" class="btn btn-block indigo-border white indigo-text text-4" id="prevBtn" onclick="nextPrev(-1)"><i class="fas fa-arrow-left"></i> Atras</button>
                        </div>
                        <div class="col-lg-4 col-6 float-right" id="next">
                            <button type="button" class="btn btn-block indigo white-text text-4" id="nextBtn" onclick="nextPrev(1)">Siguiente <i class="fas fa-arrow-right"></i></button>
                        </div>
                        <div class="col-lg-4 col-6 float-right" >
                            <button type="submit" id="addS" style="display:none;" class="btn btn-block green white-text text-4">Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
