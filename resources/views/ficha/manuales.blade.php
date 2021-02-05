<!-- INICIO EDITAR MANUALES DIAGNÓSTICOS -->


<!-- Consulta por si se recibe la variable manuales, (si existe un manual ingresado en base de datos) -->

<!-- Validaciones -->



<div class="card text-center container_information ">

    <h3 class="card-title">Manuales diagn&oacute;stico psicol&oacute;gico</h3>
    <div class="description">


 
    <div class="evaluacion">
            <h4 class="titulo">DSM IV - TR</h4>
            <!-- EDITAR MANUAL -->
            <a class="btn btn-success btn_editar_manual1" data-toggle="collapse" href="#ctn_editar_manual1" role="button" aria-expanded="false" aria-controls="ctn_evaluacion1">Editar Evaluación Multiaxial</a>
            <div class="collapse multi-collapse ctn_comentario" id="ctn_editar_manual1">

                

                <form action="" method="post" role="form">
                  
                    @csrf
                    <div class="evaluacion__1">
                        <label for="">Eje 1</label>
                        <textarea class="form-control" id="txt_editar_eje1" name="txt_editar_eje1" rows="2" placeholder="Trastornos Clínicos" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <label for="">Eje 2</label>
                        <textarea class="form-control" id="txt_editar_eje2" name="txt_editar_eje2" rows="2" placeholder="Trastornos de la persona" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <label for="">Eje 3</label>
                        <textarea class="form-control" id="txt_editar_eje3" name="txt_editar_eje3" rows="2" placeholder="Enfermedades Médicas" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <label for="">Eje 4</label>
                        <textarea class="form-control" id="txt_editar_eje4" name="txt_editar_eje4" rows="2" placeholder="EAG (0-100)" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <label for="">Eje 5</label>
                        <textarea class="form-control" id="txt_editar_eje5" name="txt_editar_eje5" rows="2" placeholder="EEAG (0-100)" required></textarea>
                    </div>
                    <div class="evaluacion__1">
                        <button type="submit" class="btn btn-primary" id="manual1" name="btn_manual1">Guardar Cambios</button>
                    </div>
                </form>
             
            
            </div>

            <!-- Alert -->
            @if(session()->has('successm1'))
            <div class="alert alert-success" role="alert">{{session('successm1')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <!-- Alert -->

        </div>


      

</div>
<div>
        <a href="{{route('create', $paciente->id)}}" class="btn btn-primary ">Crear Nuevo Manual</a>
    </div>
   
<!-- TÉRMINO EDITAR MANUALES DIAGNÓSTICOS -->
