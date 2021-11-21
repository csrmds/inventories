import Vue from "vue"
import Vuex from "vuex"

import product from "./product"
import user from "./user"
import group from "./group"
import ocsHardware from "./ocshardware"
import alert from "./alert"
import people from "./people"
import location from "./location"


Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        info: "Store Info",
        ufs: [
            {codUf: 11, nome: "Rondônia", uf: "RO"},
            {codUf: 12, nome: "Acre", uf: "AC"},
            {codUf: 13, nome: "Amazonas", uf: "AM"},
            {codUf: 14, nome: "Roraima", uf: "RR"},
            {codUf: 15, nome: "Pará", uf: "PA"},
            {codUf: 16, nome: "Amapá", uf: "AP"},
            {codUf: 17, nome: "Tocantins", uf: "TO"},
            {codUf: 21, nome: "Maranhão", uf: "MA"},
            {codUf: 22, nome: "Piauí", uf: "PI"},
            {codUf: 23, nome: "Ceará", uf: "CE"},
            {codUf: 24, nome: "Rio Grande do Norte", uf: "RN"},
            {codUf: 25, nome: "Paraíba", uf: "PB"},
            {codUf: 26, nome: "Pernambuco", uf: "PE"},
            {codUf: 27, nome: "Alagoas", uf: "AL"},
            {codUf: 28, nome: "Sergipe", uf: "SE"},
            {codUf: 29, nome: "Bahia", uf: "BA"},
            {codUf: 31, nome: "Minas Gerais", uf: "MG"},
            {codUf: 32, nome: "Espírito Santo", uf: "ES"},
            {codUf: 33, nome: "Rio de Janeiro", uf: "RJ"},
            {codUf: 35, nome: "São Paulo", uf: "SP"},
            {codUf: 41, nome: "Paraná", uf: "PR"},
            {codUf: 42, nome: "Santa Catarina", uf: "SC"},
            {codUf: 43, nome: "Rio Grande do Sul", uf: "RS"},
            {codUf: 50, nome: "Mato Grosso do Sul", uf: "MS"},
            {codUf: 51, nome: "Mato Grosso", uf: "MT"},
            {codUf: 52, nome: "Goiás", uf: "GO"},
            {codUf: 53, nome: "Distrito Federal", uf: "DF"}
        ]
            
        
    },

    getters: {
        
    },

    mutations: {

    },

    actions: {
        async convertData(context, payload) {
            console.log('store convertData')
            console.log('payload '+payload)
            let date= null
            if (payload.indexOf('/')>-1) {
                date= payload.split('/')
                date= date[2]+"-"+date[1]+"-"+date[0]
                console.log("date DB "+date)
            } else {
                date= payload.split(' ')
                date= date[0].split('-')
                date= date[2]+"/"+date[1]+"/"+date[0]
                console.log("date PT "+date)
            }
            return await date
        }
    },

    modules: {
        product: product,
        user: user,
        group: group,
        ocsHardware: ocsHardware,
        alert: alert,
        people: people,
        location: location
    }
})