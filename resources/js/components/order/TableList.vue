<template>
    <div>
        
        <div class="row">
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
                <button class="btn btn-sm btn-outline-primary container-fluid" @click="newOrder" >Novo</button>
            </div>
            
        </div>
        <br>

        <div class="row">
            <div class="col-sm">

                <table class="table table-striped table-sm">
                    <thead>
                        <th>ID</th>
                        <th>Solicitante</th>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Responsável</th>
                        <th>Data</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr v-for="(order, i) in list" :key="i">
                            <td class="d-flex bd-highlight">
                                <button class="btn btn-sm btn-outline-primary flex-fill bd-highlight" @click="view(order.id)">
                                    {{ order.id }}
                                </button>
                            </td>
                            <td>{{ order.people_request_first_name+" "+order.people_request_last_name }}</td>
                            <td>{{ order.location_origin_name }}</td>
                            <td>{{ order.location_destiny_name }}</td>
                            <td>{{ order.people_destiny_first_name+" "+order.people_destiny_last_name }}</td>
                            <td>{{ order.created_at }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
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

            </div>
        </div>

        <div class="row">
			<div class="col-sm-12">
				<c-alert dismissible="true" ></c-alert>
			</div>
		</div>

        <div>	
            <b-modal 
                id="modal-order-create" 
                title="Pedido"
                size="xl"
                button-size="sm"
                hide-footer>
                <c-order-form-local></c-order-form-local>
            </b-modal>
        </div>

        <div>
            <b-modal 
                id="modal-order-view"
                size="xl"
                button-size="sm"
                hide-footer
                hide-header>
                <c-order-form-view :order="order"></c-order-form-view>
            </b-modal>
        </div>

        <div>
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
</template>

<script>
export default {
    props: {
        inputSearch: { default: true }
    },

    data() {
        return {
            order: this.$store.state.order,
            word: null,
            list: null,
            modal: { msg: null },
            filterPaginate: null
        }
    },

    computed: {
        error() { return this.$store.state.order.error },
        resp() { return this.$store.state.order.error }
    },

    methods: {
        async filterList() {
            const resp= await this.$store.dispatch('order/search', { word: this.word })
            this.filterPaginate= resp
            this.list= this.filterPaginate.data
            this.list.forEach(e => {
                let created_at= new Date(e.created_at);
                e.created_at= (created_at.getDate() +"/"+ (created_at.getMonth()+1) +"/"+ created_at.getFullYear())
            });
        },

        async linkPage(param) {
            const resp= await this.$store.dispatch('order/search', {
                word: this.word,
                page: param
            })
            this.filterPaginate= resp
            this.list= this.filterPaginate.data
            this.list.forEach(e => {
                let created_at= new Date(e.created_at);
                e.created_at= (created_at.getDate() +"/"+ (created_at.getMonth()+1) +"/"+ created_at.getFullYear())
            });
        },

        async prevNextPage(param) {
            if (param) {
                param= new URL(param)
                let page= param.search.replace( /^\D+/g, '') //remove todos caracteres que não são numéricos
                const resp= await this.$store.dispatch('order/search', {
                    word: this.word,
                    page: page
                })
                this.filterPaginate= resp
                this.list= this.filterPaginate.data
                this.list.forEach(e => {
                    let created_at= new Date(e.created_at);
                    e.created_at= (created_at.getDate() +"/"+ (created_at.getMonth()+1) +"/"+ created_at.getFullYear())
                });
            }
        },

        newOrder() {
            this.$store.commit('order/cleanOrder')
            this.$store.commit('order/cleanResp')
            this.$bvModal.show('modal-order-create')
        },

        async view(id) {
            const order= await this.$store.dispatch('order/getById', { id: id })
            if (order.id) {
                this.$store.dispatch('order/loadInputs', order)
                this.$bvModal.show('modal-order-view')
            } else {
                this.modal.msg= order
                this.$bvModal.show('modal-msg')
            }
        },

        reload() {
            this.$store.commit('order/cleanOrder')
            this.$store.commit('order/cleanResp')
            this.filterList()
        },

        async teste() {
            const x= await this.$store.dispatch('location/search')
            console.log(x)
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
