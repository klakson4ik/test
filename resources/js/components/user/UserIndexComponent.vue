<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" @click="modalVisible = true, modalNewUserVisible = true">Добавить пользователя</button>
            </div>
            <div class="col">
                <search-component
                    @searchQuery = "getArrayPagination"
                />
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Почта</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, index) of userArray" :key="userArray.id">
                <th scope="row">{{index+1}}</th>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>
                    <i class="fa fa-wrench " aria-hidden="true" @click="edit(user)"></i>
                </td>
                <td>
                    <i class="fa fa-trash" aria-hidden="true" @click="deleteUser(user)" ></i>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <table-pagination-component
                        ref ="reRender"
                        :array = "searchArray"
                        @fillCat = "fillArray"
                    />
                </div>
            </div>
        </div>


        <div v-if="modalVisible===true && modalNewUserVisible===true">
            <template-popup-component
                title = "Новый пользователь"
            >
                <user-create-component
                    ref ="addUser"
                    @updateNewUsers = "updateNewUsers"
                />
                <template #footer>
                    <button-component
                        btnName="Закрыть"
                        @click="modalVisible = false, modalNewUserVisible = false"
                    />
                    <button-component
                        btnName="Добавить"
                        @click="saveNewUser"
                    />
                </template>
            </template-popup-component>
        </div>

        <div v-if="modalVisible===true && modalEditUserVisible === true">
            <template-popup-component
                title = "Редактирование пользовтеля"
            >
                <user-edit-component
                    ref ="editUser"
                    :editUserData = "editUserData"
                    @updateEditUsers = "updateEditUsers"
                />
                <template #footer>
                    <button-component
                        btnName="Отменить"
                        @click="modalVisible = false, modalEditUserVisible = false"
                    />
                    <button-component
                        btnName="Сохранить"
                        @click="saveEditUser"
                    />
                </template>
            </template-popup-component>
        </div>

    </div>
</template>

<script>

    import TemplatePopupComponent from "../reusedComponents/TemplatePopupComponent";
    import ButtonComponent from "../reusedComponents/ButtonComponent";
    import TablePaginationComponent from "../reusedComponents/TablePaginationComponent";
    import UserEditComponent from "./UserEditComponent";

    export default {
        name: "UserIndexComponent",
        comments : {TemplatePopupComponent, ButtonComponent, TablePaginationComponent, UserEditComponent},
        props : ['users'],
        data: () => {
            return {
                modalVisible : false,
                modalNewUserVisible : false,
                modalEditUserVisible : false,
                searchArray : [],
                userArray : [],
                editUserData : ''
            }
        },
        methods: {
            fillArray(array){
                this.userArray = array
            },

            getArrayPagination(query) {
                if (query.length > 0) {
                    let array = []
                    for (let item of this.users) {
                        let regexp = new RegExp(query.trim(), 'i');
                        if (regexp.test(item.name)) {
                            array.push(item)
                        }
                    }
                    this.searchArray = array
                }else{
                    this.searchArray = this.users
                }
            },
            edit(user){
                this.modalVisible = true
                this.modalEditUserVisible = true
                this.editUserData = user
            },

            deleteUser(user){
                let act = confirm('Точно удалить ' + user.name)
                if(act) {
                    fetch("user/" + user.id, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                    })
                    let elemID = this.users.findIndex(item=>item.id === user.id)
                    this.users.splice(elemID, 1)
                    this.searchArray = this.users
                    this.$refs['reRender'].splitArray()
                }
                else
                    return false
            },

            saveNewUser(){
                this.$refs['addUser'].addUser()
            },

            saveEditUser(){
                this.$refs['editUser'].editUser()
            },

            updateNewUsers(user){
                this.searchArray.push({
                    name : user.name,
                    email : user.email
                    }
                )
                this.$refs['reRender'].splitArray()
                this.modalVisible = false
                this.modalNewUserVisible = false
                alert('пользоветель ' + user.name + ' добавлен')
            },

            updateEditUsers(user){
                let elemID = this.searchArray.findIndex(item=>item.id === user.id)
                this.searchArray[elemID].name = user.name
                this.searchArray[elemID].email= user.email
                this.$refs['reRender'].splitArray()
                this.modalVisible = false
                this.modalEditUserVisible = false
                alert('пользоветель ' + user.name + ' изменен')
            }

        },

        created() {
            this.searchArray = this.users
        }
    }
</script>

<style scoped>

</style>
