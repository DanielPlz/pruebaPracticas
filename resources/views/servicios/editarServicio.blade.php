<script src="{{asset('assets/js/steperServicioEditar.js')}}"></script>
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-3">Editar un servicio</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>x</span>
                </button>
            </div>
            <div class="model-body " id="modal_body">
            <!-- Formulario para agregar servicios -->
                <div class="card-body">
                    <form id="formEditS" >
                        @csrf
                        <div id="msgErrorEditar"></div>
                        @include('servicios.formPasosEditar')
                        <input type="hidden" id="user_id" name="user_id" value="{{auth()->id()}}"> 
                    </form>
                    <div class="mt-5 pb-5">
                        <div class="col-lg-4 col-6 float-left">
                                <button type="button" class="btn btn-block indigo-border white indigo-text text-4" id="prevBtnEd" onclick="nextPrevEd(-1)"><i class="fas fa-arrow-left"></i> Atras</button>
                        </div>
                        <div class="col-lg-4 col-6 float-right" id="nextEd">
                            <button type="button" class="btn btn-block indigo white-text text-4" id="nextBtnEd" onclick="nextPrevEd(1)">Siguiente <i class="fas fa-arrow-right"></i></button>
                        </div>
                        <div class="col-lg-4 col-6 float-right">
                            <button type="submit" id="editS" style="display:none;" class="btn btn-block green white-text text-4">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
