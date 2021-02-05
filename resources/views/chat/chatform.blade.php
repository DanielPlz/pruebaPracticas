@extends('layouts.dashboard')
@section('contentSidebar')
{{-- vista del chat de profesional --}}
  {{-- @yield('contenidoChat')  --}}
    <div class="container-fluid" id="container-chat">
        <div class="row" id="app">
            <div class="col-md-4" id="container-users">
                <div class="card">
                    <div class="card-header text-white" style="background: #075E55; height: 60px;">
                        <h3>Pacientes.</h3>
                    </div>
                    <div class="card-body" id="contpChat" style="overflow-y: scroll; height: 700px;">
                        <ul class="users">
                            @foreach($users as $user)
                                @if ($user->tipo == 'Paciente')
                                    <li class="user" id="{{$user->id}}">
                                        {{-- verifica el listado de mensajes sin leer --}}
                                        @foreach($notReadList as $notRead)
                                            @if ($notRead['from'] == $user->id && $notRead['count'] != 0)
                                                <span class="pending">{{ $notRead['count'] }}</span>
                                            @endif
                                        @endforeach
                                        {{-- will show unread count notification --}}
                                        @if($user->unread)
                                            <span class="pending">{{ $user->unread }}</span>
                                        @endif
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{$user->avatar}}" alt="" class="media-object">
                                            </div>
                                            <div class="media-body">
                                                <p class="name">{{$user->name}} {{ $user->apellido }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8" id="container-messages">
                <div class="card" id="messages-content">
                    <div class="card-header" style="height: 60px; background: #075E55">
                        <span id="btn-showUser" class="btn float-right" ><i class="fas fa-arrow-left text-white"></i></i></span>
                        {{-- <span id="close-message-content" class="btn float-right" ><i class="fas fa-times text-white"></i></span> --}}
                    </div>
                    <div class="card-body" id="cont-chat">
                        <div class="message-wrapper" style="overflow-y: scroll; height: 100%;" >
                            <ul class="messages">
                        
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" enctype="multipart/form-data" id="formChat" action="{{ url('/chat') }}" myPersonalId="{{ Auth::id() }}">
                            {{ csrf_field() }}
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
                        </form>
                    </div>
                </div>     
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/locale/es.min.js"></script>
<script src="{{ asset('assets/js/chat.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script> --}}
{{-- <script src="{{ asset('assets/js/chat/profesional_emoji.js') }}"></script> --}}
@endsection