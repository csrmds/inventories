import axios from "axios"
import { update } from "lodash"

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
		ocs_hw_id: null,
		ocs_mon_id: null,
		people_id: null,
		location_id: null,
		location: null,
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

		setError(state, payload) {
			state.error= payload
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
			state.ocs_hw_id= product.ocs_hw_id
			state.ocs_mon_id= product.ocs_mon_id
			state.people_id= product.people_id
			state.location_id= product.location_id
			state.location= product.location
			state.created_at= product.created_at
			state.updated_at= product.updated_at
		},

		cleanProduct(state) {
			state.id= null
			state.name= null
			state.reference= null
			state.description= null
			state.type= null
			state.category= null
			state.manufacturer= null
			state.brand= null
			state.model= null
			state.sn= null
			state.tag= null
			state.property_id= null
			state.size_id= null
			state.color_id= null
			state.um= null
			state.status= null
			state.obs= null
			state.ocs_hw_id= null,
			state.ocs_mon_id= null,
			state.people_id= null,
			state.location_id= null,
			state.location= null,
			state.created_at= null,
			state.updated_at= null
		},

		cleanResp(state) {
			state.error= null
			state.resp= null
		}

	},

	actions: {
		async search(context, payload) {
			const resp= await axios.post('/product/search', {
				word: payload.word,
				page: payload.page
			})
			return resp
		},

		async searchBy(context, payload) {
			const resp= await axios.post('/product/searchby', {
				word: payload.word,
				column: payload.column
			})
			return resp
		},

		async getById(context, payload) {
			const resp= await axios.post('/product/getbyid', {id: payload})
			if (resp.data.id>0) {
				context.commit('setProduct', resp.data)
				return resp.data
			} else {
				return resp
			}
		},

		async save(context, payload) {
			context.commit('cleanResp')
			const resp= await axios.post('/product/save', { product: payload})
				.then(function (response) {
					context.commit('cleanProduct')
					context.error= null
					context.commit('setResp', "Produto salvo com sucesso")
				})
				.catch(function (error) {
					context.commit('setError', error.response.data)
				})
		},

		async update(context, payload) {
			context.commit('cleanResp')
			const resp= await axios.post('/product/update', { product: payload })
				.then(function (response) {
					context.commit('cleanProduct')
					context.error= null
					context.commit('setResp', "Alteração feita com sucesso")
					return resp.data
				})
				.catch(function (error) {
					context.commit('setError', error.response.data)
					return error.response.data
				})
		},

		async destroy(payload) {
			context.commit('cleanResp')
			const resp= await axios.post('/product/destroy', payload)
				.then(function (response) {
					context.commit('setResp', "Registro deletado com sucesso")
					return response.data
				})
				.catch(function (error) {
					context.commit('setError', error.response.data)
					return error.response.data
				})
			return resp
		},

		async getGroups(context) {
			const resp= await axios.post('/product/getgroups')
				.then(response=> {
					return response.data
				}).catch(error=> {
					context.commit('setError', error.response.data)
					return error
				})
			return resp
		},

		loadInputs(context, product) {
			if (typeof(product)=="object") {
				context.commit('setProduct', product)
			} else {
				product= JSON.parse(product)
				context.commit('setProduct', product)
			}
		}
	}
}

