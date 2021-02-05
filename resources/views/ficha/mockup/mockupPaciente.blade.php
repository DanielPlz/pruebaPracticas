@extends('layouts.dashboard')
@section('contentSidebar')

<div class="container-fluid">
    <div class="card">  
        <div class="card-header text-center">
            <p class="h1">Ficha clinica</p>
        </div>
    </div>
    
    <div class="card">  
        <div class="card-body">
            <div class="text-center">
                <p><em><strong>Antonio Dionisio Benavides Soza,</strong> 12.336.945-5, 35 años.</em></p>
                <p>Padre Hurtado, Santiago.</p> 
                <p>Ultima atención registrada el 24/05/19</p>
            </div>
            
            <br>
            <div class="card-header" id="headingOne">
                <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#masDatosPaciente" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <div class="text-center"><strong>Ver mas antecedentes</strong></div> 
                </a>
            </div>

            <div class="collapse" id="masDatosPaciente">
                <div class="card card-body">
                    <p><em><strong>Telefono: </strong> +5694825135</em></p>
                    <p><em><strong>Fecha de nacimiento: </strong> 23/11/84</em></p>
                    <p><em><strong>Region: </strong> Metropolitana de Santiago</em></p>
                    <p><em><strong>Comuna: </strong> Padre Hurtado</em></p> 
                    <p><em><strong>Calle: </strong> Violeta Parra #325</em></p>
                    <p><em><strong>Ocupacion: </strong> Venta de mercaderia</em></p>
                    <p><em><strong>Nivel de estudios: </strong> Basica completa</em></p>
                </div>
            </div>
        </div>
    </div>

    <!-- CASO A -->
    <div class="card">
        <div class="card-header" id="casoA">
            <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosCasoA" role="button" aria-expanded="false" aria-controls="collapseExample">
                <div class="h4">Caso ANTBEN-0004</div> 
            </a> 
            
            <div class="ml-4"><em>Ultima fecha de atencion: 24/05/20</em></div>
        </div>
        <div class="collapse" id="datosCasoA">
            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionA1" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">24/05/20 | Sesion 3 - Chequeo medico general</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionA1">
                    <div class="card-body">
                        <p>Atendido por Juan Valdes Pereira</p>
                        <p>Servicio de Chequeo medico general</p> 
                        <br>
                        <a href="#">Ver detalles diagnosticos</a>
                    </div>
                </div>
            </div>

            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionA2" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">05/04/20 | Derivacion a Juan Valdes Pereira, Medico General</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionA2">
                    <div class="card-body">
                        <div>Aprobado por el paciente el 06/04/20</div> 
                    </div>
                </div>
            </div>

            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionA3" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">05/04/20 | Sesion 2 - Terapia cognitiva</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionA3">
                    <div class="card-body">
                        <p>Atendido por Juan Valdes Pereira</p>
                        <p>Servicio de Chequeo medico general</p> 
                        <br>
                        <a href="#">Ver detalles diagnosticos</a>
                    </div>
                </div>
            </div>

            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionA4" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">02/03/20 | Sesion 1 - Terapia cognitiva</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionA4">
                    <div class="card-body">
                        <p>Atendido por Juan Valdes Pereira</p>
                        <p>Servicio de Chequeo medico general</p> 
                        <br>
                        <a href="#">Ver detalles diagnosticos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CASO B -->
    <div class="card">
        <div class="card-header" id="casoB">
            <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosCasoB" role="button" aria-expanded="false" aria-controls="collapseExample">
                <div class="h4">Caso ANTBEN-0002</div> 
            </a> 
            
            <div class="ml-4"><em>Ultima fecha de atencion: 13/09/19</em></div>
        </div>
        <div class="collapse" id="datosCasoB">
            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionB1" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">13/09/19 | Cierre de caso por parte de Antonio Benavides Soza</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionB1">
                    <div class="card-body">
                        <div>Usted ha decidido finalizar su participacion en este caso. Esto significa que no podra realizar modificaciones ni podra ver el avance del caso. Si desea solicitar una reintegracion al caso, puede solicitarlo enviando un mensaje a la administracion.</div> 
                    </div>
                </div>
            </div>

            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionB2" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">13/09/19 | Derivacion a Sergio Pino, Psicologo</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionB2">
                    <div class="card-body">
                        <div>Aprobado por el paciente el 13/09/19</div> 
                    </div>
                </div>
            </div>

            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionB3" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">30/06/19 | Derivacion a Juan Gabriel, Psicologo</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionB3">
                    <div class="card-body">
                        <div>Rechazado por el paciente</div> 
                    </div>
                </div>
            </div>

            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionB4" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">30/06/19 | Sesion 3 - Chequeo neurologico</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionB4">
                    <div class="card-body">
                        <p>Atendido por Manuel Rodriguez Rodriguez</p>
                        <p>Servicio de Chequeo neurologico</p> 
                        <br>
                        <a href="#">Ver detalles diagnosticos</a>
                    </div>
                </div>
            </div>

            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionB5" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">05/04/19 | Sesion 2 - Atencion de urgencia medica</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionB5">
                    <div class="card-body">
                        <p>Atendido por Ramon Cabrera</p>
                        <p>Servicio de Atencion de urgencia medica</p> 
                        <br>
                        <a href="#">Ver detalles diagnosticos</a>
                    </div>
                </div>
            </div>

            <div class="card my-3 mx-3">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" data-toggle="collapse" href="#datosSesionB6" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h6">04/04/19 | Sesion 1 - Atencion medica de urgencia</div> 
                    </a>
                </div>
                <div class="collapse" id="datosSesionB6">
                    <div class="card-body">
                        <p>Atendido por Ramon Cabrera</p>
                        <p>Servicio de Atencion de urgencia medica</p> 
                        <br>
                        <a href="#">Ver detalles diagnosticos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection

@section('scripts')

@endsection