<template>
    <div>
        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Alias</label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="ocsServer.alias"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">IP: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="ocsServer.host"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Nome DB: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="ocsServer.database_name"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">User DB: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="ocsServer.database_user"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Senha DB: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="ocsServer.database_password"
                    :readonly="readonly"
                    type="password" 
                    class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Porta DB: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="ocsServer.database_port"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm"
                    placeholder="3306">
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm-2">
                <button class="btn btn-sm btn-outline-primary" @click="getDefaultServer">Teste Conexão</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-outline-primary" @click="editMode">Editar</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-outline-success" @click="save">Salvar</button>
            </div>
        </div>
    </div>
</template>

<script>
import { readonly } from 'vue-demi'
export default {
    data() {
        return {
            readonly: true
        }
    },

    computed: {
        ocsServer() { return this.$store.state.ocsServer }
    },

    methods: {
        async save() {
            if (this.ocsServer.id== null) {
                const resp= await axios.post('ocs/serversave', {ocsServer: this.ocsServer})
                if (resp.data.success) {
                    this.readonly= true
                }
            } else {
                const resp= await axios.post('ocs/serverupdate', {ocsServer: this.ocsServer})
                if (resp.data.success) {
                    this.readonly= true
                }
            }
        },

        cleanInputs() {
            this.$store.commit('ocsServer/cleanOcsServer');
        },

        async getDefaultServer() {
            const resp= await axios.post('ocs/serverget', {id: 1})
            if (resp.data.id==1) {
                this.$store.commit('ocsServer/setOcsServer', resp.data)
            }
        },

        editMode() {
            this.readonly= !this.readonly
        }

    },

    mounted() {
        this.getDefaultServer()
    }
}
</script>


<style scoped>
.form-group {
    margin-bottom: 0px;
}
</style>