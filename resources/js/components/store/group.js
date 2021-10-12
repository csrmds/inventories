//import axios from "axios"

export default {
	namespaced: true,

	state: {
		id: null,
		table: null,
		name: null,
		description: null,
		hierarchy: null,
		hierarchy_name: null,
		created_at: null,
		updated_at: null,
		error: null,
		resp: null,
		action: null
	},

	getters: {

	},

	mutations: {
		setResp(state, payload) {
			state.resp= payload
		}
	},

	actions: {
		async search(context, payload) {

			console.log("action..: "+payload)
			const resp= await axios.post('/group/search', {
				word: payload
			})

			context.commit('setResp', resp.data)

			return resp.data
		},

		async all(context) {
			const resp= await axios.get('/group/all')

			context.commit('setResp', resp.data)

			return resp.data
		},

		getByTable(context, payload) {
			const resp= axios.post('/group/getbytable', { word:payload })
			context.commit('setResp', resp.data)

			return resp
		},

		getById(context, payload) {
			const resp= axios.post('/group/getbyid', { word:payload })
			context.commit('setResp', resp.data)

			return resp.data
		}
	}
}