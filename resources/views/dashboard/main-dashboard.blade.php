@extends('dashboard.main')

@section('content')
    <div class="content">
        <!-- Top Bar Start -->
        <div class="topbar">
            @include('dashboard.parts.header')
        </div>
        <!-- Top Bar End -->

        @section('main-content')
            Default Main Content
        @show
    </div>
@endsection