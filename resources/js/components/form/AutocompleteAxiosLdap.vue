<template>
	
	<div class="autocomplete">
		<label :for="id" v-if="label" >{{label}}</label>
		<input 
			v-model="word" 
			@input="list" 
			@keydown.down="onArrowDown"
			@keydown.up="onArrowUp"
			@keydown.enter="onEnter"
			@keydown.esc="isOpen=false"
			@blur="onBlur"
			:id="id"
			type="text" 
			class="form-control form-control-sm"
			autocomplete="off"
		/>
		<ul	v-show="isOpen" class="autocomplete-results">
			<li v-if="isLoading" class="loading">
				<div class="spinner-border text-secondary" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</li>

			<li
				v-else
				v-for= "(result, i) in results"
				:key= "i"
				:id="'li_'+i"
				:class="{'is-active': i===arrowCounter}"
				@click= "setResult(result)"
				class= "autocomplete-result"
			>
				{{ result[column][0] }}
			</li>
		</ul>

	</div>

</template>


<script>
//colocar minimo de caracteres como parametro
//settimeout para pesquisar após keyup no input
import eventbus from '../eventbus'

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
			type: String,
			required: true
		},
		column: {
			type: String,
			required: false,
			default: false
		},
		id: null,
		inputValue: null
	},

	data() {
		return {
			word: this.inputValue,
			results: [],
			isOpen: false,
			arrowCounter: -1,
			isLoading: false,
			itemSelected: false,
		};
	},

	methods: {
		filterResult() {
			this.results= this.items.filter(
				item=> item.toLowerCase().indexOf(this.word.toLowerCase()) > -1
			);
			//console.log(this.results)
		},
	
		async list() {
			this.isLoading= true
			this.results= []
			
			const resp= await this.$store.dispatch(this.source, { 
				word: this.word, 
				column: this.column
			})

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
			this.word= result[this.column][0]
			this.itemSelected= result
			this.isOpen= false

			this.$emit('itemSelected', this.itemSelected)
		},

		async onBlur() {
			const resp= await this.$store.dispatch(this.source, { 
				word: this.word, 
				column: this.column
			})
			
			if (this.itemSelected.column==this.word) {
				console.log("o campo é igual")
				console.log(this.itemSelected.column+" -> "+this.word)
			} else {
				console.log("o campo é difrerente")
				console.log(this.itemSelected.column+" -> "+this.word)	

				if (resp.data.length>0 && resp.data[0].column==this.word) {
					console.log("o registro existe.. retornar itemSelected")
					this.itemSelected= resp.data[0]
				} else {
					console.log("o registro não existe.. retornar itemSelected false")
					this.itemSelected= false
				}
			}

			this.isOpen= false
			this.$emit('itemSelected', this.itemSelected)

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
			this.word= this.results[this.arrowCounter].column
			this.itemSelected= this.results[this.arrowCounter]
			this.arrowCounter= -1
			this.isOpen= false

			this.$emit('itemSelected', this.itemSelected)
		},

		cleanResults() {
			this.results=[]
			this.isOpen= false
			this.arrowCounter= -1
			this.inputId= null
			this.itemSelected= null
		},

		cleanWord() { this.word= null },

		// loadInput() {
		// 	if (this.itemInput!=null) {
		// 		console.log('carregou loadInput')
		// 		this.itemSelected= this.itemInput
		// 		this.word= this.itemSelected[this.column]
		// 		console.log(this.itemSelected[this.column])
		// 	}
		// }

	},

	watch: {
		items: function (value, oldValue) {
			if (this.isAsync) {
				this.results= word;
				this.isOpen= true;
				this.isLoading= false;
			}
		},

		inputValue: function(newValue) {
			this.word= newValue
		}
	},

	mounted() {
		document.addEventListener('click', this.handleClickOutside);
		eventbus.$on('cleanAutocomplete', ()=>{
			//console.log('escutou clenaAutocomplete...')
			this.cleanResults()
			this.cleanWord()
		})

		eventbus.$on('loadAutocomplete', (param)=>{
			// console.log('loadAutocomplete...')
			// console.log(param)
			this.cleanResults()
			this.cleanWord()
			this.itemSelected= param
			this.word= this.itemSelected[this.column]
			// console.log(this.itemSelected[this.column])
		})
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
	min-width: 170px;
	width: auto;
	/*max-height: 6em;*/
	overflow: auto;
	z-index: 10;
	position: absolute;
	background-color: white;
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