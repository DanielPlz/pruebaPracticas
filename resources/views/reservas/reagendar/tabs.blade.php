<input type="hidden" name="cita_id" value="{{$cita->id}}">
<div class="tab text-4" id="tab">
    <div class="text-center mb-4">
        <h1 class="title-4 darkblue-text">
            Seleccione su servicio
        </h1>
    </div>
    <div class="form-group row">
        <div class="col-md-12 contenedor" id="contenedor">
            <div class="mt-1 form-group">
                <label for="servicio_id" class="text-5 darkgray-text text-bold">Servicio</label>
                <input type="hidden" id="servicio_id" value="{{$servicio->id}}">
                <input type="text" placeholder="{{$servicio->nombre}}" class="form-control"  disabled>
            </div>
            <div>
                <label for="modalidad" class="text-5 darkgray-text text-bold">Modalidad</label>
                <select class="custom-select text-4 bluegray-text" name="modalidad" id="modalidad">
                    @if($modalidad[0]->presencial == 1)
                        @if($cita->modalidad == "Presencial")
                            <option value="Presencial" class="text-4 bluegray-text" selected>Presencial</option>
                        @else
                        <option value="Presencial" class="text-4 bluegray-text">Presencial</option>
                        @endif
                    @endif
                    @if($modalidad[0]->online == 1)
                        @if($cita->modalidad == "Online")
                            <option value="Online" class="text-4 bluegray-text" selected>Online</option>
                        @else
                        <option value="Online" class="text-4 bluegray-text" >Online</option>
                        @endif
                    @endif
                    @if($modalidad[0]->visita == 1)
                        @if($cita->modalidad == "Visita")
                            <option value="Visita" class="text-4 bluegray-text" selected>Visita</option>
                        @else
                        <option value="Visita" class="text-4 bluegray-text" >Visita</option>
                        @endif
                    @endif
                </select>
            </div>
            @if($modalidad[0]->visita == 1)
                @if($cita->modalidad == "Visita")
                <div class="pl-3 pr-3 mt-3 text-4 bluegray-text" id=radio_b >
                    <div class='form-check'>
                        <input class='form-check-input mt-3' type='radio' name='radio1' value='1' checked>
                        <input disabled type='text' class='form-control text-4 bluegray-text' value='{{$cita->locacion}}' id='original' required>
                    </div>
                    <div class='form-check mt-3'>
                        <input class='form-check-input mt-3' type='radio' name='radio1' value='2'>
                        <input type='text' id='secundario' placeholder='Direccion opcional' class='form-control text-4 bluegray-text' required>
                    </div>
                </div>
                @endif  
            @endif
            <div id="prevision_id" class="mt-1 form-group">
                <label for="prevision" class="text-5 darkgray-text text-bold">Prevision
                </label>
                <input type="text" placeholder="{{$cita->prevision}} " class="form-control float-right" disabled>
                
            </div>
                @if($cita->prevision == "Isapre")
                <div class="mt-1 form-group"> 
                    <label for="prevision" class="text-5 darkgray-text text-bold">Isapre</label>
                    <input type="text" placeholder="{{$cita->isapre}} " class="form-control" disabled>
                </div>
                @endif

                

                
        </div>
    </div>
</div>
<div class="tab text-4">

    <div class="text-center mb-4">
        <h1 class="title-4 darkblue-text">
            Seleccione fecha
        </h1>
    </div>
    <div class="form-group row">
        <div class="col-md-12 contenedor" id="contenedor_fecha">
            <div class="form-group">
                <label for="custom-select" class="col-md-12 text-5 darkgray-text text-bold">Fecha</label>
                <div>
                    <input class="form-control" name="fecha" type="date" value="" id="fecha">
                </div>
            </div>
            <input type="hidden" id="termino" name="hora_terminoD">
        </div>
    </div>
</div>
<div class="tab text-4">

    <div class="text-center mb-4">
        <h1 class="title-4 darkblue-text">
            Detalles de tu reserva
        </h1>
        
    </div>
    <div class="form-group row">
        <div class="col-md-12 contenedor" id="contenedor_detalle">
            <table class="table table-bordered table-hover">

                <tbody>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Servicio</label></th>
                        <td class="text-4 bluegray-text" id="servicioD">{{$servicio->nombre}}</td>
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Direccion</label></th>
                        <td class="text-4 bluegray-text" id="direccionD"></td>
                        <input type="hidden" name="direccionD" id="direccion">
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Modalidad</label></th>
                        <td class="text-4 bluegray-text" id="modalidadD"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Fecha</label></th>
                        <td class="text-4 bluegray-text" id="fechaD"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Hora inicio</label></th>
                        <td class="text-4 bluegray-text" id="hora_inicioD"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Hora termino</label></th>
                        <td class="text-4 bluegray-text" id="hora_terminoD"></td>
                    </tr>
                    <tr>
                    <th scope="row"><label class="text-5 darkgray-text text-bold"></label>Previsión</th>
                        @if($cita->prevision == "Isapre")
                        <td class="text-4 bluegray-text" id="previsionD">{{$cita->prevision}}({{$cita->isapre}})</td>
                        @else
                        <td class="text-4 bluegray-text" id="previsionD">{{$cita->prevision}}</td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold"></label>Precio</th>
                        <td class="text-4 bluegray-text" id="precioD">${{$cita->precio}}</td>
                    </tr>
                    
                </tbody>
            </table>
            <label><input class="" type="checkbox" id="condicionesid"  name="condiciones"> si acepto los terminos y condiciones. <a href="" data-dismiss="modal"  data-toggle="modal" data-target="#condiciones">Leer mas</a> </label><br>
        </div>
    </div>
@section('script')
    <script src="{{asset('assets/js/modal_reagendar.js')}}"></script>
@endsection