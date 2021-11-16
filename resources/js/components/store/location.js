import axios from "axios";
import { update } from "lodash";

export default {
    namespaced: true,

    state: {
        id: null,
        people_id: null,
        name: null,
        description: null,
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

        setLocation(state, payload) {
            state.id= payload.id
            state.people_id= payload.people_id
            state.name= payload.name
            state.description= payload.description
            state.created_at= payload.created_at
            state.updated_at= payload.updated_at
        },

        cleanLocation(state) {
            state.id= null
            state.people_id= null
            state.name= null
            state.description= null
            state.created_at= null
            state.updated_at= null
        },

    },

    actions: {
        async search(context, payload) {
            const resp= await axios.post('/location/search', {word: payload})
            return resp.data
        },

        async getById(context, payload) {
            const resp= await axios.post('/location/getbyid', {id: payload})
            return resp.data[0]
        },

        async save(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('/location/save', {location: payload})
                .then((response)=> {
                    context.commit('cleanLocation')
                    context.commit('setResp', "Cadastro salvo com sucesso")
                    console.log("terminou update... segue resp e response")
                    console.log(resp)
                    console.log(response)
                    return response
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },

        async update(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('/location/update', {location: payload})
                .then((response)=> {
                    context.commit('cleanLocation')
                    context.commit('setResp', "Cadastro atualizado com sucesso")
                    console.log("terminou update... segue resp e response")
                    console.log(resp)
                    console.log(response) 
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },

        async destroy(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('/location/destroy', {id: payload})
                .then((response)=> {
                    context.commit('cleanLocation')
                    context.commit('setResp', "Cadastro deletado com sucesso")
                    return response
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },

        loadInputs(context, payload) {
            if(typeof(payload)=="object") {
                context.commit('setLocation', payload)
            } else {
                payload= JSON.parse(payload)
                context.commit('setLocation', payload)
            }

        }

    }
}