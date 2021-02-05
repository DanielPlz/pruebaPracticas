<button 
    id="btnServ"
    type="button" 
    data-id="{{$servicio->id}}"
    echo='{{$servicio->id}}'
    data-duracion="{{$servicio->duracion}}"
    class="btn btn-sm indigo-text"
    data-toggle="popover" 
    data-placement="bottom" 
    title="{{$servicio->nombre}}"
    data-html= "true"
    data-content="<div class='desc'><b>Descripción: </b>{{$servicio->descripcion}}</div>
                  <div><b>Duración: </b> <span id='duracionZ{{$servicio->id}}'></span> </div> 
                  <div><b>Modalidad:</b>
                    @if($servicio->modalidad[0]->presencial != null)
                        <li>
                            Presencial: <i class='fas fa-check indigo-text'></i>
                        </li>
                    @endif
                    @if($servicio->modalidad[0]->online != null)
                        <li>
                            Atención remota: <i class='fas fa-check indigo-text'></i>
                        </li>
                    @endif
                    @if($servicio->modalidad[0]->visita != null)
                        <li>
                            Visita domiciliaria: <i class='fas fa-check indigo-text'></i>
                        </li>
                    @endif
                  </div>
                  <div><b>Precios:</b>
                        @if($servicio->precio[0]->precioFonasa != null)
                            <li>
                                Fonasa: ${{$servicio->precio[0]->precioFonasa}}
                            </li>
                        @endif
                        @if($servicio->precio[0]->precioIsapre != null)
                            <li>
                                Isapre: ${{$servicio->precio[0]->precioIsapre}}
                            </li>
                        @endif
                        @if($servicio->precio[0]->precioParticular != null)
                            <li>
                                Particular: ${{$servicio->precio[0]->precioParticular}}
                            </li>
                        @endif
                    </div>
                    @if($servicio->precio[0]->precioIsapre != null)
                        <div><b>Isapres disponibles:</b>
                            @if($servicio->isapre[0]->banmedica != null)
                                <li>Banmédica</li>
                            @endif
                            @if($servicio->isapre[0]->consalud != null)
                                <li>Consalud</li>
                            @endif
                            @if($servicio->isapre[0]->colmena != null)
                                <li>Colmena</li>
                            @endif
                            @if($servicio->isapre[0]->cruzblanca != null)
                                <li>CruzBlanca</li>
                            @endif
                            @if($servicio->isapre[0]->masvida != null)
                                <li>Nueva Masvida</li>
                            @endif
                            @if($servicio->isapre[0]->vidatres != null)
                                <li>Vida Tres</li>
                            @endif
                        </div>
                    @endif
                  
                  ">
    <i class="fas fa-plus"></i>
</button> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        //toggle del popover

        $('[data-toggle="popover"]').popover();

        //Mostrar la duración del servicio con formato

        $('button[id=btnServ]').on('click',function () {
            var id = $(this).data("id");
            var duracion = $(this).data("duracion");
            var duracion_partes = duracion.split(':');
            var hora = duracion_partes[0];
            var minuto = duracion_partes[1];
            var boton = "#duracionZ"+id;
            if(hora>0){
                if(minuto>0){
                    console.log('XD');
                    $(boton).text('1 hora y 30 minutos.');
                }else{
                    $(boton).text('1 hora.');
                }
            }
            if(hora == 0){
                $(boton).text(minuto+' minutos.');
            }
        });
    });

</script>
