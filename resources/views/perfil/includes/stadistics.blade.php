<div class="card mb-3">
    <div class="card-body">
        <div class="row no-gutters mb-3">
            <div class="col-8 align-self-center">
                <div class="text-left h-100">
                    <h5 class="title-4 darkblue-text mb-0 align-self-center">Rendimiento</h5>
                </div>
            </div>
        </div>
        <div class="row no-gutters mb-3">
            <div class="col-6 align-self-center">
                <div class="d-flex justify-content-center float-left">
                    <div class="title-2 text-medium indigo-text align-self-center">
                        {{round($user->testimonios->avg('valoracion'), 1)}} <span class="lightgray-text">/ 5.0</span>
                    </div>
                </div>
            </div>
            <div class="col-6 align-self-center">
                <div class="float-right">
                    @for ($i = 1; $i <= 5; $i++)
                        @if($i <= round($user->testimonios->avg('valoracion'), 1))
                        <i class="fas fa-star yellow-text align-self-center"></i>
                        @else
                        <i class="far fa-star lightgray-text"></i>
                        @endif
                    @endfor
                    <p class="text-4 m-0 bluegray-text text-right">{{$user->testimonios->count()}} reseñas</p>
                </div>
            </div>
        </div>
        @if($user->testimonios->count() > 0)
            @for ($i = 5; $i >= 1; $i = $i - 1)                          
            <div class="row no-gutters mb-2">
                <div class="col-2 text-left">
                    <span class="text-4">
                        <i class="fas fa-star yellow-text fa-fw"></i> {{$i}}
                    </span>
                </div>
                <div class="col-8 align-self-center">
                    <div class="progress w-100" style="height: 8px;">
                        <div
                        class="progress-bar indigo" 
                        role="progressbar" 
                        style="width: {{$user->testimonios->where('valoracion', $i)->count() * 100/$user->testimonios->count()}}%" aria-valuenow="{{$user->testimonios->where('valoracion', $i)->count() * 100/$user->testimonios->count()}}" aria-valuemin="0" 
                        aria-valuemax="100">
                        </div>
                    </div>
                </div>
                <div class="col-2 text-right">
                    <span class="text-4">
                        {{round($user->testimonios->where('valoracion', $i)->count() * 100/$user->testimonios->count())}}%
                    </span>
                </div>
            </div>
            @endfor
        @else
            <div class="alert alert-warning text-4">No hay valoraciones registradas</div>
        @endif
    </div>
</div>