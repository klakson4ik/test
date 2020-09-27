<template>

    <div class="container">
						<div class="m-3"><a href="/"><i class="fa fa-home fa-2x" aria-hidden="true">Home</i></a></div>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" @click="modalVisible = true, newCurrency()">Добавить валюту</button>
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
                <th>Валюта</th>
                <th>Код</th>
                <th>Текущий курс</th>
                <th>Предыдущий курс</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="(currency, index) of currencyArray" :key="currencyArray.id">
                <th scope="row">{{index+1}}</th>
                <td>{{currency.name}}</td>
                <td>{{currency.charCode}}</td>
                <td>{{currency.value}}</td>
                <td>{{currency.previous}}</td>
                <td>
                    <i class="fa fa-refresh" aria-hidden="true" @click="refresh(currency)"></i>
                </td>
                <td>
                    <i class="fa fa-trash" aria-hidden="true" @click="deleteCat(currency)" ></i>
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


        <div v-if="modalVisible===true">
            <template-popup-component
                title = "Новая валюта"
            >
                <currency-create-component
                    title="Создание валюты"
                    ref ="addCurrency"
                    :currencyAll = "currencyAll"
                    :currentCurrency = "currencies"
                />
                <template #footer>
                    <button-component
                        btnName="Закрыть"
                        @click="modalVisible = false"
                    />
                    <button-component
                        btnName="Добавить"
                        @click="saveCreateStatus"
                    />
                </template>
            </template-popup-component>
        </div>

    </div>
</template>

<script>

    import TemplatePopupComponent from "../reusedComponents/TemplatePopupComponent";
    import ButtonComponent from "../reusedComponents/ButtonComponent";
    import CurrencyCreateComponent from "./CurrencyCreateComponent";
    import TablePaginationComponent from "../reusedComponents/TablePaginationComponent";

    export default {
        name: "CurrencyIndexComponent",
        components: {TemplatePopupComponent, ButtonComponent, CurrencyCreateComponent, TablePaginationComponent },
        props : ['currencies'],
        data: () => {
            return {
                modalVisible : false,
                searchArray : [],
                currencyArray : [],
                currencyAll : [],
            }
        },
        methods: {
            fillArray(array){
                this.currencyArray = array
            },

            getArrayPagination(query) {
                if (query.length > 0) {
                    let array = []
                    for (let item of this.currencies) {
                        let regexp = new RegExp(query.trim(), 'i');
                        if (regexp.test(item.name)) {
                            array.push(item)
                        }
                    }
                    this.searchArray = array
                }else{
                    this.searchArray = this.currencies
                }
            },

            refresh(curr){
                fetch("currency/" + curr.id, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-CSRF-TOKEN" :  document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        title: "Edit category ",
                        body: curr.charCode
                    })
                })
                .then(response => (response.json()))
                .then(response => {
                    let elemID = this.currencies.findIndex(item=>item.charCode === response.CharCode)
                    this.currencies[elemID].value = Math.round(response.Value * 100) /100
                    this.currencies[elemID].previous = Math.round (response.Previous * 100) /100
                    this.searchArray = this.currencies
                    this.$refs['reRender'].splitArray()

                })
            },

            deleteCat(curr){
                let act = confirm('Точно удалить ' + curr.name)
                if(act) {
                    fetch("currency/" + curr.id, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                    })
                    let elemID = this.currencies.findIndex(item=>item.id === curr.id)
                    this.currencies.splice(elemID, 1)
                    this.searchArray = this.currencies
                    this.$refs['reRender'].splitArray()
                }
                else
                    return false
            },

            newCurrency(){
                fetch('currency/create')
                    .then(response => (response.json()))
                    .then(response => this.currencyAll = response.currencyAll)
            },

            saveCreateStatus(){
                this.$refs['addCurrency'].add()
            },
        },

        created() {
            this.searchArray = this.currencies
        }
    }
</script>

<style scoped>

</style>
