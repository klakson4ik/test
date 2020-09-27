<template>
    <div >
        <ul v-for="child of array" @mouseover="child.is_visible = true" @mouseleave="child.is_visible = false" >
            <li class="bg-primary border-bottom rounded-lg">
                <a class="nav-link text-center text-light" :href="uri + '/' + child.item.alias">{{child.item.title}}</a>
                <menu-tree-component
                    v-if="child.is_visible === true"
                    :categoryNested="child.item.children"
						  :uri = "uri + '/' + child.item.alias"/>

            </li>
        </ul>
    </div>
</template>

<script>
    import menuMixin from "./menuMixin";

    export default {
        name: "MenuTreeComponent",
        mixins : [menuMixin]
    }
</script>

<style scoped>
	ul{
		margin-left: 0px;
}
	ul li{
		list-style: none;
	}
</style>
