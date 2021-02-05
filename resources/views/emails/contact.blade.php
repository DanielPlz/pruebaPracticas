@include('partials.head')
<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse; max-height: 600px">
        <tr>
            <td style="background-color: #FFBB00; text-align:left; padding: 0;">
                <img style="display: block; margin: 1.5% 3%; height: 50px; width: 150px; float: right;" src="https://i.postimg.cc/YSbQNWcZ/logopsicotem3-Transparente.png">
            </td>
        </tr>
        <tr>
            <td style="background-color: #D8DAE0">
                <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify; font-weight: bold">
                    <h1 style="color: #000000; margin: 0 0 7px; text-align: center">Comprobante de reserva</h1>
                    <h2></h2>
                    <div style="max-width: fit-content;">
                        <div class="justify-content-center" style="align: center; justify-content: center;">
                            <a style="align: center; justify-content: center; display: block; margin: 0.5% 3%; height: 50px; width: 150px; float: right;" href="http://localhost:8000//dashboard/profile/{{$mensaje['id']}}"><button type="button" style="margin-left: 50%; border: 2px solid yellow;"> Confirmar cita</button></a>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="1" style="color: #FFFFFF; float: left; border: outset;">
                        <thead>
                            <tr>
                                <h4 style="text-align: center; text-decoration-line: underline; color: #000000;">Información de la cita<h4>
                                        <div>
                                            <a style="font-weight: 100; text-align: justify; color: #000000;">
                                            Estimado(a) {{$nombrepacientecorreo}} {{$ApellidoPaciente}}: Junto saludar cordialmente, a continuación se adjunta el comprobante de su reserva. Además, en el presente correo se solicita que usted confirme su hora con el/la Psicologo/a {{$profesionals[0]->name}} {{$profesionals[0]->apellido}}.</a>
                                        </div>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="float:left; color: #000000;">Rut:</th>
                                        <td style="float:left; color: #000000;" >{{$mensaje['rut']}}.</td>
                                </tr>
                                <tr>
                                    <th style="float:left; color: #000000;">Telefono:</th>
                                        <td style="float:left; color: #000000;">{{$mensaje['telefono']}}.</td>
                                </tr>
                                <tr>
                                    <th style="float:left; color: #000000;" >Fecha:</th>
                                        <td style="float:left; color: #000000;">{{$mensaje['fecha']}}.</td>
                                </tr>
                                <tr>
                                    <th style="float:left; color: #000000;">Horario de la cita:</th>
                                        <td style="float:left; color: #000000;">{{ $mensaje['hora_inicio']}} - {{$mensaje['hora_termino']}}.</td>
                                </tr>
                                <tr>
                                    <th style="float:left; color: #000000;">Modalidad de la atención:</th>
                                        <td style="float:left; color: #000000;">{{ $mensaje['modalidad']}}.</td>
                                </tr>
                                <tr>
                                    <th style="float:left; color: #000000;">Previsión:</th>
                                        <td style="float:left; color: #000000;"> @if($mensaje->prevision == "Isapre") {{$mensaje['prevision']}} ( {{$mensaje['isapre']}} ) @else {{$mensaje['prevision']}}  @endif .</td>
                                </tr>
                                <tr>
                                    <th style="float:left; color: #000000;">Valor de la cita:</th>
                                        <td style="float:left; color: #000000;">{{$mensaje ['precio']}}.</td>
                                </tr>
                                <tr>
                                    <th style="float:left; color: #000000;">Ubicación:</th>
                                        <td style="float:left; color: #000000;">{{$mensaje ['locacion']}}.</td>
                                </tr>
                                <tr>
                                    <th style="float:left; color: #000000;">Servicio:</th>
                                        <td style="float:left; color: #000000;">{{$servicios[0]->nombre}}.</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="justify-content-center" >
                        <a style="font-weight: 100; text-align: justify; color: #000000;">
                        <p>Afectuosamente, se despide</p>
                        <p>Equipo Psicólogos Temuco</p>
                        </a>
                        </div>
                    </div>
                </div>
                @include('partials.footer')
                </div>
            </td>
        </tr>
    </table>
</body>
</html>