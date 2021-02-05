@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    <div>
        <h5>Mis publicaciones: </h5>
    </div>
    <br>
    @if (count($posts) > 0)
        @foreach ($posts->sortByDesc('created_at') as $post)
            <div class="card" id="list-post">
                <div class="card-body" id="tablapost">
                    <div class="mb-2">
                        <a class="h5" style="color:#02709d" href="{{ route('foroPostIndex', $post) }}">{{ $post->titulo }}</a>
                        <input type="hidden" value="{{ $post->id }}" id="post_id"><br>
                        <a style="color:grey">{{ $post->created_at }}</a><br>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @endif
@endsection
