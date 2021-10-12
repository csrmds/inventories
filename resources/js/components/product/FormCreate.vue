<template>
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-sm-2">
				<!-- <label for="property">Patrimônio</label>
				<input type="text" name="property" id="property" class="form-control input-text"> -->
				<c-autocomplete label="Patrimonio" source="product/searchBy" column="property_id"></c-autocomplete>
			</div>

			<div class="col-sm-2">
				<c-select label="Tipo" :options="type"></c-select>
			</div>
			
			<div class="col-sm">
				<label for="description">Descrição</label>
				<input type="text" id="description" name="description" class="form-control input-text">
			</div>
			
			<div class="col-sm">
				<label for="category">Categoria</label>
				<input type="text" name="category" id="category" class="form-control input-text">
			</div>

			<div class="col-sm">
				<label for="brand">Marca</label>
				<input type="text" name="brand" id="brand" class="form-control input-text">
			</div>

		</div>

		<div class="row">

			<div class="col-sm">
				<label for="model">Modelo</label>
				<input type="text" name="model" id="model" class="form-control input-text">
			</div>

			<div class="col-sm">
				<label for="sn">SN</label>
				<input type="text" name="sn" id="sn" class="form-control input-text">
			</div>

			<div class="col-sm-1">
				<c-select label="UM" :options="um" ></c-select>
			</div>

			<div class="col-sm-2">
				<label for="location">Localização</label>
				<select name="location" id="location" class="form-control">
					<option value="">DEPOSITO</option>
					<option value="">ESCRITORIO</option>
					<option value="">SALA TECNICA 01</option>
				</select>
			</div>

			<div class="col-sm">
				<label for="people">Responsável</label>
				<input type="text" name="people" id="people" class="form-control">
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
				<button class="btn btn-info" @click="teste2()">teste2</button>
			</div>
			
			<div class="col-sm-2">
				<!-- <c-select label="Select" :options="selectArray" ></c-select> -->
			</div>

		</div>
		<br>

		<div class="row">
			<div class="alert" id="response-msg">

			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<c-autocomplete label="Usuarios" source="user/search"></c-autocomplete>	
			</div>
			
		</div>
		
	</div>
	
</template>

<script>

	export default {
		props: {
			type: { type: String	},
			um: { type: String }
		},

		data() {
			return {
				product: this.$store.state.product,
				text: this.$store.state.product.resp,
				indexList: -1,
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

			teste() {
				let cesar= document.querySelectorAll("[data-id='val_data_id']")
				console.log(cesar[0].getAttribute('value'))
				console.log(cesar[0].scrollHeight)
			},
			teste2() {
				let cesar= {
					var01: "opa",
					var02: "eita"
				};
				this.$store.dispatch('product/searchBy', cesar)
				//console.log(this.type)
			},

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