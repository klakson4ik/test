<template>
    <div class="container">
        <form>
            <div class="form-group row">
                <label for="name" class="col-6 col-form-label col-form-label-lg">Name</label>
                <div class="col-6 mb-3">
                    <input type="text" class="form-control form-control-lg" id="name" v-model="login">
                </div>
                <label for="email" class="col-6 col-form-label col-form-label-lg">E-mail Address</label>
                <div class="col-6 mb-3">
                    <input type="email" class="form-control form-control-lg" id="email" placeholder="you@example.com" v-model="email">
                </div>
                <label for="password" class="col-6 col-form-label col-form-label-lg">Password</label>
                <div class="col-6 mb-3">
                    <input type="password" class="form-control form-control-lg" id="password" v-model="password">
                </div>
                <label for="confirm-password" class="col-6 col-form-label col-form-label-lg">Confirm password</label>
                <div class="col-6 mb-1">
                    <input type="password" class="form-control form-control-lg" id="confirm-password" v-model="confirmPassword">
                </div>
                <div class=" col-6 d-flex justify-content-center"  v-for="err of error.error" :key="error.id">
                    <p id="confirm-password-text" class="font-italic text-danger" >
                        {{err}}
                    </p>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "UserCreateComponent",
        data() {
            return {
                login: '',
                email: '',
                password: '',
                confirmPassword: '',
                error : ''
            }
        },
        methods: {
            addUser() {
                let user = []
                user = {
                    name : this.login,
                    email : this.email,
                    password : this.password,
                    password_confirmation : this.confirmPassword
                }
                this.fetchUser(user)
            },
            fetchUser(user){
                fetch("user", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        title: "New user",
                        body: user
                    })
                })
                    .then(response => (response.json()))
                    .then(response =>  this.error = response)
                    .then((response) => {
                            if (typeof response.success !== "undefined") {
                                this.$emit('updateNewUsers', user)
                            }
                        }
                    )

            }
        },

    }
</script>

<style scoped>
    #confirm-password-text{
        font-size: 0.8rem;
    }
</style>
