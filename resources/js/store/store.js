import Vue from 'vue'
import Vuex from 'vuex'
import categoryModule from './modules/category'
import reusedComponent from './modules/reusedComponent'

Vue.use(Vuex)

export default new Vuex.Store({
    modules : {
        categoryModule,
        reusedComponent
    }
})
