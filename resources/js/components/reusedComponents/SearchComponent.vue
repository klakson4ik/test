<template>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Найти..." v-model="pattern" aria-label="" aria-describedby="basic-addon1">
        <div class="input-group-append">
            <button class="btn btn-success" type="button">Search</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchComponent",
        data: () => {
            return {
                pattern : ''
            }
        },

        watch : {
            pattern: function (val) {
                this.$emit('searchQuery', val)
            }
        }

    }
</script>

<style scoped>

</style>
