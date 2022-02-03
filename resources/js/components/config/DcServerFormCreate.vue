<template>
    <div>
        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Alias</label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="dcServer.alias"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">IP: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="dcServer.host"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Domínio: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="dcServer.domain_name"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm"
                    placeholder="dominio_exemplo.com">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Usuário: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="dcServer.user"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Senha: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="dcServer.password"
                    :readonly="readonly"
                    type="password" 
                    class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Porta: </label>
            <div class="col-sm-2 col-form-label">
                <input 
                    v-model="dcServer.port"
                    :readonly="readonly"
                    type="text" 
                    class="form-control form-control-sm"
                    value="389"
                    placeholder="389 (default)">
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm-2">
                <button class="btn btn-sm btn-outline-primary">Teste Conexão</button>
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
export default {
    data() {
        return {
            readonly: true
        }
    },

    computed: {
        dcServer() { return this.$store.state.dcServer }
    },

    methods: {
        async save() {
            if (this.dcServer.id== null) {
                const resp= await axios.post('dc/serversave', { dcServer: this.dcServer })
                if (resp.data.success) {
                    this.readonly= true
                }
            } else {
                const resp= await axios.post('dc/serverupdate', { dcServer: this.dcServer })
                if (resp.data.success) {
                    this.readonly= true
                }
            }
        },

        cleanInputs() {
            this.$store.commit('dcServer/cleanDcServer')
        },

        async getDefaultServer() {
            const resp= await this.$store.dispatch('dcServer/getById', 1)
            if (resp.id==1) {
                this.$store.commit('dcServer/setDcServer', resp)
                this.readonly= true
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