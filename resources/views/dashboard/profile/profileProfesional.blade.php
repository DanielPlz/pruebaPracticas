<form action="{{route('imgUpdate')}}" method="POST" enctype="multipart/form-data" id="update">
    @csrf
    <input type="file" name="file" id="file">
</form>
<section class="seccion">
    <div class="panel-portada">
        <img class="panel-portada" src="{{asset('assets/img/dashboardShadow.jpg')}}" alt="">
        <div class="perfil">
            @if(auth()->user()->avatar)
            <img id="imagen_id" src="{{Auth::user()->avatar}}" alt="avatar">
            @else
            <img id="imagen_id" src="{{asset('assets/img/avatar.png')}}" alt="avatar">
            @endif
        </div>
        <label for="file" class="label-perfil"></label>
        <label for="file" class="label-perfil2">Cambiar foto</label>
    </div>
    <div class="contenido">
        <div class="tarjeta-1">
            <h2 class="titulo">{{$user->nombre}} {{$user->apellido_paterno . ' ' .$user->apellido_materno}}</h2>
            <p class="texto">Descripcion</p>
            <p class="texto2">{{$user->descripcion}}</p>
        </div>
        <div class="tarjeta-2">
            <div class="col-md-12" id="div_datos">
                <label for="" class="text-4 darkgray-text text-bold col-12">Tus datos</label>
                <label for="" class="text-5 darkgray-text col-10">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus quod nisi eos minima molestias consectetur, placeat corporis distinctio odio quos ipsam a. Aspernatur molestiae quisquam doloribus! Nemo quae dolorum numquam.</label><label id="editar_datos" class="col-1 text-5 text-bold indigo-text float-right dropbtn">Editar</label>
            </div>
            <ul class="ul sm-pr-0" style="display: none;" id="ul_datos">
                <form action="{{route('dashboardUpdate')}}" method="post" id="form_datos">
                    @csrf
                    <h2 class="subTitulo">Tus datos</h2>
                    <div class="form-group row pl-3 pr-3 mb-3">
                        <div class="col" id="nombre_div">
                            <label for="name" class="text-5 darkgray-text text-bold">Nombre</label>
                            <input id="nombre" type="text" placeholder="Nombre" class="form-control text-4 bluegray-text" name="name" required="required" value="{{$user->nombre}}" autocomplete="name">
                        </div>
                        <div class="col-md-6" id="apellido_div">
                            <label for="apellido" class="text-5 darkgray-text text-bold">Apellido</label>
                            <input id="apellido" type="text" placeholder="Apellido" class="form-control text-4 bluegray-text" name="apellido" required="required" value="{{$user->apellido_paterno . ' '.$user->apellido_materno}}" autocomplete="apellido">
                        </div>
                    </div>
                    <div class="form-group row pl-3 pr-3 mb-3">
{{--                        <div class="col " id="nickname_div">--}}
{{--                            <label for="nickname" class="text-5 darkgray-text text-bold">Nickname</label>--}}
{{--                            <input id="nickname" type="text" class="form-control text-4 bluegray-text" placeholder="Nickname" name="nickname" value="{{auth()->user()->nickname}}" autocomplete="nickname">--}}
{{--                        </div>--}}
                        <div class="col-md-6 ">
                            <div class="form-group row">
                                <div class="col-5">
                                    <label for="codigo" class=" text-5 darkgray-text  text-bold">C&#243;digo</label>
                                    <input disabled type="text" class="form-control text-4 bluegray-text" name="codigo" required value="+569">
                                </div>
                                <div class="col-7" id="telefono_div">
                                    <label for="telefono" class=" text-5 darkgray-text  text-bold">Telefono</label>
                                    <input id="telefono" type="text" placeholder="Telefono" class="form-control text-4 bluegray-text" name="telefono" required="required" value="{{$user->telefono}}" autocomplete="telefono">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row pl-3 pr-3 mb-3">
                        <div class="col" id="correo_div">
                            <label for="correo" class="text-5 darkgray-text text-bold">Correo</label>
                            <input id="correo" type="text" placeholder="Correo" class="form-control text-4 bluegray-text" name="correo" required="required" value="{{auth()->user()->email}}" autocomplete="correo">
                        </div>
                        <div class="col-md-6" id="region_div">
                            <label for="servicio_id" class="text-5 darkgray-text text-bold" id="">Región</label>
                            <select class="custom-select text-4 bluegray-text" name="region" id="select">
                                <option value="" class="text-4 bluegray-text">---- Seleccione su Regi&#243;n ----</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row pl-3 pr-3 mb-5">
                        <div class="col " id="comuna_div">
                        </div>
                        <div class="col-md-6" id="direccion_div">
                        </div>
                    </div>
                    <div class="tarjeta-2" id="div_password">
                        <label for="" class="text-4 darkgray-text text-bold col-12">Cambiar contrase&#241;a</label>
                        <label for="" class="text-5 darkgray-text col-10">Se recomienda usar una contrase&#241;a segura que no uses para ningún otro sitio </label><label id="editar_password" class="col-1 text-5 text-bold indigo-text float-right dropbtn">Editar</label>
                        <div class="form-group row pl-3 pr-3 mb-3" id="password" style="display: none;">
                            <div class="col-md-4">
                                <label for="actualContraseña" class="text-5 darkgray-text text-bold">Actual</label><i class=" far fa-eye float-left" id="actual_show"></i>
                                <input id="actualContraseña" type="password" class="form-control text-4 bluegray-text" name="actualContraseña" value="" placeholder="Password">
                                <span class="invalid-feedback" role="alert" id="valid_actual">
                                    <strong>Contraseña Incorrecta</strong>
                                </span>
                            </div>
                            <div class="col-md-4">
                                <label for="contraseña" class="text-5 darkgray-text text-bold">Contraseña</label><i class=" far fa-eye float-left" id="new_show"></i>
                                <input id="contraseña" type="password" class="form-control text-4 bluegray-text" name="contraseña" value="" placeholder="Password">
                                <span class="invalid-feedback" role="alert" id="valid_password">
                                    <strong></strong>
                                </span>
                            </div>
                            <div class="col-md-4">
                                <label for="val_contraseña" class="text-5 darkgray-text text-bold" id="">Confirmar contrase&#241;a</label><i class=" far fa-eye float-left" id="val_show"></i>
                                <input id="val_contraseña" type="password" class="form-control text-4 bluegray-text" name="val_contraseña" value="" placeholder="Password">
                                <span class="invalid-feedback" role="alert" id="valid_valid">
                                    <strong>No coinciden</strong>
                                </span>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="button" class="btn  indigo white-text text-bold float-right text-5 " id="update_password">
                                    Guardar cambios
                                </button>
                                <button type="button" class="btn  white indigo-text text-4 float-right text-5 " id="cancelar_update">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- <h6>texto opcional</h6> -->
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn  indigo white-text text-bold float-right text-5 " id="update_datos">
                            Guardar cambios
                        </button>
                        <button type="button" class="btn  white indigo-text text-4 float-right text-5 " id="cancelar_datos">
                            Cancelar
                        </button>
                    </div>
                </form>
            </ul>
        </div>
        <div class="tarjeta-3">
            <ul class="ul">
                <h2 class="subTitulo">Descripcion</h2>
                <div class="form-group row  mb-3">
                    <div class="col-sm-12 mb-3">
                        <li>
                            <textarea class="form-control text-4 textarea bluegray-text" name="descripcion" id="descripcion" value="" cols="30" rows="3">
                                {{$user->descripcion}}
                            </textarea>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
        <div class="tarjeta-4">
            <ul class="ul">
                <h2 class="subTitulo">Tus datos profesionales</h2>
                <br>
                <div class="radio-group">
                    <label class="radio">
                        <input type="radio" value="privado" name="locacion">Consulta privada
                        <span></span>
                    </label>
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    <label class="radio ">
                        <input type="radio" value="centro" name="locacion">Centro medico
                        <span></span>
                    </label>
                </div>
                <br>
                <!--
                agregar divs
                <div class="form-group row pl-3 pr-3 mb-3">
                    <div class="col" id="">
                        <label for="" class="text-5 darkgray-text text-bold"></label>
                        <input id="" type="text" placeholder="" class="form-control text-4 bluegray-text" name="" value="" autocomplete="">
                    </div>
                    <div class="col-md-6" id="">
                        <label for="" class="text-5 darkgray-text text-bold"></label>
                        <input id="" type="text" placeholder="" class="form-control text-4 bluegray-text" name="" value="" autocomplete="">
                    </div>
                </div> -->
            </ul>
        </div>
        <!--<div class="tarjeta-2">
            <ul class="ul">
                <h2 class="subTitulo">ingrese mas datos que quiera</h2>
            </ul>
             <div>
                <button type="submit" class="btn  indigo white-text text-bold float-right text-4 ">
                    Guardar datos
                </button>
                <a href="{{url('dashboard/back')}}"><button type="button" class="btn  white indigo-text text-4 float-right">Cancelar</button></a>
            </div>
        </div>-->
    </div>
</section>
@section('script')
    <script src="{{asset('assets/js/dashboard/profile.js')}}"></script>
@endsection
