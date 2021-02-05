
<!DOCTYPE html>
<html   lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/css/text.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
<style>
    a {
        color: white;
    }
    body {font-family: "Times New Roman", serif;
  margin: 45mm 8mm 2mm 8mm; margin: 0;} 

    a:hover {
        color: #FFBB00;
        ;
    }

    a:active {
        color: #FFBB00;
        ;
    }

</style>
<div class="container">
   
    
    <!-- INFORMACIÓN DEL COMERCIO -->
    <div style="text-align: center;">
        
    </div>
    <img src="assets/img/logo-ps.png" width="300" height="140">
    <div class="mt-2" style="text-align: center;">
        
        <span>Conexi&oacute;n Salud</span> |
        <span>Direccion, CL</span> <br>
        <span>(+56 9) 99976406</span> |
        <span>conexi&oacute;nsalud@gmail.com</span>
    </div>
    <!-- INFORMACIÓN DEL COMERCIO -->
    
    <h3 class="mt-3 mb-1 " style="text-align: center;">Caso Cl&iacute;nico {{$casoSeleccionado->ficha_caso->codigo}}</h3>
    <p style="text-align: center;">Fecha: {{$casoSeleccionado->ficha_caso->fecha}}</p>
    <p style="text-align: center;">Descrpcion: {{$casoSeleccionado->ficha_caso->descripcion}}</p>
    
    <!-- INFORMACIÓN DEL CLIENTE -->
    <table class="table table-sm customer-grid mt-2">
        <thead>
            <tr  style="background-color: #FFBB00; text-align: center">
                <th colspan="4">ANTECEDENTES PERSONALES:</th>
            </tr>
        </thead>
        <tr>
            <td> Nombre: </td>
            <td nowrap>
               {{$paciente->nombre}}
            </td>
            <td> Apellido: </td>
            <td>
              {{$paciente->appat}}
			</td>
		</tr>
		
		<tr>
            <td> RUT: </td>
            <td>
              {{$paciente->rut}}
            </td>
            
            <td> Sexo: </td>
            <td nowrap>
        
            </td>
		</tr>
		
		<tr>
            <td> Direcci&oacute;n: </td>
            <td>
			{{$paciente->direccion}}
			</td>
            <td> Edad: </td>
            <td nowrap>
               {{$edad}}
            </td>
        </tr>
      <br>
      <br>
      <br>

   
    </table>
    <!-- INFORMACIÓN DEL CLIENTE -->

	   <!-- INFORMACIÓN DEL CLIENTE -->
	   <table class="table table-sm customer-grid mt-2 ">
        <thead>
            <tr  style="background-color: #FFBB00; text-align: center">
                <th colspan="4">ANTECEDENTES PSICOSOCIALES:</th>
            </tr>
        </thead>
        <tr>
            <td> Escolaridad: </td>
            <td nowrap>
				Estudios Universitarios Santo Tomas
            </td>
            <td> Ocupaci&oacute;n: </td>
            <td>
				Obrero contruccion
			</td>
		</tr>
		
		<tr>
            <td> Estado civil: </td>
            <td nowrap>
				Soltero
            </td>
            <td> Grupo familiar: </td>
            <td>
                Lorem ipsum dolor sit amet, consectetur.
			</td>
        </tr>
        <tr></tr>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
		
    </table>
    <br>
  
    <!-- INFORMACIÓN DEL CLIENTE -->



    
    <!-- INFORMACIÓN DEL CASO -->
           <table class="table table-sm customer-grid mt-4">
            <thead>
                <tr  style="background-color: #FFBB00; text-align: center">
                </tr>
            </thead>
           
            @foreach ($sesionesCaso as $sesiones)
            <tr>
                <br>
                <br>
                <td colspan=2>
                    
                <strong> <p style="background-color: #ee8936bb; " class=" text-center mb-2 mt-2"> Sesion {{$sesiones->n_sesion}} - {{$sesiones->servicio->nombre}} | Fecha: {{$sesiones->fecha}}  </p></strong>
                </td>
               
            </tr>
               <tr>
               <td class="">
                
                <h4>Diagnostico</h4>
               <!-- Diagnostico General -->
               @foreach($diagnosticoG as $diag)
               @if($sesiones->id == $diag->id_sesion)
               <p> {{$diag->diag_gral}}</p>
               @endif
               @endforeach
               <!-- Manuales-->
               @foreach($manualB as $manual)
               @if($sesiones->id == $manual->id_sesion)
               <p>{{$manuniC->nombre}}</p>

               <p class="ml-1">{{$manual->ficha_diagnostico_eje->ficha_eje_manual->nombre}}</p>
               <p> {{$manual->ficha_diagnostico_eje->descripcion}} </p>
               
               @endif
               @endforeach
               </td>


         
                <td class="" >
                <h4 class="">Observaciones</h4>
                @foreach($observaciones as $obs)

                @if($sesiones->id == $obs->id_sesion)
                <p> - {{$obs->observacion}}</p>
                @endif
                @endforeach
                    </td>
            </tr>
            @endforeach

            
        </table>
        <!-- INFORMACIÓN DEL CASO -->

    <!-- MENSAJES FINALES -->
    <div>
        <div class="text-right">Equipo Conexi&oacute;n Salud</div>
    </div>
    <!-- MENSAJES FINALES -->
    <!-- FOOTER -->
    <footer class="page-footer">
        <div style="background-color: #484AF0;">

            <!-- RR.SS -->
            <div class="row py-2 d-flex align-items-center">
                <div class="col-md-12 text-center mt-4" style="font-size: smaller;">
                    <img class="mt-1" src="assets/img/icon_facebook.png" width="32" height="32"> 
                    <img class="mt-1" src="assets/img/icon_linkedin.png" width="32" height="32">
					<img class="mt-1" src="assets/img/icon_instagram.png" width="32" height="32">
                </div>
            </div>
            <div class="text-center" style="color: white;">
                Conexi&oacute;n Salud. Copyright &copy; Todos los derechos reservados.
            </div>
            <!-- RR.SS -->
        </div>
    </footer>
    <!-- FOOTER -->
</div>


<!-- <footer class="text-center mt-2" style="background-color: #484AF0; color: white;">
        <div style="justify-content: space-around;">
            <img class="mt-2" style="text-align: center;" src="assets/img/icons8_facebook_old_16.png"> |
            <a href=""> Psicólogos Temuco </a>
        </div>
        <div style="justify-content: space-around;">
            <img class="mt-2" style="text-align: center;" src="assets/img/icons8_instagram_16.png"> |
            <a href=""> Psicólogos Temuco </a>
        </div>
        <div style="justify-content: space-around;">
            <img class="mt-2" style="text-align: center;" src="assets/img/icons8_twitter_16.png"> |
            <a href=""> Psicólogos Temuco </a>
        </div>
        <div>Psicólogos Temuco. Copyright © Todos los derechos reservados.</div>

    </footer> -->
</body>
</html>



