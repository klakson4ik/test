<template>
    <button type="button" @click="$emit('click')">{{btnName}}</button>
</template>

<script>
    export default {
        name: "ButtonComponent",
        props: {
            btnName: {
                type: String,
                default: 'Ок'
            }
        }
    }


</script>

<style scoped>

</style>
