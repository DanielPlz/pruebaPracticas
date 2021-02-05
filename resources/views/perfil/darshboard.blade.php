
@include('partials.head') 


<body >
  <div id="sidemenu" class="menu-collapsed">
    <!-- header-->
    <div id="header">
      <div id="title"><span>Perfil</span></div>
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
        <img src="{{Auth::user()->avatar}}" class="">
        @else
        <img src="{{asset('assets/img/avatar.png')}}" class="">
        @endif

        <div id="name"><span>{{Auth::user()->name}} {{Auth::user()->apellido}}</span></div>
      </div>
    </div>
  @switch(auth()->user()->tipo)
    @case("Profesional")
    <div id="menu-item">
    
      <div class="item">
        <a href="#">
          <div class="icon"><i class="fas fa-user-md"></i></div>
          <div class="title"><span>Editar perfil</span></div>
        </a>
      </div>
      <div class="item">
        <a href="#">
          <div class="icon"><i class="fas fa-calendar-alt"></i></div>
          <div class="title"><span>Agenda</span></div>
        </a>
      </div>
      <div class="item separator">

      </div>
      <div class="item">
        <a href="#">
          <div class="icon"><i class="fas fa-hand-holding-medical"></i></div>
          <div class="title"><span>Servicios</span></div>
        </a>
      </div>
      <div class="item">
        <a href="#">
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
    </div>
    @break
    @case("Paciente")
    <div id="menu-item">
      <div class="item">
        <a href="#">
          <div class="icon"><i class="fas fa-user"></i></div>
          <div class="title"><span>Editar perfil</span></div>
        </a>
      </div>
      <div class="item separator">

      </div>
      <div class="item">
        <a href="#">
          <div class="icon"><i class="fas fa-calendar-alt"></i></div>
          <div class="title"><span>Historial</span></div>
        </a>
      </div>
    </div>
    @break
    @endswitch
  </div>
  <div id="main-container">
    @yield('contentSidebar')
  </div>


  @include('partials.footer')