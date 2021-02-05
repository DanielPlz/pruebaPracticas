<div class="card mt-2 tarjeta">  
        <div class="card-body">
            
           <!-- Formulario Datos Personales -->
              

            <form method="get" action="http://aprenderaprogramar.com">
            
             <div class="card card-body">
                <div class="text-center mb-4">
                    <p><u><em><strong> Antecedentes  Personales </strong></em></u></p>
                </div>
                <table >
                
                    <tr >
                        <td rowspan="5" style="text-align:center" valign="middle" align="left"><img src="/assets/img/avatar.png" width="165" height="165"></td>
                        <td style="text-align:right">Nombre :</td>
                        <td style="text-align:left"><input type="text" value="Alfredo"></td>
                        
                        <td style="text-align:right">RUT :</td>
                        <td style="text-align:left"><input type="text" value="19.922.610-K"></td>
                    </tr>
                    <tr>
                        
                        <td style="text-align:right">Apellido Paterno :</td>
                        <td style="text-align:left"><input type="text"></td>
                        
                        <td style="text-align:right">Apellido Materno :</td>
                        <td style="text-align:left"><input type="text"></td>
                    </tr>
                    <tr>
                        
                        <td style="text-align:right">Fecha de nacimiento :</td>
                        <td style="text-align:left"><input type="text"></td>

                        <td style="text-align:right">Edad :</td>
                        <td style="text-align:left"><input type="text"></td>
                    </tr>
                    <tr>
                       
                        <td style="text-align:right" >Dirección :</td>
                        <td style="text-align:left "><input type="text" ></td>
                       
                        <td style="text-align:right" >Estudio :</td>
                        <td style="text-align:left "><input type="text" ></td>
                    </tr>
                    <tr>
                        
                        <td style="text-align:right" >Tel&eacute;fono :</td>
                        <td style="text-align:left "><input type="text" ></td>
                       
                        <td style="text-align:right" >N&uacute;mero De Ficha :</td>
                        <td style="text-align:left "><input type="text" ></td>

                        <tr>
                            <td><br></td>
                            <td></td>
                            
                        </tr>
                    </tr> 
                    <tr>
                        <td></td>
                        <td style="text-align:right" ></td>
                        <td style="text-align:left"> <button class="btn btn-primaryB" type="submit">Editar</button></td>
                        <td style="text-align:left"> <button class="btn btn-primaryA" type="submit">Guardar</button></td>
                    </tr>
                    
                </table>
           
            
            </form>
        
            </div>
            <!-- Formulario Datos Personales -->

                
            </div>
            <!-- Ver mas -->
            <div class="container col 8 ">
                <div class="card ">
        
                     
                     <div id="accordion1">
                        <div class="card">
                            <div class="card-header text-center" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                       
                                        <div class="link-color" ><strong>...</strong></div>
                                    </button>
                                    
                                </h5>
                            </div>
        
                            <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                <form action="#" method="post" role="form">
                                    @csrf
                                    <div class="card">
                                        <table class="mt-2">
                                            <tr>

                                                <td style="text-align:right" >Estudios :</td>
                                                <td style="text-align:left "><input type="text" ></td>
                                                <td style="text-align:right" >Ocupación :</td>
                                                <td style="text-align:left "><input type="text" ></td>
                                               
                                            </tr>
                                            <tr>
                                                <td style="text-align:right" >Información :</td>
                                                <td style="text-align:left "><textarea name="w3review" rows="5" cols="50" placeholder="Texto Información"></textarea>
                                                <td style="text-align:right"></td>
                                                <td style="text-align:left "></td>
                                            </tr>
                                        </table>
                                    </div>
        
                                    <div>
        
                                        <button type="submit" class="btn ml-3 mt-2 mb-2 indigo text-white ">Guardar Datos</button>
                                </form>
                            </div>
                        </div>
        
                     </div>
                     <div class="card">
                        <div class="card-header text-center " id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="link-color" ><strong>Antecedentes Familiares</strong></div>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div>
        
                                    <div id="accordion1">
                                        <div class="card">
                                            <div class="card-header" id="headingOne1">
                                                <h5 class="mb-0">
        
                                                <div  class="collapseTwo " aria-labelledby="headingOne1" data-parent="#accordion">
                                                    <table class="mt-2">
                                           
                                                        <tr>
                                                            <td style="text-align:right" >Grupo Familiar :</td>
                                                            <td style="text-align:left "><textarea name="w3review" rows="10" cols="70" placeholder="Texto Información"></textarea>
                                                            <td style="text-align:right"></td>
                                                            <td style="text-align:left "></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                        </div>
        
                                    </div>
                                </div>
        
                                <button type="submit" class="btn ml-3 mt-2 mb-2 indigo text-white">Guardar</button>
                                
        
                            </div>

                      
                        
                        </div>
                    </div>
                    <!-- Ver mas -->

                    <!-- Diagnosticos -->
                    <div class="card">
                        <div class="card-header text-center " id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class="link-color" ><strong>Antecedentes Familiares</strong></div>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="collapseThree" data-parent="#accordion">
                            <div class="card-body">
                                <div>
        
                                    <div id="accordion1">
                                        <div class="card">
                                            <div class="card-header" id="headingOne1">
                                                <h5 class="mb-0">
        
                                                <div  class="collapseThree " aria-labelledby="headingOne1" data-parent="#accordion">
                                                    <!-- Contenido -->
                                                    @include('ficha.includes.diagnostico')
                                                    <!-- Contenido -->
                                                </div>
                                        </div>
        
                                    </div>
                                </div>
        
                                <button type="submit" class="btn ml-3 mt-2 mb-2 indigo text-white">Guardar</button>
                                
        
                            </div>

                        
                        </div>
                    </div>
                    <!-- Diagnosticos -->
                </div>
            </div>

                  


    