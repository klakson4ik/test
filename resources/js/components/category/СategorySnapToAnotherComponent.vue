<template>
    <div>
        <div class="col">
            <search-component
                @searchQuery = "getArrayPagination"
            />
        </div>
        <table class="table table-striped "  >
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
                <td>{{cat.title}}</td>
                <td><input type="radio" name="snap" class="ml-4 shadow"  @change = "check(cat)" :disabled="editCat.id === cat.id || editCat.parent_id === cat.id">
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
    </div>
</template>

<script>

    import tableMixin from  './table'

    export default {
        name: "CategorySnapToAnotherComponent",
        mixins : [tableMixin],
        data: () => {
            return {
                checkID: '',
                editCat : {
                    id : '',
                    parent_id : ''
                }
            }
        },
        computed: {
            categories(){
                return this.$store.getters.getCategories
            },
        },
        methods : {
            save(){

                let checked = this.$store.getters.getCheckedCat
                checked.parent_id = this.checkID
                let elemID = this.categories.findIndex(item=>item.id === checked.id)
                this.categories[elemID].parent_id = this.checkID
                this.$emit('snap')

            },
            check(cat){
                this.checkID= cat.id
            }
        },
        mounted() {
            this.$store.subscribe((mutation , getters) => {
                if(mutation.type === 'SNAP_TO_CATEGORY_STATUS' && getters.categoryModule.snapToCategoryStatus === true){
                    this.save()
                }
            })
        },
        created() {
            let cat = this.$store.getters.getCheckedCat
            this.editCat = {
                id : cat.id,
                parent_id : cat.parent_id
            }
        }
    }
</script>

<style scoped>
.scroll{
    overflow: hidden;
}
</style>
