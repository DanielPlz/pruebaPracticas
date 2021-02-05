<div class="modal fade modalUserFail"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">                
                <label class="h5" id="userFail"></label>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>                
            <div class="h5 modal-body text-center">
                <br>
                <br>
                <h4 align="center"><a href="{{ url('/register') }}" class="nav-link" >Crea tu cuenta</a></h4>
                <label>O bien...</label>
                <h4 align="center"><a href="{{ url('/login') }}" class="nav-link" >Inicia sesion</a></h4>
                <br>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>