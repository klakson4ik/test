<template>
    <div>
        <select v-model="changeCurr" name="currency">
            <option v-for="curr of currenciesData" :value="curr.charCode">{{curr.charCode}}</option>
        </select>
    </div>
</template>

<script>
    export default {
        name: "CurrencySelectComponent",
        props : ['currenciesData','currencyCookie'],
        data() {
            return {
                changeCurr : this.currencyCookie
            }
        },
        watch : {
            changeCurr : function(){
					let search = document.location.search;
					let path = document.location.pathname
					fetch('currencyWidget?curr=' + this.changeCurr)
					if(search.trim() !== '')
					{
						window.location = path + search + '&curr=' + this.changeCurr
					}
					else
					{
						window.location = path + '?curr=' + this.changeCurr
					}
            },
        }

    }
</script>

<style scoped>

</style>
