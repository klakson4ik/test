<template>

    <div class="container">
        <div class="row" v-for="cat of addedCats" :key="addedCats.placeholder">
            <div autofocus class="col">
                <input type="text"  :placeholder="cat.placeholder" v-model="cat.text">
            </div>
            <div class="btn btn-primary" @click="add(cat)">+</div>
            <div class="btn btn-primary" @click="del()">-</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "categoryCreateComponent",
        data: () => {
            return {
                addedCats: [
                    {
                        placeholder: 'Корневой элемент',
                        text: '',
                    }
                ],
            }
        },
        computed: {
            categories() {
                return this.$store.getters.getCategories
            }
        },
        methods: {
            add(cat) {
                let is_exist = false
                for (let value of this.categories) {
                    if (value.title === cat.text.trim())
                        is_exist = true;
                }
                if (!is_exist) {
                    if (this.addedCats.length > 4)
                        return (alert("Достигнут максимум элементов"))

                    this.addedCats.text = cat.text;
                    this.addedCats.push({
                        text: '',
                        placeholder: 'Новый элемент',
                    })
                } else
                    return alert("Такая категория существует");
            },
            del() {
                if (this.addedCats.length < 2)
                    return false
                this.addedCats.pop();
            },
            saveCategory() {
                fetch("category", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        title: "New subcategory",
                        body: this.addedCats
                    })
                })
                    .then(response => (response.json()))
                    .then(response => this.$store.dispatch('LOAD_CATEGORIES', response['categories']))
                this.$store.dispatch('CREATING_SUB_CATEGORY_STATUS', false)
					 window.location.href = '/category'

            },
        },
        mounted() {
            this.$store.subscribe((mutation, getters) => {
                if (mutation.type === 'CREATING_SUB_CATEGORY_STATUS' && getters.categoryModule.creatingSubCategoryStatus === true) {
                    this.saveCategory()
                }
            })
        }
    }
</script>

<style scoped>

</style>
