<template>
    <div>
        <div class="form-row">
            <div class="col-sm-4">
                <c-autocomplete-axios 
                    label="Empresa" 
                    source="people/searchBy"
                    column="first_name"
                    @itemSelected="loadPeopleId($event)"
                    :class="validation.people_id.invalid ? 'is-invalid' : null"
                    aria-describedby="people-invalid">
                </c-autocomplete-axios>
                <div id="people-invalid" class="invalid-feedback">
                    {{ validation.people_id.msg }}
                </div>
                <input type="hidden" name="people_id" id="people_id"  v-model="location.people_id">
                <input type="hidden" name="location_id" id="location_id"  v-model="location.id">
            </div>
            
            <div class="col-sm-4">
                <label for="">Nome</label>
                <input 
                    v-model="location.name" 
                    type="text" 
                    :class="validation.name.invalid ? 'is-invalid' : null"
                    aria-describedby="name-invalid"
                    class="form-control form-control-sm">
                <div id="name-invalid" class="invalid-feedback">
                    {{ validation.name.msg }}
                </div>
            </div>

            <div class="col-sm-4">
                <label for="">Descrição</label>
                <input v-model="location.description" type="text" class="form-control form-control-sm">
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm">
                <c-alert dismissible="true" ></c-alert>
            </div>
        </div>

        <hr>
        
        <div class="row">
            <div class="col-sm-2">
                <button @click="validate" class="btn btn-sm btn-primary container-fluid">Salvar</button>
            </div>
        </div>
    </div>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required, requiredUnless } from '@vuelidate/validators'
import eventbus from '../eventbus'

export default {
    data() {
        return {
            validation: {
                name: {
                    msg: "Campo obrigatório",
                    invalid: false
                },
                people_id: {
                    msg: "Campo obrigatório",
                    invalid: false
                }
            }
        }
    },

    validations() {
        return {
            name: { required },
            people_id: { required }
        }
    },

    setup () {
		return { $v: useVuelidate() }
	},

    computed: {
        location() { return this.$store.state.location },
        name() { return this.location.name },
        people_id() { return this.location.people_id },
        error() { return this.$store.state.location.error },
        resp() { return this.$store.state.location.resp },
        alert() { return this.$store.state.alert }
    },

    

    methods: {
        async validate() {
            this.$v.$touch()
            if (this.$v.$invalid) {
                this.$v.people_id.$invalid ? this.validation.people_id.invalid= true : this.validation.people_id.invalid= false
                this.$v.name.$invalid ? this.validation.name.invalid= true : this.validation.name.invalid= false
                return false
            }

            this.validation.people_id.invalid= false
            this.validation.name.invalid= false
            const save= await this.save()
            if (save.data.id>0) {
                console.log('save.data: ')
                console.log(save.data)
                this.cleanInputs()
                eventbus.$emit('cleanAutocomplete')
            } else {
                this.alert.msg= save.data
                this.$store.dispatch('alert/showAlert', this.alert)
            }
        },

        async save() {
            if (this.location.id==null) {
                const resp= await axios.post('location/save', { location: this.location })
                return resp
            } else {
                const resp= await axios.post('location/update', { location: this.location })
                return resp
            }
            
        },

        loadPeopleId(param) {
            console.log("loadPeopleId: "+param.id)
            console.log(param)
            this.location.people_id= param.id
        },

        cleanInputs() {
            this.location.id= null
            this.location.people_id= null
            this.location.name= null
            this.location.description= null
            this.location.created_at= null
            this.location.updated_at= null
        },

        async loadAutocomplete() {
            const people= await this.$store.dispatch('people/getById', this.location.people_id)
            console.log(people)
            eventbus.$emit('loadAutocomplete', people)
        }
    },

    mounted() {
        if (this.location.id!=null) {
            this.loadAutocomplete()
        }
    },

    watch: {
        error: function(newValue) {
			this.alert.msg= newValue
			this.alert.classType= "alert-danger"
			this.$store.dispatch('alert/showAlert', this.alert)
		},

		resp: function(newValue) {
            console.log("ouviu mudança no resp")
			this.alert.msg= newValue
			this.alert.classType= "alert-info"
			this.$store.dispatch('alert/showAlert', this.alert)
		}
    }
}
</script>
