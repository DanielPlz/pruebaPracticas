@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
<div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-home" aria-selected="true">Perfil</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-favorites" role="tab" aria-controls="v-pills-profile" aria-selected="false">Mis favoritos</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-posts" role="tab" aria-controls="v-pills-messages" aria-selected="false">Publicaciones</a>
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-home-tab">
      Editar perfil
      </div>
      <div class="tab-pane fade" id="v-pills-favorites" role="tabpanel" aria-labelledby="v-pills-profile-tab">
      Agregados recientemente:
      </div>
      <div class="tab-pane fade" id="v-pills-posts" role="tabpanel" aria-labelledby="v-pills-messages-tab">
      Mis articulos:
      </div>
    </div>
  </div>
</div>
@endsection