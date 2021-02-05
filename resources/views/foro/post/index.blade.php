@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
@csrf
<input type="hidden" value="{{$post->id}}" name="posteo" id="post_id"> 
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route("foroIndex")}}">Categorias</a></li>
                <li class="breadcrumb-item"><a href="{{ route('foroCatIndex', $post->categoria->id) }}">{{$post->categoria->titulo}}</a></li>
                <li class="breadcrumb-item">{{$post->titulo}}</li>
            </ol>
        </nav>
        <div id="postList">
            <div id="postDetail">
                @include('foro.post.viewDetail')
            </div>            
        </div>
        
        <!-- Caja de comentarios -->
        <div>
            <form id="addCmt">
                @csrf
                <table class="table table-condensed" align="center">
                    <tr>
                        <td>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="hidden" value="{{ $post->id }}" name="post_id">
                                </div>
                                <div class="form-group">
                                    <textarea id="boxComment" name="comment" class="form-control"
                                        placeholder="Escribe aquí tu comentario..."
                                        autocomplete="comment"></textarea>
                                </div>
                                <ul class="errorMsg mt-3"></ul>
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary" id="btnCmtAdd">Comentar</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        @if (session('mensaje'))
            <div class="alert alert-success" align="center">
                {{ session('mensaje') }}
            </div>
        @endif

        <div id="cmtList">
        </div>

        @include('foro.modals.user-fail')

        @include('foro.modals.edit-post')
        @include('foro.modals.delete-post')
        
        @include('foro.modals.edit-cmt')
        @include('foro.modals.delete-cmt')
    </div>
@endsection

@section('script')
<script>
//Cargar comentarios
$(document).ready(function(){
    loadPostDetail();
    listCmt();
});
</script>

@include('foro.routesForo')

<script type="text/javascript" src="{{ URL::asset('assets/js/foro/utils.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/foro/comment.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/foro/post.js') }}"></script>

@endsection
