<template>
	<div class="container-fluid" >
		<div class="form-row">
			
			<div class="col-sm-2" >
				<c-autocomplete 
					id="property" 
					label="Patrimonio" 
					source="product/searchBy" 
					column="property_id"
					@itemSelected="autoComplete($event)"
				>	
				</c-autocomplete>
				<input type="hidden" id="product_id" v-model="product.id" >
			</div>

			<div class="col-sm-2">
				<label for="type">Tipo</label>
				<select 
					v-model="product.type"
					name="type" 
					id="type" 
					class="form-control form-control-sm" 
					:class="validation.type.invalid ? 'is-invalid' : null"
					aria-describedby="type-invalid">
					<option v-for="(option, i) in JSON.parse(pType)" :key="i">{{ option.name }}</option>
				</select>
				<div id="type-invalid" class="invalid-feedback">
					{{ validation.type.msg }}
				</div>
			</div>
			
			<div class="col-sm">
				<label for="description">Descrição</label>
				<input 
					v-model="product.description" 
					type="text" 
					id="description" 
					name="description" 
					:class="validation.description.invalid ? 'is-invalid' : null "
					class="form-control form-control-sm input-text"
					aria-describedby="description-invalid">
				<div id="description-invalid" class="invalid-feedback">
					{{ validation.description.msg }}
				</div>
			</div>
			
			<div class="col-sm">
				<label for="category">Categoria</label>
				<input v-model="product.category" type="text" name="category" id="category" class="form-control form-control-sm input-text">
				
			</div>

			<div class="col-sm">
				<label for="brand">Marca</label>
				<input v-model="product.brand" type="text" name="brand" id="brand" class="form-control form-control-sm input-text">
			</div>

		</div>

		<div class="form-row">

			<div class="col-sm">
				<label for="model">Modelo</label>
				<input v-model="product.model" type="text" name="model" id="model" class="form-control form-control-sm input-text">
			</div>

			<div class="col-sm">
				<label for="sn">SN</label>
				<input v-model="product.sn" type="text" name="sn" id="sn" class="form-control form-control-sm input-text">
			</div>

			<div class="col-sm-1">
				<label for="um">UM</label>
				<select v-model="product.um"  name="um" id="um" class="form-control form-control-sm">
					<option v-for="(option, i) in JSON.parse(pUm)" :key="i">{{ option.name }}</option>
				</select>
			</div>

			<div class="col-sm-2">
				<label for="location">Localização</label>
				<select name="location" id="location" class="form-control form-control-sm">
					<option value="DEPOSITO">DEPOSITO</option>
					<option value="ESCRITORIO">ESCRITORIO</option>
					<option value="SALA01">SALA01</option>
					<option value="SALA02">SALA02</option>
					<option value="SALA03">SALA03</option>
					<option value="SALA04">SALA04</option>
				</select>
			</div>

			<div class="col-sm">
				<label for="people">Responsável</label>
				<input v-model="product.people" type="text" name="people" id="people" class="form-control form-control-sm">
			</div>

		</div>
		<br/>


		<div class="form-row">
			<div class="col-sm-6">
				<c-ocs-card-info :ocshardware="ocshardware"></c-ocs-card-info>
			</div>
		</div>

		<hr>

		<form>
		<div class="row">
			<div class="col-sm-2">
				<button type="submit" class="btn btn-sm btn-success container-fluid" @click="validate" >Salvar</button>
			</div>

			<!-- <div class="col-sm-2">
				<button type="submit" class="btn btn-sm btn-success container-fluid" @click="teste">teste</button>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-sm btn-outline-success container-fluid" @click="teste2">teste2</button>
			</div> -->
		</div>
		</form>
		

		<div class="form-row">
			<div class="col-sm-6">	
				<b-modal 
					id="modal-ocs-search" 
					title="OCS Inventory"
					size="xl">
					<c-ocs-form-search></c-ocs-form-search>
				</b-modal>
			</div>
		</div>
		<br>

		<div class="row">
			<div class="col-sm-12">
				<c-alert dismissible="true" ></c-alert>
			</div>
		</div>
		
	</div>
	
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required, email } from '@vuelidate/validators'
import eventbus from '../eventbus'

export default {
	props: {
		pType: { type: String },
		pUm: { type: String }
	},

	setup () {
		return { $v: useVuelidate() }
	},

	data() {
		return {
			product: this.$store.state.product,
			indexList: -1,
			loadInputs: {
				route: 'product/setProduct',
				method: 'setProduct'
			},
			
			validation: {
				type: {
					msg: "Campo obrigatório",
					invalid: false
				},
				description: {
					msg: "Campo obrigatório",
					invalid: false
				}
			}
		}
	},

	validations() {
		return {
			type: { required },
			description: { required }
		}
	},

	computed: {
		error() { return this.$store.state.product.error },
		resp() { return this.$store.state.product.resp },
		ocshardware() { return this.$store.state.ocsHardware },
		ocsHardwareId() { return this.$store.state.ocsHardware.id },
		productId() { return this.product.id },
		description() { return this.product.description },
		type() { return this.product.type },
		alert() { return this.$store.state.alert }
	},

	created() {
		//atualiza "TYPE" via evento enviado pelo componente select
		eventbus.$on('select_type', payload => {
			this.product.type= payload
		}),

		//atualiza "UM" via evento enviado pelo componente select
		eventbus.$on('select_um', payload => {
			this.product.um= payload
		})
	},

	methods: {

		async save(event) {
			event.preventDefault()
			if (this.product.id>0) {
				return await this.$store.dispatch('product/update', this.product)
			} else {
				return await this.$store.dispatch('product/save', this.product)
			}
		},

		modalOcsSearch(event) {
			this.$bvModal.show('modal-ocs-search')
			event.preventDefault()
		},

		async validate(event) {
			event.preventDefault()
			this.$v.$touch()
			if (this.$v.$invalid) {
				//console.log("entrou na validação..")
				this.$v.description.$invalid ? this.validation.description.invalid= true : this.validation.description.invalid= false
				this.$v.type.$invalid ? this.validation.type.invalid= true : this.validation.type.invalid= false
				return false
			}

			this.validation.description.invalid= false
			this.validation.type.invalid= false
			this.save(event)
		},

		autoComplete(param) {
			if (param) {
				this.$store.dispatch('product/loadInputs', param)
			} else {
				this.$store.commit('product/cleanProduct')
			}
		}
	},

	mounted() {
		
	},

	watch: {
		error: function(newValue) {
			this.alert.msg= newValue
			this.alert.classType= "alert-danger"
			this.$store.dispatch('alert/showAlert', this.alert)
		},

		resp: function(newValue) {
			this.alert.msg= newValue
			this.alert.classType= "alert-info"
			this.$store.dispatch('alert/showAlert', this.alert)
		},

		ocsHardwareId: function(newValue) { this.product.ocs_hw_id= newValue },

		productId: async function(newValue) {
			if (this.product.ocs_hw_id!=null) {
				const resp= await this.$store.dispatch('ocsHardware/searchById', this.product.ocs_hw_id)
				this.$store.commit('ocsHardware/setOcsHardware', resp.data)
			} else {
				this.$store.commit('ocsHardware/cleanOcsHardware')
			}
		}
	},

}
</script>


<style scoped>

.ul-teste {
	padding: 0;
	margin: 0;
	border: 1px solid #eeeeee;
	height: 150px;
	min-height: 1em;
	/*max-height: 6em;*/
	overflow: auto;
}

.li-teste {
	list-style: none;
	text-align: left;
	padding: 4px 2px;
	cursor: pointer;
	height: 30px;
}

.li-teste.is-active,
.li-teste:hover {
	background-color: #4aae9b;
	color: white;
}

</style>