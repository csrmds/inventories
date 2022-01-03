<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h4>Produto</h4>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <th>Nome</th>
                            <td>{{ product.name }}</td>
                        </tr>
                        <tr>
                            <th>Patrimonio</th>
                            <td>{{ product.property_id }}</td>
                        </tr>
                        <tr>
                            <th>Marca</th>
                            <td>{{ product.manufacturer }}</td>
                            <th>Modelo</th>
                            <td>{{ product.model }}</td>
                        </tr>
                        <tr>
                            <th>SN</th>
                            <td>{{ product.sn }}</td>
                        </tr>
                        <tr>
                            <th>Local Atual</th>
                            <td>{{ product.location }}</td>
                        </tr>
                        <tr>
                            <th>Responsável Atual</th>
                            <td>{{ product.people }}</td>
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
            x: null
        }
    },

    computed: {
        people() { return this.$store.state.people },
        product() { return this.$store.state.product }
    },

    methods: {

    },

    mounted() {
        
    }
}
</script>


<style scoped>
thead {
    float: left
}

thead th {
    display: block
}

tbody {
    float: left
}

.card-body {
    padding: 10px
}
</style>