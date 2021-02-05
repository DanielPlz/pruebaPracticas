@include('partials.head')

<body>

   <div class="d-flex" id="wrapper">

      <!-- Sidebar -->
      <div class="bg-white border-right" id="sidebar-wrapper">
         <div class="sidebar-heading">
            <i class="fas fa-clinic-medical"></i>
            <span>Panel Psicólogo</span>
         </div>
         <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action bg-white">
               <i class="fas fa-user-md"></i>
               <span>Mi Perfil</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-white">
               <i class="fas fa-book-medical"></i>
               <span>Agenda</span>
            </a>
            <a href="{{url('dashboard/servicios')}}" class="list-group-item list-group-item-action bg-white">
               <i class="fas fa-hand-holding-medical"></i>
               <span>Servicios</span>
            </a>
            <a href="{{url('dashboard/pacientes')}}" class="list-group-item list-group-item-action bg-white">
               <i class="fas fa-user-injured"></i>
               <span>Pacientes</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-white">
               <i class="fas fa-comment"></i>
               <span>Chat</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-white">
               <i class="fas fa-calendar-alt"></i>
               <span>Calendario</span></a>
         </div>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content Wrapper -->
      <div id="page-content-wrapper">

         <!-- navbar optonial -->
         <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <button class="btn btn-primary" id="menu-toggle"><i class="fas fa-bars"></i></button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                  <li class="nav-item ">
                     <a class="nav-link active" href="{{url('/')}}">
                        <i class="fas fa-heart align-self-center fa-fw fa-lg "></i>
                        <span class="sr-only">(current)</span>
                        <!-- <span>Home</span> -->
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">
                        <i class="fas fa-bell"></i>
                     </a>
                  </li>
                  <!-- Dropdown -->
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(auth()->user()->avatar)
                        <img src="{{Auth::user()->avatar}}" class="mini-avatar rounded-circle align-self-center mr-2">
                        @else
                        <img src="{{asset('assets/img/avatar.png')}}" class="mini-avatar rounded-circle align-self-center mr-2">
                        @endif
                     </a>
                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                           <!-- Action Logout -->
                           <form action="{{route('logout')}}" method="POST">
                              @csrf
                              <button type="submit" class="text-4 p-0 w-100 bluegray-text border-0 transparent text-left">
                                 <i class="fas fa-arrow-left fa-fw"></i> Salir
                              </button>
                           </form>
                        </a>
                        <!-- <a class="dropdown-item" href="#">Another action</a><div class="dropdown-divider"></div><a class="dropdown-item" href="#">Something else here</a> -->
                     </div>
                  </li>
               </ul>
            </div>
         </nav>
         @yield('contentSidebar')
         @yield('contentPacientes')
         @yield('contentInformation')
         @yield('contentCreate')
         @yield('contentShow')
         <!-- <div class="container-fluid">
            <h1 class="mt-4">Simple Sidebar</h1>
            <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>

            <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>. The top navbar is optional, and just for demonstration. Just create an element with the <code>#menu-toggle</code> ID which will toggle the menu when clicked.</p> -->
      </div>
   </div>
   <!-- /#page-content-wrapper -->

   </div>
   <!-- /#wrapper -->

   @include('partials.footer')
