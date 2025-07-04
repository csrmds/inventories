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
        givenname: null,
        instancetype: null,
        iscriticalsystemobject: null,
        lastlogoff: null,
        lastlogon: null,
        lastlogontimestamp: null,
        logoncount: null,
        mail: null,
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
        sn: null,
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
            state.accountexpires= payload.accountexpires[0]
            state.admincount= payload.admincount ? payload.admincount[0] : null
            state.badpasswordtime= payload.badpasswordtime[0]
            state.badpwdcount= payload.badpwdcount[0]
            state.cn= payload.cn[0]
            state.codepage= payload.codepage[0]
            state.countrycode= payload.countrycode[0]
            state.description= payload.description ? payload.description[0] : null
            state.distinguishedname= payload.distinguishedname[0]
            state.dscorepropagationdata= payload.dscorepropagationdata[0]
            state.givenname= payload.givenname[0]
            state.instancetype= payload.instancetype[0]
            state.iscriticalsystemobject= payload.iscriticalsystemobject ? payload.iscriticalsystemobject[0] : null
            state.lastlogoff= payload.lastlogoff[0]
            state.lastlogon= payload.lastlogon[0]
            state.lastlogontimestamp= payload.lastlogontimestamp ? payload.lastlogontimestamp[0] : null
            state.logoncount= payload.logoncount[0]
            state.mail= payload.mail ? payload.mail[0] : null
            state.memberof= payload.memberof
            state.name= payload.name[0]
            state.objectcategory= payload.objectcategory[0]
            state.objectclass= payload.objectclass
            state.objectguid= payload.objectguid[0]
            state.objectsid= payload.objectsid[0]
            state.primarygroupid= payload.primarygroupid[0]
            state.pwdlastset= payload.pwdlastset[0]
            state.samaccountname= payload.samaccountname[0]
            state.samaccounttype= payload.samaccounttype[0]
            state.sn= payload.sn ? payload.sn[0] : null
            state.useraccountcontrol= payload.useraccountcontrol[0]
            state.userprincipalname= payload.userprincipalname ? payload.userprincipalname[0] : null
            state.usnchanged= payload.usnchanged[0]
            state.usncreated= payload.usncreated[0]
            state.whenchanged= payload.whenchanged[0]
            state.whencreated= payload.whencreated[0]
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
            state.givenname= null
            state.instancetype= null
            state.iscriticalsystemobject= null
            state.lastlogoff= null
            state.lastlogon= null
            state.lastlogontimestamp= null
            state.logoncount= null
            state.mail= null
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
            state.sn= null
            state.useraccountcontrol= null
            state.userprincipalname= null
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
            console.log(resp)
            return resp
        },

        async getLdapUser(context, payload) {
            const resp= await axios.post('/ldap/getldapuser', {samaccountname: payload})
            return resp
        },

        // async getLdapUserPeopleId(context, payload) {
        //     const resp= await axios.post('/ldap/getldapuserpeopleid', {samaccountname: payload})
        //     return resp
        // },

        loadInputs(context, payload) {
			if (typeof(payload)=="object") {
                console.log("payload...")
                console.log(payload)
				context.commit('setLdapUser', payload)
			} else {
				payload= JSON.parse(payload)
				context.commit('setLdapUser', payload)
			}
		}

        
    }
}