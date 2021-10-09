<template>
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-sm-2">
				<label for="type">Tipo</label>
				<select name="type" id="type" class="form-control">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
				</select>
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

			<div class="col-sm">
				<label for="model">Modelo</label>
				<input type="text" name="model" id="model" class="form-control input-text">
			</div>

		</div>

		<div class="row">

			<div class="col-sm">
				<label for="property">Patrimônio</label>
				<input type="text" name="property" id="property" class="form-control input-text">
			</div>

			<div class="col-sm">
				<label for="sn">SN</label>
				<input type="text" name="sn" id="sn" class="form-control input-text">
			</div>

			<div class="col-sm-1">
				<label for="um">UM</label>
				<select name="um" id="um" class="form-control">
					<option value="">UN</option>
					<option value="">PC</option>
				</select>
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
				<c-input-list></c-input-list>
			</div>
		</div>

		<hr>
		<div class="row">
			<!-- <div class="col-sm-2">
				<button class="btn btn-success container-fluid">Salvar</button>
			</div>

			<div class="col-sm-3">
				<button class="btn btn-info">Salvar e add novo</button>
			</div> -->

			<div class="col-sm-2">
				<button class="btn btn-info" @click="teste()">teste</button>
			</div>

			<div class="col-sm-3">
				<ul class="ul-teste" id="ul-teste">
					<li 
						v-for="(item, i) in list" 
						:key=i class="li-teste" 
						:class="{'is-active': i==indexList}"
						:id="'list_'+i"
						>
						{{ item }}
					</li>
				</ul>
			</div>

			<div class="col-sm-2">
				<button class="btn btn-warning" @click="desce">+</button>
				<button class="btn btn-info" @click="sobe">-</button>
			</div>

			<div class="col-sm-2">
				<select class="form-control list-opt-group">
						<option class="list-opt" id="o1">O1</option>
						<option class="list-opt" id="o2">O2</option>
						<option class="list-opt" id="o3">O3</option>
						<option class="list-opt" id="o4">O4</option>
						<option class="list-opt" id="o5">O5</option>
						<option class="list-opt" id="o6">O6</option>
						<option class="list-opt" id="o7">O7</option>
						<option class="list-opt" id="o8">O8</option>
						<option class="list-opt" id="o9">O9</option>
						<option class="list-opt" id="o10">10</option>
						<option class="list-opt" id="o11">11</option>
						<option class="list-opt" id="o12">12</option>
						<option class="list-opt" id="o13">13</option>
						<option class="list-opt" id="o14">14</option>
						<option class="list-opt" id="o15">15</option>
						<option class="list-opt" id="o16">16</option>
				</select>

			</div>

		</div>
		<br>

		<div class="row">
			<div class="alert" id="response-msg">

			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<c-autocomplete></c-autocomplete>	
			</div>
			
		</div>
		
	</div>
	
</template>

<script>

	export default {
		data() {
			return {
				product: this.$store.state.product,
				text: this.$store.state.product.resp,
				indexList: -1,
				list: ['ovo', 'abacaxi', 'jaca', 'melão', 'groselha', 'maracuja', 'chocolate', 'mostarda', 'pink', 'jujuba'],
				//listHeight: 150,
				bola: 'aff'

			}
		},

		computed: {
			teste2() { return this.$store.state.product.resp }
		},

		methods: {
			teste() {
				//console.log($("#list_6"))
				$("#list_6")[0].classList.add("is-active")
				$("#list_6")[0].scrollIntoViewIfNeeded(false)
			},

			desce() {
				this.indexList<9 ? this.indexList++ : false
				console.log(this.indexList)
				$("#list_"+this.indexList)[0].classList.add("is-active")
				$("#list_"+this.indexList)[0].scrollIntoViewIfNeeded(false)	
			},

			sobe() {
				this.indexList>0 ? this.indexList-- : false
				console.log(this.indexList)
				$("#list_"+this.indexList)[0].classList.add("is-active")
				$("#list_"+this.indexList)[0].scrollIntoViewIfNeeded(false)	
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