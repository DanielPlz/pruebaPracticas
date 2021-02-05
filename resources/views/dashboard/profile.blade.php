@extends('layouts.dashboard')

@section('contentSidebar')
    @switch($rol)
        @case(1)
            @include('dashboard.profile.profilePaciente')
        @break
        @case(2)
            @include('dashboard.profile.profileProfesional')
        @break
    @endswitch
@endsection
