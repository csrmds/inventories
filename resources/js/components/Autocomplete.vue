<template>
	
	<div class="autocomplete">
		<input 
			v-model="search" 
			@input="list" 
			@blur="blur"
			@keydown.down="onArrowDown"
			@keydown.up="onArrowUp"
			@keydown.enter="onEnter"
			@keydown.tab="isOpen=false"
			type="text" 
			class="form-control" 
		/>
		<ul	v-show="isOpen" class="autocomplete-results">

			<li v-if="isLoading" class="loading">
				Carregando lista...
			</li>

			<li
				v-else
				v-for= "(result, i) in results"
				:key= "i"
				@click= "setResult(result)"
				class= "autocomplete-result"
				:class="{'is-active': i===arrowCounter}">
				{{ result }}
			</li>

		</ul>

	</div>

	

</template>


<script>

export default {
	name: 'SearchAutocomplete',
	props: {
		items: {
			type: Array,
			required: false
			//default: ()=> ['maça', 'banana', 'melancia', 'jaca', 'morango', 'uva', 'maracuja', 'abacaxi', 'manga', 'limão', 'pepino', 'baunilha'],
		},
		isAsync: {
			type: Boolean,
			required: false,
			default: false
		}
	},

	data() {
		return {
			search: '',
			results: [],
			isOpen: false,
			arrowCounter: -1,
			isLoading: false
		};
	},

	methods: {
		filterResult() {
			this.results= this.items.filter(
				item=> item.toLowerCase().indexOf(this.search.toLowerCase()) > -1
			);
		},

		async list() {
			this.isLoading= true
			this.results= []
			const resp= await this.$store.dispatch('product/search', this.search)

			if (resp.data.length<1) {
				this.isOpen= false
			} else {
				resp.data.forEach((element, i) => {
					this.results.push(element.name)
				});
				this.isLoading= false
				this.isOpen= true
			}

		},

		setResult(result) {
			this.search= result;
			this.isOpen= false;
		},

		handleClickOutside(event) {
			if (!this.$el.contains(event.target)) {
				this.arrowCounter= -1;
				this.isOpen= false;
			}
		},

		onArrowDown() {
			if (this.arrowCounter < this.results.length) {
				this.arrowCounter= this.arrowCounter +1;
			}
		},

		onArrowUp() {
			if (this.arrowCounter > 0) {
				this.arrowCounter= this.arrowCounter -1;
			}
		},

		onEnter() {
			this.search= this.results[this.arrowCounter];
			this.arrowCounter= -1;
			this.isOpen= false
		},

		blur() {
			//this.isOpen= false
		}

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