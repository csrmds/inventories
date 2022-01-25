<template>
    <div>
        <div class="form-row">
            <div class="col-sm-1">
                <strong>ID: </strong>{{ order.id }}
            </div>
            <div class="col-sm">
                <strong>Tipo: </strong>{{ order.category }}
            </div>
            <div class="col-sm">
                <strong>Solicitante: </strong>{{ order.people_request_first_name+" "+order.people_request_last_name }}
            </div>
            <div class="col-sm">
                <strong>Data Mov: </strong>{{ null }}
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm">
                <strong>Empresa Origem: </strong>{{ order.location_origin_name }}
            </div>
            <div class="col-sm">
                <strong>Empresa Dest: </strong>{{ order.location_destiny_name }}
            </div>
        </div>
        <br>

        <div class="form-row">
            <div class="col-sm">
                <h4>Itens</h4>
                <table class="table table-sm table-striped table-borderless">
                    <thead>
                        <th>Patrimônio</th>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Responsável</th>
                        <th>Local</th>
                    </thead>
                    <tbody>
                        <tr v-for="(orderItem, i) in itemList" :key="i">
                            <td>{{ orderItem.product_property_id }}</td>
                            <td>{{ orderItem.product_name }}</td>
                            <td>{{ orderItem.product_manufacturer }}</td>
                            <td>{{ orderItem.people_first_name+" "+orderItem.people_last_name }}</td>
                            <td>{{ orderItem.location_name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        order: null,
    },

    data() {
        return {
            itemList: null    
        }
    },

    computed: {

    },

    methods: {
        async getOrderItems() {
            const resp= await this.$store.dispatch('orderItem/getByOrderId', this.order.id)
            console.log(resp)
            this.itemList= resp
        }
    },

    mounted() {
        this.getOrderItems()
    }
}
</script>
