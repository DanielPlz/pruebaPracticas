@section('css')
<link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet">
@endsection
@include('partials.head')
@section('contentSidebar')
<h1 style="text-align: center;">Bienvenido a Psicólogos Temuco</h1>
@endsection

<div>
    <div id="sidemenu" class="menu-collapsed">
        <!-- header-->
        <div id="header">
            <div id="title"><span>Mi Perfil</span></div>
            <div id="menu-btn">
                <div class="btn-hamburger"></div>
                <div class="btn-hamburger"></div>
                <div class="btn-hamburger"></div>
            </div>
        </div>
        <!-- perfil-->
        <div id="profile">
            <div id="photo">
                @if(auth()->user()->avatar)
                <img id="profile_id" src="{{Auth::user()->avatar}}" class="">
                @else
                <img id="profile_id" src="{{asset('assets/img/avatar.png')}}" class="">
                @endif
{{--                <div id="name"><span>{{Auth::user()->nombre}} {{Auth::user()->apellido}}</span></div>--}}
                    <div id="name">
                        <span>
                            {{Session::get('user')->nombre . ' ' .Session::get('user')->apellido_paterno. ' ' .Session::get('user')->apellido_materno}}
                        </span>
                    </div>
            </div>
        </div>
        @switch(Session::get('rol'))
            @case(1)
            <div id="menu-item">
                <div class="item">
                    <a href="{{url('/dashboard/profile')}}/{{Auth::user()->id}}">
                        <div class="icon"><i class="fas fa-user"></i></div>
                        <div class="title"><span>Editar perfil</span></div>
                    </a>
                </div>
                <div class="item separator">
                </div>
                <div class="item">
                    <a href="{{url('/reserva/list')}}">
                        <div class="icon"><i class="fas fa-notes-medical"></i></div>
                        <div class="title"><span>Historial de Citas</span></div>
                    </a>
                </div>
                <div class="item">
                    <a href="/pasareladepago/webpay/vista">
                        <div class="icon"><i class="fas fa-file-invoice"></i></div>
                        <div class="title"><span>Historial de Pagos</span></div>
                    </a>
                </div>
                <div class="item">
                    <a href="{{url('/')}}">
                        <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
                        <div class="title"><span>Salir</span></div>
                    </a>
                </div>
            </div>
            @break
            @case(2)
            <div id="menu-item">
                <div class="item">
                    <a href="{{url('/dashboard/profile')}}/{{Auth::user()->id}}">
                        <div class="icon"><i class="fas fa-user-md"></i></div>
                        <div class="title"><span>Editar perfil</span></div>
                    </a>
                </div>
                <div class="item">
                    <a href="{{url('/agenda/calendario')}}">
                        <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="title"><span>Agenda</span></div>
                    </a>
                </div>

                <div class="item">
                    <a href="{{url('servicios/dashboardServicios')}}">
                        <div class="icon"><i class="fas fa-hand-holding-medical"></i></div>
                        <div class="title"><span>Servicios</span></div>
                    </a>
                </div>
                <div class="item">
                    <a href="{{url('dashboard/pacientes')}}/{{Auth::user()->id}}">
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <div class="title"><span>Pacientes</span></div>
                    </a>
                </div>
                <div class="item">
                    <a href="{{ url('/chat/chatform') }}">
                        <div class="icon"><i class="fas fa-comments"></i></div>
                        <div class="title"><span>Chat</span></div>
                    </a>
                </div>
                <div class="item">
                    <a href="{{url('reserva/listPsicologo')}}">
                        <div class="icon"><i class="fas fa-notes-medical"></i></div>
                        <div class="title"><span>Historial de Reservas</span></div>
                    </a>
                </div>
                <div class="item">
                    <a href="/pasareladepago/webpay/vista">
                        <div class="icon"><i class="fas fa-file-invoice"></i></div>
                        <div class="title"><span>Historial de Pagos</span></div>
                    </a>
                </div>
                <div class="item separator">
                </div>
                <div class="item">
                    <a href="{{url('/')}}">
                        <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
                        <div class="title"><span>Salir</span></div>
                    </a>
                </div>
            </div>
            @break
        @endswitch
    </div>
    <!-- </div> -->

    <div id="main-container">
        @yield('contentSidebar')
    </div>


    @include('partials.scripts')
