<div class="modal fade p-0" id="create-testimonio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reseñas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pl-5 pr-5">
                <form action="/testimonios/guardar" method="POST">
                    @csrf
                    <input type="hidden" name="profesional_id" value="{{$user->id}}">
                    <div class="form-group">
                        <h3 class="text-5 darkgray-text text-bold">Evalúe su experiencia</h3>
                        <div class="form-row w-100">
                            <div class="rating">
                                <div class="stars">
                                    <input type="radio" name="valoracion" class="star star-5" value="5" id="star-5">
                                    <label for="star-5" class="star star-5"></label>
                                    
                                    <input type="radio" name="valoracion" class="star star-4" value="4" id="star-4">
                                    <label for="star-4" class="star star-4"></label>
                                    
                                    <input type="radio" name="valoracion" class="star star-3" value="3" id="star-3">
                                    <label for="star-3" class="star star-3"></label>

                                    <input type="radio" name="valoracion" class="star star-2" value="2" id="star-2">
                                    <label for="star-2" class="star star-2"></label>
                                    
                                    <input type="radio" name="valoracion" class="star star-1" value="1" id="star-1">
                                    <label for="star-1" class="star star-1"></label>
                                </div>
                            </div>
                        </div>
                    </div>		
                    <div class="form-group">
                        <label for="" class="text-5 darkgray-text text-bold">Título*</label>
                        <input type="text" placeholder="Escriba un título" class="form-control text-4 bluegray-text" id="title" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="text-5 darkgray-text text-bold">Testimonio*</label>
                        <textarea class="form-control text-4 bluegray-text" placeholder="Escriba su testimonio" rows="5" id="comment" name="comentario" required></textarea>
                    </div>
                    <div class="form-group">
                        <input class="toggle-state" type="checkbox" id="myCheck" name="anonimo"/>
                        <label class="text-4 bluegray-text">Publicar testimonio como anónimo</label>
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-block green white-text text-4 rounded-pill">Registrar testimonio</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>