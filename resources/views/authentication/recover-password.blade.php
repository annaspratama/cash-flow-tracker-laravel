<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Cash Flow Tracker - Recover Password</title>
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
                                            <h4 class="text-dark">Recover Your Password</h4>
                                        </div>
                                        <div class="px-3 pb-3">
                                            <form class="form-horizontal m-t-20 mb-0" method="POST" action="{{ route('password.update') }}">
                                                @if (session()->has('errors'))
                                                    <div class="alert alert-danger mt-3 alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        {{ session()->get('errors')->first('email') }}
                                                        {{ session()->get('errors')->first('password') }}
                                                    </div>
                                                @endif
                                                @if (session()->has('status'))
                                                    <div class="alert alert-success mt-3 alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        {{ session()->get('status') }}
                                                    </div>
                                                @endif

                                                <div class="alert alert-info mt-3 alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    Enter your <b>new password</b>.
                                                </div>

                                                @csrf

                                                <input type="hidden" name="token" value="{{ $token }}" required>

                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <input class="form-control" type="email" name="email" required placeholder="Email">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <input class="form-control" type="password" name="password" required placeholder="New password">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <input class="form-control" type="password" name="password_confirmation" required placeholder="Retype new password">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group text-center row m-t-20 mb-0">
                                                    <div class="col-12">
                                                        <button class="btn btn-raised btn-primary btn-block waves-effect waves-light" type="submit">Recover Password</button>
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