@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    <div>
        <h5>Mis favoritos: </h5>
    </div>
    <br>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <a class="h5" style="color:#02709d" href="{{ route('foroPostIndex', $post) }}">{{ $post->titulo }}</a>
                        <input type="hidden" value="{{ $post->id }}" id="post_id"><br>
                        <a style="color:grey">Por: {{ $post->user->name }}</a><br>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @endif
@endsection
