
<template>

    <nav>
        <ul>
            <li v-if="paginationData['currentPage'] > 1">
                <a href="?page=1">First</a>
            </li>
            <li v-if="paginationData['currentPage'] > 1">
                <a :href="`?page=${paginationData['currentPage']-1}`"><</a>
            </li>
				<li v-for="n in arrayPage">
					<span v-if="n === paginationData['currentPage']">{{n}}</span>
					<a v-else :href="`?page=${n}`">{{n}}</a>
				</li>
				<li v-if="paginationData['countPage'] !== paginationData['currentPage']">
                <a :href="`?page=${paginationData['currentPage']+1}`">></a>
            </li>
            <li v-if="paginationData['countPage'] !== paginationData['currentPage']">
                <a :href="`?page=${paginationData['countPage']}`">Last</a>
            </li>
        </ul>
    </nav>

</template>


<script>

    import DropdownComponent from "./DropdownComponent";

    export default {
        name: "PaginationMainComponent",
        component : {DropdownComponent},
        props : ['paginationData'],
        data : () => {
            return {
					arrayPage : []
            }

        },
        methods : {
				numberStartPage(){
					let countPage = this.paginationData['countShowPage'];
					let currentPage = this.paginationData['currentPage'];
					let floorCount = Math.floor(countPage / 2);
					let ceilCount = countPage - floorCount;
					let startPage = 1;
					if((currentPage - floorCount) < 2){
						startPage = 1;
					} 
					else if ((currentPage + ceilCount) >= (this.paginationData['countPage'])){
						startPage = this.paginationData['countPage'] - countPage + 1 ;					
					}
					else{
						startPage = currentPage - floorCount;
					}
					for (let i = startPage; i < (countPage + startPage) ; ++i){
						this.arrayPage.push(i);	
					}	
				},
            nextPage(){
            },
            previousPage(){
            },
            lastPage(){
            },
            firstPage(){
            },
        },
        created(){
				this.numberStartPage();
        }
    }

</script>

<style scoped>
	nav{
		text-align: center;
	}

	ul{
		display: flex;			
		justify-content: center;
		list-style-type: none;
		flex-wrap: wrap;
	}
	
	li{
		margin: 5px;
		padding: 5px;
	}
	
	span{
		color: grey;	
	}

	a:hover{
		color: red;
	}

	a{
		text-decoration: none;
	}


</style>
