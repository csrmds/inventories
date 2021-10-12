import axios from "axios"

export default {
	namespaced: true,
	
	state: {
		id: null,
		name: null,
		reference: null,
		description: null,
		type: null,
		category: null,
		manufacturer: null,
		brand: null,
		model: null,
		sn: null,
		tag: null,
		property_id: null,
		size_id: null,
		color_id: null,
		um: null,
		status: null,
		obs: null,
		created_at: null,
		updated_at: null,
		error: [],
		resp: null,
		action: []
	},

	getters: {
		
	},

	mutations: {
		getInfo(state) {
			axios.get('/product/getinfo')
				.then(function (response) {
					state.resp= response.data
				}).catch(function (error) {
					state.error= error
				})
		},

		setResp(state, payload) {
			state.resp= payload
		}
	},

	actions: {
		async search(context, payload) {
			const resp= await axios.post('/product/search', {
				word: payload
			})

			context.commit('setResp', resp.data)

			return resp
		},

		async searchBy(context, payload) {
			const resp= await axios.post('/product/searchby', {
				word: payload.word,
				column: payload.column
			})

			context.commit('setResp', resp.data)

			return resp
			
		}
	}
}

