<template>
	
	<div class="autocomplete">
		<label :for="inputId" v-if="label" >{{label}}</label>
		<input 
			v-model="word" 
			@input="list" 
			@keydown.down="onArrowDown"
			@keydown.up="onArrowUp"
			@keydown.enter="onEnter"
			@keydown.tab="isOpen=false"
			type="text" 
			class="form-control"
			:id="inputId"
		/>
		<ul	v-show="isOpen" class="autocomplete-results">

			<li v-if="isLoading" class="loading">
				Carregando lista...
			</li>

			<li
				v-else
				v-for= "(result, i) in results"
				:key= "i"
				:id="'li_'+i"
				@click= "setResult(result)"
				class= "autocomplete-result"
				:class="{'is-active': i===arrowCounter}">
				{{ result.name }}
			</li>

		</ul>

	</div>

	

</template>


<script>
//colocar minimo de caracteres como parametro
//settimeout para pesquisar após keyup no input

export default {
	//name: 'SearchAutocomplete',
	props: {
		items: {
			type: Array,
			required: false
		},
		isAsync: {
			type: Boolean,
			required: false,
			default: false
		},
		label: {
			type: String,
			default: null
		},
		source: {
			type: String, Array,
			required: true
		}
	},

	data() {
		return {
			word: '',
			results: [],
			isOpen: false,
			arrowCounter: -1,
			isLoading: false,
			inputId: null,
			attr: []
		};
	},

	methods: {
		filterResult() {
			this.results= this.items.filter(
				item=> item.toLowerCase().indexOf(this.word.toLowerCase()) > -1
			);
		},

		async list() {
			this.isLoading= true
			this.results= []
			const resp= await this.$store.dispatch(this.source, this.word)

			if (resp.data.length<1) {
				this.isOpen= false
			} else {
				resp.data.forEach((element, i) => {
					this.results.push(element)
				});
				this.isLoading= false
				this.isOpen= true
			}

		},

		setResult(result) {
			this.attr= result,
			this.word= result.name;
			this.inputId= result.id;
			this.isOpen= false;
		},

		handleClickOutside(event) {
			if (!this.$el.contains(event.target)) {
				this.arrowCounter= -1;
				this.isOpen= false;
				this.word=="" ? this.inputId=null : false
			}
		},

		onArrowDown() {
			if (this.arrowCounter < this.results.length-1) {
				this.arrowCounter++
				$("#li_"+this.arrowCounter)[0].scrollIntoViewIfNeeded(false)
			}
		},

		onArrowUp() {
			if (this.arrowCounter > 0) {
				this.arrowCounter--
				$("#li_"+this.arrowCounter)[0].scrollIntoViewIfNeeded(false)
			}
		},

		onEnter() {
			this.attr= this.results[this.arrowCounter]
			this.word= this.results[this.arrowCounter].name
			this.inputId= this.results[this.arrowCounter].id
			this.arrowCounter= -1
			this.isOpen= false
		},

	},

	watch: {
		items: function (value, oldValue) {
			if (this.isAsync) {
				this.results= value;
				this.isOpen= true;
				this.isLoading= false;
			}
		}
	},

	mounted() {
		document.addEventListener('click', this.handleClickOutside);
	},

	destroyed() {
		document.removeEventListener('click', this.handleClickOutside);
	},


}


</script>

<style>

.autocomplete { position: relative; }

.autocomplete-results {
	padding: 0;
	margin: 0;
	border: 1px solid #eeeeee;
	height: 160px;
	min-height: 1em;
	/*max-height: 6em;*/
	overflow: auto;
}

.autocomplete-result {
	list-style: none;
	text-align: left;
	padding: 4px 2px;
	cursor: pointer;
}

.autocomplete-result.is-active,
.autocomplete-result:hover {
	background-color: #4aae9b;
	color: white;
}

</style>