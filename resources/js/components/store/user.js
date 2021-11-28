import axios from "axios"

export default {
    namespaced: true,

    state: {
        id: null,
        name: null,
        email: null,
        email_verified_at: null,
        password: null,
        remember_token: null,
        people_id: null,
        guid: null,
        domain: null,
        created_at: null,
        updated_at: null,
        
        error: null,
        resp: null,
    },

    getters: {

    },

    mutations: {
        setResp(state, payload) {
            state.resp= payload
        },

        setUser(state, payload) {
            state.id= payload.id
            state.name= payload.name
            state.email= payload.email
            state.email_verified_at= payload.email_verified_at
            state.remember_token= payload.remember_token
            state.people_id= payload.people_id
            state.guid= payload.guid
            state.domain= payload.domain
        },

        cleanUser(state) {
            state.id= null
            state.name= null
            state.email= null
            state.email_verified_at= null
            state.remember_token= null
            state.people_id= null
            state.guid= null
            state.domain= null
        }

        

    },

    actions: {
        async search(context, payload) {
            const resp= await axios.post('/user/search', {
                word: payload
            })
            context.commit('setResp', resp.data)
            return resp
        },

        async getLdapUser(context, payload) {
            const resp= await axios.post('/user/getldapuser', {id: payload})
            return resp
        }

    }
}