@extends('dashboard.main-dashboard')

@section('title')
    Your Profile
@endsection

@section('css')
    <link href="{{ asset('plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
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
                                <h4 class="mt-0 header-title">Your Profile</h4>
                                <p class="text-muted font-14">You can update your account details.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-lg-6 col-sm-12 mx-auto">
                                <form @submit.prevent="saveImage" class="mb-3" id="upload-profile-image-form">
                                    @csrf
                                    <div class="form-group">
                                        @if ($user->profile_image)
                                            <img class="rounded-circle img-fluid mx-auto d-block" alt="200x200" src="{{ url($user->profile_image) }}" alt="Profile Image" height="200" width="200" data-holder-rendered="true">
                                        @else
                                            <img class="rounded-circle img-fluid mx-auto d-block" alt="200x200" src="{{ asset('images/small/circle.jpg') }}" data-holder-rendered="true">
                                        @endif
                                    </div>
                                    <div class="col-6 col-lg-6 col-md-6 col-sm-12 mx-auto">
                                        <div class="form-group">
                                            <input type="file" 
                                            @change="handleUploadImage"
                                            {{-- class="dropify"  --}}
                                            data-height="100" required />
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-sm btn-primary" :disabled="is_loading"><i class="mdi mdi-message-image"></i>
                                            <span v-if="is_loading"> Saving...</span>
                                            <span v-else> Save Image</span>
                                        </button>
                                    </div>
                                </form>
                                <form @submit.prevent="saveAccount" class="mb-0 p-3 bg-light" id="your-profile-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="firstname" class="bmd-label-floating font-14">Fist Name</label>
                                        <input type="text" class="form-control" v-model="user.first_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="bmd-label-floating font-14">Last Name</label>
                                        <input type="text" class="form-control" v-model="user.last_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="bmd-label-floating font-14">Phone</label>
                                        <input type="text" class="form-control" v-model="user.phone" 
                                            {{-- data-mask="9999-9999-9999" --}}
                                        >
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" :disabled="is_loading"><i class="fa fa-send"></i> 
                                            <span v-if="is_loading"> Saving...</span>
                                            <span v-else> Save</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection

@section('js')
    <script src="{{ asset('plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('pages/upload-init.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
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
                    is_loading: false,
                    user: {
                        profile_image: null,
                        first_name: "{{ $user->first_name }}",
                        last_name: "{{ $user->last_name }}",
                        phone: "{{ $user->phone }}"
                    }
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
                handleUploadImage: function(e) {
                    this.user.profile_image = e.target.files[0]
                },
                saveImage: async function() {
                    this.is_loading = true

                    if (this.user.profile_image) {

                        let formData = new FormData()
                        
                        formData.append('profile_image', this.user.profile_image)

                        try {
                            const response = await axios.post(`{{ route('api-upload-profile-image') }}`, formData,  {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            this.permissions = response.data.data

                            this.showNotification("success", "Your profile image updated.")

                            setTimeout(() => {
                                location.reload()
                            }, 3000)
                        } catch (err) {
                            const errorMsg = err.response.data.errors.profile_image[0]
                            console.error(errorMsg);
                            this.showNotification("error", errorMsg)
                        }
                    } else this.showNotification("error", "Please select an image.")

                    this.is_loading = false
                },
                saveAccount: async function() {
                    this.is_loading = true

                    try {
                        const response = await axios.post(`{{ route('api-profile-update') }}`, this.user)

                        if (response.data.data) this.user = response.data.data;

                        this.showNotification("success", "Your data saved.")
                    } catch (err) {
                        const errorMsg = err.response.data.message
                        console.error(errorMsg);
                        this.showNotification("error", errorMsg)
                    }

                    this.is_loading = false
                }
            }
        });

        app.use(VueToast.ToastPlugin)
        app.mount('#app')
    </script>
@endsection