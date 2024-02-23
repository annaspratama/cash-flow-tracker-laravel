@extends('dashboard.main-dashboard')

@section('title')
    Needs Verification
@endsection

@section('main-content')
    <div class="page-content-wrapper dashborad-v">
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-12 col-sm-12">
                    <div class="card text-center">
                        <div class="card-header">
                            @if (session()->has('success'))
                                <div class="alert alert-success mt-3 alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <h4>Verify Your Account</h4>
                        </div>
                        <div class="card-body">
                            Before proceeding, please check your email for a verification link. If you did not receive the email,
                            click the button resend verification below.
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('verification.resend') }}" type="button" class="btn btn-primary"><i class="mdi mdi-send"></i> Resend Verification</a>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
@endsection