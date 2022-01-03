import { faSave } from "@fortawesome/free-regular-svg-icons"
import axios from "axios"
import { update } from "lodash"

export default {
    namespaced: true,

    state: {
        id: null,
        first_name: null,
        last_name: null,
        nick_name: null,
        type: null,
        category: null,
        birth_date: null,
        zipcode: null,
        country: null,
        state: null,
        city: null,
        district: null,
        address: null,
        number: null,
        complement: null,
        rg: null,
        cpf: null,
        cnpj: null,
        ie: null,
        created_at: null,
        updated_at: null,
        sistema: null,

        categories: null,

        error: null,
        resp: null
    },

    getters: {
        getResp(state) {
            return {resp: state.resp, error: state.error}
        },
    },

    mutations: {
        setResp(state, payload) {
            state.resp= payload
        },

        setError(state, payload) {
            state.error= payload
        },

        setPeople(state, people) {
            state.id= people.id,
            state.first_name= people.first_name,
            state.last_name= people.last_name,
            state.nick_name= people.nick_name,
            state.type= people.type,
            state.category= people.category,
            state.birth_date= people.birth_date,
            state.zipcode= people.zipcode,
            state.country= people.country,
            state.state= people.state,
            state.city= people.city,
            state.district= people.district,
            state.address= people.address,
            state.number= people.number,
            state.complement= people.complement,
            state.rg= people.rg,
            state.cpf= people.cpf,
            state.cnpj= people.cnpj,
            state.ie= people.ie,
            state.sistema= people.sistema
        },

        cleanPeople(state) {
            state.id= null,
            state.first_name= null,
            state.last_name= null,
            state.nick_name= null,
            state.type= null,
            state.category= null,
            state.birth_date= null,
            state.zipcode= null,
            state.country= null,
            state.state= null,
            state.city= null,
            state.district= null,
            state.address= null,
            state.number= null,
            state.complement= null,
            state.rg= null,
            state.cpf= null,
            state.cnpj= null,
            state.ie= null,
            state.sistema= null,
            state.created_at= null,
            state.updated_at= null
        },

        cleanResp(state) {
            state.error= null,
            state.resp= null
        },

        setAddress(state, payload) {
            state.zipcode= payload.cep
            state.state= payload.uf
            state.city= payload.city
            state.district= payload.district
            state.address= payload.address
            state.complement= payload.complement
        },

        setCategories(state, payload) {
            state.categories= payload
        }
    },

    actions: {
        async search(context, payload) {
            const resp= await axios.post('/people/search', {
                word: payload.word,
                page: payload.page
            })
            
            if (typeof resp.data.data == 'object') {
                //console.log(resp.data)
                return resp.data
            } else {
                return resp
            }
            
        },

        async searchBy(context, payload) {
            const resp= await axios.post('/people/searchby', {
                word: payload.word,
                column: payload.column
            })
            return resp
        },

        async getById(context, payload) {
            const resp= await axios.post('/people/getbyid', {
                id: payload
            })
            if (resp.data[0].id>0) {
                context.commit('setPeople', resp.data[0])
                return resp.data[0]
            } else {
                return resp
            }
        },

        async save(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('/people/save', {
                people: payload.people,
                ldapUser: payload.ldapUser 
            })
            .then(function(response) {
                context.commit('cleanPeople')
                context.commit('setResp', "Cadastro salvo com sucesso")
            })
            .catch(function (error) {
                context.commit('setError', error.response.data)
            })
        },

        async update(context, payload) {
            context.commit('cleanResp')
            const resp= await axios.post('/people/update', payload)
                .then(function (response) {
                    context.commit('cleanPeople')
                    context.commit('setResp', "Alteração feita com sucesso")
                    return response
                })
                .catch(function (error) {
                    context.commit('setError', error.response.data)
                    return error.response.data
                })
        },

        async destroy(context, payload) {
			context.commit('cleanResp')
			const resp= await axios.post('/people/destroy', {id: payload})
				.then(function (response) {
                    //context.commit('cleanPeople')
					context.commit('setResp', "Registro deletado com sucesso")
					return resp
				})
				.catch( (error)=> {
					context.commit('setError', error.response.data)
					return error.response.data
				})
		},

        loadInputs(context, people) {
            if(typeof(people)=="object") {
                context.commit('setPeople', people)
            } else { 
                people= JSON.parse(people)
                context.commit('setPeople', people)
            }
        },

        loadAddress(context, payload) {
            context.commit('setAddress', payload)
        },

        async listCategory(context) {
            await axios.post('/people/listcategory')
                .then((response)=> {
                    context.commit('setCategories', response.data)
                })
                .catch((error)=> {
                    console.log("error: "+error)
                    return error
                })
        },

        async getUser(context, payload) {
            console.log('getUser people.js: '+payload)
            return await axios.post('/people/getuser', {id: payload})
        },

        async removeLdapUser(context, payload) {
            return await axios.post('/people/removeldapuser', {ldapUser: payload})
        }
    }
}