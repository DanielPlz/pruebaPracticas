<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pdf_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Ficha Médica Paciente</title>
</head>

<body>
        <img src="/assets/img/logo-ps.png" alt="Logo Conexión Salud">
    <div class="text-center encabezado_pdf">
        <h1>Conexión Salud</h1>
    </div>
    <h5 class="ficha">Ficha Clínica Paciente</h5>
    <div class="contenedor_sesiones">
        
        <!-- Datos del Paciente -->
        <table class="table table-bordered letra_tabla table_paciente">
            <thead>
                <tr>
                    <th scope="col">N° de Ficha</th>
                    <th scope="col">Run</th>
                    <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><label for="">{{$paciente->id}}</label></th>
                    <td><label for="">{{$paciente->rut}}</label></td>
                    <td><label for="">{{$paciente->name }} {{ $paciente->apellido}}</label></td>
                </tr>
            </tbody>
        </table>
        <!-- Información del Paciente -->
        <div class="item_pdf">
            <h4 class="text-left subtitulo">Información Del Paciente</h4>
            <table class="table table-bordered letra_tabla table_info">
                <tbody>
                    <tr>
                        <th scope="row">Correo :</th>
                        <td colspan="2">{{$paciente->email}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Estado :</th>
                        <td colspan="2">@if ($paciente->estado === 1) Activo @else Histórico @endif</td>
                    </tr>
                    <tr>
                        <th scope="row">Ocupación :</th>
                        <td colspan="2">{{$paciente->ocupacion}}</td>
                    </tr>
                    <tr>
                        <th scope="row">F. nacimiento :</th>
                        <td colspan="2">{{$paciente->fecha_nacimiento}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Edad :</th>
                        <td colspan="2">{{$paciente->edad}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Domicilio :</th>
                        <td colspan="2">{{$paciente->direccion}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Estudios :</th>
                        <td colspan="2">{{$paciente->estudios}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tipo de Egreso :</th>
                        <td colspan="2">@if ($paciente->tipo_alta === 1)Alta Terapéutica @elseif ($paciente->tipo_alta === 2)Alta Administrativa @elseif ($paciente->tipo_alta === 3) Abandono @else @endif</td>
                    </tr>
                    <tr>
                        <th scope="row">Fecha de Egreso :</th>
                        <td colspan="2">{{$paciente->fecha_egreso}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Información Diagnóstico -->
        <div class="item_pdf">
            <h4 class="text-left subtitulo">Diagn&oacute;stico</h4>
            <table class="table table-bordered letra_tabla table_info">
                <tbody>
                    <tr>
                        <th scope="row">Fecha Creaci&oacute;n :</th>
                        <td colspan="2">{{$diagnostico->created_at}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Fecha &Uacute;ltima Actualizaci&oacute;n :</th>
                        <td colspan="2">{{$diagnostico->updated_at}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Descripci&oacute;n :</th>
                        <td colspan="2">{{$diagnostico->descripcion}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Información Manuales -->
        <div class="item_pdf ctn_manual">
            <h4 class="text-left subtitulo">Manuales</h4>
            <!-- manual 1 -->
            @foreach ($manuales as $manual)
            @if ($manual->tipo_manual===1)
            <table class="table table-bordered letra_tabla table_manuales">
                <tbody>
                    <tr>
                        <th scope="col" colspan="2" class="ctn-table-manuales">DSM IV - TR Evaluaci&oacute;n Multiaxial</th>
                    </tr>
                    <tr>
                        <th scope="row">Eje 1:</th>
                        <td>{{$manual->eje1}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 2:</th>
                        <td>{{$manual->eje2}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 3:</th>
                        <td>{{$manual->eje3}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 4:</th>
                        <td>{{$manual->eje4}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 5:</th>
                        <td>{{$manual->eje5}}</td>
                    </tr>
                </tbody>
            </table>
            @endif
            @endforeach
            <!-- manual 2 -->
            @foreach ($manuales as $manual)
            @if ($manual->tipo_manual===2)
            <table class="table table-bordered letra_tabla table_manuales">
                <tbody>
                    <tr>
                        <th scope="col" colspan="2" class="ctn-table-manuales">DSM IV - TR Evaluaci&oacute;n Multiaxial</th>
                    </tr>
                    <tr>
                        <th scope="row">Eje 1:</th>
                        <td>{{$manual->eje1}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 2:</th>
                        <td>{{$manual->eje2}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 3:</th>
                        <td>{{$manual->eje3}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 4:</th>
                        <td>{{$manual->eje4}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 5:</th>
                        <td>{{$manual->eje5}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 6:</th>
                        <td>{{$manual->eje6}}</td>
                    </tr>
                </tbody>
            </table>
            @endif
            @endforeach
            <!-- manual 3 -->
            @foreach ($manuales as $manual)
            @if ($manual->tipo_manual===3)
            <table class="table table-bordered letra_tabla table_manuales">
                <tbody>
                    <tr>
                        <th scope="col" colspan="2" class="ctn-table-manuales">DSM IV - TR Evaluaci&oacute;n Dimensional</th>
                    </tr>
                    <tr>
                        <th scope="row">Eje 1:</th>
                        <td>{{$manual->eje1}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 2:</th>
                        <td>{{$manual->eje2}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Eje 3:</th>
                        <td>{{$manual->eje3}}</td>
                    </tr>
                </tbody>
            </table>
            @endif
            @endforeach
        </div>
        <!-- Información Sesiones -->
        <div class="item_pdf ctn_sesion">
            <div class="contenedor_sesiones">
                <h4 class="text-left subtitulo">Sesiones</h4>
                <!-- Sesiones -->
                @foreach ($sesiones as $sesion)
                <table class="table table-bordered letra_tabla table_sesiones">
                    <tbody>
                        <tr>
                            <th scope="row" class="ctn-table-sesiones">Sesi&oacute;n N° :</th>
                            <td class="ctn-table-sesiones">{{$sesion->numero_sesion}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Descripci&oacute;n :</th>
                            <td>{{$sesion->descripcion}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Fecha :</th>
                            <td>{{$sesion->fecha}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Periodo :</th>
                            <td>{{$sesion->periodo}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                <!-- Fin sesiones -->
            </div>
            <!-- Información Comentarios -->
            <div class="item_pdf">
                <h4 class="text-left subtitulo">Comentarios</h4>

                <table class="table table-bordered letra_tabla table_info">
                    @foreach ($observaciones as $observacion)
                    <tbody>
                        <tr>
                            <th scope="row">{{$observacion->observacion}}</th>
                            <td>{{$observacion->created_at}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
</body>

</html>