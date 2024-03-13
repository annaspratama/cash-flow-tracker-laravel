import { createApp } from "@vitejs/plugin-vue"
import profile from "./vue-component/your-profile.vue"

createApp({
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
}).mount("#app")