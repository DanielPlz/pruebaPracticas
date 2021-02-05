<div class="tab text-4" id="tab">

    <div class="text-center mb-4">
        <h1 class="title-4 darkblue-text" id="h1">
            Identificación del paciente
        </h1>
    </div>
    <div class="form-group row">
        <div class="col-md-12 contenedor" id="contenedor">




            <div id="datos_rut">
                <form action="">
                    <div class="form-group row pl-3 pr-3 mb-3">
                        <label class="col-md-12 text-5 darkgray-text text-bold">Correo</label>
                        <div class="col-md-12">
                            <input id="correo" type="email" class="form-control text-4 bluegray-text" name="correo" value="" required="" autocomplete="correo">
                        </div>
                    </div>
                    <div class="form-group row pl-3 pr-3 mb-3">
                        <label for="telefono" class="col-md-12 text-5 darkgray-text text-bold">Telefono</label>

                        <div class="col-5">
                            <input disabled="" type="text" class="form-control text-4 bluegray-text" name="codigo" id="codigo" value="+569">
                        </div>
                        <div class="col-7">
                            <input id="telefono" maxlength="9" minlength="1" type="Tel" class="form-control text-4 bluegray-text pt-2 pb-2 " placeholder="Telefono" name="telefono" value="" autocomplete="telefono" autofocus="">

                        </div>
                    </div>
                    <div class="form-group row pl-3 pr-3 mb-3">
                        <label class="col-md-12 text-5 darkgray-text text-bold">Rut</label>
                        <div class="col-12">
                            <input id="rut" type="text" placeholder="Rut" class="form-control text-4 bluegray-text" name="rut" value="" required="" autocomplete="rut">
                        </div>
                    </div>
                    <div class="form-group row pl-3 pr-3 mb-3">
                        <label class="col-md-6 text-5 darkgray-text text-bold">Nombre completo</label>
                        <div class="col-6">
                            <input id="nombre" type="text" placeholder="Nombre" class="form-control text-4 bluegray-text" name="nombre" value="" required="" autocomplete="nombre">
                        </div>
                        <div class="col-6">
                            <input id="nombre" type="text" placeholder="Apellido" class="form-control text-4 bluegray-text pt-2 pb-2" name="apellido" value="" required="" autocomplete="apellido">
                        </div>
                    </div>
            </div>
            <div id="servicios" style="display: none;" >
                <label for="servicio_id" class="text-5 darkgray-text text-bold"  id="label_id">Servicio</label>
                @if(count($user->servicios)>0)
                <select class="custom-select text-4 bluegray-text"  name="servicio_id" id="servicio_id">
                    <option value="" class="text-4 bluegray-text">Indica tu Servicio</option>
                    @foreach($user->servicios as $nombre)
                    <option value="{{$nombre->id}}" class="text-4 bluegray-text">{{$nombre->nombre}}</option>
                    @endforeach
                </select>
                @endif
            </div>
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
                        <td class="text-4 bluegray-text" id="servicioD"></td>
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
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Prevision</label></th>
                        <td class="text-4 bluegray-text" id="previsionD"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Precio</label></th>
                        <td class="text-4 bluegray-text" id="precioD"></td>
                        <input type="hidden" name="precioD" id="precio">
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Nombre</label></th>
                        <td class="text-4 bluegray-text" id="nombreD"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Rut</label></th>
                        <td class="text-4 bluegray-text" id="rutD"></td>
                        <input type="hidden" name="rutD" id="rutDa">
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Correo</label></th>
                        <td class="text-4 bluegray-text" id="correoD"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label class="text-5 darkgray-text text-bold">Telefono</label></th>
                        <td class="text-4 bluegray-text" id="telefonoD"></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>
        <label><input class="" type="checkbox" id="condicionesid" name="condiciones"> Si, acepto los terminos y condiciones. <a href="" data-dismiss="modal" data-toggle="modal" data-target="#condiciones">Leer mas</a> </label>
    </div>
    <!-- @section('script_reservas')
    <script src="{{asset('assets/js/funciones.js')}}"></script>
    <script src="{{asset('assets/js/modal_create_reservas.js')}}"></script>
    @endsection -->
    {{-- @section('script') --}}
    {{-- <script src="{{asset('assets/js/funciones.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/modal_create_reservas.js')}}"></script> --}}
    {{-- @endsection --}}
