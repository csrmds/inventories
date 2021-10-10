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
        created_at: null,
        updated_at: null,
        error: [],
        resp: null,
        action: [],
    },

    getters: {

    },

    muitations: {
        setResp(state, payload) {
            state.resp= payload
        }

    },

    actions: {
        async search(context, payload) {
            const resp= await axios.post('/user/search', {
                word: payload
            })

            context.commit('setResp', resp.data)

            return resp
        }
    }
}