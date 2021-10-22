<template>
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-sm-2">
				<!-- <label for="property">Patrimônio</label>
				<input type="text" name="property" id="property" class="form-control input-text"> -->
				<c-autocomplete 
					id="property" 
					label="Patrimonio" 
					source="product/searchBy" 
					column="property_id"
					:callback="getInputs"
				>	
				</c-autocomplete>
				<input type="hidden" id="product_id" v-model="product.id">
			</div>

			<div class="col-sm-2">
				<c-select label="Tipo" name="type" :options="type" :option_selected="product.type"></c-select>
			</div>
			
			<div class="col-sm">
				<label for="description">Descrição</label>
				<input v-model="product.description" type="text" id="description" name="description" class="form-control input-text">
			</div>
			
			<div class="col-sm">
				<label for="category">Categoria</label>
				<input v-model="product.category" type="text" name="category" id="category" class="form-control input-text">
			</div>

			<div class="col-sm">
				<label for="brand">Marca</label>
				<input v-model="product.brand" type="text" name="brand" id="brand" class="form-control input-text">
			</div>

		</div>

		<div class="row">

			<div class="col-sm">
				<label for="model">Modelo</label>
				<input v-model="product.model" type="text" name="model" id="model" class="form-control input-text">
			</div>

			<div class="col-sm">
				<label for="sn">SN</label>
				<input v-model="product.sn" type="text" name="sn" id="sn" class="form-control input-text">
			</div>

			<div class="col-sm-1">
				<c-select v-model="product.um" label="UM" :options="um" :option_selected="product.um" ></c-select>
			</div>

			<div class="col-sm-2">
				<label for="location">Localização</label>
				<select v-model="teste" name="location" id="location" class="form-control">
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
				<input v-model="product.people" type="text" name="people" id="people" class="form-control">
			</div>

		</div>

		<div class="row">
			<div class="col-sm-3">
				<label for="ocs">OCS ID</label>
				<div class="input-group">
					<input type="text" name="product-find" class="form-control input-control input-sm" placeholder="Busca">
					<div class="input-group-append">
						<button class="btn btn-secondary">OCS</button>
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<label for="">input teste</label>
				<input type="text" name="texto" id="text_id" data-id="val_data_id" value="valor_do_input" class="form-control">
			</div>
		</div>

		<hr>
		<div class="row">
			<div class="col-sm-2">
				<button class="btn btn-success container-fluid">Salvar</button>
			</div>

			<div class="col-sm-3">
				<button class="btn btn-info">Salvar e add novo</button>
			</div>

			<div class="col-sm-2">
				<button class="btn btn-info" @click="teste4()">teste select</button>
			</div>
			
			<div class="col-sm-2">
				
			</div>

		</div>
		<br>

		<div class="row">
			<div class="alert" id="response-msg">
				<p></p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				
				<c-autocomplete label="Usuarios" source="user/search"></c-autocomplete>	
			</div>
			
		</div>

		<div class="row">
			<div class="col-sm-3">
				
			</div>
			
		</div>
		
	</div>
	
</template>

<script>

	export default {
		props: {
			type: { type: String },
			um: { type: String }
		},

		data() {
			return {
				product: this.$store.state.product,
				text: this.$store.state.product.resp,
				indexList: -1,
				loadInputs: {
					route: 'product/setProduct',
					method: 'setProduct'
				},
				teste: null,
			}
		},

		computed: {
			
		},

		methods: {
			async getType() {
				const resp= await this.$store.dispatch('group/getByTable', 'product_type')
				this.type= resp.data
			},

			async getUm() {
				const resp= await this.$store.dispatch('group/getByTable', 'product_um')
				this.um= resp.data
			},

			// teste() {
			// 	let cesar= document.querySelectorAll("[data-id='val_data_id']")
			// 	console.log(cesar[0].getAttribute('value'))
			// 	console.log(cesar[0].scrollHeight)
			// },
			teste2() {
				let cesar= {
					var01: "opa",
					var02: "eita"
				};
				this.$store.dispatch('product/searchBy', cesar)
				//console.log(this.type)
			},

			teste4() {
				this.teste="SERVIÇO"
			},

			getInputs() {
				console.log("chamando funcção doida aqui...")
			}

		},

		mounted() {
			
		},

		watch: {
			
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