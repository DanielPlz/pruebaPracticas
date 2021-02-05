<nav class="fixed-top navbar navbar-expand-lg pt-3 mb-4" style="background-color: #ffffff;" >
    <div class="container">
        <a class="navbar-brand d-flex justify-content-center" href="{{ url('/') }}">
            <!-- <img src="{{asset('assets\img\logo-ps.png')}}" alt="" srcset=""> -->
            {{-- <i class="fas fa-heart align-self-center fa-fw"></i> --}}
            <img src="{{ asset('assets/img/logoV2.png') }}" height="60px" />
        </a>
        <button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-align-right"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                {{-- <li class="nav-item">
                    <a class="nav-link text-4 bluegray-text" href="{{ url('/about')}}">
                        <i class="fas fa-hands-helping"></i>
                        Quienes somos
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-4 bluegray-text" href="{{ url('/profesionals')}}">
                        <i class="fas fa-quote-left"></i>
                        Psicólogos
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-4 bluegray-text" href="{{route('work')}}">
                        <i class="fas fa-briefcase"></i>
                        Planes
                    </a>
                </li> --}}
                <li class="nav-item mr-2 mb-lg-0 mb-3">
                    <a class="nav-link text-4 bluegray-text" href="{{route('Contacto')}}">
                        <i class="fas fa-phone"></i>
                        Contacto
                    </a>
                </li>
                {{-- <li class="nav-item mr-2 mb-lg-0 mb-3">
                    <a class="nav-link text-4 bluegray-text" href="{{route('FAQ')}}">
                        <i class="fas fa-comments"></i>
                        Preguntas frecuentes
                    </a>
                </li> --}}
                @if(!auth()->user())
                    <li class="nav-item mr-2 mb-lg-0 mb-3">
                        <a class="nav-link text-4 bluegray-text" href="{{route('rol_register')}}">
                            <i class="far fa-user fa-fw"></i>
                            Registrarme
                        </a>
                    </li>
                @elseif(Auth::user()->tipo=='Paciente')
                    <li class="nav-item mr-2 mb-lg-0 mb-3">
                        <a class="nav-link text-4 bluegray-text" href="{{route('work')}}">
                            ¿Eres psicólogo? Entra aquí!
                        </a>
                    </li>
                @endif
            </ul>
            <div class="float-lg-right">
                @if(Auth::user())
                    <!-- Example single danger button -->
                    <div class="dropdown">
                        <button class="dropbtn transparent text-4 d-flex justify-content-center">
                            @if(auth()->user()->avatar)
                                <img src="{{Auth::user()->avatar}}" class="mini-avatar rounded-circle align-self-center mr-2">
                            @else
                                <img src="{{asset('assets/img/avatar.png')}}" class="mini-avatar rounded-circle align-self-center mr-2">
                            @endif
                            <span class="align-self-center text-4 black-text">
                                {{Auth::user()->name}}
                            </span>
                        </button>
                        <div class="dropdown-content dropdown-menu-lg-right">
                            <a href="" class="text-4 bluegray-text">
                            <i class="far fa-user fa-fw"></i> Mi perfil
                            </a>
                            <a href="{{url('/dashboard/profile')}}/{{auth()->user()->id}}" class="text-4 bluegray-text">
                                <i class="fas fa-chart-bar fa-fw"></i> Dashboard privado
                            </a>
                            <a class="text-4 bluegray-text">
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-4 p-0 w-100 bluegray-text border-0 transparent text-left">
                                        <i class="fas fa-arrow-left fa-fw"></i> Salir
                                    </button>
                                </form>
                            </a>
                        </div>

                    </div>
                @else
                    {{-- <div class="dropdown">
                        <button class="btn pink text-white text-4 pl-3 pr-3 p-2" type="button" id="dropBtnLogin"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user fa-fw white-text"></i>
                            Mi cuenta
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropBtnLogin">
                            <a class="dropdown-item" href="{{ route('login') }}">Iniciar Sesión</a>
                        </div>
                    </div> --}}
                    {{-- Desplegable prueba --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-light " href="#" data-toggle="dropdown">
                        <i class="fas fa-align-justify align-self-center "></i>   <i class="fas fa-user-circle fa-2x "></i>
                       <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                        <li>
                                <a class="dropdown-item trigger right-caret">Iniciar sesión</a>
                                <ul class="dropdown-menu sub-menu">
                                    <li>
                                        <a class="dropdown-item  " href="{{ route('login_paciente') }}">     <i class="fas fa-user-plus"></i>  Paciente</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login_psicologo') }}">     <i class="fas fa-id-badge"></i>        Psicólogo</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="dropdown-item trigger right-caret">Registrarse</a>
                                <ul class="dropdown-menu sub-menu">
                                    <li>
                                        <a class="dropdown-item  " href="{{ route('register') }}">     <i class="fas fa-user-plus"></i>  Paciente</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('work') }}">     <i class="fas fa-id-badge"></i>        Psicólogo</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
<!-- Los siguientes dos script pertenecen al chatbot, estos lo hacen aparecer, se encuentra aquí para que el bot
sea accesible desde cualquier pestaña que tenga acceso al navbar-->
<script>
var botmanWidget = {
    title:'Conexión Salud ChatBot',
    mainColor:'#484AF0',
    bubbleBackground:'#484AF0',
    headerTextColor: '#fff',
    minwidth: "150px",
    placeholderText: 'Envíe un mensaje',
    aboutText: 'Conexión Salud',
    introMessage: "Hola soy el ChatBot de Conexión Salud. Puedo responder cualquiera de sus preguntas, para comenzar escriba 'hola'."
};
</script>
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

@section('script_desplegable')
<script>
    $(function(){
        $(".dropdown-menu > li > a.trigger").on("click",function(e){
            var current=$(this).next();
            var grandparent=$(this).parent().parent();
            if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
                $(this).toggleClass('right-caret left-caret');
            grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
            grandparent.find(".sub-menu:visible").not(current).hide();
            current.toggle();
            e.stopPropagation();
        });
        $(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
            var root=$(this).closest('.dropdown');
            root.find('.left-caret').toggleClass('right-caret left-caret');
            root.find('.sub-menu:visible').hide();
        });
    });
</script>
@endsection
