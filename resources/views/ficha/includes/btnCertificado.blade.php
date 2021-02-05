
    <!-- Se aplica la condicion para mostrar el boton -->
   
    <div>
    <a class="btn  btn-primaryB dropdown-toggle ml-3"  href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Certificados
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
        <!-- VistaPrevia Certificado Diagnostico Psicologico -->
        <a class="dropdown-item" href="{{route('vistaPreviaCpiscologico', [ 'ids'=> $ids ])}}">Certificado Psicol&oacute;gico</a>
        <!-- VistaPrevia Certificado de Asistencia  -->
        <a class="dropdown-item" href="{{route('vistaPreviaCasistencia', [ 'ids'=> $ids ])}}">Certificado Asistencia</a>

     

    </div>
   </div>


