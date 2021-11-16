<template>
    <div>
        <div class="row">
            <div class="col-sm-9 input-group">
                <input v-model='word' type="text" class="form-control form-control-sm" placeholder="Busca" >
            </div>

            <div class="col-sm">
                <button @click="newLocation" class="form-control form-control-sm" >Novo</button>
            </div>

            <div class="col-sm">
                <button class="form-control form-control-sm" >Teste</button>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>ID</th>
                        <th>Local</th>
                        <th>Descrição</th>
                        <th>Proprietário</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr v-for="(location, i) in list" :key="i">
                            <td>{{ location.id }}</td>
                            <td>{{ location.name }}</td>
                            <td>{{ location.description }}</td>
                            <td>{{ location.people_id }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" @click="edit(location.id)">Editar</button>
                                <button class="btn btn-sm btn-outline-danger" @click="destroy(location)">Deletar</button>
                            </td>                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="col-sm">
                <b-modal
                    id="modal-location-form"
                    title="Locais"
                    size="xl"
                    button-size="sm"
                    hide-footer
                    @hide="reload">
                    <c-location-form></c-location-form>
                </b-modal>
            </div>

            <div class="col-sm">	
				<b-modal 
					id="modal-location-edit" 
					title="Locais"
                    size="xl"
                    button-size="sm"
                    hide-footer
                    @hide="reload">
					<c-location-form></c-location-form>
				</b-modal>
			</div>

            <div class="col-sm">
                <b-modal 
					id="modal-destroy-confirmation" 
					size="sm"
                    button-size="sm"
                    hide-header
                    @hide="reload">
                    <p>Deseja realmente deletar o seguinte registro?</p> 
                    <strong>{{ "ID: "+location.id+" " }} {{ location.name+" - "+location.description }}</strong>
                    <template #modal-footer>
                        <button size="sm" variant="outline-secondary" class="btn btn-sm btn-danger" @click="destroyConfirm">Deletar</button>
                    </template>
				</b-modal>
            </div>

            <div class="col-sm">
                <b-modal
                    id="modal-msg"
                    size="sm"
                    hide-header
                    ok-only
                    @hide="reload"
                >
                    {{ modal.msg }}
                </b-modal>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            location: this.$store.state.location,
            word: null,
            list: null,
            modal: { msg: null }
        }
    },

    computed: {
        error() { return this.$store.state.location.error },
        resp() { return this.$store.state.location.resp }
    },

    methods: {
        async filterList() {
            const resp= await this.$store.dispatch('location/search', {word: this.word})
            this.list= resp
        },

        newLocation() {
            this.$store.commit('location/cleanLocation')
            this.$store.commit('location/cleanResp')
            this.$bvModal.show('modal-location-form')
        },

        async edit(id) {
            const location= await this.$store.dispatch('location/getById', {id: id})
            // console.log('resp location')
            // console.log(location)
            if (location.id) {
                // console.log('chama loadinputs')
                this.$store.dispatch('location/loadInputs', location)
                this.$bvModal.show('modal-location-edit')
            } else {
                // console.log('chamou error')
                this.modal.msg= location
                this.$bvModal.show('modal-msg')
            }
        },

        destroy(param) {
            this.location= param
            this.$bvModal.show('modal-destroy-confirmation')
        },

        async destroyConfirm() {
            await this.$store.dispatch('location/destroy', this.location.id)
            this.$bvModal.hide('modal-destroy-confirmation')
        },

        reload() {
            this.$store.commit('location/cleanLocation')
            this.$store.commit('location/cleanResp')
            this.filterList()
        },

    },

    mounted() {
        this.filterList()
    },

    watch: {
        error: function(newValue) {
            if (newValue!=null) {
                this.modal.msg= newValue
                this.$bvModal.show('modal-msg')
            }
        },

        resp: function(newValue) {
            if (newValue!=null) {
                this.modal.msg= newValue
                this.$bvModal.show('modal-msg')
            }
        }
    }
}
</script>
