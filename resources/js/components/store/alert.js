export default {
	namespaced: true,

    state: {
        title: null,
        msg: null,
        classType: null,
        timeToClose: { default: 3000 },
        view: false
    },

    getters: {

    },

    mutations: {
        setMessage(state, payload) {
            
            state.title= payload.title,
            state.msg= payload.msg,
            state.classType= payload.classType || "alert-info"
            //timeToClose= payload.timeToClose 
        },

        cleanMessage(state) {
            state.title= null,
            state.msg= null
        },

        alertShow(state) { state.view= true },

        alertHide(state) { state.view= false },

        alertToggle(state) { state.view= !state.view }
    },

    actions: {
        showAlert(context, payload) {
            context.commit('setMessage', payload)
            context.commit('alertShow')
        },

        closeAlert(context) {
            context.commit('alertHide')
            context.commit('cleanMessage')
        }
    }
}