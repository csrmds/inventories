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
                        <th>PedidoID</th>
                        <th>Patrimônio</th>
                        <th>Tipo Prod.</th>
                        <th>Fabricante</th>
                        <th>Localização</th>
                        <th>Responsável</th>
                    </thead>

                    <tbody>
                        <tr v-for="(orderItem, i) in list" :key="i">
                            <td class="d-flex bd-highlight">
                                <button class="btn btn-sm btn-outline-primary flex-fill bd-highlight" @click="orderView(orderItem.order_id)">
                                    {{ orderItem.order_id }}
                                </button>
                            </td>
                            <td>
                                <a href="#" @click="productView(orderItem.product_id)">{{ orderItem.product_property_id }}</a>
                            </td>
                            <td>{{ orderItem.product_type }}</td>
                            <td>{{ orderItem.product_manufacturer }}</td>
                            <td>{{ orderItem.location_name }}</td>
                            <td>{{ orderItem.people_first_name+" "+orderItem.people_last_name }}</td>
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

        <div>
            <b-modal
                id="modal-product-view"
                title="Produto"
                size="xl"
                button-size="sm"
                hide-footer
                hide-header>
                <c-product-form-view :prp-product="product"></c-product-form-view>
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
        
    </div>
</template>

<script>
export default {
    props: {
        inputSearch: { default: true }
    },

    data() {
        return {
            word: null,
            list: null,
            modal: { msg: null },
            filterPaginate: null
        }
    },

    computed: {
        order() { return this.$store.state.order },
        product() { return this.$store.state.product },
        ocsHardware() { return this.$store.state.ocsHardware }
    },

    methods: {
        async filterList() {
            const resp= await this.$store.dispatch('orderItem/search', { word: this.word })
            this.filterPaginate= resp
            this.list= this.filterPaginate.data
        },

        async linkPage(param) {
            const resp= await this.$store.dispatch('orderItem/search', {
                word: this.word,
                page: param
            })
            this.filterPaginate= resp
            this.list= this.filterPaginate.data
        },

        async prevNextPage(param) {
            if (param) {
                param= new URL(param)
                let page= param.search.replace( /^\D+/g, '') //remove todos caracteres que não são numéricos
                const resp= await this.$store.dispatch('orderItem/search', {
                    word: this.word,
                    page: page
                })
                this.filterPaginate= resp
                this.list= this.filterPaginate.data
            }
        },

        async orderView(id) {
            const order= await this.$store.dispatch('order/getById', { id: id })
            if (order.id) {
                this.$store.dispatch('order/loadInputs', order)
                this.$bvModal.show('modal-order-view')
            } else {
                this.modal.msg= order
                this.$bvModal.show('modal-msg')
            }
        },

        async productView(product_id) {
            this.$store.commit('product/cleanProduct')
            this.$store.commit('product/cleanResp')
            const resp= await this.$store.dispatch('product/getById', product_id)
            this.$store.commit('product/setProduct', resp)  
            this.$bvModal.show('modal-product-view')
        },

        newOrder() {
            this.$store.commit('order/cleanOrder')
            this.$store.commit('order/cleanResp')
            this.$bvModal.show('modal-order-create')
        },

        reload() {
            this.$store.commit('order/cleanOrder')
            this.$store.commit('order/cleanResp')
            this.filterList()
        },
    },

    mounted() {
        this.filterList()
    },
    
}
</script>
