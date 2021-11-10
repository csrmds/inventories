<template>
    <div class="container-fluid">

        <div v-if="inputSearch" class="row">
            <div class="col-sm-9 input-group">
                <input 
                    v-model="word" 
                    @keydown.enter="filterList"
                    type="text" 
                    class="form-control form-control-sm" 
                    placeholder="Busca">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-outline-secondary" @click="filterList">Filtrar</button>
                </div>
            </div>

            <div class='col-sm'>
                <button class="btn btn-sm btn-outline-primary container-fluid" @click="newPeople" >Novo</button>
            </div>

        </div>

        <div class="row">
            <div class="col-sm">
                <pre></pre>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                
                <table class="table table-striped table-sm">
                    <thead>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Categoria</th>
                        <th>Cidate</th>
                        <th>Endereço</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr v-for="(people, i) in list" :key="i">
                            <td>{{ people.id}}</td>
                            <td>{{ people.first_name}} {{ people.last_name }}</td>
                            <td>{{ people.type}}</td>
                            <td>{{ people.category}}</td>
                            <td>{{ people.city}}</td>
                            <td>{{ people.address}}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" @click="edit(people.id)">Edit</button>
                                <button class="btn btn-sm btn-outline-danger" @click="destroy(people)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>


        <div class="row">
			<div class="col-sm-12">
				<c-alert dismissible="true" ></c-alert>
			</div>
		</div>


        <div class="row">
			<div class="col-sm">	
				<b-modal 
					id="modal-people-edit" 
					title="Pessoas"
					size="xl"
                    button-size="sm"
                    hide-footer>
					<c-people-form-edit></c-people-form-edit>
				</b-modal>
			</div>
            
            <div class="col-sm">
                <b-modal 
					id="modal-destroy-confirmation" 
					size="sm"
                    button-size="sm"
                    hide-header>
                    <p>Deseja realmente deletar o seguinte registro?</p> 
                    <strong>{{ "ID: "+people.id+" " }} {{ people.first_name+" "+people.last_name }}</strong>
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
        props: {
            inputSearch: {
                default: true
            }
        },

        data() {
            return {
                people: this.$store.state.people,
                word: null,
                list: null,
                modal: { msg: null }
            }
        },

        computed: {
            error() { return this.$store.state.people.error },
            resp() { return this.$store.state.people.resp }
        },

        methods: {
            async filterList() {
                const resp= await this.$store.dispatch('people/search', { word: this.word })
                this.list= resp.data
            },

            async edit(id) {
                const people= await this.$store.dispatch('people/getById', { id: id })
                if (people.id) {
                    this.$store.dispatch('people/loadInputs', people)
                    this.$bvModal.show('modal-people-edit')
                } else {
                    this.modal.msg= people
                    this.$bvModal.show('modal-msg')
                }
            },

            newPeople() {
                this.$store.commit('people/cleanPeople')
                this.$store.commit('people/cleanResp')
                this.$bvModal.show('modal-people-edit')
            },

            destroy(param) {
                this.people= param
                this.$bvModal.show('modal-destroy-confirmation')
            },

            async destroyConfirm() {
                await this.$store.dispatch('people/destroy', this.people.id)
                this.$bvModal.hide('modal-destroy-confirmation')
            },

            reload() {
                this.$store.commit('people/cleanPeople')
                this.$store.commit('people/cleanResp')
                this.filterList()
            }
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
