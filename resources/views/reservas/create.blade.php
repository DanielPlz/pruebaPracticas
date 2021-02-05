<div class="modal fade" id="create">
    <div class="modal-dialog">
        <form method="POST" action="{{route('reserva.create')}}" id="modalForm">
            <div class="modal-content">
                <div class="card-body p-4">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>x</span>
                    </button>
                    <h4 class="mb-3">Reserva</h4>
                </div>
                <div class="modal-body p-4" id="model_body">
                    @csrf
                    @include('reservas.steps')
                    <div id="mensaje">
                  </div>
                    @include('reservas.tabs')
                </div>
                <div class="" id="modal_footer">
                    <div class="col-lg-4 col-5 float-left">
                        <button type="button" class="btn btn-block indigo-border white indigo-text text-4" id="prevBtn" onclick="nextPrev(-1)"></button>
                        <button type="button" class="btn btn-block indigo-border white indigo-text text-4" id="prev" style="display: none;" ><i class="fas fa-arrow-left"></i> Atras</button>
                    </div>
                    <div class="col-lg-4 col-6 float-right" id="next">
                        <button type="button" class="btn btn-block indigo white-text text-4" id="button">Siguiente <i class="fas fa-arrow-right"></i></button>
                        <button type="button" class="btn btn-block indigo white-text text-4" id="nextBtn"  onclick="nextPrev(1)"></button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>