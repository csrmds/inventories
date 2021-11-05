import axios from "axios"

export default {
    namespaced: true,

    state: {
        id: null,
		deviceid: null,
		name: null,
		workgroup: null,
		userdomain: null,
		osname: null,
		osversion: null,
		oscomments: null,
		processort: null,
		processors: null,
		processorn: null,
		memory: null,
		swap: null,
		ipaddr: null,
		dns: null,
		defaultgateway: null,
		etime: null,
		lastdate: null,
		lastcome: null,
		quality: null,
		fidelity: null,
		userid: null,
		type: null,
		description: null,
		wincompany: null,
		winowner: null,
		winprodid: null,
		winprodkey: null,
		useragent: null,
		checksum: null,
		sstate: null,
		ipsrc: null,
		uuid: null,
		arch: null,
		category_id: null,
		archive: null,
        tag: null,

        error: null,
        resp: null
    },

    getters: {

    },

    mutations: {
        setResp(state, payload) {
            state.resp= payload
        },

        setError(state, payload) {
            state.error= payload
        },

        setOcsHardware(state, ocsHardware) {
            state.id= ocsHardware.id,
            state.deviceid= ocsHardware.deviceid,
            state.name= ocsHardware.name,
            state.workgroup= ocsHardware.workgroup,
            state.userdomain= ocsHardware.userdomain,
            state.osname= ocsHardware.osname,
            state.osversion= ocsHardware.osversion,
            state.oscomments= ocsHardware.oscomments,
            state.processort= ocsHardware.processort,
            state.processors= ocsHardware.processors,
            state.processorn= ocsHardware.processorn,
            state.memory= ocsHardware.memory,
            state.swap= ocsHardware.swap,
            state.ipaddr= ocsHardware.ipaddr,
            state.dns= ocsHardware.dns,
            state.defaultgateway= ocsHardware.defaultgateway,
            state.etime= ocsHardware.etime,
            state.lastdate= ocsHardware.lastdate,
            state.lastcome= ocsHardware.lastcome,
            state.quality= ocsHardware.quality,
            state.fidelity= ocsHardware.fidelity,
            state.userid= ocsHardware.userid,
            state.type= ocsHardware.type,
            state.description= ocsHardware.description,
            state.wincompany= ocsHardware.wincompany,
            state.winowner= ocsHardware.winowner,
            state.winprodid= ocsHardware.winprodid,
            state.winprodkey= ocsHardware.winprodkey,
            state.useragent= ocsHardware.useragent,
            state.checksum= ocsHardware.checksum,
            state.sstate= ocsHardware.sstate,
            state.ipsrc= ocsHardware.ipsrc,
            state.uuid= ocsHardware.uuid,
            state.arch= ocsHardware.arch,
            state.category_id= ocsHardware.category_id,
            state.archive= ocsHardware.archive,
            state.tag= ocsHardware.tag
        },

        cleanOcsHardware(state) {
            state.id= null,
            state.deviceid= null,
            state.name= null,
            state.workgroup= null,
            state.userdomain= null,
            state.osname= null,
            state.osversion= null,
            state.oscomments= null,
            state.processort= null,
            state.processors= null,
            state.processorn= null,
            state.memory= null,
            state.swap= null,
            state.ipaddr= null,
            state.dns= null,
            state.defaultgateway= null,
            state.etime= null,
            state.lastdate= null,
            state.lastcome= null,
            state.quality= null,
            state.fidelity= null,
            state.userid= null,
            state.type= null,
            state.description= null,
            state.wincompany= null,
            state.winowner= null,
            state.winprodid= null,
            state.winprodkey= null,
            state.useragent= null,
            state.checksum= null,
            state.sstate= null,
            state.ipsrc= null,
            state.uuid= null,
            state.arch= null,
            state.category_id= null,
            state.archive= null,
            state.tag= null
        },

        cleanResp(state) {
			state.error= null
			state.resp= null
		}
    },

    actions: {
        async search(context, payload) {
			const resp= await axios.post('/ocs/search', {
				word: payload
			})

			//context.commit('setResp', resp.data)

			return resp
		},

        async searchById(context, payload) {
            const resp= await axios.post('/ocs/searchbyid', {
                id: payload
            })

            return resp
        }

    }
}