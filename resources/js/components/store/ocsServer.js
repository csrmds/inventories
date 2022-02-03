export default {
	namespaced: true,

    state: {
        id: null,
        alias: null,
        host: null,
        database_name: null,
        database_user: null,
        database_password: null,
        database_port: null,
        status: null,
        created_at: null,
        updated_at: null,

        resp: null,
        error: null
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

        setOcsServer(state, payload) {
            state.id= payload.id
            state.alias= payload.alias
            state.host= payload.host
            state.database_name= payload.database_name
            state.database_user= payload.database_user
            state.database_password= payload.database_password
            state.database_port= payload.database_port
            state.status= payload.status
        },

        cleanOcsServer(state) {
            state.id= null
            state.alias= null
            state.host= null
            state.database_name= null
            state.database_user= null
            state.database_password= null
            state.database_port= null
            state.status= null
            state.created_at= null
            state.updated_at= null
        }


    },

    actions: {
        async getById(context, payload) {
            const resp= await axios.post('/ocs/serverget', {id: payload})
            return resp.data[0]
        },

        async save(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('ocs/serversave', {ocsServer: payload})
                .then((response)=> {
                    // context.commit('cleanOcsServer')
                    // context.commit('setResp', "Registro salvo com sucesso")
                    return response
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },

        async update(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('ocs/serverupdate', {ocsServer: payload})
                .then((response)=> {
                    // context.commit('cleanOcsServer')
                    // context.commit('setResp', "Registro atualizado com sucesso")
                    return response
                })
                .catch((error)=> {
                    context.commit('setError', error.response.data)
                })
        },

        loadInputs(context, payload) {
            if (typeof(payload)=="object") {
                context.commit('setOcsServer', payload)
            } else {
                payload= JSON.parse(payload)
                context.commit('setOcsServer', payload)
            }
        }
    }
}