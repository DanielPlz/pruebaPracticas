@include('partials.head')
<div class="container pl-3 pr-3">
    @yield('navbar')
</div>
@yield('header')
@yield('content')
{{-- @include('partials.footer') --}}

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/steper.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="{{asset('assets/js/regionesYcomunas.js')}}"></script>
@yield('script')
@yield('script_desplegable')
@yield('script_reagendar')
@yield('script_dinamica')
{{-- @yield('script_reservas') --}}

<!-- Menu Toggle Script -->
<script>
    const btn = document.querySelector('#menu-btn');
    const menu = document.querySelector('#sidemenu');
    btn.addEventListener('click', function() {
      menu.classList.toggle("menu-expanded");
      menu.classList.toggle("menu-collapsed");
      document.querySelector('body').classList.toggle('body-expanded');

    });
</script>