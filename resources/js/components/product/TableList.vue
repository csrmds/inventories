<template>
    <div>
        <div v-if="inputSearch" class="row">
            <div class="col-sm-9 input-group">
                <input 
                    v-model="word"
                    @keydown.enter="filterList"
                    type="text"
                    class="form-control form-control-sm"
                    placeholder="Busca">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-outline-secondary container-fluid" @click="filterList">Filtrar</button>
                </div>
            </div>

            <div class="col-sm">
                <button class="btn btn-sm btn-outline-primary container-fluid" @click="newProduct">Novo</button>
            </div>
        </div>
        <br>
        

        <div class="row">
            <div class="col-sm">

                <table class="table table-striped table-sm">
                    <thead>
                        <th>Id</th>
                        <th>Patrimonio</th>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>Modelo</th>
                        <th>Localização</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr v-for="(product, i) in list" :key="i">
                            <td>{{ product.id }}</td>
                            <td>{{ product.property_id }}</td>
                            <td>{{ product.type }}</td>
                            <td>{{ product.name }}</td>
                            <td>{{ product.model }}</td>
                            <td>{{ product.location_name }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" @click="edit(product.id)">Editar</button>
                                <button class="btn btn-sm btn-outline-danger" @click="destroy(product)">Deletar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <br>

        <nav v-if="filterPaginate">
            <ul class="pagination justify-content-center">
                <span v-for="(page, i) in filterPaginate.links" :key="i">
                    <li v-if="page.label=='pagination.previous'">
                        <a href="#" @click="prevNextPage(page.url)" class="page-link">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only"></span>
                        </a>
                    </li>
                    <li v-else-if="page.label=='pagination.next'">
                        <a href="#" @click="prevNextPage(page.url)" class="page-link" :class="!page.url ? 'disabled' : null ">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only" ></span>
                        </a>
                    </li>
                    <li v-else :class="page.active ? 'page-item active' : 'page-item'">
                        <a
                            class="page-link" 
                            @click="linkPage(page.label)"
                            href="#">
                            {{page.label}}
                        </a>
                    </li>
                </span>
            </ul>
        </nav>


        <div class="row">
			<div class="col-sm-12">
				<c-alert dismissible="true" ></c-alert>
			</div>
		</div>


        <div class="row">
            <div class="col-sm">	
				<b-modal 
					id="modal-product-edit" 
					title="Produto"
					size="xl"
                    button-size="sm"
                    hide-footer>
                    <c-product-form-create 
                        :category-list="categoryList"
                        :type-list="typeList"
                        :um-list="umList"
                        :location-list="locationList"
                    />
				</b-modal>
			</div>

            <div class="col-sm">
                <b-modal 
					id="modal-destroy-confirmation" 
					size="sm"
                    button-size="sm"
                    hide-header>
                    <p>Deseja realmente deletar o seguinte registro?</p> 
                    <strong>{{ "ID: "+product.id }} {{ product.description }}</strong>
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
        inputSearch: { default: true }
    },

    data() {
        return {
            product: this.$store.state.product,
            word: null,
            list: null,
            modal: { msg: null },
            filterPaginate: null,
            typeList: null,
            umList: null,
            categoryList: null,
            locationList: null
        }
    },

    computed: {
        error() { return this.$store.state.product.error },
        resp() { return this.$store.state.product.resp }
    },

    methods: {
        async filterList() {
            const resp= await this.$store.dispatch('product/search', {word: this.word})
            this.filterPaginate= resp.data
            this.list= this.filterPaginate.data
        },

        async linkPage(param) {
            const resp= await this.$store.dispatch('product/search', {
                word: this.word,
                page: param
            })
            this.filterPaginate= resp.data
            this.list= this.filterPaginate.data
        },

        async prevNextPage(param) {
            if (param) {
                param= new URL(param)
                let page= param.search.replace( /^\D+/g, '') //remove todos caracteres que não são numéricos
                const resp= await this.$store.dispatch('product/search', {
                    word: this.word,
                    page: page
                })
                this.filterPaginate= resp.data
                this.list= this.filterPaginate.data
            }
        },

        async edit(id) {
            const product= await this.$store.dispatch('product/getById', id)
            console.log("edit...")
            console.log(product)
            if (product.id) {
                this.$store.dispatch('product/loadInputs', product)
                this.$bvModal.show('modal-product-edit')
            } else {
                this.modal.msg= product
                this.$bvModal.show('modal-msg')
            }
        },

        newProduct() {
            this.$store.commit('product/cleanProduct')
            this.$store.commit('product/cleanResp')
            this.$bvModal.show('modal-product-edit')
        },

        destroy(param) {
            this.product= param
            this.$bvModal.show('modal-destroy-confirmation')
        },

        async destroyConfirm() {
            await this.$store.dispatch('product/destroy', this.product.id)
            this.$bvModal.hide('modal-destroy-confirmation')
        },

        async getGroups() {
            const groups= await this.$store.dispatch('product/getGroups')
            this.typeList= JSON.stringify(groups.typeList)
            this.umList= JSON.stringify(groups.umList)
            this.categoryList= JSON.stringify(groups.categoryList)
            this.locationList= JSON.stringify(groups.locationList)
        },
        

        reload() {
            this.$store.commit('product/cleanProduct')
            this.$store.commit('product/cleanResp')
            this.filterList()
        }
    },

    mounted() {
        this.filterList()
        this.getGroups()
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
