@extends('dashboard.main-dashboard')

@section('title')
    Roles
@endsection
@section('route-title')
    {{ route('dashboard-roles-page') }}
@endsection

@section('sub-title')
    Permissions
@endsection

@section('css')
    <!-- Toast Notification CSS -->
    <link href="{{ asset('css/theme-bootstrap.min.css') }}" rel="stylesheet">
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
                                <h4 class="mt-0 header-title">Permissions Data Web</h4>
                                <p class="text-muted font-14">You can manage permissions by update.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12 col-sm-12">
                                <div class="general-label">
                                    <form @submit.prevent="updatePermissions({{ $role_id }})" class="mb-2" id="update-permissions">
                                        <div v-for="(value, key) in permissions" :key="key" class="form-check form-check-inline">
                                            <input type="hidden" v-model="value.id" readonly>
                                            <input class="form-check-input" type="checkbox" v-model=value.checked>
                                            <label class="form-check-label">[[ value.label ]]</label>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-raised btn-primary mb-0" data-toggle="modal" data-target="#confirmation-modal"><i class="mdi mdi-content-save"></i> Submit</button>
                                        </div>

                                        <!-- Modal save confirmation -->
                                        <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmation</h5>
                                                    <button type="button" ref="closeConfirmationModal" class="btn btn-raised btn-default mdi mdi-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <p class="text-muted">Are you sure save the new permissions?</p>
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
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    <!-- Content end -->
@endsection

@section('js')
    <!-- Vue JS -->
    <script src="{{ asset('js/vue-3.4.20.js') }}"></script>
    <!-- Axios JS -->
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <!-- Toast Notification JS -->
    <script src="{{ asset('js/toast.min.js') }}"></script>
    <!-- Custom Vue JS -->
    <script>
        const app = Vue.createApp({
            delimiters: ['[[', ']]'],
            data() {
                return {
                    permissions: []
                }
            },
            methods: {
                showNotification: function(type="error", msg="Lorem ipsum dolor sit amet.") {
                    this.$toast.open({
                        message: msg,
                        type: type,
                        duration: 1000 * 10, // second
                        dismissible: true,
                        position: "top"
                    })
                },
                getPermissions: async function(roleId) {
                    try {
                        const response = await axios.get(`{{ url('api/v1/roles/${roleId}/permissions') }}`)
                        this.permissions = response.data.data
                    } catch (err) {
                        const errorMsg = err.response.data.message
                        console.error(errorMsg);
                        this.showNotification("error", errorMsg)
                    }
                },
                updatePermissions: async function(roleId) {
                    try {
                        const response = await axios.put(`{{ url('api/v1/roles/${roleId}/permissions') }}`, this.permissions)
                        this.permissions = response.data.data
                        this.$refs.closeConfirmationModal.click()
                        this.showNotification("success", "Your data saved.")
                    } catch (err) {
                        const errorMsg = err.response.data.message
                        console.error(errorMsg);
                        this.showNotification("error", errorMsg)
                    }
                }
            },
            created() {
                this.getPermissions({{ $role_id }})
            }
        })

        app.use(VueToast.ToastPlugin)
        app.mount('#app')
    </script>
@endsection