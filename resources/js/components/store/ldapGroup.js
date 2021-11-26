import axios from "axios"

export default {
	namespaced: true,

    state: {
        admincount: null,
        cn: null,
        description: null,
        distinguishedname: null,
        dscorepropagationdata: null,
        grouptype: null,
        instancetype: null,
        iscriticalsystemobject: null,
        member: null,
        name: null,
        objectcategory: null,
        objectclass: null,
        objectguid: null,
        objectsid: null,
        samaccountname: null,
        samaccounttype: null,
        systemflags: null,
        usnchanged: null,
        usncreated: null,
        whenchanged: null,
        whencreated: null,

        error: null,
        resp: null
    },

    getters: {

    },

    mutations: {
        setLdapGroup(state, payload) {
            state.admincount= payload.admincount
            state.cn= payload.cn
            state.description= payload.description
            state.distinguishedname= payload.distinguishedname
            state.dscorepropagationdata= payload.dscorepropagationdata
            state.grouptype= payload.grouptype
            state.instancetype= payload.instancetype
            state.iscriticalsystemobject= payload.iscriticalsystemobject
            state.member= payload.member
            state.name= payload.name
            state.objectcategory= payload.objectcategory
            state.objectclass= payload.objectclass
            state.objectguid= payload.objectguid
            state.objectsid= payload.objectsid
            state.samaccountname= payload.samaccountname
            state.samaccounttype= payload.samaccounttype
            state.systemflags= payload.systemflags
            state.usnchanged= payload.usnchanged
            state.usncreated= payload.usncreated
            state.whenchanged= payload.whenchanged
            state.whencreated= payload.whencreated
        },

        cleanLdapGroup(state) {
            state.admincount= null
            state.cn= null
            state.description= null
            state.distinguishedname= null
            state.dscorepropagationdata= null
            state.grouptype= null
            state.instancetype= null
            state.iscriticalsystemobject= null
            state.member= null
            state.name= null
            state.objectcategory= null
            state.objectclass= null
            state.objectguid= null
            state.objectsid= null
            state.samaccountname= null
            state.samaccounttype= null
            state.systemflags= null
            state.usnchanged= null
            state.usncreated= null
            state.whenchanged= null
            state.whencreated= null
        },

        cleanResp(state) {
            state.error= null
            state.resp= null
        }
    },

    actions: {
        async searchGroup(context, payload) {
            const resp= await axios.post('/ldap/searchgroup', {word: payload})
            return resp
        }
    }
}