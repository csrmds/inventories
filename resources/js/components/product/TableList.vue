<template>
    <div>
        <div v-if="inputSearch" class="row">
            <div class="col-sm-9 input-group">
                <input 
                    v-model="word"
                    @keydown.enter="filterList"
                    type="text"
                    class="form-control form-control-sm"
                    placeholder="busca">
                <div class="input-group-apped">
                    <button class="btn btn-sm btn-outline-primary container-fluid" @click="filterList">Filtrar</button>
                </div>
            </div>

            <div class="col-sm">
                <button class="btn btn-sm btn-outline-primary container-fluid" @click="newProduct">Novo</button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">

                <table class="table table-striped table-sm">
                    <thead>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ product.id }}</td>
                            <td>{{ product.type }}</td>
                            <td>{{ product.description }}</td>
                            <td>{{ product.brand }}</td>
                            <td>{{ product.model }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" @click="edit(product.id)"></button>
                                <button class="btn btn-sm btn-outline-danger" @click="destroy(product)"></button>
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
					<c-product-form-create></c-product-form-create>
				</b-modal>
			</div>

            <div class="col-sm">
                <b-modal 
					id="modal-destroy-confirmation" 
					size="sm"
                    button-size="sm"
                    hide-header>
                    <p>Deseja realmente deletar o seguinte registro?</p> 
                    <strong>{{ "ID: "+product.id+" " }} {{ product.description }}</strong>
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
        inputeSearch: true
    },

    data() {
        return {
            product: this.$store.state.product,
            word: null,
            list: null,
            modal: { msg: null },
            filterPaginate: null
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
        }
    },

    mounted() {
        
    }
}
</script>
