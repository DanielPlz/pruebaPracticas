<div class="modal fade" id="modalCatAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Crear Categoria</h5>
                <button align="right" type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formCatAdd">
                    @csrf
                    <div>
                        <label>Titulo</label>
                        <div>
                            <input type="text" class="form-control" id="boxCatTitulo" name="titulo" autocomplete="title" autofocus>
                        </div>
                    </div>
                    <div>
                        <label>Descripcion</label>
                        <div>
                            <textarea type="text" class="form-control" id="boxCatDescripcion" name="descripcion"
                                autocomplete="content" style="height: 20vh;" autofocus></textarea>
                        </div>
                    </div>
                </form>
                
                <ul class="errorMsg mt-3"></ul>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn green white-text text-4" id="btnCatAdd">Publicar</button>
            </div>
        </div>
    </div>
</div>
