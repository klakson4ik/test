<template>
    <div class="container">
						<div class="m-3"><a href="/"><i class="fa fa-home fa-2x" aria-hidden="true">Home</i></a></div>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" @click="showModal('create')">Добавить категорию</button>
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
                <th>Категория</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(cat, index) of items" :key="items.index">
                <th scope="row">{{index+1}}</th>
                <td class="d-flex justify-content-start">{{cat.title}}</td>
                <td>
                    <i class="fa fa-pencil"aria-hidden="true" @click="showModal('edit'),editItem(cat)" ></i>
                </td>
                <td v-if="canDelete.includes(cat.id)">
                    <i class="fa fa-trash" aria-hidden="true" @click="deleteCat(cat)" ></i>
                </td>
                <td v-else>
                    <i class="fa fa-ban" aria-hidden="true"></i>
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
                        @fillCat = "fillCat"
                    />
                </div>
            </div>
        </div>


        <div v-if="modalVisible===true && modal.create === true">
            <template-popup-component
                title = "Создание категории"
            >
                <category-create-component
                    @close = "closeModalCreate"
                />
                <template #footer>
                    <button-component
                        btnName="Закрыть"
                        @click="closeModalCreate"
                    />
                    <button-component
                        btnName="Создать категорию"
                        @click="saveCreateStatus"
                    />
                </template>
            </template-popup-component>
        </div>

        <div v-if="modalVisible===true && modal.edit === true">
            <template-popup-component
                title = "Редактирование категории">
                <category-edit-component
                    title="Редактирование категорий"
                    @close="closeModalEdit"
                    @saveEditCategory="saveEditCategory"
                />
                <template #footer>
                    <button-component
                        btnName="Отменить"
                        @click="closeModalEdit"
                    />
                    <button-component
                        btnName="Сохранить"
                        @click="saveEditStatus"
                    />
                </template>
            </template-popup-component>
        </div>
    </div>
</template>




<script>
    import categoryCreateComponent from "./CategoryCreateComponent";
    import TemplatePopupComponent from "../reusedComponents/TemplatePopupComponent";
    import CategoryEditComponent from "./CategoryEditComponent";
    import ButtonComponent from "../reusedComponents/ButtonComponent";

    import tableMixin from  './table'

    export default {
        name: "categoryIndexComponent",
        mixins : [tableMixin],
        props: ['categories', 'categoryNesting'],
        components: {categoryCreateComponent, TemplatePopupComponent, CategoryEditComponent, ButtonComponent },
        data: () => {
            return {
                modalVisible : false,
                editCat : [],
                canDelete : [],
                modal : {
                    'create': false,
                    'edit': false,
                    'delete' : false
                },
            }
        },
        methods: {
            editItem(cat){
                this.$store.dispatch('LOAD_CHECKED_CAT', cat)
                this.editCat.push({
                    id: cat.id,
                    parent_id: cat.parent_id
                    })

            },
            deleteCat(cat){
                let act = confirm('Точно удалить ' + cat.title)
                if(act) {
                    fetch("category/" + cat.id, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                    })
                    let elemID = this.categories.findIndex(item=>item.id === cat.id)
                    delete this.categories[elemID]
					 	  window.location.href = '/category'
                }
                else
                    return false
            },

            showModal(act){
                this.modalVisible = true
                this.modal[act] = true
            },
            closeModalCreate(){
                this.modal.create = false
                this.modalVisible = false
            },
            closeModalEdit(){
                this.modal.edit = false
                this.modalVisible = false
                let elemID = this.categories.findIndex(item=>item.id === this.editCat[0].id)
                this.categories[elemID].parent_id = this.editCat[0].parent_id
                this.$refs['reRender'].splitArray()
            },
            saveEditCategory(){
                this.modal.edit = false
                this.modalVisible = false
                this.$refs['reRender'].splitArray()
            },
            saveEditStatus(){
                this.$store.dispatch('EDITING_CATEGORY_STATUS', true)
            },
            saveCreateStatus(){
                this.$store.dispatch('CREATING_SUB_CATEGORY_STATUS', true)
            },
            compilationNesting(nest){
                for (let item in nest) {
                    if (!nest[item]['children'])
                        this.canDelete.push(nest[item]['id'])
                    else
                        this.compilationNesting(nest[item]['children'])
                }
            }

        },

        created() {
            this.$store.dispatch('LOAD_CATEGORIES', this.categories)
            this.compilationNesting(this.categoryNesting)
        }
    }
</script>

<style scoped>

</style>
