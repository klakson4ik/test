<template>

    <div class="container">
        <div v-for="cat of cats" :key="cats.id">
            <div v-if="cat.status==='active'">
                <div class="row" >
                    <div class="col">
                        <p class="border  shadow border-warning p-1 mb-2">{{cat.title}}</p>
                    </div>
                </div>
                <div class="row" >
                    <div class="col">
                        <input type="text" class="p-1 mb-2 shadow form-control border-warning" placeholder="Новое имя" v-model="editName">
                    </div>
                </div>
                <div class="row" >
                    <div class="col">
                        <button type="button" class=" btn btn-primary mt-4" @click="changeName">Изменить имя</button>
                        <button type="button" class=" btn btn-primary mt-4" @click="modalVisible=true">Привязать к другой категории</button>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="row" >
                    <div class="col">
                        <p class="border  shadow border-primary p-1 mb-1">{{cat.title}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center" >
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 d-flex justify-content-center">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="modalVisible===true">
            <category-template-popup-component
                title="Привязка категории"
            >
                <category-snap-to-another-component
                    @snap="snap"

                />
                <template #footer>
                    <button-component
                        btnName="Отменить"
                        @click="closeModal"
                    />
                    <button-component
                        btnName="Привязать"
                        @click="save"
                    />
                </template>
            </category-template-popup-component>
        </div>
    </div>
</template>

<script>

    import CategoryTemplatePopupComponent from "../reusedComponents/TemplatePopupComponent";
    import CategorySnapToAnotherComponent from "./СategorySnapToAnotherComponent";


    export default {
        name: "CategoryEditComponent",
        components: {CategoryTemplatePopupComponent , CategorySnapToAnotherComponent},
        data: () => {
            return {
                modalVisible : false,
                editName : '',
                cats : [
                    {
                        title: "",
                        status: "",
                        id : ""
                    }
                ],
            }
        },

        computed: {
            categories(){
                return this.$store.getters.getCategories
            },
            item(){
                return this.$store.getters.getCheckedCat
            }

        },
        created() {
            this.editList()
        },
        methods : {
            fillParentCats(id){
                if(id != null) {
                    let elemId = this.categories.findIndex(item=>item.id === id)
                    this.cats.unshift({
                        title: this.categories[elemId].title,
                        id: this.categories[elemId].id,
                    })
                    this.fillParentCats(this.categories[elemId].parent_id);
                }else{
                    return false
                }
            },
            closeModal(){
                this.modalVisible = false
            },
            save(){
                this.$store.dispatch('SNAP_TO_CATEGORY_STATUS', true)
            },
            editList(){
                this.cats[0].title = this.item.title
                this.cats[0].status = 'active'
                this.fillParentCats(this.item.parent_id)
            },
            snap(){
                this.closeModal()
                this.cats  = [
                    {
                        title: "",
                        status: "",
                        id : ""
                    }
                ]
                this.editList()
            },
            changeName(){
                this.item.title = this.editName
                this.cats  = [
                    {
                        title: "",
                        status: "",
                        id : ""
                    }
                ]
                this.editList()


            },
            saveCategory(){

                let elemId = this.categories.findIndex(item=>item.id === this.item.id)
                this.categories[elemId].title = this.item.title
                fetch("category/" + this.item.id, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-CSRF-TOKEN" :  document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        title: "Edit category ",
                        body: this.item
                    })
                })
                this.$emit('saveEditCategory')
            }

        },
        mounted() {
            this.$store.subscribe((mutation , getters) => {
                if(mutation.type === 'EDITING_CATEGORY_STATUS' && getters.categoryModule.editingCategoryStatus === true){
                    this.saveCategory()
                }
            })
        }
    }
</script>

<style scoped>

</style>
