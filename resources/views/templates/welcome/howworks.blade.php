<div class="container pl-3 pr-3" style="background-color:#bbbbbe">
    <div class="row pt-5 pb-5 d-flex justify-content-center">
        <div class="col-md-6">
            <h4 class="text-sm-left text-white">
                <a class="text-white" href="#" style="text-decoration: none;">
                    Psicologos Temuco
                </a>
            </h4>
            <p class="text-sm-left">
                <a class="text-white" href="{{ url('/about')}}" style="text-decoration: none;">
                    Quienes somos 
                </a>
            </p>
            <p class="text-sm-left">
                <a class="text-white" href="{{route('work')}}" style="text-decoration: none; line-height: 10px;">
                    Membresias
                </a>
            </p>  
            <p class="text-sm-left">
                <a class="text-white" href="{{route('FAQ')}}" style="text-decoration: none;">
                    Preguntas frecuentes
                </a>
            </p>
            <p class="text-sm-left">
                <a class="text-white" href="" data-dismiss="modal" data-toggle="modal" data-target="#condiciones" style="text-decoration: none;">
                    Terminos y Condiciones
                </a>
            </p>   
        </div>
        <div class="col-md-6">
            <h4 class="text-sm-left text-white">
                <a class="text-white" href="{{route('Contacto')}}" style="text-decoration: none;">
                    Contacto
                </a>
            </h4>
            <p class="text-sm-left">
                <p class="text-white" style="text-decoration: none;">
                    contacto@psicologostemuco.cl 
                </p>
            </p>
            <p class="text-sm-left">
                <p class="text-white" style="text-decoration: none;">
                    Telefono: (+569)99976406 
                </p>
            </p>
            <p class="text-sm-left">
                <p class="text-white" style="text-decoration: none;">
                      
                       <i class="fab fa-facebook-square zoom"></i>   |   <i class="fab fa-linkedin zoom"></i>   |   <i class="fab fa-instagram zoom"></i>
                </p>
            </p>
        </div>
    </div>
</div>
@include('reservas.terminos')
