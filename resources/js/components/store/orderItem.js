import axios from "axios";

export default {
    namespaced: true,

    state: {
        order_id: null,
        product_id: null,
        description: null,
        order: null,
        amount: null,
        value: null,
        discount: null,
        category: null,
        created_at: null,
        updated_at: null,

        error: null,
        resp: null
    },

    getters: {

    },

    mutations: {
        setResp(state, payload) {
            state.resp= payload
        },

        cleanResp(state) {
            state.resp= null
            state.error= null
        },

        setError(state, payload) {
            state.error= payload
        },

        setOrderItem(state, payload) {
            state.order_id= payload.order_id
            state.product_id= payload.product_id
            state.description= payload.description
            state.order= payload.order
            state.amount= payload.amount
            state.value= payload.value
            state.discount= payload.discount
            state.category= payload.category
        },

        cleanOrderItem(state, payload) {
            state.order_id= null
            state.product_id= null
            state.description= null
            state.order= null
            state.amount= null
            state.value= null
            state.discount= null
            state.category= null
            state.created_at= null
            state.updated_at= null
        }
    },

    actions: {
        async search(context, payload) {
            const resp= await axios.post('/order/itemsearch', {order_id: payload})
            return resp.data
        },

        async getByOrderId(context, payload) {
            const resp= await axios.post('/order/itemsearch', {order_id: payload})
            return resp.data
        },

        async save(context, payload) {
            console.log("orderItemSaveJs: ")
            console.log(payload)
            context.commit('cleanResp')
            context.commit('setOrderItem', payload)
            console.log('setOrderItem: ')
            console.log(context.state)
            const resp= await axios.post('/order/itemsave', {order_item: context.state} )
                .then((response)=> {
                    context.commit('cleanOrderItem')
                    context.commit('setResp', "Item salvo no pedido")
                    console.log(response)
                    return response
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },

        async destroy(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('/order/itemdestroy', payload)
                .then((response)=> {
                    context.commit('cleanOrderItem')
                    context.commit('setResp', "Item removido do pedido")
                    return response
                })
                .catch((error)=> {
                    context.commit('setError', error.resposne.data)
                })
        }
    }
}