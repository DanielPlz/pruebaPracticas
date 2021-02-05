@extends('layouts.app')
@section('content')
@include('partials.card-head')
<form method="POST" action="/registrar/profesional/api" enctype="multipart/form-data">
    @csrf
        <div class="text-center">
            <h1 class="title-4 darkblue-text">Inscripcion</h1>
            <h2 class="text-4 bluegray-text">Completa tus datos</h2>
        </div>
        <div class="form-group row pl-5 pr-5 mt-4 mb-3">
            <label for="rut" class="col-md-12 text-4 darkblue-text">{{ __('RUT') }}</label>

            <div class="col-md-12">
                <input id="rut" type="text" class="form-control pt-2 pb-2 @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" required autocomplete="rut" autofocus>

                @error('rut')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row pl-5 pr-5 mb-3">
            <div class="col-md-5 mb-3 mb-lg-0">
                <label for="comuna" class="text-4 darkblue-text">{{ __('Comuna') }}</label>
                <input id="comuna" type="text" class="form-control" name="comuna" value="{{ old('comuna') }}" required autocomplete="comuna">
                @error('comuna')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-7">
                <label for="direccion" class="text-4 darkblue-text">{{ __('Direccion') }}</label>
                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" >
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row pl-5 pr-5 mb-5">
            <label for="telefono" class="col-md-12 text-4 darkblue-text">{{ __('Telefono') }}</label>

            <div class="col-5">
                <input disabled type="text" class="form-control" name="codigo" required value="+569">
            </div>
            <div class="col-7">
                <input id="telefono" type="text" class="form-control pt-2 pb-2 @error('email') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" autocomplete="telefono" autofocus>

                @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-0 pl-5 pr-5">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn indigo white-text text-4 pt-2 pb-2 rounded-pill indigo-border btn-block mb-3">
                    {{ __('Enviar solicitud') }}
                </button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection