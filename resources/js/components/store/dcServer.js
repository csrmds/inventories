import axios from "axios"
import { create, update } from "lodash"

export default {
	namespaced: true,

    state: {
        id: null,
        alias: null,
        host: null,
        domain_name: null,
        user: null,
        password: null,
        port: null,
        status: null,
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

        setError(state, payload) {
            state.error= payload
        },

        cleanResp(state) {
            state.resp= null,
            state.error= null
        },

        setDcServer(state, payload) {
            state.id= payload.id
            state.alias= payload.alias
            state.host= payload.host
            state.domain_name= payload.domain_name
            state.user= payload.user
            state.password= payload.password
            state.port= payload.port
            state.status= payload.status
        },

        cleanDcServer(state) {
            state.id= null
            state.alias= null
            state.host= null
            state.domain_name= null
            state.user= null
            state.password= null
            state.port= null
            state.status= null
            state.created_at= null
            state.updated_at= null
        }
    },

    actions: {
        async getById(context, payload) {
            const resp= await axios.post('/dc/serverget', {id: payload})
            return resp.data[0]
        },

        async save(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('dc/serversave', {dcServer: payload})
                .then((response)=> {
                    context.commit('cleanDcServer')
                    context.commit('setResp', "Registro salvo com sucesso")
                    return response
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },

        async update(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('dc/serverupdate', {dcServer: payload})
                .then((response)=> {
                    context.commit('cleanDcServer')
                    context.commit('setResp', "Registro atualizado com sucesso")
                    return response
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },

        loadInputs(context, payload) {
            if (typeof(payload)=="object") {
                context.commit('setDcServer', payload)
            } else {
                payload= JSON.parse(payload)
                context.commit('setDcServer', payload)
            }
        }
    }
}