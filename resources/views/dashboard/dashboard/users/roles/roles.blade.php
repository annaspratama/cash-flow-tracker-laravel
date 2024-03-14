@extends('dashboard.main-dashboard')

@section('title')
    Roles
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
                            <div class="col-6">
                                <h4 class="mt-0 header-title">Roles Data Web</h4>
                                <p class="text-muted font-14">You can manage roles by read, create, update, or delete.</p>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" @click="operationModeToCreate" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-update-role-modal"><i class="mdi mdi-content-save"></i> Create New</button>
                            </div>
                        </div>
                        <div class="table-responsive">        
                            <table id="datatable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Guard Name</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(value, key) in roles" :key="value.id">
                                        <td>[[ value.name ]]</td>
                                        <td width="20%">[[ value.guard_name ]]</td>
                                        <td width="25%">
                                            @can('role-create', 'web')
                                                <a type="button" :href="'roles/'+ value.id +'/permissions'" class="btn btn-sm btn-outline-success"><i class="mdi mdi-account-key"></i> Permissions</a>
                                            @endcan
                                            @can('role-update', 'web')
                                                <button type="button" @click="showModal('create-update', [[ value.id ]])" class="btn btn-sm btn-outline-primary ml-2"><i class="mdi mdi-tooltip-edit"></i> Update</button>
                                            @endcan
                                            @can('role-delete', 'web')
                                                <button type="button" @click="showModal('delete', [[ value.id ]])" class="btn btn-sm btn-outline-danger ml-2"><i class="mdi mdi-delete"></i> Delete</button>
                                            @endcan
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <!-- Modal create & update -->
        <div class="modal fade" id="create-update-role-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form @submit.prevent="createOrUpdate([[ operation_mode ]])" id="form-add-update-roles">
                        <div class="modal-header">
                            <h5 class="modal-title">Create or Update New Role</h5>
                        <button type="button" ref="closeCreateUpdate" class="btn btn-raised btn-default mdi mdi-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" class="bmd-label-floating">Name</label>
                                        <input type="text" class="form-control" v-model="role.name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="guard-name" class="bmd-label-floating">Choose Guard Name</label>
                                        <select class="form-control" id="exampleSelect1" v-model="role.guard_name" required>
                                            <option value="web">Web</option>
                                            <option value="api" disabled>API</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-raised btn-success"><i class="fa fa-send"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal create & update end -->

        <!-- Modal delete -->
        <div class="modal fade" id="delete-role-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Exist Role</h5>
                    <button type="button" ref="closeDelete" class="btn btn-raised btn-default mdi mdi-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-muted">Are you sure delete this role?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-raised btn-danger" @click="deleteRole([[ active_id ]])"><i class="mdi mdi-delete"></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal delete end -->
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
                    operation_mode: "createRole",
                    active_id: null,
                    role: {
                        name: null,
                        guard_name: null
                    },
                    roles: [],
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
                showModal: function(modal="create-update", id) {
                    this.active_id = id

                    if (modal == "create-update") {
                        this.operation_mode = "updateRole"
                        this.getRole(this.active_id)
                        $("#create-update-role-modal").modal("show")
                    } else $("#delete-role-modal").modal("show")
                },
                operationModeToCreate: function() {
                    this.operation_mode = "createRole"
                    this.role = {}
                },
                createOrUpdate: function(operationMode) {
                    if (operationMode == "createRole") this.createRole()
                    else this.updateRole(this.active_id)
                },
                getRoles: function() {
                    axios.get("{{ url('api/v1/roles') }}")
                    .then(res => {
                        this.roles = res.data.data;
                    })
                    .catch(err => {
                        console.error(err);
                    });
                },
                createRole: function() {
                    axios.post("{{ url('api/v1/role') }}", this.role)
                    .then(res => {
                        this.roles = res.data.data
                        this.role = {}
                        this.$refs.closeCreateUpdate.click()
                        this.showNotification("success", "Your data saved.")
                    })
                    .catch(err => {
                        var errorMsg = err.response.data.message
                        console.error(errorMsg);
                        this.showNotification("error", errorMsg)
                    });
                },
                updateRole: function(id) {
                    axios.put(`{{ url('api/v1/${id}/role') }}`, this.role)
                    .then(res => {
                        this.roles = res.data.data
                        this.role = {}
                        this.$refs.closeCreateUpdate.click()
                        this.showNotification("success", "Your data saved.")
                    })
                    .catch(err => {
                        var errorMsg = err.response.data.message
                        console.error(errorMsg);
                        this.showNotification("error", errorMsg)
                    });
                },
                getRole: function(id) {
                    axios.get(`{{ url('api/v1/${id}/role') }}`)
                    .then(res => {
                        this.role = res.data.data
                    })
                    .catch(err => {
                        var errorMsg = err.response.data.message
                        console.error(errorMsg);
                        this.showNotification("error", errorMsg)
                    })
                },
                deleteRole: function(id) {
                    axios.delete(`{{ url('api/v1/${id}/role') }}`)
                    .then(res => {
                        this.roles = res.data.data
                        this.$refs.closeDelete.click()
                        this.showNotification("success", "Your data deleted.")
                    })
                    .catch(err => {
                        var errorMsg = err.response.data.message
                        console.error(errorMsg);
                        this.showNotification("error", errorMsg)
                    })
                }
            },
            created() {
                this.getRoles()
            },
            watch: {}
        })

        app.use(VueToast.ToastPlugin)
        app.mount('#app')
    </script>
@endsection