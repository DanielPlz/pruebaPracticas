<link href="assets/css/text.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<style>
    a {
        color: white;
    }

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
    <div class="mt-2" style="text-align: left;"><img src="assets/img/logo-ps.png" width="290" height="108"></div>
    
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
    </table>
    <!-- INFORMACIÓN DEL CLIENTE -->

	   <!-- INFORMACIÓN DEL CLIENTE -->
	   <table class="table table-sm customer-grid mt-2">
        <thead>
            <tr  style="background-color: #FFBB00; text-align: center">
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
		
    </table>
    <!-- INFORMACIÓN DEL CLIENTE -->
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
                    <img class="mt-1" src="../assets/img/icon_facebook.png" width="32" height="32"> 
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


