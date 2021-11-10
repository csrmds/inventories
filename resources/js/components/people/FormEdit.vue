<template>
    <div class="container-fluid">
        <div class="form-row">
            <div class="col-sm-2">
                <label for="type">Tipo</label>
                <select name="type" id="type" class="form-control form-control-sm" v-model="people.type">
                    <option value="F">Física</option>
                    <option value="J">Jurídica</option>
                </select>

            </div>

            <div class="col-sm-3">
                <template v-if="people.type=='F'">
                    <label for="">Nome</label>
                    <input v-model="people.first_name" type="text" class="form-control form-control-sm">
                </template>
                <template v-else>
                    <label for="">Razão Social</label>
                    <input v-model="people.first_name" type="text" class="form-control form-control-sm">
                </template>

            </div>

            <div class="col-sm-2">
                <label for="">Categoria</label>
                <input v-model="people.category" type="text" class="form-control form-control-sm">
            </div>

            <div class="col-sm-2">
                <label for="">Nascimento</label>
                <input v-if="people.type=='F'" v-model="people.birth_date" type="text" class="form-control form-control-sm">
                <input v-else type="text" class="form-control form-control-sm" disabled>
            </div>

            <div class="col-sm-2">
                <template v-if="people.type=='F'">
                    <label for="">CPF</label>
                    <input v-model="people.cpf" type="text" class="form-control form-control-sm">
                </template>
                <template v-else>
                    <label for="">CNPJ</label>
                    <input v-model="people.cnpj" type="text" class="form-control form-control-sm">
                </template>
            </div>

        </div>

        <div class="form-row">
            <div class="col-sm-2">
                <label for="">CEP</label>
                <input v-model="people.zipcode" type="text" class="form-control form-control-sm">
            </div>

            <div class="col-sm-3">
                <label for="">Logradouro</label>
                <input v-model="people.address" type="text" class="form-control form-control-sm">
            </div>

            <div class="col-sm-1">
                <label for="">Número</label>
                <input v-model="people.number" type="text" class="form-control form-control-sm">
            </div>

            <div class="col-sm-2">
                <label for="">Complemento</label>
                <input v-model="people.complement" type="text" class="form-control form-control-sm">
            </div>

            <div class="col-sm-2">
                <label for="">Bairro</label>
                <input v-model="people.district" type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm-2">
                <label for="">Cidade</label>
                <input v-model="people.city" type="text" class="form-control form-control-sm">
            </div>

            <div class="col-sm-2">
                <label for="">UF</label>
                <select v-model="people.state" name="state" id="state" class="form-control form-control-sm">
                    <option v-for="(uf, i) in ufs" :key="i" :value="uf.uf">{{ uf.uf }}</option>
                </select>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm">
                <c-alert dismissible="true"></c-alert>
            </div>
        </div>
        <hr>


        <div class="row">
            <div class="col-sm-2">
                <button class="btn btn-sm btn-primary" @click="save">Salvar</button>
            </div>
        </div>


    </div>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required } from '@vuelidate/validators'

export default {
    props: {

    },

    data() {
        return {
            ufs: this.$store.state.ufs
        }
    },

    computed: {
        people() { return this.$store.state.people },
        error() { return this.$store.state.people.error },
        resp() { return this.$store.state.people.resp },
        alert() { return this.$store.state.alert }
    },

    mounted() {
        
    },

    methods: {
        async save() {
            if (this.people.id>0) {
                console.log("entrou no update: "+this.people.id)
                await this.$store.dispatch('people/update', this.people)
            } else {
                console.log("entrou no salvar: "+this.people.id)
                console.log(this.people)
                await this.$store.dispatch('people/save', this.people)
            }
            
        }
    },

    watch: {
        // error: function(newValue) {
        //     this.alert.msg= newValue
        //     this.alert.classType= "alert-danger"
        //     this.$store.dispatch('alert/showAlert', this.alert)
        // },

        // resp: function(newValue) {
        //     this.alert.msg= newValue
        //     this.alert.classType= "alert-info"
        //     this.$store.dispatch('alert/showAlert', this.alert)
        // },
    }
}
</script>
