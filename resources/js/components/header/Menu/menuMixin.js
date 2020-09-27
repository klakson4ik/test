export default {
    props : ['categoryNested', 'uri'],
    data() {
        return {
            array : []
        }
    },

    created() {
        for (let item in this.categoryNested){
            this.array.push({
                item :this.categoryNested[item],
                is_visible : false
            })

        }
    }
}
