<div class="modal fade" id="modalMensaje">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data" id="formChatModal" action="{{ url('/chat') }}" 
            myPersonalId="{{ Auth::id() }}" recerveId="{{ $user->id }}" style="position: relative;"> 
            <div class="modal-content">
                <div class="card-body" style="background: #075E55; height: 60px" >
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="white-text">x</span>
                    </button>
                    <h5 class="text-left text-white text-3" style="margin-top:8px"> 
                        <p style="margin-left: 2rem"> 
                            @if($user->isOnline())
                                <span class="color" ></span> 
                            @else 
                                <span class="colors"></span>
                            @endif Chat con {{ $user->name }} {{ $user->apellido }} 
                        </p>
                    </h5> 
                </div>
                <div id="cont-chat" class="card-body" >
                    <div class="message-wrapper" style="height:60vh; overflow-y: scroll">
                        {{-- Alerta para usuarios no logeados --}}
                        <div hidden id="element" role="alert" aria-live="assertive" aria-atomic="true" class="toast m-auto" data-autohide="false">
                            <div class="toast-header" style="font-size:20px">
                                <strong class="mr-auto"><i class="fa fa-exclamation-triangle fa-fw" style="color:#FF4057"></i> Recuerde</strong>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body" style="font-size: 18px">
                                Por favor <a href="{{ url('/login') }}" style="color:#FF4057"> iniciar sesion. </a>
                            </div>
                        </div>
                        {{-- contenedor de mensajes --}}
                        <ul class="messages">
                            {{-- Prueba de spiner de carga --}}
                            <div id="spinner" class="spinner-grow text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="file" name="fileUser" id="fileUser" hidden>
                    <div class="input-group">
                        <!-- <button id="emoji-button" class="btn btn-light" type="button">😛</button> -->
                        <input type="text" autocomplete="off" id="txtChat" class="form-control" placeholder="Escribe un mensaje aqui..." aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            {{-- botón de seleccion de archivo --}}
                            <button type="button" class="btn btn-outline-secondary" name="addFile" id="addFile" style="background-color: #075E55">
                                <i class="fas fa-paperclip fa-fw white-text"></i>
                            </button>
                            {{-- botón de envio de mensaje --}}
                            <button type="submit" class="btn btn-outline-secondary" name="message" type="button" style="background-color: #075E55">
                                <i class="far fa-paper-plane fa-fw white-text"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@section('script')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/locale/es.min.js"></script>
<script src="{{ asset('assets/js/chat.js') }}"></script>
<script src="{{ asset('assets/js/funciones.js') }}"></script>
<script src="{{ asset('assets/js/modal_create_reservas.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script> --}}
{{-- <script src="{{ asset('assets/js/chat/paciente_emoji.js') }}"></script> --}}
@endsection
