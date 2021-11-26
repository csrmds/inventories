import axios from "axios"

export default {
	namespaced: true,

    state: {
        accountexpires: null,
        admincount: null,
        badpasswordtime: null,
        badpwdcount: null,
        cn: null,
        codepage: null,
        countrycode: null,
        description: null,
        distinguishedname: null,
        dscorepropagationdata: null,
        instancetype: null,
        iscriticalsystemobject: null,
        lastlogoff: null,
        lastlogon: null,
        lastlogontimestamp: null,
        logoncount: null,
        memberof: null,
        name: null,
        objectcategory: null,
        objectclass: null,
        objectguid: null,
        objectsid: null,
        primarygroupid: null,
        pwdlastset: null,
        samaccountname: null,
        samaccounttype: null,
        useraccountcontrol: null,
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
        setLdapUser(state, payload) {
            state.accountexpires= payload.accountexpires
            state.admincount= payload.admincount
            state.badpasswordtime= payload.badpasswordtime
            state.badpwdcount= payload.badpwdcount
            state.cn= payload.cn
            state.codepage= payload.codepage
            state.countrycode= payload.countrycode
            state.description= payload.description
            state.distinguishedname= payload.distinguishedname
            state.dscorepropagationdata= payload.dscorepropagationdata
            state.instancetype= payload.instancetype
            state.iscriticalsystemobject= payload.iscriticalsystemobject
            state.lastlogoff= payload.lastlogoff
            state.lastlogon= payload.lastlogon
            state.lastlogontimestamp= payload.lastlogontimestamp
            state.logoncount= payload.logoncount
            state.memberof= payload.memberof
            state.name= payload.name
            state.objectcategory= payload.objectcategory
            state.objectclass= payload.objectclass
            state.objectguid= payload.objectguid
            state.objectsid= payload.objectsid
            state.primarygroupid= payload.primarygroupid
            state.pwdlastset= payload.pwdlastset
            state.samaccountname= payload.samaccountname
            state.samaccounttype= payload.samaccounttype
            state.useraccountcontrol= payload.useraccountcontrol
            state.usnchanged= payload.usnchanged
            state.usncreated= payload.usncreated
            state.whenchanged= payload.whenchanged
            state.whencreated= payload.whencreated
        },

        cleanLdapUser(state) {
            state.accountexpires= null
            state.admincount= null
            state.badpasswordtime= null
            state.badpwdcount= null
            state.cn= null
            state.codepage= null
            state.countrycode= null
            state.description= null
            state.distinguishedname= null
            state.dscorepropagationdata= null
            state.instancetype= null
            state.iscriticalsystemobject= null
            state.lastlogoff= null
            state.lastlogon= null
            state.lastlogontimestamp= null
            state.logoncount= null
            state.memberof= null
            state.name= null
            state.objectcategory= null
            state.objectclass= null
            state.objectguid= null
            state.objectsid= null
            state.primarygroupid= null
            state.pwdlastset= null
            state.samaccountname= null
            state.samaccounttype= null
            state.useraccountcontrol= null
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
        async search(context, payload) {
            const resp= await axios.post('/ldap/searchuser', {word: payload})
            return resp
        }

        
    }
}