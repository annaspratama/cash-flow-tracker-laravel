@extends('dashboard.main')

@section('content')
    <div class="content">
        <!-- Top Bar Start -->
        <div class="topbar">
            @include('dashboard.parts.header')
        </div>
        <!-- Top Bar End -->

        <!-- Page content Wrapper -->
        <div class="page-content-wrapper dashborad-v">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard-dashboard-page') }}">Home</a></li>
                                    @if ($__env->hasSection('sub-title'))
                                        <li class="breadcrumb-item"><a href="@yield('route-title')">@yield('title')</a></li>
                                        <li class="breadcrumb-item active">@yield('sub-title')</li>
                                    @else
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    @endif
                                </ol>
                            </div>
                            <h4 class="page-title">
                                @if ($__env->hasSection('sub-title'))
                                    @yield('sub-title')
                                @else
                                    @yield('title')
                                @endif
                            </h4>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <!-- Error Flash Message -->
                @if (session()->has('error'))
                    <div class="alert alert-danger mt-3 alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('error') }}
                    </div>
                @endif

                <!-- Vue Error Flash Message -->
                {{-- <div class="alert alert-danger mt-3 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Lorem ipsum dolor sit amet.
                </div> --}}

                <!-- Success Flash Message -->
                @if (session()->has('success'))
                    <div class="alert alert-success mt-3 alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success') }}
                    </div>
                @endif

                <!-- Vue Success Flash Message -->
                {{-- <div class="alert alert-success mt-3 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Lorem ipsum dolor sit amet.
                </div> --}}

                <!-- end page title end breadcrumb -->

                @section('main-content')
                    Default Main Content
                @show

            </div>
        </div>
        <!-- container -->
    </div>
    <!-- Page content Wrapper -->
@endsection