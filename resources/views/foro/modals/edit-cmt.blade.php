<div class="modal fade" id="modalCmtEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar comentario</h5>
                <button align="right" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formCmtEdit">
                    @method("PUT")
                    <input type="hidden" id="cmtEditId" name="cmtEditId" value="0">
                    <textarea type="text" class="form-control" id="boxCmt" name="comment"
                                autocomplete="content" style="height: 25vh;" required  autofocus></textarea>
                </form>

                <ul class="errorMsg mt-3"></ul>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button id="btnCmtEdit" class="btn btn-primary">Editar</button>
            </div>
        </div>
    </div>
</div>
