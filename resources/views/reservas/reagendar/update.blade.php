<div class="modal fade" id="update">
    <div class="modal-dialog">
        <form method="POST" action="{{route('reagendar')}}" id="modalForm">
            <div class="modal-content">
                <div class="card-body p-4">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>x</span>
                    </button>
                    <h4 class="mb-3">Reagendar reserva</h4>
                </div>
                <div class="modal-body p-4" id="model_body">
                    @csrf
                    @include('reservas.reagendar.steps')
                    <div id="mensaje"></div>
                    @include('reservas.reagendar.tabs')
                </div>
                <div class="" id="modal_footer">
                    <div class="col-lg-4 col-5 float-left">
                        <button type="button" class="btn btn-block indigo-border white indigo-text text-4" id="prevBtn" onclick="nextPrev(-1)"></button>
                    </div>
                    <div class="col-lg-4 col-6 float-right" id="next">
                        <button type="button" class="btn btn-block indigo white-text text-4" id="nextBtn" onclick="nextPrev(1)"></button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>