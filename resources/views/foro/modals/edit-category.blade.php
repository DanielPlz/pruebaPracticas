<!-- Modal editar -->
<div class="modal fade" id="modalCatEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar Categoria</h5>
                <button align="right" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formCatEdit">
                    @method('PUT')
                    <input type="hidden" id="catEditId" name="catEditId" value="0">
                    <div>
                        <div>
                            <label>Titulo</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="titulo" id="boxCatEditTitulo" autocomplete="name" autofocus>
                        </div>
                        <div>
                            <label>Descripcion</label>
                            <textarea type="text" class="form-control" id="boxCatEditDescripcion" name="descripcion" style="height: 20vh;" required autocomplete="description" autofocus></textarea>
                        </div>
                    </div>
                </form>

                <ul class="errorMsg mt-3"></ul>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnCatEdit" class="btn btn-primary">Editar</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>