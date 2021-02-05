<!-- tab paso 1: Datos del servicio -->
<script src="{{ asset('assets/js/servicios/cargarDatosEditar.js') }}"> </script>
<input type="hidden" id="servicio_id_edit" name="servicio_id">
<div class="tabEd text-4">
    <div class="text-center mb-4">
        <h1 class="title-4 darkblue-text">
            Ingrese los datos del servicio
        </h1>
    </div>
    <div class="form-group row pl-3 pr-3 mb-3">
        <div class="col-md-12 mb-3 mb-lg-0">
            <label for="nombre" class="text-5 darkgray-text text-bold">{{ __('* Nombre') }}</label>
            <input id="nombreEd" type="text" class="form-control text-4 bluegray-text validar" name="nombreEd" required>
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row pl-3 pr-3 mt-4 mb-3">
        <label class="col-md-12 text-5 darkgray-text text-bold">{{ __('Descripción') }}</label>
        <div class="col-md-12">
            <textarea class="form-control pt-2 pb-2 text-4 bluegray-text" id="descripcionEd" name="descripcionEd" placeholder="Máx. 100 caracteres" maxlength="100"></textarea>
        </div>
    </div>
    <div class="form-group row pl-3 pr-3 mb-3">
        <label for="duracion" class="col-md-12 text-5 darkgray-text text-bold">{{ __('* Duración') }}</label>
        <div class="col-12">
            <select name="duracionEd" id="duracionEd" class="form-control form-control-sm validar @error('duracion') is-invalid @enderror" required>
                <option value="">-</option>
                <option value="00:15:00">15 minutos</option>
                <option value="00:30:00">30 minutos</option>
                <option value="01:00:00">60 minutos</option>
                <option value="01:30:00">90 minutos</option>
            </select>
            @error('duracion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<!-- tab paso 2: Modalidad de atención -->

<div class="tabEd">
    <div class="text-center mb-4">
        <h1 class="title-4 darkblue-text">
            Modalidad de atención
        </h1>
    </div>
    <div class="row no-gutters d-flex justify-content-center mb-3">
        <div class="col-2 col-lg-2">
            <div class="card-body p-lg-3 p-2">
                <div class="form-check">
                    <label > 
                        <input type="checkbox" class="form-check-input validar" id="presencialEd" name="presencialEd" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="col-10 col-lg-10 align-self-center">
            <div class="card-body p-lg-3 p-2 lightgray-border">
                <h3 class="text-4 darkgray-text mb-0"> Presencial</h3>
            </div>
        </div>
    </div>
    <div class="row no-gutters d-flex justify-content-center mb-3">
        <div class="col-2 col-lg-2">
            <div class="card-body p-lg-3 p-2">
                <div class="form-check">
                    <label> 
                        <input type="checkbox" class="form-check-input validar" id="onlineEd" name="onlineEd" value="1">        
                    </label>
                </div>
            </div>
        </div>
        <div class="col-10 col-lg-10 align-self-center">
            <div class="card-body p-lg-3 p-2 lightgray-border">
                <h3 class="text-4 darkgray-text mb-0"> Atención remota</h3>
            </div>
        </div>
    </div>
    <div class="row no-gutters d-flex justify-content-center mb-3">
        <div class="col-2 col-lg-2">
            <div class="card-body p-lg-3 p-2">
                <div class="form-check">
                    <label>
                        <input type="checkbox" class="form-check-input validar" id="visitaEd" name="visitaEd" value="1"> 
                    </label>
                </div>
            </div>
        </div>
        <div class="col-10 col-lg-10 align-self-center">
            <div class="card-body p-lg-3 p-2 lightgray-border">
                <h3 class="text-4 darkgray-text mb-0"> Visita domiciliaria</h3>
            </div>
        </div>
    </div>
</div>

<!-- tab paso 3 Seleccionar precios y previsiones disponibles  -->

<div class="tabEd">
    <div class="text-center">
        <h1 class="title-4">Previsiones disponibles</h1>
    </div>
    <div class="row no-gutters d-flex justify-content-center mb-3">
        <div class="col-2 col-lg-2">
            <div class="card-body p-lg-3 p-2">
                <div class="form-check">
                    <label > 
                        <input class="form-check-input validarPrevisionEd" type="checkbox" id="checkFonasaEd" value="fonasa">
                    </label>
                </div>
            </div>
        </div>
        <div class="col-10 col-lg-10 align-self-center">
            <div class="card-body p-lg-3 p-2 lightgray-border">
                <span >Fonasa
                    <input type="number" class="form-control form-control-sm precios @error('fonasa') is-invalid @enderror" id="precioFonasaEd" name="precioFonasaEd" placeholder="Precio en Fonasa">
                </span>
                @error('fonasa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row no-gutters d-flex justify-content-center mb-3">
        <div class="col-2 col-lg-2">
            <div class="card-body p-lg-3 p-2">
                <div class="form-check">
                    <label> 
                        <input class="form-check-input validarPrevisionEd" type="checkbox" id="checkIsapreEd" value="isapre">      
                    </label>
                </div>
            </div>
        </div>
        <div class="col-10 col-lg-10 align-self-center">
            <div class="card-body p-lg-3 p-2 lightgray-border">
                <span >Isapre
                    <input type="number" class="form-control form-control-sm precios" id="precioIsapreEd" name="precioIsapreEd" placeholder="Precio en Isapre">
                </span>
            </div>
            <div class="container">
                <div id="checkboxesLeftEd" class="divIsapre">
                    <div class="form-check">
                        <label for="one">
                            <input type="checkbox" class="isapresEd" id="banmedicaEd" name="banmedicaEd" value="1"/> Banmédica
                        </label>
                    </div>
                    <div class="form-check">
                        <label for="two">
                            <input type="checkbox" class="isapresEd" id="consaludEd" name="consaludEd" value="1"/> Consalud
                        </label>
                    </div>
                    <div class="form-check">
                        <label for="three">
                            <input type="checkbox" class="isapresEd" id="colmenaEd" name="colmenaEd" value="1"/> Colmena
                        </label>
                    </div>
                </div>
                <div id="checkboxesRightEd" class="divIsapre">
                    <div class="form-check">
                        <label for="four">
                            <input type="checkbox" class="isapresEd" id="cruzBlancaEd" name="cruzBlancaEd" value="1"/> CruzBlanca
                        </label>
                    </div>
                    <div class="form-check">
                        <label for="five">
                            <input type="checkbox" class="isapresEd" id="masVidaEd" name="masVidaEd" value="1"/> Nueva Masvida
                        </label>
                    </div>
                    <div class="form-check">
                        <label for="six">
                            <input type="checkbox" class="isapresEd" id="vidaTresEd" name="vidaTresEd" value="1"/> Vida Tres
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters d-flex justify-content-center mb-3">
        <div class="col-2 col-lg-2">
            <div class="card-body p-lg-3 p-2">
                <div class="form-check">
                    <label>
                        <input class="form-check-input validarPrevisionEd" type="checkbox" id="checkParticularEd" value="particular">
                    </label>
                </div>
            </div>
        </div>
        <div class="col-10 col-lg-10 align-self-center">
            <div class="card-body p-lg-3 p-2 lightgray-border">
                <span >Particular
                    <input type="number" class="form-control form-control-sm precios" id="precioParticularEd" name="precioParticularEd" placeholder="Precio particular">
                </span>
            </div>
        </div>
    </div>
</div>
