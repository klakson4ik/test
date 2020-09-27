import TablePaginationComponent from "../reusedComponents/TablePaginationComponent";
import SearchComponent from "../reusedComponents/SearchComponent";

export default {
    component :{TablePaginationComponent, SearchComponent},
    data() {
        return {
            searchArray : [],
            items : []
        }
    },
    methods : {
        getArrayPagination(query) {
            if (query.length > 0) {
                let array = []
                for (let item of this.categories) {
                    let regexp = new RegExp(query.trim(), 'i');
                    if (regexp.test(item.title)) {
                        array.push(item)
                    }
                }
                this.searchArray = array
            }else{
                this.searchArray = this.categories
            }
        },
        fillCat(array) {
            this.items = [];
            for (let cat of array) {
                this.items.push({
                        title: cat.title,
                        id: cat.id,
                        parent_id: cat.parent_id
                    }
                )
            }
        },
    },
    // mounted() {
    //     this.$store.subscribe((mutation) => {
    //         if(mutation.type === 'SEARCHING_QUERY'){
    //             this.getArrayPagination()
    //         }
    //     })
    // },
    created() {
        this.searchArray = this.categories

    }
}
