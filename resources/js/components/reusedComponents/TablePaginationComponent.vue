<template>

    <nav aria-label="...">
        <ul class="pagination pagination-sm">
            <li class="page-item">
                <button type="button" class="btn btn-outline-info">  <dropdown-component
                    @perPage = "getPerPage"
                /></button>

            </li>
            <li class="page-item">
                <a class="page-link" href="#" tabindex="-1" @click="firstPage">First</a>
            </li>
            <li class="page-item"><a class="page-link" href="#" @click="previousPage"><i class="fa fa-angle-left" aria-hidden="true" ></i></a></li>
            <li class="page-item"><a class="page-link" href="#" @click="nextPage"><i class="fa fa-angle-right" aria-hidden="true" ></i></a></li>
            <li class="page-item">
                <a class="page-link" href="#" @click="lastPage">Last</a>
            </li>
        </ul>
    </nav>

</template>


<script>

    import DropdownComponent from "./DropdownComponent";

    export default {
        name: "tablePaginationComponent",
        component : {DropdownComponent},
        props : ['array'],
        data : () => {
            return {
                start : 0,
                end : 10,
                perPage : 10,
                pass : 0,
                count : 1
            }

        },
        watch : {
            array: function () {
                this.searchingSplitArray()
            }
        },
        methods : {
            splitArray(){
                let arr = this.array.slice(this.start, this.end)
                this.$emit('fillCat', arr)
            },

            searchingSplitArray(){
                this.start = 0
                this.end = this.start + this.perPage
                this.pass = Math.ceil(this.array.length / this.perPage)
                this.count = 1
                let arr = this.array.slice(this.start, this.end)
                this.$emit('fillCat', arr)
            },
            nextPage(){
                ++this.count
                if(this.count <= this.pass) {
                    this.start += this.perPage;
                    this.end += this.perPage
                    this.splitArray()
                }else{
                    this.count = this.pass
                }
            },
            previousPage(){
                --this.count
                if(this.count >= 1) {
                    if((this.count+1)===this.pass){
                        this.end = this.pass * this.perPage
                    }
                    this.start -= this.perPage;
                    this.end -= this.perPage
                    this.splitArray()
                }else{
                    this.count = 1
                }
            },
            lastPage(){
                this.end = this.pass* this.perPage;
                this.start = this.end - this.perPage
                this.count = this.pass
                this.splitArray()
            },
            firstPage(){
                this.start = 0;
                this.end = this.perPage
                this.count = 1
                this.splitArray()
            },
            getPerPage(value){
                let prevCount = this.count * 100 / this.pass / 100;
                this.perPage = value

                this.pass = Math.ceil(this.array.length / this.perPage)
                this.count = Math.ceil((this.array.length / this.perPage) * prevCount)
                if (this.count === 1){
                    this.start = 0
                    this.end = this.start + this.perPage
                }else {
                    this.start = this.count * this.perPage - this.perPage
                    this.end = this.start + value
                }

                this.splitArray()
            }
        },
        created(){
            this.pass = Math.ceil(this.array.length / this.perPage)
            this.splitArray()
        }
    }

</script>

<style scoped>

</style>
