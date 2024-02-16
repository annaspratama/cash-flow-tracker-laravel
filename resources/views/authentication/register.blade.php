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
                                            <form class="form-horizontal m-t-20 mb-0" action="index.html">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="email" required="" placeholder="Email">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="text" required="" placeholder="Username">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="password" required="" placeholder="Password">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                            <label class="custom-control-label font-weight-normal" for="customCheck1">I accept <a href="#" class="text-muted">Terms and Conditions</a></label>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="form-group text-center row m-t-20">
                                                    <div class="col-12">
                                                        <button class="btn btn-raised btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
                                                    </div>
                                                </div>
                    
                                                <div class="form-group m-t-10 mb-0 row">
                                                    <div class="col-12 m-t-20 text-center">
                                                        <a href="{{ route('auth-sign-in') }}" class="text-muted">Already have account?</a>
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