<template>
    <div class="container-fluid menu ">
        <div class="row">
            <div class="d-flex align-items-start">
                <div class="col bg-primary rounded-lg border-bottom cat-l" v-for="each of array" @mouseover="each.is_visible = true" @mouseleave="each.is_visible = false">
                    <a class="nav-link text-center text-light " :href="'/products/' + each.item.alias" >{{each.item.title}}</a>
                    <first-level-menu-component
                    v-if="each.is_visible === true"
                    :categoryNested="each.item.children"
						  :uri = "'/products/' + each.item.alias"		
						  />
                </div>
            </div>
        </div>
    </div>
</template>


<script>

    export default {
        name: "headerComponent",
        props : ['categoryNested'],
        data() {
            return {
                array : [],
            }
        },

        created() {
            for (let item in this.categoryNested){
                if (this.categoryNested[item]['parent_id'] == null)
                    this.array.push({
                        item :this.categoryNested[item],
                        is_visible : false
                    })
            }
        }
    }

</script>

<style scoped>
    .menu{
        z-index: 2;
        position: absolute;
    }

	.cat-l{
	opacity: 0.95;
}
</style>
