<div class="card mb-3">
    <div class="card-body">
        <div class="mb-5">
            <p class="float-left darblue-text title-4 text-bold">Reseñas</p>
            @if(auth()->user() && $user->id != auth()->user()->id)
                <a type="button" class="btn float-right p-0 transparent bluegray-text text-4 text-bold" data-toggle="modal" data-target="#create-testimonio">Escribir reseña <i class="fas fa-pen"></i></a>
            @endif
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(count($testimonios)>0)
            @foreach($testimonios as $testimonio)
            <div class="row no-gutters d-flex justify-content-center mb-3">
                    <div class="col-2 col-lg-2">
                        <div class="card-body p-lg-3 p-2">
                            @if($testimonio->anonimo == 0)
                            @if($testimonio->user->avatar)
                                <img src="{{$testimonio->user->avatar}}" 
                                class="avatar rounded-circle align-self-center" alt="">
                            @else
                                <img src="{{'/assets/img/avatar.png'}}" 
                                class="avatar rounded-circle align-self-center" alt="">
                            @endif
                            @else
                                <img src="{{asset('assets/img/anonimo.png')}}" class="avatar align-self-center" alt=""> 
                            @endif
                        </div>
                    </div>
                    <div class="col-10 col-lg-10 align-self-center">
                        <div class="card-body p-lg-3 p-2 lightgray-border">
                            @if($testimonio->anonimo == 0)
                                <h5 class="text-4 darkgray-text mb-0">
                                {{$testimonio->user->name.' '.$testimonio->user->apellido}}
                                </h5>
                            @else
                                <h5 class="text-4 darkgray-text mb-0">Paciente anonimo</h5>
                            @endif
                            <div class="mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimonio->valoracion)
                                    <i class="fas fa-star yellow-text"></i>
                                    @else
                                    <i class="far fa-star lightgray-text"></i>
                                    @endif
                                @endfor
                                <span class="text-5 bluegray-text">{{' - '.$testimonio->created_at}}</span>
                            </div>
                            <p class="text-4 bluegray-text mb-0">
                                {{$testimonio->titulo}}
                            </p>
                            <p class="text-4 bluegray-text mb-0">
                                {{$testimonio->comentario}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{$testimonios->links()}}
            </div>
        @else
            <div class="alert alert-warning text-4">No hay testimonios registrados</div>
        @endif                                    
    </div>
</div>
@include('testimonios.create')

