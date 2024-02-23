<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Cash Flow Tracker - Register</title>
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
                            <div class="col-md-6">
                                <img class="main-logo" src="{{ asset('images/cash-flow-tracker-logo.png') }}" alt="Cash Flow Tracker Logo" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center pt-3">
                                            <h4 class="text-dark">Register</h4>
                                        </div>
                                        <div class="px-3 pb-3">
                                            <form class="form-horizontal m-t-20 mb-0" method="POST" action="{{ route('auth-action-register') }}">
                                                @if (session()->has('errors'))
                                                    <div class="alert alert-danger mt-3 alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-sm-12">
                                                                {{ session()->get('errors')->first('email') }}
                                                                {{ session()->get('errors')->first('first_name') }}
                                                                {{ session()->get('errors')->first('password') }}
                                                                {{ session()->get('errors')->first('g-recaptcha-response') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="email" name="email" required placeholder="Email">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="text" name="first_name" required placeholder="First Name">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="text" name="last_name" placeholder="Last Name">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="password" name="password" required placeholder="Password">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        {!! NoCaptcha::display() !!}
                                                    </div>
                                                </div>
                    
                                                <div class="form-group text-center row m-t-20">
                                                    <div class="col-12">
                                                        <button class="btn btn-raised btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
                                                    </div>
                                                </div>
                    
                                                <div class="form-group m-t-10 mb-0 row">
                                                    <div class="col-12 m-t-20 text-center">
                                                        <a href="{{ route('auth-signin-page') }}" class="text-muted">Already have account?</a>
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
        <!-- Google Recaptcha -->
        {!! NoCaptcha::renderJs() !!}
    </body>
</html>