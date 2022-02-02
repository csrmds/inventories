import { faSearch } from "@fortawesome/free-solid-svg-icons";
import axios from "axios";

export default {
    namespaced: true,

    state: {
        id: null,
        people_origin: null,
        people_destiny: null,
        title: null,
        category: null,
        description: null,
        location_origin: null,
        location_destiny: null,
        user_id: null,
        request_from: null,
        value: null,
        discount: null,
        status: null,
        created_at: null,
        updated_at: null,

        location_destiny_name: null,
        location_origin_name: null,
        people_destiny_first_name: null,
        people_destiny_last_name: null,
        people_origin_first_name: null,
        people_origin_last_name: null,
        people_request_first_name: null,
        people_request_last_name: null,

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

        setOrder(state, payload) {
            state.id= payload.id
            state.people_origin= payload.people_origin
            state.people_destiny= payload.people_destiny
            state.title= payload.title
            state.category= payload.category
            state.description= payload.description
            state.location_origin= payload.location_origin
            state.location_destiny= payload.location_destiny
            state.user_id= payload.user_id
            state.request_from= payload.request_from
            state.value= payload.value
            state.discount= payload.discount
            state.status= payload.status
            state.created_at= payload.created_at
            state.updated_at= payload.updated_at

            state.location_destiny_name= payload.location_destiny_name
            state.location_origin_name= payload.location_origin_name
            state.people_destiny_first_name= payload.people_destiny_first_name
            state.people_destiny_last_name= payload.people_destiny_last_name
            state.people_origin_first_name= payload.people_origin_first_name
            state.people_origin_last_name= payload.people_origin_last_name
            state.people_request_first_name= payload.people_request_first_name
            state.people_request_last_name= payload.people_request_last_name
        },

        cleanOrder(state, payload) {
            console.log('order cleanOrder')
            state.id= null
            state.people_origin= null
            state.people_destiny= null
            state.title= null
            state.category= null
            state.description= null
            state.location_origin= null
            state.location_destiny= null
            state.user_id= null
            state.request_from= null
            state.value= null
            state.discount= null
            state.status= null
            state.created_at= null
            state.updated_at= null

            state.location_destiny_name= null
            state.location_origin_name= null
            state.people_destiny_first_name= null
            state.people_destiny_last_name= null
            state.people_origin_first_name= null
            state.people_origin_last_name= null
            state.people_request_first_name= null
            state.people_request_last_name= null
        }

    },

    actions: {
        async search(context, payload) {
            const resp= await axios.post('/order/search', {
                word: payload.word,
                page: payload.page
            })
            
            if (typeof resp.data.data == 'object') {
                //console.log(resp.data)
                return resp.data
            } else {
                return resp
            }
        },

        async getById(context, payload) {
            // console.log('getById order.js')
            // console.log(payload)
            const resp= await axios.post('/order/getById', {id: payload})
            return resp.data[0]
        },

        async save(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('/order/save', {order: payload})
                .then((response)=>{
                    context.commit('cleanOrder')
                    context.commit('setResp', "Pedido salvo com sucesso")
                    //console.log(response)
                    return response
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },

        async update(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('/order/update', {order: payload})
                .then((response)=> {
                    context.commit('cleanOrder')
                    context.commit('setResp', "Pedido atualizado com sucesso")
                    // console.log("terminou update... segue resp e response")
                    // console.log(resp)
                    // console.log(response) 
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },


        loadInputs(context, payload) {
            if(typeof(payload)=="object") {
                context.commit('setOrder', payload)
            } else {
                payload= JSON.parse(payload)
                context.commit('setOrder', payload)
            }

        }
    }
}