@extends('dashboard.main-dashboard')

@section('title')
    Change Password
@endsection

@section('main-content')
    <!-- Content -->
    <div class="row">
        <div class="col-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-12 col-sm-12">
                            <h4 class="mt-0 header-title">Change Your Password</h4>
                            <p class="text-muted font-14">You can manage your account password.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-lg-6 col-sm-12 mx-auto">
                            <form action="{{ route('dashboard.update.password') }}" method="POST" class="mb-0" id="update-password-form">
                                @csrf
                                <div class="form-group">
                                    <div>
                                        <input type="password" class="form-control" name="password_old" minlength="8" required
                                                placeholder="Old Password"/>
                                    </div>
                                    <div class="mt-4">
                                        <input type="password" id="change-password" class="form-control" name="password" minlength="8" required
                                                placeholder="New Password"/>
                                    </div>
                                    <div class="mt-4">
                                        <input type="password" class="form-control" name="password_confirmation" minlength="8" required
                                                data-parsley-equalto="#change-password"
                                                placeholder="Retype New Password"/>
                                    </div>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <div class="text-center">
                                        <button type="button" data-toggle="modal" data-target="#confirmation-modal" class="btn btn-raised btn-primary waves-effect waves-light mb-0">
                                            <i class="mdi mdi-key"></i> Update
                                        </button>
                                    </div>
                                </div>

                                <!-- Modal save confirmation -->
                                <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmation</h5>
                                            <button type="button" class="btn btn-raised btn-default mdi mdi-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p class="text-muted">Are you sure to update new password?</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-raised btn-success"><i class="fa fa-send"></i> Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal save confirmation end -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection

@section('js')
    <script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
    <script>
        $('#update-password-form').parsley();
    </script>
@endsection