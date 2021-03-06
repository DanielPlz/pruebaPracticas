
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
    <title>Certificado</title>
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
    .page-break {
    page-break-before: always;
  
}
.page-break-after{
    page-break-after: always;
  
}

    a:active {
        color: #FFBB00;
        ;
    }

</style>

<div class="container">
   
    
    <!-- Fecha -->
    <div class="mt-1" >
        
        <table width="100%"  cellpadding="0" cellspacing="0" >
            <tr>
            <td rowspan="2" valign="middle" align="left"><img src="assets/img/logo-ps.png" width="165" height="70"></td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td colspan="2"><span >Temuco, {{$hoy}}</span></td>
            
            </tr>
            
            </table>
    </div>

     <!-- Fecha -->


      <!-- Certificado -->
	   <table class="table table-sm customer-grid  ">
        <thead>
            <tr  style=" text-align: center;">
               <th class= "mt-3" colspan="4" style="text-align: center; border-style: none;"> <u>CERTIFICADO DE DIAGNÓSTICO PSICOLÓGICO: </u> </th> 
            </tr>
        </thead>
        <tr >
           <td class= "mt-1" colspan="4"  style="text-align: left; border-style: none; " >
            Quien suscribe, certifica a Sr/a {{$paciente->nombre}} {{$paciente->appat}} {{$paciente->apmat}}, edad {{$edad}} años, RUT {{$paciente->rut}}, inicia proceso psicoterapéutico con psicólogo clínico {{$profesional->user->name}} {{$profesional->user->apellido}} desde el día {{$fechaModificadaF}}
           </td>
		</tr>
        
        <tr >
            <td class= "mt-1" colspan="4"  style="text-align: left; border-style: none;" >
                En relación al diagnóstico de salud mental, presenta:
            </td>
         </tr>
		
    </table>
      <!-- Certificado -->
      
        @csrf
        <!-- Diagnostico -->
        @if (@isset($diagnosticoG))
        <table class="table table-sm customer-grid " style="page-break-after">
            <tr >
                
               <td colspan="4"  style="text-align: left; border-style: none; " >
                <p style=" text-align: center;"><u>Diagn&oacute;stico General:</u> </p>
                <p>{{$diagnosticoG->diag_gral}}</p>
                <p> {{$comentarios}}</p>
             

            </tr>

            
        </table>
        @elseif($manuniC !== 1 )
          <table class="table table-sm customer-grid " style="page-break-after text-align: left;">
            <tr>
               <td colspan="4"  style=" border-style: none; " >
                <p class="mt-n3" style=" text-align: center;"><u>{{$manuniC->nombre}}</u></p>
                @foreach($manualC as $manual)

               <h6 class="ml-1">{{$manual->ficha_diagnostico_eje->ficha_eje_manual->nombre}}</h6>
               <p> {{$manual->ficha_diagnostico_eje->descripcion}} </p>

               @endforeach   
                <p> {{$comentarios}}</p>
                </td>
            </tr>
            <tr>
                <td colspan="4"  style=" border-style: none; ">
                    <small >{{$manual->ficha_diagnostico_eje->ficha_eje_manual->ficha_manual->copyright}}</small>
                </td>
            </tr>
                   
 
            </table>
        @endif
       
        <!-- Diagnostico -->

        

        <!-- texto final -->
        <div  style="text-align: left;">
        
            <span>Se extiende el presente certificado a petición del interesado para los fines que estime pertinente y la ley lo permita</span>
            <br>
            <span>Atentamente, </span>
        </div>
      
        
        <!-- texto final -->
        <!-- Firma  -->
        <div class="mt-4 " style="text-align: center;">

            <p  style="border-style: none;">____________________</p>
            <p class="mt-n3"style="border-style: none;" > {{$profesional->user->name}}  {{$profesional->user->apellido}} </p>
            <p class="mt-n3"style="border-style: none;" > {{$profesional->user->rut}}</p>
            <p class="mt-n3"style="border-style: none;" > {{$profesional->titulo}}</p>
            <p class="mt-n3"style="border-style: none;" > {{$profesional->user->direccion}}</p>

            <div class="mt-n2 text-secondary">
                <p> Conexi&oacute;n Salud. Copyright &copy; Todos los derechos reservados.</p>
            </div>
                
        </div>


 
</div>

</body>
</html>



