<div class="row">
    <div class="col-md-12" align="center">
        @if (count($categorias) > 0)
            @foreach ($categorias as $categoria)
                <div class="card mb-4" style="width: 18rem;" align="left">
                    <div class="card-body">
                        <a href="{{ route('foroCatIndex', $categoria->id) }}" class="title-4">{{ $categoria->titulo }}</a>
                        <div class="float-right">
                            @if (Auth::user() && Auth::user()->tipo == "Administrador" )
                                <button data-id="{{$categoria->id}}" class="btn btn-light btn-sm btnModalCatEdit" data-dismiss="modal" data-toggle="modal" data-target="#modalCatEdit"><i class="far fa-edit"></i></button>
                                <button data-id="{{$categoria->id}}" class="btn btn-light btn-sm btnModalCatDelete" data-dismiss="modal" data-toggle="modal" data-target="#modalCatDelete"><i class="far fa-trash-alt"></i></button> 
                            @endif
                        </div>
                        <p class="text-4">{{ $categoria->descripcion }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert-warning">
                <p class="text-4">No hay categorias por aquí</p>
            </div>
        @endif
    </div>
</div>