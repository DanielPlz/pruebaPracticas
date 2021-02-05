<div class="tab text-4">
    <div class="text-center mb-4">
        <h1 class="title-4 darkblue-text">
            Personaliza tu cuenta
        </h1>
    </div>
    <div class="form-group row pl-3 pr-3 mb-3">
        <div class="col-md-5 mb-3 mb-lg-0">
            <label for="comuna" class="text-5 darkgray-text text-bold">{{ __('Comuna') }}</label>
            <input id="comuna" type="text" class="form-control text-4 bluegray-text" name="comuna" value="{{ old('comuna') }}" required autocomplete="comuna">
            @error('comuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror 
        </div>
        <div class="col-md-7">
            <label for="direccion" class="text-5 darkgray-text text-bold">{{ __('Direccion') }}</label>
            <input id="direccion" type="text" class="form-control text-4 bluegray-text" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" >
            @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row pl-3 pr-3 mb-3">
        <label for="telefono" class="col-md-12 text-5 darkgray-text text-bold">{{ __('Telefono') }}</label>

        <div class="col-5">
            <input disabled type="text" class="form-control text-4 bluegray-text" name="codigo" required value="+569">
        </div>
        <div class="col-7">
            <input id="telefono" type="text" class="form-control text-4 bluegray-text pt-2 pb-2 @error('email') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" autocomplete="telefono" autofocus>

            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row pl-3 pr-3 mt-4 mb-3">
        <label class="col-md-12 text-5 darkgray-text text-bold">{{ __('Descripcion') }}</label>
        <div class="col-md-12">
            <textarea class="form-control pt-2 pb-2 text-4 bluegray-text @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" autocomplete="descripcion" ></textarea>
            @error('descripcion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="tab">
    <div class="text-center mb-4">
        <h1 class="title-4 darkblue-text">
            Informacion psicólogica
        </h1>
    </div>
    <div class="form-group row pl-3 pr-3 mb-3">
        <label for="custom-select" class="col-md-12 text-5 darkgray-text text-bold">Modalidad de atencion</label>
        <div class="col-md-12">
            <select class="custom-select text-4 bluegray-text" name="atencion">
                <option selected class="text-4 bluegray-text">Indica tu modalidad de atencion</option>
                <option value="Online" class="text-4 bluegray-text">Online</option>
                <option value="Presencial" class="text-4 bluegray-text">Presencial</option>
            </select>
        </div>
    </div>
    <div class="form-group row pl-3 pr-3 mb-3">
        <div class="col-md-6 mb-3 mb-lg-0">
            <label for="edad" class="text-5 darkgray-text text-bold">{{ __('Edad') }}</label>
            <input id="edad" type="number" class="form-control text-4 bluegray-text" name="edad" value="{{ old('edad') }}" required autocomplete="edad">
            @error('edad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="experiencia" class="text-5 darkgray-text text-bold">{{ __('Exp. Profesional') }}</label>
            <input id="experiencia" type="number" class="form-control text-4 bluegray-text" name="experiencia" value="{{ old('experiencia') }}" required autocomplete="experiencia" >
            @error('experiencia')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="tab">
    <div class="text-center">
        <h1 class="title-4">Validacion</h1>
        <p class="text-5 bluegray-text">
            Estimado profesional, por seguridad su informacion sera validada mediante la API de la <strong>Super Intendencia de salud</strong>
        </p>
    </div>
    <div class="form-group row pl-3 pr-3 mt-4 mb-3">
        <label for="rut" class="col-md-12 text-5 darkgray-text">{{ __('RUT') }}</label>

        <div class="col-md-12">
            <input id="rut" type="text" class="text-4 bluegray-text form-control pt-2 pb-2 @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" required autocomplete="rut" autofocus>
            @error('rut')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row mb-0 pl-3 pr-3">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn rounded-pill green white-text text-bold text-4 btn-block mb-3">
                {{ __('Enviar solicitud') }}
            </button>
        </div>
    </div>
</div>