
<div class="col-7 ml-5"> 
             <p class="h3  ">Diagn&oacute;stico de la sesi&oacute;n</p>
             </div>
             <!-- Se aplica la condicion para mostrar el boton -->
             @if($caes == 'Activo')
             <div>
             <a class="btn  btn-primaryB dropdown-toggle"  href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Egresar Caso
             </a>

             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
             @foreach($tipo_alta as $alta)
                 <a class="dropdown-item" href=" {{route('egresarPaciente', ['idpa'=> $paciente->id  , 'idpo'=> $idpo , 'idc' => $idc , 'sr' => $sr , 'nomc' => $nomc , 'alta' => $alta->id ]  )}}"> {{$alta->descripcion}} </a>
             @endforeach
             </div>
            </div>
    @endif