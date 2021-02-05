@extends('layouts.dashboard')
@section('contentSidebar')
<div class="container-fluid">
	<div class="card">
        <div class="card-header text-center">
			<p class="h1">DETALLES DE LA SESION</p>
			<p class="h3">diagnostiko</p>
        </div>
	</div>

	<div class="card">
        <div class="card-body">
            <div class="text-center">
                <p><em><strong>Antonio Dionisio Benavides Soza,</strong> 12.336.945-5, 35 años.</em></p>
                <p>Padre Hurtado, Santiago.</p>
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
                    <p><em><strong>Nivel de estudios: </strong>media</em></p>
                </div>
            </div>
        </div>
	</div>


	<div class="card">
        <div class="card-header text-center">
			<p class="h3">Diagnostico de la sesion</p>
		</div>
		<p class="h4">Manual: MEDIVAC</p>
		<label for="signosVitales">Signos Vitales</label>
		<textarea name="signosVitales" id="signosVitales" placeholder="Descripcion de los signos vitales del paciente" cols="30" rows="10">El paciente posee un pulso 70/130 y esta con quemaduras graves</textarea>
		<label for="examenFisico">Examen Fisico</label>
		<textarea name="examenFisico" id="examenFisico" placeholder="Informacion acerca del cuerpo de la persona" cols="30" rows="10"></textarea>
	</div>



</div>

@endsection

@section('script')
	<script src="{{asset('assets/js/ficha/mockup/jquery.steps.js')}}"></script>
	<script src="{{asset('assets/js/ficha/mockup/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets/js/ficha/mockup/main.js')}}"></script>
@endsection
