@extends('layouts.dashboard')
@section('contentSidebar')

<div class="row">

  <div class="col-md-1">
  </div>

  <div class="col-md-10">

    <h1>SERVICIO</h1>

    @if (session('mensaje'))
      <div class="alert alert-success">
        {{session('mensaje')}}
      </div>
    @endif

    <form action="{{ route('notas.crear')}}" method="POST">
    @csrf

    @error('duracion')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        El nombre es obligatorio
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
    @enderror

    @error('estado_servicio')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        El nombre es obligatorio
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
    @enderror

    @error('precio_particular')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        la descripcion es obligatorio
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button> </div>
    @enderror

    @error('servicioPsicologo')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        la descripcion es obligatorio
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
    @enderror

    <div class="row">
        <!--columnas 12-->
        <div class="col-md-1">

        </div>
        <div class="col-md-9">

        </div>
        <div class="col-md-1">
            <!-- boton modal para agregar datos -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ventanaModal1">
                Agregar
            </button>
        </div>
        <div class="col-md-1">

        </div>
    </div>



      <!-- Modal -->
      <div class="modal fade" id="ventanaModal1" tabindex="-1" role="dialog" aria-labelledby="ventanaModal1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ventanaModal1Label">Agregar Datos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <label>Servicio </label>
                <input type="text" name="Servicio" placeholder="Nombre de servicio" class="form-control mb-2" value = "{{ old('nombre') }}">
                <br>
                <label>Estado </label>

                <select class="form-control" aria-label="Default select example">
                    <option selected>Seleccione...</option>
                    <option value="1">Habilitado</option>
                    <option value="0">Deshabilitado</option>
                  </select>
                <br>
                <label>Duracion </label>
                <input type="text" name="Duracion" placeholder="Duracion" class="form-control mb-2" value = "{{ old('nombre') }}">
                <br>
                <label>Precio </label>
                <input type="text" name="Precio" placeholder="Precio" class="form-control mb-2" value = "{{ old('nombre') }}">
                <br>
                <label>Descripcion </label>
                <input type="text" name="Descripcion" placeholder="Descripcion" class="form-control mb-2" value = "{{ old('nombre') }}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </div>
        </div>
      </div>
    </form>

      <table class="table">
        <thead>
          <tr>
          <th scope="col">#id</th>
            <th scope="col">Servicio</th>
            <th scope="col">Estado</th>
            <th scope="col">Duracion</th>
            <th scope="col">Precio</th>
            <th scope="col">Descripcion</th>
            <th scope="col">ACCIONES</th>
          </tr>
        </thead>
        <tbody>

      @foreach ($notas as $item)

      <tr>
      <th scope="row">{{$item->id_servicio_psicologo}}</th>
      <td>{{$item->Servicio}}</td>
      @if ($item->Estado = 1)
      <td>{{"Habilitado"}}</td>
        @else
        <td>{{"No Habilitado"}}</td>
      @endif
      <td>{{$item-> duracion}}</td>

      <td>${{$item->Precio}}</td>

      <td>{{$item->Descripcion}}</td>

      <td><!-- boton modal para editar datos -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ventanaModal2">
          Editar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="ventanaModal2" tabindex="-1" role="dialog" aria-labelledby="ventanaModal2Label" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ventanaModal2Label">Editar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="text" name="Duracion" placeholder="duracion" class="form-control mb-2" value = "{{ old('nombre') }}">
                <input type="text" name="estado_servicio" placeholder="estado de servicio" class="form-control mb-2" value = "{{ old('nombre') }}">
                <input type="text" name="precio_particular" placeholder="precio particular" class="form-control mb-2" value = "{{ old('nombre') }}">
                <input type="text" name="Descripcion" placeholder="descripcion" class="form-control mb-2" value = "{{ old('nombre') }}">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
              </div>
            </div>
          </div>
        </div>

            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ventanaModal3">Eliminar</button>

    </tr>

    @endforeach

  </tbody>
</table>
            </div>
            <div class="col-md-1">
            </div>

</div>

@endsection
