<template>
    <div class="dropdown">
        <span>{{currentValue}}</span><button class="btn" @click="expand = !expand">v</button>
        <div v-if="expand === true">
            <div v-for="value of valueOnList">
                <div v-if="currentValue !==value">
                    <p @click="changeValue(value)">{{value}}</p>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DropdownComponent",
        data : () => {
            return {
                valueOnList : [5,10,15,20,50,100],
                currentValue : 10,
                expand : false
            }

        },
        methods : {
            changeValue(value){
                this.currentValue = value
                this.expand = false
                this.$emit('perPage', this.currentValue)
            },
        },

    }
</script>

<style scoped>

</style>
