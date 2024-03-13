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
                                            <th data-field="id">ID</th>
                                            <th data-field="fullname">Fullname</th>
                                            <th data-field="email">Email</th>
                                            <th data-field="phone">Phone</th>
                                            <th data-field="is_signed_in">Signed In</th>
                                            <th data-field="verified">Verified At</th>
                                            <th data-formatter="operateFormatter">Operation</th>
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
@endsection

@section('js')
    <!-- Bootstrap Table -->
    <script src="{{ asset('js/bootstrap-table.min.js') }}"></script>
    <!-- Vue JS -->
    {{-- <script src="{{ asset('js/vue-3.4.20.js') }}"></script> --}}
    <script>
        function operateFormatter(value, row, index) {
            return [
            // '<div class="left">',
            // '<a href="https://github.com/wenzhixin/' + value + '" target="_blank">' + value + '</a>',
            // '</div>',
            '<div class="right">',
            '<a class="like" href="javascript:void(0)" title="Like">',
            '<i class="fa fa-heart"></i>',
            '</a>  ',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash"></i>',
            '</a>',
            '</div>'
            ].join('')
        }
    </script>
@endsection