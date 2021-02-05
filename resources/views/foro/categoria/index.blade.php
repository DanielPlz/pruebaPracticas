@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url("/foro")}}">Categorias</a></li>
            <li class="breadcrumb-item">{{$categoria->titulo}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 mb-4">
            @if(Auth::user())
                <a style="color:white;background:#00aef5;" class="btn btn-primary bntModalPostAdd" data-target="#modalPostAdd" data-toggle="modal"><i class="fas fa-pen-fancy"></i> Nuevo post</a>

                <div class="btn-group dropright">
                    <a type="button" style="color:grey;background:#EDEDED;" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-list-ul"></i> Biblioteca
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{route('foroUserFavPost')}}" type="button" class="dropdown-item" ><i class="far fa-star"></i> Mis Favoritos</a>
                        <a href="{{route('foroPostsUser')}}" type="button" class="dropdown-item" ><i class="far fa-bookmark"></i> Mis Publicaciones</a>
                    </div>
                </div>
            @else
                <a href="{{ url('/register')}}" class="btn btn-outline-primary">Inicia sesion para crear una publicacion</a>
            @endif
        </div>
    </div>

    @csrf
    <input type="hidden" value="{{$categoria->id}}" id="cat_id">
    <meta id="page_id" value="1">  
    <div id="topPostList" name="topPostList"></div>
    <div id="postList" class="justify-content-center"></div>
</div>

@include('foro.modals.create-post')
@include('foro.modals.edit-post')
@include('foro.modals.delete-post')
@include('foro.modals.user-fail')


@endsection

@section('script')

@include('foro.routesForo')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/foro/utils.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/foro/categoria.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/foro/post.js') }}"></script>

@endsection
