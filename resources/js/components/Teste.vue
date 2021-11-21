<template>
    <div>
        <div class="form-row">
            <div class="col-sm">
                <label for="">Input Label</label>
                <input 
                    v-model="cValue"
                    autocomplete="false"
                    type="text"
                    name="campo-teste"
                    class="form-control form-control-sm">
            </div>

            <div class="col-sm">
                <label for="">savar</label><br>
                <button class="btn btn-sm btn-dark" @click="save" >Salvar</button>
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

        async loadList() {
            const resp= await this.$store.dispatch('product/getGroups')
            this.list= resp.categoryList
        }

    },


    mounted() {
        this.loadList()
    }

}
</script>






