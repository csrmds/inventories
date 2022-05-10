<template>
    <div>
        <div class="row">
            <div class="col-sm">
                <button class="btn btn-sm btn-outline-primary">Importar</button>
            </div>
            <div class="col-sm">
                <button class="btn btn-sm btn-outline-primary" @click="teste">Teste</button>
            </div>
            <div class="col-sm">
                <button class="btn btn-sm btn-outline-primary" @click="products">Products</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            location: null
        }
    },

    methods: {
        async teste() {
            const resp= await axios.get('/csv/import/locations')
            console.log(resp.data) 
        },

        async products() {
            const resp= await axios.get('/csv/import/products')
            console.log(resp.data)
        }
    },

    mounted() {
        console.log('Component mounted.')
    }
}
</script>
