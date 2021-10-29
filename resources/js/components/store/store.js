import Vue from "vue"
import Vuex from "vuex"

import product from "./product"
import user from "./user"
import group from "./group"


Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        info: "Store Info",
        alertView: false
    },

    getters: {

    },

    mutations: {
        alertShow() {
            console.log("opaa  do store")
            this.state.alertView= !this.state.alertView
        }
    },

    actions: {

    },

    modules: {
        product: product,
        user: user,
        group: group
    }
})