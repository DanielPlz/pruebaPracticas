<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/css/text.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <style>
        a {
            color: white;
        }

        body {
            font-family: "Times New Roman", serif;
            margin: 45mm 8mm 2mm 8mm;
            margin: 0;
        }

        a:hover {
            color: #FFBB00;
            ;
        }
        .page-break {
    page-break-before: always;
  
}


        a:active {
            color: #FFBB00;
            ;
        }
    </style>
    <div class="container">
        <div class="mt-2" style="text-align: left;"><img src="assets/img/logo-ps.png" width="300" height="108"></div>

        <!-- INFORMACIÓN DEL COMERCIO -->
        <div style="text-align: center;">

        </div>
        <div class="mt-2" style="text-align: center;">
            <span>Conexi&oacute;n Salud</span> |
            <span>Direccion, CL</span> <br>
            <span>(+56 9) 99976406</span> |
            <span>conexi&oacute;nsalud@gmail.com</span>
        </div>
        <!-- INFORMACIÓN DEL COMERCIO -->
        <!-- INFORMACIÓN DEL CLIENTE -->
        <table class="table table-sm customer-grid mt-2">
            <thead>
                <tr style="background-color: #FFBB00; text-align: center">
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
        <table class="table table-sm customer-grid mt-2">
            <thead>
                <tr style="background-color: #FFBB00; text-align: center">
                    <th colspan="4">ANTECEDENTES PSICOSOCIALES:</th>
                </tr>
            </thead>
            <tr>
                <td> Escolaridad: </td>
                <td nowrap>
                    Escolaridad
                </td>
                <td> Ocupaci&oacute;n: </td>
                <td>
                    Ocupación
                </td>
            </tr>

            <tr>
                <td> Estado civil: </td>
                <td nowrap>
                    Estado civil
                </td>
                <td> Grupo familiar: </td>
                <td>
                    Grupo familiar
                </td>
            </tr>
            <br>
        <br>
   
        </table>


        <!-- INFORMACIÓN DEL CLIENTE -->
        
        <!-- INFORMACIÓN DE LOS CASOS  -->
      
        @foreach($casouni as $ficha)

        @if($ficha->id_profesional == $idpo)
        <div class="page-break" >
        <table class="table table-sm customer-grid mt-2">
            
                <tr style="background-color: #ee8936bb; text-align: center">
                    <th colspan="2">Caso Cl&iacute;nico-{{$ficha->ficha_caso->codigo}}</th>
                </tr>
            
            @foreach( $sesion as $sesiones )
            @if ($sesiones->id_caso == $ficha->ficha_caso->id )
          
         
            <tr>
                <td colspan="2" >
                    <strong>
                        <p  class=" text-center text-primary mb-2 mt-2"> Sesion {{$sesiones->n_sesion}} - {{$sesiones->servicio->nombre}} | Fecha: {{$sesiones->fecha}} </p>
                    </strong>
                </td>

            </tr>
      
            <tr>

            <td style="background-color: #ECEEFA;">

            <h4>Diagnostico</h4>
                @foreach($diagnosticog as $diag)
                @if($sesiones->id == $diag->id_sesion)

                <p> {{$diag->diag_gral}}</p>

                @endif
                @endforeach
                @foreach($manualC as $manual)
                @if($sesiones->id == $manual->id_sesion)
                <p>{{$manuniC->nombre}}</p>
                <p class="ml-3"><strong>{{$manual->ficha_diagnostico_eje->ficha_eje_manual->nombre}}</strong></p>

                <p> {{$manual->ficha_diagnostico_eje->descripcion}} </p>

                @endif
                @endforeach

                </td>

                <td style="background-color:#ECEEFA">
               <h4 class="">Observaciones</h4>
                @foreach($observaciones as $obs)

                @if($sesiones->id == $obs->id_sesion)

                <p> - {{$obs->observacion}}</p>

                @endif
                @endforeach

                </td>
            </tr>


            @endif
            @endforeach


        </table>
    </div>
        <!-- INFORMACIÓN DE LOS CASOS -->
        @endif
        @endforeach
        <div class="page-break-after" >
        </div>
        <br>
        <br>
        <br>
        <br>
  

        <div class="mt-6 ">
            
                <table class="table table-sm customer-grid mt-2">
                  
                    <tr >
                   <td style="border-style: none;">_________________</td>
                   <td style="border-style: none;">_________________</td>
                   
                   </tr>
                   <tr> 
                   <td style="border-style: none;" >Firma del Profesional </td>
                   <td style="border-style: none;" >Timbre</td>
                   
                   </tr>
              
            
                </table>
            
       
        </div>

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
                <div class="text-left ml-1 mt-2" style="color: white;">
                  <p> Conexi&oacute;n Salud. Copyright &copy; Todos los derechos reservados.</p>
                 </div>
                 <div class="text-left ml-1" style="color: white;">
                  <p>Copyright ©, 2000, AMERICAN PSYCHIATRIC ASSOCIATION (APA). Diagnostic and Statistical Manual of Mental Disorders (DSM-IV-TR). </p> 
                 </div>
                 <div class="text-left ml-1" style="color: white;">
                   <p>Copyright ©, 2013, AMERICAN PSYCHIATRIC ASSOCIATION (APA). Diagnostic and Statistical Manual of Mental Disorders (DSM-5).</p>  
                 </div>
                 <div class="text-left ml-1" style="color: white;">
                   <p>Copyright ©, 1992, International Statistical Classification of Diseases and Related Health Problems (ICD-10).</p>  
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