<template>
	</div>
		<div>
			<div class="container">
				<div class="row">
					<div class="col-4">
						<div class="m-3"><a href="/"><i class="fa fa-home fa-2x" aria-hidden="true">Home</i></a>
						</div>
					</div>
					<div v-if="auth">
						<div class="col-4 m-3">
							<a href="/category"><i class="fa fa-pencil fa-2x" aria-hidden="true">categories</i></a>
						</div>
						<div class="col-4 m-3">
							<a href="/currency"><i class="fa fa-pencil fa-2x" aria-hidden="true">currencies</i></a>
						</div>
					</div>	
				</div>
			</div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Price</th>
					 <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product of products" :key="product.id">
                <td>{{product.id}}</td>
                <td>{{product.title}}</td>
                <td>{{Math.round(product.price / currency.value  * 100)/100}} </td>
                <td>{{product.quantity}} </td>
            </tr>
            </tbody>
        </table>
	</div>
    </div>
</template>




<script>


    export default {
        name: "ProductsIndexComponent",
        props: ['products', 'auth', 'currency'],
        }
    
</script>

<style scoped>

</style>
