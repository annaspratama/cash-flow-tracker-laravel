@extends('dashboard.main-dashboard')

@section('title')
    Users
@endsection

@section('css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/bootstrap-table.min.css" rel="stylesheet"> --}}
    <!-- Bootstrap Table -->
    <link href="{{ asset('css/bootstrap-table.min.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <!-- Content -->
    <div id="app">
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-12 col-sm-12">
                                <h4 class="mt-0 header-title">Users Data</h4>
                                <p class="text-muted font-14">You can users by create, read, update or delete.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12 col-sm-12">
                                <table
                                    id="table"
                                    data-toggle="table"
                                    data-url="{{ route('api-users-table') }}"
                                    data-search="true"
                                    data-height="670"
                                    data-side-pagination="server"
                                    data-id-field="id"
                                    data-page-list="[10, 25, 50, 100, all]"
                                    data-pagination="true">
                                    <thead>
                                        <tr class="text-center">
                                            <th data-field="num">Num</th>
                                            <th data-field="id" data-sortable="true">ID</th>
                                            <th data-field="fullname" data-sortable="true">Fullname</th>
                                            <th data-field="email" data-sortable="true">Email</th>
                                            <th data-field="phone" data-sortable="true">Phone</th>
                                            <th data-field="is_signed_in" data-sortable="true">Signed In</th>
                                            <th data-field="verified" data-sortable="true">Verified At</th>
                                            <th
                                                @can('user-delete', 'web')
                                                    data-formatter="operateFormatter"
                                                @endcan
                                                >Operation</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->

    <!-- Modal delete -->
    <div class="modal fade" id="delete-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('dashboard-delete-user') }}" method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Exist User</h5>
                    <button type="button" class="btn btn-raised btn-default mdi mdi-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-muted">Are you sure delete this user?</p>
                                <input type="hidden" name="id" id="user-id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-raised btn-danger"><i class="mdi mdi-delete"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal delete end -->
@endsection

@section('js')
    <!-- Bootstrap Table -->
    <script src="{{ asset('js/bootstrap-table.min.js') }}"></script>
    <!-- Axios JS -->
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>

        function operateFormatter(value, row, index) {
            return [
                '<button type="button" data-toggle="modal" data-target="#delete-user-modal" onclick="userSelected('+ row.id +')" class="btn btn-sm btn-outline-danger btn-delete-user"><i class="mdi mdi-delete"></i> Delete</button>',
            ].join('')
        }

        function userSelected(id) {
            $('#user-id').val(id);
        }
    </script>
@endsection