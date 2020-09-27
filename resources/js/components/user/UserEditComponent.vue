<template>
    <div class="container">
        <form>
            <div class="form-group row">
                <label for="name" class="col-6 col-form-label col-form-label-lg">Name</label>
                <div class="col-6 mb-3">
                    <p class="border  shadow border-warning p-1 mb-2">{{editUserData.name}}</p>
                </div>
                <div class="col-6 mb-3">
                    <input type="text" class="form-control form-control-lg" id="name" v-model="login">
                </div>
                <label for="email" class="col-6 col-form-label col-form-label-lg">Email</label>
                <div class="col-12 mb-3">
                    <p class="border  shadow border-warning p-1 mb-2">{{editUserData.email}}</p>
                </div>
                <div class="col-6 mb-3">
                    <input type="email" class="form-control form-control-lg" id="email"  v-model="email">
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
        name: "UserEditComponent",
        props : ['editUserData'],
        data() {
            return {
                login : '',
                email: '',
                error : ''
            }
        },
        methods: {
            editUser() {
                let user = []
                user = {
                    id : this.editUserData.id,
                    name : this.login,
                    email : this.email,
                }
                this.fetchUser(user)
            },
            fetchUser(user){
                fetch("user/" + this.editUserData.id, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        title: "Edit user",
                        body: user
                    })
                })
                    .then(response => (response.json()))
                    .then(response =>  this.error = response)
                    .then((response) => {
                            if (typeof response.success !== "undefined") {
                                this.$emit('updateEditUsers', user)
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
