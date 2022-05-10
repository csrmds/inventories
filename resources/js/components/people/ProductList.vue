<template>
    <div class="container-fluid">
        <table class="table table-striped table-sm">
            <thead>
                <th>Patrimonio</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>SN</th>
                <th>OCS</th>
                <th>Localização</th>
                <th>Pedido</th>
            </thead>
            <tbody>
                <tr v-for="(product, i) in productList" :key="i">
                    <td>{{ product.property_id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.brand }}</td>
                    <td>{{ product.model }}</td>
                    <td>{{ product.sn }}</td>
                    <td>{{ product.ocs_hw_id }}</td>
                    <td>{{ product.location_name }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        peopleId: null
    },

    data() {
        return {
            productList: [],
            x: null
        }
    },

    methods: {
        async getProducts(param) {
            const resp= await this.$store.dispatch('product/searchByPeopleId', param)
            console.log("getProducts")
            console.log(resp)
            if (resp.length>0) {
                this.productList= resp
            }
        }
    },

    mounted() {
        this.getProducts(this.peopleId)
    }
}
</script>
