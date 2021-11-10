<template>
    <div>
        
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
        //map aplica uma função em um array
        testeMap() {
            this.grupo.map(function(item) {
                //codigo da função
                console.log(item)
            })
        },

        //filter aplica filtro no array retornando verdadeiro ou falso com a função aplica
        testeFilter() {
            this.grupo.filter(function(item, i) {
                //se atender condição adicionar a outro array
                console.log(i)
                console.log(item)
            })
        },
    }

    }
</script>






