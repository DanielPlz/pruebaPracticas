@extends('layouts.app')
@section('navbar')
    @include('partials.navbar')
@endsection
@section('content')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">Categorias</li>
            </ol>
        </nav>        
        @if (Auth::user() && Auth::user()->tipo == "Administrador")
            <a style="color:white;background:#00aef5;" class="btn btn-primary bntModalCatAdd" data-target="#modalCatAdd" data-toggle="modal"><i class="fas fa-pen-fancy"></i>Nueva categoria</a>
        @endif
        <div id="catList">
        </div>
    </div>

    @include('foro.modals.create-category')
    @include('foro.modals.edit-category')
    @include('foro.modals.delete-category')
    @include('foro.modals.user-fail')
    
@endsection

@section('script')

@include('foro.routesForo')

<script type="text/javascript" src="{{ URL::asset('assets/js/foro/utils.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/foro/crudCat.js') }}"></script>

@endsection