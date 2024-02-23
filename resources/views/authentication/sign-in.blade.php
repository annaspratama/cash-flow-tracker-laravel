<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Cash Flow Tracker - Sign In</title>
        <meta content="Cash Flow Tracker is a tool to help you stay on top of your finances and achieve your financial goals." name="description" />
        <meta content="Annas Pratama" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
        <link href="{{ asset('css/bootstrap-material-design.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body>


    <!-- Begin page -->
        <div class="wrapper-page">
            <div class="display-table">
                <div class="display-table-cell">
                    <diV class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <img class="main-logo" src="{{ asset('images/cash-flow-tracker-logo.png') }}" alt="Cash Flow Tracker Logo" class="img-fluid">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center pt-3">
                                            <h4 class="text-dark">Sign In</h4>
                                        </div>
                                        <div class="px-3 pb-3">
                                            <form class="form-horizontal m-t-20 mb-0" method="POST" action="{{ route('auth-action-signin') }}">
                                                @if (session()->has('errors'))
                                                    <div class="alert alert-danger mt-3 alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        {{ session()->get('errors')->first('error') }}
                                                    </div>
                                                @endif
                                                @if (session()->has('success'))
                                                    <div class="alert alert-success mt-3 alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        {{ session()->get('success') }}
                                                    </div>
                                                @endif
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" name="email" type="email" required placeholder="Email">
                                                    </div>
                                                </div>
                        
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" name="password" type="password" required placeholder="Password">
                                                    </div>
                                                </div>
                        
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="remember-me" class="custom-control-input" id="customCheck1">
                                                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="form-group text-right row m-t-20">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary btn-raised btn-block waves-effect waves-light" type="submit"><i class="mdi mdi-login"></i> Sign In</button>
                                                    </div>
                                                </div>
                        
                                                <div class="form-group m-t-10 mb-0 row">
                                                    <div class="col-sm-7 m-t-20">
                                                        <a href="{{ route('auth-forgot-password-page') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password ?</a>
                                                    </div>
                                                    <div class="col-sm-5 m-t-20">
                                                        <a href="{{ route('auth-register-page') }}" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account ?</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </diV>
                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
    </body>
</html>