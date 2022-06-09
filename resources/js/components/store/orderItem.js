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

        list: [],

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

        setOrderItems(state, payload) {
            payload.forEach(element => {
                state.list.push(element)
            });
        },

        cleanOrderItem(state, payload) {
            console.log('orderItem cleanOrderItem')
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
        },

        cleanOrderItems(state) {
            state.list= []
        }
    },

    actions: {
        async search(context, payload) {
            const resp= await axios.post('/order/itemsearch', {
                word: payload.word,
                page: payload.page
            })
            
            if (typeof resp.data.data== 'object') {
                return resp.data
            } else {
                return resp
            }
        },

        async getByOrderId(context, payload) {
            const resp= await axios.post('/order/itembyorder', {order_id: payload})
            return resp.data
        },

        async save(context, payload) {
            context.commit('cleanResp')
            context.commit('setOrderItems', payload.orderItems)
            const resp= await axios.post('/order/itemsave', {
                order_items: context.state.list,
                order: payload.order
                })
                .then((response)=> {
                    context.commit('cleanOrderItem')
                    context.commit('cleanOrderItems')
                    context.commit('setResp', "Item salvo no pedido")
                    return response
                })
                .catch((error)=> {
                    context.commit('cleanOrderItem')
                    context.commit('cleanOrderItems')
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