<template>
    <div>
        <label v-if="label" :for="id">{{ label }}</label>
        <input 
            v-model="cep" 
            v-mask="'#####-###'" 
            @blur="consulta"
            @keydown.enter="consulta"
            type="text" 
            :id="id" 
            class="form-control form-control-sm"
            :class="classValidation"
            aria-describedby="validation-cep">
            <div id="validation-cep" class="invalid-feedback">
                CEP inválido
            </div>
    </div>
</template>

<script>
    export default {
        props: {
            id: null,
            label: null
        },

        data() {
            return {
                cep: null,
                error: false,
                ibge: {
                    cep: null,
                    district: null,
                    complement: null,
                    ddd: null,
                    gia: null,
                    ibge: null,
                    city: null,
                    address: null,
                    siafi: null,
                    uf: null,
                },
                classValidation: null
            }
        },

        methods: {
            async consulta() {
                await axios.get("https://viacep.com.br/ws/"+this.cep+"/json/")
                    .then((response)=>{
                        if (response.data.erro) {
                            this.error= true
                            this.classValidation= "is-invalid"
                            return false
                        }
                        
                        let x= response.data
                        this.ibge.cep= x.cep
                        this.ibge.district= x.bairro
                        this.ibge.complement= x.complemento
                        this.ibge.ddd= x.ddd
                        this.ibge.gia= x.gia
                        this.ibge.ibge= x.ibge
                        this.ibge.city= x.localidade
                        this.ibge.address= x.logradouro
                        this.ibge.siafi= x.siafi
                        this.ibge.uf= x.uf

                        this.classValidation= null
                        this.$emit('ibge', this.ibge)
                    })
                    .catch(()=>{
                        this.error= true
                        this.classValidation= "is-invalid"
                    })
            }
        },

        mounted() { }
    }
</script>
