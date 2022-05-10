<template>
    <div>
        <div class="row">
            <div class="col-sm-9">
                <button class="btn btn-sm btn-outline-secondary" @click="loadList">Teste</button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">

                <table class="table table-striped table-sm">
                    <thead>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>SN</th>
                        <th>Patrimonio</th>
                        <th>Status</th>
                        <th>LocalizaçãoID</th>
                    </thead>

                    <tbody>
                        <tr v-for="(product, i) in products" :key="i">
                            <td>{{ product.name }}</td>
                            <td>{{ product.type }}</td>
                            <td>{{ product.brand }}</td>
                            <td>{{ product.model }}</td>
                            <td>{{ product.sn }}</td>
                            <td>{{ product.property_id }}</td>
                            <td>{{ product.status }}</td>
                            <td>{{ product.location_id }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: null
        }
    },

    methods: {
        async loadList() {
            const resp= await axios.get('/csv/import/products')
            console.log(resp.data)
            this.products= resp.data
        }
    },

    mounted() {
        
    }
}
</script>
