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
		},

		setProduct(state, product) {
			//product= JSON.parse(product)
			state.id= product.id
			state.name= product.name
			state.reference= product.reference
			state.description= product.description
			state.type= product.type
			state.category= product.category
			state.manufacturer= product.manufacturer
			state.brand= product.brand
			state.model= product.model
			state.sn= product.sn
			state.tag= product.tag
			state.property_id= product.property_id
			state.size_id= product.size_id
			state.color_id= product.color_id
			state.um= product.um
			state.status= product.status
			state.obs= product.obs
		},

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
		},

		loadInputs(context, product) {
			console.log('laod inputs chegou...')
			//console.log(typeof(product))
			if (typeof(product)=="object") {
				context.commit('setProduct', product)
			} else {
				product= JSON.parse(product)
				context.commit('setProduct', product)
			}
		}
	}
}

