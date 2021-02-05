<div class="card mb-3" style="">
    <div class="card-body text-center">
        <div class="row d-flex justify-content-center">
            <div class="col-4 p-2 align-self-center">
                @if($user->avatar)
                    <img src="{{$user->avatar}}" class="rounded-circle avatar align-self-center"alt="">
                @else
                    <img src="{{asset('assets/img/avatar.png')}}" class="avatar align-self-center" alt=""> 
                @endif
            </div>
            <div class="col-8 p-2 align-self-center">
                <div class="text-left h-100">
                    <h5 class="title-3 darkblue-text mb-0 align-self-center">{{$user->name.' '.$user->apellido}}
                    <p class="text-4 m-0 bluegray-text">Cuenta verificada <i class="fas fa-check-circle fa-fw lightblue-text"></i></p>
                    <p class="text-4 m-0 bluegray-text">{{$user->info->titulo.' - '.$user->comuna}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        @include('perfil.includes.details')                                  
    </div>
</div>