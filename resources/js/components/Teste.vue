<template>
    <div>
        <div class="form-row">
            <div class="col-sm-4">
                <label for="">Input Label</label>
                <input 
                    v-model="cValue"
                    autocomplete="false"
                    type="text"
                    name="campo-teste"
                    class="form-control form-control-sm">
            </div>

            <div class="col-sm-2">
                <label for="">savar</label><br>
                <button class="btn btn-sm btn-dark" @click="save" >Salvar</button>
            </div>
        </div>


        <div class="form-row">
            <div class="col-sm-4">
                <label for="">input</label>
                <input type="text" class="form-control form-control-sm" placeholder="teste">

            </div>
            <div class="col-sm-2">
                <label for="btn">&nbsp;x</label><br>
                <button id="btn" class="btn btn-sm btn-outline-secondary" @click="createUser">Teste</button>
            </div>
        </div>
        

    </div>
</template>

<script>
export default {
    props: {
        value: null
    },

    data() {
        return {
            word: "",
            product: this.$store.state.product,
            list: null
        }
    },

    computed: {
        cValue() { return this.value }
    },

    methods: {

        async save(e) {
            e.preventDefault()
            console.log(this.cValue)
            // const x= await this.$store.dispatch('product/save', this.product )
            // console.log(x)
        },

        async loadList(e) {
            e.preventDefault()
            const resp= await this.$store.dispatch('product/getGroups')
            this.list= resp.categoryList
        },

        async createUser(e) {
            e.preventDefault()
            const resp= await axios.post('/teste/teste')
            console.log(resp)
        }

    },


    mounted() {
        this.loadList()
    }

}
</script>






